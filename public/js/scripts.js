var recaptcha1;
var recaptcha2;
var myCallBack = function() {

    recaptcha1 = grecaptcha.render('recaptcha1', {
        'sitekey' : '6Ldk-wgUAAAAAPGDPYPxtgopZxFfDIDmqvafCJ36'
    });

    recaptcha2 = grecaptcha.render('recaptcha2', {
        'sitekey' : '6Ldk-wgUAAAAAPGDPYPxtgopZxFfDIDmqvafCJ36'
    });
};

var locSearch = window.location.search.substring(1).split('&')[0];
if(locSearch){
    document.getElementById( locSearch ).style.display = "block";
}

function solvereport(button, id) {
    $.ajax('/admin/report/solve/' + id,{
        success:function (data) {
            console.log("Lyckades: " + data);
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        },

    });
}