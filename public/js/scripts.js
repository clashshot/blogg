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

function removecategory(button, blogid, cate) {
    $.ajax('/blog/manage/' + blogid + '/removecategory/', {
        data: {format: "json", category: cate},
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

function setVisibility(button, bid, visibility) {
    $.ajax('/blog/visibility/',{
        data: {format: "json", blog_id: bid, visible: visibility},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            var parent = button.parentNode;
            parent.innerHTML = '';
            if(data == 1){
                $('<i class="-alt fa fa-2x fa-eye fa-fw" onclick="setVisibility(this, ' + bid + ', 0)"></i>').appendTo(parent);
            }else if(data == 0){
                $('<i class="-alt fa fa-2x fa-fw fa-eye-slash" onclick="setVisibility(this,' + bid + ', 1)"></i>').appendTo(parent);
            }
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}

function like_post(button, post, like) {
    $.ajax('/blog/like/',{
        data: {format: "json", post_id: post, like: like},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            if(data == 1){
                button.setAttribute('onclick', 'like_post(this, ' + post + ', 0)');
                button.setAttribute('class', "btn btn-primary btn-sm");
                button.innerHTML = "Sluta gilla"
            }else if(data == 0){
                button.setAttribute('onclick', 'like_post(this, ' + post + ', 1)');
                button.setAttribute('class', "btn btn-primary btn-sm");
                button.innerHTML = "Gilla"
            }
            $("#likes").load("/blog/ajaxcheck/post_likes", {post_id: post});
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}

function like_comment(button, comment, like) {
    $.ajax('/blog/like_comment/',{
        data: {format: "json", comment_id: comment, like: like},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            if(data == 1){
                button.setAttribute('onclick', 'like_comment(this, ' + comment + ', 0)');
                button.setAttribute('class', "btn btn-primary btn-sm");
                button.innerHTML = "Sluta gilla"
            }else if(data == 0){
                button.setAttribute('onclick', 'like_comment(this, ' + comment + ', 1)');
                button.setAttribute('class', "btn btn-primary btn-sm");
                button.innerHTML = "Gilla"
            }
            $("#comment_likes" + comment).load("/blog/ajaxcheck/comment_likes", {comment_id: comment});
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}

function postHistory(historyid) {
    console.log(historyid);
    $.ajax('/blog/ajaxCheck/posthistory/',{
        data: {format: "json", post_id: historyid},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            document.getElementById("title").value = data.title;
            var parent = $(".btn-inner")[$(".btn-inner").length - 1].parentNode;
            if(parent.getAttribute("class").includes("on")){
                $("#editor").bbcode(data.content);
            }else{
                $(".btn-inner").click();
                $("#editor").bbcode(data.content);
                $(".btn-inner").click();
            }
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}

function favoritepost(button, post, favorite) {
    $.ajax('/blog/favorite/',{
        data: {format: "json", postid: post, favorite: favorite},
        dataType: 'json',
        type: "POST",
        success:function (data) {
            if(data == 1){
                button.setAttribute('onclick', 'favoritepost(this, ' + post + ', 0)');
                button.setAttribute('class', "btn btn-primary btn-sm glyphicon glyphicon-star");
            }else if(data == 0){
                button.setAttribute('onclick', 'favoritepost(this, ' + post + ', 1)');
                button.setAttribute('class', "btn btn-primary btn-sm glyphicon glyphicon-star-empty");
            }
        },
        error:function (request, status, error) {
            var manage = document.getElementsByClassName("col-md-9")[0];
            $('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + error + '</div>').prependTo(manage);
        }
    });
}