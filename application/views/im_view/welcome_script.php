<script type="text/javascript">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    $(document).ready(function() {

        localStorage.removeItem("_r");
        localStorage.removeItem("T");
        localStorage.removeItem("groupId");
        localStorage.removeItem("groupObjects");
        window.mobileAndTabletcheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        <?php if(isset($demo) && $demo==true) {?>
            $("#loginInfoModal").modal("show");
            $("#loginInfo").on("click",function () {
                $("#loginInfoModal").modal("show");
            });
        <?php }?>
        $("#login").on("click",function () {
            $("#registerDiv").hide();
            $("#loginDiv").show();
        });
        $("#register").on("click",function () {
            $("#loginDiv").hide();
            $("#registerDiv").show();
        });
        $('#loginPassword').keypress(function (e) {
            if (e.which == 13) {
                $("#loginSubmit").trigger('click');
            }
        });
        $("#loginSubmit").on("click",function (e) {
            var form = new FormData();
            form.append("userPassword", $('#loginPassword').val());
            form.append("userEmail", $('#loginEmail').val().trim());
            form.append("<?php echo $this->security->get_csrf_token_name(); ?>","<?php echo $this->security->get_csrf_hash(); ?>");
            if(!loginValid()){
                return;
            }
            $.ajax({
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imregistration/login/'); ?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "cache-control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "success":function (response) {
                    var data=JSON.parse(response);
                    if(data.status.code==200 && data.status.message=="Success")
                    {
                        var	responseToken= data.response;
                        if(data.type=="token"){
                            localStorage.setItem("_r",responseToken);
                        }
                        else{
                            localStorage.setItem("_r",JSON.stringify(responseToken));
                        }

                        localStorage.setItem("T",data.type);
                        if(window.mobileAndTabletcheck()){
                            location.href="<?php echo base_url('immobile/loginSuccess')."?r="; ?>"+responseToken;
                        }else{
                            location.href="<?php echo base_url('imuserview/loginSuccess')."?r="; ?>"+responseToken;
                        }


                    }

                },
                "statusCode": {
                    404: function(error) {
                        var msg=JSON.parse(error.responseText);
                        toastr.error(msg.status.message);
                    },
                    406: function (error) {
                        var msg=JSON.parse(error.responseText);
                        toastr.error(msg.status.message);
                    }
                }
            });
        });
        $(".regInput").on("click",function () {
            $(this).css("border", "1px solid #ccc")
        });
        $('#regSubmit').on("click",function () {
            if(!urserRegValid()){
                return;
            }
            var form = new FormData();
            let fname=$('#regFirstName').val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let lname= $('#regLastName').val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            form.append("firstName", fname);
            form.append("userPassword", $('#regPassword').val());
            form.append("userEmail", $('#regEmail').val().trim());
            form.append("lastName", lname);
            form.append("userType", 1);
            form.append("<?php echo $this->security->get_csrf_token_name(); ?>","<?php echo $this->security->get_csrf_hash(); ?>");


            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imregistration/register/'); ?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "cache-control": "no-cache",

                },
                "statusCode": {
                    406: function(error) {

                        toastr.error(" One or more Input Fields Are Empty")
                    },
                    409:function(error) {

                        toastr.error(" "+" Email already exist!");
                    }
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };

            $.ajax(settings).done(function (response) {
                var data=JSON.parse(response);
                if(data.status.code==200 )
                {
                    toastr.info(" "+" Registration Successful. You can login now");
                    var	responseToken= data.response;
                    if(data.type=="token"){
                        localStorage.setItem("_r",responseToken);
                    }
                    else{
                        localStorage.setItem("_r",JSON.stringify(responseToken));
                    }

                    localStorage.setItem("T",data.type);
                    if(window.mobileAndTabletcheck()){
                        location.href="<?php echo base_url('immobile/loginSuccess')."?r="; ?>"+responseToken;
                    }else{
                        location.href="<?php echo base_url('imuserview/loginSuccess')."?r="; ?>"+responseToken;
                    }

                }

            });
        });

        <?php
        if($token!=null && $token!=''){
        ?>

        var verifyToken="<?php echo $token ?>";
        if(verifyToken!=null && verifyToken!=''){
            var userEmail=jwt_decode(verifyToken).userEmail;
            var form = new FormData();
            form.append("userToken", verifyToken);
            form.append("userEmail", userEmail);
            form.append("<?php echo $this->security->get_csrf_token_name(); ?>","<?php echo $this->security->get_csrf_hash(); ?>");
            $.ajax({
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imregistration/emailVerification/'); ?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "cache-control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "success":function (response) {
                    var data=JSON.parse(response);
                    if(data.status.code==200)
                    {
                        toastr.info(" "+data.status.message);

                    }

                },
                "statusCode": {
                    404: function(error) {
                        var msg=JSON.parse(error.responseText);

                        toastr.error(" "+msg.status.message);

                    },
                    406: function (error) {
                        var msg=JSON.parse(error.responseText);
                        toastr.error(" "+msg.status.message);
                    }
                }
            });
        }


        <?php
        }
        ?>
        function loginValid(){
            var userPassword= $('#loginPassword').val();
            var userEmail=$('#loginEmail').val().trim();

            var ret = true;
            if (userEmail == null || userEmail == "" ) {
                ret = false;
                $('#loginEmail').css("border", "2px solid red");
            }
            if (userPassword == null || userPassword == "") {
                ret = false;
                $('#loginPassword').css("border", "2px solid red");
            }
            return ret;
        }
        function checkSpaceAndLength(string,length){
            return string.indexOf(' ') === -1 && string.length<=length;

        }
        function urserRegValid() {
            var firstName = $('#regFirstName').val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            var userPassword = $('#regPassword').val();
            var userEmail = $('#regEmail').val().trim();
            let lname= $('#regLastName').val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();

            var ret = true;
            if (firstName == null || firstName == "" ) {
                ret = false;
                $('#regFirstName').css("border", "2px solid red");
            }
            if (!checkSpaceAndLength(firstName,15)) {
                ret = false;
                $('#regFirstName').css("border", "2px solid red");
            }
            if (!checkSpaceAndLength(lname,15)) {
                ret = false;
                $('#regLastName').css("border", "2px solid red");
            }
            if (userEmail == null || userEmail == "" ) {
                ret = false;
                $('#regEmail').css("border", "2px solid red");
            }
            if (userPassword == null || userPassword == "") {
                ret = false;
                $('#regPassword').css("border", "2px solid red");
            }
            if(!isEmail(userEmail)  && ret!=false){
                ret=false;
                $('#ErrorBlock5').addClass("hidden");
                $('#ErrorBlock2').removeClass("hidden");
                $('.error-message2').html(" "+" Email is not valid");
                $('#regEmail').css("border", "2px solid red");
            }
            return ret;
        }

        function  isPhone(number) {
            var regex = /^[0-9-+]+$/;
            return regex.test(number);
        }
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        let AllInputTag = $('input[type=text]');
        AllInputTag.keyup(function(e) {
            if (isUnicode($(this).val())) {
                $(this).css('direction', 'rtl');
            }
            else {
                $(this).css('direction', 'ltr');
            }
        });
    });

</script>

</body>

</html>