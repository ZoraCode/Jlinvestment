<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index(){

		$category = $this->uri->segment(1);

		$menu["pn"] = $category;

		//$data["market"] = $this->Common_db_model->get_row("", board, array('category' => 'market') ,'idx desc','5','');
		//$data["research"] = $this->Common_db_model->get_row("", board, array('category' => 'research') ,'idx desc','5','');
		//$data["sector"] = $this->Common_db_model->get_row("", board, array('category' => 'sector') ,'idx desc','5','');
		//$data["issue"] = $this->Common_db_model->get_row("", board, array('category' => 'issue') ,'idx desc','5','');
		//$data["visual"] = $this->Common_db_model->get_row("", main_visual, " view='Y' " ,'idx asc','','');

        $data["popup"] = $this->Common_db_model->get_row("", popup, " view='Y' and type2 = 'popup' " ,'idx desc','','');
        $data["banner"] = $this->Common_db_model->get_row("", popup, " view='Y' and type2 = 'banner' " ,'idx desc','','');

		if(trim($_SERVER['SERVER_NAME'])!='jlinvestment.co.kr'){
					$url = "https://jlinvestment.co.kr". $_SERVER['REQUEST_URI']."";
					redirect($url);
					exit;
		}
		if(substr($_SERVER['HTTP_HOST'],0,3)=="www"){
			header("Location: https://jlinvestment.co.kr");
		}
		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'index',$data);
		$this->load->view('_footer'.$is_mobile);
	}
	public function error(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		//echo $this->agent->referrer();

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		if($this->session->userdata('sess_idx')){
			$this->load->view('inc/header'.$is_mobile,$menu);
			$this->load->view('error');
			$this->load->view('inc/footer'.$is_mobile);
		}else{
			$this->load->view('_header'.$is_mobile,$menu);
			$this->load->view('error');
			$this->load->view('_footer'.$is_mobile);
		}
	}
	public function mypage(){
		if(!$this->session->userdata(DB_PREFIX.'idx')){
			redirect("/");
		}
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";

		}

		$data["mypage"] = $this->Common_db_model->get_row("", member_list, array('idx' => $this->session->userdata(DB_PREFIX.'idx')) ,'','1','');
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'mypage',$data);
		$this->load->view('_footer'.$is_mobile);
	}
	public function payment(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$data["settings"] = getSettings();
		$data["product"] = $this->Common_db_model->get_row("", product, "1=1" ,'','','');

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view('payment',$data);
		$this->load->view('_footer'.$is_mobile);
	}
	public function paymenthistory(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$member_idx = $this->session->userdata(DB_PREFIX.'idx');

		// $data["paymenthistory"] = $this->Common_db_model->get_row("", pay_orderinfo, array('member_idx' => $this->session->userdata(DB_PREFIX.'idx'), 'is_del'=>'N') ,'idx desc','10000','');
		// $data["member"] = $this->Common_db_model->get_row("", member_list, array('idx' => $this->session->userdata(DB_PREFIX.'idx'), 'is_del'=>'N') ,'idx desc','','');
		// $data["pdt_list"] = $this->Common_db_model->get_row("", product, array(' idx ') ,'idx desc','','');

		$paymenthistory = $this->Common_db_model->get_row("", pay_orderinfo, array('member_idx' => $this->session->userdata(DB_PREFIX.'idx'), 'is_del'=>'N') ,'idx desc','10000','');

		$data["paymenthistory"] = [];

		 $member_idx = "";
		 $mb_idx     = "";
		 $mb_id      = "";
		 $mb_name    = "";

		 // echo "<pre>".print_r($paymenthistory)."</pre>";

		 foreach ($paymenthistory as $item) {
		 	$member_idx = $item["member_idx"];
		 	$price = $item["price"];
			$total_price = $item["total_price"];
		 	$pay_method = $item["pay_method"];
		 	$pay_status = $item["pay_status"];
		 	$orderno = $item["orderno"];
			$reg_dt= $item["reg_dt"];

				if(!empty($member_idx)){
	 			 	$members = $this->Common_db_model->get_row("", member_list, array('idx' => $member_idx) ,'idx desc','','');
				 	foreach ($members as $mem) {
				 	 	$mb_idx  = $mem["idx"];
					 	$mb_id   = $mem["mb_id"];
					 	$mb_name = $mem["mb_name"];
						$startdate = $mem["startdate"];
						$enddate = $mem["enddate"];
				 }
	 		 	}

		 	$data["paymenthistory"][] = $arrayName = array(
		 		'member_idx' => $member_idx,
		 		'price' => $price,
				'total_price' => $total_price,
		 		'pay_method' => $pay_method,
		 		'pay_status' => $pay_status,
		 		'orderno' => $orderno,
				'reg_dt' => $reg_dt,
				'mb_idx'=> $mb_idx,
				'mb_id'=> $mb_id,
				'mb_name'=> $mb_name,
				'startdate'=> $startdate,
				'enddate'=> $enddate
		 	 );
		 	}

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view('paymenthistory',$data);
		$this->load->view('_footer'.$is_mobile);
	}
	public function popup($idx){

		$data["popup"] = $this->Common_db_model->get_row("", popup, " view='Y' and idx=".$idx ,'idx desc','','');
		$this->load->view('popup',$data);
	}

	public function login(){
		checkLogin();
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'login');
		$this->load->view('_footer'.$is_mobile);
	}
	public function signup(){
		checkLogin();
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$step = $this->input->post('step', TRUE);
		$name = $this->input->post('name', TRUE);
		$data["step"] = $step;
		$data["name"] = $name;

		if($data["step"]==""){
			$sqlWhere = " idx=1 ";
			$data["pp"] = $this->Common_db_model->get_row("", siteinfo, $sqlWhere ,'idx desc','','');
		}
		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'signup',$data);
		$this->load->view('_footer'.$is_mobile);
	}

	public function findidpw(){
		checkLogin();
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'findidpw');
		$this->load->view('_footer'.$is_mobile);
	}


	public function caresystem(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$this->load->view('_header',$menu);
		$this->load->view('caresystem');
		$this->load->view('_footer');
	}

	// 회사소개
	public function company(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";

		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'company');
		$this->load->view('_footer'.$is_mobile);
	}

	public function philosophy(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'philosophy');
		$this->load->view('_footer'.$is_mobile);
	}

	public function promise(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'promise');
		$this->load->view('_footer'.$is_mobile);
	}

	public function award(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'award');
		$this->load->view('_footer'.$is_mobile);
	}

	public function test2(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'test2');
		$this->load->view('_footer'.$is_mobile);
	}

	public function milestones(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'milestones');
		$this->load->view('_footer'.$is_mobile);
	}
	
	
	//회사소개 ... end
	public function h2o(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'h2o');
		$this->load->view('_footer'.$is_mobile);
	}

	public function vipapply(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$sqlWhere = " idx=1 ";
		$data["pp"] = $this->Common_db_model->get_row("", siteinfo, $sqlWhere ,'idx desc','','');

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'vipapply',$data);
		$this->load->view('_footer'.$is_mobile);
	}

	public function jlvip(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		//수정
		$data["product"] = $this->Common_db_model->get_row("", product, "1=1" ,'','','');

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'jlvip',$data);
		$this->load->view('_footer'.$is_mobile);
	}
	public function vipservice(){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		//수정
		//$data["vipsevice"] = $this->Common_db_model->get_row("", product, "1=1" ,'','','');

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}

		$this->load->view('_header'.$is_mobile,$menu);
		$this->load->view($redirect.'vipservice');
		$this->load->view('_footer'.$is_mobile);
	}


	public function performance($page=0, $idx=0){
		$this->board($page, $idx);
	}

	public function oneminute($page=0, $idx=0){
		$this->board($page, $idx);
	}

	public function issue($page=0, $idx=0){
		$this->board($page, $idx);
	}
	public function notice($page=0, $idx=0){
		$this->board($page, $idx);
	}

	public function review($page=0, $idx=0){
		$this->board($page, $idx);
	}
	public function profit($page=0, $idx=0){
		$this->board($page, $idx);
	}
	public function interview($page=0, $idx=0){
		$this->board($page, $idx);
	}
	// 220322 뷰 추가
	public function payclass($page=0, $idx=0){
		$this->board($page, $idx);
	}

	public function board($page=0, $idx=0){
		$category = $this->uri->segment(1);
		$menu["pn"] = $category;
		$data = get_title($category);
		$data["settings"] = getSettings();
		$searchStr = $this->input->get('searchStr', TRUE);

		$is_mobile = "";
		$redirect = "";
		if($this->agent->is_mobile()){
			$is_mobile = "_m";
			$redirect="mobile/";
		}
		$member_id = $this->session->userdata(DB_PREFIX.'id');
		$member_idx = $this->session->userdata(DB_PREFIX.'idx');
		if(!empty($member_idx)){
			$data["payresult"] = $this->Common_db_model->get_row("", pay_orderinfo, array('member_idx' => $this->session->userdata(DB_PREFIX.'idx'), 'member_idx' => $member_idx, 'is_del'=>'N') ,'idx desc','','');
		}

		$mode = $this->input->get('mode', TRUE);
		$data["mode"] = $mode;
		$data["page"] = $page;
		$data["searchStr"] = $searchStr;
		$data["idx"] = $idx;
		$sqlWhere ="1=1";
		$sqlWhere_noti = " is_notice='Y' and category='".$category."' ";



		//$sqlWhere = array('category' => $category);
		if(!$idx){
			//$sqlWhere["is_notice"] = 'N';
		}
		// 220322 카테고리 추가
		if(empty($idx) or $category == "review" or $category == "profit" or $category == "interview" or $category == "payclass"){

			$sqlWhere .= " and category='".$category."' and is_notice='N' ";
			if(!empty($searchStr)){
				//
				//$sqlWhere["and subject like '%". $searchStr ."%' or  contents like '%". $searchStr ."%'"] = null;
				$sqlWhere .= " and ( subject like '%". $searchStr ."%' or  contents like '%". $searchStr ."%' )";
				$sqlWhere_noti .= " and ( subject like '%". $searchStr ."%' or  contents like '%". $searchStr ."%' )";
			}
			$paging = 10;
			if($category != "review"){
				$paging = 20;
			}

			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(board, $sqlWhere);
			$no = $total - $page;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".$category, $total, $page_per_row,2);
			$data["user_pay_list"] = null;
			if($category == "payclass")
			{
				$user_pay_list = $this->Common_db_model->user_payclass_list($member_id);
				$data["user_pay_list"] = array_column($user_pay_list, "bd_idx");
			}
			$data["notice"] = $this->Common_db_model->get_row("", board, $sqlWhere ,'idx desc','',$page, $page_per_row);
			$data["noticelist"] = $this->Common_db_model->get_row("", board, $sqlWhere_noti , '1 desc' , "", "");
		}

        $data["lists"] = null;
		if(!empty($idx)){
			$sqlWhere .= " and idx=".$idx;
			//$sqlWhere["idx"] = $idx;
			$limit ="1";
            $data["lists"] = $this->Common_db_model->get_row("", board, $sqlWhere, " idx desc" , "", "");

			if(!isset($this->session->get_userdata()["notice_hit".$idx])){
				$this->Common_db_model->add_hit($idx);
				$this->session->set_userdata('notice_hit'.$idx, true);
			}

			// 유료컨텐츠 열람 로그 - usher 220323
			$data["pay_contents"] = null;
			if($category=="payclass"){

				$log_data = array(
					"mb_idx" => $member_idx,
					"mb_id"  => $member_id,
					"bd_idx" => $idx,
                    "bd_subject" => $data["lists"][0]["subject"],
					"type" 	=> "read",
					"reg_id" => $member_id
				);

				// 유료동영상 게시판 권한 확인 - usher 220323
				$data["pay_contents"] = $this->Common_db_model->get_row("", pay_contents_list, array('mb_idx' => $member_idx, 'bd_idx'=>$idx) ,'idx desc','','');
				if(count($data["pay_contents"]) > 0)
				{
                    if(!isset($this->session->get_userdata()["payclass_read".$idx]))
					{
                        $this->Common_db_model->insert(pay_contents_log, $log_data);
                        $this->session->set_userdata('payclass_read'.$idx, strtotime(date("Y-m-d H:i:s")));
                    }
					else
					{
						$save_time = $this->session->get_userdata()["payclass_read".$idx];
						$now_time = strtotime(date("Y-m-d H:i:s"));
						if($now_time - $save_time >= 300)
						{
							$this->Common_db_model->insert(pay_contents_log, $log_data);
							$this->session->set_userdata('payclass_read'.$idx, strtotime(date("Y-m-d H:i:s")));
						}
					}

				}else{
					alert_history_back("유료 결제가 필요합니다.");
				}
			}


			$p_orderby = "1 desc";
			$n_orderby = "1 asc";
			if($category=="notice"){
				$p_orderby = "is_notice desc,1 desc";
				$n_orderby = "is_notice desc,1 asc";
			}
			$data["prev_idx"] = $this->Common_db_model->get_row("", board, "category = '".$category."' and idx < ". $idx . " and is_notice='N' ", $p_orderby, "1", "");
			$data["next_idx"] = $this->Common_db_model->get_row("", board, "category = '".$category."' and idx > ". $idx . " and is_notice='N' ", $n_orderby, "1", "");

			//$data["notice"] = $this->Common_db_model->get_row("", board, array('idx' => $idx) ,'idx desc','','');
		}
        else
        {
            $data["lists"] = $this->Common_db_model->get_row("", board, $sqlWhere, " idx desc" , "", "");
        }

		if($idx && !count($data["lists"])){
			redirect("/".$category);
		}

		$this->load->view('_header'.$is_mobile,$menu);
		// $view_page = $category=="review" ? "review":"board";
		//
		// if($category=="profit"){
		// 	$view_page = "profit";
		// }
		// if($category=="interview"){
		// 	$view_page = "interview";
		// }


		// 220322 카테고리 추가
		if($category=="review" || $category=="profit" || $category=="interview" || $category=="payclass"){
			$view_page = $category;
		}
		else {
			$view_page = "board";
		}

		$this->load->view($redirect.$view_page, $data);
		$this->load->view('_footer'.$is_mobile);
	}

	public function logout(){
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if(strpos($key,DB_PREFIX)!==false){
				$this->session->unset_userdata($key);
			}
		}

		//$this->session->sess_destroy();
		redirect('/');
	}

	public function test(){

			// $user_pay_list = $this->Common_db_model->user_payclass_list($member_id);
			// $data["user_pay_list"] = $this->Common_db_model->user_payclass_list($member_id);
			// $user_pay_list = null;
			$user_pay_list = array();

			$data["user_pay_list"] = array_column($user_pay_list, "bd_idx");
	}

}
