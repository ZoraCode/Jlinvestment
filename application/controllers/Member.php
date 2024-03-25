<?
class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	// 로그인
	public function login(){
		if($this->session->userdata('sess_id') != ""){
			redirect(admmng.'/');
		}

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view($redirect.'member/login');
	}
	public function findpwadm(){
		if($this->session->userdata('sess_id') != ""){
			redirect(admmng.'/');
		}
		$this->load->view('member/admfindpassword');
	}
	// logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(admmng.'/');
	}
	// 로그인처리
	public function login_proc(){
		$id = $this->input->post('id', TRUE);
		$pw = $this->input->post('pwd', TRUE);

		// -- save
//		$options = ['cost' => 12];
//		$userPwd = password_hash($pw, PASSWORD_BCRYPT, $options);

		$data = $this->Admin_model->login_admin($id, $pw);
		// 아이피 차단 풀기
		// if($data["ip_pass"]=="N"){
		// 	$data["settings"] = getSettings();
		// 	$ip_allow = $data["settings"]["ip_allow"];
		// 	if(isset($ip_allow)){
		// 		$is_in_iplist = false;
		// 		$ip_allow_arr = explode(",",$ip_allow);
		// 		foreach($ip_allow_arr as $var){
		// 			if($var == $this->input->ip_address()){
		// 				$is_in_iplist = true;
		// 			}
		// 		}
		// 		if($is_in_iplist == false){
		// 			$this->Admin_model->member_login_log('로그차단(ip)', $id);
		// 			echo "허용된 아이피가 아닙니다.";
		// 			exit;
		// 		}
		// 	}
		// }
		//if(isset($data['id'])) {
		if(isset($data['id']) && password_verify($pw, $data["pwd"])){
			$first_menu = "";
			if(isset($data['menus'])){
				$first_menu = explode(",",$data['menus']);
				$first_menu = $first_menu[0];
			}
			$userdata = array(
				'sess_idx' => $data['idx'],
				'sess_id' => $data['id'],
				'sess_name' => $data['name'],
				'sess_hp' => $data['hp'],
				'sess_level' => $data['level'],
				'sess_first' => $first_menu,
				'sess_logged_in' => TRUE
			);
			$this->session->set_userdata($userdata);

			$this->Admin_model->member_login_log('로그인', $data['id']);

			echo "success";
		} else {
			echo "일치하는 회원 정보가 없습니다.";
		}
	}
	// 관리자비밀번호찾기
	public function find_admin_pwd(){
		$id = $this->input->post('id', TRUE);
		$hp = $this->input->post('hp', TRUE);

		$data = $this->Admin_model->find_admin($id, $hp);


		if( isset($data['id']) ){

			$new_password = generateRandomString(8);
			$options = ['cost' => 12];
			$userPwd = password_hash($new_password, PASSWORD_BCRYPT, $options);
			$settings = getSettings();
			$title = "";
			$contents = "관리자 비밀번호찾기\n임시비밀번호 : ".$new_password;

			$sms_result = send_sms("sms",$title,$contents,"",$hp);
			$this->Common_db_model->setSmsLog("sms",$title,$contents,COM_NUMBER,$hp);
			$result = json_decode($sms_result);
			$send_result = $result->loginRstMsg;
			if($send_result == "success"){
				$this->Common_db_model->update_board(admin_list, array('pwd'=>$userPwd), "id='".$data['id']."'");
				$this->Admin_model->member_login_log('비밀번호찾기', $data['id'], $this->input->ip_address());
				echo $send_result;
			}else{
				echo "휴대폰번호로 문자발송이 정상적으로 완료되지 않았습니다.\n코드번호(".$send_result.") 관리자에게 확인해주세요.";
			}
		} else {
			echo "일치하는 회원 정보가 없습니다.";
		}
	}

}
