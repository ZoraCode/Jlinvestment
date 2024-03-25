<?
class Main extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('kcppayment/index');
	}
	public function order(){
		$this->load->view('kcppayment/sample/order');
	}
	public function kcpevent(){
		$selfip = $this->input->ip_address();

		$site_cd = $this->input->post('site_cd', TRUE);
		$tno = $this->input->post('tno', TRUE);
		$order_no = $this->input->post('order_no', TRUE);
		$tx_cd = $this->input->post('tx_cd', TRUE);
		$tx_tm = $this->input->post('tx_tm', TRUE);


		$ipgm_name = $this->input->post("ipgm_name", TRUE);
		$remitter  = $this->input->post("remitter" , TRUE);
		$ipgm_mnyx = $this->input->post("ipgm_mnyx", TRUE);
		$bank_code = $this->input->post("bank_code", TRUE);
		$account   = $this->input->post("account"  , TRUE);
		$op_cd     = $this->input->post("op_cd"    , TRUE);
		$noti_id   = $this->input->post("noti_id"  , TRUE);
		$cash_a_no = $this->input->post("cash_a_no", TRUE);
		$cash_a_dt = $this->input->post("cash_a_dt", TRUE);

		$data = array();
		$data['site_cd'] = $site_cd;
		$data['tno'] = $tno;
		$data['order_no'] = $order_no;
		$data['tx_cd'] = $tx_cd;
		$data['tx_tm'] = $tx_tm;

		$data['ipgm_name'] = $ipgm_name;
		$data['remitter'] = $remitter;
		$data['ipgm_mnyx'] = $ipgm_mnyx;
		$data['bank_code'] = $bank_code;
		$data['account'] = $account;
		$data['op_cd'] = $op_cd;
		$data['noti_id'] = $noti_id;
		$data['cash_a_no'] = $cash_a_no;
		$data['cash_a_dt'] = $cash_a_dt;
		$result = "0000";
		if($tx_cd == "TX00"){
			if($selfip == "1.227.95.122" || $selfip == "183.96.24.38"){

				if($tno != ""){
					$param["tno"] = $tno;
					$param["pay_status"] = "WAIT";
					$param["pay_type"] = "VBANK";
					$list = $this->order_model->get_order($param,'idx desc');
					$idx = $list[0]["idx"];
					if($idx != ""){
						$param2["pay_status"] = "DONE";
						$param2["reg_dt"] = date('Y-m-d H:i:s');
						$udt = $this->order_model->update_order($param2,$idx);

						$param3['idx'] = $list[0]["seminar_idx"];
						$param3['category'] = $list[0]["category"];
						$row = $this->seminar_model->get_seminar($param3);

						$msg = "[지식인스쿨 결제안내]\n".$list[0]["service"]."\n강의일:".$row[0]["seminar_dt"]."\n강의시간:".$row[0]["lec_time"]."\n강의실:".$row[0]["lec_room"]."\n수강료:".$row[0]["price"]."원\n결제수단:가상계좌 결제완료 되었습니다.";
						send_sml($list[0]["userhp"],SND_PHN_ID,$msg,'10');

						// 결제완료후 알림문자발송
						$msg2 = "[결제알림] 이름:".$list[0]["username"]."\n상품명:".$list[0]["service"]."\n결제금액:".$list[0]["price"]."원\n결제수단:가상계좌";
						send_sml('01040330905',SND_PHN_ID,$msg2,'10');
					}else{
						$result = "1111";
					}
				}else{
					$result = "1111";
				}
			}else{
				$result = "1111";
			}
		}else{
			$result = "1111";
		}
		$data["result"] = $result;
		$this->load->view('kcppayment/kcpevent',$data);
	}

}
