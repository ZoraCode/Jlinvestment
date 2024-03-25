<?
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('is_dev')){
	function is_dev(){
		$rtn = false;
		$arrow_ip_array = array("1.227.95.122","183.96.24.38");
		if(in_array($_SERVER['REMOTE_ADDR'], $arrow_ip_array)){
			$rtn = true;
		}
		return $rtn;
	}
}

if ( ! function_exists('seminar_cate_name')){
	function seminar_cate_name($cate){
		$name = '';
		$categorys = (array) json_decode(categorys);
		return $categorys[$cate];
	}
}

function hc($str, $n = 500, $end_char = '...'){
	$CI =& get_instance();
	$charset = $CI->config->item('charset');

	if (mb_strlen( $str , $charset) < $n){
		return $str ;
	}

	//$str = preg_replace( "/\s+/iu", ' ', str_replace( array( "\r\n", "\r", "\n" ), ' ', $str ) );

	if ( mb_strlen( $str , $charset) <= $n ) {
		return $str;
	}

	return mb_substr(trim($str), 0, $n ,$charset) . $end_char ;
}
function getOrderNo(){
	$today = date("Ymd");
	$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
	$unique = $today . $rand;
	return $unique;
}
function is_empty($str){
	if(isset($str) and !empty($str) and $str != ""){
		return false;
	}
	return true;
}
function get_server_type($type){
	switch($type){
		case '1':
			$rst = "무료그룹";
			break;
		case '2':
			$rst = "유료그룹";
			break;
		case '3':
			$rst = "체험그룹";
			break;
		default:
			$rst = "";
			break;
	}
	return $rst;
}

function cus_alert($str)
{
	echo("<script language=\"javascript\">\n" .
		 "<!--\n" .
		 "alert(\"$str\");\n" .
		 "//-->\n" .
		 "</script>\n");
	exit;
}
function error_move($str, $url)
{
	echo("<script language=\"javascript\">\n" .
		"<!--\n" .
		"alert(\"$str\");\n" .
		"location.href='$url';\n" .
		"//-->\n" .
		"</script>\n");
	exit;
}
function alert_history_back($str)
{
	echo("<script language=\"javascript\">\n" .
		"<!--\n" .
		"alert(\"$str\");\n" .
		"history.back();\n" .
		"//-->\n" .
		"</script>\n");
	exit;
}
function history_back()
{
	echo("<script language=\"javascript\">\n" .
		"<!--\n" .
		"history.back();\n" .
		"//-->\n" .
		"</script>\n");
	exit;
}
function movescript($url)
{
	echo("<script language=\"javascript\">\n" .
		"<!--\n" .
		"location.href='$url';\n" .
		"//-->\n" .
		"</script>\n");
	exit;
}

function get_title($cate){
	$menus = json_decode(menus);
	$data = array();
	$data["t1"] = $menus[get_key($cate)]->$cate->super;
	$data["t2"] = $menus[get_key($cate)]->$cate->name;

	return $data;
}

function get_key($cate){
	$menus = json_decode(menus);
	$data = array();

	$key = "";

	foreach($menus as $k=>$v){
		foreach($v as $kk=>$vv){
			if($kk==$cate){
				$key = $k;
				break;
			}
		}
	}
	return $key;
}
function get_key_front($cate){
	$navbar = json_decode(navbar);
	$data = array();

	$key = "";

	foreach($navbar as $k=>$v){

		foreach($v as $kk=>$vv){

			if($kk==$cate){
				$key = $k;
				break;
			}
		}
	}
	return $key;
}

function get_key_front_m($cate){
	$navbar = json_decode(navbar_m);
	$data = array();

	$key = "";

	foreach($navbar as $k=>$v){

		foreach($v as $kk=>$vv){

			if($kk==$cate){
				$key = $k;
				break;
			}
		}
	}
	return $key;
}

function getUserInfo($member_idx){
	$ci =& get_instance();
	$class = $ci->db->query("select * from ". admin_list ." where idx='".$member_idx."'");
	$class = $class->result_array();
	return count($class)!=0?$class[0]:'';
}
function getSettings(){
	$ci =& get_instance();
	$class = $ci->db->query("select * from ".siteinfo." where idx=1");
	$class = $class->result_array();
	return $class[0];
}
function getServername($server_idx){
	$ci =& get_instance();
	$class = $ci->db->query("select * from ".room_list." where idx='".$server_idx."'");
	$class = $class->result_array();
	return count($class)!=0?$class[0]:'';
}

function checkMenuPms($pn){
	$ci =& get_instance();
	if($ci->session->userdata('sess_idx')==1)return true;
	$userInfo = getUserInfo($ci->session->userdata('sess_idx'));
	$mymenus = isset($userInfo["menus"]) ? explode(",",$userInfo["menus"]) : [];
	$menus = json_decode(menus);

	return in_array($pn,$mymenus);
}
function _getTitle($category){
	$title = '';
	switch($category){
		case 'notice':
			$title = '공지사항';
			break;
		case 'qna':
			$title = '자주묻는질문';
			break;
		case 'history':
			$title = '투자종목내역';
			break;
		case 'result':
			$title = '투자성과';
			break;
		case 'membership':
			$title = '가입상담';
			break;
	}

	return $title;
}
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }

function getUpdateDate(){
	$isUse = true;
	if($isUse){
		return date('ymdhis');
	}else{
		return "";
	}
}
function getUserInfoByIdx($member_idx){
	$ci =& get_instance();
	$class = $ci->db->query("select * from ".member_list." where idx='".$member_idx."'");
	$class = $class->result_array();
	return count($class)!=0?$class[0]:'';
}
function send_sms($type="sms",$title="",$msg="",$sno="",$rno="",$room_idx="",$category=""){
	$ch = curl_init();
	$url = "http://www.sendmon.com/_REST/smsApi.asp";
	$category = $category==""?"send":$category;
	$param = $type;
	$apikey = COM_YESBIT_KEY;
	$send_num = COM_NUMBER;
	$receive_nums = $rno;
	$title = $title;
	$message = $msg;

	$sendparams = "apikey=" . urlencode($apikey)
	. "&category=" . urlencode($category)
	. "&param=" . urlencode($param)
	. "&send_num=" . urlencode($send_num)
	. "&receive_nums=" . urlencode($receive_nums)
	. "&title=" . urlencode($title)
	. "&message=" . urlencode($message)
	. "&room_idx=" . urlencode($room_idx);

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $sendparams);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	$response = curl_exec($ch);

	return $response;
	curl_close ($ch);
}

function request_charge($price){
	if(empty($price)){
		return "";
	}
	$ch = curl_init();
	$url = "http://www.sendmon.com/_REST/settleApi.asp";
	$apikey = COM_YESBIT_KEY;
	$PayWay = "ONLINE";

	$settleparams = "apikey=" . urlencode($apikey)
	. "&PayWay=" . urlencode($PayWay)
	. "&SettleCash=" . urlencode($price)
	. "&SettlePrice=" . urlencode($price);

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $settleparams);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	$response = curl_exec($ch);

	return $response;
	curl_close ($ch);
}

function getSmsList(){
	$ch = curl_init();
	$url = "http://www.sendmon.com/_REST/settleListAsp.asp";
	$apikey = COM_YESBIT_KEY;

	$settleparams = "apikey=" . urlencode($apikey);

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $settleparams);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	$response = curl_exec($ch);
	return $response;
	curl_close ($ch);
}

function send_fcm($title, $message, $server, $id) {
	$url = 'https://fcm.googleapis.com/fcm/send';

	$headers = array ('Authorization: key=' . GOOGLE_SERVER_KEY,'Content-Type: application/json');
	$fields = array ( 'data' => array ("server" => $server),'notification' => array ("body" => $message, "title" => $title));

	if(is_array($id)) {
		$fields['registration_ids'] = $id;
	} else {
		$fields['to'] = $id;
	}

	$fields['priority'] = "high";

	$fields = json_encode ($fields);

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

	$result = curl_exec ( $ch );
	if ($result === FALSE) {
	//die('FCM Send Error: ' . curl_error($ch));
	}
	curl_close ( $ch );
	return $result;
}

function send_mail($mailTo='', $subject='', $content=''){
    $nameFrom  = BASE_TITLE;
    $mailFrom = MAIL_FROM;
    $nameTo  = "수신자";
    $cc = ""; //참조
    $bcc = ""; //숨은참조

    $charset = "UTF-8";

    $nameFrom   = "=?$charset?B?".base64_encode($nameFrom)."?=";
    $nameTo   = "=?$charset?B?".base64_encode($nameTo)."?=";
    $subject = "=?$charset?B?".base64_encode($subject)."?=";

    $header  = "Content-Type: text/html; charset=utf-8\r\n";
    $header .= "MIME-Version: 1.0\r\n";

    $header .= "Return-Path: <". $mailFrom .">\r\n";
    $header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
    $header .= "Reply-To: <". $mailFrom .">\r\n";
    if ($cc)  $header .= "Cc: ". $cc ."\r\n";
    if ($bcc) $header .= "Bcc: ". $bcc ."\r\n";

    $result = mail($mailTo, $subject, $content, $header, $mailFrom);

    if(!$result) {
		return "err";
	}else{
		return "success";
	}
}


function makeResultString($result, $msg)
{
	echo "{ \"result\": \"" . $result ."\",\"result_msg\": \"" . $msg ."\" }";
	exit;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function cmp($a, $b){
    return strcmp($a->senddate, $b->senddate);
}
function splitArr($arr,$ori,$ch){
	$arr = array_merge($arr, explode($ch, $ori));
	$arr = array_values(array_filter($arr));
	return $arr;
}
function generateRandomNumber($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function cnv_mailform($txt){
	$base = "<div style='width:800px;position:relative;margin: 0 auto;height:530px;background:url(".BASE_URL."/images/common/mail_form.jpg) no-repeat;'><div style='width:100%;padding-top: 150px;color:#000000;line-height:25px;text-align:center;font-size:17px;'>안녕하세요 (주)JL투자그룹 입니다. <br><b>".$txt."</b><br>안전한 사용을 위해 어메이징스탁 로그인 후 변경하여 사용하시기 바랍니다.</div><a href='".BASE_URL."/' target='_blank' style='position:absolute;left:50%;margin-left:-160px;top:290px;'><img src='".BASE_URL."/images/common/btn_mail.jpg' alt='' style='margin-bottom:30px'></a></div>";
	return $base;
}
function checkLogin(){
	$ci =& get_instance();
	if($ci->session->userdata(DB_PREFIX.'idx')){
		redirect("/");
	}else{
	}
}

function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBFBC');
    $text = preg_replace("/$bom/", ' ', $text);
    return $text;
}   

function unescape_web_txt($value) {
    $value = remove_utf8_bom($value);
    $unescapers = array("\\\\", "\\/", "\\\"","\\n","&amp;");
    $replacements = array("\\", "/", "\"","<br>","&");
    $result = str_replace($unescapers, $replacements, $value);
    return $result;
}
