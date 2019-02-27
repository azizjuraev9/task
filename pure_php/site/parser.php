<?php

function getSslPage($url) {

	$ch = curl_init();
	//curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$result = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	//echo "<pre>";
	//var_dump(curl_getinfo($ch));die;
	
	curl_close($ch);
	if($http_code != 200)
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
	
	$content = '';
	try{
		$content = getSslPage($url);
	}catch(\Exception $e){
		$xml->addChild('net',$e->getMessage().' '.$e->getCode());
	}
	
	$dom = new DOMDocument('1.0', 'UTF-8');
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
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
		$c_url = $xml->addChild('url'.$n);
		parse($_GET['site'.$n],$_GET['const'],$c_url);
		$n++;
	}
	return $sites;
}

$xml = new SimpleXMLElement('<data/>');
parseUrls($xml);
header('Content-Type: text/plain');
$out = str_replace("\n","",$xml->asXML());
$out = str_replace("\r","",$out);
$out = str_replace("$#xD","",$out);
echo html_entity_decode($out,ENT_COMPAT | ENT_HTML5);
