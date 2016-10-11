var recaptcha1;
var recaptcha2;
var myCallBack = function() {

    recaptcha1 = grecaptcha.render('recaptcha1', {
        'sitekey' : '6Lf9lAgUAAAAAK3bvFom92-FadchsiIaAkU1iI5M'
    });

    recaptcha2 = grecaptcha.render('recaptcha2', {
        'sitekey' : '6Lf9lAgUAAAAAK3bvFom92-FadchsiIaAkU1iI5M'
    });
};

var locSearch = window.location.search.substring(1).split('&')[0];
if(locSearch){
    document.getElementById( locSearch ).style.display = "block";
}