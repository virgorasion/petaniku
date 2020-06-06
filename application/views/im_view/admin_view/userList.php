<?php

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>All user information</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">User</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="content mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-7"><strong>User List</strong></div>
                        <div class="col-sm-5">
                            <div class="col-sm-12">
                                <div class="form-group pull-left">
                                    <input id="emailSearch" type="search" class="input-sm form-control-sm form-control col-sm-10 " placeholder="Email or first name" aria-controls="sample_1" >
                                </div>
                                <button type="button" id="searchEmailBtn" class="btn btn-sm btn-primary col-sm-2 "> Search </button>
                                <button id="clearBtn" type="button" class="btn btn-sm btn-secondary col-sm-2 "> All </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                    <table id="userListTable" class="table table-light table-bordered">
                        <thead>
                        <tr class="uppercase">
                            <th> Profile Picture</th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Email </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($userList!=null && count($userList)>0){ ?>
                    <?php foreach ($userList as $user){ ?>
                        <tr id="user_<?php echo $user['userId']?>">
                            <td> <img src="<?php echo $user['profilePictureUrl']?>" style="width: 25px;"> </td>
                            <td> <?php echo $user['firstName']?> </td>
                            <td> <?php echo $user['lastName']?> </td>
                            <td> <?php echo $user['userEmail']?> </td>
                            <?php if($user['userStatus']==1 && $user['userVerification']==1){ ?>
                            <td id="status_<?php echo $user['userId']?>">
                                <span  class="badge badge-success"> Activate </span>
                            </td>
                            <?php }else if($user['userStatus']==0 && $user['userVerification']==1){ ?>
                                <td id="status_<?php echo $user['userId']?>">
                                    <span  class="badge badge-danger"> Deactivate </span>
                                </td>
                            <?php } else if($user['userStatus']==2 && $user['userVerification']==0){?>
                                <td id="status_<?php echo $user['userId']?>">
                                    <span class="badge badge-info"> Verification pending </span>
                                </td>
                            <?php } else if($user['userStatus']==0 && $user['userVerification']==0){?>
                            <td id="status_<?php echo $user['userId']?>">
                                <span class="badge badge-danger"> Deactivate </span>
                            </td>
                            <?php } else if($user['userStatus']==5 && $user['userVerification']==0){?>
                            <td id="status_<?php echo $user['userId']?>">
                                <span class="badge badge-warning"> Invited </span>
                            </td>
                            <?php } ?>
                            <td>
                                <button id="userInfoBTN_<?php echo $user['userId']?>" type="button" data-status="<?php echo $user['userStatus'];?>" data-varification="<?php echo $user['userVerification']?>" data-user="<?php echo $user['userId']?>" class="btn btn-primary btn-sm userInfo">View info</button>
                            </td>

                        </tr>
                        <?php } ?>
                    <?php if($links!=null || $links!=""){ ?>
                        <tr>
                            <td colspan="6" align="right"  >
                                <ul class="pagination pagination-sm" style="display: inline-flex;">
                                    <?php echo $links;?>
                                </ul>

                            </td>
                        </tr>
                    <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
</div>


</div>
<!-- END CONTAINER -->
<div id="userInfoModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;"><div class="scroller" style="height: auto; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                        <div class="row">
                            <div class="col-md-12">
                               <div class="text-center">
                                   <img class="userImg" src="" style="width: 130px">
                               </div>
                                <div style="padding-top: 5px">
                                <table border="0" align="center" width="90%">
                                    <tbody>
                                    <tr>
                                        <td style="text-align: left;padding: 5px;border-bottom: 0.5px solid #EFEFEF">Name:</td>
                                        <td style="text-align: left;padding: 5px;border-bottom: 0.5px solid #EFEFEF"> <span class="userName"></span></td>
                                    </tr>
                                    <tr><td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF">Email:</td>
                                        <td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF"><span class="userEmail"></span></td>
                                    </tr>
                                    <tr><td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF">Total Groups:</td>
                                        <td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF"><span class="usergroups"></span></td>
                                    </tr>
                                    <tr><td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF">Last Profile Update</td>
                                        <td style="text-align: left;padding: 5px;border-bottom: 1px solid #EFEFEF"><span class="userupdate"></span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 300px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    ( function ( $ ) {
        "use strict";

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-bottom-left",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        /*$('#babyList').DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false,
            "pageLength": 10
        } );*/

         function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName;

            for (var i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        var queryEmail=getUrlParameter('email');
        if(queryEmail!=null){
            $('#emailSearch').val(queryEmail);
        }
        var t=localStorage.getItem('_r');
        //$('#userTab').addClass('open');
        $('#userTab').addClass('active open');
        //$('#userList').addClass('active open');


        $('#searchEmailBtn').on('click',function (e) {
            var email=$('#emailSearch').val();
            location.href="<?php echo base_url('imadmin/user').'?search='?>"+email;
        });
        $('#clearBtn').on('click',function () {
            location.href="<?php echo base_url('imadmin/user')?>";
        });
    var currentUserInfo=null;
        var babylistTable=null;
        $('.userInfo').on('click',function () {
            var userStatus=$(this).data('status');
            var verification=$(this).data('varification');
            var userId=parseInt($(this).data('user'));
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/getUserById').'?userId=' ?>"+userId,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                }
            };
            $.ajax(settings).done(function (response) {
                var strVar="";
            <?php if(isset($demo) && $demo==true){ ?>

            if(userId==4|| userId==5 || userId==6) {
                if (userStatus == 1 && verification == 1) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-danger blockUserBtn\" disabled>Deactivate User<\/button>";
                } else if (userStatus == 2 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-primary verifyUserBtn\">Verify user<\/button>";
                } else if (userStatus == 0 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-success unblockUserBtn\" disabled>Activate User<\/button>";
                } else {
                    strVar += "                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-info\">Close<\/button>";
                }
            }else{
                if (userStatus == 1 && verification == 1) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-danger blockUserBtn\" >Deactivate User<\/button>";
                } else if (userStatus == 2 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-primary verifyUserBtn\">Verify user<\/button>";
                } else if (userStatus == 0 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-success unblockUserBtn\" >Activate User<\/button>";
                } else {
                    strVar += "                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-info\">Close<\/button>";
                }
            }
            <?php }else{?>
                if (userStatus == 1 && verification == 1) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-danger blockUserBtn\" >Deactivate User<\/button>";
                } else if (userStatus == 2 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-primary verifyUserBtn\">Verify user<\/button>";
                } else if (userStatus == 0 && verification == 0) {
                    strVar += "                <button data-id=" + userId + " type=\"button\" class=\"btn btn-success unblockUserBtn\" >Activate User<\/button>";
                } else {
                    strVar += "                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-info\">Close<\/button>";
                }
            <?php }?>
            $('#userInfoModal').find('.modal-footer').html(strVar);
                $('#userInfoModal').find('.userImg').attr('src',response.response.profilePictureUrl);
                $('#userInfoModal').find('.userName').html("<strong>"+response.response.firstName+" "+response.response.lastName+"</strong>");
                $('#userInfoModal').find('.userEmail').html("<strong>"+response.response.userEmail+"</strong>");
                currentUserInfo=$('.userInfo');

                $('.userupdate').html("<strong>"+response.response.userUpdate+"</strong>");
                $('.usergroups').html("<strong>"+response.response.totalGroups+"</strong>");


                $('#userInfoModal').modal('show');
            });
        });

        $('#userInfoModal').on('click','.blockUserBtn',function (e) {
            var userId=$(this).data('id');
            <?php if(isset($demo) && $demo==true){ ?>
            if(userId==4 || userId==5 || userId==6) {
                return;
            }
            <?php } ?>

            var form = new FormData();
            form.append("userId", userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/blockUser')?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                },
                "error":function (e) {
                    toastr.error("Invalid User Id");
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };
            $.ajax(settings).done(function (response) {
                $('#userInfoModal').modal('hide');
                $('#status_'+userId).html('<span class="badge badge-danger"> Deactivate </span>');
                $('#userInfoBTN_'+userId).data('status',0);
                $('#userInfoBTN_'+userId).data('varification',0);
                currentUserInfo=null;
                toastr.success('User Deactivated successfully');
            });
        });

        $('#userInfoModal').on('click','.verifyUserBtn',function (e) {
            var userId=$(this).data('id');
            var form = new FormData();
            form.append("userId", userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/verifyUser')?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                },
                "error":function (e) {
                    toastr.error("Invalid User Id");
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };
            $.ajax(settings).done(function (response) {
                $('#userInfoModal').modal('hide');
                $('#status_'+userId).html('<span  class="badge badge-success"> Activate </span>');
                $('#userInfoBTN_'+userId).data('status',1);
                $('#userInfoBTN_'+userId).data('varification',1);
                currentUserInfo=null;
                toastr.success('User verified successfully');
            });
        });

        $('#userInfoModal').on('click','.unblockUserBtn',function (e) {
            var userId=$(this).data('id');
            var form = new FormData();
            form.append("userId", userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/unblockUser')?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                },
                "error":function (e) {
                    toastr.error("Invalid User Id");
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            };
            $.ajax(settings).done(function (response) {
                $('#userInfoModal').modal('hide');
                $('#status_'+userId).html('<span  class="badge badge-success"> Activate </span>');
                $('#userInfoBTN_'+userId).data('status',1);
                $('#userInfoBTN_'+userId).data('varification',1);
                currentUserInfo=null;
                toastr.success('User activated successfully');
            });
        });
    } )( jQuery );
</script>

</body>
</html>