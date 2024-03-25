<?
class Sendmon_model extends CI_Model{

	public $api_url = "http://www.sendmon.com/_REST/msgApi.asp";


	public function __construct(){
		parent::__construct();
	}
	
	public function getInfo() {
	}
	
	public function sendSMS($receive_nums="", $msg="", $adsms=false) {
			$receive_nums_sring = "";			
			if ( is_array($receive_nums) ) {			
				for($i = 0; $i < count($receive_nums); $i++)
				{
					$receive_nums_sring .= "-,".$receive_nums[$i].",,,,";
				}				
			} else {
				$receive_nums_sring = "-,".$receive_nums.",,,,";
			}
						
			if ($adsms==true) {
				$msg = "(광고)".COM_NAME."\n".$msg."\n".COM_YESBIT_080;
			}
			$category = "send";	
			$param = "sms";
			$title = "";

			if (strlen(iconv("UTF-8","EUC-KR" ,$msg)) > 90) {
				$param = "lms";
			}	
			
			$postparam = "category=" . urlencode($category)
			. "&param=" . urlencode($param)
			. "&send_num=" . urlencode(COM_NUMBER)
			. "&receive_nums=" . urlencode($receive_nums_sring)
			. "&title=" . urlencode($title)
			. "&message=" . urlencode($msg);
	
	
			return $this->sendApi($postparam);
	}
	
	
	public function sendApi($postparam) {	
	
		$postparam = $postparam."&apikey=".COM_YESBIT_KEY;
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->api_url);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $postparam);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		$response = curl_exec($ch);
		curl_close ($ch);		
		return  $response;
	}

}
?>
