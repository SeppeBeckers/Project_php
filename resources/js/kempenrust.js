xport function hello(){
    console.log('Welkom op de reserveringspagina van het hotel Kempenrust!');
}

$(function(){
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    });
});

Noty.overrideDefaults({
    layout: 'topRight',
    theme: 'bootstrap-v4',
    timeout: 3000
});