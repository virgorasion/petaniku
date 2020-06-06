<?php

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Admin options</h1>
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
            <div class="col-sm-4"><strong>Admin List</strong></div>
            <div class="col-sm-8">
                <div class="col-sm-12">
                    <div class="form-group pull-left">
                        <input id="emailSearch" type="search" class="input-sm form-control-sm form-control col-sm-10 " placeholder="Email or first name" aria-controls="sample_1" >
                    </div>
                    <button type="button" id="searchEmailBtn" class="btn btn-sm btn-primary col-sm-2 "> Search </button>
                    <button id="clearBtn" type="button" class="btn btn-sm btn-secondary col-sm-2 "> All </button>
                    <button id="newAdminModal" type="button" class="btn btn-success btn-sm ml-3">
                      <i class="fa fa-plus"></i> Add new
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow: auto;">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th> Action </th>
                </tr>
                </thead>
                <tbody>

                <?php for ($i=0,$j=1;$i<count($userList); $i++,$j++){ ?>
                    <tr>
                        <td><?php echo $j?></td>
                        <td> <?php echo $userList[$i]["firstName"]?> </td>
                        <td> <?php echo $userList[$i]["userEmail"]?> </td>
                        <td> <?php if((int)$userList[$i]["adminType"]==0||(int)$userList[$i]["adminType"]==2) {echo "super user";} else {echo "Manager";} ?> </td>
                        <td>
                            <button type="button"  data-type="<?php echo (int)$userList[$i]["adminType"] ?>" data-user="<?php echo $userList[$i]["userId"]?>" class="btn btn-primary btn-sm AdminInfo">Update info</button>
                            <?php if((int)$userList[$i]["adminType"]!=2){ ?>
                                <button type="button" data-name="<?php echo $userList[$i]["firstName"]?>" data-user="<?php echo $userList[$i]["userId"]?>" class="btn btn-danger btn-sm deleteAdmin">Delete admin</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                <?php if($links!=null || $links!=""){ ?>
                    <tr>
                        <td colspan="6" align="right">
                            <ul class="pagination pagination-sm">
                                <?php echo $links;?>
                            </ul>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>
<!-- END CONTAINER -->
<div id="newAdmin" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
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
                                <form id="newAdminForm" role="form" autocomplete="off">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Admin name" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="email" class="form-control " id="userEmail" name="userEmail" placeholder="Admin email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="password" class="form-control " id="userPass" name="userPass" placeholder="Password" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-md-radios ">
                                        <label>Select role</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="radio6" name="userType" value="0" class="md-radiobtn" required>
                                                <label for="radio6">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Super user</label>
                                            </div>

                                            <div class="md-radio">
                                                <input type="radio" id="radio8" name="userType" value="1" class="md-radiobtn" required>
                                                <label for="radio8">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Manager </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hidden" id="superUser">
                                        <p>Super user can create new admin. Can change any admins password. He has all the authority.</p>
                                    </div>
                                    <div class="col-md-12 hidden" id="manager">
                                        <p>Manager user can't create new admin. Can't change any admins password.
                                            Can access and mange all the other items.
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 300px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
            <div class="modal-footer">
                <div class="form-actions noborder">
                    <button id="newAdminSubmit" type="button" class="btn btn-success my-btn-color">Submit</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="updateAdmin" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
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
                                <form id="updateAdminForm" role="form" autocomplete="off">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="updateUserName" name="userName" placeholder="Admin name" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="email" class="form-control " id="updateUserEmail" name="userEmail" placeholder="Admin email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="password" class="form-control " id="updateUserPass" placeholder="Password" autocomplete="off" name="userPass" >
                                    </div>
                                    <div class="form-group form-md-radios " id="updateAdminRadio">
                                        <label>Select role</label>
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="superRadio" name="updateUserType" value="0" class="md-radiobtn" required>
                                                <label for="superRadio">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Super user</label>
                                            </div>

                                            <div class="md-radio">
                                                <input type="radio" id="managerRadio" name="updateUserType" value="1" class="md-radiobtn">
                                                <label for="managerRadio">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Manager </label>
                                            </div>
                                            <div class="md-radio hidden">
                                                <input type="radio" id="supersuperAdmin" name="supersuperAdmin" value="2" class="md-radiobtn">
                                                <label for="supersuperAdmin">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Super Super Admin </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="userId" id="updateAdminId">
                                    <div class="col-md-12 hidden" id="infosuperUser">
                                        <p>Super user can create new admin. Can change any admins password. He has all the authority</p>
                                    </div>
                                    <div class="col-md-12 hidden" id="infomanager">
                                        <p>Manager user can't create new admin. Can't change any admins password.
                                            Can access and mange all the other items.
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 300px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
            <div class="modal-footer">
                <div class="form-actions noborder">
                    <button id="updateAdminSubmit" type="button" class="btn btn-success my-btn-color">Save</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="deleteAdmin" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;"><div class="scroller" style="height: auto; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                        <div class="row">
                            <div class="col-md-12">
                                <p> Are you sure want to remove <strong><span class="deleteAdminName"> </span></strong>?</p>
                                <input type="hidden" id="deleteAdminId">
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 300px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </div>
            <div class="modal-footer">
                <div class="form-actions noborder">
                    <button id="deleteAdminSubmit" type="button" class="btn btn-danger">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#settingsTab').trigger('click');
        $('#adminSettings').addClass('active open');
        $('#newAdminModal').on('click',function () {
            $('#newAdmin').modal('show');
        });

        $('#radio6').on('change',function () {
            if ($(this).is(':checked')) {
                $('#superUser').removeClass('hidden');
                if(!$('#manager').hasClass('hidden')){
                    $('#manager').addClass('hidden');
                }
            }

            });
        $('#radio8').on('change',function () {
            if ($(this).is(':checked')) {
                $('#manager').removeClass('hidden');
                if(!$('#superUser').hasClass('hidden')){
                    $('#superUser').addClass('hidden');
                }
            }
        });

        $('#newAdminSubmit').on('click',function () {
            $('#newAdminForm').trigger('submit');
        });
        var form1 = $('#newAdminForm');
        var form2 = $('#updateAdminForm');
        var error1 = $('.alert-danger', form1);
        var error2 = $('.alert-danger', form2);
        var success1 = $('.alert-success', form1);
        var success2 = $('.alert-success', form2);
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                userName:{
                    required:'New admin name'
                },
                userEmail:{
                    required:'Login Email Address',
                    email: true
                },
                userPass:{
                    required:'Login password'
                }
            },
            rules: {
                userName: {
                    minlength: 2,
                    required: true
                },
                userEmail: {
                    email: true,
                    required: true
                },
                userPass: {
                    required: true,
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                //App.scrollTo(error1, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },

            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                success1.show();
                error1.hide();
            }
        });
        form2.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                userName:{
                    required:'New admin name'
                },
                userEmail:{
                    required:'Login Email Address',
                    email: true
                }
            },
            rules: {
                userName: {
                    minlength: 2,
                    required: true
                },
                userEmail: {
                    email: true,
                    required: true
                }

            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success2.hide();
                error2.show();
                //App.scrollTo(error2, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },

            highlight: function (element) { // hightlight error inputs

                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                success2.show();
                error2.hide();
            }
        });
       // validator.form();
        var t=localStorage.getItem('_r');

        $('#searchEmailBtn').on('click',function (e) {
            var email=$('#emailSearch').val();
            location.href="<?php echo base_url('imadmin/adminSettings').'?search='?>"+email;
        });
        $('#clearBtn').on('click',function () {
            location.href="<?php echo base_url('imadmin/adminSettings')?>";
        });
        $('#newAdminForm').on('submit',function (e) {
            e.preventDefault();
           if($(this).valid()) {
               var form=new FormData($(this)[0]);
               var settings = {
                   "async": true,
                   "crossDomain": true,
                   "url": "<?php echo base_url('imadminApi/createAdmin') ?>",
                   "method": "POST",
                   "headers": {
                       "authorization": "Basic YWRtaW46MTIzNA==",
                       "x-auth-token": String(t),
                       "cache-control": "no-cache",

                   },
                   "processData": false,
                   "contentType": false,
                   "mimeType": "multipart/form-data",
                   "data": form,
                   "statusCode": {
                       404:function (e) {
                           var msg = JSON.parse(e.responseText);

                           toastr.error(msg.response);

                       },
                       406:function (e) {
                           var msg = JSON.parse(e.responseText);

                           toastr.error(msg.response);

                       },
                       400:function (e) {
                           var msg = JSON.parse(e.responseText);

                           toastr.error(msg.response);

                       },
                       409:function (e) {

                           var msg = JSON.parse(e.responseText);

                           toastr.error(msg.response);

                       }
                   }
               };

               $.ajax(settings).done(function (response) {
                   toastr.success("Admin created successfully");

                   setTimeout(function () {
                       location.reload();
                   },500);
               });
           }


        });

        $('.AdminInfo').on("click",function () {
           var userId=$(this).data("user");
            $('#updateAdminId').val(userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/getAdminById').'?userId=' ?>"+userId,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "statusCode": {
                    404:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    406:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    400:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    409:function (e) {

                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);
                    }
                }
            };
            $.ajax(settings).done(function (response) {
                var data=response.response;
                if(data!=null){
                    $('#updateUserName').val(data.firstName);
                    $('#updateUserEmail').val(data.userEmail);
                    $('#updateUserPass').val("");

                    if(data.adminType==2){
                        $('#updateAdminRadio').addClass('hidden');
                        $('#supersuperAdmin').prop('checked',true);
                    }
                   else if(data.adminType==0){
                        if($('#updateAdminRadio').hasClass('hidden')){
                            $('#updateAdminRadio').removeClass('hidden');
                        }
                        $('#supersuperAdmin').prop('checked',false);
                        $('#superRadio').prop('checked',true);
                    }else{

                        if($('#updateAdminRadio').hasClass('hidden')){
                            $('#updateAdminRadio').removeClass('hidden');
                        }
                        $('#supersuperAdmin').prop('checked',false);
                        $('#managerRadio').prop('checked',true);
                    }
                }
               $('#updateAdmin').modal('show');
            });
        });


        $('#updateAdminSubmit').on("click",function () {
            <?php if(isset($demo) && $demo==true){ ?>
                toastr.error("Update is deactivated on demo.");
                return;
            <?php } ?>
            $('#updateAdminForm').trigger("submit");
        });

        $('#updateAdminForm').on('submit',function (e) {
            e.preventDefault();
            var validForm=false;
            if($("#supersuperAdmin").is(':checked')){
                validForm=true;
            }else{
                validForm=$(this).valid();
            }


            if(validForm) {
                var form = new FormData($(this)[0]);
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo base_url('adminApi/updateAdmin') ?>",
                    "method": "POST",
                    "headers": {
                        "authorization": "Basic YWRtaW46MTIzNA==",
                        "x-auth-token": String(t),
                        "cache-control": "no-cache",

                    },
                    "processData": false,
                    "contentType": false,
                    "mimeType": "multipart/form-data",
                    "data": form,
                    "statusCode": {
                        404:function (e) {
                            var msg = JSON.parse(e.responseText);

                            toastr.error(msg.response);

                        },
                        406:function (e) {
                            var msg = JSON.parse(e.responseText);

                            toastr.error(msg.response);

                        },
                        400:function (e) {
                            var msg = JSON.parse(e.responseText);

                            toastr.error(msg.response);

                        },
                        409:function (e) {

                            var msg = JSON.parse(e.responseText);

                            toastr.error(msg.response);
                            console.log(msg.response);
                        }
                    }
                };
                $.ajax(settings).done(function (response) {
                    toastr.success("Information update successful");

                    setTimeout(function () {
                        location.reload();
                    },500);
                });
            }

        });
        $('.deleteAdmin').on('click',function () {
           var userId=$(this).data("user");
            var userName=$(this).data("name");
            $('#deleteAdminId').val(userId);
            $('.deleteAdminName').html(userName);
            $('#deleteAdmin').modal('show');
        });

        $('#deleteAdminSubmit').on('click',function () {
            var userId=$('#deleteAdminId').val();
            console.log(userId);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('adminApi/deleteAdmin').'?adminId=' ?>"+userId,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(t),
                    "cache-control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "statusCode": {
                    404:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    406:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    400:function (e) {
                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);

                    },
                    409:function (e) {

                        var msg = JSON.parse(e.responseText);

                        toastr.error(msg.response);
                    }
                }
            };
            $.ajax(settings).done(function (response) {
                toastr.success("Admin removed successfully");

                setTimeout(function () {
                    location.reload();
                },500);
            });
        })
    });
</script>