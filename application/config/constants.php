<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('MASTERURL',"jlinvestment.co.kr");

$protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https' : 'http';
$http = $protocol."://";
$host=$_SERVER["HTTP_HOST"];
$domain = $http.$host;

define('BASE_URL',$domain);
define('BASE_CSS',$domain . "/assets/css");
define('BASE_JS',$domain . "/assets/js");
define('BASE_IMG',$domain . "/images");
define('BASE_TITLE',"(주)JL투자그룹");

define('BASE_TITLE_ADM',BASE_TITLE." Admin");
define('BASE_FOOTER',"&copy; 2020 ". BASE_TITLE ." Admin");

define('COM_NAME',"(주)JL투자그룹");
define('MAIL_FROM',"jl_investment@naver.com");
// define('COM_NUMBER',"0262463535");
//220906 스팸차단으로 발신번호 변경
define('COM_NUMBER',"0262463527");
define('COM_YESBIT_KEY',"575899943CF3401822C98C63617490911114F462B693DB690910209388955A1F ");

define('PAGE_PER_ROW',10);
define('PAGE_PER_ROW2',8);
define('BLOCK_PER_PAGE',10);

$_SERVER['CI_ENV'] = "production";

define('kcp_root',"/kcppay");
define('site_conf_inc',$_SERVER['DOCUMENT_ROOT']."/kcppay/cfg/site_conf_inc.php");

$menus = [
	array(
		"manager" => array("super" => "관리자관리", "name" => "관리자관리", "icon" => "icon-group", "type" => "b")
	),
	array(
		// "manager" => array("super" => "회원관리", "name" => "관리자관리", "icon" => "icon-group", "type" => "b")
		"members" => array("super" => "회원관리", "name" => "회원관리", "icon" => "icon-user",  "type" => "b")
		,"demembers" => array("super" => "회원관리", "name" => "탈퇴회원", "icon" => "icon-user",  "type" => "b")
		// ,"server" => array("super" => "회원관리", "name" => "그룹관리", "icon" => "icon-user",  "type" => "b")
	),
	array(
		"paymenthistory" => array("super" => "결제관리", "name" => "결제내역", "icon" => "icon-user",  "type" => "b")
		// ,"product" => array("super" => "결제관리", "name" => "상품관리", "icon" => "icon-user",  "type" => "b")

	),
	array(
		// "press" => array("super" => "게시판관리", "name" => "언론보도", "icon" => "icon-pencil",  "type" => "b")
		"profit" => array("super" => "게시판관리", "name" => "수익자랑", "icon" => "icon-pencil",  "type" => "b")
		,"review" => array("super" => "게시판관리", "name" => "이용후기", "icon" => "icon-pencil",  "type" => "b")
		,"interview" => array("super" => "게시판관리", "name" => "고객인터뷰", "icon" => "icon-pencil",  "type" => "b")
		,"notice" => array("super" => "게시판관리", "name" => "공지사항", "icon" => "icon-pencil",  "type" => "b")
		,"performance" => array("super" => "게시판관리", "name" => "투자성과", "icon" => "icon-pencil",  "type" => "b")
		,"oneminute" => array("super" => "게시판관리", "name" => "1분 시황", "icon" => "icon-pencil",  "type" => "b")
		,"issue" => array("super" => "게시판관리", "name" => " 기업 REPORT", "icon" => "icon-pencil",  "type" => "b")
		,"payclass" => array("super" => "게시판관리", "name" => "유료강의", "icon" => "icon-pencil",  "type" => "b")
		,"paycontentslist" => array("super" => "게시판관리", "name" => "유료강의 권한 부여 내역", "icon" => "icon-pencil",  "type" => "b")
		,"paycontentshistory" => array("super" => "게시판관리", "name" => "유료강의 열람 이력", "icon" => "icon-pencil",  "type" => "b")
		// ,"event" => array("super" => "게시판관리", "name" => "이벤트", "icon" => "icon-pencil",  "type" => "b")
		// ,"faq" => array("super" => "게시판관리", "name" => "자주묻는질문", "icon" => "icon-pencil",  "type" => "b")
		// ,"viprecommend" => array("super" => "게시판관리", "name" => "VIP 추천종목", "icon" => "icon-pencil",  "type" => "b")

		// ,"research" => array("super" => "게시판관리", "name" => "종목리서치", "icon" => "icon-pencil",  "type" => "b")

	),
	array(
		"apply" => array("super" => "신청내역", "name" => "신청내역", "icon" => "icon-th-list",  "type" => "b")
	),
	array(
		// "settings" => array("super" => "사이트관리", "name" => "사이트관리", "icon" => "icon-cog", "type" => "b")
		"banner" => array("super" => "사이트관리", "name" => "배너관리", "icon" => "icon-cog", "type" => "b")
		,"popup" => array("super" => "사이트관리", "name" => "팝업관리", "icon" => "icon-cog", "type" => "b")
		// "visual" => array("super" => "사이트관리", "name" => "매인비쥬얼", "icon" => "icon-cog", "type" => "b")
		,"privacy" => array("super" => "사이트관리", "name" => "약관/개인정보보호정책", "icon" => "icon-cog", "type" => "b")
		,"sendsms" => array("super" => "사이트관리", "name" => "문자발송", "icon" => "icon-cog", "type" => "b")
		,"sendhistory" => array("super" => "사이트관리", "name" => "문자발송내역", "icon" => "icon-cog", "type" => "b")
	)
];

define('menus', json_encode($menus));

$header = array();
foreach($menus as $k=>$menu){
	//if($k>=4){break;}
	foreach($menu as $m_k => $m_v){
		$header[$m_k] = $m_v;
		break;
	}
}

define('headers',json_encode($header));



$navbar = [
	array(
		"company" => array("super" => "JL투자그룹", "name" => "회사소개", "sub" => "sub_01", "type" => "b")
		,"philosophy" => array("super" => "JL투자그룹", "name" => "운용철학", "sub" => "sub_01",  "type" => "b")
		,"promise" => array("super" => "JL투자그룹", "name" => "고객과의 약속", "sub" => "sub_01",  "type" => "b")
		,"award" => array("super" => "JL투자그룹", "name" => "수상내역", "sub" => "sub_01",  "type" => "b")
		,"milestones" => array("super" => "JL투자그룹", "name" => "연혁", "sub" => "sub_01",  "type" => "b")
	),
	// array(
	// 	"vipapply" => array("super" => "VIP 체험신청", "name" => "VIP 체험신청", "sub" => "sub_02",  "type" => "b")
	// ),
	array(
		"vipapply" => array("super" => "VIP 체험신청", "name" => "VIP 체험신청", "sub" => "sub_02",  "type" => "b")
		,"jlvip" => array("super" => "VIP 서비스", "name" => "VIP 서비스", "sub" => "",  "type" => "b")
		,"performance" => array("super" => "VIP 서비스", "name" => "투자성과", "sub" => "sub_03",  "type" => "b")

	),
	array(
		"profit" => array("super" => "이용후기", "name" => "수익자랑", "sub" => "sub_04",  "type" => "b")
		,"review" => array("super" => "이용후기", "name" => "실시간 이용후기", "sub" => "sub_04",  "type" => "b")
		,"interview" => array("super" => "이용후기", "name" => "고객인터뷰", "sub" => "sub_04",  "type" => "b")
	),

	array(
		"oneminute" => array("super" => "투자정보", "name" => "1분시황", "sub" => "sub_05", "type" => "b")
		,"issue" => array("super" => "투자정보", "name" => "기업 REPORT", "sub" => "sub_05", "type" => "b")
		,"payclass" => array("super" => "투자정보", "name" => "유료강의", "sub" => "sub_05",  "type" => "b")
	),
	array(
		"notice" => array("super" => "ABOUT", "name" => "공지사항", "sub" => "sub_06", "type" => "b")
		,"h2o" => array("super" => "ABOUT", "name" => "기부행사", "sub" => "sub_06", "type" => "b")
	)
];

define('navbar', json_encode($navbar));

$navbars = array();
foreach($navbar as $k=>$menu){
	foreach($menu as $m_k => $m_v){
		$navbars[$m_k] = $m_v;
		break;
	}
}

define('navbars',json_encode($navbars));



//jl_mobile

$navbar_m = [
	array(
		"company" => array("super" => "JL투자그룹", "name" => "회사소개", "sub" => "sub_01", "type" => "b")
		,"philosophy" => array("super" => "JL투자그룹", "name" => "운용철학", "sub" => "sub_01",  "type" => "b")
		,"promise" => array("super" => "JL투자그룹", "name" => "고객과의 약속", "sub" => "sub_01",  "type" => "b")
		,"award" => array("super" => "JL투자그룹", "name" => "수상내역", "sub" => "sub_01",  "type" => "b")
		,"milestones" => array("super" => "JL투자그룹", "name" => "연혁", "sub" => "sub_01",  "type" => "b")
	),
	// array(
	// 	"vipapply" => array("super" => "VIP 체험신청", "name" => "VIP 체험신청", "sub" => "",  "type" => "b")
	// ),
	array(
		"vipapply" => array("super" => "VIP 체험신청", "name" => "VIP 체험신청", "sub" => "",  "type" => "b")
		,"jlvip" => array("super" => "VIP 서비스", "name" => "VIP 서비스", "sub" => "",  "type" => "b")
		,"performance" => array("super" => "VIP 서비스", "name" => "투자성과", "sub" => "sub_03",  "type" => "b")
	),
	array(
		"profit" => array("super" => "이용후기", "name" => "수익자랑", "sub" => "sub_04",  "type" => "b")
		,"review" => array("super" => "이용후기", "name" => "실시간 이용후기", "sub" => "sub_04",  "type" => "b")
		,"interview" => array("super" => "이용후기", "name" => "고객인터뷰", "sub" => "sub_04",  "type" => "b")
	),
	array(
		"oneminute" => array("super" => "투자정보", "name" => "1분시황", "sub" => "sub_05", "type" => "b")
		,"issue" => array("super" => "투자정보", "name" => "기업 REPORT", "sub" => "sub_05", "type" => "b")
		,"payclass" => array("super" => "이용후기", "name" => "유료강의", "sub" => "sub_04",  "type" => "b")
		,"notice" => array("super" => "투자정보", "name" => "공지사항", "sub" => "sub_05", "type" => "b")
		,"h2o" => array("super" => "투자정보", "name" => "기부행사", "sub" => "sub_05", "type" => "b")
	)
];

define('navbar_m', json_encode($navbar_m));
$navbars_m = array();
foreach($navbar_m as $k=>$menu){
	foreach($menu as $m_k => $m_v){
		$navbars_m[$m_k] = $m_v;
		break;
	}
}
define('navbars_m',json_encode($navbars_m));






define('admmng','_jl');


// db tables
define('DB_PREFIX','jl_');
define('DB_PREFIX2','jltb_');
define('admin_list',DB_PREFIX2.'adm_lst');
define('banner',DB_PREFIX.'banner');
define('popup',DB_PREFIX.'popup');
define('conn_log',DB_PREFIX.'conn_log');
define('logs',DB_PREFIX.'logs');
define('siteinfo',DB_PREFIX.'siteinfo');
define('board',DB_PREFIX.'board');
define('send_log',DB_PREFIX.'send_log');
define('room_manager',DB_PREFIX.'room_manager');
define('member_list',DB_PREFIX.'member_list');
define('member_list_withdraw',DB_PREFIX.'member_list_withdraw');
define('sms_join_log', DB_PREFIX.'sms_join_log');
define('room_list', DB_PREFIX.'room_list');
define('apply', DB_PREFIX.'apply');
define('product', DB_PREFIX.'product');
define('pay_orderinfo', DB_PREFIX.'pay_orderinfo');
define('pay_contents_list', DB_PREFIX.'pay_contents_list');
define('pay_contents_log', DB_PREFIX.'pay_contents_log');
