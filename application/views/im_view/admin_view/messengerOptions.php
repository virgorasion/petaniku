<?php

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Messenger options</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Options</li>
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
                                <button type="button" data-status="<?php echo $user['userStatus'];?>" data-varification="<?php echo $user['userVerification']?>" data-user="<?php echo $user['userId']?>" class="btn btn-primary btn-sm userInfo">View Messages</button>
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


<script type="text/javascript">

    jQuery(document).ready(function ($) {
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

        var getUrlParameter = function getUrlParameter(sParam) {
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
        $('#messengerTab').addClass('active open');
        //$('#userList').addClass('active open');


        $('#searchEmailBtn').on('click',function (e) {
            var email=$('#emailSearch').val();
            location.href="<?php echo base_url('imadmin/messengerOptions').'?search='?>"+email;
        });
        $('#clearBtn').on('click',function () {
            location.href="<?php echo base_url('imadmin/messengerOptions')?>";
        });
    var currentUserInfo=null;

        $('.userInfo').on('click',function () {
            var userId=$(this).data('user');
            window.open("<?php echo base_url('imadmin/messenger/')?>"+userId,"_blank");
        });

        $('#userInfoModal').on('click','.blockUserBtn',function (e) {
            var userId=$(this).data('id');
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
                $('#status_'+userId).html('<span class="label label-sm label-danger"> Deactivate </span>');
                currentUserInfo.data('status',0);
                currentUserInfo.data('varification',0);
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
                $('#status_'+userId).html('<span  class="label label-sm label-success"> Activate </span>');
                currentUserInfo.data('status',1);
                currentUserInfo.data('varification',1);
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
                $('#status_'+userId).html('<span  class="label label-sm label-success"> Activate </span>');
                currentUserInfo.data('status',1);
                currentUserInfo.data('varification',1);
                currentUserInfo=null;
                toastr.success('User activated successfully');
            });
        });
    });
</script>

</body>
</html>