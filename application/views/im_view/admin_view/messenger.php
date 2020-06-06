<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="page-contents">

        <div class="leftSection col-xl-3 col-md-3 col-sm-12 col-xs-12" style="padding: 0;border-right: 1px solid rgba(0, 0, 0, .10)">
            <div class="chat-search col-md-12" id=""  style="">
                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="">
                   <div class="col-md-12" style="padding: 0;font-size: 25px;font-weight: bold"><span class="" style="padding: 0;sty"></span>Group List </div>
                </div>
            </div>
            <div style="float:left; width: 100%"  id="groupDiv">
                <ul class="persons" id="groups" >

                </ul>
            </div>
        </div>
        <div class="middleSection col-xl-6 col-md-6 col-sm-12 col-xs-12" style="padding: 0;">
           <div class="chat-search col-md-12 groupNameDiv" style="text-align: left; padding-bottom: 21px;">
               <div class="col-md-10 col-xl-10 col-xs-10 col-sm-10">
                    <h3 style="font-size: 18px;"><span class="UserNames"  style="display: inline-block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;width: 95%"></span></h3>
               </div>

           </div>


            <div class="chat col-md-12 col-xl-12 col-sm-12 col-xs-12" style="overflow: scroll;overflow-x: hidden;" id="chatBox" >


            </div>




        </div>

    <div class="rightSection col-xl-3 col-md-3 col-sm-12 col-xs-12 persons2 " style="padding: 0;border-left: 1px solid rgba(0, 0, 0, .10);border-top: 1px solid rgba(0, 0, 0, .10); text-overflow: ellipsis;overflow-x: hidden;overflow-y: hidden ">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center  person2 rightGroupImages" style="padding-top: 5px;display: flex;justify-content: center;"   >
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center pad-10" >
            <h4 class="be-use-name" style="text-transform: uppercase; overflow: hidden; text-overflow: ellipsis"></h4>
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center pad-2" style="padding-bottom: 5px" >
            <div class="preview be-user-info" style="font-size: 10px; padding-bottom:5px;border-bottom:1px solid rgba(0, 0, 0, .10) "></div>
        </div>
        <!--<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12  pad-5" style="cursor: pointer;" id="addMember" data-group="">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 " style="padding-right: 0;"><i class="fa fa-plus" style="color: #388ded; margin-right:10px;padding: 16px; width: 45px;height: 45px; border-radius: 50px; border: 1px solid #388ded"></i><strong>Add new member</strong></div>
        </div>-->
        <ul class="persons personsList" id="groupMembers" ></ul>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 hidden" id="attachment">
            <div class="sectionName text-center">Sheared Files</div>
            <ul class="attachment" id="attachmentList" >

            </ul>
        </div>
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 hidden" id="imageAttachment">
            <div class="sectionName text-center" >Sheared Images</div>
            <div class="row ol-lightbox-gallery" style="list-style: none;padding: 0;" id="ImageAttachmentList" >

            </div>
        </div>
    </div>


</section>
<!-- Modals -->


<script src="<?php echo base_url("assets/im/newTheme/assets/js/vendors/jquery.min.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/vendors/vendors.js") ?>"></script>
<!-- Local Revolution tools-->
<!-- Only for local and can be removed on server-->

<script src="<?php echo base_url("assets/im/newTheme/assets/js/custom.js") ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/jquery.playSound.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/toastr.min.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/anchorme.min.js") ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/magicsuggest.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/moment.min.js") ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/socket.io.js") ?>"></script>


<script src="<?php echo base_url("assets/im/newTheme/assets/js/jwt-decode.min.js") ?>"></script>

<script src="<?php echo base_url("assets/im/newTheme/assets/js/clamp.min.js") ?>"></script>

<script>
    var baseUrl="<?php echo base_url() ?>";
    function isUnicode(str) {
        let textareavalue = str; //Getting input value
        let arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
        let hebrew = /[\u0590-\u05FF]/g;
        let match = textareavalue.match(arabic) || textareavalue.match(hebrew);
        let spacesMatch = textareavalue.match(new RegExp(" ", 'g'));
        let allcount = textareavalue.length;
        let farsicount = match ? match.length : 0;
        let spacesCount = spacesMatch ? spacesMatch.length : 0;
        let Englishcount = allcount - farsicount - spacesCount;

        return farsicount > Englishcount;
    }
    (function ($) {
        $.fn.serializeFormJSON = function () {

            let o = {};
            let a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);
</script>

<script>
    let $buoop = {
        notify:{e:-1,f:-1,o:-1,s:-1,c:-1},
        insecure:true,
        api:5,
        text:"Your browser, {brow_name}, is too old for Chat manager: <a{up_but}>update</a>.",
        style: "top",
        container: document.body,
        jsshowurl: "//browser-update.org/update.show.min.js",
        l: false,
    };
    function $buo_f(){
        let e = document.createElement("script");
        e.src = "//browser-update.org/update.min.js";
        document.body.appendChild(e);
    };
    try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
    catch(e){window.attachEvent("onload", $buo_f)}
</script>

<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay_progress.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji-picker.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/mediaelement-and-player.min.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/perfect-scrollbar.jquery.min.js") ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji/2/twemoji.min.js") ?>"></script>

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
        $("body").css("overflow","hidden", "important");
        function trim(str)
        {
            return str.trim();
        }
        let t='<?php echo $_r ?>';
        let name=null;
        let pic=null;
        if(trim("<?php echo $T ?>")=="token"){
            name=jwt_decode(t).firstName;
            pic=jwt_decode(t).profilePicture;
        }else{
            t=JSON.parse(t);
            name=t.firstName;
            pic=t.profilePicture;
        }
        $("#userNameTop").html(name);
        $("#userImageTop").attr("src",pic);
        $(window).bind("resize",function () {

            //window.scrollTo(0,0);
            let viewHeight=$(window).height();
            let viewWidth=$(window).width();
            if(viewWidth>995){
                $("body").addClass("controlOverflow");
            }else if($("body").hasClass("controlOverflow")){
                $("body").removeClass("controlOverflow");
            }
            if(viewWidth<990){

                $('#convStart').css("height",61);
                $('.persons').css({"margin-top":0});
                $(".rightSection").css({'margin-top': '30px'});
                $(".groupNameDiv").css({"padding-bottom":'32px'});
                $('.video').css({'margin-left': '-34px'});

            }
            else {
                $(".rightSection").css({'margin-top': '0px'});
                $(".groupNameDiv").css({"padding-bottom":'21px'});
                $('.video').css({'margin-left': '0px'});
            }
            /*if(viewHeight<776){
             $("#newMModalBody").css("margin-bottom", "155px");
             }else {
             $("#newMModalBody").css("margin-bottom", "160px");
             }*/
            if(viewWidth<990){
                // $(".leftSection").css({"height":(viewHeight-95)});
                $(".middleSection").css({"height":(viewHeight-95)});
                $(".rightSection").css({"height":(viewHeight-95)});
            }
            else{
                //$(".leftSection").css({"height":590});
                //$(".middleSection").css({"height":590});
                $(".rightSection").css({"height":590});
                $("body").css({"height":590});
            }
            $(".chat").css({"height":(viewHeight-170)});
            $('#groups').css({"height":(viewHeight-100)});
            $(".rightSection").css({"height":(viewHeight-50)});
            //$('.personsList').css({"height":(viewHeight-250)});
        }).trigger("resize");

        /*
           --------Global variables
         */
        twemoji.base="<?php echo base_url("assets/im/newTheme/assets/js/twemoji/2/") ?>";
        let chatBox=$('#chatBox');
        let groupBox=$("#groups");
        let videoObjects=[];
        let responce='<?php echo $_r ?>';
        let userId=null;
        let type=1;
        let ID_BASED=false;
        if(trim("<?php echo $T ?>")=="token"){
            userId=jwt_decode(responce).userId;
            type=jwt_decode(responce).userType;
        }else{
            responce=JSON.parse(responce);
            userId=responce.userId;
            ID_BASED=true;
        }
        let start=0;
        let limit=30;
        let groupLimit=30;
        let groupStart=0;
        let totalGroup=null;
        let friendStart=0;
        let friendLimit=30;
        let totalFriend=null;
        let totalRetivedMessage=0;

        let groupIds=[];
        let time=[];
        let groupImages={};
        let groupType=null;
        let activegroupId=null;
        let scrollPosition=null;
        let notRequested=true;

        let typing = false;
        let typingTimeout = undefined;
        let lastMessageDate=null;
        let topMessage=null;
        let addexpendDropdown=null;
        let addMemberexpendDropdown=null;
        let membersId=[];

        let magicSuggestOption={
            placeholder: 'Search for members...',
            maxSelection:null,
            allowFreeEntries:false,
            // data: q,
            renderer: function(data){
                return '<div style="padding: 5px; overflow:hidden;">' +
                    '<div style="float: left;"><img style="width: 25px;height: 25px" src="' + data.picture + '" /></div>' +
                    '<div style="float: left; margin-left: 5px">' +
                    '<div style="font-weight: bold; color: #333; font-size: 12px; line-height: 11px">' + data.name + '</div>' +
                    '<div style="color: #999; font-size: 9px">' + data.email + '</div>' +
                    '</div>' +
                    '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
            }
        };
        let addmember=$('#addMemberInput').magicSuggest(magicSuggestOption);
        let newMemberInput=$('#addNewMemberInput').magicSuggest(magicSuggestOption);
        /*let momentOptions={
            sameDay: '[Today at] h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: '[Yesterday at] h:mm a',
            lastWeek: '[Last] dddd [at] h:mm a',
            sameElse: 'MMM DD, YYYY h:mm a'
        };*/
        let momentOptions={
            sameDay: '[Today at] h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: 'MMMM DD, YYYY h:mm a',
            lastWeek: 'MMMM DD, YYYY h:mm a',
            sameElse: 'MMMM DD, YYYY h:mm a'
        };
        let momentOptions2={
            sameDay: 'h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: '[Yesterday at] h:mm a',
            lastWeek: '[Last] dddd [at] h:mm a',
            sameElse: 'MMM DD, YYYY h:mm a'
        };
        // --------- Global Functions--------------

        function isUnicode(str) {
            let textareavalue = str; //Getting input value
            let arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
            let hebrew = /[\u0590-\u05FF]/g;
            let match = textareavalue.match(arabic) || textareavalue.match(hebrew);
            let spacesMatch = textareavalue.match(new RegExp(" ", 'g'));
            let allcount = textareavalue.length;
            let farsicount = match ? match.length : 0;
            let spacesCount = spacesMatch ? spacesMatch.length : 0;
            let Englishcount = allcount - farsicount - spacesCount;

            return farsicount > Englishcount;
        }

        function typingTimeoutFunction(){
            let groupId=$("#addMember").attr('data-group');
            let data={
                _r:token,
                groupId:groupId
            };
            typing = false;
            //socket.emit("notTyping",JSON.stringify(data));
        }
        function onKeyDownNotEnter(){
            let groupId=$("#addMember").attr('data-group');
            let data={
                _r:token,
                groupId:groupId
            };
            if(typing == false) {
                typing = true;
                //socket.emit("typing",JSON.stringify(data));
                typingTimeout = setTimeout(typingTimeoutFunction, 3000);
            } else {
                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(typingTimeoutFunction, 3000);
            }

        }
        // this function used to clear new message div
        function resetNewMessage () {
            $("#newMessageFile").replaceWith($("#newMessageFile").val('').clone(true));
            $('#newMessagefileIV').attr("src","<?php echo base_url('assets/im/img/i-camera.png')?>");

            $('.twemoji-textarea').html("");
            $('.twemoji-textarea-duplicate').html("");
            $('#newMessageText').text("");
            $('#newMessageText').val("");
            $('.close').trigger("click");

        }

        // this function used to clear message div
        function reset () {
            $("#messageFile").replaceWith($("#messageFile").val('').clone(true));
            $('#fileIV').attr("src","<?php echo base_url('assets/im/img/i-camera.png')?>");

            $("#messageFile1").replaceWith($("#messageFile1").val('').clone(true));
            $('#fileIV1').attr("src","<?php echo base_url('assets/im/img/fileAttach.png')?>");

            $('.twemoji-textarea').html("");
            $('.twemoji-textarea-duplicate').html("");
            $('#message').text("");
            $('#message').val("");

        }

        function initVideo(id, isme) {

            $("#" + id).mediaelementplayer({
                // Do not forget to put a final slash (/)
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                // this will allow the CDN to use Flash without restrictions
                // (by default, this is set as `sameDomain`)
                shimScriptAccess: 'always',

                success: function (player, node) {


                    $(player).closest('.mejs__container').find("div.mejs__overlay-button").css({"height": "110px"});
                    $(player).closest('.mejs__container').find("div.mejs__controls").css({"background": "#32cdc7"});
                    // $(player).closest('.mejs__container').find("div.mejs__controls").css({"background":"transparent"});
                    $(player).closest('.mejs__container').css({"background": "transparent"});

                    if (!isme) {
                        $(player).closest('.mejs__container').css({"margin-left": "auto"});
                    }

                }
            });


        }

        function initAudio(id, isme) {

            $("#" + id).mediaelementplayer({
                // Do not forget to put a final slash (/)
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                // this will allow the CDN to use Flash without restrictions
                // (by default, this is set as `sameDomain`)
                shimScriptAccess: 'always',
                success: function (player, node) {


                    $(player).closest('.mejs__container').find("div.mejs__controls").css({"border-radius": "50px"});
                    $(player).closest('.mejs__container').css({"background": "transparent"});
                    $(player).closest('.mejs__container').find("div.mejs__mediaelement").css({"border-radius": "50px"});
                    $(player).closest('.mejs__container').find("div.mejs__mediaelement").css({"background-color": "transparent"});
                    if (!isme) {
                        $(player).closest('.mejs__container').parent(".fw-im-attachments").css({"margin-left": "auto"});
                    }

                }
            });

        }
        // function for checking image/video type and size before uploading
        function imageChange(event) {
            let file = this.files[0];
            let imagefile = file.type;
            let size=file.size;
            let match= ["image/jpeg","image/png","image/jpg","video/3gpp","video/mp4","video/3gp","audio/mp3"];
            if(size>20971520){
                toastr.error("Max limit 20Mb exceeded");
                return ;
            }

            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) || (imagefile==match[5])||(imagefile==match[6])))
            {
                toastr.error("This type of file is not allowed");
                return false;
            }else {
                $('#sendMessage').trigger('click');
                /* let type=null;
                 let url=URL.createObjectURL(this.files[0]);
                 if((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])){
                 type=new Image();
                 type.src=url;
                 type.onload = function() {
                 captureImage(type);
                 };

                 }
                 else{
                 type = document.createElement('video');
                 let source = document.createElement('source');
                 source.setAttribute('src',url);
                 type.appendChild(source);
                 type.muted = true;
                 type.play();
                 setTimeout(function(){
                 type.pause(); // note the [0] to access the native element
                 captureImage(type);
                 }, 3000);

                 }*/

            }
        }

        function attachChange(event) {
            let file = this.files[0];
            let attachFile = file.type;
            let matched=false;
            let size=file.size;
            let match= ["application/pdf","application/msword","application/vnd.ms-excel","application/vnd.ms-powerpoint","text/csv","text/plain","application/zip","application/x-zip-compressed","audio/mp3","audio/x-ms-wma"];
            if(size>20971520){
                toastr.error("Max limit 20Mb exceeded");
                return false ;
            }

            for(let i=0;i<match.length;i++){
                if(attachFile===match[i]){
                    matched=true;
                }
            }
            if(matched){
                $('#sendMessage').trigger('click');
            }else{
                toastr.error("This type of file is not allowed");
                return false;
            }
            /*if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) || (imagefile==match[5])||(imagefile==match[6])))
            {
                toastr.error("This type of file is not allowed");
                return false;
            }else {
                $('#sendMessage').trigger('click');


            }*/
        }

        // function for checking image/video type and size before uploading
        function imageChangeNewMessage(event) {
            let file = this.files[0];
            let imagefile = file.type;
            let size=file.size;
            let match= ["image/jpeg","image/png","image/jpg","video/3gpp","video/mp4","video/3gp","audio/mp3"];
            if(size>20971520){
                toastr.error("Max limit 20Mb exceeded");
                return ;
            }

            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) || (imagefile==match[5]) || (imagefile==match[6])))
            {
                toastr.error("This type of file is not allowed");
                return false;
            }else {

                $('#newSendMessage').trigger('click');
                /*let type=null;
                 let url=URL.createObjectURL(this.files[0]);
                 if((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])){
                 type=new Image();
                 type.src=url;
                 type.onload = function() {
                 captureImagenewMessage(type);
                 };

                 }
                 else{
                 type = document.createElement('video');
                 let source = document.createElement('source');
                 source.setAttribute('src',url);
                 type.appendChild(source);
                 type.muted = true;
                 type.play();
                 setTimeout(function(){
                 type.pause(); // note the [0] to access the native element
                 captureImagenewMessage(type);
                 }, 3000);

                 }*/

            }
        }

        // Api pagination functions
        function increaseStart() {
            start+=limit;
        }
        function resetStart() {
            start=0;
        }
        function resetRetiveMessage(){
            totalRetivedMessage=0;
        }
        function increaseGroupLimit() {
            groupStart+=groupLimit
        }
        function resetFriendStart() {
            friendStart=0;
        }
        function increaseFriendsLimit() {
            friendStart+=friendLimit;
        }
        function addNewGroup(group) {
            let html="";
            groupIds.push(group.groupId);
            time[group.groupId]=group.lastActive;
            html += " <li class=\"person\" data-chat=\"person1\" id='group_"+group.groupId+"' data-type=\""+group.groupType+"\" data-group=\""+group.groupId+"\">";
            groupImages[group.groupId]=group.groupImage;
            html +='<span id="groupImage_'+group.groupId+'">';
            for (j=0;j<group.groupImage.length;j++){

                html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+group.groupImage[j]+"\" >";
            }
            html +='</span>';
            html += "                        <span class=\"name\" id='groupName_"+group.groupId+"' style=\"overflow: hidden\"><div>"+group.groupName+"</div><\/span>";
            let date=moment(group.lastActive,moment.ISO_8601).fromNow();

            html += "                        <span id='time_"+group.groupId+"' class=\"time\">"+date+"<\/span>";
            if(group.messageType==="text"){
                let recentMessage=group.recentMessage;
                if(recentMessage===null){
                    recentMessage='';
                }
                html += "                        <span style='float: left' id='messageType_"+group.groupId+"' class=\"preview\">"+recentMessage+"<\/span>";
            }else{
                let messageType=group.messageType;
                if(messageType===null){
                    messageType='';
                }
                html += "                        <span style='float: left' id='messageType_"+group.groupId+"' class=\"preview\">"+messageType+"<\/span>";
            }
            if(group.pendingMessage>0){
                html += "                        <div style='' id='notice_"+group.groupId+"' class=\"pad-2 notice text-center\" >New<\/div>";
            }else {
                html += "                        <div style='' id='notice_"+group.groupId+"' class=\"pad-2 notice hidden text-center\" ><\/div>";
            }

            html += "                    <\/li>";

            $("#groups").prepend(html);
        }

        // this function prints group list on the left side
        function printGroupListAppend(groups){
            let html="";
            groupIds=[];

            time={};
            for(let i=0;i<groups.length;i++){
                groupIds.push(groups[i].groupId);
                time[groups[i].groupId]=groups[i].lastActive;
                html += " <li class=\"person\" data-chat=\"person1\" id='group_"+groups[i].groupId+"' data-mecreator=\""+groups[i].meCreator+"\"  data-type=\""+groups[i].groupType+"\" data-group=\""+groups[i].groupId+"\">";
                groupImages[groups[i].groupId]=groups[i].groupImage;
                html +='<span id="groupImage_'+groups[i].groupId+'">';
                for (j=0;j<groups[i].groupImage.length;j++){

                    html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+groups[i].groupImage[j]+"\" >";
                }
                html +='</span>';
                html += "                        <span class=\"name\" id='groupName_"+groups[i].groupId+"' style=\"overflow: hidden\"><div>"+groups[i].groupName+"</div><\/span>";
                let date=moment(groups[i].lastActive,moment.ISO_8601).fromNow();

                html += "                        <span id='time_"+groups[i].groupId+"' class=\"time\">"+date+"<\/span>";
                if(groups[i].messageType==="text"){
                    let recentMessage=groups[i].recentMessage;
                    if(recentMessage===null){
                        recentMessage='';
                    }
                    html += "                        <span style='float: left' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+recentMessage+"<\/span>";
                }else{
                    let messageType=groups[i].messageType;
                    if(messageType===null){
                        messageType='';
                    }
                    html += "                        <span style='float: left' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+messageType+"<\/span>";
                }
                /*if(groups[i].pendingMessage>0){
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice text-center\" >New<\/div>";
                }else {
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice hidden text-center\" ><\/div>";
                }*/

                html += "                    <\/li>";
            }
            $("#groups").append(html);
            let scrollXClone=$(".ps__scrollbar-x-rail").clone();
            let scrollYClone=$(".ps__scrollbar-y-rail").clone();
            $(".ps__scrollbar-x-rail").remove();
            $(".ps__scrollbar-y-rail").remove();
            $("#groups").append(scrollXClone);
            $("#groups").append(scrollYClone);
        }
        function printGroupList(groups){
            let html="";
            groupIds=[];

            time={};
            for(let i=0;i<groups.length;i++){
                groupIds.push(groups[i].groupId);
                time[groups[i].groupId]=groups[i].lastActive;
                html += " <li class=\"person\" data-chat=\"person1\" id='group_"+groups[i].groupId+"' data-mecreator=\""+groups[i].meCreator+"\" data-type=\""+groups[i].groupType+"\" data-group=\""+groups[i].groupId+"\">";
                groupImages[groups[i].groupId]=groups[i].groupImage;
                html +='<span id="groupImage_'+groups[i].groupId+'">';
                for (j=0;j<groups[i].groupImage.length;j++){

                    html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+groups[i].groupImage[j]+"\" >";
                }
                html +='</span>';
                html += "                        <span class=\"name\" id='groupName_"+groups[i].groupId+"' style=\"overflow: hidden\"><div>"+groups[i].groupName+"</div><\/span>";
                let date=moment(groups[i].lastActive,moment.ISO_8601).fromNow();

                html += "                        <span id='time_"+groups[i].groupId+"' class=\"time\">"+date+"<\/span>";
                if(groups[i].messageType==="text"){
                    let recentMessage=groups[i].recentMessage;
                    if(recentMessage===null){
                        recentMessage='';
                    }
                    html += "                        <span style='float: left' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+recentMessage+"<\/span>";
                }else{
                    let messageType=groups[i].messageType;
                    if(messageType===null){
                        messageType='';
                    }
                    html += "                        <span style='float: left' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+messageType+"<\/span>";
                }
                /*if(groups[i].pendingMessage>0){
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice text-center\" >New<\/div>";
                }else {
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice hidden text-center\" ><\/div>";
                }*/

                html += "                    <\/li>";
            }
            $("#groups").html(html);
        }

        //This function is used to get the group list
        function getGroupList(callback) {
            let url="<?php echo base_url('imApi/getGroups?limit=') ?>"+groupLimit+"&start=0";
            if(ID_BASED){
                url="<?php echo base_url('imApi/getGroups?limit=') ?>"+groupLimit+"&start=0&userId="+userId;
            }
            let settings = {
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
                        location.href="<?php echo base_url('userview/logout') ?>"
                    }
                }
            };

            $.ajax(settings).done(function (response) {

                let groups=response.response;
                totalGroup=response.status.total;
                if(groups.length<=0){
                    $('#addMember').attr('data-group',null);
                    $('#addMember').addClass("hidden");
                    chatBox.html('<img id="blankImg" src="<?php echo base_url('assets/im/img/nomess.png')?>" class="img-responsive blankImg" style="width:500px;margin-top: 20px;">');
                    chatBox.addClass("text-center");
                    $('#groupMembers').html("");
                    $('#groups').html('');
                    $("#editGroupName").addClass("hidden");
                    $('.UserNames').html('');
                }else{
                    $('#addMember').removeClass("hidden");
                    $("#editGroupName").removeClass("hidden");

                    printGroupList(groups);
                    // $("#groups li").first().trigger("click");
                    if(callback!=null|| callback!=""){
                        if(groups.length>0){
                            callback(true);
                        }else {
                            callback(false);
                        }

                    }else {
                        $("#groups li").first().trigger("click",[{update:true}]);
                    }
                }



            });

        }

        //this function is used to print the group member list on the right side
        function printGroupMembers(members,meCreator,groupId) {
            let html="";
            membersId=[];
            for (i=0;i<members.length;i++){
                membersId.push(members[i].userId);
                html += "<li class=\"person\"  style=\"padding-top: 5px;padding-bottom: 22px;cursor: default;\">";
                if(members[i].active===1){
                    html += "                        <img class='memberStatus memberActive' id='member_"+members[i].userId+"' src=\""+members[i].profilePictureUrl+"\" alt=\"\" \/>";
                }else {
                    html += "                        <img class='memberStatus' id='member_"+members[i].userId+"' src=\""+members[i].profilePictureUrl+"\" alt=\"\" \/>";
                }
                html += "                        <span  class=\"name\"><div style='margin-top: 8px'>"+members[i].firstName+" "+members[i].lastName +"</div><\/span>";
                /*if((meCreator===true || meCreator==="true") && parseInt(groupType)===0){
                    html += "                        <span class=\"time\" style='padding-top: 5px' ><a href=\"#\" data-group=\""+groupId+"\" data-member=\""+members[i].userId+"\" class=\"btn-danger btn-extra-small btnMemberDelete\"><i class=\"fa fa-trash\"><\/i><\/a><\/span>";
                }*/
                html += "                    <\/li>";
            }
            $('#groupMembers').html(html);
        }
        function getFileIcon(type) {
            let defaultIcon = "fa fa-file";
            let iconArray = [
                {type: "text", icon: "fa fa-file-text-o"}, {type: "txt", icon: "fa fa-file-text-o"},
                {type: "video", icon: "fa fa-file-movie-o"},
                {type: "audio", icon: "fa fa-file-audio-o"},
                {type: "pdf", icon: "fa fa-file-pdf-o"},
                {type: "doc", icon: "fa fa-file-word-o"}, {type: "docx", icon: "fa fa-file-word-o"},
                {type: "ppt", icon: "fa fa-file-powerpoint-o"}, {type: "pptx", icon: "fa fa-file-powerpoint-o"},
                {type: "xls", icon: "fa fa-file-excel-o"}, {type: "xlsx", icon: "fa fa-file-excel-o"},
                {type: "rar", icon: "fa fa-file-archive-o"}, {type: "zip", icon: "fa fa-file-archive-o"},
            ];
            for (let i = 0; i < iconArray.length; i++) {
                if (iconArray[i].type == type) {
                    return iconArray[i].icon;
                }
            }
            return defaultIcon;
        }
        function printGroupFiles(groupFiles) {
            if (groupFiles.length > 0) {
                if ($("#attachment").hasClass("hidden")) {
                    $("#attachment").removeClass("hidden");
                }
            }
            else {
                if (!$("#attachment").hasClass("hidden")) {
                    $("#attachment").addClass("hidden");
                }
            }

            let strVar = "";
            for (let i = 0; i < groupFiles.length; i++) {
                strVar += "<li>";
                strVar += "                        <i class='" + getFileIcon(groupFiles[i].type) + "'><\/i>";
                strVar += "                        <span>";
                strVar += "                            <a  target='_blank'style=\"color: #75aef3;\" href='" + groupFiles[i].message + "'>";
                strVar += groupFiles[i].fileName;
                strVar += "                            <\/a>";
                strVar += "                        <\/span>";
                strVar += "                    <\/li>";
            }
            $("#attachmentList").html(strVar);
        }
        function printGroupImages(groupImages) {
            if (groupImages.length > 0) {
                if ($("#imageAttachment").hasClass("hidden")) {
                    $("#imageAttachment").removeClass("hidden");
                }
            }
            else {
                if (!$("#imageAttachment").hasClass("hidden")) {
                    $("#imageAttachment").addClass("hidden");
                }
            }

            let strVar = "";
            for (let i = 0; i < groupImages.length; i++) {
                strVar += "<div class=\" pad-5\" style='float: left;'>";
                strVar += "                            <a style='height: 100px;width: 100px' href='" + groupImages[i].message + "' class=\"ol-hover hover-5 ol-lightbox\">";
                strVar += "                                <img style='height: 100px;width: 100px'  src='" + groupImages[i].message + "' alt=\"image hover\">";
                strVar += "                                <div class=\"ol-overlay ov-light-alpha-80\"><\/div>";
                strVar += "                                <div class=\"icons\"><i class=\"fa fa-camera\"><\/i><\/div>";
                strVar += "                            <\/a>";
                strVar += "                    <\/div>";
            }
            $("#ImageAttachmentList").html(strVar);
            lightBox.init();
        }

        //This function is used to get the group member list
        function getGroupMembers(groupId) {
            let url="<?php echo base_url('imApi/getMembers?groupId=') ?>"+groupId;
            if(ID_BASED){
                url="<?php echo base_url('imApi/getMembers?groupId=') ?>"+groupId+"&userId="+userId;
            }
            let settings = {
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
                "contentType": false
            };
            $.ajax(settings).done(function (response) {
                let members=response.response.memberList;
                let meCreator=response.response.meCreator;
                //let groupFiles=response.response.groupFiles;
                //let groupImages=response.response.groupImages;
                printGroupMembers(members,meCreator,groupId);
            });

        }

        //This function is used to print the group name and three member image on the right side top
        function printGroupInfo(groupId,groupImages,groupName){
            let html="";
            let images=groupImages[groupId];
            for(i=0;i<images.length;i++){
                html += "<img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+images[i]+"\" >";
            }
            $('.rightGroupImages').html(html);
            $('.be-use-name').html(groupName);
            $clamp($('.be-use-name')[0], { clamp: 2, useNativeClamp: false });
        }

        function clampData() {
            $('.clamp-desc').each(function (index,element) {
                $clamp(element, {clamp: 4, useNativeClamp: false});
            });
            $('.clamp-title').each(function (index,element) {
                $clamp(element, {clamp: 3, useNativeClamp: false});
            });
        }
        //This function is used to  get friend list of user
        function getMembers(callback) {   // get friends list
            resetFriendStart();
            let settings={
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imuser/friendList?start=') ?>"+friendStart+"&limit="+friendLimit,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",

                },
                "dataType" : 'json'
            };
            $.ajax(settings).done(function (response) {

                let data=response.response.friends;
                totalFriend=response.response.total;
                callback(data);
            });
        }

        //This function is used to clear the current chat box for retrieving new message for the new group
        function clearChatBox() {
            chatBox.html('');
        }

        function getImagePreview(message){
            let defaultImage = "<?php echo base_url('/assets/im/img/compact_camera1600.png') ?>";
            let linkData=JSON.parse(message.linkData);
            let  html = "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\"><a style='display: inline-block;border: 1px solid #eee;border-radius: 10px;max-height: 450px;' href=\"" + message.message + "\" class=\"ol-hover hover-5 ol-lightbox\"><img onerror='this.style.display=\"none\";' style='max-height: 450px;' height=\"200px\" width=\"200px\" src=\"" + message.message + "\" alt=\"image hover\">";
            if(linkData!=null && linkData.hasOwnProperty("playerOrImageUrl") && linkData.playerOrImageUrl.hasOwnProperty("size") && linkData.playerOrImageUrl.size!=null && linkData.playerOrImageUrl.size.hasOwnProperty("height") && linkData.playerOrImageUrl.size.height!=null &&linkData.playerOrImageUrl.size.hasOwnProperty("width") && linkData.playerOrImageUrl.size.width!=null ){
                html = "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\"><a style='display: inline-block;border: 1px solid #eee;border-radius: 10px;max-height: 450px;' href=\"" + message.message + "\"  class=\"ol-hover hover-5 ol-lightbox\"><img onerror='this.style.display=\"none\";' style='max-height: 450px;' height=\""+linkData.playerOrImageUrl.size.height+"px\" width=\""+linkData.playerOrImageUrl.size.width+"px\" src=\"" + message.message + "\" alt=\"image hover\">";
            }

            html += "                            <div class=\"ol-overlay ov-light-alpha-80\"><\/div>";
            html += "                            <div class=\"icons\"><i class=\"fa fa-camera\"><\/i><\/div><\/a>";
            html += "                            <\/div>";

            return html;
        }
        //This function is used to create the preview for a link sheared in message
        function getLinkPreview(linkData, link) {
            let defaultImage = "<?php echo base_url('/assets/im/img/compact_camera1600.png') ?>";
            if (linkData.playerOrImageUrl.type === 'player') {
                return "<div class='i-wrapper'><iframe src='" + linkData.playerOrImageUrl.url + "' class='medea-frame iframe-wrapper' allowfullscreen></iframe></div>";
            }
            else if (linkData.playerOrImageUrl.type === 'file') {
                let image = "<img src='" + linkData.playerOrImageUrl.url + "' id='tImg' width='100%' onerror='this.style.display=\"none\";' >";
                if(linkData.playerOrImageUrl.hasOwnProperty("size") && linkData.playerOrImageUrl.size!=null && linkData.playerOrImageUrl.size.hasOwnProperty("height") && linkData.playerOrImageUrl.size.height!=null &&linkData.playerOrImageUrl.size.hasOwnProperty("width") && linkData.playerOrImageUrl.size.width!=null ){
                    image = "<img src='" + linkData.playerOrImageUrl.url + "' id='tImg' width='100%' onerror='this.style.display=\"none\";' style='height:"+linkData.playerOrImageUrl.size.height+"px; width:"+linkData.playerOrImageUrl.size.width +"px;' >";
                }

                return "<a href='" + link + "' target=\"_blank\" >" +
                    "<div class='linkPreview-wrapper'>" +
                    "<div class='link-file' >" + image +
                    "</div> " +
                    "</div>" +
                    "</a>";
            }
            else {
                let image = "<img src='<?php echo base_url("/assets/im/img/compact_camera1600.png") ?>' id='tImg_blank' width='100%'>";
                let returnString="";
                if (linkData.playerOrImageUrl.url != null) {
                    image = "<img src='" + linkData.playerOrImageUrl.url + "' id='tImg' width='100%' onerror='this.style.display=\"none\";' >";
                    returnString= "<a href='" +link + "' target=\"_blank\" >" +
                        "<div class='linkPreview-wrapper'>" +
                        "<div id='texts'>" +
                        "<div id='thumbnail' >" + image +
                        "</div> " +
                        "<div id='desc'>" +
                        "<div id='title'>" +
                        "<div class='clamp-title'>" + linkData.title +
                        "</div>" +
                        "</div>" +
                        "<div class='clamp-desc'>" + linkData.description +
                        "</div> " +
                        "<div id='meta'>" +
                        "<div id='domain'>" + linkData.host +
                        "</div>" +
                        "<div class='clear'></div>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</a>";
                }
                returnString= "<a href='" + link + "' target=\"_blank\" >" +
                    "<div class='linkPreview-wrapper'>" +
                    "<div id='texts'>" +
                    "<div id='thumbnail' >" + image +
                    "</div> " +
                    "<div id='desc'>" +
                    "<div id='title'>" +
                    "<div class='clamp-title'>" + linkData.title +
                    "</div>" +
                    "</div> " +
                    "<div class='clamp-desc'>" + linkData.description +
                    "</div> " +
                    "<div id='meta'>" +
                    "<div id='domain'>" + linkData.host +
                    "</div>" +
                    "<div class='clear'></div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</a>";

                /* if(String(linkData.description).length===0){
                     returnString="";
                 }*/
                return returnString;
            }


        }


        //This function is used to format the links and add the emojis send by user
        function parseMessage(message) {
            return  twemoji.parse(
                anchorme(message,{
                    //truncate:[15,10],
                    attributes:[
                        function(urlObj){
                            if(urlObj.protocol !== "mailto:")
                                return {name:"target",value:"blank"};
                        }
                    ]
                })
            );
        }

        //This function is used to retrieve messages from server based on group id
        function getMessage(groupId) {

            if(start==1){
                start=0;
            }
            let url="<?php echo base_url('imApi/getMessage?groupId=') ?>"+groupId+"&limit="+limit+"&start="+start+"&isAdmin="+1;
            if(ID_BASED){
                url="<?php echo base_url('imApi/getMessage?groupId=') ?>"+groupId+"&limit="+limit+"&start="+start+"&isAdmin="+1+"&userId="+userId;
            }
            let settings={
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
                "beforeSend":function () {

                    chatBox.html('<img id="loadingMessage" src="<?php echo base_url('assets/im/img/loadingMessage.gif')?>" class="img-responsive blankImg" style="">');
                    chatBox.addClass("text-center");
                    chatBox.addClass("vertical-alignment");
                },
                "success":function () {

                    $("#loadingMessage").remove();
                    chatBox.removeClass("text-center");
                    chatBox.removeClass("vertical-alignment");
                }

            };
            $.ajax(settings).done(function (result) {

                let data=result.response;
                let html="";
                totalRetivedMessage+=data.length;

                if(data.length===0){
                    chatBox.html('<img id="blankImg" src="<?php echo base_url('assets/im/img/nomess.png')?>" class="img-responsive blankImg" style="width:500px;margin-top: 20px;">');
                    chatBox.addClass("text-center");
                }else{
                    chatBox.removeClass("text-center");
                    lastMessageDate=moment(data[data.length-1].message.ios_date_time,moment.ISO_8601);
                    let currentDate=lastMessageDate;
                    let flage=true;
                    topMessage=data[0].message.m_id;
                    for(let i=0;i<data.length;i++) {

                        let sender = data[i].sender;
                        let message = data[i].message;

                        let senderId = data[i].sender.userId;
                        let messageDate = moment(data[i].message.date);
                        let seen=data[i].seen;

                        if (currentDate.diff(messageDate, 'days') >= 1 || currentDate.diff(messageDate, 'days') <= -1) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            currentDate = messageDate;
                            flage = false;
                        }
                        else if (flage && currentDate.diff(messageDate, 'minutes') >= 30) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            currentDate = messageDate;
                        }
                        if (message.type === "update") {
                            html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender\" style='font-family: monospace;font-size: large' data-og-container=\"\">";
                            html += "<i  class='oli oli-newspaper'></i> "+ message.message;
                            html += "                <\/div>";
                        }

                        else {
                            if (parseInt(senderId) === parseInt(userId)) {

                                html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                                if (message.type === "text") {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message) + "<\/div>";
                                    if (message.linkData !== null) {
                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a id='document_" + message.m_id + "' href="+message.message +" download="+message.fileName+">"+message.fileName+"<\/a></div>";
                                    //html += "                    <\/div>";
                                }
                                html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                                html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                                html += "                    <\/div>";
                                if(seen===null){
                                    html += "                    <div class=\"fw-im-message-time seen hidden  seenId_"+ message.m_id+"\">";
                                    html += "                        <span class='seenMessage_"+ message.m_id+"'>"+seen+"<\/span>";
                                    html += "                    <\/div>";
                                }
                                else{
                                    if(seen.time!==null){
                                        html += "                    <div class=\"fw-im-message-time seen  seenId_"+ message.m_id+"\">";
                                        html += "                        <span class='seenMessage_"+ message.m_id+"'>"+seen.seen+moment(seen.time, moment.ISO_8601).calendar(null, momentOptions2)+"<\/span>";
                                        html += "                    <\/div>";
                                    }else{
                                        html += "                    <div class=\"fw-im-message-time seen  seenId_"+ message.m_id+"\">";
                                        html += "                        <span class='seenMessage_"+ message.m_id+"'>"+seen.seen+"<\/span>";
                                        html += "                    <\/div>";
                                    }

                                }

                                html += "                <\/div>";
                            }
                            else {
                                html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                                if (message.type === "text") {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message) + "<\/div>";
                                    if (message.linkData !== null) {

                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\">";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a  id='document_" + message.m_id + "' href="+message.message +" download="+message.fileName+"  >"+message.fileName+"<\/a></div>";
                                    //html += "                    <\/div>";
                                }
                                html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                                if (sender.active === 1) {
                                    html += "                        <img class='auth_" + senderId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                                } else {
                                    html += "                        <img class='auth_" + senderId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                                }
                                html += "                    <\/div>";
                                /* html += "                    <div class=\"fw-im-message-time\">";
                                 html += "                        <span style=\"cursor:help\" title=\""+moment(message.ios_date_time,moment.ISO_8601).format('LLLL')+"\">"+moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions)+"<\/span>";
                                 html += "                    <\/div>";*/
                                html += "                <\/div>";
                            }


                        }
                    }

                    chatBox.html("");

                    chatBox.append(html);
                    chatBox.scrollTop(0);

                    for (let i = 0; i < data.length; i++) {
                        let allMessage = data[i].message;
                        let sender = data[i].sender;
                        let isme = parseInt(sender.userId) !== parseInt(userId);
                        if (allMessage.type == "video") {
                            initVideo("video_" + allMessage.m_id, isme);
                        } else if (allMessage.type == "audio") {
                            initAudio("audio_" + allMessage.m_id, isme);
                        } else if (allMessage.type == "text" && isUnicode(allMessage.message)) {
                            $("#message_" + allMessage.m_id).css({
                                "direction": "rtl",
                                "font-size": "15px",
                                "font-family": "Tahoma"
                            });
                        }
                    }

                    let height=chatBox[0].scrollHeight;
                    //scrollPosition=height;
                    //chatBox.scrollTop( chatBox.prop( "scrollHeight" ) );
                    chatBox.scrollTop(height);

                    //$('#notice_'+groupId).addClass("hidden");
                    lightBox.init();
                    chatBox.perfectScrollbar({suppressScrollX:true});
                    clampData();


                }


            });

        }

        //This function is used to send message to the server
        function sendMessage(form,sendFile,newmessage) {
            let settings=null;
            if(sendFile){
                let progress1 = new LoadingOverlayProgress();

                settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo base_url('imApi/sendMessage') ?>",
                    "method": "POST",
                    "headers": {
                        "authorization": "Basic YWRtaW46MTIzNA==",
                        "x-auth-token": String(responce),
                        "cache-control": "no-cache",

                    },
                    "xhr": function() {

                        let xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener("progress", function(evt) {
                            if(sendFile) {
                                let percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);

                                if (percentComplete >= 100) {
                                    //clearInterval(iid1);
                                    delete progress1;
                                    $("body").LoadingOverlay("hide");
                                    return;
                                }
                                progress1.Update(percentComplete);
                            }
                        }, false);

                        return xhr;
                    },
                    "processData": false,
                    "contentType": false,
                    "mimeType": "multipart/form-data",
                    "data": form,
                    "error":function () {
                        toastr.error("An error occurred. Please try again");
                    },
                    "beforeSend":function () {
                        $('.close').trigger("click");
                        if(sendFile){
                            $("body").LoadingOverlay("show", {
                                custom  : progress1.Init()
                            });
                        }

                    },
                    "complete":function () {
                        delete progress1;
                        $("body").LoadingOverlay("hide");
                    }
                };
            }else{
                typingTimeoutFunction();
                settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo base_url('imApi/sendMessage') ?>",
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
                    "error":function () {
                        toastr.error("An error occurred. Please try again");
                    },
                    "beforeSend":function () {
                        $('.close').trigger("click");

                    },
                    "complete":function () {

                    }
                };
            }

            $.ajax(settings).done(function (res) {
                let json=JSON.parse(res);
                let group=json.response;

                resetNewMessage();
                if(newmessage){
                    let currentGroupId=$('#addMember').attr("data-group");
                    $("#group_"+group.groupId).remove();
                    $('.person').removeClass('active');
                    addNewGroup(group);
                    $('#groups li').first().trigger("click",[{update:true}]);

                }

            });
        }

        // unused function. have a plan used in the future
        function captureImage(file) {
            let canvas = document.createElement("canvas");
            canvas.width = 40;
            canvas.height = 40;

            canvas.strokeStyle = 'black';
            canvas.lineWidth = 1;
            canvas.getContext('2d').strokeRect(0, 0, canvas.width, canvas.height);
            canvas.getContext('2d').drawImage(file, 0, 0, canvas.width-1, canvas.height-1);

            let img = document.getElementById("fileIV");
            img.src = canvas.toDataURL("image/png");
            //$output.prepend(img);
        };
        function captureImagenewMessage(file) {
            let canvas = document.createElement("canvas");
            canvas.width = 40;
            canvas.height = 40;

            canvas.strokeStyle = 'black';
            canvas.lineWidth = 1;
            canvas.getContext('2d').strokeRect(0, 0, canvas.width, canvas.height);
            canvas.getContext('2d').drawImage(file, 0, 0, canvas.width-1, canvas.height-1);

            let img = document.getElementById("newMessagefileIV");
            img.src = canvas.toDataURL("image/png");
            //$output.prepend(img);
        };




        //update the message time on the left side
        function updateTime() {
            for (i=0;i<groupIds.length;i++){
                let date=moment(time[groupIds[i]],moment.ISO_8601).fromNow();
                $('#time_'+groupIds[i]).html(date);
            }

        }

        function getGroupFiles(groupId) {
            /* if (!$("#imageAttachment").hasClass("hidden")) {
                 $("#imageAttachment").addClass("hidden");
             }
             if (!$("#attachment").hasClass("hidden")) {
                 $("#attachment").addClass("hidden");
             }*/
            //$("#ImageAttachmentList").html("");
            //$("#attachmentList").html("");
            let url = "<?php echo base_url('imApi/getGroupFiles?groupId=') ?>" + groupId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/getMembers?groupId=') ?>" + groupId + "&userId=" + userId;
            }
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": url,
                "method": "GET",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",
                    "Postman-Token": "fc25d304-c91a-4a8e-babf-0676ba176084"
                }
            };

            $.ajax(settings).done(function (response) {
                let groupFiles = response.response.groupFiles;
                let groupImages = response.response.groupImages;
                printGroupFiles(groupFiles);
                printGroupImages(groupImages);
            });
        }
// -----------------End of Global functions --------------------------//

        $('#groups').perfectScrollbar({suppressScrollX:true});
        $('#groupMembers').perfectScrollbar({suppressScrollX:true});
        chatBox.perfectScrollbar({suppressScrollX:true});

        $(addmember).on('expand', function(c){
            addexpendDropdown=$('.ms-res-ctn.dropdown-menu').perfectScrollbar({suppressScrollX:true});
            initaddexpendDropdown();
        });

        $(addmember).on('collapse', function(c){
            addexpendDropdown.perfectScrollbar("destroy");
        });

        $(newMemberInput).on('expand', function(c){
            addMemberexpendDropdown=$('.ms-res-ctn.dropdown-menu').perfectScrollbar({suppressScrollX:true});
            initaddMemberexpendDropdown();
        });

        $(newMemberInput).on('collapse', function(c){
            addMemberexpendDropdown.perfectScrollbar("destroy");
        });


        $(newMemberInput).on('keyup', function(e, m, v){
            let value=this.getRawValue().replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imuser/filterFriendList?key=') ?>" + value,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",

                },
                "dataType": 'json'
            };
            $.ajax(settings).done(function (response) {
                request=true;
                let res = response.response;
                let oldData=[];
                for (let i = 0; i < res.length; i++) {
                    if (res[i].userStatus !== 0) {
                        let md = {
                            id: parseInt(res[i].userId),
                            name: res[i].firstName + " " + res[i].lastName,
                            picture: res[i].profilePictureUrl,
                            email: res[i].userEmail
                        };
                        oldData.push(md);
                        //expendDropdown.append(getMagicData(md));
                    }
                }
                //addmember.setData(oldData);
                newMemberInput.setData(oldData);
            });

        });

        $(addmember).on('keyup', function(e, m, v){
            let value=this.getRawValue().replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imuser/filterFriendList?key=') ?>" + value,
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",

                },
                "dataType": 'json'
            };
            $.ajax(settings).done(function (response) {
                request=true;
                let res = response.response;
                let oldData=[];
                for (let i = 0; i < res.length; i++) {
                    if (res[i].userStatus !== 0) {
                        let md = {
                            id: parseInt(res[i].userId),
                            name: res[i].firstName + " " + res[i].lastName,
                            picture: res[i].profilePictureUrl,
                            email: res[i].userEmail
                        };
                        oldData.push(md);
                        //expendDropdown.append(getMagicData(md));
                    }
                }
                addmember.setData(oldData);
                //newMemberInput.setData(oldData);
            });

        });
        function initaddexpendDropdown() {


            let request = true;
            addexpendDropdown.on("ps-y-reach-end", function () {
                increaseFriendsLimit();
                if (request && friendStart <totalFriend) {
                    request = false;

                    let settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "<?php echo base_url('imuser/friendList?start=') ?>" + friendStart + "&limit=" + friendLimit,
                        "method": "GET",
                        "headers": {
                            "authorization": "Basic YWRtaW46MTIzNA==",
                            "x-auth-token": String(responce),
                            "cache-control": "no-cache",

                        },
                        "dataType": 'json'
                    };
                    $.ajax(settings).done(function (response) {
                        request=true;
                        let res = response.response.friends;
                        let oldData=addmember.getData();
                        for (let i = 0; i < res.length; i++) {
                            if (res[i].userStatus !== 0) {
                                let md = {
                                    id: parseInt(res[i].userId),
                                    name: res[i].firstName + " " + res[i].lastName,
                                    picture: res[i].profilePictureUrl,
                                    email: res[i].userEmail
                                };
                                oldData.push(md);
                                //expendDropdown.append(getMagicData(md));
                            }
                        }
                        addmember.setData(oldData);
                        //newMemberInput.setData(oldData);
                    });
                }
            });
        }

        function initaddMemberexpendDropdown()  {


            let request = true;
            addMemberexpendDropdown.on("ps-y-reach-end", function () {
                increaseFriendsLimit();
                if (request && friendStart <totalFriend) {
                    request = false;

                    let settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "<?php echo base_url('imuser/friendList?start=') ?>" + friendStart + "&limit=" + friendLimit,
                        "method": "GET",
                        "headers": {
                            "authorization": "Basic YWRtaW46MTIzNA==",
                            "x-auth-token": String(responce),
                            "cache-control": "no-cache",

                        },
                        "dataType": 'json'
                    };
                    $.ajax(settings).done(function (response) {
                        request=true;
                        let res = response.response.friends;
                        let oldData=newMemberInput.getData();
                        for (let i = 0; i < res.length; i++) {
                            if (res[i].userStatus !== 0) {
                                let md = {
                                    id: parseInt(res[i].userId),
                                    name: res[i].firstName + " " + res[i].lastName,
                                    picture: res[i].profilePictureUrl,
                                    email: res[i].userEmail
                                };
                                oldData.push(md);
                                //expendDropdown.append(getMagicData(md));
                            }
                        }
                        // addmember.setData(oldData);
                        newMemberInput.setData(oldData);
                    });
                }
            });
        }

        let requested=true;
        groupBox.on("ps-y-reach-end",function () {
            increaseGroupLimit();
            if(requested && groupStart<totalGroup){
                requested=false;

                let url="<?php echo base_url('imApi/getGroups?limit=') ?>"+groupLimit+"&start="+groupStart;
                if(ID_BASED){
                    url="<?php echo base_url('imApi/getGroups?limit=') ?>"+groupLimit+"&start="+groupStart+"&userId="+userId;
                }
                let settings = {
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
                    "beforeSend":function () {
                        groupBox.append("<div class='text-center groupLoader'><div class='loader'></div></div>");
                    },
                    "complete":function () {
                        $('.groupLoader').remove();

                    }
                };
                $.ajax(settings).done(function (response) {

                    let groups=response.response;
                    printGroupListAppend(groups);
                    requested=true;
                });



            }


        });

        chatBox.on("ps-scroll-up",function() {

            if (notRequested && chatBox.scrollTop()===0) {
                notRequested=false;
                increaseStart();

                let groupId= activegroupId;
                let url="<?php echo base_url('imApi/getMessage?groupId=') ?>" + groupId + "&limit="+limit+"&start=" + start;
                if(ID_BASED){
                    url="<?php echo base_url('imApi/getMessage?groupId=') ?>" + groupId + "&limit="+limit+"&start=" + start+"&userId="+userId;
                }

                let settings = {
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
                    "beforeSend":function () {
                        chatBox.prepend("<div class='loader'></div>");
                    },
                    "complete":function () {
                        $('.loader').remove();

                    }
                };
                $.ajax(settings).done(function (result) {
                    $('.loader').remove();
                    notRequested=true;
                    let data = result.response;
                    if(data.length===0){
                        notRequested=false;
                        return;
                    }
                    if(totalRetivedMessage===result.totalMessage){
                        resetStart();
                        return;
                    }
                    let html = "";
                    let currentDate=lastMessageDate;
                    let currentTopMessage=topMessage;
                    topMessage=data[0].message.m_id;
                    for (let i = 0; i < data.length; i++) {
                        let self = data[i].self;
                        let sender = data[i].sender;
                        let message = data[i].message;

                        let senderId = data[i].sender.userId;
                        let messageDate = moment(data[i].message.ios_date_time, moment.ISO_8601);


                        if (currentDate.date() - messageDate.date() >= 1 || currentDate.date() - messageDate.date() <= -1) {
                            if (currentDate !== messageDate) {
                                html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                                html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                                html += "                <\/div>";
                                currentDate = messageDate;
                            }
                        }
                        if (message.type === "update") {
                            html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender\" style='font-family: monospace;font-size: large' data-og-container=\"\">";
                            html += "<i   class='oli oli-newspaper'></i> "+ message.message;
                            html += "                <\/div>";
                        }

                        else {
                            if (parseInt(senderId) === parseInt(userId)) {
                                html += "<div  class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                                if (message.type === "text") {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message) + "<\/div>";
                                    if (message.linkData != null) {
                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'   width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a  id='document_" + message.m_id + "' href="+message.message +" download="+message.fileName+" >"+message.fileName+"<\/a></div>";
                                    //html += "                    <\/div>";
                                }
                                html += "                    <div class=\"fw-im-message-author\"   title=\"" + sender.firstName + " " + sender.lastName + "\">";
                                html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                                html += "                    <\/div>";
                                /*html += "                    <div class=\"fw-im-message-time\">";
                                html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time,moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions) + "<\/span>";
                                html += "                    <\/div>";*/
                                html += "                <\/div>";
                            }
                            else {
                                html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                                if (message.type === "text") {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message) + "<\/div>";
                                    if (message.linkData !== null) {
                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\">";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'   width=\"250px\" height=\"150px\" controls=\"true\"  preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a  id='document_" + message.m_id + "' href="+message.message +" download="+message.fileName+">"+message.fileName+"<\/a></div>";
                                    //html += "                    <\/div>";
                                }
                                html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                                if (sender.active === 1) {
                                    html += "                        <img class='auth_" + senderId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                                } else {
                                    html += "                        <img class='auth_" + senderId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                                }
                                html += "                    <\/div>";
                                /* html += "                    <div class=\"fw-im-message-time\">";
                                 html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time,moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions) + "<\/span>";
                                 html += "                    <\/div>";*/
                                html += "                <\/div>";
                            }
                        }
                    }


                    totalRetivedMessage+=data.length;

                    chatBox.prepend(html);
                    for (let i = 0; i < data.length; i++) {
                        let allMessage = data[i].message;
                        let sender = data[i].sender;
                        let isme = parseInt(sender.userId) !== parseInt(userId);
                        if (allMessage.type == "video") {
                            initVideo("video_" + allMessage.m_id, isme);
                        } else if (allMessage.type == "audio") {
                            initAudio("audio_" + allMessage.m_id, isme);
                        } else if (allMessage.type == "text" && isUnicode(allMessage.message)) {
                            $("#message_" + allMessage.m_id).css({
                                "direction": "rtl",
                                "font-size": "15px",
                                "font-family": "Tahoma"
                            });
                        }
                    }
                    /*if(data.length>0){
                     let m_id=data[data.length-1].message.m_id;
                     chatBox.animate({scrollTop:$("#message_"+m_id).offset().top},3);
                     }*/
                    // let height=chatBox[0].scrollHeight;
                    let elmnt = document.getElementById("message_"+currentTopMessage);

                    if(data.length!==0){
                        if(!elmnt){
                            chatBox.scrollTop(scrollPosition);
                        }
                        else{
                            elmnt.scrollIntoView(false);
                        }

                    }

                    lightBox.init();
                    $('.loader').hide();
                    clampData();

                });
            }
        });
        //$(".rightSection").perfectScrollbar();

        $('#newMessageText').twemojiPicker({
            init: "Your message.....",
            size: '30px',
            icon: 'grinning',
            iconSize: '25px',
            height: '90px',
            width: '100%',
            border:'0',
            category: ['smile', 'cherry-blossom', 'video-game', 'oncoming-automobile', 'symbols'],
            categorySize: '20px',
            pickerPosition: 'bottom',
            pickerHeight: '150px',
            pickerWidth: '100%'
        });

        let sendMessageSettings= {
            init: "Your message.....",
            size: '30px',
            icon: 'grinning',
            iconSize: '25px',
            height: '50px',
            width: '100%',
            border:'0',
            category: ['smile', 'cherry-blossom', 'video-game', 'oncoming-automobile', 'symbols'],
            categorySize: '20px',
            pickerPosition: 'top',
            pickerHeight: '150px',
            pickerWidth: '100%'
        };



        if(responce!=null && responce!='' && type==1)
        {

            getGroupList(function (data) {
                if(data){
                    /*let token={
                        _r:String(responce)
                    };
                   // socket.emit("messageNotification",JSON.stringify(token));*/
                    $("#groups li").first().trigger("click",[{update:true}]);

                }
            });
        }

        else {
            location.href="<?php echo base_url("imadmin/logout")  ?>";
        }


        $('#message').twemojiPicker(sendMessageSettings);

        $('#groups').on("click",".person",function (e,update) {
            notRequested=true;
            $('#chatBox').perfectScrollbar('destroy');
            for(i=0;i<videoObjects.length;i++){
                videoObjects[i].dispose();
            }
            videoObjects=[];
            resetStart();
            resetRetiveMessage();
            if ($(this).hasClass('active')) {
                return false;
            }
            groupType=parseInt($(this).attr('data-type'));
            if(groupType==1){
                if (!$('#addMember').hasClass('hidden')) {
                    $('#addMember').addClass('hidden');
                }
            }else{
                if ($('#addMember').hasClass('hidden')) {
                    $('#addMember').removeClass('hidden');
                }
            }

            activegroupId = parseInt($(this).attr('data-group'));
            let groupId=activegroupId;
            let personName = $(this).find('.name').text();
            if(!$("#notice_"+groupId).hasClass("hidden")){
                $("#notice_"+groupId).addClass("hidden");
            }

            $('.UserNames').html(personName);
            $('.person').removeClass('active');
            $(this).addClass('active');
            let oldGroupId=$('#addMember').attr('data-group');
            $('#addMember').attr('data-group',groupId);
            $('#editGroupName').attr('data-group',groupId);
            let updateList=true;
            if(typeof update!=='undefined' ){
                updateList=update.update;
            }
            if(updateList){
                getGroupMembers(groupId);
            }

            getGroupFiles(groupId);
            clearChatBox();
            getMessage(groupId,start,limit);

            reset();
            let data={groupId:groupId};
            if(oldGroupId!==null|| oldGroupId!==""){
               // socket.emit("leaveRoom",oldGroupId);
            }
            printGroupInfo(groupId,groupImages,personName);

           // socket.emit("joinRoom",groupId,userId);

        });



        $('#groupMembers').on("click",".btnMemberDelete",function (e) {
            let groupId = $(this).attr('data-group');
            let memberId=$(this).attr('data-member');
            let form=new FormData();

            form.append("groupId",groupId);
            form.append("memberId",memberId);

            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/deleteMember') ?>",
                "method": "POST",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "data":form
            };

            $.ajax(settings).done(function (res) {
                //let data=JSON.parse(response)

                printGroupMembers(res.response.memberList,res.response.meCreator,groupId);
                groupImages[groupId]=res.response.groupInfo.groupImage;

                let html="";
                for (let j=0;j<res.response.groupInfo.groupImage.length;j++){

                    html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+res.response.groupInfo.groupImage[j]+"\" >";
                }
                $("#groupImage_"+groupId).html(html);
                $("#groupName_"+groupId).html("<div>"+res.response.groupInfo.groupName+"</div>");
                $(".UserNames").html(res.response.groupInfo.groupName);
                printGroupInfo(groupId,groupImages,res.response.groupInfo.groupName);
                toastr.success("Member deleted");
                // getGroupMembers(groupId);

            });

        });



        $('#addMember').on("click",function (e) {

            getMembers(function (res) {
                let q=[];
                for(i=0;i<res.length;i++) {
                    if(res[i].userStatus!=0) {
                        let md = {
                            id: parseInt(res[i].userId),
                            name: res[i].firstName + " " + res[i].lastName,
                            picture: res[i].profilePictureUrl,
                            email: res[i].userEmail
                        };
                        q.push(md);
                    }
                }

                newMemberInput.setData(q);
                newMemberInput.clear();

                $('#addNewMemberModal').modal('show');
            });
        });

        $("#newMemberAddBtn").on("click",function (e) {
            let userIds=newMemberInput.getValue();
            let groupId= $('#addMember').attr('data-group');

            if(userIds.length>0) {
                let form = new FormData();
                for (i = 0; i < userIds.length; i++) {
                    form.append("userId[]", userIds[i]);
                }
                form.append("groupId", groupId);

                let settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo base_url('imApi/addGroupMember/') ?>",
                    "method": "POST",
                    "headers": {
                        "authorization": "Basic YWRtaW46MTIzNA==",
                        "x-auth-token": String(responce),
                        "cache-control": "no-cache",

                    },
                    "processData": false,
                    "contentType": false,
                    "data": form
                };
                $.ajax(settings).done(function (res) {

                    printGroupMembers(res.response.memberList, res.response.meCreator, groupId);
                    groupImages[groupId]=res.response.groupInfo.groupImage;

                    let html="";
                    for (let j=0;j<res.response.groupInfo.groupImage.length;j++){

                        html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+res.response.groupInfo.groupImage[j]+"\" >";
                    }
                    $("#groupImage_"+groupId).html(html);
                    $("#groupName_"+groupId).html("<div>"+res.response.groupInfo.groupName+"</div>");
                    $(".UserNames").html(res.response.groupInfo.groupName);
                    printGroupInfo(groupId,groupImages,res.response.groupInfo.groupName);
                    newMemberInput.clear();
                    toastr.success("member add successful");
                    $('#addNewMemberModal').modal('hide');
                    // getGroupMembers(groupId);

                });

            }
        });


        $('#newMessage').on("click",function (e) {

            resetNewMessage ();
            getMembers(function (res) {
                let q=[];
                for(i=0;i<res.length;i++) {
                    if(res[i].userStatus!=0) {
                        let md = {
                            id: parseInt(res[i].userId),
                            name: res[i].firstName + " " + res[i].lastName,
                            picture: res[i].profilePictureUrl,
                            email: res[i].userEmail
                        };
                        q.push(md);
                    }
                }

                addmember.setData(q);
                addmember.clear();
                addmember.empty();

                $('#newMessageModal').modal('show');
            });
        });

        $('#newMessagefileIV').on("click",function () {
            $("#newMessageFile").click();
        });

        $('#fileIV').on("click",function () {
            $("#messageFile").click();
        });
        $('#fileIV1').on("click",function () {
            $("#messageFile1").click();
        });

        $("#messageFile").change(imageChange);
        $("#messageFile1").change(attachChange);

        $("#newMessageFile").change(imageChangeNewMessage);



        $('#newMessageText_twemoji').on("keyup input",function (e) {
            if (e.which == 13) {
                $('#newSendMessage').trigger('click');
            }
        });

        $('#message_twemoji').on("keyup input",function (e) {

            if (e.which == 13) {
                $('#sendMessage').trigger('click');
            }else{
                onKeyDownNotEnter();
            }
        });

        $('#sendMessage').on("click",function (event) {
            let receiverId=$('#addMember').attr('data-group');
            if(receiverId===null || receiverId===""){
                return;
            }
            $('.close').trigger("click");

            $("#message").find("div:has(br)").each(function(){
                if($(this).html() === '<br>' || $(this).html() === '<br />'){
                    $(this).remove();
                }
            });
            let message=$('#message').text();
            let mainFileObject=null;
            let file=$("#messageFile").val();
            if(file===null || file===""){
                file=$("#messageFile1").val();
                mainFileObject=$("#messageFile1")[0].files[0];
            }
            else{
                mainFileObject=$("#messageFile")[0].files[0]
            }

            let modmessage=message.replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            if((modmessage === null || modmessage==="") && (file===null || file==="")){
                reset ();
                return;

            }
            if(modmessage != null || modmessage!=""){

                $('#message').val(modmessage);
            }

            let date=moment().format("YYYY-MM-DD");
            let time=moment().format("HH:mm:ss");

            let form=new FormData($('#messageForm')[0]);
            debugger;
            form.append("groupId",receiverId);

            form.append("file",mainFileObject);
            reset();
            if(file===null || file===""){

                sendMessage(form,false,false);
            }
            else {
                sendMessage(form,true,false);
            }


        });

        $('#newSendMessage').on("click",function (event) {
            //$('.close').trigger("click");

            let message=$('#newMessageText').text();
            let modmessage=message.replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            let file=$("#newMessageFile").val();
            if((modmessage == null || modmessage=="") && (file==null || file=="")){
                // resetNewMessage();
                return;

            }
            if(modmessage != null || modmessage!=""){

                $('#newMessageText').val(modmessage);
            }


            //let receiverId=$('#addMember').attr('data-group');
            let date=moment().format("YYYY-MM-DD");
            let time=moment().format("HH:mm:ss");
            let userIds=addmember.getValue();
            if(userIds.length==0){
                return;
            }
            let form=new FormData($('#newMessageForm')[0]);
            for(i=0;i<userIds.length;i++){
                form.append("userId[]",userIds[i]);
            }
            form.append("date",date);
            form.append("time",time);

            sendMessage(form,false,true);
            $('#groups').scrollTop(0);
            //updateGroupList();

        });

        $('#editGroupName').on("click",function (event) {
            $("#groupName").css("border", "1px solid #ccc");
            $("#changeNameModal").modal("show");

        });

        $("#groupName").focus(function () {
            $(this).css("border", "1px solid #ccc");
        });

        $('#changeNameBtn').on("click",function () {
            let groupId=$('#addMember').attr('data-group');
            let groupName=$("#groupName").val();
            groupName=groupName.replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/(<([^>]+)>)/ig,"").replace(/&nbsp;/gi," ").replace(/&nbsp;/gi," ").trim();
            if (groupName==null || groupName==""){
                $('#groupName').css("border","1px solid red");
                toastr.error("Group name is empty");
                return;
            }
            let form=new FormData();
            form.append("groupId",groupId);
            form.append("groupName",groupName);
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/changeGroupName') ?>",
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
                toastr.success("Group name update successful");
                $("#changeNameModal").modal("hide");
                //socket.emit('updateData',groupId);
                /*getGroupList(function (data) {
                 if(data){
                 $('#groups li#group_'+groupId).trigger("click",[{update:true}]);
                 }
                 });*/
            })
        });

        $(".persons").on("mouseenter",".person", function(){
            if($(this).hasClass("active")){
                return;
            }else{
                if(!$(this).hasClass("person-hover")){
                    $(this).addClass('person-hover');
                }
            }

        });
        $(".persons").on("mouseleave",".person", function(){
            if($(this).hasClass("person-hover")){
                $(this).removeClass('person-hover')
            }

        });
        setInterval(updateTime, 60000);
    });


</script>
</body>
</html>