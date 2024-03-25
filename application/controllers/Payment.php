<?
class Payment extends CI_Controller{

	//private $default_dir = '';
	private $root_dir = '';
	public function __construct(){
		parent::__construct();

	}

	public function payment_proc(){

		$orderno = $this->input->post('orderno', TRUE);
		$price = $this->input->post('price', TRUE);
		$period = $this->input->post('period', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$total_price = $this->input->post('total_price', TRUE);
		$pay_method = $this->input->post('pay_method', TRUE);
		$pay_status = "READY";
		// READY = 무통장저장, OK = 관리자승인
		$settings = getSettings();
		$pay_msg = "[".$settings["bank"]."] ".$settings["bank_no"]." / ".$settings["bank_owner"]." \n 입금자: ".$this->session->userdata(DB_PREFIX.'name');

		$data = array(
			'member_idx' => $this->session->userdata(DB_PREFIX.'idx'),
			'orderno' => $orderno,
			'price' => $price,
			'period' => $period,
			'discount' => $discount,
			'total_price' => $total_price,
			'pay_method' => $pay_method,
			'pay_status' => $pay_status
		);

		//$this->Common_db_model->setLogs('payment','결제신청',$this->session->userdata(DB_PREFIX.'id'));
		$idx = $this->Common_db_model->insert_board(pay_orderinfo, $data);
		if($idx){
			if($this->session->userdata(DB_PREFIX.'hp')!=""){
				$pay_msg.="\n결제금액".number_format($total_price,0)."원";
				send_sms("sms","",$pay_msg,COM_NUMBER,$this->session->userdata(DB_PREFIX.'hp'));
			}
			//redirect("/payment/result/".$orderno);

			$response['status'] = 'success';
			$response['redirect'] = "/payment/result/".$orderno;
			echo json_encode($response);

		}else{
			$response['status'] = "error";
			$response['msg'] = "잠시후 다시 이용해주세요.";
			echo json_encode($response);
		}

	}
	public function payment_card_proc(){

		$orderno = $this->input->post('orderno', TRUE);
		$price = $this->input->post('price', TRUE);
		$period = $this->input->post('period', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$total_price = $this->input->post('total_price', TRUE);

		$good_mny = $this->input->post('good_mny', TRUE);
		$app_time = $this->input->post('app_time', TRUE);
		$card_name = $this->input->post('card_name', TRUE);
		$card_name = urldecode($card_name);
		$card_name = iconv("euc-kr","utf-8",$card_name);
		$bank_name = $this->input->post('bank_name', TRUE);
		$bank_name = urldecode($bank_name);
		$bank_name = iconv("euc-kr","utf-8",$bank_name);

		$good_name = $this->input->post('good_name', TRUE);
		$good_name = urldecode($good_name);
		$good_name = iconv("euc-kr","utf-8",$good_name);


		$bank_code = $this->input->post('bank_code', TRUE);
		$bk_mny = $this->input->post('bk_mny', TRUE);
		$bankname = $this->input->post('bankname', TRUE);
		$depositor = $this->input->post('depositor', TRUE);
		$account = $this->input->post('account', TRUE);
		$va_date = $this->input->post('va_date', TRUE);
		$tno = $this->input->post('tno', TRUE);
		$via = $this->input->post('via', TRUE);

		$pay_status = "OK";
		// READY = 무통장저장, OK = 관리자승인

		$data = array(
			'member_idx' => $this->session->userdata(DB_PREFIX.'idx'),
			'orderno' => $orderno,
			'price' => $price,
			'period' => $period,
			'discount' => $discount,
			'total_price' => $total_price,
			'pay_method' => 'card',
			'pay_status' => $pay_status,
			'mod_dt' => date('Y-m-d H:i:s'),
			'app_time' => $app_time,
			'bank_name' => $bank_name,
			'bank_code' => $bank_code,
			'goods' => $good_name,
			'bk_mny' => $bk_mny,
			'bankname' => $bankname,
			'depositor' => $depositor,
			'account' => $account,
			'va_date' => $va_date,
			'tno' => $tno,
			'via' => $via
		);

		//$this->Common_db_model->setLogs('payment','결제신청',$this->session->userdata(DB_PREFIX.'idx'));
		$idx = $this->Common_db_model->insert_board(pay_orderinfo, $data);

		if($idx){
			$date = new DateTime();
			$startdate = $date->format('Y-m-d H:i:s');
			$startdate_timestamp = strtotime($startdate);

			$date->modify('+'.$period.' month');
			$enddate = $date->format('Y-m-d H:i:s');
			$enddate_timestamp = strtotime($enddate);

			//$this->Common_db_model->update_board(member_list, array( 'startdate' => $startdate_timestamp, 'enddate' => $enddate_timestamp ), array("idx"=> $this->session->userdata(DB_PREFIX.'idx')));

			redirect("/payment/result/".$orderno);

			echo "success";
			exit;
		}else{
			echo "잠시후 다시 이용해주세요.";
		}

	}

	public function result($orderno=""){
		$payresult = "";
		if($orderno){
			$data["payresult"] = $this->Common_db_model->get_row("", pay_orderinfo, array('member_idx' => $this->session->userdata(DB_PREFIX.'idx'), 'orderno' => $orderno, 'is_del'=>'N') ,'idx desc','','');
		}else{
			error_move("잘못된접근입니다.","/payment");
		}

		if($this->session->userdata(DB_PREFIX.'idx') == ""){
			error_move("잘못된접근입니다.","/login");
		}
		if(!count($data["payresult"])){
			error_move("잘못된접근입니다.","/payment");
		}

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$data["orderno"] = $orderno;
		$data["settings"] = getSettings();
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view('paymentresult',$data);
		$this->load->view('_footer'.$is_mobile);

	}

	public function payStatusProc(){
		$type = $this->input->post('type', TRUE);
		$orderno = $this->input->post('orderno', TRUE);
		if($type=="apply"){
			$data = array(
				'pay_status' => "OK",
				'mod_dt' => date('Y-m-d H:i:s')
			);
			$data = $this->Common_db_model->update_board(pay_orderinfo, $data, array("orderno"=> $orderno));
			if($data){
				$payment = $this->Common_db_model->get_row("", pay_orderinfo, array("orderno"=> $orderno) ,'idx desc','','');
				if(count($payment)>0){
					$memberInfo = getUserInfoByIdx($payment[0]["member_idx"]);
					if($memberInfo["startdate"]==0 && $memberInfo["enddate"]==0){
						$date = new DateTime();
						$startdate = $date->format('Y-m-d H:i:s');
						$startdate_timestamp = strtotime($startdate);

						$date->modify('+'.$payment[0]["period"].' month');
						$enddate = $date->format('Y-m-d H:i:s');
						$enddate_timestamp = strtotime($enddate);
					}else{
						$date = new DateTime(date('Y-m-d H:i:s', $memberInfo["enddate"]));
						//$startdate = $date->format('Y-m-d H:i:s');
						$startdate_timestamp = $memberInfo["startdate"];

						$date->modify('+'.$payment[0]["period"].' month');
						$enddate = $date->format('Y-m-d H:i:s');
						$enddate_timestamp = strtotime($enddate);
					}
					$this->Common_db_model->update_board(member_list, array( 'startdate' => $startdate_timestamp, 'enddate' => $enddate_timestamp ), array("idx"=> $this->session->userdata(DB_PREFIX.'idx')));
				}
				echo "success";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}elseif($type=="delete"){
			$data = $this->Common_db_model->update_board(pay_orderinfo, array('is_del' => 'Y','mod_dt' => date('Y-m-d H:i:s')), array("orderno"=> $orderno));
			if($data==true ){
				echo "success";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}
	}
}
