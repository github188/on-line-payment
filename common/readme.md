#verifyLogin.php使用方法
请在每个需要登陆才能使用的页面的ｐｈｐ脚本内加上
    require_once("../common/verifyLogin.php")

#captcha.php
在ｈｔｍｌ代码中加上
    <img src="../common/captcha.php" onerror=alert("xss") />
即可生成验证码图像
同时sha1算法加密过的验证码会被保存在$_SESSION['captcha_phrase']中

#email.class.php使用方法
```
require_once "../common/email.class.php";

//******************** 配置变量 ********************************
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "qqq1051814353@163.com";//SMTP服务器的用户邮箱
$smtpemailto = $_POST['mail'];//发送给谁
$fromName = 'Meteor';
$smtpuser = "qqq1051814353@163.com";//SMTP服务器的用户帐号
$smtppass = "qqq1051814353";//密码，或者授权码
$mailtitle = "this is test mail";//邮件主题
$mailcontent = "hello";//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

//************************ 创建对象 ****************************
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息，默认不发送
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $fromName, $mailtitle, $mailcontent, $mailtype);
if($state=="") 
	$error = "激活邮件发送失败，请确认你的邮箱地址！";
else
	$error = "成功发送邮件！";
```

#LiberationMono-BoldLtalic.ttf
验证码的字体文件