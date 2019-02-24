<?php

function getSslPage($url) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if(!$result)
		throw new Exception('Ошибка',$http_code);	
	return $result;

}

function parse($url,$const,&$xml){
	$headers = [];
	$tags = [];
	switch((int)$const){
		case(1): $headers = ['h2']; break;
		case(2): $headers = ['h2','h3']; break;
		case(3): $headers = ['h2','h3','h4']; break;
	}
	$content = getSslPage($url);
	$dom = new DOMDocument;
	$dom->loadHTML($content);
	foreach ($headers as $header){
		foreach ($dom->getElementsByTagName($header) as $node) {
			$xml->addChild($header,$node->nodeValue);
		}
	}
	return $tags;
}

function parseUrls(&$xml){
	if(!isset($_GET['const']))
		return [];

	$sites = [];

	$n = 1;
	while(isset($_GET['site'.$n])){
//		$c_url = $xml->addChild($_GET['site'.$n]);
		$c_url = $xml->addChild('url'.$n);
		parse($_GET['site'.$n],$_GET['const'],$c_url);
		$n++;
	}
	return $sites;
}

$xml = new SimpleXMLElement('<data/>');
try{
	parseUrls($xml);
}catch(\Exception $e){
	$xml->addChild('net',$e->getMessage().' '.$e->getCode());
}
echo $xml->asXML();

