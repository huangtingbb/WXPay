<?php
require_once "../lib/WxPay.Api.php";
require_once '../example/WxPay.NativePay.php';
require_once '../example/log.php';

$notify=new NativePay();
$url1=$url1 = $notify->GetPrePayUrl("123456789");


$input = new WxPayUnifiedOrder();
//支付内容
$input->SetBody("黄婷是头猪");
$input->SetAttach("TEST");
//订单号:随机生成
$input->SetOut_trade_no("sdkphp123456789".date("YmdHis"));
//支付金额：分
$input->SetTotal_fee("1");

//商品标签
$input->SetGoods_tag("虚拟道具");
$input->SetNotify_url("http://wp.com/example/notify.php");
//扫码支付
$input->SetTrade_type("NATIVE");
//商品id
$input->SetProduct_id("123456789");

$config=new WxPayConfig();
$result = WxPayApi::unifiedOrder($config,$input);
var_dump($result);
$url2 = $result["code_url"];
$img="<img src='http://wp.com/example/qrcode.php?data={$url2}' />";
echo $img;
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>微信支付样例-退款</title>
</head>
<body>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
	<img alt="模式一扫码支付" src="qrcode.php?data=<?php echo urlencode($url1);?>" style="width:150px;height:150px;"/>
	<br/><br/><br/>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
	<img alt="模式二扫码支付" src="qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/>
	<div style="color:#ff0000"><b>微信支付样例程序，仅做参考</b></div>

</body>
</html>