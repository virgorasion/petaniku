<script>
    $(document).ready(function () {
        let t=null;
        let name=null;
        let pic=null;
        window.mobileAndTabletcheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        if(!window.mobileAndTabletcheck()){
            location.href="<?php echo base_url('imuserview/profile') ?>";
        }
        $(window).bind("resize",function () {
            if(!window.mobileAndTabletcheck()){
                location.href="<?php echo base_url('imuserview/profile') ?>";
            }
        });
        let tc=null;
        $("#profileLink").attr("href","#");
        $("#profileLink").attr("target","");
        window.setInterval(function() {
            tc=localStorage.getItem("_r");

            if(tc===null){
                location.href="<?php echo base_url('imuserview/logout') ?>";
            }
            if(String(localStorage.getItem("T"))=="token"){
                t=localStorage.getItem("_r");
                name=jwt_decode(t).firstName;
                pic=jwt_decode(t).profilePicture
            }else{
                t=JSON.parse(localStorage.getItem("_r"));
                name=t.firstName;
                pic=t.profilePicture;
            }
            $("#userNameTop").html(name);
            $("#userImageTop").attr("src",pic);


        },1000)
    });
</script>
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
    $(document).ready(function () {
        <?php if(isset($demo) && $demo==true){ ?>
        $("#userPassword").prop("disabled",true);
        $("#newPassword").prop("disabled",true);
        $("#RePassword").prop("disabled",true);
        $("#passwordFormSubmit").prop("disabled",true);
        <?php }?>
        $(".jumper").on("click", function( e ) {

            e.preventDefault();

            $("body, html").animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 600);

        });

        let responce=null;
        let userId=null;
        let type=1;
        let ID_BASED=false;
        if(String(localStorage.getItem("T"))=="token"){
            responce=localStorage.getItem("_r");
            userId=jwt_decode(responce).userId;
            type=jwt_decode(responce).userType;
        }else{
            responce=JSON.parse(localStorage.getItem("_r"));
            userId=responce.userId;
            ID_BASED=true;
        }

        function getblockList(){
            var form = new FormData();
            form.append("userId",userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/getBlockList') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",
                
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };

            $.ajax(settings).done(function (response) {
                let list=JSON.parse(response).response;
                let strVar="";
                for(let i=0;i<list.length;i++){
                    strVar += "<li id='user_"+list[i].userId+"'>";
                    strVar += "                                            <span style='text-transform: capitalize;'>"+list[i].firstName+" "+list[i].lastName+"<\/span>&nbsp;&nbsp;<span class=\"unblock\" style=\"color: #75aef3;cursor: pointer\" data-i='"+list[i].userId+"' data-g='"+list[i].group+"' >Unblock<\/span>";
                    strVar += "                                        <\/li>";
                }
                $("#blockList").html(strVar);

            });
        }
        if(responce!=null && responce!='' && type==1)
        {
            let url="<?php echo base_url('imuser/userProfile/')?>";
            if(ID_BASED){
                url="<?php echo base_url('imuser/userProfile?userId=')?>"+userId;
            }
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",
                
                },
                "processData": false,
                "contentType": false,
                "statusCode": {
                    401: function(error) {
                        location.href="<?php echo base_url('imuserview/logout') ?>"
                    }
                }
            };

            $.ajax(settings).done(function (response) {

                var data=response;
                $('#firstName').val(data.response.firstName);
                $('#lastName').val(data.response.lastName);
                $('#userEmail').val(data.response.userEmail);
                $("#editProfileImage").fadeIn("fast").attr("src", data.response.profilePictureUrl);
            });
            getblockList();
        }
        else {
            location.href="<?php echo base_url("imuserview/logout")  ?>";
        }
        $("#profileImage").click(function () {

            $("#profileImageFile").click();
        });

        $("#blockList").on("click",".unblock",function () {
            let id=parseInt($(this).attr("data-i"));
            let group=parseInt($(this).attr("data-g"));

            var form = new FormData();
            form.append("groupId",group);
            form.append("userId",id);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/unblockGroup') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",
                    
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };

            $.ajax(settings).done(function (response) {
                $("#user_"+id).remove();
                toastr.info("Unblock successful");
            });
        });

        $('#passwordForm').on("submit",function (e) {

            e.preventDefault();
            if(responce!=null || responce!='') {
                var oldPass=$('#userPassword').val();
                var newPass=$('#newPassword').val();
                var rePass=$('#RePassword').val();
                if(oldPass==null || oldPass==""){
                    toastr.error("Old password is empty");
                    return;
                }
                <?php if(isset($demo) && $demo==true){ ?>
                    return;
                <?php }?>
                if(newPass==rePass && (oldPass!=null && oldPass!='') && (newPass!=null && newPass!='')){
                    var form = new FormData($(this)[0]);
                    if(ID_BASED){
                        form.append("userId",userId);
                    }
                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "<?php echo base_url('/imuser/changePassword/'); ?>",
                        "method": "POST",
                        "headers": {
                            "authorization": "Basic YWRtaW46MTIzNA==",
                            "x-auth-token": String(responce),
                            "cache-control": "no-cache",
                            
                        },
                        "processData": false,
                        "contentType": false,
                        "mimeType": "multipart/form-data",
                        "data": form
                    };

                    $.ajax(settings).done(function (response) {

                        var data=JSON.parse(response);

                        if(data.status.code == 200 && data.status.message=="Success") {

                            toastr.info("Password Update Successful");

                        }
                    }).fail(function (e) {

                        var msg=JSON.parse(e.responseText);

                        if(msg.stauts.code==406) {

                            toastr.error("All Inputs Are Required");

                        }
                        else {

                            toastr.error(msg.stauts.message);

                        }
                    });
                }
                else{

                    toastr.error("New Password And Retype password Doesn't Match");

                }
            }

        });

        function checkSpaceAndLength(string,length){
            return string.indexOf(' ') === -1 && string.length<=length;

        }

        function profileFormValidation(){
            let firstName=$("#firstName").val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let lastName=$("#lastName").val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let ret=true;
            if (firstName == null || firstName == "" ) {
                ret = false;
                $('#firstName').css("border", "2px solid red");
            }
            if (!checkSpaceAndLength(firstName,15)) {
                ret = false;
                $('#firstName').css("border", "2px solid red");
            }
            if (!checkSpaceAndLength(lastName,15)) {
                ret = false;
                $('#lastName').css("border", "2px solid red");
            }
            return ret;
        }

        $(".profileInfo").on("click",function () {
            $(this).css("border", "1px solid #ccc")
        });

        $('#profileUpdate').on("submit",function (e) {
            e.preventDefault();
            if(responce!=null || responce!='') {

                if(!profileFormValidation()){
                    return;
                }

                let firstName=$("#firstName").val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
                let lastName=$("#lastName").val().replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
                let form = new FormData();
                form.append("firstName",firstName);
                form.append("lastName",lastName);
                form.append("userType",1);

                if(ID_BASED){
                    form.append("userId",userId);
                }
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo base_url('imuser/edit/'); ?>",
                    "method": "POST",
                    "headers": {
                        "authorization": "Basic YWRtaW46MTIzNA==",
                        "x-auth-token": String(responce),
                        "cache-control": "no-cache",
                        
                    },
                    "processData": false,
                    "contentType": false,
                    "mimeType": "multipart/form-data",
                    "data": form,
                    "statusCode": {
                        404: function(error) {
                            var msg=JSON.parse(error.responseText);
                            toastr.error(" "+msg.stauts.message);
                        },
                        401: function(error) {
                            location.href="<?php echo base_url('imuserview/logout') ?>"
                        }
                    }
                };


                $.ajax(settings).done(function (response) {
                    var data=JSON.parse(response);

                    if(data.status.code == 200 && data.status.message=="Success") {
                        $('#firstName').val(data.response.firstName);
                        $('#lastName').val(data.response.lastName);
                        $('#userEmail').val(data.response.userEmail);
                        if(data.type=="token"){
                            localStorage.setItem("_r",data.token);
                        }
                        else{
                            localStorage.setItem("_r",JSON.stringify(data.token));
                        }

                        localStorage.setItem("T",data.type);
                        toastr.info("Profile Update Successful");

                    }
                    else{

                        toastr.error("Profile Update Unsuccessful");

                    }
                }).fail(function () {

                    toastr.error("Connection !ERROR");

                });
            }
        });

        $("#profileImageFile").change(function (event) {
            var file = this.files[0];
            var imagefile = file.type;
            let size=file.size;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(size>5242880){
                toastr.error("Max limit 5Mb exceeded");
                return false ;
            }
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                toastr.error("Please Select A Valid Image File");
                return false;
            }

            else
            {
                if(responce!=null || responce!='') {

                    var form = new FormData();
                    form.append("file",file);
                    if(ID_BASED){
                        form.append("userId",userId);
                    }
                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "<?php echo base_url('/imuser/profilePictureUpload/'); ?>",
                        "method": "POST",
                        "headers": {
                            "authorization": "Basic YWRtaW46MTIzNA==",
                            "x-auth-token": String(responce),
                            "cache-control": "no-cache",
                            
                        },
                        "processData": false,
                        "contentType": false,
                        "mimeType": "multipart/form-data",
                        "data": form
                    };

                    $.ajax(settings).done(function (response) {
                        var data=JSON.parse(response);
                        if(data.type=="token"){
                            localStorage.setItem("_r",data.token);
                        }
                        else{
                            localStorage.setItem("_r",JSON.stringify(data.token));
                        }

                        localStorage.setItem("T",data.type);
                        $("#editProfileImage").fadeIn("fast").attr("src", data.response);
                    });

                }
            }

        });
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