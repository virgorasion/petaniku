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



    <div class="middleSection col-xl-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
        <div class="chat-search col-md-12 groupNameDiv" style="text-align: left; padding-bottom: 21px;">
            <div class="col-md-1 col-xl-1 col-sm-1 col-xs-1" style="text-align: left;cursor: pointer;">
                <a href="<?php echo base_url('immobile/im') ?>" style="color: #75aef3"> <i class="fa fa-arrow-left"></i> </a>
            </div>
            <div class="col-md-7 col-xl-7 col-xs-7 col-sm-7 text-center">
                <div style="font-size: 14px;font-weight: bold"><span class="UserNames group-name group-name-style " id="UserNames" ></span></div>
            </div>
            <div id="searchMessage" title="Refresh" class="col-md-2 col-sm-2 col-xs-2"  style="text-align: right;cursor: pointer;color: #75aef3;">
                <i class="fa fa-search"></i>
            </div>
            <div id="searchDone" class="col-md-2 col-sm-2 col-xs-2 bold hidden" title="Close Search" style="text-align: right;cursor: pointer;color: #75aef3">
                Done
            </div>
            <div id="showGroupInfo" class="col-md-1 col-xl-1 col-sm-1 col-xs-1" style="text-align: right;cursor: pointer;color: #75aef3">
                <i class="fa fa-info-circle"></i>
            </div>
        </div>

        <div class="chat col-md-12 col-xl-12 col-sm-12 col-xs-12 " style="overflow: scroll;overflow-x: hidden;" id="chatBox" ></div>
        <div class="chat col-md-12 col-xl-12 col-sm-12 col-xs-12 hidden" style="overflow: scroll;overflow-x: hidden;" id="searchChatBox" ></div>

        <form id="messageForm">
            <div class="form-group col-md-10 col-xl-10 col-sm-10 col-xs-8 " style="padding-top: 5px;padding-right: 5px" >
                <textarea style="max-height: 50px; border: 0"  id="message" type="text" name="message" class="form-control" placeholder="Your message....."></textarea>
            </div>
            <div class="form-group col-md-2 col-xl-2 col-sm-2 col-xs-4 pad-1" style="margin-top: 10px">
                <img title="Send File/Audio" src="<?php echo base_url('assets/im/img/fileAttach.png')?>" id="fileIV1" style="float:left;cursor: pointer; width: 25px;height: 22px;margin-left: 0px;">
                <img title="Send Picture/Video" src="<?php echo base_url('assets/im/img/cam.png')?>" id="fileIV" style="float:left;cursor: pointer; width: 25px;height: 25px;margin-left: 10px;">
                <input type="file" class="hidden" id="messageFile1" name="documents" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.txt,.text,.mp3,.mp4,.wma,.rar,.zip">
                <input type="file" class="hidden" id="messageFile" name="pictureVideo" accept=".3gpp,.mp4,.3gp,.png,.jpeg,.jpg">
                <!--<i id="sendMessage" class="fa fa-send fa-2x pad-5" style="color: #82d6d5;cursor: pointer; margin-left: 10px;width: 25px;height: 25px"></i>-->
                <img title="Send Message" src="<?php echo base_url('assets/im/img/pp.png')?>" id="sendMessage" style="cursor: pointer; margin-left: 10px;width: 25px;height: 25px">
            </div>
        </form>
        <div class="col-md-12 col-xl-12 col-sm-12 col-xs-12 text-center pad-20 hidden" id="blockmessage" >You cannot reply to this conversation.</div>
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
                            <img src="<?php /*echo base_url('assets/im/img/i-camera.png')*/?>" id="newMessagefileIV"  style="float:left;cursor: pointer; width: 50px;height: 50px">
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

<div id="messageSearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog" style="margin-top: 0 !important;">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" id="searchModalCloseBtn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 class="modal-title myUpdateModalLabel" style="background-color: #75aef3">Search In Conversation </h4>
                <div class="modal-body" >
                    <p><strong>Search a message</strong></p>
                    <div class="form-group">
                        <input type="text" id="searchMessageText" class="form-control" placeholder="Message..." required="required">

                    </div>
                    <div class="modal-footer" id="searchModalFooter" style="background-color: white">
                        <button type="button" class="btn btn-small btn-round btn-skin-green"  data-toggle="modal" id="searchMessageBtn">Search</button>
                        <div class="chat col-md-12 col-xl-12 col-sm-12 col-xs-12 hidden" style="border:none;overflow: scroll;overflow-x: hidden;padding-top: 10px; " id="searchResultBox" >

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>