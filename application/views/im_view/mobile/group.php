<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 3/9/2018
 * Time: 11:11 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="page-contents">

    <div class="leftSection col-xl-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
         <div class="chat-search col-md-12" id="convStart"  style="">
                <div class=" col-md-2 col-sm-2 col-xs-2" id="unreadMessage" title="Unread Messages">
                    <div class="col-md-12" style="padding: 0;font-size: 25px;font-weight: bold"><span class="" style="padding: 0;cursor: pointer;"><i class="ico-pending-message" style="color: #388ded" ></i></span></div>
                </div>
                <div class=" col-md-8 col-sm-8 col-xs-8" id="">
                    <div class="col-md-12" style="padding: 0;font-size: 18px;font-weight: bold"><span class="" style="padding: 0;"></span>Messenger</div>
                </div>
                <div class=" col-md-2 col-sm-2 col-xs-2" id="newMessage" title="New Message">
                   <div class="col-md-12" style="padding: 0;font-size: 25px;font-weight: bold"><span class="" style="padding: 0;cursor: pointer;"><i class="ico-new-message" style="color: #388ded" ></i></span></div>
                </div>
            </div>
        <div style="float:left; width: 100%"  id="groupDiv">
            <ul class="persons" id="groups" >

            </ul>
        </div>
    </div>


</section>
<!-- Modals -->
<div id="addNewMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 class="modal-title myUpdateModalLabel" style="background-color: #75aef3">Add new member </h4>

                <div class="modal-body" >
                    <p><strong>Search members by there name</strong></p>
                    <div class="form-group">
                        <input type="text" id="addNewMemberInput" multiple class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-small btn-round btn-skin-green"  data-toggle="modal" id="newMemberAddBtn">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="changeNameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 class="modal-title myUpdateModalLabel" style="background-color: #75aef3">Change name </h4>
                <div class="modal-body" >
                    <p><strong>Give a new name</strong></p>
                    <div class="form-group">
                        <input type="text" id="groupName" class="form-control" placeholder="Group Name" required="required">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-small btn-round btn-skin-green"  data-toggle="modal" id="changeNameBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="newMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 6px;">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 id="myModalLabel" class="modal-title" style="background-color: #75aef3">Start a new conversation</h4>
                <div class="modal-body " id="newMModalBody" style="margin-bottom: 110px">
                    <form id="newMessageForm" role="form">
                        <div class="form-group m-bottom-20">
                            <input type="text" id="addMemberInput" multiple class="form-control" >
                        </div>
                        <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12 m-bottom-20" style="padding-top: 5px;padding-right: 5px; height: 90px" >
                            <textarea style="max-height: 100px; height: 90px border: 0"  id="newMessageText" type="text" name="message" class="form-control" placeholder="Your message....."></textarea>
                        </div>
                        <!--<div class="form-group col-md-2 col-xl-2 col-sm-2 col-xs-2 pad-1 m-bottom-20 " style="margin-top: 10px;">
                            <img src="<?php /*echo base_url('assets/img/i-camera.png')*/?>" id="newMessagefileIV"  style="float:left;cursor: pointer; width: 50px;height: 50px">
                            <input type="file" class="hidden" id="newMessageFile" name="file" accept="video/3gpp,video/mp4,video/3gp,image/x-png,image/jpeg">
                        </div>-->

                    </form>
                </div>
                <div class="modal-footer" style="background-color: white;">
                    <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <a href="#" class="btn-primary btn-small btn-rounded btn-skin-green col-md-12 col-xl-12 col-sm-12 col-xs-12" id="newSendMessage"><i class="fa fa-envelope"></i>  Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="connectionErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 6px;">
                <!--<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>-->
                <h4 id="myModalLabel" class="modal-title" style="background-color: #bc0200">Connection lost</h4>
                <div class="modal-body " >
                    <p>Connecting...</p>
                </div>
                <!--<div class="modal-footer" style="background-color: white;">
                    <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <a href="#" class="btn-primary btn-small btn-rounded btn-skin-green col-md-12 col-xl-12 col-sm-12 col-xs-12" id="newSendMessage"><i class="fa fa-envelope"></i>  Send</a>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>

