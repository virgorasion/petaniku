const serverConf= require("./serverConf");

let mysqlCon;
let app = {};

app.setMysql= (mysql)=>{
    if (!mysqlCon) {
        mysqlCon = mysql;
    }
};

app.get_user = async (u_id) =>{
    try {


        let userData = await mysqlCon.execute("SELECT * FROM `im_users` WHERE `userId` = ?", [u_id]);
        if(!userData){
            return null;
        }
        let url = serverConf.getHost() + "assets/im/img/download.png";
        if (userData[0].userProfilePicture !== null) {
            url = serverConf.getHost() + "assets/im/userImage/" + userData[0].userProfilePicture;
        }
        return {
            'userId': parseInt(userData[0].userId),
            'firstName': userData[0].firstName,
            'lastName': userData[0].lastName,
            'userEmail': userData[0].userEmail,
            'userAddress': userData[0].userAddress,
            'userMobile': userData[0].userMobile,
            'userStatus': parseInt(userData[0].userStatus),
            'userGender': userData[0].userGender,
            'profilePictureUrl': url,
            'active': parseInt(userData[0].active)
        }
    }catch (e) {
        return null;
    }
};

app.messageProcess=async (message) =>{
    message.ios_date_time=message.date_time;
    message.poster="";
    if(message.type!="text" && message.type!="document" && message.type!="update"){
        message.message=serverConf.getHost()+ "assets/im/im/group_"+message.receiver+"/"+message.message;
    }
    if(message.type=="document"){
        let fileUrl=encodeURIComponent(serverConf.getHost() + "assets/im/im/group_"+message.receiver+"/"+message.message)+"&f="+encodeURIComponent(message.fileName);
        message.message=serverConf.getHost()+"download?u="+fileUrl;
    }
    if(message.type=="video"){
        message.poster=serverConf.getHost()+"assets/im/img/poster.jpg";
    }
    if(message.type=="update"){
        message.message=await app.processUpdate(message.message);
    }
    return message;
};

app.processUpdate=async (message)=> {
    let str=message.split(" ");
    if(app.isNumeric(str[0])){
        let user=await app.get_user(str[0]);
        if(user){
            str[0]=user.firstName;
        }else {
            str[0]="unknown"
        }

    }
    if(app.isNumeric(str[str.length-1])){
        let user=await app.get_user(str[str.length-1]);
        if(user){
            str[str.length-1]=user.firstName;
        }else {
            str[str.length-1]="unknown"
        }

    }
    return str.join(" ");
};
app.isNumeric=function (n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
};

app.isMute= async (u_id,g_id)=>{
let query="select * from im_mutelist where u_id= ? and g_id= ?";
let result=await mysqlCon.execute(query,[u_id,g_id]);

 if(result.length === 0){
     return 0;
 }else{
     return 1;
 }
};
app.ifExistsInBlockList=async (u_id,g_id)=>{
    let query="select * from im_blocklist where u_id= ? and g_id= ?";
    let result=await mysqlCon.execute(query,[u_id,g_id]);

    if(result.length === 0){
        return 0;
    }else{
        return 1;
    }
};

app.get_group = async (g_id, u_id) => {
    let membersInfo = [];
    let groupImage = [];
    let groupInfo = await mysqlCon.execute("SELECT * FROM `im_group` WHERE `g_id` =? ORDER BY `lastActive` DESC LIMIT 1", [g_id]);
    let recentMessage= await mysqlCon.execute("select * from im_message where receiver=? and type <>'update' order by m_id DESC",[g_id]);
    let lastActive=recentMessage[0].date_time;

    let groupName = groupInfo[0].name;
    let block=groupInfo[0].block;
    let type=parseInt(groupInfo[0].type);
    let blocker=0;
    if (type && block){
        blocker= await app.ifExistsInBlockList(u_id,g_id);
    }
    let  mute =await app.isMute(u_id,g_id);
    let pending = await mysqlCon.execute("SELECT (CASE WHEN COUNT(m_id) >= 100 THEN 99 ELSE COUNT(m_id) END) as pending FROM `im_receiver` WHERE `r_id` = ? AND `g_id` = ? AND `received` =0 GROUP BY `g_id`", [u_id, g_id]);
    let totalPending = 0;
    if(pending.length>0){
        totalPending=pending[0].pending;
    }
    let members = await mysqlCon.execute("SELECT `u_id` FROM `im_group_members` WHERE `g_id` = ? AND `u_id` <> ?", [g_id, u_id]);
    for (let i = 0; i < members.length; i++) {
        let user=await app.get_user(members[i].u_id)
            if(user){
                membersInfo.push(user);
            }

    }
    if(membersInfo.length===0){
        groupImage.push(serverConf.getHost() + "/assets/im/img/download.png");
        if (groupName === null || groupName === "" || groupName === '""' || groupName === "''") {
            groupName = "No Member";
        }
    }else{
        for(let i=0;i<membersInfo.length;i++){
            if(i===3){
                break;
            }else {
                groupImage.push(membersInfo[i].profilePictureUrl);
            }
        }
    }


    if (groupName === null || groupName === "" || groupName === '""' || groupName === "''" || groupName === "''") {
        groupName = "No Member";
        let groupNameArray=[];
        for(let i=0;i<membersInfo.length;i++){
            if(membersInfo.length===1){
                groupNameArray.push(membersInfo[i].firstName+" "+membersInfo[i].lastName);
                break;
            }else{
                groupNameArray.push(membersInfo[i].firstName);
            }
        }
        if(groupNameArray.length>0){
            groupName=groupNameArray.join(", ");
        }

    }
    let meCreator=false;
    if(groupInfo[0].createdBy===parseInt(u_id)){
        meCreator=true;
    }

    let formattedMessage=recentMessage[0].message;
    if(parseInt(recentMessage[0].sender)===parseInt(u_id)){
        formattedMessage= "You: "+formattedMessage;
    }else{
        let user=await app.get_user(recentMessage[0].sender);
        let name="Unknown";
        if(user){
            name=user.firstName;
        }
        formattedMessage= name+": "+formattedMessage;
    }

    return {
        "groupId": parseInt(g_id),
        "groupImage": groupImage,
        "groupName": String(groupName).trim(),
        //"totalMember":totalMember,
        "lastActive": lastActive,
        "groupType":type,
        "block":block,
        "meBlocker":blocker,
        "meCreator":meCreator,
        "mute": mute,
        "members":membersInfo,
        //"me":me,
        "recentMessage": formattedMessage,
        "mainRecentMessage":recentMessage[0].message,
        "senderId":parseInt(recentMessage[0].sender),
        "messageType": recentMessage[0].type,
        "pendingMessage": totalPending
        //"messageDateTime":recentMessage.date_time,
    };


};

app.processSeen=async (receivedTime,g_id,receiverIds)=> {

        let membersIds=receiverIds;
        let totalMember=await mysqlCon.execute("SELECT count(u_id) as total FROM `im_group_members` WHERE `g_id` = ?",[g_id]);
        if(membersIds.length===0){
            return null;
        }
        if(totalMember[0].total===2){
            //new Date(new Date().toUTCString()).toISOString()
            return {
                seen: "Seen ",
                time: receivedTime
            };
        }
        if((totalMember[0].total-1)===membersIds.length){
            return {
                seen: "Seen By everyone ",
                time: null
            };
            //return "Seen By everyone";
        }
        let names=[];
        for(let i=0;i<membersIds.length;i++){
            let name="Unknown"
            let user=await app.get_user(membersIds[i]);
            if(user){
                names.push(String(user.firstName));
            }else{
                names.push(name)
            }


        }

         return {
             seen: "Seen By "+names.join(","),
             time: null
         };

};

app.isReceived=async (r_id,g_id,m_id)=> {
    let result= await mysqlCon.execute("SELECT COUNT(*) AS `numrows` FROM `im_receiver` WHERE `g_id` =? AND `r_id` =? AND `m_id` =? AND `received` = 1",[g_id,r_id,m_id]);
    return result.length !== 0;

};



module.exports = app;
