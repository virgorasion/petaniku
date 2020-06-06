<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/loadingoverlay_progress.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/si.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/mediaelement-and-player.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/perfect-scrollbar.jquery.min.js?v=").$var ?>"></script>
<script src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji/2/twemoji.min.js?v=").$var ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/im/newTheme/assets/js/twemoji-picker.js?v=").$var ?>"></script>

<script>
    $(document).ready(function () {
        let t = null;
        let name = null;
        let pic = null;
        if (String(localStorage.getItem("T")) == "token") {
            t = localStorage.getItem("_r");
            name = jwt_decode(t).firstName;
            pic = jwt_decode(t).profilePicture;
        } else {
            t = JSON.parse(localStorage.getItem("_r"));
            name = t.firstName;
            pic = t.profilePicture;
        }
        $("#userNameTop").html(name);
        $("#userImageTop").attr("src", pic);

    });
</script>


<script type="text/javascript">

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-left",
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


        window.mobileAndTabletcheck = function () {
            let check = false;
            (function (a) {
                if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
            })(navigator.userAgent || navigator.vendor || window.opera);
            return check;
        };
        let viewHeight = null;
        let viewWidth = null;


        $(window).bind("resize", function () {
            if (!window.mobileAndTabletcheck()) {
                location.href = "<?php echo base_url('imuserview/im') ?>";
            }

            viewHeight = $(window).height();
            viewWidth = $(window).width();
            if (viewWidth > 995) {
                $("body").addClass("controlOverflow");
            } else if ($("body").hasClass("controlOverflow")) {
                $("body").removeClass("controlOverflow");
            }
            if (viewWidth < 990) {

                $('#convStart').css("height", 61);
                $('.persons').css({"margin-top": 0});
                $(".rightSection").css({'margin-top': '30px'});
                $(".groupNameDiv").css({"padding-bottom": '32px'});
                $('.video').css({'margin-left': '-34px'});

            }
            else {
                $(".rightSection").css({'margin-top': '0px'});
                $(".groupNameDiv").css({"padding-bottom": '21px'});
                $('.video').css({'margin-left': '0px'});
            }

            if (viewWidth < 990) {
                $(".leftSection").css({"height": (viewHeight - 95)});
                //$(".middleSection").css({"height":(viewHeight-95)});
                $(".rightSection").css({"height": (viewHeight - 95)});
            }
            else {
                //$(".leftSection").css({"height": 590});
                $(".middleSection").css({"display": "inline-block"});
                //$(".rightSection").css({"height": 590});
                //$("body").css({"height": 590});
            }
            $(".chat").css({"height": (viewHeight - 160)});
            $('#groups').css({"height": (viewHeight - 110)});
            $(".rightSection").css({"height": (viewHeight - 50)});

        }).trigger("resize");

        /*
           --------Global variables
         */
        twemoji.base = "<?php echo base_url("assets/im/newTheme/assets/js/twemoji/2/") ?>";
        let chatBox = $('#chatBox');
        let searchChatBox=$("#searchChatBox");
        let searchResultBox=$("#searchResultBox");
        let groupBox = $("#groups");
        let videoObjects = [];
        let responce = null;
        let userId = null;
        let type = 1;
        let ID_BASED = false;
        if (String(localStorage.getItem("T")) == "token") {
            responce = localStorage.getItem("_r");
            userId = jwt_decode(responce).userId;
            type = jwt_decode(responce).userType;
        } else {
            responce = JSON.parse(localStorage.getItem("_r"));
            userId = responce.userId;
            ID_BASED = true;
        }
        let start = 0;
        let limit = 30;
        let groupLimit = 30;
        let groupStart = 0;
        let totalGroup = null;
        let friendStart = 0;
        let friendLimit = 30;
        let totalFriend = null;
        let totalRetivedMessage = 0;
        let activeGroupId = parseInt(localStorage.getItem("groupId"));
        let activeGroupmember = null;
        let groupIds = [];
        let time = [];
        let groupImages = {};
        let groupType = null;
        let mute = 0;
        let block = 0;
        let groupObjects = JSON.parse(localStorage.getItem("groupObjects"));
        let scrollPosition = null;
        let notRequested = true;
        let meBlocker = 0;
        let messageLoading = false;

        let typing = false;
        let typingTimeout = undefined;
        let lastMessageDate = null;
        let LastMessageId = null;
        let firstmessageDate = null;
        let topMessage = null;
        let addexpendDropdown = null;
        let addMemberexpendDropdown = null;
        let membersId = [];
        let presentTypingDiv = null;
        let messageFormhtml = $("#messageForm").html();
        let messageTyping=true;
        let max_upload_size=20971520; //20mb

        let messageBox=null;
        let listenType = (navigator.userAgent.toLowerCase().indexOf("edge") != -1) ? 'mouseup' : 'click';

        let magicSuggestOption = {
            placeholder: 'Search for members...',
            maxSelection: null,
            allowFreeEntries: false,
            // data: q,
            renderer: function (data) {
                return '<div style="padding: 5px; overflow:hidden;">' +
                    '<div style="float: left;"><img style="width: 25px;height: 25px" src="' + data.picture + '" /></div>' +
                    '<div style="float: left; margin-left: 5px">' +
                    '<div style="font-weight: bold; color: #333; font-size: 12px; line-height: 11px">' + data.name + '</div>' +
                    '<div style="color: #999; font-size: 9px">' + data.email + '</div>' +
                    '</div>' +
                    '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
            }
        };
        let addmember = $('#addMemberInput').magicSuggest(magicSuggestOption);
        let newMemberInput = $('#addNewMemberInput').magicSuggest(magicSuggestOption);
        /*let momentOptions={
            sameDay: '[Today at] h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: '[Yesterday at] h:mm a',
            lastWeek: '[Last] dddd [at] h:mm a',
            sameElse: 'MMM DD, YYYY h:mm a'
        };*/
        let momentOptions = {
            sameDay: '[Today at] h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: 'MMMM DD, YYYY h:mm a',
            lastWeek: 'MMMM DD, YYYY h:mm a',
            sameElse: 'MMMM DD, YYYY h:mm a'
        };
        let momentOptions2 = {
            sameDay: 'h:mm a',
            nextDay: '[Tomorrow at] at h:mm a',
            nextWeek: 'dddd [at] h:mm a',
            lastDay: '[Yesterday at] h:mm a',
            lastWeek: '[Last] dddd [at] h:mm a',
            sameElse: 'MMM DD, YYYY h:mm a'
        };
        let momentOptions3 = {
            sameDay: 'h:mm a',
            nextDay: '[Tomorrow] h:mm a',
            nextWeek: 'dddd h:mm a',
            lastDay: '[Yesterday] h:mm a',
            lastWeek: '[Last] dddd h:mm a',
            sameElse: 'MMMM DD, YYYY h:mm a'
        };




        //$(".rightSection").perfectScrollbar();
        let sendNewMessageSettings ={
            init: "Your message.....",
            size: '30px',
            icon: 'grinning',
            iconSize: '25px',
            height: '90px',
            width: '100%',
            border: '0',
            category: ['smile', 'cherry-blossom', 'video-game', 'oncoming-automobile', 'symbols'],
            categorySize: '20px',
            pickerPosition: 'bottom',
            pickerHeight: '150px',
            pickerWidth: '100%'
        };


        let sendMessageSettings = {
            init: "Your message.....",
            size: '30px',
            icon: 'grinning',
            iconSize: '25px',
            height: '50px',
            width: '100%',
            border: '0',
            category: ['smile', 'cherry-blossom', 'video-game', 'oncoming-automobile', 'symbols'],
            categorySize: '20px',
            pickerPosition: 'top',
            pickerHeight: '150px',
            pickerWidth: '100%'
        };


        //----------start point-------------------
        init_twemoji();
        if (responce != null && responce != '' && type == 1) {
            if(!activeGroupId){
                location.href = "<?php echo base_url("immobile/im")  ?>";
            }
            getMessage(activeGroupId, start, limit);
            socket.emit("joinRoom", activeGroupId);
            let personName = groupObjects[activeGroupId].groupName;
            $('.UserNames').html(personName);
            groupType = parseInt(groupObjects[activeGroupId].groupType);
            mute = parseInt(groupObjects[activeGroupId].mute);
            block = parseInt(groupObjects[activeGroupId].block);
            meBlocker = parseInt(groupObjects[activeGroupId].meBlocker);

            if (block) {
                $("#messageForm").hide();
                if ($("#blockmessage").hasClass("hidden")) {
                    $("#blockmessage").removeClass("hidden");
                }

            } else {
                if (!$("#blockmessage").hasClass("hidden")) {
                    $("#blockmessage").addClass("hidden");
                }
                $("#messageForm").show();

            }
        }

        else {
            location.href = "<?php echo base_url("immobile/logout")  ?>";
        }


        // --------- Global Functions--------------


        function typingTimeoutFunction() {
            let data = {
                userId: userId,
                groupId: activeGroupId
            };

            typing = false;
            socket.emit("notTyping", JSON.stringify(data));
        }

        function onKeyDownNotEnter() {
            let groupId = activeGroupId;
            let data = {
                userId: userId,
                groupId: groupId
            };
            if (!typing) {
                typing = true;
                socket.emit("typing", JSON.stringify(data));
                typingTimeout = setTimeout(typingTimeoutFunction, 3000);
            } else {
                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(typingTimeoutFunction, 3000);
            }

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

        // this function used to clear new message div
        function resetNewMessage() {
            $("#newMessageFile").replaceWith($("#newMessageFile").val('').clone(true));
            $('#newMessagefileIV').attr("src", "<?php echo base_url('assets/im/img/i-camera.png')?>");

            $('.twemoji-textarea').html("");
            $('.twemoji-textarea-duplicate').html("");
            $('#newMessageText').text("");
            $('#newMessageText').val("");
            $('.close').trigger("click");

        }

        // this function used to clear message div
        function reset() {
            $("#messageFile").replaceWith($("#messageFile").val('').clone(true));
            $('#fileIV').attr("src", "<?php echo base_url('assets/im/img/i-camera.png')?>");

            $("#messageFile1").replaceWith($("#messageFile1").val('').clone(true));
            $('#fileIV1').attr("src", "<?php echo base_url('assets/im/img/fileAttach.png')?>");

            setTimeout(function () {
                $('.twemoji-textarea').html("");
                $('.twemoji-textarea-duplicate').html("");
            },100);
            $('#message').text("");
            $('#message').val("");
            if(messageBox){
                messageBox.resetTwEmoji();
            }

        }

        // function for checking image/video type and size before uploading
        function imageChange(event) {
            let file = this.files[0];
            let imagefile = file.type;
            let size = file.size;
            let match = ["image/jpeg", "image/png", "image/jpg", "video/3gpp", "video/mp4", "video/3gp", "audio/mp3"];
            if (size > max_upload_size) {
                toastr.error("Max limit 20Mb exceeded");
                return;
            }

            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]) || (imagefile == match[4]) || (imagefile == match[5]) || (imagefile == match[6]))) {
                toastr.error("This type of file is not allowed");
                return false;
            } else {
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
        function getFileExtension(filename) {
            return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2).toLowerCase();
        }

        function attachChange(event) {
            let file = this.files[0];
            let attachFile = getFileExtension(file.name);
            let matched = false;
            let size = file.size;
            let match = ["txt","rar","zip","xlsx","xls","ppt","docx","pptx","text","doc","ppt","wma","mp3","mp4","pdf","3gpp","3gp","png","jpg","jpeg","csv"];
            if (size > max_upload_size) {
                toastr.error("Max limit 20Mb exceeded");
                return false;
            }

            for (let i = 0; i < match.length; i++) {
                if (attachFile === match[i]) {
                    matched = true;
                }
            }
            if (matched) {
                $('#sendMessage').trigger('click');
            } else {
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
            let attachFile = getFileExtension(file.name);
            let matched = false;
            let size = file.size;
            let match = ["txt","rar","zip","xlsx","xls","ppt","docx","pptx","text","doc","ppt","wma","mp3","mp4","pdf","3gpp","3gp","png","jpg","jpeg","csv"];
            if (size > max_upload_size) {
                toastr.error("Max limit 20Mb exceeded");
                return;
            }
            for (let i = 0; i < match.length; i++) {
                if (attachFile === match[i]) {
                    matched = true;
                }
            }
            if (!matched) {
                toastr.error("This type of file is not allowed");
                return false;
            } else {

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
            start += limit;
        }

        function resetStart() {
            start = 0;
        }

        function resetRetiveMessage() {
            totalRetivedMessage = 0;
        }

        function increaseGroupLimit() {
            groupStart += groupLimit;
        }

        function resetFriendStart() {
            friendStart = 0;
        }

        function increaseFriendsLimit() {
            friendStart += friendLimit;
        }

        function addNewGroup(group) {
            let html = "";
            groupIds.push(group.groupId);
            groupObjects[group.groupId] = group;
            time[group.groupId] = group.lastActive;
            if (group.pendingMessage > 0) {
                html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_" + group.groupId + "' data-type=\"" + group.groupType + "\" data-block=\"" + group.block + "\" data-mute=\"" + group.mute + "\" data-group=\"" + group.groupId + "\">";
            } else {
                html += " <li class=\"person\" data-chat=\"person1\" id='group_" + group.groupId + "' data-type=\"" + group.groupType + "\" data-block=\"" + group.block + "\" data-mute=\"" + group.mute + "\" data-group=\"" + group.groupId + "\">";
            }

            groupImages[group.groupId] = group.groupImage;
            html += '<span id="groupImage_' + group.groupId + '">';
            for (j = 0; j < group.groupImage.length; j++) {

                html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\"" + group.groupImage[j] + "\" >";
            }
            html += '</span>';
            html += "                        <span class=\"name\" id='groupName_" + group.groupId + "' style=\"overflow: hidden\"><div>" + group.groupName + "</div><\/span>";
            let date = moment(group.lastActive, moment.ISO_8601).fromNow();

            html += "                        <span id='time_" + group.groupId + "' class=\"time\">" + date + "<\/span>";
            if (group.messageType === "text") {
                let recentMessage = group.recentMessage;
                if (recentMessage === null) {
                    recentMessage = '';
                }
                html += "                        <span style='float: left' id='messageType_" + group.groupId + "' class=\"preview\">" + recentMessage + "<\/span>";

            } else {
                let messageType = group.messageType;
                if (messageType === null) {
                    messageType = '';
                }
                html += "                        <span style='float: left' id='messageType_" + group.groupId + "' class=\"preview\">" + messageType + "<\/span>";
            }
            if (group.mute) {
                html += "                        <div style='' id='mute_" + group.groupId + "' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
            } else {
                html += "                        <div style='' id='mute_" + group.groupId + "' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
            }


            html += "                    <\/li>";

            $("#groups").prepend(html);
        }

        // this function prints group list on the left side
        function printGroupListAppend(groups) {
            let html = "";
            groupIds = [];

            time = {};
            for (let i = 0; i < groups.length; i++) {
                groupObjects[groups[i].groupId] = groups[i];
                groupIds.push(groups[i].groupId);
                time[groups[i].groupId] = groups[i].lastActive;
                if (groups[i].pendingMessage > 0) {
                    html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                } else {
                    html += " <li class=\"person \" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }
                groupImages[groups[i].groupId] = groups[i].groupImage;
                html += '<span id="groupImage_' + groups[i].groupId + '">';
                for (j = 0; j < groups[i].groupImage.length; j++) {

                    html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\"" + groups[i].groupImage[j] + "\" >";
                }
                html += '</span>';
                html += "                        <span class=\"name\" id='groupName_" + groups[i].groupId + "' style=\"overflow: hidden\"><div>" + groups[i].groupName + "</div><\/span>";
                let date = moment(groups[i].lastActive, moment.ISO_8601).fromNow();

                html += "                        <span id='time_" + groups[i].groupId + "' class=\"time\">" + date + "<\/span>";
                if (groups[i].messageType === "text") {
                    let recentMessage = groups[i].recentMessage;
                    if (recentMessage === null) {
                        recentMessage = '';
                    }
                    html += "                        <span style='float: left' id='messageType_" + groups[i].groupId + "' class=\"preview\">" + recentMessage + "<\/span>";

                } else {
                    let messageType = groups[i].messageType;
                    if (messageType === null) {
                        messageType = '';
                    }
                    html += "                        <span style='float: left' id='messageType_" + groups[i].groupId + "' class=\"preview\">" + messageType + "<\/span>";
                }
                if (groups[i].mute) {
                    html += "                        <div style='' id='mute_" + groups[i].groupId + "' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                } else {
                    html += "                        <div style='' id='mute_" + groups[i].groupId + "' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }

                html += "                    <\/li>";
            }
            $("#groups").append(html);
            $("#groups").perfectScrollbar('update');
        }

        function printGroupList(groups) {
            let html = "";
            groupIds = [];

            time = {};
            for (let i = 0; i < groups.length; i++) {
                groupIds.push(groups[i].groupId);
                groupObjects[groups[i].groupId] = groups[i];
                time[groups[i].groupId] = groups[i].lastActive;
                if (groups[i].pendingMessage > 0) {
                    html += " <li class=\"person font-bold-black\" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                } else {
                    html += " <li class=\"person \" data-chat=\"person1\" id='group_" + groups[i].groupId + "' data-mecreator=\"" + groups[i].meCreator + "\"  data-type=\"" + groups[i].groupType + "\" data-block=\"" + groups[i].block + "\" data-mute=\"" + groups[i].mute + "\" data-group=\"" + groups[i].groupId + "\">";
                }
                groupImages[groups[i].groupId] = groups[i].groupImage;
                html += '<span id="groupImage_' + groups[i].groupId + '">';
                for (j = 0; j < groups[i].groupImage.length; j++) {

                    html += "                        <img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\"" + groups[i].groupImage[j] + "\" >";
                }
                html += '</span>';
                html += "                        <span class=\"name\" id='groupName_" + groups[i].groupId + "' style=\"overflow: hidden\"><div>" + groups[i].groupName + "</div><\/span>";
                let date = moment(groups[i].lastActive, moment.ISO_8601).fromNow();

                html += "                        <span id='time_" + groups[i].groupId + "' class=\"time\">" + date + "<\/span>";
                if (groups[i].messageType === "text") {
                    let recentMessage = groups[i].recentMessage;
                    if (recentMessage === null) {
                        recentMessage = '';
                    }
                    html += "                        <span style='float: left' id='messageType_" + groups[i].groupId + "' class=\"preview\">" + recentMessage + "<\/span>";

                } else {
                    let messageType = groups[i].messageType;
                    if (messageType === null) {
                        messageType = '';
                    }
                    html += "                        <span style='float: left' id='messageType_" + groups[i].groupId + "' class=\"preview\">" + messageType + "<\/span>";
                }
                if (groups[i].mute) {
                    html += "                        <div style='' id='mute_" + groups[i].groupId + "' class=\"mute-pad  text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                } else {
                    html += "                        <div style='' id='mute_" + groups[i].groupId + "' class=\"mute-pad hidden text-right\" ><i class=\"fa fa-bell-slash\"></i><\/div>";
                }

                html += "                    <\/li>";
            }
            $("#groups").html(html);
        }




        //this function is used to print the group member list on the right side
        function printGroupMembers(members, meCreator, groupId) {
            let html = "";
            membersId = [];
            if (!members.length) {
                $("#groupMembers").css({"padding": "0px"});
            } else {
                $("#groupMembers").css({"padding": "10px"});
            }
            for (i = 0; i < members.length; i++) {
                membersId.push(members[i].userId);
                html += "<li class=\"person\"  style=\"padding-top: 5px;padding-bottom: 0px;height:50px;cursor: default;\">";
                if (members[i].active === 1) {
                    html += "                        <img class='memberStatus memberActive' id='member_" + members[i].userId + "' src=\"" + members[i].profilePictureUrl + "\" alt=\"\" \/>";
                } else {
                    html += "                        <img class='memberStatus' id='member_" + members[i].userId + "' src=\"" + members[i].profilePictureUrl + "\" alt=\"\" \/>";
                }
                html += "                        <span  class=\"name\"><div style='margin-top: 8px'>" + members[i].firstName + " " + members[i].lastName + "</div><\/span>";
                if (parseInt(groupType) === 0) {
                    html += "                        <span class=\"time\" style='padding-top: 5px' ><a href=\"#\" data-group=\"" + groupId + "\" data-member=\"" + members[i].userId + "\" class=\"btn-danger btn-extra-small btnMemberDelete\"><i class=\"fa fa-trash\"><\/i><\/a><\/span>";
                }
                html += "                    <\/li>";
            }
            $('#groupMembers').html(html);
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
                strVar += "                        <i class=\"oli oli-document\"><\/i>";
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
                strVar += "<div class=\"col-md-4 col-xl-4 col-xs-4 col-sm-4 pad-5\">";
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
            let url = "<?php echo base_url('imApi/getMembers?groupId=') ?>" + groupId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/getMembers?groupId=') ?>" + groupId + "&userId=" + userId;
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
                let members = response.response.memberList;
                let meCreator = response.response.meCreator;
                let groupFiles = response.response.groupFiles;
                let groupImages = response.response.groupImages;
                printGroupMembers(members, meCreator, groupId);

                printGroupFiles(groupFiles);
                printGroupImages(groupImages);
            });

        }

        //This function is used to print the group name and three member image on the right side top
        function printGroupInfo(groupId, groupImages, groupName) {
            let html = "";
            let images = groupImages[groupId];
            for (i = 0; i < images.length; i++) {
                html += "<img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\"" + images[i] + "\" >";
            }
            $('.rightGroupImages').html(html);
            $('.be-use-name').html(groupName);
            $clamp($('.be-use-name')[0], {clamp: 2, useNativeClamp: false});
        }

        function clampData() {
            $('.clamp-desc').each(function (index, element) {
                $clamp(element, {clamp: 3, useNativeClamp: false});
            });
            $('.clamp-title').each(function (index, element) {
                $clamp(element, {clamp: 3, useNativeClamp: false});
            });
        }

        //This function is used to  get friend list of user
        function getMembers(callback) {   // get friends list
            resetFriendStart();
            let url = "<?php echo base_url('imuser/friendList?start=') ?>" + friendStart + "&limit=" + friendLimit;
            if (ID_BASED) {
                url = "<?php echo base_url('imuser/friendList?start=') ?>" + friendStart + "&limit=" + friendLimit + "&userId=" + userId;
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
                "dataType": 'json'
            };
            $.ajax(settings).done(function (response) {

                let data = response.response.friends;
                totalFriend = response.response.total;
                callback(data);
            });
        }

        //This function is used to clear the current chat box for retrieving new message for the new group
        function clearChatBox() {
            chatBox.html('');
        }
        function getImagePreview(message){
            let linkData=JSON.parse(message.linkData);
            let  html = "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\"><a style='display: inline-block;margin-left: auto;border: 1px solid #eee;border-radius: 10px;' href=\"" + message.message + "\" class=\"ol-hover hover-5 ol-lightbox\"><img onerror='this.style.display=\"none\";' style=\"margin-left: auto;border: 1px solid #eee;border-radius: 10px;max-height: 230px;max-width: 240px;\" height=\"200px\" width=\"200px\" src=\"" + message.message + "\" alt=\"image hover\">";
            if(linkData!=null && linkData.hasOwnProperty("playerOrImageUrl") &&linkData.playerOrImageUrl.hasOwnProperty("size") && linkData.playerOrImageUrl.size!=null && linkData.playerOrImageUrl.size.hasOwnProperty("height") && linkData.playerOrImageUrl.size.height!=null &&linkData.playerOrImageUrl.size.hasOwnProperty("width") && linkData.playerOrImageUrl.size.width!=null ){
                html = "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\"><a style='display: inline-block;margin-left: auto;border: 1px solid #eee;border-radius: 10px;' href=\"" + message.message + "\"  class=\"ol-hover hover-5 ol-lightbox\"><img onerror='this.style.display=\"none\";' style='border: 1px solid #eee;border-radius: 10px; max-height: 230px;max-width: 240px;width: "+linkData.playerOrImageUrl.size.width+"px;height: "+linkData.playerOrImageUrl.size.height+"px;'  src=\"" + message.message + "\" alt=\"image hover\">";
            }

            html += "                            <div class=\"ol-overlay ov-light-alpha-80\"><\/div>";
            html += "                            <div class=\"icons\"><i class=\"fa fa-camera\"><\/i><\/div><\/a>";
            html += "                            <\/div>";

            return html;
        }
        //This function is used to create the preview for a link sheared in message
        function getLinkPreview(linkData, link) {
            let defaultImage = "<?php echo base_url('/assets/img/compact_camera1600.png') ?>";
            if (linkData.playerOrImageUrl.type === 'player') {
                return "<div class='i-wrapper'><iframe src='" + linkData.playerOrImageUrl.url + "' class='medea-frame iframe-wrapper' allowfullscreen></iframe></div>";
            }
            else if (linkData.playerOrImageUrl.type === 'file') {
                let image = "<img onerror='this.style.display=\"none\";' src='" + linkData.playerOrImageUrl.url + "' id='tImg' width='100%'  >";
                if(linkData.playerOrImageUrl.hasOwnProperty("size") && linkData.playerOrImageUrl.size!=null && linkData.playerOrImageUrl.size.hasOwnProperty("height") && linkData.playerOrImageUrl.size.height!=null &&linkData.playerOrImageUrl.size.hasOwnProperty("width") && linkData.playerOrImageUrl.size.width!=null ){
                    image = "<img onerror='this.style.display=\"none\";' src='" + linkData.playerOrImageUrl.url + "' id='tImg' width='100%' style='height:"+linkData.playerOrImageUrl.size.height+"px; width:"+linkData.playerOrImageUrl.size.width +"px;max-height: 230px;' >";
                }
                return "<a href='" + link + "' target=\"_blank\">" +
                    "<div class='linkPreview-wrapper'>" +
                    "<div class='link-file' >" + image +
                    "</div> " +
                    "</div>" +
                    "</a>";
            }
            else {
                let image = "<img src='<?php echo base_url("/assets/img/compact_camera1600.png") ?>' id='tImg_blank' width='100%'>";
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
        function parseMessage(message, onlyemoji) {
            if (onlyemoji) {
                return twemoji.parse(
                    anchorme(message, {
                        //truncate:[15,10],
                        attributes: [
                            function (urlObj) {
                                if (urlObj.protocol !== "mailto:")
                                    return {name: "target", value: "blank"};
                            }
                        ]
                    }), {className: "emoji2x"}
                );
            }
            return twemoji.parse(
                anchorme(message, {
                    //truncate:[15,10],
                    attributes: [
                        function (urlObj) {
                            if (urlObj.protocol !== "mailto:")
                                return {name: "target", value: "blank"};
                        }
                    ]
                })
            );
        }

        //This function is used to retrieve messages from server based on group id
        function getMessage(groupId) {

            if (start == 1) {
                start = 0;
            }
            let url = "<?php echo base_url('imApi/getMessage?groupId=') ?>" + groupId + "&limit=" + limit + "&start=" + start;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/getMessage?groupId=') ?>" + groupId + "&limit=" + limit + "&start=" + start + "&userId=" + userId;
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
                "beforeSend": function () {

                    messageLoading = true;
                    chatBox.html('<img id="loadingMessage" src="<?php echo base_url('assets/im/img/loadingMessage.gif')?>" class="img-responsive blankImg" style="width:500px;margin-top: 20px;">');
                    chatBox.addClass("text-center");
                },
                "success": function () {
                    messageLoading = false;
                    $("#loadingMessage").remove();
                    chatBox.removeClass("text-center");
                },
                "complete":function () {

                }

            };
            $.ajax(settings).done(function (result) {



                let data = result.response;
                let html = "";
                totalRetivedMessage += data.length;

                if (data.length === 0) {
                    chatBox.html('<img id="blankImg" src="<?php echo base_url('assets/im/img/nomess.png')?>" class="img-responsive blankImg" style="width:500px;margin-top: 20px;">');
                    chatBox.addClass("text-center");
                } else {
                    chatBox.removeClass("text-center");
                    lastMessageDate = moment(data[data.length - 1].message.ios_date_time);
                    LastMessageId = parseInt(data[data.length - 1].message.m_id);
                    let currentDate = moment(moment().toISOString());

                    topMessage = data[0].message.m_id;
                    let today = false;
                    for (let i = 0; i < data.length; i++) {

                        let sender = data[i].sender;
                        let message = data[i].message;

                        let senderId = data[i].sender.userId;
                        let messageDate = moment(data[i].message.ios_date_time);
                        let seen = data[i].seen;
                        if (moment(moment().toISOString()).diff(messageDate, 'days') === 0 && !today) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            currentDate = messageDate;
                            today = true;
                        }
                        else if (currentDate.diff(messageDate, 'days') !== 0 && (currentDate.diff(messageDate, 'days') >= 1 || currentDate.diff(messageDate, 'days') <= -1)) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            currentDate = messageDate;
                        }
                        else if (moment(moment().toISOString()).diff(messageDate, 'days') === 0 && (currentDate.diff(messageDate, 'minutes') <= -30 || currentDate.diff(messageDate, 'minutes') >= 30)) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            currentDate = messageDate;
                        }
                        if (message.type === "update") {
                            html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender update-message-font\"  data-og-container=\"\">";
                            html += "<i  class='oli oli-newspaper'></i> " + message.message;
                            html += "                <\/div>";
                        }

                        else {
                            if (parseInt(senderId) === parseInt(userId)) {

                                html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";

                                if (message.type === "text") {
                                    if (message.onlyemoji) {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                    } else {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                    }
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
                                    html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                                    //html += "                    <\/div>";
                                }
                                html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                                html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                                html += "                    <\/div>";
                                if (seen === null) {
                                    html += "                    <div class=\"fw-im-message-time seen hidden  seenId_" + message.m_id + "\">";
                                    html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen + "<\/span>";
                                    html += "                    <\/div>";
                                }
                                else {
                                    if (seen.time !== null) {
                                        html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                                        html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + moment(seen.time, moment.ISO_8601).calendar(null, momentOptions2) + "<\/span>";
                                        html += "                    <\/div>";
                                    } else {
                                        html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                                        html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + "<\/span>";
                                        html += "                    <\/div>";
                                    }

                                }

                                html += "                <\/div>";
                            }
                            else {
                                html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                                if (isUnicode(sender.firstName)) {
                                    html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                                } else {
                                    html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                                }
                                if (message.type === "text") {
                                    if (message.onlyemoji) {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                    } else {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                    }
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
                                    html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + "   ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
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

                    firstmessageDate = currentDate;
                    chatBox.html("");
                    chatBox.append(html);
                    chatBox.scrollTop(0);

                    for (i = 0; i < data.length; i++) {
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
                                "font-family": "Tahoma"
                            });
                        }

                    }

                    let height = chatBox[0].scrollHeight;
                    //scrollPosition=height;
                    //chatBox.scrollTop( chatBox.prop( "scrollHeight" ) );
                    chatBox.scrollTop(height);

                    //$('#notice_'+groupId).addClass("hidden");
                    lightBox.init();
                    chatBox.perfectScrollbar({suppressScrollX: true});
                    clampData();


                }


            });

        }

        //------------------ Search message Functions -----------------------





        function searchMessage(searchText) {

            let url = "<?php echo base_url('imApi/searchMessage?groupId=') ?>" + activeGroupId +'&search='+searchText;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/searchMessage?groupId=') ?>" + activeGroupId + +'&search='+searchText +"&userId=" + userId;
            }

            var settings = {
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

            $.ajax(settings).done(function (result) {
                let html='';
                let data = result.response;

                for(let i=0;i<data.length;i++){

                    let sender = data[i].sender;
                    let message = data[i].message;
                    let senderId = data[i].sender.userId;

                    if (parseInt(senderId) === parseInt(userId)) {
                        html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender searchMessageList\"  data-og-container=\"\" style=\"cursor:pointer;\" data-id='"+message.m_id+"' >";

                        if (isUnicode(sender.firstName)) {
                            html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                        } else {
                            html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                        }

                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) +  "<\/div>";
                        html += "                    <div class=\"fw-im-message-author\" style='top:10px' title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        html += "                        <img  src=\"" + sender.profilePictureUrl + "\" />";
                        html += "                    <\/div>";
                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "<\/span>";
                        html += "                    <\/div>";
                        html += "                <\/div>";
                    }else{
                        html += "<div class=\"fw-im-message  fw-im-isnotme fw-im-othersender searchMessageList\"  data-og-container=\"\" style=\"cursor:pointer;\"  data-id='"+message.m_id+"' >";

                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                        html += "                    <div class=\"fw-im-message-author\" style='top:0' title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        html += "                        <img  src=\"" + sender.profilePictureUrl + "\" />";
                        html += "                    <\/div>";
                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "<\/span>";
                        html += "                    <\/div>";
                        html += "                <\/div>";
                    }
                }


                searchResultBox.html(html);


                if(searchResultBox.hasClass("hidden") && data.length>0){
                    searchResultBox.removeClass("hidden");
                }
                searchResultBox.perfectScrollbar({suppressScrollX: true});

                searchResultBox.css({height:"350px"})
            });

        }

        function hideSearchMessageBox(){
            $("#searchMessage").removeClass("hidden");
            $("#searchDone").addClass("hidden");
            chatBox.removeClass("hidden");
            searchChatBox.addClass("hidden");
            searchChatBox.html("");
            searchChatBox.perfectScrollbar("destroy");
            let height = parseInt(chatBox[0].scrollHeight);
            chatBox.scrollTop(height);
        }

        let firstSearchMessageId=null;
        let lastSearchMessageId=null;

        function searchMessageList(messageId){

            chatBox.addClass("hidden");
            searchChatBox.removeClass("hidden");



            $("#messageSearchModal").modal('hide');

            let url = "<?php echo base_url('imApi/searchMessageList?groupId=') ?>" + activeGroupId +'&m_id='+messageId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/searchMessageList?groupId=') ?>" + activeGroupId  +'&m_id='+messageId +"&userId=" + userId;
            }

            var settings = {
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

            $.ajax(settings).done(function (result) {

                let data = result.response;
                let html = "";
                firstSearchMessageId = data[0].message.m_id;
                lastSearchMessageId = parseInt(data[data.length - 1].message.m_id);

                html += "<div id='searchMessageUpper'  class=\"fw-im-message bold load-more text-center fw-im-othersender\" data-og-container=\"\">";
                html +='<i class="fas fa-angle-double-up"></i> Load More';
                html += "                <\/div>";


                for (let i = 0; i < data.length; i++) {

                    let sender = data[i].sender;
                    let message = data[i].message;

                    let senderId = data[i].sender.userId;

                    if (parseInt(senderId) === parseInt(userId)) {

                        html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender \"  data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\" >";

                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {
                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:10px'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                        html += "                    <\/div>";

                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\""+moment(message.ios_date_time,moment.ISO_8601).format('LLLL')+"\">"+moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions)+"<\/span>";
                        html += "                    <\/div>";

                        html += "                <\/div>";
                    }
                    else {
                        html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\"  style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                        if (isUnicode(sender.firstName)) {
                            html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                        } else {
                            html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                        }
                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {

                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\">";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + "   ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:0'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        if (sender.active === 1) {
                            html += "                        <img class='auth_" + senderId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                        } else {
                            html += "                        <img class='auth_" + senderId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                        }
                        html += "                    <\/div>";
                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\""+moment(message.ios_date_time,moment.ISO_8601).format('LLLL')+"\">"+moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions)+"<\/span>";
                        html += "                    <\/div>";
                        html += "                <\/div>";
                    }
                }

                html += "<div id='searchMessageLower'  class=\"fw-im-message bold load-more text-center fw-im-othersender\" data-og-container=\"\">";
                html +='<i class="fas fa-angle-double-down"></i> Load More';
                html += "                <\/div>";

                searchChatBox.perfectScrollbar({suppressScrollX: true});
                searchChatBox.html(html);

                $("#search_message_"+firstSearchMessageId).addClass("search-text");




                for (let i = 0; i < data.length; i++) {
                    let allMessage = data[i].message;
                    let sender = data[i].sender;
                    let isme = parseInt(sender.userId) !== parseInt(userId);
                    if (allMessage.type == "video") {
                        initVideo("video_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "audio") {
                        initAudio("audio_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "text" && isUnicode(allMessage.message)) {
                        $("#search_message_" + allMessage.m_id).css({
                            "direction": "rtl",
                            "font-family": "Tahoma"
                        });
                    }
                }

                // let height = parseInt(searchChatBox[0].scrollHeight/3);
                //scrollPosition=height;
                //chatBox.scrollTop( chatBox.prop( "scrollHeight" ) );
                //searchChatBox.scrollTop(searchChatBox[0].scrollTop+20);

                //$('#notice_'+groupId).addClass("hidden");
                lightBox.init();
                // searchChatBox.perfectScrollbar({suppressScrollX: true});
                clampData();
            });



        }

        searchChatBox.on(listenType,"#searchMessageUpper", function (e) {

            $(this).remove();
            let url = "<?php echo base_url('imApi/searchMessageUpper?groupId=') ?>" + activeGroupId +'&m_id='+firstSearchMessageId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/searchMessageUpper?groupId=') ?>" + activeGroupId  +'&m_id='+firstSearchMessageId +"&userId=" + userId;
            }

            var settings = {
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

            $.ajax(settings).done(function (result) {

                let data = result.response;
                let html = "";

                html += "<div id='searchMessageUpper'  class=\"fw-im-message bold load-more text-center fw-im-othersender\" data-og-container=\"\">";
                html +='<i class="fas fa-angle-double-up"></i> Load More';
                html += "                <\/div>";

                for (let i = 0; i < data.length; i++) {

                    let sender = data[i].sender;
                    let message = data[i].message;

                    let senderId = data[i].sender.userId;

                    if (parseInt(senderId) === parseInt(userId)) {

                        html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender \"  data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\" >";

                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {
                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:10px'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                        html += "                    <\/div>";

                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\""+moment(message.ios_date_time,moment.ISO_8601).format('LLLL')+"\">"+moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions)+"<\/span>";
                        html += "                    <\/div>";

                        html += "                <\/div>";
                    }
                    else {
                        html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\"  style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                        if (isUnicode(sender.firstName)) {
                            html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                        } else {
                            html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                        }
                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {

                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\">";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + "   ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:0'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        if (sender.active === 1) {
                            html += "                        <img class='auth_" + senderId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                        } else {
                            html += "                        <img class='auth_" + senderId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                        }
                        html += "                    <\/div>";
                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\""+moment(message.ios_date_time,moment.ISO_8601).format('LLLL')+"\">"+moment(message.ios_date_time,moment.ISO_8601).calendar(null,momentOptions)+"<\/span>";
                        html += "                    <\/div>";
                        html += "                <\/div>";
                    }
                }

                searchChatBox.prepend(html);


                for (let i = 0; i < data.length; i++) {
                    let allMessage = data[i].message;
                    let sender = data[i].sender;
                    let isme = parseInt(sender.userId) !== parseInt(userId);
                    if (allMessage.type == "video") {
                        initVideo("video_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "audio") {
                        initAudio("audio_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "text" && isUnicode(allMessage.message)) {
                        $("#search_message_" + allMessage.m_id).css({
                            "direction": "rtl",
                            "font-family": "Tahoma"
                        });
                    }
                }


                lightBox.init();

                clampData();

                searchChatBox.perfectScrollbar('update');



                if(data.length>0){
                    firstSearchMessageId = data[0].message.m_id;
                    //lastSearchMessageId = parseInt(data[data.length - 1].message.m_id);

                }

                if(data.length<=0){
                    $("#searchMessageUpper").remove();
                }

            });


        });


        searchChatBox.on(listenType,"#searchMessageLower", function (e) {
            $(this).remove();
            let url = "<?php echo base_url('imApi/searchMessageLower?groupId=') ?>" + activeGroupId + '&m_id=' + lastSearchMessageId;
            if (ID_BASED) {
                url = "<?php echo base_url('imApi/searchMessageLower?groupId=') ?>" + activeGroupId  +'&m_id=' + lastSearchMessageId + "&userId=" + userId;
            }

            var settings = {
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

            $.ajax(settings).done(function (result) {

                let data = result.response;
                let html = "";



                for (let i = 0; i < data.length; i++) {

                    let sender = data[i].sender;
                    let message = data[i].message;

                    let senderId = data[i].sender.userId;

                    if (parseInt(senderId) === parseInt(userId)) {

                        html += "<div class=\"fw-im-message  fw-im-isme fw-im-othersender \"  data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\" >";

                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {
                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:10px'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                        html += "                    <\/div>";

                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "<\/span>";
                        html += "                    <\/div>";

                        html += "                <\/div>";
                    } else {
                        html += "                <div class=\"fw-im-message  fw-im-isnotme fw-im-othersender\" data-og-container=\"\"  style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                        if (isUnicode(sender.firstName)) {
                            html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                        } else {
                            html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                        }
                        if (message.type === "text") {
                            if (message.onlyemoji) {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                            } else {
                                html += "                    <div id='search_message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                            }
                            if (message.linkData !== null) {

                                html += getLinkPreview(JSON.parse(message.linkData), message.link);
                            }
                        }
                        if (message.type === "image") {
                            html += getImagePreview(message);
                        }
                        if (message.type === "video") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments\">";
                            html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "audio") {
                            html += "<div id='search_message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                            html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%' controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                            html += "                    <\/div>";
                        }
                        if (message.type === "document") {
                            // html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                            html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + "   ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                            //html += "                    <\/div>";
                        }
                        html += "                    <div class=\"fw-im-message-author\" style='top:0'  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                        if (sender.active === 1) {
                            html += "                        <img class='auth_" + senderId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                        } else {
                            html += "                        <img class='auth_" + senderId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                        }
                        html += "                    <\/div>";
                        html += "                    <div class=\"fw-im-message-time\">";
                        html += "                        <span style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).format('LLLL') + "\">" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "<\/span>";
                        html += "                    <\/div>";
                        html += "                <\/div>";
                    }
                }

                html += "<div id='searchMessageLower'  class=\"fw-im-message bold load-more text-center fw-im-othersender\" data-og-container=\"\">";
                html +='<i class="fas fa-angle-double-down"></i> Load More';
                html += "                <\/div>";
                searchChatBox.append(html);


                for (let i = 0; i < data.length; i++) {
                    let allMessage = data[i].message;
                    let sender = data[i].sender;
                    let isme = parseInt(sender.userId) !== parseInt(userId);
                    if (allMessage.type == "video") {
                        initVideo("video_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "audio") {
                        initAudio("audio_" + allMessage.m_id, isme);
                    } else if (allMessage.type == "text" && isUnicode(allMessage.message)) {
                        $("#search_message_" + allMessage.m_id).css({
                            "direction": "rtl",
                            "font-family": "Tahoma"
                        });
                    }
                }


                lightBox.init();

                clampData();

                searchChatBox.perfectScrollbar('update');

                if(data.length>0) {
                    //firstSearchMessageId = data[0].message.m_id;
                    lastSearchMessageId = parseInt(data[data.length - 1].message.m_id);

                }
                if(data.length<=0){
                    $("#searchMessageLower").remove();
                }
            });


        });

        //---------------------------------------------------------------------------------------


        //This function is used to send message to the server
        function sendMessage(form, sendFile, newmessage, socketData) {

            let settings = null;
            if (ID_BASED) {
                form.append("userId", userId);
                socketData.userId = userId;
            }
            let url = "<?php echo base_url('imApi/sendMessage') ?>";
            if (sendFile) {
                let progress1 = new LoadingOverlayProgress();
                settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": url,
                    "method": "POST",
                    "headers": {
                        "authorization": "Basic YWRtaW46MTIzNA==",
                        "x-auth-token": String(responce),
                        "cache-control": "no-cache",

                    },
                    "xhr": function () {

                        let xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener("progress", function (evt) {
                            if (sendFile) {
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
                    "error": function (e) {
                        let err = JSON.parse(e.responseText);
                        toastr.error(err.response);
                    },
                    "beforeSend": function () {
                        $('.close').trigger("click");
                        if (sendFile) {
                            $("body").LoadingOverlay("show", {
                                custom: progress1.Init()
                            });
                        }

                    },
                    "complete": function () {
                        delete progress1;
                        $("body").LoadingOverlay("hide");
                    }
                };
                $.ajax(settings).done(function (res) {


                });
            }
            else{
                typingTimeoutFunction();
                $('.close').trigger("click");
                socketData._r = String(responce);
                socket.emit("sendText", socketData);
                messageTyping=false;
            }


        }

        // unused function. have a plan used in the future
        function captureImage(file) {
            let canvas = document.createElement("canvas");
            canvas.width = 40;
            canvas.height = 40;

            canvas.strokeStyle = 'black';
            canvas.lineWidth = 1;
            canvas.getContext('2d').strokeRect(0, 0, canvas.width, canvas.height);
            canvas.getContext('2d').drawImage(file, 0, 0, canvas.width - 1, canvas.height - 1);

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
            canvas.getContext('2d').drawImage(file, 0, 0, canvas.width - 1, canvas.height - 1);

            let img = document.getElementById("newMessagefileIV");
            img.src = canvas.toDataURL("image/png");
            //$output.prepend(img);
        };


        //update the message time on the left side
        function updateTime() {
            for (i = 0; i < groupIds.length; i++) {
                let date = moment(time[groupIds[i]], moment.ISO_8601).fromNow();
                $('#time_' + groupIds[i]).html(date);
            }

        }

// -----------------End of Global functions --------------------------//

        //--------------------- search message functions---------------------------------

        $('#searchMessage').on("click",function(){
            $("#messageSearchModal").modal({show: true});
        });

        $("#searchMessageBtn").on("click",function () {



            let searchText=$("#searchMessageText").val();

            searchMessage(searchText);
        });

        $('#messageSearchModal').on('hidden.bs.modal', function (e) {
            searchResultBox.html("");
            $("#searchMessageText").val("");

            if(!searchResultBox.hasClass("hidden")){
                searchResultBox.addClass("hidden");
            }
            searchResultBox.perfectScrollbar("destroy");
        });

        $("#searchResultBox").on(listenType,".searchMessageList",function () {

            $("#searchMessage").addClass("hidden");
            $("#searchDone").removeClass("hidden");

            let id=parseFloat($(this).attr("data-id"));
            searchMessageList(id);
        });

        $("#searchDone").on(listenType,function(){
            hideSearchMessageBox();
        });

        //--------------------------------------------------------


        $('#groups').perfectScrollbar({suppressScrollX: true});
        //$('#groupMembers').perfectScrollbar({suppressScrollX:true});
        $('#rightSection').perfectScrollbar({suppressScrollX: true});
        chatBox.perfectScrollbar({suppressScrollX: true});


        $(addmember).on('expand', function (c) {
            addexpendDropdown = $('.ms-res-ctn.dropdown-menu').perfectScrollbar({suppressScrollX: true});
            initaddexpendDropdown();
        });

        $(addmember).on('collapse', function (c) {
            addexpendDropdown.perfectScrollbar("destroy");
        });

        $(newMemberInput).on('expand', function (c) {
            addMemberexpendDropdown = $('.ms-res-ctn.dropdown-menu').perfectScrollbar({suppressScrollX: true});
            initaddMemberexpendDropdown();
        });

        $(newMemberInput).on('collapse', function (c) {
            addMemberexpendDropdown.perfectScrollbar("destroy");
        });


        $(newMemberInput).on('keyup', function (e, m, v) {
            let value = this.getRawValue().replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/(<([^>]+)>)/ig, "").replace(/&nbsp;/gi, " ").replace(/&nbsp;/gi, " ").trim();
            let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imuser/filterFriendList?key=') ?>" + escapeHtml(value),
                "method": "GET",
                "headers": {
                    "authorization": "Basic YWRtaW46MTIzNA==",
                    "x-auth-token": String(responce),
                    "cache-control": "no-cache",

                },
                "dataType": 'json'
            };
            $.ajax(settings).done(function (response) {
                request = true;
                let res = response.response;
                let oldData = [];
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

        $(addmember).on('keyup', function (e, m, v) {
            let value = this.getRawValue().replace(/<script[^>]*>/gi, "&lt;script&gt;").replace(/<\/script[^>]*>/gi, "&lt;/script&gt;").replace(/(<([^>]+)>)/ig, "").replace(/&nbsp;/gi, " ").replace(/&nbsp;/gi, " ").trim();
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
                request = true;
                let res = response.response;
                let oldData = [];
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
                if (request && friendStart < totalFriend) {
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
                        request = true;
                        let res = response.response.friends;
                        let oldData = addmember.getData();
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

        function initaddMemberexpendDropdown() {


            let request = true;
            addMemberexpendDropdown.on("ps-y-reach-end", function () {
                increaseFriendsLimit();
                if (request && friendStart < totalFriend) {
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
                        request = true;
                        let res = response.response.friends;
                        let oldData = newMemberInput.getData();
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

        let requested = true;
        groupBox.on("ps-y-reach-end", function () {
            increaseGroupLimit();
            if (requested && groupStart < totalGroup) {
                requested = false;

                let url = "<?php echo base_url('imApi/getGroups?limit=') ?>" + groupLimit + "&start=" + groupStart;
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
                    "beforeSend": function () {
                        groupBox.append("<div class='text-center groupLoader'><div class='loader'></div></div>");
                    },
                    "complete": function () {
                        $('.groupLoader').remove();

                    }
                };
                $.ajax(settings).done(function (response) {

                    let groups = response.response;
                    printGroupListAppend(groups);
                    requested = true;
                });


            }


        });


        chatBox.on("ps-scroll-up", function () {

            if (notRequested && chatBox.scrollTop() === 0) {
                notRequested = false;
                increaseStart();

                let url = "<?php echo base_url('imApi/getMessage?groupId=') ?>" + activeGroupId + "&limit=" + limit + "&start=" + start;


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
                    "beforeSend": function () {
                        chatBox.prepend("<div class='loader'></div>");
                    },
                    "complete": function () {
                        $('.loader').remove();

                    }
                };
                $.ajax(settings).done(function (result) {
                    $('.loader').remove();
                    notRequested = true;
                    let data = result.response;
                    if (data.length === 0) {
                        notRequested = false;
                        return;
                    }
                    if (totalRetivedMessage === result.totalMessage) {
                        resetStart();
                        return;
                    }
                    let html = "";
                    let currentDate = firstmessageDate;
                    let currentTopMessage = topMessage;
                    topMessage = data[0].message.m_id;
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
                            html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender update-message-font\"  data-og-container=\"\">";
                            html += "<i   class='oli oli-newspaper'></i> " + message.message;
                            html += "                <\/div>";
                        }

                        else {
                            if (parseInt(senderId) === parseInt(userId)) {
                                html += "<div  class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";

                                if (message.type === "text") {
                                    if (message.onlyemoji) {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                    } else {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                    }
                                    if (message.linkData != null) {
                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + "  ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
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
                                if (isUnicode(sender.firstName)) {
                                    html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                                } else {
                                    html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                                }
                                if (message.type === "text") {
                                    if (message.onlyemoji) {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                    } else {
                                        html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                    }
                                    if (message.linkData !== null) {
                                        html += getLinkPreview(JSON.parse(message.linkData), message.link);
                                    }
                                }
                                if (message.type === "image") {
                                    html += getImagePreview(message);
                                }
                                if (message.type === "video") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\">";
                                    html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "'  width=\"250px\" height=\"150px\" controls=\"true\"  preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "audio") {
                                    html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                    html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                    html += "                    <\/div>";
                                }
                                if (message.type === "document") {
                                    //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                    html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
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


                    totalRetivedMessage += data.length;

                    chatBox.prepend(html);
                    for (i = 0; i < data.length; i++) {
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
                                "font-family": "Tahoma"
                            });
                        }
                    }
                    /*if(data.length>0){
                     let m_id=data[data.length-1].message.m_id;
                     chatBox.animate({scrollTop:$("#message_"+m_id).offset().top},3);
                     }*/
                    // let height=chatBox[0].scrollHeight;
                    let elmnt = document.getElementById("message_" + currentTopMessage);

                    if (data.length !== 0) {
                        if (!elmnt) {
                            chatBox.scrollTop(scrollPosition);
                        }
                        else {
                            chatBox.perfectScrollbar('update');
                            elmnt.scrollIntoView(false);
                        }

                    }

                    lightBox.init();
                    $('.loader').hide();
                    clampData();
                    window.scrollTo(0, 0);

                });
            }
        });



        $('#newMessagefileIV').on("click", function () {
            $("#newMessageFile").click();
        });

        $('#fileIV').on("click", function () {
            $("#messageFile").click();
        });
        $('#fileIV1').on("click", function () {
            $("#messageFile1").click();
        });

        $("#messageFile").change(imageChange);
        $("#messageFile1").change(attachChange);

        $("#newMessageFile").change(imageChangeNewMessage);


        function init_twemoji() {
            messageBox=$('#message').twemojiPicker(sendMessageSettings);
            $('#newMessageText').twemojiPicker(sendNewMessageSettings);

            $(".twemoji-list").perfectScrollbar({suppressScrollX: true});
            $('#newMessageText_twemoji').on("keydown input", function (e) {
                /*if (e.which == 13) {
                    $('#newSendMessage').trigger('click');
                }*/
                if (isUnicode($(this).text())) {
                    $(this).css('direction', 'rtl');
                    $("#newMessageText_icon_picker").find(".emoji.emoji_header").css({
                        "left": "21px",
                        "right": "unset"
                    });
                    $("#newMessageText_twemoji").css({"padding-left": "50px"});
                    $("#newMessageText_twemoji").css({"padding-right": "12px"});
                }
                else {
                    $(this).css('direction', 'ltr');
                    $("#newMessageText_icon_picker").find(".emoji.emoji_header").css({
                        "left": "unset",
                        "right": "21px"
                    });
                    $("#newMessageText_twemoji").css({"padding-right": "50px"});
                    $("#newMessageText_twemoji").css({"padding-left": "12px"});
                }
            });

            $('#message_twemoji').on("keydown input", function (e) {


                    onKeyDownNotEnter();

                if (isUnicode($(this).text())) {
                    $(this).css('direction', 'rtl');
                    $("#message_icon_picker").find(".emoji.emoji_header").css({"left": "21px", "right": "unset"});
                    $("#message_twemoji").css({"padding-left": "50px"});
                    $("#message_twemoji").css({"padding-right": "12px"});
                }
                else {
                    $(this).css('direction', 'ltr');
                    $("#message_icon_picker").find(".emoji.emoji_header").css({"left": "unset", "right": "21px"});
                    $("#message_twemoji").css({"padding-right": "50px"});
                    $("#message_twemoji").css({"padding-left": "12px"});
                }
            });
        }

        $('#sendMessage').on("click", function (event) {
            if(!messageTyping){
                return;
            }
            let receiverId = activeGroupId;
            if (receiverId === null || receiverId === "") {
                return;
            }
            if (messageLoading) {
                return;
            }
            $('.close').trigger("click");

            let message = decodeHTML($('#message').val());
            let mainFileObject = null;
            let file = $("#messageFile").val();
            if (file === null || file === "") {
                file = $("#messageFile1").val();
                mainFileObject = $("#messageFile1")[0].files[0];
            }
            else {
                mainFileObject = $("#messageFile")[0].files[0];
            }

            let modmessage = (message).trim();
            if ((modmessage === null || modmessage === "") && (file === null || file === "")) {
                reset();
                return;

            }
            if (modmessage != null || modmessage != "") {

                $('#message').val(modmessage);
            }

            let date = moment().format("YYYY-MM-DD");
            let time = moment().format("HH:mm:ss");

            let form = new FormData($('#messageForm')[0]);
            let socketData = $('#messageForm').serializeFormJSON();
            socketData.groupId = receiverId;
            form.append("groupId", receiverId);

            form.append("file", mainFileObject);
            reset();
            if (file === null || file === "") {

                sendMessage(form, false, false, socketData);
            }
            else {
                sendMessage(form, true, false, socketData);
            }


        });

        $('#newSendMessage').on("click", function (event) {
            //$('.close').trigger("click");

            let message = $('#newMessageText').text();
            let modmessage = message.replace(/(<([^>]+)>)/ig, "").replace(/&nbsp;/gi, " ").replace(/&nbsp;/gi, " ").trim();
            let file = $("#newMessageFile").val();
            if ((modmessage == null || modmessage == "") && (file == null || file == "")) {
                // resetNewMessage();
                return;

            }
            if (modmessage != null || modmessage != "") {

                $('#newMessageText').val(modmessage);
            }


            //let receiverId=activeGroupId
            let date = moment().format("YYYY-MM-DD");
            let time = moment().format("HH:mm:ss");
            let userIds = addmember.getValue();
            if (userIds.length == 0) {
                return;
            }
            let form = new FormData($('#newMessageForm')[0]);
            for (i = 0; i < userIds.length; i++) {
                form.append("memberId[]", userIds[i]);
            }
            form.append("date", date);
            form.append("time", time);

            sendMessage(form, false, true);
            $('#groups').scrollTop(0);
            //updateGroupList();

        });


        $("#groupName").focus(function () {
            $(this).css("border", "1px solid #ccc");
        });


        $("#showGroupInfo").on("click", function () {
            localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            location.href = "<?php echo base_url('immobile/info') ?>";
        });


//------------------  Web sockt section ------------------------------

        socket.on('newMessage', function (res) {
            messageTyping=true;
            chatBox.find('#blankImg').hide();
            chatBox.perfectScrollbar({suppressScrollX: true});
            let data = res;
            let sender = data.sender;
            let message = data.message;
            let html = "";
            let seen = data.seen;
            let messageDate = moment(message.ios_date_time, moment.ISO_8601);
            LastMessageId = parseInt(message.m_id);
            if (!lastMessageDate) {
                html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                html += "                <\/div>";
                lastMessageDate = messageDate;
            }
            else if (lastMessageDate.date() - messageDate.date() >= 1 || lastMessageDate.date() - messageDate.date() <= -1) {
                if (lastMessageDate !== messageDate) {
                    html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                    html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                    html += "                <\/div>";
                    lastMessageDate = messageDate;
                }
            } else if (lastMessageDate.diff(messageDate, 'minutes') <= -30) {
                html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                html += "                <\/div>";
                lastMessageDate = messageDate;
            }
            if (message.type === "update") {
                html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender update-message-font\" data-og-container=\"\">";
                html += "<i class='oli oli-newspaper'></i> " + message.message;
                html += "                <\/div>";
            }

            else {
                $(".fw-im-message-time").addClass("hidden");
                if (parseInt(sender.userId) !== parseInt(userId)) {

                    html += "<div  class=\"fw-im-message fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                    if (isUnicode(sender.firstName)) {
                        html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                    } else {
                        html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                    }
                    if (message.type === "text") {
                        if (message.onlyemoji) {
                            html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                        } else {
                            html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                        }
                        if (message.linkData !== null) {
                            html += getLinkPreview(JSON.parse(message.linkData), message.link);

                        }
                    }
                    if (message.type === "image") {
                        html += getImagePreview(message);
                    }
                    if (message.type === "video") {
                        html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                        html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                        html += "                    <\/div>";
                    }
                    if (message.type === "audio") {
                        html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                        html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                        html += "                    <\/div>";
                    }
                    if (message.type === "document") {
                        //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                        html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                        //html += "                    <\/div>";
                    }
                    html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                    if (sender.active === 1) {
                        html += "                        <img class='auth_" + sender.userId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                    } else {
                        html += "                        <img class='auth_" + sender.userId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                    }
                    html += "                    <\/div>";

                    html += "                <\/div>";
                    if (!mute) {
                        $.playSound("<?php echo base_url('assets/im/img/nf')?>");
                        //toastr.info("New Message from " + sender.firstName + " " + sender.lastName);
                    }
                } else {
                    html += "<div  class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";

                    if (message.type === "text") {
                        if (message.onlyemoji) {
                            html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                        } else {
                            html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                        }

                        if (message.linkData !== null) {
                            html += getLinkPreview(JSON.parse(message.linkData), message.link);

                        }
                    }
                    if (message.type === "image") {
                        html += getImagePreview(message);
                    }
                    if (message.type === "video") {
                        html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                        html += "                        <video class='mediaVideo' class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                        html += "                    <\/div>";
                    }
                    if (message.type === "audio") {
                        html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                        html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                        html += "                    <\/div>";
                    }
                    if (message.type === "document") {
                        //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                        html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                        //html += "                    <\/div>";
                    }
                    html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                    html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                    html += "                    <\/div>";
                    if (seen === null) {
                        html += "                    <div class=\"fw-im-message-time seen hidden seenId_" + message.m_id + "\">";
                        html += "                        <span class='seenMessage_" + message.m_id + "'><\/span>";
                        html += "                    <\/div>";
                    } else {
                        if (seen.time !== null) {
                            html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                            html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + moment(seen.time, moment.ISO_8601).calendar(null, momentOptions2) + "<\/span>";
                            html += "                    <\/div>";
                        } else {
                            html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                            html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + "<\/span>";
                            html += "                    <\/div>";
                        }
                    }
                    html += "                <\/div>";

                }
            }
            if (presentTypingDiv) {
                $(html).insertBefore(presentTypingDiv);
            } else {
                chatBox.append(html);
            }


            let isme = parseInt(sender.userId) !== parseInt(userId);
            if (message.type == "video") {
                initVideo("video_" + message.m_id, isme);
            } else if (message.type == "audio") {

                initAudio("audio_" + message.m_id, isme);
            } else if (message.type == "text" && isUnicode(message.message)) {
                $("#message_" + message.m_id).css({"direction": "rtl", "font-family": "Tahoma"});
            }
            let groupId = data.to;
            if (message.type == "text") {
                if (parseInt(sender.userId) == parseInt(userId)) {
                    $('#messageType_' + groupId).html("You: " + message.message);
                } else {
                    $('#messageType_' + groupId).html(sender.firstName + ": " + message.message);
                }


            } else if (message.type !== "update") {
                $('#messageType_' + groupId).html(message.type);
                lightBox.init();
            }
            $('#time_' + groupId).html(moment(message.ios_date_time, moment.ISO_8601).fromNow());
            time[groupId] = message.ios_date_time;
            groupObjects[groupId].lastActive=message.ios_date_time;

            let height = chatBox[0].scrollHeight;
            chatBox.scrollTop(height);
            clampData();
        });

        socket.on("getFetchOnReconnect", function (data) {


            //message section
            let messages = data.activeGroupMessages;
            let html = "";
            let message = null;
            let seen = null;
            let messageDate = null;
            let sender = null;
            if (messages.length > 0) {
                LastMessageId = parseInt(messages[messages.length - 1].message.m_id);
                time[activeGroupId] = messages[messages.length - 1].message.ios_date_time;

                $(".fw-im-message-time").addClass("hidden");
                for (let i = 0; i < messages.length; i++) {
                    message = messages[i].message;
                    sender = messages[i].sender;
                    seen = message.seen;
                    messageDate = moment(message.ios_date_time, moment.ISO_8601);
                    if (!lastMessageDate) {
                        html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                        html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                        html += "                <\/div>";
                        lastMessageDate = messageDate;
                    }
                    else if (lastMessageDate.date() - messageDate.date() >= 1 || lastMessageDate.date() - messageDate.date() <= -1) {
                        if (lastMessageDate !== messageDate) {
                            html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                            html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                            html += "                <\/div>";
                            lastMessageDate = messageDate;
                        }
                    } else if (lastMessageDate.diff(messageDate, 'minutes') <= -30) {
                        html += "<div class=\"fw-im-message  text-center fw-im-othersender\" data-og-container=\"\">";
                        html += moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions2);
                        html += "                <\/div>";
                        lastMessageDate = messageDate;
                    }
                    if (message.type === "update") {
                        html += "<div id='message_" + message.m_id + "' class=\"fw-im-message  text-center fw-im-othersender update-message-font\" data-og-container=\"\">";
                        html += "<i class='oli oli-newspaper'></i> " + message.message;
                        html += "                <\/div>";
                    }

                    else {

                        if (parseInt(sender.userId) !== parseInt(userId)) {

                            html += "<div  class=\"fw-im-message fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                            if (isUnicode(sender.firstName)) {
                                html += "<div class='fw-im-message-author-name font-Tahoma'>" + sender.firstName + "</div>";
                            } else {
                                html += "<div class='fw-im-message-author-name'>" + sender.firstName + "</div>";
                            }
                            if (message.type === "text") {
                                if (message.onlyemoji) {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                } else {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                }
                                if (message.linkData !== null) {
                                    html += getLinkPreview(JSON.parse(message.linkData), message.link);

                                }
                            }
                            if (message.type === "image") {
                                html += getImagePreview(message);
                            }
                            if (message.type === "video") {
                                html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                html += "                        <video class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                html += "                    <\/div>";
                            }
                            if (message.type === "audio") {
                                html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                html += "                    <\/div>";
                            }
                            if (message.type === "document") {
                                //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                                //html += "                    <\/div>";
                            }
                            html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                            if (sender.active === 1) {
                                html += "                        <img class='auth_" + sender.userId + " authStatus memberActive'  src=\"" + sender.profilePictureUrl + "\" >";
                            } else {
                                html += "                        <img class='auth_" + sender.userId + " authStatus' src=\"" + sender.profilePictureUrl + "\" >";
                            }
                            html += "                    <\/div>";

                            html += "                <\/div>";

                        } else {
                            html += "<div  class=\"fw-im-message  fw-im-isme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";


                            if (message.type === "text") {
                                if (message.onlyemoji) {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\" style='background-color:transparent;'>" + parseMessage(message.message, true) + "<\/div>";
                                } else {
                                    html += "                    <div id='message_" + message.m_id + "' class=\"fw-im-message-text\">" + parseMessage(message.message, false) + "<\/div>";
                                }

                                if (message.linkData !== null) {
                                    html += getLinkPreview(JSON.parse(message.linkData), message.link);

                                }
                            }
                            if (message.type === "image") {
                                html += getImagePreview(message);
                            }
                            if (message.type === "video") {
                                html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                html += "                        <video class='mediaVideo' class='mediaVideo' id='video_" + message.m_id + "' poster='" + message.poster + "' width=\"250px\" height=\"150px\" controls=\"true\" preload='none'  name=\"media\"><source src=\"" + message.message + "\" type=\"video\/mp4\"><\/video>";
                                html += "                    <\/div>";
                            }
                            if (message.type === "audio") {
                                html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments mediaAudio-player-wrapper\" >";
                                html += "                        <audio class='mediaAudio' id='audio_" + message.m_id + "' style='width:100%;height:100%;' width='100%' height='100%'  controls=\"true\" preload='none' name=\"media\"><source src=\"" + message.message + "\" type=\"audio\/mp3\"><\/audio>";
                                html += "                    <\/div>";
                            }
                            if (message.type === "document") {
                                //html += "<div id='message_" + message.m_id + "' class=\"fw-im-attachments\" >";
                                html += "                        <div class=\"fw-im-message-text\"><a target='_blank' id='document_" + message.m_id + "' href=" + message.message + " ><i class=\"fa fa-arrow-circle-down\"></i> " + message.fileName + "<\/a></div>";
                                //html += "                    <\/div>";
                            }
                            html += "                    <div class=\"fw-im-message-author\"  title=\"" + sender.firstName + " " + sender.lastName + "\">";
                            html += "                        <img src=\"" + sender.profilePictureUrl + "\" >";
                            html += "                    <\/div>";
                            if (seen === null) {
                                html += "                    <div class=\"fw-im-message-time seen hidden seenId_" + message.m_id + "\">";
                                html += "                        <span class='seenMessage_" + message.m_id + "'><\/span>";
                                html += "                    <\/div>";
                            } else {
                                if (seen.time !== null) {
                                    html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                                    html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + moment(seen.time, moment.ISO_8601).calendar(null, momentOptions2) + "<\/span>";
                                    html += "                    <\/div>";
                                } else {
                                    html += "                    <div class=\"fw-im-message-time seen  seenId_" + message.m_id + "\">";
                                    html += "                        <span class='seenMessage_" + message.m_id + "'>" + seen.seen + "<\/span>";
                                    html += "                    <\/div>";
                                }
                            }
                            html += "                <\/div>";

                        }
                    }
                }
                if (presentTypingDiv) {
                    $(html).insertBefore(presentTypingDiv);
                } else {
                    chatBox.append(html);
                }

                for (let i = 0; i < messages.length; i++) {
                    message = messages[i].message;
                    let sender = messages[i].sender;
                    let isme = parseInt(sender.userId) !== parseInt(userId);
                    if (message.type == "video") {
                        initVideo("video_" + message.m_id, isme);
                    } else if (message.type == "audio") {

                        initAudio("audio_" + message.m_id, isme);
                    }
                }
                lightBox.init();
                let height = chatBox[0].scrollHeight;
                chatBox.scrollTop(height);
                clampData();
            }
            //group section
            let groups = data.groups;
            for (let i = (groups.length-1); i >=0 ; i--) {
                groupObjects[groups[i].groupId] = groups[i];
                if (activeGroupId === parseInt(groups[i].groupId)) {
                    $(".UserNames").html(groups[i].groupName);
                }

            }
            if(activeGroupId) {
                let loopGroupObject = groupObjects[activeGroupId];
                if (!loopGroupObject.mute && messages.length > 0) {
                    $.playSound("<?php echo base_url('assets/im/img/nf')?>");
                }

                //block part
                if (loopGroupObject.block) {
                    if ($("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").removeClass("hidden");
                    }
                    $("#messageForm").hide();

                } else {
                    if (!$("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").addClass("hidden");
                    }
                    $("#messageForm").show();
                }
            }
            let difference = data.removedGroupIds;
            let leaveThisGroup=false;
            for (let i = 0; i < difference.length; i++) {
                if (activeGroupId == difference[i]) {
                    $("#showGroupInfo").hide();
                    socket.emit("leaveRoom", activeGroupId);
                    leaveThisGroup=true;

                }
                delete groupObjects[difference[i]];
            }
            if(leaveThisGroup){
                location.href = "<?php echo base_url('immobile/im') ?>";
            }

            localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
        });


        socket.on("userTyping", function (data) {
            let typerGroupId = parseInt(data.groupId);
            let currentGroupId = parseInt(activeGroupId);


            if (parseInt(data.userId) !== parseInt(userId) && typerGroupId === currentGroupId) {
                let html = "";

                html += "<div id='group_" + data.groupId + data.userId + "' class=\"fw-im-message fw-im-isnotme fw-im-othersender\" data-og-container=\"\" style=\"cursor:help\" title=\"" + moment(message.ios_date_time, moment.ISO_8601).calendar(null, momentOptions) + "\">";
                html += "                    <div  class=\"fw-im-message-text\" style='background-color: transparent;white-space: unset;'>";
                html+="<div class=\"fw-im-message-author-name\">"+data.userName+"</div>";
                html += "<div class=\"typing-indicator\">";
                html += "  <span><\/span>";
                html += "  <span><\/span>";
                html += "  <span><\/span>";
                html += "<\/div>";

                html += "<\/div>";
                html += "                    <div class=\"fw-im-message-author\" title=\"" + data.userName + "\">";
                html += "                        <img src=\"" + data.profilePicture + "\" title=\"" + data.userName + "\">";
                html += "                    <\/div>";
                html += "                <\/div>";

                chatBox.append(html);

                let height = chatBox[0].scrollHeight;
                chatBox.scrollTop(height);
                presentTypingDiv = $("#group_" + data.groupId + data.userId);
                if (!mute) {
                    $.playSound("<?php echo base_url('assets/im/img/typing')?>");
                }
            }

        });

        socket.on("receiveSeen", function (data) {
            let m_id = data.forMessage;
            let seenMessage = data.seen;
            $(".seenId_" + m_id).removeClass("hidden");
            if (seenMessage) {
                if (seenMessage.time != null && seenMessage.seen !== null) {
                    $(".seenMessage_" + m_id).html(seenMessage.seen + moment(seenMessage.time, moment.ISO_8601).calendar(null, momentOptions2));
                } else if (seenMessage.seen !== null) {
                    $(".seenMessage_" + m_id).html(seenMessage.seen);
                }
            }
            let elmnt = $(".seenMessage_" + m_id)[0];
            if (elmnt) {

                elmnt.scrollIntoView(false);
            }
        });

        socket.on("userNotTyping", function (data) {
            let typerGroupId = parseInt(data.groupId);
            let currentGroupId = parseInt(activeGroupId);
            $("#group_" + data.groupId + data.userId).remove();
            if (presentTypingDiv && presentTypingDiv.is("#group_" + data.groupId + data.userId)) {
                presentTypingDiv = null;
            }
            let height = chatBox[0].scrollHeight;
            chatBox.scrollTop(height);

        });

        socket.on("reconnect", function () {
            socket.emit("register", JSON.stringify(tokenData));
            let groupId = activeGroupId;
            if (groupId != null || groupId != "") {
                socket.emit("joinRoom", parseInt(groupId));
            }
            let objectGroupIds = [];
            $.each(groupObjects, function (key, value) {
                let loopGroupObject = value;
                objectGroupIds.push(parseInt(loopGroupObject.groupId));
            });
            let data = {
                _r: token,
                userId: userId,
                activeGroupId: activeGroupId, //current active group id
                //lastMessageId: LastMessageId, // current active group last massage id
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
            messageTyping=true;
            //$('#connectionErrorModal').modal('hide');
        });

        socket.on("reconnecting", function () {
            
                $(".memberStatus").removeClass("memberActive");
                $(".authStatus").removeClass("memberActive");
           
            //$('#connectionErrorModal').modal({backdrop: 'static', keyboard: false, show: true});
        });

        socket.on("updateGroupNameData", function (res) {
            let data = {
                "groupId": res.groupId,
                "groupName": res.groupName
            };
            let currentGroupId = $('#addMember').attr("data-group");
            if (document.getElementById('group_' + data.groupId)) {
                // group is present and user is currently in this group
                if (currentGroupId === data.groupId) {
                    $("#groupName_" + data.groupId).html("<div>" + data.groupName + "</div>");
                    $('.be-use-name').html(data.groupName);
                    $(".UserNames").html(data.groupName);
                    $clamp($('.be-use-name')[0], {clamp: 2, useNativeClamp: false});
                }
                // group is present but user currently not chatting on this group
                else {
                    $("#groupName_" + data.groupId).html("<div>" + data.groupName + "</div>");
                }
            }

        });

        socket.on("addNewMember", function (res) {
            let data = {
                "groupId": parseInt(res.groupId),
                "group": res.groupInfo,
                "members": res.memberList
            };

            let currentGroupId = parseInt(activeGroupId);
            groupObjects[data.groupId] = data.group;
            localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            // check group is present but user is not chatting on this group
            if (currentGroupId === data.groupId) {

                $("#UserNames").html(data.group.groupName);

            }

        });

        socket.on("deleteAMember", function (res) {

            let data = {
                "groupId": parseInt(res.groupId),
                "group": res.groupInfo,
                "members": res.memberList,
                "removeGroup": res.removeGroup
            };

            let currentGroupId = parseInt(activeGroupId);
            if (currentGroupId === data.groupId && data.removeGroup === true) {
                delete groupObjects[data.group];
                localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
                localStorage.removeItem("groupId");
                location.href = "<?php echo base_url('immobile/im') ?>";
            }
            if (currentGroupId === data.groupId && data.removeGroup === false) {
                $("#UserNames").html(data.group.groupName);
                groupObjects[data.groupId] = data.group;
                localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            }
            if (data.removeGroup === true) {
                delete groupObjects[data.group];
                localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            }


        });


        socket.on("updateStatus", function (res) {

            let data = res;
            if (parseInt(data.status) === 1) {
                if (!$("#member_" + data.userId).hasClass("memberActive")) {
                    $("#member_" + data.userId).addClass("memberActive");
                }
                if (!$(".auth_" + data.userId).hasClass("memberActive")) {
                    $(".auth_" + data.userId).addClass("memberActive");
                }
            } else {
                if ($("#member_" + data.userId).hasClass("memberActive")) {
                    $("#member_" + data.userId).removeClass("memberActive");
                }
                if ($(".auth_" + data.userId).hasClass("memberActive")) {
                    $(".auth_" + data.userId).removeClass("memberActive");
                }
            }

        });

        socket.on("updateStatusOnReconnect", function (res) {
            let data = res;
            for (let i = 0; i < data.friendsIds.length; i++) {
                if (!$("#member_" + data.friendsIds[i].userId).hasClass("memberActive")) {
                    $("#member_" + data.friendsIds[i].userId).addClass("memberActive");
                }
                if (!$(".auth_" + data.friendsIds[i].userId).hasClass("memberActive")) {
                    $(".auth_" + data.friendsIds[i].userId).addClass("memberActive");
                }
            }

        });

        socket.on("blockStatus", function (data) {

            if (activeGroupId === data.groupId) {
                if (data.block) {
                    if (parseInt(userId) === parseInt(data.userId)) {
                        if (!$("#block").hasClass("hidden")) {
                            $("#block").addClass("hidden");
                        }
                        if ($("#unblock").hasClass("hidden")) {
                            $("#unblock").removeClass("hidden");
                        }

                    }

                } else {
                    if (parseInt(userId) === parseInt(data.userId)) {
                        if ($("#block").hasClass("hidden")) {
                            $("#block").removeClass("hidden");
                        }
                        if (!$("#unblock").hasClass("hidden")) {
                            $("#unblock").addClass("hidden");
                        }
                    }

                }
                if (data.fullUnblock) {
                    if ($("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").removeClass("hidden");
                    }

                    $("#messageForm").hide();
                } else {
                    if (!$("#blockmessage").hasClass("hidden")) {
                        $("#blockmessage").addClass("hidden");
                    }
                    $("#messageForm").show();
                }
            }
            groupObjects[data.groupId] = data.blockGroup;
            localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            block = data.block;

        });

        socket.on("muteStatus", function (data) {
            if (activeGroupId === data.groupId && document.getElementById("group_" + data.groupId)) {
                if (!data.mute) {
                    if ($("#mute").hasClass("hidden")) {
                        $("#mute").removeClass("hidden");
                    }
                    if (!$("#unmute").hasClass("hidden")) {
                        $("#unmute").addClass("hidden");
                    }
                    if (!$("#mute_" + data.groupId).hasClass("hidden")) {
                        $("#mute_" + data.groupId).addClass("hidden");
                    }
                } else {
                    if (!$("#mute").hasClass("hidden")) {
                        $("#mute").addClass("hidden");
                    }
                    if ($("#unmute").hasClass("hidden")) {
                        $("#unmute").removeClass("hidden");
                    }
                    if ($("#mute_" + data.groupId).hasClass("hidden")) {
                        $("#mute_" + data.groupId).removeClass("hidden");
                    }
                }

            } else {
                if (document.getElementById("group_" + data.groupId)) {
                    if (!data.mute) {
                        if (!$("#mute_" + data.groupId).hasClass("hidden")) {
                            $("#mute_" + data.groupId).addClass("hidden");
                        }
                    } else {
                        if ($("#mute_" + data.groupId).hasClass("hidden")) {
                            $("#mute_" + data.groupId).removeClass("hidden");
                        }
                    }
                }
            }
            groupObjects[data.groupId].mute = data.mute;
            localStorage.setItem("groupObjects", JSON.stringify(groupObjects));
            mute = data.mute;
        });

        socket.on("errorMessage", function (data) {
            toastr.error("data");
        });

//------------------ End of web socket section -------------------------

       // setInterval(updateTime, 60000);
    });


</script>
</body>
</html>