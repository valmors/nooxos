if (window.location.host == "localhost") {
    const BASE_URL = "http://localhost/nooxos/";
    //alert("Sistema Local");
} else {
    const BASE_URL = "http://os.nooxbrasil.com.br/"; 
    //alert("Sistema Oline");
}

$(function () {
    function blinker() {
        $('.blink_me').fadeOut(1000);
        $('.blink_me').fadeIn(1000);
    }
    setInterval(blinker, 1000);
});//]]> 
