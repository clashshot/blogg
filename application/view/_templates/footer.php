    </div><!-- close class="wrapper" -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
        <script src="<?php echo Config::get('URL'); ?>js/scripts.js" async defer></script>
    <script src="https://use.fontawesome.com/33c781547e.js"></script>
    <script src="<?php echo Config::get('URL'); ?>js/wysibb/jquery.wysibb.min.js"></script>

    <script>
        var mymodal = function(cmd,opt,queryState) {
            var url = prompt("Enter the image URL");
            if (queryState) {
                //Delete the current BB code, if it is active.
                //This is necessary if you want to replace the current element
                this.wbbRemoveCallback(cmd,true);
            }
            //Call syntax wbbInsertCallback (command, params), where params - Perrin values ​​to be inserted
            this.wbbInsertCallback(cmd,{src:url});

            //this.wbbRemoveCallback(cmd); /delete the current function BB code
        }

        $(function() {
            var wbbOpt = {
                buttons: "bold,italic,underline,strike,sup,sub,|,bild,video,link,|,fontcolor,fontsize,fontfamily,|,justifyleft,justifycenter,justifyright,|,quote,|,bullist,numlist",
                allButtons: {
                    bild: {
                        title: "Lägg in bild",
                        buttonText: "Bild",
                        modal: { //Description of modal window
                            title: "Bild",
                            width: "600px",
                            tabs: [
                                {
                                    input: [ //List of form fields
                                        {
                                            param: "SRC",
                                            title: "Bildlänk:",
                                            validation: '^http(s)?://.*?\.(jpg|png|gif|jpeg)$'
                                        },
                                        {
                                            param: "TITLE",
                                            title: "Bildtitel:",
                                            type: "div"
                                        }
                                    ]
                                }
                            ],
                            onLoad: function () {
                                //Callback function that will be called after the display of a modal window
                            },
                            onSubmit: function () {
                                //Callback function that will be called by pressing the "Save"
                                //If function return false, it means sending data WysiBB not be made
                            }
                        },
                        transform: {
                            '<img width="100%" src="{SRC}" title="{TITLE}" />': '[img width=100% title={TITLE}]{SRC}[/img]'
                        }
                    },
                    video: {
                        title: "Lägg till youtubelänk",
                        buttonHTML: '<span class="fonticon ve-tlb-video1">\uE008</span>',
                        modal: {
                            title: "Lägg till youtubelänk",
                            width: "600px",
                            tabs: [
                                {
                                    title: "Lägg till länk:",
                                    input: [
                                        {param: "SRC",title:CURLANG.modal_video_text}
                                    ]
                                }
                            ],
                            onSubmit: function(cmd,opt,queryState) {
                                var url = this.$modal.find('input[name="SRC"]').val();
                                if (url) {
                                    url = url.replace(/^\s+/,"").replace(/\s+$/,"");
                                }
                                var a;
                                if (url.indexOf("youtu.be")!=-1) {
                                    a = url.match(/^http[s]*:\/\/youtu\.be\/([a-z0-9_-]+)/i);
                                }else{
                                    a = url.match(/^http[s]*:\/\/www\.youtube\.com\/watch\?.*?v=([a-z0-9_-]+)/i);
                                }
                                if (a && a.length==2) {
                                    var code = a[1];
                                    this.insertAtCursor(this.getCodeByCommand(cmd,{src:code}));
                                }
                                this.closeModal();
                                this.updateUI();
                                return false;
                            }
                        },
                        transform: {
                            '<iframe src="http://www.youtube.com/embed/{SRC}" width="640" height="480" frameborder="0"></iframe>':'[youtube]{SRC}[/youtube]'
                        }
                    }

                }
            }
            $("#editor").wysibb(wbbOpt);
        })
    </script>
</body>
</html>