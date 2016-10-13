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
            if(data){
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }else{
                var report = document.getElementsByClassName("col-md-9")[0];
                $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Misslyckades att ändra status</div>').prependTo(report);
            }
        }
    });
}

function removemod(button, bid, uid) {
    $.ajax('/blog/removeMod/' + bid, {
        data: {format: "json", user_id: uid},
        dataType: 'json',
        type: "POST",
        success: function (data) {
            if (data) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else {
                var manage = document.getElementsByClassName("col-md-9")[0];
                $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Misslyckades att ta bort mod</div>').prependTo(manage);
            }
        }
    });
}


function blogSlugCheck(field) {
    $.ajax('/blog/ajaxcheck/blog_slug/' + field.value, {
        success:function (data) {
            if (field.nextElementSibling){
                field.nextElementSibling.innerHTML = '/' + data;
            }else{
                var slug = document.createElement('span');
                slug.setAttribute("class", "help-block");
                slug.innerHTML = data;
                field.parentNode.appendChild(slug);
            }
        },
        error: function (request, status, error) {
            alert(error);

        }
    });
}