<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 3/11/2017
 * Time: 3:03 PM
 */
?>
<body class="bg-dark" style="background-image: url('<?php echo base_url('assets/im/img/bg.png'); ?>');">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="<?php echo base_url("imadmin") ?>">
                    <i class="fa fa-comments" style="padding-right: 10px; font-size: 1.5em;"></i><span>Chat Manager</span>
                </a>
            </div>
            <div class="login-form">
                <form id="loginForm" method="post">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" autocomplete="off" placeholder="Email" name="userEmail" id="loginEmail">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" autocomplete="off" placeholder="Password" name="userPassword" id="loginPassword">
                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" id="loginSubmit">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    localStorage.removeItem("_r");
    ( function ( $ ) {
        "use strict";

        <?php if(isset($demo) && $demo==true){ ?>
        $("#loginEmail").val("admin@admin.com");
        $("#loginPassword").val("123456");
        <?php }?>
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
        $('#loginSubmit').on('click',function (e) {
            e.preventDefault();
            if(!$('#ErrorBlock1').hasClass('hidden')){
                $('#ErrorBlock1').addClass('hidden');
            }

            if(!loginValid()){
                return;
            }
            var form=new FormData($('#loginForm')[0]);
            $.ajax({
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imregistration/adminLogin/'); ?>",
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
                        localStorage.setItem("_r",responseToken);
                        var type=jwt_decode(responseToken).userType;
                        if(type==0){
                            location.href="<?php echo base_url('imadmin/loginSuccess')."?r="; ?>"+responseToken;
                        }
                        else {
                            location.href="<?php echo base_url('imadmin')."?error=true"; ?>";
                        }

                    }

                },
                "statusCode": {
                    404: function(error) {
                        var msg=JSON.parse(error.responseText);
                        $('#ErrorBlock1').removeClass("hidden");
                        //$('.error-message1').html(" "+msg.status.message);
                    },
                    406: function (error) {
                        $('#ErrorBlock1').removeClass("hidden");
                        //$('.error-message1').html(" All Inputs Are Required");
                    }
                }
            });
        });
    } )( jQuery );


</script>


</body>
</html>