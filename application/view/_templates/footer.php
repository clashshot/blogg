    </div><!-- close class="wrapper" -->

    <!-- the support button on the top right -->
    <a class="support-button" href="https://affiliates.a2hosting.com/idevaffiliate.php?id=4471&url=579" target="_blank"></a>
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
                buttons: "bold,italic,underline,strike,|,myimg,video,link,|,fontcolor,fontsize,fontfamily,|,justifyleft,justifycenter,justifyright,|,quote,|,bullist,numlist",
                allButtons: {
                    myimg: {
                        title: "Inserting a picture with the parameters",
                        buttonText: "myimg",
                        modal: { //Description of modal window
                            title: "Modal title",
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
                                        },
                                        {
                                            param: "WIDTH",
                                            title: "Bildbredd(lämna en av dessa blank för att behålla proportionerna)"
                                        },
                                        {
                                            param: "HEIGHT",
                                            title: "Bildhöjd(lämna en av dessa blank för att behålla proportionerna)"
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
                            '<img width="{WIDTH}" height="{HEIGHT}" src="{SRC}" title="{TITLE}" />': '[img width={WIDTH} height={HEIGHT} title={TITLE}]{SRC}[/img]'
                        }
                    }

                }
            }
            $("#editor").wysibb(wbbOpt);
        })
    </script>

</body>
</html>