export function hello(){
    console.log('Welkom op de reserveringspagina van het hotel Kempenrust!');
}

$(function(){
    //Tooltips
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

export function names_footer(ontwikkelaarId, testId){
    let namen =["Babette Geerkens ", "Brent Vervecken ", "Jentse van Thielen ", "Seppe Beckers "];
    let ontwikkelaar = namen[ontwikkelaarId -1];
    let test = namen[testId -1];
    namen.splice (ontwikkelaarId - 1, 1);

    if (namen.indexOf(test) > -1){
        let id = namen.indexOf(test);
        namen.splice(id,1);
    }

    let footer_names = ontwikkelaar + " (O), " + test + " (T)";
    for (let i = 0; i < namen.length; i++){
        footer_names += ",  " + namen[i];
    }
    console.log(footer_names);
    return footer_names;





}
// maak een methode met 2 parameters voor de ontwikkelaar en tester
// ieder teamlid krijgt een volgnummer
