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

function unsolvereport(button, id) {
    $.ajax('/admin/report/unsolve/' + id,{
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

function addCategory(bid) {
    var category = document.getElementById("new_category"),
        cat_select = document.getElementById("cat_select");
    $.ajax("/blog/ajaxAdd/" + bid + "/addcategory",{
        data: {format: "json", name: category.value},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            cat_select.innerHTML = "";
            $('<option disabled >Välj kategori</option>').appendTo(cat_select);
            for(var i = 0; i < data.length; i++){
                if(category.value == data[i].name){
                    $('<option selected value="' + data[i].id + '">' + data[i].name + '</option>').appendTo(cat_select);
                }else{
                    $('<option value="' + data[i].id + '">' + data[i].name + '</option>').appendTo(cat_select);
                }
            }
            category.value = '';
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}
