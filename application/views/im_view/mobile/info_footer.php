<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay_progress.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/si.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji-picker.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/mediaelement-and-player.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/perfect-scrollbar.jquery.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji/2/twemoji.min.js?v=").$var ?>"></script>

<script>
    $(document).ready(function () {
        let t=null;
        let name=null;
        let pic=null;
        if(String(localStorage.getItem("T"))=="token"){
            t=localStorage.getItem("_r");
            name=jwt_decode(t).firstName;
            pic=jwt_decode(t).profilePicture;
        }else{
            t=JSON.parse(localStorage.getItem("_r"));
            name=t.firstName;
            pic=t.profilePicture;
        }
        $("#userNameTop").html(name);
        $("#userImageTop").attr("src",pic);

    });
</script>


<script type="text/javascript">
    $(".page-contents").hide();
    toastr.options = {
        "closeButton": true,
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

        //moment.locale('de');
        /*
            window and element resizing besed on user window size
        */
        window.mobileAndTabletcheck = function() {
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        let viewHeight=null;
        let viewWidth=null;

        //window.scrollTo(0,0);
        $(window).bind("resize",function () {
            if(!window.mobileAndTabletcheck()){
                location.href="<?php echo base_url('imuserview/im') ?>";
            }
            //window.scrollTo(0,0);
            viewHeight=$(window).height();
            viewWidth=$(window).width();
            if(viewWidth>995){
                $("body").addClass("controlOverflow");
            }else if($("body").hasClass("controlOverflow")){
                $("body").removeClass("controlOverflow");
            }
            if(viewWidth<990){

                $('#convStart').css("height",61);
                $('.persons').css({"margin-top":0});
                //$(".rightSection").css({'margin-top': '30px'});
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
                $(".leftSection").css({"height":(viewHeight-95)});
                $(".middleSection").css({"height":(viewHeight-95)});
                $(".rightSection").css({"height":(viewHeight-95)});
            }
            else{
                //$(".leftSection").css({"height":590});
                //$(".middleSection").css({"height":590});
                $(".rightSection").css({"display": "inline-block"});
                //$("body").css({"display": "inline-block"});
            }
            $(".chat").css({"height":(viewHeight-170)});
            $('#groups').css({"height":(viewHeight-110)});
            $(".rightSection").css({"height":(viewHeight-50)});
            //$('.personsList').css({"height":(viewHeight-250)});
        }).trigger("resize");

        /*
           --------Global variables
         */
        let chatBox=$('#chatBox');
        let groupBox=$("#groups");
        let videoObjects=[];
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
        let start=0;
        let limit=30;
        let groupLimit=30;
        let groupStart=0;
        let totalGroup=null;
        let friendStart=0;
        let friendLimit=30;
        let totalFriend=null;
        let totalRetivedMessage=0;
        let activeGroupId=parseInt(localStorage.getItem("groupId"));
        let activeGroupmember=null;
        let groupIds=[];
        let time=[];
        let groupImages={};
        let groupType=null;
        let mute=0;
        let block=0;
        let groupObjects=JSON.parse(localStorage.getItem("groupObjects"));
        let scrollPosition=null;
        let notRequested=true;
        let meBlocker=0;
        let messageLoading=false;

        let typing = false;
        let typingTimeout = undefined;
        let lastMessageDate=null;
        let firstmessageDate=null;
        let topMessage=null;
        let addexpendDropdown=null;
        let addMemberexpendDropdown=null;
        let membersId=[];
        let presentTypingDiv=null;
        let messageFormhtml=$("#messageForm").html();

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



        //----------start point-------------------

        if(responce!=null && responce!='' && type==1)
        {
            groupType=parseInt(groupObjects[activeGroupId].groupType);
            mute=parseInt(groupObjects[activeGroupId].mute);
            block=parseInt(groupObjects[activeGroupId].block);
            meBlocker=parseInt(groupObjects[activeGroupId].meBlocker);
            //groupImages[activeGroupId]=groupObjects[activeGroupId].groupImage;
            if(groupType){
                if($("#blockOptions").hasClass("hidden")){
                    $("#blockOptions").removeClass("hidden");
                }
            }else{
                if(!$("#blockOptions").hasClass("hidden")){
                    $("#blockOptions").addClass("hidden");
                }
            }
            if(block){
                $("#messageForm").hide();
                if($("#blockmessage").hasClass("hidden")) {
                    $("#blockmessage").removeClass("hidden");
                }
                if(meBlocker) {
                    if ($("#unblock").hasClass("hidden")) {
                        $("#unblock").removeClass("hidden");
                    }
                    if (!$("#block").hasClass("hidden")) {
                        $("#block").addClass("hidden");
                    }
                }else{
                    if (!$("#unblock").hasClass("hidden")) {
                        $("#unblock").addClass("hidden");
                    }
                    if ($("#block").hasClass("hidden")) {
                        $("#block").removeClass("hidden");
                    }
                }

            }else{
                if(!$("#blockmessage").hasClass("hidden")) {
                    $("#blockmessage").addClass("hidden");
                }
                $("#messageForm").show();
                if(!meBlocker) {
                    if (!$("#unblock").hasClass("hidden")) {
                        $("#unblock").addClass("hidden");
                    }
                    if ($("#block").hasClass("hidden")) {
                        $("#block").removeClass("hidden");
                    }
                }else{
                    if ($("#unblock").hasClass("hidden")) {
                        $("#unblock").removeClass("hidden");
                    }
                    if (!$("#block").hasClass("hidden")) {
                        $("#block").addClass("hidden");
                    }
                }

            }
            if(mute){
                if($("#unmute").hasClass("hidden")){
                    $("#unmute").removeClass("hidden");
                }
                if(!$("#mute").hasClass("hidden")){
                    $("#mute").addClass("hidden");
                }
            }else{
                if(!$("#unmute").hasClass("hidden")){
                    $("#unmute").addClass("hidden");
                }
                if($("#mute").hasClass("hidden")){
                    $("#mute").removeClass("hidden");
                }
            }
            if(groupType==1){
                if (!$('#addMember').hasClass('hidden')) {
                    $('#addMember').addClass('hidden');
                }
                if(!$("#editGroupName").hasClass('hidden')){
                    $("#editGroupName").addClass('hidden');
                }
                if(!$("#leaveGroup").hasClass('hidden')){
                    $("#leaveGroup").addClass('hidden');
                }
            }else{
                if ($('#addMember').hasClass('hidden')) {
                    $('#addMember').removeClass('hidden');
                }
                if($("#editGroupName").hasClass('hidden')){
                    $("#editGroupName").removeClass('hidden');
                }
                if($("#leaveGroup").hasClass('hidden')){
                    $("#leaveGroup").removeClass('hidden');
                }
            }
            if(!groupType){
                getGroupMembers(activeGroupId);
            }
            getGroupFiles(activeGroupId);
            //printGroupMembers(groupObjects[activeGroupId].members, groupObjects[activeGroupId].meCreator, activeGroupId);
            printGroupInfo(activeGroupId,groupObjects[activeGroupId].groupName);
            //socket.emit("joinRoom",activeGroupId);
            $(".page-contents").show();

        }else {
            location.href="<?php echo base_url("immobile/logout")  ?>";
        }


        // --------- Global Functions--------------



        function initVideo(id){

            $("#"+id).mediaelementplayer({
                // Do not forget to put a final slash (/)
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                // this will allow the CDN to use Flash without restrictions
                // (by default, this is set as `sameDomain`)
                shimScriptAccess: 'always',

                success: function (player, node) {


                    $(player).closest('.mejs__container').find("div.mejs__overlay-button").css({"height":"110px"});
                    $(player).closest('.mejs__container').find("div.mejs__controls").css({"background":"#32cdc7"});
                    // $(player).closest('.mejs__container').find("div.mejs__controls").css({"background":"transparent"});
                    $(player).closest('.mejs__container').css({"background":"transparent"});



                }
            });


        }

        function getFileIcon(type) {
            let defaultIcon = "fas fa-file";

            let iconArray = [
                {type: "text", icon: "fas fa-file-alt"}, {type: "txt", icon: "fas fa-file-alt"},
                {type: "video", icon: "fas fa-file-video"},
                {type: "audio", icon: "fas fa-file-audio"},
                {type: "pdf", icon: "fas fa-file-pdf"},
                {type: "doc", icon: "fas fa-file-word"}, {type: "docx", icon: "fas fa-file-word"},
                {type: "ppt", icon: "fas fa-file-powerpoint"}, {type: "pptx", icon: "fas fa-file-powerpoint"},
                {type: "xls", icon: "fas fa-file-excel"}, {type: "xlsx", icon: "fas fa-file-excel"},
                {type: "rar", icon: "fas fa-file-archive"}, {type: "zip", icon: "fas fa-file-archive"},
                {type: "csv", icon: "fas fa-file-csv"},
            ];
            for (let i = 0; i < iconArray.length; i++) {
                if (iconArray[i].type == type) {
                    return iconArray[i].icon;
                }
            }
            return defaultIcon;
        }



        function initAudio(id){

            $("#"+id).mediaelementplayer({
                // Do not forget to put a final slash (/)
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                // this will allow the CDN to use Flash without restrictions
                // (by default, this is set as `sameDomain`)
                shimScriptAccess: 'always',
                success: function (player, node) {


                    $(player).closest('.mejs__container').find("div.mejs__controls").css({"border-radius":"50px"});
                    $(player).closest('.mejs__container').css({"background":"transparent"});
                    $(player).closest('.mejs__container').find("div.mejs__mediaelement").css({"border-radius":"50px"});
                    $(player).closest('.mejs__container').find("div.mejs__mediaelement").css({"background-color":"transparent"});

                }
            });

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
            groupStart+=groupLimit;
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
            groupObjects[group.groupId]=group;
            time[group.groupId]=group.lastActive;
            if(group.pendingMessage>0){
                html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_"+group.groupId+"' data-type=\""+group.groupType+"\" data-block=\""+group.block+"\" data-mute=\""+group.mute+"\" data-group=\""+group.groupId+"\">";
            }else {
                html += " <li class=\"person\" data-chat=\"person1\" id='group_"+group.groupId+"' data-type=\""+group.groupType+"\" data-block=\""+group.block+"\" data-mute=\""+group.mute+"\" data-group=\""+group.groupId+"\">";
            }

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
            if(group.mute){
                html += "                        <div style='' id='mute_"+group.groupId+"' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
            }else{
                html += "                        <div style='' id='mute_"+group.groupId+"' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
            }


            html += "                    <\/li>";

            $("#groups").prepend(html);
        }

        // this function prints group list on the left side
        function printGroupListAppend(groups) {
            let html="";
            groupIds=[];

            time={};
            for(let i=0;i<groups.length;i++){
                groupObjects[groups[i].groupId]=groups[i];
                groupIds.push(groups[i].groupId);
                time[groups[i].groupId]=groups[i].lastActive;
                if(groups[i].pendingMessage>0) {
                    html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }else{
                    html += " <li class=\"person \" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }
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
                if(groups[i].mute){
                    html += "                        <div style='' id='mute_"+groups[i].groupId+"' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }else{
                    html += "                        <div style='' id='mute_"+groups[i].groupId+"' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }

                html += "                    <\/li>";
            }
            $("#groups").append(html);
        }
        function printGroupList(groups){
            let html="";
            groupIds=[];

            time={};
            for(let i=0;i<groups.length;i++){
                groupIds.push(groups[i].groupId);
                groupObjects[groups[i].groupId]=groups[i];
                time[groups[i].groupId]=groups[i].lastActive;
                if(groups[i].pendingMessage>0) {
                    html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }else{
                    html += " <li class=\"person \" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }
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
                if(groups[i].mute){
                    html += "                        <div style='' id='mute_"+groups[i].groupId+"' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }else{
                    html += "                        <div style='' id='mute_"+groups[i].groupId+"' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }

                html += "                    <\/li>";
            }
            $("#groups").html(html);
        }

        //This function is used to get the group list
        function getGroupList(callback) {
            let url ="<?php echo base_url('imApi/getGroups?limit=') ?>"+groupLimit+"&start=0";
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
                        location.href="<?php echo base_url('imuserview/logout') ?>";
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
            if(!members.length){
                $("#groupMembers").css({"padding":"0px"});
            }else{
                $("#groupMembers").css({"padding":"10px"});
            }
            for (i=0;i<members.length;i++){
                membersId.push(members[i].userId);
                html += "<li class=\"person\"  style=\"padding-top: 5px;padding-bottom: 0px;height:50px;cursor: default;\">";
                if(members[i].active===1){
                    html += "                        <img class='memberStatus memberActive' id='member_"+members[i].userId+"' src=\""+members[i].profilePictureUrl+"\" alt=\"\" \/>";
                }else {
                    html += "                        <img class='memberStatus' id='member_"+members[i].userId+"' src=\""+members[i].profilePictureUrl+"\" alt=\"\" \/>";
                }
                html += "                        <span  class=\"name\"><div style='margin-top: 8px'>"+members[i].firstName+" "+members[i].lastName +"</div><\/span>";
                if(parseInt(groupType)===0){
                    html += "                        <span class=\"time\" style='padding-top: 5px' ><a href=\"#\" data-group=\""+groupId+"\" data-member=\""+members[i].userId+"\" class=\"btn-danger btn-extra-small btnMemberDelete\"><i class=\"fa fa-trash\"><\/i><\/a><\/span>";
                }
                html += "                    <\/li>";
            }
            $('#groupMembers').html(html);

        }
        function printGroupFiles(groupFiles){
            if(groupFiles.length>0){
                if($("#attachment").hasClass("hidden")){
                    $("#attachment").removeClass("hidden");
                }
            }
            else{
                if(!$("#attachment").hasClass("hidden")){
                    $("#attachment").addClass("hidden");
                }
            }

            let strVar="";
            for(let i=0;i<groupFiles.length;i++){
                strVar += "<li>";
                strVar += "                        <i class='"+getFileIcon(groupFiles[i].type)+"'><\/i>";
                strVar += "                        <span>";
                strVar += "                            <a  target='_blank'style=\"color: #75aef3; word-break: break-all;\" href='"+groupFiles[i].message+"'>";
                strVar +=groupFiles[i].fileName;
                strVar += "                            <\/a>";
                strVar += "                        <\/span>";
                strVar += "                    <\/li>";
            }
            $("#attachmentList").html(strVar);
        }
        function printGroupImages(groupImages){
            if(groupImages.length>0){
                if($("#imageAttachment").hasClass("hidden")){
                    $("#imageAttachment").removeClass("hidden");
                }
            }
            else{
                if(!$("#imageAttachment").hasClass("hidden")){
                    $("#imageAttachment").addClass("hidden");
                }
            }

            let strVar="";
            for(let i=0;i<groupImages.length;i++){
                strVar += "<div class=\"col-md-4 col-xl-4 col-xs-4 col-sm-4 pad-5\">";
                strVar += "                            <a style='height: 100px;width: 100px' href='"+groupImages[i].message+"' class=\"ol-hover hover-5 ol-lightbox\">";
                strVar += "                                <img style='height: 100px;width: 100px'  src='"+groupImages[i].message+"' alt=\"image hover\">";
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

                printGroupMembers(members,meCreator,groupId);

            });

        }

        //This function is used to print the group name and three member image on the right side top
        function printGroupInfo(groupId,groupName){

            (function () {
                let c = document.createElement("canvas");
                let ctx = c.getContext("2d");
                ctx.canvas.width = 500;
                ctx.canvas.height = 500;
                ctx.fillStyle = "white";
                ctx.fillRect(0, 0, c.width, c.height);
                ctx.moveTo(0, 0);

                if (groupObjects[groupId].groupImage.length === 1) {
                    let html = "<img class=\"img-responsive img-circle\" style=\"width: 50px; height: 50px;border-radius: 50%\" src=\"" + groupObjects[groupId].groupImage[0] + "\" >";
                    $('.rightGroupImages').html(html);
                } else if (groupObjects[groupId].groupImage.length === 2) {
                    let imageObj1 = new Image();
                    imageObj1.src = groupObjects[groupId].groupImage[0];
                    imageObj1.onload = (function (groupId) {
                        return function () {
                            ctx.drawImage(imageObj1, 0, 0, 240, 500);
                            let imageObj2 = new Image();
                            imageObj2.src = groupObjects[groupId].groupImage[1];
                            imageObj2.onload = (function (groupId,cb) {
                                return function () {
                                    ctx.drawImage(imageObj2, 260, 0, 250, 500);

                                    let html = "<img class=\"img-responsive img-circle\" style=\"width: 50px; height: 50px;border-radius: 50%\" src=\"" + c.toDataURL("image/png") + "\" >";
                                    $('.rightGroupImages').html(html);
                                }
                            })(groupId);
                        }
                    })(groupId);

                } else if (groupObjects[groupId].groupImage.length === 3) {
                    let imageObj1 = new Image();
                    imageObj1.src = groupObjects[groupId].groupImage[0];
                    imageObj1.onload = (function (groupId) {
                        return function () {
                            ctx.drawImage(imageObj1, 0, 0, 260,500);
                            let imageObj2 = new Image();
                            imageObj2.src = groupObjects[groupId].groupImage[1];
                            imageObj2.onload = (function (groupId) {
                                return function () {
                                    ctx.drawImage(imageObj2, 280, 0, 250, 240);
                                    let imageObj3 = new Image();
                                    imageObj3.src = groupObjects[groupId].groupImage[2];
                                    imageObj3.onload = (function (groupId, cb) {
                                        return function () {
                                            ctx.drawImage(imageObj3, 280, 260, 240, 240);
                                            let html = "<img class=\"img-responsive img-circle\" style=\"width: 50px; height: 50px;border-radius: 50%\" src=\"" + c.toDataURL("image/png") + "\" >";
                                            $('.rightGroupImages').html(html);
                                        }
                                    })(groupId);
                                }
                            })(groupId);
                        }
                    })(groupId);
                }
            })();

            //let image = localStorage.getItem("g_image");
           // let html = "<img class=\"img-responsive img-circle\" style=\"width: 50px; height: 50px;border-radius: 50%\" src=\"" + image + "\" >";



            //let personName = groupObjects[activeGroupId].groupName;
            $('.be-use-name').html(groupName);
            $clamp($('.be-use-name')[0], { clamp: 2, useNativeClamp: false });
        }

        function clampData() {
            $('.clamp-desc').each(function (index,element) {
                $clamp(element, {clamp: 3, useNativeClamp: false});
            });
            $('.clamp-title').each(function (index,element) {
                $clamp(element, {clamp: 3, useNativeClamp: false});
            });
        }
        //This function is used to  get friend list of user
        function getMembers(callback) {   // get friends list
            resetFriendStart();
            let url= "<?php echo base_url('imuser/friendList?start=') ?>"+friendStart+"&limit="+friendLimit;
            if(ID_BASED){
                url="<?php echo base_url('imuser/friendList?start=') ?>"+friendStart+"&limit="+friendLimit+"&userId="+userId;
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
                "dataType" : 'json'
            };
            $.ajax(settings).done(function (response) {

                let data=response.response.friends;
                totalFriend=response.response.total;
                callback(data);
            });
        }




        function getGroupFiles(groupId){
            if (!$("#imageAttachment").hasClass("hidden")) {
                $("#imageAttachment").addClass("hidden");
            }
            if (!$("#attachment").hasClass("hidden")) {
                $("#attachment").addClass("hidden");
            }
            $("#ImageAttachmentList").html("");
            $("#attachmentList").html("");
            let url = "<?php echo base_url('imApi/getGroupFiles?groupId=') ?>" + groupId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/getGroupFiles?groupId=') ?>" + groupId + "&userId=" + userId;
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
        //$('#groupMembers').perfectScrollbar({suppressScrollX:true});
        $('#rightSection').perfectScrollbar({suppressScrollX:true});
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
            let value=this.getRawValue().trim();
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
            let value=this.getRawValue().trim();
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








        $('#groupMembers').on("click",".btnMemberDelete",function (e) {
            let groupId = $(this).attr('data-group');
            let memberId=$(this).attr('data-member');
            let form=new FormData();

            form.append("groupId",groupId);
            form.append("memberId",memberId);
            form.append("userId",userId);
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
                "data":form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
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
                printGroupInfo(groupId,res.response.groupInfo.groupName);
                toastr.info("Member deleted");
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
            let groupId= activeGroupId;

            if(userIds.length>0) {
                let form = new FormData();
                for (i = 0; i < userIds.length; i++) {
                    form.append("memberId[]", userIds[i]);
                }
                form.append("groupId", groupId);
                form.append("userId",userId);
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
                    "data": form,
                    "error": function (e) {
                        let err = JSON.parse(e.responseText);
                        toastr.error(err.response);
                    },
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
                    printGroupInfo(groupId,res.response.groupInfo.groupName);
                    newMemberInput.clear();
                    toastr.info("member add successful");
                    $('#addNewMemberModal').modal('hide');
                    // getGroupMembers(groupId);

                });

            }
        });



        $('#editGroupName').on("click",function (event) {
            $("#groupName").css("border", "1px solid #ccc");
            $("#changeNameModal").modal("show");

        });

        $("#groupName").focus(function () {
            $(this).css("border", "1px solid #ccc");
        });

        $('#changeNameBtn').on("click",function () {
            let groupId=activeGroupId;
            let groupName=$("#groupName").val();
            groupName=(groupName).trim();
            if (groupName==null || groupName==""){
                $('#groupName').css("border","1px solid red");
                toastr.error("Group name is empty");
                return;
            }
            let form=new FormData();
            form.append("groupId",groupId);
            form.append("groupName",groupName);
            form.append("userId",userId);
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
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };
            $.ajax(settings).done(function (response) {
                toastr.info("Group name update successful");
                $("#changeNameModal").modal("hide");
                groupObjects[groupId].groupName=groupName;
                localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
                $("#groupName").val("");
            });
        });

        $("#block").on("click",function () {
            let groupId =activeGroupId;
            let form = new FormData();
            form.append("groupId",groupId);
            form.append("userId",userId);
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/blockGroup') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };

            $.ajax(settings).done(function (response) {
                toastr.info("Block successful");
            });
        });
        $("#unblock").on("click",function () {
            let groupId =activeGroupId;
            let form = new FormData();
            form.append("groupId",groupId);
            form.append("userId",userId);
            let settings = {
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
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };

            $.ajax(settings).done(function (response) {
                toastr.info("Unblock successful");
            });
        });
        $("#mute").on("click",function () {
            let groupId =activeGroupId;
            let form = new FormData();
            form.append("groupId",groupId);
            form.append("userId",userId);
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/muteGroup') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };

            $.ajax(settings).done(function (response) {
                toastr.info("Message muted successful");
            });
        });
        $("#unmute").on("click",function () {
            let groupId =activeGroupId;
            let form = new FormData();
            form.append("groupId",groupId);
            form.append("userId",userId);
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/unmuteGroup') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };

            $.ajax(settings).done(function (response) {
                toastr.info("Unmuting successful");
            });
        });


        $("#leaveGroup").on("click",function () {
            let form = new FormData();
            form.append("groupId", activeGroupId);
            form.append("userId",userId);
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/leaveGroup') ?>",
                "method": "POST",
                "headers": {
                    "Authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "Cache-Control": "no-cache",

                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form,
                "error": function (e) {
                    let err = JSON.parse(e.responseText);
                    toastr.error(err.response);
                },
            };

            $.ajax(settings).done(function (response) {
                toastr.info("You successfully leave the group.");
            });
        });

        $("#showGroupInfo").on("click",function () {
            localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            location.href="<?php echo base_url('mobile/info') ?>";
        });


//------------------  Web sockt section ------------------------------
        socket.on("getFetchOnReconnect",function (data) {

            //group section
            let groups=data.groups;
            for (let i = (groups.length-1); i >=0 ; i--){
                groupObjects[groups[i].groupId]=groups[i];
                if(activeGroupId===parseInt(groups[i].groupId)){

                    let meCreator= groups[i].meCreator;
                    printGroupMembers(groups[i].members,meCreator,groups[i].groupId);
                    groupImages[data.groupId]=groups[i].groupImage;
                    printGroupInfo(groups[i].groupId,groupImages,groups[i].groupName);

                }
            }
                if(activeGroupId) {
                    let activeGroupObject = groupObjects[activeGroupId];


                    //block part
                    if (activeGroupObject.block) {
                        if (parseInt(activeGroupObject.meBlocker)) {
                            if (!$("#block").hasClass("hidden")) {
                                $("#block").addClass("hidden");
                            }
                            if ($("#unblock").hasClass("hidden")) {
                                $("#unblock").removeClass("hidden");
                            }

                        } else {
                            if ($("#block").hasClass("hidden")) {
                                $("#block").removeClass("hidden");
                            }
                            if (!$("#unblock").hasClass("hidden")) {
                                $("#unblock").addClass("hidden");
                            }
                        }

                    } else {
                        if (!parseInt(activeGroupObject.meBlocker)) {
                            if ($("#block").hasClass("hidden")) {
                                $("#block").removeClass("hidden");
                            }
                            if (!$("#unblock").hasClass("hidden")) {
                                $("#unblock").addClass("hidden");
                            }
                        }
                    }
                    //mute Part
                    if (!activeGroupObject.mute) {
                        if ($("#mute").hasClass("hidden")) {
                            $("#mute").removeClass("hidden");
                        }
                        if (!$("#unmute").hasClass("hidden")) {
                            $("#unmute").addClass("hidden");
                        }
                        if (!$("#mute_" + activeGroupObject.groupId).hasClass("hidden")) {
                            $("#mute_" + activeGroupObject.groupId).addClass("hidden");
                        }
                    } else {
                        if (!$("#mute").hasClass("hidden")) {
                            $("#mute").addClass("hidden");
                        }
                        if ($("#unmute").hasClass("hidden")) {
                            $("#unmute").removeClass("hidden");
                        }
                        if ($("#mute_" + activeGroupObject.groupId).hasClass("hidden")) {
                            $("#mute_" + activeGroupObject.groupId).removeClass("hidden");
                        }
                    }
                }
            let difference = data.removedGroupIds;
            let leaveThisGroup=false;
            for (let i = 0; i < difference.length; i++) {
                if (activeGroupId == difference[i]) {

                    leaveThisGroup=true;

                }
                delete groupObjects[difference[i]];
            }
            if(leaveThisGroup){
                location.href = "<?php echo base_url('immobile/im') ?>";
            }

            localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
        });

        socket.on("reconnect",function () {
            socket.emit("register",JSON.stringify(tokenData));
            let objectGroupIds = [];
            $.each(groupObjects, function (key, value) {
                let loopGroupObject = value;
                objectGroupIds.push(parseInt(loopGroupObject.groupId));
            });
            let data = {
                _r: token,
                userId: userId,
                activeGroupId: activeGroupId, //current active group id
               // lastMessageId: LastMessageId, // current active group last massage id
                domGroups: objectGroupIds, // all fetched group ids from server
                sId: sessionId
            };
            if(sessionId==null){
                setTimeout(function(){
                    data.sId=sessionId;
                    socket.emit("fetchOnReconnect", data);
                },3000);
            }else{
                socket.emit("fetchOnReconnect", data);
            }
        });
        socket.on("updateGroupNameData",function (res) {
            let data={
                "groupId":parseInt(res.groupId),
                "groupName":res.groupName
            };
            let currentGroupId = parseInt(activeGroupId);
            if(currentGroupId===data.groupId ){
                // group is present and user is currently in this group
                if(currentGroupId===data.groupId){
                    $("#groupName_"+data.groupId).html("<div>"+data.groupName+"</div>");
                    $('.be-use-name').html(data.groupName);
                    $(".UserNames").html(data.groupName);
                    $clamp($('.be-use-name')[0], { clamp: 2, useNativeClamp: false });
                }
                // group is present but user currently not chatting on this group
                else{
                    $("#groupName_"+data.groupId).html("<div>"+data.groupName+"</div>");
                }
            }

        });

        socket.on("addNewMember",function (res) {
            let data={
                "groupId":parseInt(res.groupId),
                "group":res.groupInfo,
                "members":res.memberList
            };

            let currentGroupId = parseInt(activeGroupId);
            groupObjects[data.groupId]=data.group;

            localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            // check group is present but user is not chatting on this group
            if(parseInt(currentGroupId)===data.groupId){
                //groupImages[currentGroupId]=data.group.groupImage;
                printGroupInfo(currentGroupId,data.group.groupName);

            }

        });

        socket.on("deleteAMember",function (res) {

            let data={
                "groupId":parseInt(res.groupId),
                "group":res.groupInfo,
                "members":res.memberList,
                "removeGroup":res.removeGroup
            };

            let currentGroupId = parseInt(activeGroupId);
            if(currentGroupId===data.groupId && data.removeGroup===true){
                delete groupObjects[data.groupId];
                localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
                localStorage.removeItem("groupId");
                location.href="<?php echo base_url('immobile/im') ?>";
            }
            if(currentGroupId===data.groupId && data.removeGroup===false){

                groupObjects[data.groupId]=data.group;
                //groupImages[currentGroupId]=data.group.groupImage;
                printGroupInfo(currentGroupId,data.group.groupName);
                localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            }
            if(data.removeGroup===true){
                delete groupObjects[data.group];
                localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            }


        });



        socket.on("updateStatus",function (res) {

            let data=res;
            if(parseInt(data.status)===1){
                if(!$("#member_"+data.userId).hasClass("memberActive")){
                    $("#member_"+data.userId).addClass("memberActive");
                }
                if(!$(".auth_"+data.userId).hasClass("memberActive")){
                    $(".auth_"+data.userId).addClass("memberActive");
                }
            }else{
                if($("#member_"+data.userId).hasClass("memberActive")){
                    $("#member_"+data.userId).removeClass("memberActive");
                }
                if($(".auth_"+data.userId).hasClass("memberActive")){
                    $(".auth_"+data.userId).removeClass("memberActive");
                }
            }

        });

        socket.on("updateStatusOnReconnect",function (res) {
            let data=res;
            for(let i=0;i<data.friendsIds.length;i++){
                if(!$("#member_"+data.friendsIds[i].userId).hasClass("memberActive")){
                    $("#member_"+data.friendsIds[i].userId).addClass("memberActive");
                }
                if(!$(".auth_"+data.friendsIds[i].userId).hasClass("memberActive")){
                    $(".auth_"+data.friendsIds[i].userId).addClass("memberActive");
                }
            }

        });

        socket.on("blockStatus",function (data) {

            if(activeGroupId===data.groupId){
                if(data.block){
                    if(parseInt(userId)===parseInt(data.userId)) {
                        if (!$("#block").hasClass("hidden")) {
                            $("#block").addClass("hidden");
                        }
                        if ($("#unblock").hasClass("hidden")) {
                            $("#unblock").removeClass("hidden");
                        }

                    }

                }else{
                    if(parseInt(userId)===parseInt(data.userId)) {
                        if ($("#block").hasClass("hidden")) {
                            $("#block").removeClass("hidden");
                        }
                        if (!$("#unblock").hasClass("hidden")) {
                            $("#unblock").addClass("hidden");
                        }
                    }

                }
                if(data.fullUnblock){
                    if($("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").removeClass("hidden");
                    }

                    $("#messageForm").hide();
                }else{
                    if(!$("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").addClass("hidden");
                    }
                    $("#messageForm").show();
                }
            }
            groupObjects[data.groupId]=data.blockGroup;
            localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            block=data.block;

        });

        socket.on("muteStatus",function (data) {
            if(activeGroupId===data.groupId){
                if(!data.mute){
                    if($("#mute").hasClass("hidden")){
                        $("#mute").removeClass("hidden");
                    }
                    if(!$("#unmute").hasClass("hidden")){
                        $("#unmute").addClass("hidden");
                    }
                    if(!$("#mute_"+data.groupId).hasClass("hidden")){
                        $("#mute_"+data.groupId).addClass("hidden");
                    }
                }else{
                    if(!$("#mute").hasClass("hidden")){
                        $("#mute").addClass("hidden");
                    }
                    if($("#unmute").hasClass("hidden")){
                        $("#unmute").removeClass("hidden");
                    }
                    if($("#mute_"+data.groupId).hasClass("hidden")){
                        $("#mute_"+data.groupId).removeClass("hidden");
                    }
                }

            }
            groupObjects[data.groupId].mute=data.mute;
            localStorage.setItem("groupObjects",JSON.stringify(groupObjects));
            mute=data.mute;
        });

//------------------ End of web socket section -------------------------

       // setInterval(updateTime, 60000);
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