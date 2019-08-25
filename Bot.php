<?php
/*
לכל בעיה אני בטלגרם @Elazar12
*/ 
ob_start(); 
//לשים תטוקן של הבוט שלכם במקום המילה Token
$API_KEY =  "Token";
define('API_KEY', $API_KEY);
function bot($method,$datas=[]){
 $url = "https://api.telegram.org/bot".API_KEY."/".$method; 
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
    var_dump(curl_error($ch));
}else{
    return json_decode($res);
   }

}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$mid = $message->message_id;
$name = $message->from->first_name;
$id = $message->from->id;
$is_bot = $message->new_chat_member->is_bot;
$A1 =$update->message->new_chat_member->first_name;
$A2 = $update->message->new_chat_member->last_name;
//לשים קישור לרובוט בלי @ 
$grup = "israelbot";

//מוחק הודעת כניסה 
if (isset ($update->message->new_chat_member )) {
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid
]);
}
//מוחק הודעה עזב
if (isset ($update->message->left_chat_member )) {
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid
]);
}


if($text == '/start'){
bot('sendChatAction',array('chat_id'=>$chat_id,'action'=>"typing"));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
שלום לך $name 👋 

אני רובוט נגד ערבים 👿

- אני מסיר תמשתמש 🚫
- וגם מוחק תהודעה שלו 🗑️
- אני מסיר כל רובוט שמשתמש מוסיף 🤖
- אני עובד על שקט 🔕

יש להוסיף את הרובוט לקבוצה ולתת לו ניהול 


להוספת הרובוט לקבוצה [לחץ כאן](https://telegram.me/$grup?startgroup=new)


לכל בעיה פנה אלי - @Elazar12 👨‍💻
",
'parse_mode' => 'Markdown',
'reply_to_message_id'=>$message->message_id
    ]);
}

if ($is_bot != false) {
 bot('kickChatMember',[
 'chat_id'=>$chat_id, 'user_id'=>$update->message->new_chat_member->id,
]);
}
if( (preg_match("/\p{Arabic}|🇮🇷|^[آ-ی]$/u", $A1))||(preg_match("/\p{Arabic}|🇮🇷|^[آ-ی]$/u", $A2))){
bot('kickChatmember',[
'chat_id'=>$chat_id,
'user_id'=>$update->message->from->id,
]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}
if(preg_match("/\p{Arabic}|🇮🇷|^[آ-ی]$/u", $message->caption)){
bot('kickChatmember',[
'chat_id'=>$chat_id,
'user_id'=>$update->message->from->id,
]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}
if(preg_match("/\p{Arabic}|🇮🇷|^[آ-ی]$/u", $message->document->file_name)){
bot('kickChatmember',[
'chat_id'=>$chat_id,
'user_id'=>$update->message->from->id,
]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}
if(preg_match("/\p{Arabic}|🇮🇷|^[آ-ی]$/u", $message->text)){
bot('kickChatmember',[
'chat_id'=>$chat_id,
'user_id'=>$update->message->from->id,
]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}
