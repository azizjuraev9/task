var angle = 0;

function galleryspin(to) {
    spinner = document.querySelector("#spinner");
    angle = to;
    spinner.setAttribute("style", "-webkit-transform: rotateY(" + angle + "deg); -moz-transform: rotateY(" + angle + "deg); transform: rotateY(" + angle + "deg);");
}

function showResult(result) {
    var content = '';
    if(result.id == 'money'){
        content = '<img src="/assets/imgs/money.png"><h2>'+ result.value +' <span class="glyphicon glyphicon-euro"></span></h2>';
        content += '<div class="btn btn-success" onclick="sendMoney()">Send me</div>';
        content += '<div class="btn btn-success" onclick="convertMoney('+ parseInt(result.value*conversion_ratio) +')">Convert to units( '+ parseInt(result.value*conversion_ratio) +' )</div>';
    }else if(result.id == 'units'){
        content = '<img src="/assets/imgs/coins.png"><h2>'+ result.value +' Units</h2>';
    }else{
        content = '<img src="'+result.image+'"><h2>'+ result.name +'</h2>';
        content += '<div class="btn btn-success" onclick="sendGift()">Send me</div>';
        content += '<div class="btn btn-danger" onclick="refuse()">I don`t need that</div>';
    }
    $("#result-content").html(content);
    $("#result-modal").modal('show');
}

function sendMoney(){
    $.post(
        '/',
        {
            action: 'result',
            token: token,
            giftAction: 'send'
        },
        function (data) {
            $("#result-content").html('<h2>Money has been sent successfully!</h2>');
        });
}

function convertMoney(sum){
    $.post(
        '/',
        {
            action: 'result',
            token: token,
            giftAction: 'convert'
        },
        function (data) {
            $("#units").text(data);
            $("#result-content").html('<h2>Converted successfully!</h2>');
        });
}

function sendGift(){
    $.post(
        '/',
        {
            action: 'result',
            token: token,
            giftAction: 'save'
        },
        function (data) {
            $("#result-content").html('<h2>Your winning will be sent soon!</h2>');
        });
}

function refuse(){
    $.post(
        '/',
        {
            action: 'result',
            token: token,
            giftAction: ''
        },
        function (data) {
            $("#result-content").html(' ');
            $("#result-modal").modal('hide');
        });
}

$(function () {

    var el = $("#spinner>div").length;

    $("#spinner>div").each(function (i, e) {
        $(e).css('transform', 'rotateY(' + (360 / el) * i + 'deg)');
    });

    $("#rotate").click(function () {
        $("#rotate").hide();
        var units = parseInt($("#units").text());

        if(units > rotate_cost)
            $.post(
                '/',
                {
                    action: 'getGift',
                    token: token
                },
                function (data) {
                    data = JSON.parse(data);
                    var i = $("#item-" + data.id).index();
                    if (angle > 3000)
                        angle = 360 - ((360 / el) * i);
                    else
                        angle = 3600 - ((360 / el) * i);
                    galleryspin(angle);

                    setTimeout(function () {
                        showResult(data);
                        $("#units").text( data.units );
                        $("#rotate").show();
                    },5500);
                });
        else
            alert("You don't have enough units to play");
    });
});



