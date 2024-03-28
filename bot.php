<?php
/*
jahanbots
jahanbots
jahanbots

jahanbots


@jahanbots
*/
ob_start();
error_reporting(0);
define('API_KEY','902827269:AAFB4gdKmG7Oc5XIiACYStpz6JDEv_2DKa'); // توکن
//-----------------------------------------------------------------------------------------
//فانکشن jijibot :
function jijibot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    return json_decode($res);
    }
//-----------------------------------------------------------------------------------------
//متغیر ها :
$admin = array("114635738","0000000","000000");
$usernamebot = "jahanbots"; // یوزرنیم ربات
$channel = "jahanbots"; // یوزرنیم کانال
$channelby = "jahanbots"; // یوزرنیم کانال گزارش خرید کاربران
$web = ""; // ادرس ربات شماره مجازی
//-----------------------------------------------------------------------------------------------
// متغیر های پرداخت آفلاین
$cardnumber = ""; // شماره کارت خود را وارد کنید
$ownercard = "  "; // نام صاحب کارت را وارد کنید
//-----------------------------------------------------------------------------------------------
$apikey = ""; // API key sms-activate 5sim.net
//-----------------------------------------------------------------------------------------------
// database 
// اطلاعات دیتا بیس را وارد کنید
$servername = "localhost";
$username = "";
$password = '';
$dbname = "";
$connect = mysqli_connect($servername, $username, $password, $dbname);

//-----------------------------------------------------------------------------------------------
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
if(isset($message->from)){
$message_id = $message->message_id;
$text = $message->text;
$first_name = $message->from->first_name;
$username = $message->from->username;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$tc = $message->chat->type;
// data
$user = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM user WHERE id = '$from_id' LIMIT 1"));
}
if(isset($update->callback_query)){
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$firstname = $update->callback_query->from->first_name;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$membercall = $update->callback_query->id;
// data
$usercall = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM user WHERE id = '$fromid' LIMIT 1")); 
}
//================================================================================
// function
function getbalance() {
global $apikey;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://5sim.net/v1/user/profile/stubs/handler_api.php?api_key=$apikey&action=getBalance");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
$curl_exec = curl_exec($ch);
curl_close($ch);
return $curl_exec;
}
function jahanbots($service , $country) {
global $apikey;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://sms-activate.api.5sim.net/stubs/handler_api.php?api_key=$apikey&action=jahanbots&service=$service&country=$country");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
$curl_exec = curl_exec($ch);
curl_close($ch);
return $curl_exec;
}
function setstats($orderid) {
global $apikey;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://sms-activate.api.5sim.net/stubs/handler_api.php?api_key=$apikey&action=setStatus&status=-1&id=$orderid");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
$curl_exec = curl_exec($ch);
curl_close($ch);
return $curl_exec;
}
function getstats($orderid) {
global $apikey;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://sms-activate.api.5sim.net/stubs/handler_api.php?api_key=$apikey&action=getStatus&id=$orderid");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
$curl_exec = curl_exec($ch);
curl_close($ch);
return $curl_exec;
}
//================================================================================
if($text=="/start"){
	jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $first_name 👋
به ربات شماره مجازی نامبرسل خوش آمدید🌹
با این ربات میتوانید در مدت زمان 1دقیقه صاحب شماره مجازی اختصاصی خود شوید.🤗

برای اطلاعات بیشتر به قسمت راهنما مراجعه کنید.

@jahanbots",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
    		]);
if ($user["id"] != true){
$connect->query("INSERT INTO `user` (`id`, `step`, `stock`, `member`, `listby`, `inviter`, `service`) VALUES ('$from_id', 'none', '0', '0', '', '', '')");
}
}
elseif(strpos($text , '/start ') !== false  ) {
if ($user["id"] == true){
	jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $first_name 👋
به ربات شماره مجازی نامبرسل خوش آمدید🥰
با این ربات میتوانید در مدت زمان 1دقیقه صاحب شماره مجازی اختصاصی خود شوید🤩

برای اطلاعات بیشتر به قسمت راهنما مراجعه کنید.

@jahanbots",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
    		]);
}
else
{
$start = str_replace("/start ","",$text);
$user = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM user WHERE id = '$start' LIMIT 1"));
$plusmember = $user["member"] + 1;
	jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $first_name 👋
به ربات شماره مجازی نامبرسل خوش آمدید🥰
با این ربات میتوانید در مدت زمان 1دقیقه صاحب شماره مجازی اختصاصی خود شوید🤩

برای اطلاعات بیشتر به قسمت راهنما مراجعه کنید

@jahanbots",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
    		]);
$name = str_replace(["`","*","_","[","]","(",")","```"],"",$first_name);
jijibot('sendmessage',[
	'chat_id'=>$start,
	'text'=>"🌟 تبریک ! کاربر [$name](tg://user?id=$from_id) با استفاده از لینک دعوت شما وارد ربات شده
❄️ یک نفر به مجموع زیر مجموعه های شما اضاف شد !

📋 در صورتی که زیر مجموعه شما از ربات خرید کند شما مطلع خواهید شد
💰 5 درصد از هر خرید زیر مجموعه به عنوان هدیه به موجودی شما اضافه میگردد
👥 تعداد زیر مجموعه ها : $plusmember",
	'parse_mode'=>'Markdown',
	  	]);
$connect->query("UPDATE user SET member = '$plusmember' WHERE id = '$start' LIMIT 1");
$connect->query("INSERT INTO `user` (`id`, `step`, `stock`, `member`, `listby`, `inviter`, `service`) VALUES ('$from_id', 'none', '0', '0', '', '$start', '')");
}
}
elseif($text=="🏛 خانه"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔘 به منوی اصلی بازگشتید 
	
🌟 گزینه مورد نظر خودت رو انتخاب کن 👇🏻",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");	
}
elseif($text=="🛒 خرید شماره"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔘 میخواهید در چه برنامه ای ثبت نام کنید ؟ سرویس یا اپلکیشن مورد نظر خود را انتخاب کنید 👇🏻

⚠️ توجه کنید در انتخاب سرویس دقت کنید ! زیر کد تایید ارسالی بر اساس سرویس دسته بندی خواهد شد .
ℹ️ درصورتی که در این قسمت نیاز به راهنما دارید از دکمه '🚦راهنما' استفاده کنید",
'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"💎 تلگرام"],['text'=>"📨 گوگل"]
				],
				           [
                   ['text'=>"📸 اینستاگرام"],['text'=>"📱 واتساپ"]
                ],
                 [
                   ['text'=>"📗 لاین"],['text'=>"🐦 توییتر"],['text'=>"💡 ویبر"]
                ],
				                 [
                   ['text'=>"💻 ماکروسافت"],['text'=>"📪 فیسبوک"],['text'=>"💬 وی چت"]
                ],
								                 [
                   ['text'=>"📞 یاهو"],['text'=>"❄️ امازون"],['text'=>"☎️ وب مانی"]
                ],
				                 [
                   ['text'=>"🏛 خانه"],['text'=>"🚦راهنما"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
}
else
{
 jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="📊 استعلام | قیمت ها"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
$info = json_decode(file_get_contents("numberstats.json"),true);	
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"☑️ قیمت و استعلام موجودی شماره ‌ها 👇🏻
⏱ آخرین بروز رسانی : {$info["time"]}
ℹ️ لیست شماره های موجود و استعلام شماره ها هر 5 دقیقه یک بار بروز خواهد شد .

🗣 نمایش تعداد شماره های موجود به صورت پیش فرض برای نرم افزار محبوب 'تلگرام' تنظیم شده و تعداد شماره های موجود ممکن است در سرویس های دیگر متفاوت باشد

✅ = موجود میباشد
❌ = موجود نیست
❗️ = نامشخص است

🔄 اگر از تلفن همراه استفاده میکنید ! برای نمایش بهتر لیست استعلام گوشی خود را در حالت افقی نگه دارید.",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
				[
	['text'=>"🌏 کشور",'callback_data'=>"text"],['text'=>"💰 قیمت",'callback_data'=>"text"],['text'=>"✅ وضعیت",'callback_data'=>"text"]
	],
						[
['text'=>"🇩🇿الجزایر🇩🇿",'callback_data'=>"text"],
['text'=>"15000",'callback_data'=>"text"],
['text'=>"{$info["algeria"]}",'callback_data'=>"text"]
	],
						[
	['text'=>"🇧🇩بنگلادش🇧🇩",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["bangladesh"]}",'callback_data'=>"text"]
	],
										[
	['text'=>"🇧🇾بلاروس🇧🇾",'callback_data'=>"text"],
	['text'=>"18000",'callback_data'=>"text"],
	['text'=>"{$info["belarus"]}",'callback_data'=>"text"]
	],
											[
	['text'=>"🇰🇭کامبوج🇰🇭",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["cambodia"]}",'callback_data'=>"text"]
	],
												[
	['text'=>"🇨🇲کامرون🇨🇲",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["cameroon"]}",'callback_data'=>"text"]
	],
													[
	['text'=>"🇨🇦کانادا🇨🇦",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["canada"]}",'callback_data'=>"text"]
	],
									[
	['text'=>"🇨🇳چین🇨🇳",'callback_data'=>"text"],
	['text'=>"3000",'callback_data'=>"text"],
	['text'=>"{$info["china"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇪🇬مصر🇪🇬",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["egypt"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿󠁧󠁢󠁥󠁮󠁧󠁿󠁧󠁢󠁥󠁮󠁧󠁿",'callback_data'=>"text"],
	['text'=>"35000",'callback_data'=>"text"],
	['text'=>"{$info["england"]}",'callback_data'=>"text"]
	],
																					[
	['text'=>"🇪🇹اتیوپی🇪🇹",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ethiopia"]}",'callback_data'=>"text"]
	],
																						[
	['text'=>"🇬🇲گامبیا🇬🇲",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["gambia"]}",'callback_data'=>"text"]
	],
													[
	['text'=>"🇬🇭غنا🇬🇭",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ghana"]}",'callback_data'=>"text"]
	],
																	[
	['text'=>"🇭🇹هایتی🇭🇹",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["haiti"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇭🇰هنگ کنگ🇭🇰",'callback_data'=>"text"],
	['text'=>"5000",'callback_data'=>"text"],
	['text'=>"{$info["hongkong"]}",'callback_data'=>"text"]
	],
														[
	['text'=>"🇮🇩اندونزی🇮🇩",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["indonesia"]}",'callback_data'=>"text"]
	],
								[
	['text'=>"🇮🇪ایرلند🇮🇪",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ireland"]}",'callback_data'=>"text"]
	],
										[
	['text'=>"🇨🇮ساحل عاج🇨🇮",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ivorycoast"]}",'callback_data'=>"text"]
	],
											[
	['text'=>"🇰🇿قزاقستان🇰🇿",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["kazakhstan"]}",'callback_data'=>"text"]
	],
															[
	['text'=>"🇱🇻لتونی🇱🇻",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["latvia"]}",'callback_data'=>"text"]
	],	
																[
	['text'=>"🇲🇴ماکائو🇲🇴",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["macao"]}",'callback_data'=>"text"]
	],	
																[
	['text'=>"🇲🇬ماداگاسکار🇲🇬",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["madagascar"]}",'callback_data'=>"text"]
	],
																	[
	['text'=>"🇲🇾مالزی🇲🇾",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["malaysia"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇲🇽مکزیک🇲🇽",'callback_data'=>"text"],
	['text'=>"13000",'callback_data'=>"text"],
	['text'=>"{$info["mexico"]}",'callback_data'=>"text"]
	],													
					[
	['text'=>"➡️ صفحه بعد",'callback_data'=>"next"],['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="🖥 حساب کاربری"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
$listby = count(explode("^", $user["listby"])) - 1;
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🎫 حساب کاربری شما در ربات خرید شماره مجازی :

🗣 نام : $first_name
🆔 شناسه : $from_id
💰 موجودی : {$user["stock"]} تومان
🛍 تعداد خرید : $listby
👥 تعداد زیر مجموعه ها : {$user["member"]} نفر

💎 با دعوت هر نفر به ربات 5 درصد از هر خرید هر زیر مجموعه را هدیه بگیرید
🌟 برای کسب اطمینان نسبت به ربات و خرید های موفق میتوانید به کانال خرید ها مراجعه کنید 👇🏻",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
			[
	['text'=>"👥 زیرمجموعه گیری",'callback_data'=>"member"],['text'=>"💎 خرید من",'callback_data'=>"myby"]
	],
				[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="jfuewqdoiqdfiofudfaiuwefuiwehfufweufuiwefdjfuewf"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
$stock = $user["stock"] - 200;
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⤴️ برای انتقال موجودی ابتدا شناسه فرد را وارد کنید و در خط پایین مقدار موجودی ارسالی را به تومان وارد کنید !	
🆔 شناسه کاربری هر فرد در قسمت اطلاعات حساب وی مشخص هست 
💰 حداکثر موجودی قابل انتقال : $stock تومان

⚠️ توجه کنید که هزینه انتقال موجودی برای هر بار 200 تومان میباشد ! و حداقل انتقال موجودی 100 تومان میباشد
ℹ️ مثال :
267785153
1000",
'reply_markup'=>json_encode([
            	'keyboard'=>[
								    [
                ['text'=>"🏛 خانه"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
$connect->query("UPDATE user SET step = 'sendcoin' WHERE id = '$from_id' LIMIT 1");
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="💸 شارژ حساب"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"💵 به قسمت شارژ حساب خوش آمدید 

💎 برای افزایش موجودی حساب خود بر روی هر یک از مبالغ دلخواه کلیک کرده و پس از منتقل شدن به درگاه امن بانک، آن را پرداخت کنید .
☑️ تمامی پرداخت ها به صورت اتوماتیک بوده و پس از تراکنش موفق مبلغ آن به موجودی حساب شما در ربات افزوده خواهد شد .

🆔 شناسه : $from_id
💰 موجودی : {$user["stock"]} تومان

👮🏻 در صورت بروز هرگونه مشکل و یا انجام نشدن پرداخت کافیست با پشتیبانی در تماس باشید .
🌟 لطفا بسته مورد نظر خود را انتخاب کنید تا به صفحه خرید منتقل شوید 👇🏻",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"💰 1000 تومان",'url'=>"$web/pay/pay.php?amount=1000&id=$from_id"],['text'=>"💰 2000 تومان",'url'=>"$web/pay/pay.php?amount=2000&id=$from_id"]
	],
		[
	['text'=>"💰 3000 تومان",'url'=>"$web/pay/pay.php?amount=3000&id=$from_id"],['text'=>"💰 5000 تومان",'url'=>"$web/pay/pay.php?amount=5000&id=$from_id"]
	],
			[
	['text'=>"💰 8000 تومان",'url'=>"$web/pay/pay.php?amount=8000&id=$from_id"],['text'=>"💰 10000 تومان",'url'=>"$web/pay/pay.php?amount=10000&id=$from_id"]
	],
				[
	['text'=>"💰 20000 تومان",'url'=>"$web/pay/pay.php?amount=20000&id=$from_id"],['text'=>"💰 50000 تومان",'url'=>"$web/pay/pay.php?amount=50000&id=$from_id"]
	],
					[
['text'=>"💎 مبالغ دیگر",'callback_data'=>'otheramount']
	],
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="👥 زیرمجموعه گیری"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
		$id = jijibot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>"https://t.me/jahanbots/460",
	'caption'=>"☎️ ربات شماره مجازی نامبرسل (رایگان؛پولی)

📲 بدون نیاز به سیمکارت اکانت جدید در تلگرام، واتساپ و ... بساز 
و به هرکس دوست داری پیام بده !

🌀 تو این ربات میتونید شماره مجازی همه کشورهارو دریافت کنید به صورت اتوماتیک و در چند ثانیه! اون هم بصورت رایگان!
👇

t.me/$usernamebot?start=$from_id",
    		])->result->message_id;
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"💬 پیام بالا حاوی لینک دعوت اختصاصی شما به ربات است 	
🗣 با معرفی ربات به دوستان خود 5 درصد از هر افزایش موجودی به عنوان هدیه به شما داده خواهد شد .

💰 موجودی شما : {$user["stock"]} تومان
👥 تعداد زیر مجموعه ها : {$user["member"]} نفر",
	'reply_to_message_id'=>$id,
    		]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="☎️ پشتیبانی"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"👮🏻 همکاران ما در خدمت شما هستن !
	
🔘 در صورت وجود نظر , ایده , گزارش مشکل , پیشنهاد , ایراد سوال , یا انتقاد میتوانید با ما در ارتباط باشید 
💬 لطفا پیام خود را به صورت فارسی و روان ارسال کنید",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
								    [
                ['text'=>"🏛 خانه"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
$connect->query("UPDATE user SET step = 'sup' WHERE id = '$from_id' LIMIT 1");	
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="🚦راهنما"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🚸 به بخش راهنما خوش امدید

🤗 شما با استفاده از این ربات هوشمند شماره مجازی کشور ها مختلف را به صورت ارزان خریدار می کنید.
♋️ تمام روند خرید و دریافت شماره و ثبت نام در برنامه مورد نظر کاملا اتوماتیک انجام می شود.
📴 با کم ترین هزینه ممکن در سریع ترین زمان و امن ترین حالت ممکن شماره مجازی خود را خریداری نمایید.
👮🏻 در صورت بروز هرگونه مشکل با کلید بر روی دکمه پشتیبانی در منو اصلی با ما ارتباط برقرار نمایید.

👇🏼 از منو زیر جهت راهنمایی استفاده کنید",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"شماره مجازی چیست🤔"],
				],
				           [
                   ['text'=>"💰کسب درامد💰"],['text'=>"🖌آموزش خرید🖌"]
                ],
                 [
                   ['text'=>"👮‍♀قوانین👮‍♀"],['text'=>"♻️درباره♻️"],['text'=>"⚠️سوالات متداول⚠️"]
                ],
				                 [
                   ['text'=>"🏛 خانه"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
elseif($text=="❌ لغو خرید"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ خرید شما با موفقیت لغو شد و مبلغی از حساب شما کسر نشد !
	
🔘 به منوی اصلی بازگشتید 
🌟 گزینه مورد نظر خودت رو انتخاب کن 👇🏻",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
setstats(explode("^",$user["service"])[2]);
}
elseif($text=="❌ لغو"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ پروسه افزایش موجودی با موفقیت لغو شد .
	
🔘 به منوی اصلی بازگشتید 
🌟 گزینه مورد نظر خودت رو انتخاب کن 👇🏻",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");	
}
elseif($text=="💬 دریافت کد"){
$allinfo = explode("^",$user["service"]);
$info = explode(":",getstats($allinfo[2]));
switch ($info[0]) {
    case "STATUS_OK":
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ کد با موفقیت دریافت شد
💭 کد ورود شما به برنامه : $info[1]

🛍 با تشکر از خرید شما ! گزارش خرید به کانال ما @$channelby ارسال شد . 
👮🏻 درصورت وجود هرگونه مشکل کافیست با پشتیبانی در تماس باشید",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
$amount = str_replace(["algeria","bangladesh","belarus","cambodia","cameroon","canada","china","egypt","england","ethiopia","gambia","ghana","haiti","hongkong","indonesia","ireland","ivorycoast","kazakhstan","latvia","macao","madagascar","malaysia","mexico","mozambique","nigeria","pakistan","panama","peru","philippines","poland","romania","russia","serbia","southafrica","thailand","usa","vietnam","yemen","zambia"],["15000","9000","18000","9000","15000","20000","3000","20000","35000","15000","15000","13000","13000","9000","9000","13000","15000","9000","20000","9000","9000","15000","20000","9000","15000","8000","9000","15000","9000","25000","15000","5000","15000","15000","15000","25000","9000","13000","9000"],$allinfo[1]);
$plusstock = $user["stock"] - $amount;
$connect->query("UPDATE user SET stock = '$plusstock' , listby = CONCAT (listby,'+$allinfo[3] -> $info[1]^') WHERE id = '$from_id' LIMIT 1");
$name = str_replace(["algeria","bangladesh","belarus","cambodia","cameroon","canada","china","egypt","england","ethiopia","gambia","ghana","haiti","hongkong","indonesia","ireland","ivorycoast","kazakhstan","latvia","macao","madagascar","malaysia","mexico","mozambique","nigeria","pakistan","panama","peru","philippines","poland","romania","russia","serbia","southafrica","thailand","usa","vietnam","yemen","zambia"],["🇩🇿الجزایر🇩🇿","🇧🇩بنگلادش🇧🇩","🇧🇾بلاروس🇧🇾","🇰🇭کامبوج🇰🇭","🇨🇲کامرون🇨🇲","🇨🇦کانادا🇨🇦","🇨🇳چین🇨🇳","🇪🇬مصر🇪🇬","🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿","🇪🇹اتیوپی🇪🇹","🇬🇲گامبیا🇬🇲","🇬🇭غنا🇬🇭","🇭🇹هایتی🇭🇹","🇭🇰هنگ کنگ🇭🇰","🇮🇩اندونزی🇮🇩","🇮🇪ایرلند🇮🇪","🇨🇮ساحل عاج🇨🇮","🇰🇿قزاقستان🇰🇿","🇱🇻لتونی🇱🇻","🇲🇴ماکائو🇲🇴","🇲🇬ماداگاسکار🇲🇬","🇲🇾مالزی🇲🇾","🇲🇽مکزیک🇲🇽","🇲🇿موزامبیک🇲🇿","🇳🇬نیجریه🇳🇬","🇵🇰پاکستان🇵🇰","🇵🇦پاناما🇵🇦","🇵🇪پرو🇵🇪","🇵🇭فیلیپین🇵🇭","🇵🇱لهستان🇵🇱","🇷🇴رومانی🇷🇴","🇷🇺روسیه🇷🇺","🇷🇸صربستان🇷🇸","🇿🇦آفریقای جنوبی🇿🇦","🇹🇭تایلند🇹🇭","🇺🇸 آمریکا 🇺🇸","🇻🇳ویتنام🇻🇳","🇾🇪یمن🇾🇪","🇿🇲زامبیا🇿🇲"],$allinfo[1]);
$servic = str_replace(["telegram","google","instagram","whatsapp","line","twitter","viber","microsoft","facebook","wechat","yahoo","amazon","webmoney"],["💎 تلگرام","📨 گوگل","📸 اینستاگرام","📱 واتساپ","📗 لاین","🐦 توییتر","💡 ویبر","💻 ماکروسافت","📪 فیسبوک","💬 وی چت","📞 یاهو","❄️ امازون","☎️ وب مانی"],$allinfo[0]);
date_default_timezone_set('Asia/Tehran'); 
$time = date("Y-m-d | H:i:s");
$number = mb_substr("$allinfo[3]","0","7")."***";
$getid = mb_substr("$from_id","0","5")."***";
$listby = count(explode("^", $user["listby"]));
jijibot('sendmessage',[
	'chat_id'=>"@$channelby",
	'text'=>"📱یک عدد شماره مجازی  $name خریداری شد! 
⏰ در ساعت : $time
💎 اطلاعات خرید 👇🏻
🤖 @$usernamebot",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
				[
	['text'=>"🌏 کشور",'callback_data'=>"text"],['text'=>"$name",'callback_data'=>"text"]
	],
					[
	['text'=>"🔘 سرویس",'callback_data'=>"text"],['text'=>"$servic",'callback_data'=>"text"]
	],
						[
	['text'=>"📞 شماره",'callback_data'=>"text"],['text'=>"+$number",'callback_data'=>"text"]
	],
							[
	['text'=>"💎 قیمت",'callback_data'=>"text"],['text'=>"$amount",'callback_data'=>"text"]
	],
								[
	['text'=>"👤 شناسه کاربر",'callback_data'=>"text"],['text'=>"$getid",'callback_data'=>"text"]
	],
									[
	['text'=>"🛍 تعداد خرید",'callback_data'=>"text"],['text'=>"$listby",'callback_data'=>"text"]
	],
										[
['text'=>"👥 تعداد زیرمجموعه",'callback_data'=>"text"],['text'=>"{$user["member"]}",'callback_data'=>"text"]
	],
																[
	['text'=>"💈ورود به ربات شماره مجازی نامبرسل💈",'url'=>"https://t.me/$usernamebot"],
	],
              ]
        ])
            ]);	
        break;
		case "STATUS_WAIT_CODE":
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ کد فعال سازی هنوز ارسال نشده است !

ℹ️ لطفا دقت فرمایید شماره به همراه با پیش شماره و به صورت صحیح وارد کرده باشید و بعد از 30 ثانیه روی دریافت کد ضربه بزنید

🔆 درصورت وجود هرگونه مشکل کافیست سفارش خود را لغو کنید . در صورت دریافت نشدن کد مبلغی از شما کسر نخواهد شد !

❗️ از ارسال پشت سر هم دریافت کد خودداری کنید . در صورت ارسال اسپم از ربات مسدود خواهید شد !
",
'reply_to_message_id'=>$message_id,
'parse_mode'=>'MarkDown',
			'reply_markup'=>json_encode([
            	'keyboard'=>[
				                 [
                   ['text'=>"❌ لغو خرید"],['text'=>"💬 دریافت کد"]
                ],
 	],
            	'resize_keyboard'=>true
       		])	
            ]);
        break;
    default:
	jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⏰ زمان برای دریافت کد برای سفارش شما به پایان رسید !
ℹ️ حداکثر زمان برای دریافت کد 3 دقیقه میباشد و پس از آن سفارش لغو خواهد شد
	
❌ سفارش شما لغو شد و مبلغی از حساب شما کسر نشد ! میتوانید نسبت به خرید دوباره اقدام کنید
👮🏻 درصورت وجود هرگونه مشکل کافیست با پشتیبانی در تماس باشید",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
            ]);
setstats(explode("^",$user["service"])[2]);
}
}
elseif($text=="شماره مجازی چیست🤔"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📱 شماره مجازی چیست ؟

☎️ هنگام ثبت‌نام در اپلیکیشن‌های پیام ‌رسان و شبکه‌های اجتماعی موبایل، باید از شماره تلفن خود به عنوان شناسه استفاده کنید. اگر از کاربرانی هستید که علاقه‌ای به اشتراک‌گذاری شماره‌ی اصلی خود ندارید یا اینکه نیاز به ثبت‌نام بیش از یک بار در این برنامه‌ها دارید، می‌توانید از شماره‌های مجازی استفاده کنید. همچنین شماره مجازی این امکان را می‌دهد که بدون ثبت سیم کارت و اهراز هویت و بدون صرف وقت و هزینه صاحب شماره از کشور های مختلف شوید.

ℹ️ مزایا و کاربرد شماره مجازی چیست

➊ تلگرام، واتس اپ، وایبر، اینستاگرام  و... برای ثبت‌نام به شماره تلفن شما نیاز دارند تا کدفعال‌سازی مربوطه را برای تشخیص هویت به تلفن‌تان ارسال کنند که به جای شماره اصلی خود میتوان از شماره مجازی برای فعال کردن حساب خود استفاده کرد.

➋ بسیاری از افراد به دلایل مختلف مانند مدیریت یک اکانت دیگر برای مباحث کاری یا... نیاز به اکانت دوم دارند تا بتوانند در عین ارتباط داشتن با مشتریان، از تلگرام شخصی و خصوصی خود نیز استفاده کنند.
 
➌ بدون ثبت نام در اپراتور و بدون صرف وقت و هزینه و اهراز هویت صاحب شماره مجازی می شوید .

➍ استفاده در تمامی اپلیکیشن های اجتماعی با شماره از کشورهای مختلف! همراه با هویتی ناشناس

🤖 @$usernamebot",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif($text=="⚠️سوالات متداول⚠️"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"❓ سوالات متداول

❓شماره خریدم کد نمیده چیکار کنم؟
▫️جواب : ابتدا فیلم آموزش نحوه خرید را مشاهده کنید. جهت دریافت کد پس از اطمینان از ارسال کد توسط اپلیکیشن درخواستی به شماره مورد نظر 30 ثانیه صبر کنید و سپس بر روی دکمه دریافت کد کلیک کنید ، اگر پس از گذشت 5 دقیقه از دریافت شماره، کد را دریافت نکردید بر روی دکمه بازگشت کلیک کنید سپس مجددا نسبت به دریافت شماره جدید و کد اقدام نمایید.

❓شماره رو وارد آپ کردم میگه شماره اشتباهه(مسدوده) و پیام Banned Number میدهد چکار کنم؟
▫️جواب : این حالت بیشتر برای شماره چین ، روسیه و آمریکا پیش میاد. بر روی دکمه بازگشت کلیک کنید سپس مجددا نسبت به دریافت شماره جدید و کد اقدام نمایید.

❓کد تایید گرفتم اما وارد آپ نکردم، باید چیکار کنم؟
▫️جواب : متاسفانه امکان بازگشت وجه در چنین وضعیتی وجود ندارد. چون پول شماره در پنل خارجی همزمان با دریافت کد از حساب ما کم میشود‌.

❓شماره از ربات خریدم اما بعد از چند دقیقه شماره دلیت اکانت شد علت چیه؟
▫️جواب : علت دلیت اکانت شدن شماره‌ حساس شدن تلگرام نسبت به ip شماست.
از آنجایی که تلگرام مخالف با عضو فیک است نباید بیش از 3 شماره مجازی بر روی یک ip ثبت نام کنید.
اگر قصد دارید تعداد بالا شماره مجازی خریداری و ثبت نام کنید، باید آی پی خود را پس از ثبت هر شماره تغییر دهید.
🗣 برای تغییر آی پی دو راه وجود دارد :
1️⃣ استفاده از VPN
2️⃣خاموش و روشن کردن مودم ، یا خاموش و روشن کردن دیتا در تلفن همراه برای چند دقیقه موجب تغییر آی پی شما خواهد شد.

❓شماره‌ای که برای تلگرام خریدم بعد از دریافت کد یه نفر دیگه داخل اکانت بود یا two-step verification روی اکانت فعال بود، و نتوستم وارد اکانت بشم ، الان چکار کنم؟
▫️جواب : با توجه به اینکه شماره ها مستقیما از پنل های خارجی دریافت می شوند و ربات نامبر جی تنها واسط بین کاربر و پنل است امکان بررسی شماره ها توسط ما امکان پذیر نیست! به همین علت گاها ممکن است بعد از دریافت کد اکانتی از قبل توسط شماره مورد نظر در اپلیکیشن مورد نظرتان خصوصا تلگرام فعال باشد؛ تنها راه حل برای جلوگیری از بروز این مشکل، چک کردن شماره مجازی قبل از دریافت کد است، بررسی این که شماره مجازی در اپلیکیشن مورد نظرتان قبلا ثبت شده است یا خیر به راحتی امکان پذیر است، برای تلگرام اگر شماره ثبت شده باشد بلافاصله با وارد کردن شماره در تلگرام پیغام ارسال کد به تلگرام فعال دیگر نمایش داده می شود و مانند شماره های ریجستر نشده نیست و این مورد به راحتی برای تلگرام و دیگر اپلیکیشن ها قابل بررسی است؛ در هر صورت اگر شماره ای دریافت کردید که از قبل ثبت شده بود (به ندرت پیش می آید) هرگونه عواقب آن بر عهده خریدار خواهد بود و ربات هیچ گونه مسئولیتی در رابطه با بی دقتی کاربران را برعهده نمی گیرد.

❓شماره بدون ریپورت یعنی چی؟
▫️جواب : شماره های مجازی اغلب محدودیت ارسال پیام به اکانت های ایرانی را به مدت 4 روز دارند، بعد از 4 روز این محدودیت از بین خواهد رفت اما نوعی شماره ها در ربات وجود دارد که از همان ابتدا این محدودیت را ندارند و مانند خطوط ایرانی میتوان از همان ابتدا به اکانت های ایرانی پیام داد که اصطلاحا بدون ریپورت نام گذاری شده اند.

💎 سوالاتان در این بخش نبود ؟ به منوی اصلی برگردید و با پشتیبانی در تماس باشید 

🤖 @jahanbots",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif($text=="💰کسب درامد💰"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔰 راهنمای کسب درآمد

💎 با دریافت لینک مخصوص زیر مجموعه گیری خود از منو تومان رایگان؛ به ازای هر خرید زیرمجموعه های شما از ربات، اعتبار شما به میزان 5 درصد از مبلغ خریداری شده شارژ می شود.
(برای مثال؛ اگر زیر مجموعه شما 10 هزارتومان خرید کند ، حساب شما 500 تومان شارژ خواهد شد)

🍁 برای مثال اگر روزانه 10 نفر از لینک شما عضو ربات شوند، و میانگین هر زیر مجموعه بطور ماهانه 10000 تومان خرید کند.
بعد از یک ماه درآمد شما 150 هزارتومان خواهد رسید!!!

🤗 با کمی تبلیغات به راحتی میتوانید میلیونر شوید. 
🗣 جهت دریافت لینک مخصوص زیر مجموعه گیری خود به منو اصلی برگشته و دکمه دعوت دیگران را انتخاب نمایید.

🤖 @$usernamebot",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif($text=="👮‍♀قوانین👮‍♀"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"💁🏻‍♂️ قوانین و توضیحات :

1️⃣ شماره ها اختصاصی هستند و معمولا فقط به یک نفر داده میشوند توجه داشته باشید که ما مسئول از بین رفتن هیچ اکانتی نیستیم به این دلیل که ما سازنده این شماره ها نیستم و از مدیریت ما خارج میباشد 

2️⃣ شماره ها مصرفین پس تموم میشن ، پس دلیل وجود نداشتن شماره اینه که تموم شدن ؛ اما سریعا باز هم اورده میشه.

3️⃣ اوردن شماره ها دست ما نیست و باید اپراتور اون کشور شماره ارائه بده تا بتونیم بیاریم.

4️⃣ تمامی ربات های توی تلگرام و حتی سایت ها به یک منبع مشخص شماره ها متصل هستند پس اگر توی این ربات شماره ای موجود نباشه ، توی هیچ ربات و سایت دیگه ای هم موجود نیست‌.

5️⃣ تمامی شماره های ربات خام هستند یعنی قبل از شما ثبت نام نکرده اند ، بجز برخی شماره های کشور چین و روسیه که برای جلوگیری از این شماره رو توی تلگرام چک کنید و سپس اقدام به گرفتن کد کنید

6️⃣ اما لازم به ذکر هست که پس از دریافت کد دیگه به هیچکس اون شماره فروخته نمیشه و کسی به اکانت شما نمیتواند از طریق خط وارد شود.

7️⃣ شماره هایی هم کمیاب هستن و خیلی ها دنبال این شماره ها هستن پس برای گرفتن این شماره ها درصورتی که در ربات موجود نباشن باید حداقل هر ساعت یک بار چک کنید که اگر موجود شد سریعا خریداری کنید. (مثل شماره های انگلستان که درخواست زیادی دارند)

8️⃣ لطفا شماره رو به صورت کامل وارد کنید و  برای این که دچار اشتباه نشید شماره رو کپی کنید

9️⃣در صورتی که شماره های زیادی با IP شما ثبت نام شده باشند از شماره های چین یا روسیه استفاده نکنید چون ممکنه IP شما توسط تلگرام بلاک شده باشه و اکانت دلیت شود.

🔟 در صورتی که کد دریافت نکردید باید برگشت بزنید و شماره جدید دریافت کنید ، برای دریافت کد باید شماره را در اپ اصلی آن نرم افزار وارد کنید تا کد دریافت نکنید پولی از شما کسر نخواهد شد

⚠️ برای اینکه امکان بلاک شدن شماره ها به صفر برسه توصیه میشه از وی پی ان استفاده کنید و موقع ساخت شماره اسم اکانتتون رو به زبون همون کشور بنویسید با گوگل ترنسلیت این امر بسیار راحته  بعد چند روز اسم خودتونو بزارید.

1️⃣1️⃣ با توجه به اینکه تلگرام مخالف عضو فیک هست لذا نامبر جی هیچ مسئولیتی در قبال دلیت شدن اکانت (Delete account) یا لاگ اوت (Log out) شدن اکانت ندارد. همچنین پس از تحویل کد، ربات دیگر هیچ مسئولیتی در مورد شماره ندارد.

2️⃣1️⃣ در صورت عمل نکردن به بندهای بالا عواقب آن بر عهده شماست و وجهی بازگشت داده نمی‌شود.

🤖 @$usernamebot",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif($text=="♻️درباره♻️"){
jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"ℹ️ درباره ربات فروش شماره مجازی  :

🤖 ربات شماره مجازی کاملا به صورت اختصاصی برنامه نویسی شده جهت ارائه شماره مجازی برای کشور های مختلف
🔘 تمام حقوق و متون پیام ها و سورس کد ربات محفوظ است و هر نوع کپی بر داری پیگرد قانونی دارد

🎈 برنامه نویسی شده جهت خرید شماره مجازی به صورت خودکار و سهولت در خرید شماره مجازی مطمعن و اسان

🤖 @$usernamebot",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif($text=="🖌آموزش خرید🖌"){
jijibot('sendvideo',[
	'chat_id'=>$chat_id,
	'video'=>"https://t.me/justfortestjiji/177",
	'caption'=>"🎥 گیف اموزشی خرید شماره مجازی
🤖 @$usernamebot",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
            ]);
}
elseif(in_array($text, array("💎 تلگرام","📨 گوگل","📸 اینستاگرام","📱 واتساپ","📗 لاین","🐦 توییتر","💡 ویبر","💻 ماکروسافت","📪 فیسبوک","💬 وی چت","📞 یاهو","❄️ امازون","☎️ وب مانی"))){
$strname = str_replace(["💎 تلگرام","📨 گوگل","📸 اینستاگرام","📱 واتساپ","📗 لاین","🐦 توییتر","💡 ویبر","💻 ماکروسافت","📪 فیسبوک","💬 وی چت","📞 یاهو","❄️ امازون","☎️ وب مانی"],["تلگرام","گوگل","اینستاگرام","واتساپ","لاین","توییتر","ویبر","بیتالک","فیسبوک","وی چت","یاهو","امازون","وب مانی"],$text);
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✅ سرویس شما با موفقیت $strname تنظیم شد
💰 موجودی : {$user["stock"]} تومان
			
🌟 همه شماره کشور ها اختصاصی و بدون فروش قبل و بعدن هستن ! و محدودیت ریپورت ندارد .
🌍 کشور مورد نظر را انتخاب کنید 👇🏻",
'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"🇩🇿الجزایر🇩🇿"],['text'=>"🇧🇩بنگلادش🇧🇩"]
				],
												[
				['text'=>"🇧🇾بلاروس🇧🇾"],['text'=>"🇰🇭کامبوج🇰🇭"]
				],
												[
				['text'=>"🇨🇲کامرون🇨🇲"],['text'=>"🇨🇦کانادا🇨🇦"]
				],
												[
				['text'=>"🇨🇳چین🇨🇳"],['text'=>"🇪🇬مصر🇪🇬"]
				],
												[
				['text'=>"🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿"],['text'=>"🇪🇹اتیوپی🇪🇹"]
				],
												[
				['text'=>"🇬🇲گامبیا🇬🇲"],['text'=>"🇬🇭غنا🇬🇭"]
				],
												[
				['text'=>"🇭🇹هایتی🇭🇹"],['text'=>"🇭🇰هنگ کنگ🇭🇰"]
				],
												[
				['text'=>"🇮🇩اندونزی🇮🇩"],['text'=>"🇮🇪ایرلند🇮🇪"]
				],
												[
				['text'=>"🇨🇮ساحل عاج🇨🇮"],['text'=>"🇰🇿قزاقستان🇰🇿"]
				],
												[
				['text'=>"🇱🇻لتونی🇱🇻"],['text'=>"🇲🇴ماکائو🇲🇴"]
				],
																[
				['text'=>"🇲🇬ماداگاسکار🇲🇬"],['text'=>"🇲🇾مالزی🇲🇾"]
				],
												[
				['text'=>"🇲🇽مکزیک🇲🇽"],['text'=>"🇲🇿موزامبیک🇲🇿"]
				],
																[
				['text'=>"🇳🇬نیجریه🇳🇬"],['text'=>"🇵🇰پاکستان🇵🇰"]
				],
												[
				['text'=>"🇵🇦پاناما🇵🇦"],['text'=>"🇵🇪پرو🇵🇪"]
				],
																[
				['text'=>"🇵🇭فیلیپین🇵🇭"],['text'=>"🇵🇱لهستان🇵🇱"]
				],
												[
				['text'=>"🇷🇴رومانی🇷🇴"],['text'=>"🇷🇺روسیه🇷🇺"]
				],
																[
				['text'=>"🇷🇸صربستان🇷🇸"],['text'=>"🇿🇦آفریقای جنوبی🇿🇦"]
				],
												[
				['text'=>"🇹🇭تایلند🇹🇭"],['text'=>"🇺🇸 آمریکا 🇺🇸"]
				],
																[
				['text'=>"🇻🇳ویتنام🇻🇳"],['text'=>"🇾🇪یمن🇾🇪"]
				],
																[
				['text'=>"🇿🇲زامبیا🇿🇲"]
				],
				                 [
                   ['text'=>"🏛 خانه"],['text'=>"💸 شارژ حساب"]
                ]
 	],
            	'resize_keyboard'=>true
       		])	
 ]);
$str = str_replace(["💎 تلگرام","📨 گوگل","📸 اینستاگرام","📱 واتساپ","📗 لاین","🐦 توییتر","💡 ویبر","💻 ماکروسافت","📪 فیسبوک","💬 وی چت","📞 یاهو","❄️ امازون","☎️ وب مانی"],["telegram","google","instagram","whatsapp","line","twitter","viber","microsoft","facebook","wechat","yahoo","amazon","webmoney"],$text);
$connect->query("UPDATE user SET service = '$str^' WHERE id = '$from_id' LIMIT 1");	
}
elseif(in_array($text, array("🇩🇿الجزایر🇩🇿","🇧🇩بنگلادش🇧🇩","🇧🇾بلاروس🇧🇾","🇰🇭کامبوج🇰🇭","🇨🇲کامرون🇨🇲","🇨🇦کانادا🇨🇦","🇨🇳چین🇨🇳","🇪🇬مصر🇪🇬","🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿","🇪🇹اتیوپی🇪🇹","🇬🇲گامبیا🇬🇲","🇬🇭غنا🇬🇭","🇭🇹هایتی🇭🇹","🇭🇰هنگ کنگ🇭🇰","🇮🇩اندونزی🇮🇩","🇮🇪ایرلند🇮🇪","🇨🇮ساحل عاج🇨🇮","🇰🇿قزاقستان🇰🇿","🇱🇻لتونی🇱🇻","🇲🇴ماکائو🇲🇴","🇲🇬ماداگاسکار🇲🇬","🇲🇾مالزی🇲🇾","🇲🇽مکزیک🇲🇽","🇲🇿موزامبیک🇲🇿","🇳🇬نیجریه🇳🇬","🇵🇰پاکستان🇵🇰","🇵🇦پاناما🇵🇦","🇵🇪پرو🇵🇪","🇵🇭فیلیپین🇵🇭","🇵🇱لهستان🇵🇱","🇷🇴رومانی🇷🇴","🇷🇺روسیه🇷🇺","🇷🇸صربستان🇷🇸","🇿🇦آفریقای جنوبی🇿🇦","🇹🇭تایلند🇹🇭","🇺🇸 آمریکا 🇺🇸","🇻🇳ویتنام🇻🇳","🇾🇪یمن🇾🇪","🇿🇲زامبیا🇿🇲"))){
$amount = str_replace(["🇩🇿الجزایر🇩🇿","🇧🇩بنگلادش🇧🇩","🇧🇾بلاروس🇧🇾","🇰🇭کامبوج🇰🇭","🇨🇲کامرون🇨🇲","🇨🇦کانادا🇨🇦","🇨🇳چین🇨🇳","🇪🇬مصر🇪🇬","🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿","🇪🇹اتیوپی🇪🇹","🇬🇲گامبیا🇬🇲","🇬🇭غنا🇬🇭","🇭🇹هایتی🇭🇹","🇭🇰هنگ کنگ🇭🇰","🇮🇩اندونزی🇮🇩","🇮🇪ایرلند🇮🇪","🇨🇮ساحل عاج🇨🇮","🇰🇿قزاقستان🇰🇿","🇱🇻لتونی🇱🇻","🇲🇴ماکائو🇲🇴","🇲🇬ماداگاسکار🇲🇬","🇲🇾مالزی🇲🇾","🇲🇽مکزیک🇲🇽","🇲🇿موزامبیک🇲🇿","🇳🇬نیجریه🇳🇬","🇵🇰پاکستان🇵🇰","🇵🇦پاناما🇵🇦","🇵🇪پرو🇵🇪","🇵🇭فیلیپین🇵🇭","🇵🇱لهستان🇵🇱","🇷🇴رومانی🇷🇴","🇷🇺روسیه🇷🇺","🇷🇸صربستان🇷🇸","🇿🇦آفریقای جنوبی🇿🇦","🇹🇭تایلند🇹🇭","🇺🇸 آمریکا 🇺🇸","🇻🇳ویتنام🇻🇳","🇾🇪یمن🇾🇪","🇿🇲زامبیا🇿🇲"],["15000","9000","18000","9000","15000","20000","3000","20000","35000","15000","15000","13000","13000","9000","9000","13000","15000","9000","20000","9000","9000","15000","20000","9000","15000","8000","9000","15000","9000","25000","15000","5000","15000","15000","15000","25000","9000","13000","9000"],$text);
if($user["stock"] >= $amount){
$name = str_replace(["🇩🇿الجزایر🇩🇿","🇧🇩بنگلادش🇧🇩","🇧🇾بلاروس🇧🇾","🇰🇭کامبوج🇰🇭","🇨🇲کامرون🇨🇲","🇨🇦کانادا🇨🇦","🇨🇳چین🇨🇳","🇪🇬مصر🇪🇬","🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿","🇪🇹اتیوپی🇪🇹","🇬🇲گامبیا🇬🇲","🇬🇭غنا🇬🇭","🇭🇹هایتی🇭🇹","🇭🇰هنگ کنگ🇭🇰","🇮🇩اندونزی🇮🇩","🇮🇪ایرلند🇮🇪","🇨🇮ساحل عاج🇨🇮","🇰🇿قزاقستان🇰🇿","🇱🇻لتونی🇱🇻","🇲🇴ماکائو🇲🇴","🇲🇬ماداگاسکار🇲🇬","🇲🇾مالزی🇲🇾","🇲🇽مکزیک🇲🇽","🇲🇿موزامبیک🇲🇿","🇳🇬نیجریه🇳🇬","🇵🇰پاکستان🇵🇰","🇵🇦پاناما🇵🇦","🇵🇪پرو🇵🇪","🇵🇭فیلیپین🇵🇭","🇵🇱لهستان🇵🇱","🇷🇴رومانی🇷🇴","🇷🇺روسیه🇷🇺","🇷🇸صربستان🇷🇸","🇿🇦آفریقای جنوبی🇿🇦","🇹🇭تایلند🇹🇭","🇺🇸 آمریکا 🇺🇸","🇻🇳ویتنام🇻🇳","🇾🇪یمن🇾🇪","🇿🇲زامبیا🇿🇲"],["algeria","bangladesh","belarus","cambodia","cameroon","canada","china","egypt","england","ethiopia","gambia","ghana","haiti","hongkong","indonesia","ireland","ivorycoast","kazakhstan","latvia","macao","madagascar","malaysia","mexico","mozambique","nigeria","pakistan","panama","peru","philippines","poland","romania","russia","serbia","southafrica","thailand","usa","vietnam","yemen","zambia"],$text);
$info = explode(":",jahanbots(explode("^",$user["service"])[0] , $name));
$servic = str_replace(["telegram","google","instagram","whatsapp","line","twitter","viber","microsoft","facebook","wechat","yahoo","amazon","webmoney"],["💎 تلگرام","📨 گوگل","📸 اینستاگرام","📱 واتساپ","📗 لاین","🐦 توییتر","💡 ویبر","💻 ماکروسافت","📪 فیسبوک","?? وی چت","📞 یاهو","❄️ امازون","☎️ وب مانی"],explode("^",$user["service"])[0]);
if($info[0] == "ACCESS_NUMBER"){
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✅ شماره کشور '$text' با موفقیت ساخته شد			
📞 شماره مجازی شما
+$info[2]

ℹ️ شماره را همراه با پیش شماره در سرویس '$servic' وارد کنید و پس از 30 ثانیه روی دریافت کد ضربه بزنید !

❗️ درصورت وجود هر گونه مشکل و تمایل نداشتن به خرید میتونید خرید خود را لغو کنید ! مبلغی از شما کسر نخواهد شد",
'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
            	'keyboard'=>[
				                 [
                   ['text'=>"❌ لغو خرید"],['text'=>"💬 دریافت کد"]
                ]
 	],
            	'resize_keyboard'=>true
       		])	
 ]);
$connect->query("UPDATE user SET service = CONCAT (service,'$name^$info[1]^$info[2]')  WHERE id = '$from_id' LIMIT 1");	
}
else
{
       jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"⚠️ شماره ای برای ارائه در حال حاظر برای این کشور وجود ندارد !
ℹ️ برای مشاهده لیست کشور های قابل ارائه از دکمه '📊 استعلام | قیمت ها' استفاده کنید
			
🌟 لطفا کشور دیگری را انتخاب کنید یا ساعاتی دیگر مجدد امتحان کنید 👇🏻",
'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
            	'keyboard'=>[
								[
				['text'=>"🇩🇿الجزایر🇩🇿"],['text'=>"🇧🇩بنگلادش🇧🇩"]
				],
												[
				['text'=>"🇧🇾بلاروس🇧🇾"],['text'=>"🇰🇭کامبوج🇰🇭"]
				],
												[
				['text'=>"🇨🇲کامرون🇨🇲"],['text'=>"🇨🇦کانادا🇨🇦"]
				],
												[
				['text'=>"🇨🇳چین🇨🇳"],['text'=>"🇪🇬مصر🇪🇬"]
				],
												[
				['text'=>"🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿"],['text'=>"🇪🇹اتیوپی🇪🇹"]
				],
												[
				['text'=>"🇬🇲گامبیا🇬🇲"],['text'=>"🇬🇭غنا🇬🇭"]
				],
												[
				['text'=>"🇭🇹هایتی🇭🇹"],['text'=>"🇭🇰هنگ کنگ🇭🇰"]
				],
												[
				['text'=>"🇮🇩اندونزی🇮🇩"],['text'=>"🇮🇪ایرلند🇮🇪"]
				],
												[
				['text'=>"🇨🇮ساحل عاج🇨🇮"],['text'=>"🇰🇿قزاقستان🇰🇿"]
				],
												[
				['text'=>"🇱🇻لتونی🇱🇻"],['text'=>"🇲🇴ماکائو🇲🇴"]
				],
																[
				['text'=>"🇲🇬ماداگاسکار🇲🇬"],['text'=>"🇲🇾مالزی🇲🇾"]
				],
												[
				['text'=>"🇲🇽مکزیک🇲🇽"],['text'=>"🇲🇿موزامبیک🇲🇿"]
				],
																[
				['text'=>"🇳🇬نیجریه🇳🇬"],['text'=>"🇵🇰پاکستان🇵🇰"]
				],
												[
				['text'=>"🇵🇦پاناما🇵🇦"],['text'=>"🇵🇪پرو🇵🇪"]
				],
																[
				['text'=>"🇵🇭فیلیپین🇵🇭"],['text'=>"🇵🇱لهستان🇵🇱"]
				],
												[
				['text'=>"🇷🇴رومانی🇷🇴"],['text'=>"🇷🇺روسیه🇷🇺"]
				],
																[
				['text'=>"🇷🇸صربستان🇷🇸"],['text'=>"🇿🇦آفریقای جنوبی🇿🇦"]
				],
												[
				['text'=>"🇹🇭تایلند🇹🇭"],['text'=>"🇺🇸 آمریکا 🇺🇸"]
				],
																[
				['text'=>"🇻🇳ویتنام🇻🇳"],['text'=>"🇾🇪یمن🇾🇪"]
				],
																[
				['text'=>"🇿🇲زامبیا🇿🇲"]
				],
				                 [
                   ['text'=>"🏛 خانه"],['text'=>"💸 شارژ حساب"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
 ]);
}
}
else
{
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"💳 موجودی شما برای خرید شماره کشور '$text' کافی نمیباشد !			
💎 قیمت شماره مورد نظر : $amount تومان
💰 موجودی حساب شما : {$user["stock"]} تومان

ابتدا به منوی اصلی برگشته وبا استفاده از دکمه 💸 شارژ حساب موجودی خود را به میزان دلخواه اضافه کنید",
'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
            	'keyboard'=>[
																[
				['text'=>"🇩🇿الجزایر🇩🇿"],['text'=>"🇧🇩بنگلادش🇧🇩"]
				],
												[
				['text'=>"🇧🇾بلاروس🇧🇾"],['text'=>"🇰🇭کامبوج🇰🇭"]
				],
												[
				['text'=>"🇨🇲کامرون🇨🇲"],['text'=>"🇨🇦کانادا🇨🇦"]
				],
												[
				['text'=>"🇨🇳چین🇨🇳"],['text'=>"🇪🇬مصر🇪🇬"]
				],
												[
				['text'=>"🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿"],['text'=>"🇪🇹اتیوپی🇪🇹"]
				],
												[
				['text'=>"🇬🇲گامبیا🇬🇲"],['text'=>"🇬🇭غنا🇬🇭"]
				],
												[
				['text'=>"🇭🇹هایتی🇭🇹"],['text'=>"🇭🇰هنگ کنگ🇭🇰"]
				],
												[
				['text'=>"🇮🇩اندونزی🇮🇩"],['text'=>"🇮🇪ایرلند🇮🇪"]
				],
												[
				['text'=>"🇨🇮ساحل عاج🇨🇮"],['text'=>"🇰🇿قزاقستان🇰🇿"]
				],
												[
				['text'=>"🇱🇻لتونی🇱🇻"],['text'=>"🇲🇴ماکائو🇲🇴"]
				],
																[
				['text'=>"🇲🇬ماداگاسکار🇲🇬"],['text'=>"🇲🇾مالزی🇲🇾"]
				],
												[
				['text'=>"🇲🇽مکزیک🇲🇽"],['text'=>"🇲🇿موزامبیک🇲🇿"]
				],
																[
				['text'=>"🇳🇬نیجریه🇳🇬"],['text'=>"🇵🇰پاکستان🇵🇰"]
				],
												[
				['text'=>"🇵🇦پاناما🇵🇦"],['text'=>"🇵🇪پرو🇵🇪"]
				],
																[
				['text'=>"🇵🇭فیلیپین🇵🇭"],['text'=>"🇵🇱لهستان🇵🇱"]
				],
												[
				['text'=>"🇷🇴رومانی🇷🇴"],['text'=>"🇷🇺روسیه🇷🇺"]
				],
																[
				['text'=>"🇷🇸صربستان🇷🇸"],['text'=>"🇿🇦آفریقای جنوبی🇿🇦"]
				],
												[
				['text'=>"🇹🇭تایلند🇹🇭"],['text'=>"🇺🇸 آمریکا 🇺🇸"]
				],
																[
				['text'=>"🇻🇳ویتنام🇻🇳"],['text'=>"🇾🇪یمن🇾🇪"]
				],
																[
				['text'=>"🇿🇲زامبیا🇿🇲"]
				],
				                 [
                   ['text'=>"🏛 خانه"],['text'=>"💸 شارژ حساب"]
                ]
 	],
            	'resize_keyboard'=>true
       		])	
 ]);
}
}
//===========================================================================================
//panel admin
elseif($text=="/panel" and $tc == "private" and in_array($from_id,$admin)){
jijibot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📍 ادمین عزیز به پنل مدریت ربات خوش امدید",
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍 امار ربات"],['text'=>"📍 شارژ پنل"]     
		 ],
 	[
	  	['text'=>"📍 ارسال به همه"],['text'=>"📍 فروارد همگانی"]
	  ],
	   	[
	  	['text'=>"📍 افزایش | کاهش موجودی"]  
	  ],
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
elseif($text== "برگشت 🔙" and $tc == "private" and in_array($from_id,$admin)){
jijibot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📍 به منوی مدیریت بازگشتید",
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍 امار ربات"],['text'=>"📍 شارژ پنل"]     
		 ],
 	[
	  	['text'=>"📍 ارسال به همه"],['text'=>"📍 فروارد همگانی"]
	  ],
	   	[
	  	['text'=>"📍 افزایش | کاهش موجودی"]  
	  ],
   ],
      'resize_keyboard'=>true
   ])
 ]);
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");	
}
elseif($text== "📍 امار ربات" and $tc == "private" and in_array($from_id,$admin)){
$alltotal = mysqli_num_rows(mysqli_query($connect,"select id from user"));
				jijibot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"👤 امار ربات شما : $alltotal",
		]);
}
elseif ($text == "📍 ارسال به همه" and $tc == "private" and in_array($from_id,$admin)) {
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 لطفا متن یا رسانه خود را ارسال کنید [میتواند شامل عکس , گیف یا فایل باشد]  همچنین میتوانید رسانه را همراه با کشپن [متن چسپیده به رسانه ارسال کنید]",
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$connect->query("UPDATE user SET step = 'sendtoall' WHERE id = '$from_id' LIMIT 1");
$connect->query("UPDATE sendall SET step = 'none' , text = '' , msgid = '' , user = '0' , chat = '' LIMIT 1");	
}
elseif ($text == "📍 فروارد همگانی" and $tc == "private" and in_array($from_id,$admin)){
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 لطفا پیام خود را فوروارد کنید [پیام فوروارد شده میتوانید از شخص یا کانال باشد]",
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$connect->query("UPDATE user SET step = 'fortoall' WHERE id = '$from_id' LIMIT 1");		
$connect->query("UPDATE sendall SET step = 'none' , text = '' , msgid = '' , user = '0' , chat = '' LIMIT 1");	
}
elseif($text== "📍 شارژ پنل" and $tc == "private" and in_array($from_id,$admin)){
$get = explode(":",getbalance());
				jijibot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"📍 مقدار شارژ پنل : $get[1] روبل",
		]);
		}
elseif ($text == '📍 افزایش | کاهش موجودی' and $tc == "private" and in_array($from_id,$admin)) {
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 در خط اول ایدی عددی فرد و در خط دوم مقدار موجودی را اسال کنید
📍 اگر میخواهید موجودی فر را کم کنید از علامت - منفی استفاده کنید",
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$connect->query("UPDATE user SET step = 'senddowncoin' WHERE id = '$from_id' LIMIT 1");
}
//=====================================================================
elseif($data=="join"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$fromid"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
	jijibot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"☑️ عضویت شما تایید شد . به منوی اصلی ربات خوش آمدید	
🌟 این ربات بصورت اتوماتیک است و میتوانید فقط در ظرف چند ثانیه شماره مجازی و کد اختصاصی شمارهٔ مجازی خودتون رو دریافت کنید.

👇🏻 خوب چه کاری برات انجام بدم ؟ از منوی پایین انتخاب کن",
'reply_to_message_id'=>$messageid,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
    		]);
}
else
{
       jijibot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "❌ هنوز داخل کانال @$channel عضو نیستید",
            'show_alert' =>true
        ]);
}
}
elseif($data=="member"){
		$id = jijibot('sendvideo',[
	'chat_id'=>$chatid,
	'photo'=>"https://t.me/jahanbots/460",
	'caption'=>"☎️ ربات شماره مجازی نامبرسل (رایگان؛پولی)

📲 بدون نیاز به سیمکارت اکانت جدید در تلگرام، واتساپ و ... بساز 
و به هرکس دوست داری پیام بده !

🌀 تو این ربات میتونید شماره مجازی همه کشورهارو دریافت کنید به صورت اتوماتیک و در چند ثانیه! اون هم بصورت رایگان!
👇

t.me/$usernamebot?start=$fromid",
    		])->result->message_id;
jijibot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"💬 پیام بالا حاوی لینک دعوت اختصاصی شما به ربات است 	
🗣 با معرفی ربات به دوستان خود 5 درصد از هر افزایش موجودی به عنوان هدیه به شما داده خواهد شد .

💰 موجودی شما : {$usercall["stock"]} تومان
👥 تعداد زیر مجموعه ها : {$usercall["member"]} نفر",
	'reply_to_message_id'=>$id,
    		]);
}
elseif($data=="myby"){
$getby = explode("^", $usercall["listby"]);
if(count($getby) > 1){
for($z = 0;$z <= count($getby) - 2;$z++){
$zplus+=1;
$result = $result."$zplus - $getby[$z]"."\n";
}
jijibot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"🛍 لیست تمام خرید های شما :
	
$result",
'reply_to_message_id'=>$messageid,
    		]);
}
else
{
       jijibot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "❌ شما هنوز خریدی ثبت نکرده اید",
            'show_alert' =>true
        ]);
}
}
elseif($data=="cart"){
jijibot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"💰 به بخش افزایش موجودی به صورت آفلاین خوش آمدید
🗣 درصورتی که امکان خرید به صورت آنلاین و با رمز دوم ندارید میتوانید پرداخت را آفلاین انجام دهید !

💎 میزان موجودی که نیاز دارید را به صورت کارت به کارت به حساب زیر انتقال دهید و اسکرین شات پرداخت را برای پشتیبانی ارسال کنید . تا موجودی شما توسط مدیریت افزایش یابد 👇🏻

💳 شماره کارت : $cardnumber
👤 نام صاحب کارت : $ownercard",
'reply_to_message_id'=>$messageid,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
    		]);
}
elseif($data=="otheramount"){
jijibot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"🗣 در صورتی که مبلغ مورد نظر شما در بین بسته ها نبود در این قسمت میتوانید به میزان دلخواه حساب خود را شارژ کنید
	
⚠️ توجه کنید مبلغ را به تومان وارد کنید و حداقل مبلغی که میتوانید خرید کنید 500 تومان و حداکثر 200000 تومان است
💰 مبلغی که میخواهید حساب خود را شارژ کنید وارد کنید 👇🏻",
'reply_to_message_id'=>$messageid,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"❌ لغو"]
				],
 	],
            	'resize_keyboard'=>true
       		])
    		]);
$connect->query("UPDATE user SET step = 'otheramount' WHERE id = '$fromid' LIMIT 1");	
}
elseif($data=="next"){
       jijibot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "ℹ به صفحه بعدی منتقل شدید",
        ]);
$info = json_decode(file_get_contents("numberstats.json"),true);
jijibot('editMessageReplyMarkup',[
	'chat_id'=>$chatid,
    'message_id'=>$messageid,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
					[
['text'=>"🌏 کشور",'callback_data'=>"text"],['text'=>"💰 قیمت",'callback_data'=>"text"],['text'=>"✅ وضعیت",'callback_data'=>"text"]
	],
																[
	['text'=>"🇲🇿موزامبیک🇲🇿",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["mozambique"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🇳🇬نیجریه🇳🇬",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["nigeria"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇵🇰پاکستان🇵🇰",'callback_data'=>"text"],
	['text'=>"8000",'callback_data'=>"text"],
	['text'=>"{$info["pakistan"]}",'callback_data'=>"text"]
	],
																						[
	['text'=>"🇵🇦پاناما🇵🇦",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["panama"]}",'callback_data'=>"text"]
	],
																							[
	['text'=>"🇵🇪پرو🇵🇪",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["peru"]}",'callback_data'=>"text"]
	],
																								[
	['text'=>"🇵🇭فیلیپین🇵🇭",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["philippines"]}",'callback_data'=>"text"]
	],
																									[
	['text'=>"🇵🇱لهستان🇵🇱",'callback_data'=>"text"],
	['text'=>"25000",'callback_data'=>"text"],
	['text'=>"{$info["poland"]}",'callback_data'=>"text"]
	],
																										[
	['text'=>"🇷🇴رومانی🇷🇴",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["romania"]}",'callback_data'=>"text"]
	],
																			[
	['text'=>"🇷🇺روسیه🇷🇺",'callback_data'=>"text"],
	['text'=>"5000",'callback_data'=>"text"],
	['text'=>"{$info["russia"]}",'callback_data'=>"text"]
	],
	[
	['text'=>"🇷🇸صربستان🇷🇸",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["serbia"]}",'callback_data'=>"text"]
	],
	[
	['text'=>"🇿🇦آفریقای جنوبی🇿🇦",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["southafrica"]}",'callback_data'=>"text"]
	],
	[
	['text'=>"🇹🇭تایلند🇹🇭",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["thailand"]}",'callback_data'=>"text"]
	],	
	[
	['text'=>"🇺🇸 آمریکا 🇺🇸",'callback_data'=>"text"],
	['text'=>"25000",'callback_data'=>"text"],
	['text'=>"{$info["usa"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🇻🇳ویتنام🇻🇳",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["vietnam"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🇾🇪یمن🇾🇪",'callback_data'=>"text"],
	['text'=>"13000",'callback_data'=>"text"],
	['text'=>"{$info["yemen"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🇿🇲زامبیا🇿🇲",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["zambia"]}",'callback_data'=>"text"]
	],
					[
	['text'=>"⬅️ صفحه قبل",'callback_data'=>"beck"],['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
		      ]);
}
elseif($data=="beck"){
       jijibot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "ℹ به صفحه قبلی منتقل شدید",
        ]);
$info = json_decode(file_get_contents("numberstats.json"),true);
jijibot('editMessageReplyMarkup',[
	'chat_id'=>$chatid,
    'message_id'=>$messageid,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
				[
	['text'=>"🌏 کشور",'callback_data'=>"text"],['text'=>"💰 قیمت",'callback_data'=>"text"],['text'=>"✅ وضعیت",'callback_data'=>"text"]
	],
						[
['text'=>"🇩🇿الجزایر🇩🇿",'callback_data'=>"text"],
['text'=>"15000",'callback_data'=>"text"],
['text'=>"{$info["algeria"]}",'callback_data'=>"text"]
	],
						[
	['text'=>"🇧🇩بنگلادش🇧🇩",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["bangladesh"]}",'callback_data'=>"text"]
	],
										[
	['text'=>"🇧🇾بلاروس🇧🇾",'callback_data'=>"text"],
	['text'=>"18000",'callback_data'=>"text"],
	['text'=>"{$info["belarus"]}",'callback_data'=>"text"]
	],
											[
	['text'=>"🇰🇭کامبوج🇰🇭",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["cambodia"]}",'callback_data'=>"text"]
	],
												[
	['text'=>"🇨🇲کامرون🇨🇲",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["cameroon"]}",'callback_data'=>"text"]
	],
													[
	['text'=>"🇨🇦کانادا🇨🇦",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["canada"]}",'callback_data'=>"text"]
	],
									[
	['text'=>"🇨🇳چین🇨🇳",'callback_data'=>"text"],
	['text'=>"3000",'callback_data'=>"text"],
	['text'=>"{$info["china"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇪🇬مصر🇪🇬",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["egypt"]}",'callback_data'=>"text"]
	],
																				[
	['text'=>"🏴󠁧󠁢󠁥󠁮󠁧󠁿انگلستان🏴󠁧󠁢󠁥󠁮󠁧󠁿󠁧󠁢󠁥󠁮󠁧󠁿󠁧󠁢󠁥󠁮󠁧󠁿",'callback_data'=>"text"],
	['text'=>"35000",'callback_data'=>"text"],
	['text'=>"{$info["england"]}",'callback_data'=>"text"]
	],
																					[
	['text'=>"🇪🇹اتیوپی🇪🇹",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ethiopia"]}",'callback_data'=>"text"]
	],
																						[
	['text'=>"🇬🇲گامبیا🇬🇲",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["gambia"]}",'callback_data'=>"text"]
	],
													[
	['text'=>"🇬🇭غنا🇬🇭",'callback_data'=>"text"],
	['text'=>"13000",'callback_data'=>"text"],
	['text'=>"{$info["ghana"]}",'callback_data'=>"text"]
	],
																	[
	['text'=>"🇭🇹هایتی🇭🇹",'callback_data'=>"text"],
	['text'=>"13000",'callback_data'=>"text"],
	['text'=>"{$info["haiti"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇭🇰هنگ کنگ🇭🇰",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["hongkong"]}",'callback_data'=>"text"]
	],
														[
	['text'=>"🇮🇩اندونزی🇮🇩",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["indonesia"]}",'callback_data'=>"text"]
	],
								[
	['text'=>"🇮🇪ایرلند🇮🇪",'callback_data'=>"text"],
	['text'=>"13000",'callback_data'=>"text"],
	['text'=>"{$info["ireland"]}",'callback_data'=>"text"]
	],
										[
	['text'=>"🇨🇮ساحل عاج🇨🇮",'callback_data'=>"text"],
	['text'=>"15000",'callback_data'=>"text"],
	['text'=>"{$info["ivorycoast"]}",'callback_data'=>"text"]
	],
											[
	['text'=>"🇰🇿قزاقستان🇰🇿",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["kazakhstan"]}",'callback_data'=>"text"]
	],
															[
	['text'=>"🇱🇻لتونی🇱🇻",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["latvia"]}",'callback_data'=>"text"]
	],	
																[
	['text'=>"🇲🇴ماکائو🇲🇴",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["macao"]}",'callback_data'=>"text"]
	],	
																[
	['text'=>"🇲🇬ماداگاسکار🇲🇬",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["madagascar"]}",'callback_data'=>"text"]
	],
																	[
	['text'=>"🇲🇾مالزی🇲🇾",'callback_data'=>"text"],
	['text'=>"9000",'callback_data'=>"text"],
	['text'=>"{$info["malaysia"]}",'callback_data'=>"text"]
	],
																		[
	['text'=>"🇲🇽مکزیک🇲🇽",'callback_data'=>"text"],
	['text'=>"20000",'callback_data'=>"text"],
	['text'=>"{$info["mexico"]}",'callback_data'=>"text"]
	],									
					[
	['text'=>"➡️ صفحه بعد",'callback_data'=>"next"],['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
		      ]);
}
elseif($data=="text"){
       jijibot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "ℹ️ این دکمه برای نمایش اطلاعات است ! و کاربرد دیگری ندارد",
            'show_alert' =>true
        ]);
}
//==================================================
elseif($user["step"] == "otheramount" && $tc == "private"){
if($text >= 500 and $text <= 200000){
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"✅ صفحه افزایش موجودی با مبلغ $text تومان با موفقیت برای شما ساخته شد
			
☑️ تمامی پرداخت ها به صورت اتوماتیک بوده و پس از تراکنش موفق مبلغ آن به موجودی حساب شما در ربات افزوده خواهد شد .

🆔 شناسه : $from_id
💰 موجودی : {$user["stock"]} تومان



👮🏻 در صورت بروز هرگونه مشکل و یا انجام نشدن پرداخت کافیست با پشتیبانی در تماس باشید .
🌟 لطفا روی دکمه زیر ضربه بزنید تا به صفحه خرید منتقل شوید 👇🏻",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"💰 $text تومان",'url'=>"$web/pay/pay.php?amount=$text&id=$from_id"]
	],
					[
	['text'=>"🛍 کانال خرید ها",'url'=>"https://t.me/$channelby"]
	],
              ]
        ])
	]);	
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");
}
else
{
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"❗️ مبلغ وارد شده نادرست است ! لطفا اعداد را به لاتین و از وارد کردن حروف اضافی خودداری کنید
			
⚠️ توجه کنید مبلغ را به تومان وارد کنید و حداقل مبلغی که میتوانید خرید کنید 500 تومان و حداکثر 200000 تومان است
💰 مبلغی که میخواهید حساب خود را شارژ کنید وارد کنید 👇🏻",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"❌ لغو"]
				],
 	],
            	'resize_keyboard'=>true
       		])
	]);	
}
}
elseif($user["step"] == "sup" && $tc == "private"){
jijibot('ForwardMessage',[
'chat_id'=>$admin[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"🗣 پیام شما با موفقیت ارسال شد منتظر پاسخ پشتیبانی باشید",
			'reply_to_message_id'=>$message_id,
	]);	
}
elseif($user["step"] == "sendcoin" && $tc == "private"){
$all = explode("\n", $text);
if($all[1] >= 100){	
$plusstock = $all[1] + 200;
if($plusstock <= $user["stock"]){
$userget = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM user WHERE id = '$all[0]' LIMIT 1"));
if($userget["id"] == true and $all[0] != $from_id){
$pluscoin = $user["stock"] - $plusstock;
$pluscoinusergets = $userget["stock"] + $all[1] ;
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"✅ انتقال موجودی با موفقیت انجام شد
			
❄️ مقدار موجودی انتقال داده شده : $all[1]
💰 میزان جدید موجودی شما : $pluscoin
☂️ میزان قبلی موجودی شما : {$user["stock"]}
👤 کاربر مورد نظر : [$all[0]](tg://user?id=$all[0])

⚠️ توجه کنید هزینه انتقال 200 تومان میباشد که از حساب شما کسر شد .
↗️ گزارش انتقال شما در کانال `@$channelby` ارسال شد",
'reply_to_message_id'=>$message_id,
	'parse_mode'=>'Markdown',
	'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"?? استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])
	]);	
				jijibot('sendmessage',[       
			'chat_id'=>$all[0],
			'text'=>"🎁 $all[1] تومان موجودی به شما هدیه داده شد !

💰 میزان جدید موجودی شما : $pluscoinusergets
☂️ میزان قبلی موجودی شما : {$userget["stock"]}
🎈 کاربر ارسال کننده : [$from_id](tg://user?id=$from_id)

↗️ گزارش دریافت شما در کانال `@$channelby` ارسال شد",
	'parse_mode'=>'Markdown',
	]);	
$connect->query("UPDATE user SET step = 'none' , stock = '$pluscoin' WHERE id = '$from_id' LIMIT 1");
$connect->query("UPDATE user SET stock = '$pluscoinusergets' WHERE id = '$all[0]' LIMIT 1");
$sendid = mb_substr("$from_id","0","5")."***";
$reid = mb_substr("$all[0]","0","5")."***";
date_default_timezone_set('Asia/Tehran'); 
$time = date("Y-m-d | H:i:s");
jijibot('sendmessage',[
	'chat_id'=>"@$channelby",
	'text'=>"✅ گزارش انتقال #موفق
⏰ در ساعت : $time
⤴️ اطلاعات انتقال موجودی 👇🏻
🤖 @$usernamebot",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
				[
	['text'=>"📤 فرستنده",'callback_data'=>"text"],['text'=>"$sendid",'callback_data'=>"text"]
	],
					[
	['text'=>"📥 دریافت کننده",'callback_data'=>"text"],['text'=>"$reid",'callback_data'=>"text"]
	],
						[
	['text'=>"💰 میزان",'callback_data'=>"text"],['text'=>"$all[1] تومان",'callback_data'=>"text"]
	],
																[
	['text'=>"💈ورود به ربات شماره مجازی نامبرسل💈",'url'=>"https://t.me/$usernamebot"],
	],
              ]
        ])
            ]);	
}
else
{
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"❌ کاربر مورد نظر یافت نشد ! 
ℹ️ شناسه فرد را با دقت وارد کنید و از وجود داشتن حساب برای شناسه در ربات اطمینان کسب کنید			
🆔 شناسه کاربری هر فرد در قسمت اطلاعات حساب وی مشخص هست 

⚠️ توجه کنید که هزینه انتقال موجودی برای هر بار 200 تومان میباشد ! و حداقل انتقال موجودی 100 تومان میباشد
ℹ️ مثال :
267785153
1000",
'reply_to_message_id'=>$message_id,
	]);	
}
}
else
{
$restock = $user["stock"] - 200 ;
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"❗️ میزان موجودی که میخواهید انتقال دهید از موجودی حساب شما بیش تر است !
💰 حداکثر موجودی قابل انتقال : $restock
☂️ مبلغ وارد شده شما : $all[1]

⚠️ توجه کنید که هزینه انتقال موجودی برای هر بار 200 تومان میباشد ! و حداقل انتقال موجودی 100 تومان میباشد
ℹ️ مثال :
267785153
1000",
'reply_to_message_id'=>$message_id,
	]);	
}
}
else
{
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"❗️ حداقل موجودی برای انتقال 100 تومان میباشد !
⚠️ توجه کنید که هزینه انتقال موجودی برای هر بار 200 تومان میباشد .

ℹ️ مثال :
267785153
1000",
'reply_to_message_id'=>$message_id,
	]);	
}
}
elseif($user["step"] == "senddowncoin" && $tc == "private"){
$all = explode("\n", $text);	
$usergets = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM user WHERE id = '$all[0]' LIMIT 1"));
if($usergets["id"] == true){
$pluscoinusergets = $usergets["stock"] + $all[1] ;
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"انتقال موجودی با موفقیت انجام شد ✅",
				   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
	]);	
				jijibot('sendmessage',[       
			'chat_id'=>$all[0],
			'text'=>"💎 $all[1] موجودی شما تغییر یافت

💰 میزان جدید موجودی شما : $pluscoinusergets
☂️ میزان قبلی موجودی شما : {$usergets["stock"]}
👮🏻 هدیه از طرف مدیریت ربات !",
	]);	
$connect->query("UPDATE user SET stock = '$pluscoinusergets' WHERE id = '$all[0]' LIMIT 1");
}
else
{
			jijibot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"📍 کاربر مورد نظر یافت نشد ! شاید هنوز ربات را استارت نکرده باشد !			
🎈 شناسه کاربری هر فرد در قسمت اطلاعات حساب وی مشخص هست 
🌟 مثال :
267785153",
	]);	
}
}
elseif ($user["step"] == 'sendtoall' && $tc == "private") {
$filephoto = $message->photo;
$photo = $filephoto[count($filephoto)-1]->file_id;
$file = $update->message->document->file_id;
$caption = $update->message->caption;
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام شما با موفقیت برای ارسال همگانی تنظیم شد  ✔️",
 ]);
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");
$connect->query("UPDATE sendall SET step = 'sendall' , text = '$text$caption' , msgid = '$file$photo' LIMIT 1");			
}
elseif ($user["step"] == 'fortoall' && $tc == "private") {
         jijibot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام شما با موفقیت به عنوان فوروارد همگانی تنظیم شد ✔️",
 ]);
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 1");	
$connect->query("UPDATE sendall SET step = 'forall' , msgid = '$message_id' , chat = '$chat_id' LIMIT 1");		
}
//===========================================================
elseif($update->message->text && $update->message->reply_to_message && $from_id == $admin[0] && $tc == "private"){
	jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"پاسخ شما برای فرد ارسال شد ☑️"
		]);
	jijibot('sendmessage',[
        "chat_id"=>$update->message->reply_to_message->forward_from->id,
        "text"=>"👮🏻 پاسخ پشتیبان برای شما : `$text`",
'parse_mode'=>'MarkDown'
		]);
}
elseif($update->message and $tc == "private"){
$tch = jijibot('getChatMember',['chat_id'=>"@$channel",'user_id'=>"$from_id"])->result->status;
if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
	jijibot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"❗️ پیامت رو متوجه نشدم

به ربات شماره مجازی نامبرسل خوش آمدید🌹
با این ربات میتوانید در مدت زمان 1دقیقه صاحب شماره مجازی اختصاصی خود شوید🤗

برای اطلاعات بیشتر به قسمت راهنما مراجعه کنید

@jahanbots",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
            	'keyboard'=>[
				[
				['text'=>"🛒 خرید شماره"]
				],
				           [
                   ['text'=>"📊 استعلام | قیمت ها"],['text'=>"🖥 حساب کاربری"]
                ],
                 [
                   ['text'=>"💸 شارژ حساب"],['text'=>"🚦راهنما"]
                ],
				                 [
                   ['text'=>"☎️ پشتیبانی"],['text'=>"👥 زیرمجموعه گیری"]
                ]
 	],
            	'resize_keyboard'=>true
       		])	
				]);
}
else
{
jijibot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"برای استفاده از ربات شماره مجازی نامبرسل ابتدا عضو کانال زیر شوید و سپس مجددا استارت کنید
		
📣 @$channel 📣 @$channel
📣 @$channel 📣 @$channel

👇 بعد از « عضویت » بروی دکمه زیر کلیک کنید 👇",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[
	['text'=>"🔔 عضویت در کانال",'url'=>"https://t.me/$channel"]
	],
		[
	['text'=>"📢 عضو شدم",'callback_data'=>'join']
	],
              ]
        ])
		]);
}
}
?>
