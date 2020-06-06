const group=require("./group");
const serverConf= require("./serverConf");

let mysqlCon;
let app={};
let Im_blocklist={};
let Im_group_members_Model={};
let Im_group_Model={};
let Im_message_Model={};
let Im_receiver_Model={};

app.setMysql= (mysql)=>{
    if(!mysqlCon){
        mysqlCon=mysql;
        group.setMysql(mysql);
    }
};


//--------- Im_block_list_model-------//

Im_blocklist.ifExistInList=async (userId,memberIds)=>{
    let ids=memberIds.map(String).join(",");
    let query="select distinct igm.u_id from im_group_members igm INNER JOIN im_blocklist ibl on ibl.g_id=igm.g_id where ibl.u_id=? and igm.u_id<>? and igm.u_id IN (?)";
    let result=await mysqlCon.execute(query,[userId,userId,ids]);
    if(result.length === 0){
        return 0;
    }else{
        return 1;
    }
};

//-------- Im_group_members_Model---------//

Im_group_members_Model.getPersonalGroups=async (userIds,limit,start)=>{
    userIds=userIds.map(String).join(",");
    let query="select distinct igm.g_id,ig.type,ig.lastActive from im_group_members igm INNER JOIN im_group ig ON ig.g_id=igm.g_id where ig.type=1 and igm.u_id IN (?) ORDER BY ig.lastActive DESC ";
    let result=await mysqlCon.execute(query,[userIds]);
    return result;
};

Im_group_members_Model.getNonPersonalGroups = async (userIds,limit,start)=>{
    userIds=userIds.map(String).join(",");
    let query="select distinct igm.g_id,ig.type,ig.lastActive from im_group_members igm INNER JOIN im_group ig ON ig.g_id=igm.g_id where ig.type=0 and igm.u_id IN (?) ORDER BY ig.lastActive DESC";
    let result=await mysqlCon.execute(query,[userIds]);
    return result;
};

Im_group_members_Model.getTotalGroupMember= async (g_id)=>{
    let query="SELECT count(u_id) as total from im_group_members where g_id=?";
    let result=await mysqlCon.execute(query,[g_id]);
    return result[0].total;
};

Im_group_members_Model.getMembers=async (g_id)=>{
    let query="select u_id from im_group_members where g_id=?";
    let result=await mysqlCon.execute(query,[g_id]);
    return result;
};

Im_group_members_Model.insert=async function (g_id,u_id){
  let query="INSERT INTO im_group_members (g_id,u_id) VALUES (?,?)";
    await mysqlCon.execute(query,[g_id,u_id]);
};

//-------------- Im_group_Model -----------//

Im_group_Model.insert=async (name,lastActive,type,createdBy)=>{
    let query="INSERT INTO im_group (name,lastActive,type,createdBy) VALUES (?,?,?,?)";
    let res=await mysqlCon.execute(query,[name,lastActive,type,createdBy]);
    return res.insertId;
};

Im_group_Model.isBlocked=async (g_id)=>{
    let query="select * from im_group where g_id=? and block=1";
    let result=await mysqlCon.execute(query,[g_id]);
    if(result.length === 0){
        return 0;
    }else{
        return 1;
    }
};

Im_group_Model.updateLastActiveDate=async (g_id,lastActive)=>{
    let query="UPDATE im_group SET lastActive=? WHERE g_id=?";
    await mysqlCon.execute(query,[lastActive,g_id]);
};

//---------------- Im_message_Model -------------//

Im_message_Model.getRecentMessage = async (g_id)=>{
    let query="select * from im_message where receiver=? and type <> 'update'  order by m_id DESC LIMIT 1";
    let result=await mysqlCon.execute(query,[g_id]);
    if(result.length>0){
        let prepareData=result[0];
        prepareData.poster="";
        if(prepareData.type!="text" && prepareData.type!="update" && prepareData.type!="document"){
            prepareData.message= serverConf.getHost()+"assets/im/im/group_"+g_id+"/"+prepareData.message;
        }
        if(prepareData.type=="document"){
            let fileUrl=encodeURIComponent("assets/im/im/group_"+prepareData.receiver+"/"+prepareData.message)+"&fn="+encodeURIComponent(prepareData.fileName);
            prepareData.message=serverConf.getHost()+"download?f="+fileUrl;
        }
        if(prepareData.type=="video"){
            prepareData.poster=serverConf.getHost()+"assets/im/img/poster.jpg";
        }
        return prepareData;
    }
};

Im_message_Model.getRecentMessageWithUpdate = async (g_id)=>{
    let query="select * from im_message where receiver=? order by m_id DESC LIMIT 1";
    let result=await mysqlCon.execute(query,[g_id]);
    if(result.length>0){
        let prepareData=result[0];
        prepareData.poster="";
        if(prepareData.type!="text" && prepareData.type!="update" && prepareData.type!="document"){
            prepareData.message= serverConf.getHost()+"assets/im/im/group_"+g_id+"/"+prepareData.message;
        }
        if(prepareData.type=="document"){
            let fileUrl=encodeURIComponent(serverConf.getHost() + "assets/im/im/group_"+prepareData.receiver+"/"+prepareData.message)+"&fn="+encodeURIComponent(prepareData.fileName);
            prepareData.message=serverConf.getHost()+"download?f="+fileUrl;
        }
        if(prepareData.type=="video"){
            prepareData.poster=serverConf.getHost()+"assets/im/img/poster.jpg";
        }
        return prepareData;
    }
};

Im_message_Model.insert= async (u_id,g_id,message,type,fileName,receiver_type,date,time,date_time)=>{
    let query="INSERT INTO im_message (sender,receiver,message,type,fileName,receiver_type,date,time,date_time) VALUES (?,?,?,?,?,?,?,?,?)";
    let res= await mysqlCon.execute(query,[u_id,g_id,message,type,fileName,receiver_type,date,time,date_time]);
    return res.insertId;
};


//------------ Im_receiver_Model --------------//

Im_receiver_Model.deleteByGroupId=async (g_id)=>{
    let query="DELETE from im_receiver where g_id=?";
    await mysqlCon.execute(query,[g_id]);
};

app.Im_blocklist=Im_blocklist;
app.Im_group_members_Model=Im_group_members_Model;
app.Im_group_Model=Im_group_Model;
app.Im_message_Model=Im_message_Model;
app.Im_receiver_Model=Im_receiver_Model;
module.exports=app;