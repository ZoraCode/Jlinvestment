<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mng extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		if($this->session->userdata('sess_first') != ""){
			redirect('/'.admmng.'/'.$this->session->userdata('sess_first'));
		}
		$this->load->view('inc/header',$menu);
		//$this->load->view('mng/main');
		$this->load->view('mng/members');
		$this->load->view('inc/footer');
	}
	// profile
	public function profile(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$profile = $this->Common_db_model->get_row("", admin_list, array('idx' => $this->session->userdata('sess_idx')) ,'idx desc','','');

		$data["profile"] = $profile;
		$this->load->view('inc/header',$menu);
		$this->load->view('member/profile',$data);
		$this->load->view('inc/footer');
	}

	// 관리자관리
	public function manager($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$data["paging"] = $paging;

		$sqlWhere = " idx > 1 ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( id like '%". $searchStr ."%' or name like '%". $searchStr ."%' or hp like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(admin_list, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/manager", $total, $page_per_row);

			$data["manager"] = $this->Common_db_model->get_row("", admin_list, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["manager"] = $this->Common_db_model->get_row("", admin_list, array('idx' => $idx) ,'idx desc','','');
			// $data["room_manager"] = $this->Common_db_model->get_row("", room_manager, array('manager_idx' => $idx) ,'idx desc','','');
		}
		$data["room_list"] = $this->Common_db_model->get_row("", room_list, array(' type > ' => '1') ,'idx desc','','');
		$this->load->view('inc/header',$menu);
		$this->load->view('mng/manager',$data);
		$this->load->view('inc/footer');
	}


	// 회원관리
	public function members($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$search_room_idx = $this->input->get('search_room_idx', TRUE);
		$startdate = $this->input->get('startdate', TRUE);
		$enddate = $this->input->get('enddate', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$data["search_room_idx"] = $search_room_idx;
		$data["startdate"] = $startdate;
		$data["enddate"] = $enddate;
		$data["paging"] = $paging;

		$sqlWhere = " 1 = 1 ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( mb_name like '%". $searchStr ."%' or mb_id like '%". $searchStr ."%' or mb_hp like '%". $searchStr ."%' or mb_nick like '%". $searchStr ."%' )";
			}
			if(!empty($search_room_idx)){
				if($search_room_idx=="free"){
					$sqlWhere .= " and room_idx = '' ";
				}elseif($search_room_idx=="pay"){
					$sqlWhere .= " and room_idx <> '' ";
				}else{
					$sqlWhere .= " and room_idx = '". $search_room_idx ."' ";
				}
			}
			if(!empty($startdate)){
				$startdate_full = $startdate." 00:00:00";
				$startdate_timestamp = strtotime($startdate_full);
				$sqlWhere .= " and startdate >= '". $startdate_timestamp ."' ";
			}
			if(!empty($enddate)){
				$enddate_full = $enddate." 23:59:59";
				$enddate_timestamp = strtotime($enddate_full);
				$sqlWhere .= " and enddate <= '". $enddate_timestamp ."' ";
			}
			if(empty($paging)){
				$paging = 10;
			}


			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(member_list, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/members", $total, $page_per_row);
			$data["members"] = $this->Common_db_model->get_row("", member_list, $sqlWhere ,'idx desc','',$start, $page_per_row);

		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["members"] = $this->Common_db_model->get_row("", member_list, array('idx' => $idx) ,'idx desc','','');
			//sssss
			$data["paycontents"] = $this->Common_db_model->pay_contents_join($idx);
		}
		$data["room_list"] = $this->Common_db_model->get_row("", room_list, array(' type > ' => '1') ,'idx desc','','');
		$data["pdt_list"] = $this->Common_db_model->get_row("", product, array(' idx ') ,'idx desc','','');

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/members',$data);
		$this->load->view('inc/footer');
	}

	public function demembers($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$search_room_idx = $this->input->get('search_room_idx', TRUE);
		$startdate = $this->input->get('startdate', TRUE);
		$enddate = $this->input->get('enddate', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$data["search_room_idx"] = $search_room_idx;
		$data["startdate"] = $startdate;
		$data["enddate"] = $enddate;
		$data["paging"] = $paging;

		$sqlWhere = " 1 = 1 ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( phone like '%". $searchStr ."%' or nick like '%". $searchStr ."%' )";
			}
			if(!empty($search_room_idx)){
				if($search_room_idx=="free"){
					$sqlWhere .= " and room_idx = '' ";
				}elseif($search_room_idx=="pay"){
					$sqlWhere .= " and room_idx <> '' ";
				}else{
					$sqlWhere .= " and room_idx = '". $search_room_idx ."' ";
				}
			}
			if(!empty($startdate)){
				$startdate_full = $startdate." 00:00:00";
				$startdate_timestamp = strtotime($startdate_full);
				$sqlWhere .= " and startdate >= '". $startdate_timestamp ."' ";
			}
			if(!empty($enddate)){
				$enddate_full = $enddate." 23:59:59";
				$enddate_timestamp = strtotime($enddate_full);
				$sqlWhere .= " and enddate <= '". $enddate_timestamp ."' ";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(member_list_withdraw, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/demembers", $total, $page_per_row);

			$data["members"] = $this->Common_db_model->get_row("", member_list_withdraw, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["members"] = $this->Common_db_model->get_row("", member_list_withdraw, array('idx' => $idx) ,'idx desc','','');
		}
		$data["room_list"] = $this->Common_db_model->get_row("", room_list, array(' type > ' => '1') ,'idx desc','','');
		$data["pdt_list"] = $this->Common_db_model->get_row("", product, array(' idx ') ,'idx desc','','');

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/demembers',$data);
		$this->load->view('inc/footer');
	}


	public function membersexceldown(){

		$searchStr = $this->input->get('searchStr', TRUE);
		$startdate = $this->input->get('startdate', TRUE);
		$enddate = $this->input->get('enddate', TRUE);
		$search_room_idx = $this->input->get('search_room_idx', TRUE);
		$targetidxs = $this->input->get('targetidxs', TRUE);

		$sqlWhere = " 1=1 ";

		if(!empty($targetidxs)){
			$sqlWhere .= " and idx in(".$targetidxs.") ";
		}
		// 검색어
		if(!empty($searchStr)){
			$sqlWhere .= " and ( phone like '%". $searchStr ."%' or nick like '%". $searchStr ."%' )";
		}
		if(!empty($search_room_idx)){
			if($search_room_idx=="free"){
				$sqlWhere .= " and room_idx = '' ";
			}elseif($search_room_idx=="pay"){
				$sqlWhere .= " and room_idx <> '' ";
			}else{
				$sqlWhere .= " and room_idx = '". $search_room_idx ."' ";
			}
		}
		if(!empty($startdate)){
			$startdate_full = $startdate." 00:00:00";
			$startdate_timestamp = strtotime($startdate_full);
			$sqlWhere .= " and startdate >= '". $startdate_timestamp ."' ";
		}
		if(!empty($enddate)){
			$enddate_full = $enddate." 23:59:59";
			$enddate_timestamp = strtotime($enddate_full);
			$sqlWhere .= " and enddate <= '". $enddate_timestamp ."' ";
		}

		$list = $this->Common_db_model->get_row("", member_list, $sqlWhere,' 1 desc', '', '');


		// echo $sqlWhere."<br>".count($list);
		$title = "회원관리";
		$data = array();

		//$data['list'] = $list;

		// echo "<pre>".print_r($list)."</pre>";
		// exit;


		$filename = $title."_".date('Ymd').'.xls';

		header( "Content-type: application/vnd.ms-excel" );
		header( "Content-type: application/vnd.ms-excel; charset=utf-8");
		header( "Content-Disposition: attachment; filename=$filename" );
		header( "Content-Description: PHP4 Generated Data" );

		$this->load->view('mng/membersexcel', $data);
	}

	// 결제관리
	public function paymenthistory($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["mode"] = $mode;
		$data["paging"] = $paging;

		$sqlWhere = " is_del = 'N' ";

		if(empty($paging)){
			$paging = 10;
		}
		$page_per_row = $paging;
		$total = $this->Common_db_model->get_query_total(pay_orderinfo, $sqlWhere);
		$no = $total - $start;
		$data['no'] = $no;
		$data['pages'] = $this->Common_db_model->get_page("/".admmng."/paymenthistory", $total, $page_per_row);

		$paymenthistory = $this->Common_db_model->get_row("", pay_orderinfo, $sqlWhere ,'idx desc','',$start, $page_per_row);

		$data["paymenthistory"] = [];

		 $member_idx = "";
		 $mb_idx     = "";
		 $mb_id      = "";
		 $mb_name    = "";

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
				'mb_name'=> $mb_name

		 	 );
		 	}
		$this->load->view('inc/header',$menu);
		$this->load->view('mng/paymenthistory',$data);
		$this->load->view('inc/footer');
	}

	// 상품관리
	public function product(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$data["product"] = $this->Common_db_model->get_row("", product, " 1=1 " ,'pd_price desc','','');

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/product',$data);
		$this->load->view('inc/footer');
	}

	// 그룹관리
	public function server($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["mode"] = $mode;
		$data["paging"] = $paging;

		$sqlWhere = " is_use = 'Y' ";

		if($mode == ""){
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(room_list, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/server", $total, $page_per_row);

			$data["server"] = $this->Common_db_model->get_row("", room_list, $sqlWhere ,'idx desc','',$start, $page_per_row);
			$data["room_manager"] = $this->Common_db_model->get_row("", room_manager, "1=1" ,'idx desc','','');
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["server"] = $this->Common_db_model->get_row("", room_list, array('idx' => $idx) ,'idx desc','','');
			$data["room_manager"] = $this->Common_db_model->get_row("", room_manager, array('room_idx' => $idx) ,'idx desc','','');
		}
		$data["manager"] = $this->Common_db_model->get_row("", admin_list, array(' idx > ' => '1') ,'idx desc','','');

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/server',$data);
		$this->load->view('inc/footer');
	}
	// 사이트관리
	public function apply($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$data["settings"] = getSettings();

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$startdate = $this->input->get('startdate', TRUE);
		$enddate = $this->input->get('enddate', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$data["startdate"] = $startdate;
		$data["enddate"] = $enddate;
		$sqlWhere = " 1=1 ";

		if(!empty($searchStr)){
			$sqlWhere .= " and ( tel like '%". $searchStr ."%' or name like '%". $searchStr ."%' )";
		}
		if(!empty($startdate)){
			$sqlWhere .= " and reg_dt >= '". $startdate ." 00:00:00' ";
		}
		if(!empty($enddate)){
			$sqlWhere .= " and reg_dt <= '". $enddate ." 23:59:59' ";
		}
		if(empty($paging)){
			$paging = 10;
		}
		$page_per_row = $paging;
		$total = $this->Common_db_model->get_query_total(apply, $sqlWhere);
		$no = $total - $start;
		$data['no'] = $no;
		$data['pages'] = $this->Common_db_model->get_page("/".admmng."/apply", $total, $page_per_row);
		$data["apply"] = $this->Common_db_model->get_row("", apply, $sqlWhere ,'idx desc','',$start, $page_per_row);

		if($mode=="excel"){
			$this->exceldown();
		}


		$this->load->view('inc/header',$menu);
		$this->load->view('mng/apply', $data);
		$this->load->view('inc/footer');
	}

	public function applyexceldown(){
		$searchStr = $this->input->get('searchStr', TRUE);
		$startdate = $this->input->get('startdate', TRUE);
		$enddate = $this->input->get('enddate', TRUE);
		$sqlWhere = " 1=1 ";
		// 검색어
		if(!empty($searchStr)){
			$sqlWhere .= " and ( title like '%". $searchStr ."%' )";
		}
		if(!empty($startdate)){
			$sqlWhere .= " and reg_dt >= '". $startdate ." 00:00:00' ";
		}
		if(!empty($enddate)){
			$sqlWhere .= " and reg_dt <= '". $enddate ." 23:59:59' ";
		}
		$list = $this->Common_db_model->get_row("", apply, $sqlWhere,' 1 desc', '', '');
		$title = "신청내역";
		$data = array();

		$data['list'] = $list;

		$filename = $title."_".date('Ymd').'.xls';

		header( "Content-type: application/vnd.ms-excel" );
		header( "Content-type: application/vnd.ms-excel; charset=utf-8");
		header( "Content-Disposition: attachment; filename=$filename" );
		header( "Content-Description: PHP4 Generated Data" );

		$this->load->view('mng/applyexcel', $data);

	}


	// 사이트관리
	public function settings(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$data["settings"] = getSettings();

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/settings', $data);
		$this->load->view('inc/footer');
	}
	// 매인 비쥬얼 관리
	public function visual($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$sqlWhere = " 1=1 ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( title like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(main_visual, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/visual", $total, $page_per_row);
			$data["visual"] = $this->Common_db_model->get_row("", main_visual, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["visual"] = $this->Common_db_model->get_row("", main_visual, array('idx' => $idx) ,'idx desc','','');
		}

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/visual', $data);
		$this->load->view('inc/footer');
	}

	public function banner_old($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$sqlWhere = " 1=1 ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( title like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(banner, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/banner", $total, $page_per_row);
			$data["banner"] = $this->Common_db_model->get_row("", banner, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["banner"] = $this->Common_db_model->get_row("", banner, array('idx' => $idx) ,'idx desc','','');
		}

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/banner', $data);
		$this->load->view('inc/footer');
	}

    // 홈페이지 배너관리
	public function banner($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$sqlWhere = " type2 = 'banner' ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( title like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(popup, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/banner", $total, $page_per_row);
			$data["banner"] = $this->Common_db_model->get_row("", popup, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["banner"] = $this->Common_db_model->get_row("", popup, array('idx' => $idx) ,'idx desc','','');
		}

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/banner', $data);
		$this->load->view('inc/footer');
	}

	// 팝업관리
	public function popup($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;
		$sqlWhere = " type2 = 'popup' ";

		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( title like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(popup, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/popup", $total, $page_per_row);
			$data["popup"] = $this->Common_db_model->get_row("", popup, $sqlWhere ,'idx desc','',$start, $page_per_row);
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["popup"] = $this->Common_db_model->get_row("", popup, array('idx' => $idx) ,'idx desc','','');
		}

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/popup', $data);
		$this->load->view('inc/footer');
	}

	// 약관/개인정보
	public function privacy(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$sqlWhere = " idx=1 ";
		$data["privacy"] = $this->Common_db_model->get_row("", siteinfo, $sqlWhere ,'idx desc','','');

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/privacy', $data);
		$this->load->view('inc/footer');
	}

	// 문자발송
	public function sendsms(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$mode = $this->input->get('mode', TRUE);

		$search_room_idx = $this->input->get('search_room_idx', TRUE);
		$push = $this->input->get('push', TRUE);
		$type = $this->input->get('type', TRUE);
		$title = $this->input->get('title', TRUE);
		$contents = $this->input->get('contents', TRUE);
		$data["mode"] = $mode;
		$data["push"] = $push;
		$data["type"] = $type;
		$data["title"] = $title;
		$data["contents"] = $contents;
		$data["search_room_idx"] = $search_room_idx;

		$data["settings"] = getSettings();
		$apikey = COM_YESBIT_KEY;

		$sms_api = file_get_contents("http://www.sendmon.com/_REST/smsApi.asp?apikey=".$apikey);

		$result = json_decode($sms_api);
		$data["cash"] = $result->cashinfo[0]->cash;
		$data["sms"] = $result->cashinfo[0]->sms;
		$data["lms"] = $result->cashinfo[0]->lms;
		$data["mms"] = $result->cashinfo[0]->mms;


		$sqlWhere = " 1=1 ";
		if(!empty($search_room_idx)){
			if($search_room_idx=="free"){
				$sqlWhere .= " and room_idx = '' ";
			}elseif($search_room_idx=="pay"){
				$sqlWhere .= " and room_idx <> '' ";
			}else{
				$sqlWhere .= " and room_idx = '". $search_room_idx ."' ";
			}
		}
		$data["pdt_list"] = $this->Common_db_model->get_row("", product, array(' idx ') ,'idx desc','','');
		$data["room_list"] = $this->Common_db_model->get_row("", room_list, array(' type > ' => '1') ,'idx desc','','');
		$data["members"] = $this->Common_db_model->get_row("", member_list, $sqlWhere ,'idx desc','',null);

		$smsList = getSmsList();
		$settleList = json_decode($smsList);
		$data["settleList"] = $settleList->result;

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/sendsms', $data);
		$this->load->view('inc/footer');
	}
	// 문자발송
	public function sendhistory(){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$data["settings"] = getSettings();
		$search_room_idx = $this->input->post('search_room_idx', TRUE);
		$data["search_room_idx"] = $search_room_idx;

		$data["history_list"] = "";
		if(!empty($search_room_idx)){
				$history_r = send_sms("list","","","","",$search_room_idx,"history");

			$history_r = preg_replace("/[\r\n]+/", " ", $history_r);
			$history_result = json_decode($history_r);

			$history_list = isset($history_result->result)?$history_result->result:null;
			$data["history_list"] = $history_list;
		}

		$data["pdt_list"] = $this->Common_db_model->get_row("", product, array(' idx ') ,'idx desc','','');
		$data["room_list"] = $this->Common_db_model->get_row("", room_list, array(' type > ' => '1') ,'idx desc','','');
		$this->load->view('inc/header',$menu);
		$this->load->view('mng/sendhistory', $data);
		$this->load->view('inc/footer');
	}


	public function review($start=0){
		$this->board($start);
	}
	public function profit($start=0){
		$this->board($start);
	}
	public function notice($start=0){
		$this->board($start);
	}
	public function performance($start=0){
		$this->board($start);
	}
	public function oneminute($start=0){
		$this->board($start);
	}
	public function faq($start=0){
		$this->board($start);
	}
	public function viprecommend($start=0){
		$this->board($start);
	}
	public function market($start=0){
		$this->board($start);
	}
	public function research($start=0){
		$this->board($start);
	}
	public function sector($start=0){
		$this->board($start);
	}
	public function issue($start=0){
		$this->board($start);
	}
	public function interview($start=0){
		$this->board($start);
	}
	// 220322 유료영상게시판 추가
	public function payclass($start=0){
		$this->board($start);
	}
	public function board($start=0){

		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		$data["settings"] = getSettings();
		$mode = $this->input->get('mode', TRUE);
		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["mode"] = $mode;
		$data["searchStr"] = $searchStr;

		$sqlWhere = " category='".$category."' and is_notice='N' ";
		$sqlWhere_noti = " is_notice='Y' and category='".$category."' ";
		if($mode == ""){
			if(!empty($searchStr)){
				$sqlWhere .= " and ( subject like '%". $searchStr ."%' or  contents like '%". $searchStr ."%' )";
				$sqlWhere_noti .= " and ( subject like '%". $searchStr ."%' or  contents like '%". $searchStr ."%' )";
			}
			if(empty($paging)){
				$paging = 10;
			}
			$page_per_row = $paging;
			$total = $this->Common_db_model->get_query_total(board, $sqlWhere);
			$no = $total - $start;
			$data['no'] = $no;
			$data['pages'] = $this->Common_db_model->get_page("/".admmng."/".$category, $total, $page_per_row);
			$data["notice"] = $this->Common_db_model->get_row("", board, $sqlWhere ,'idx desc','',$start, $page_per_row);

			$data["noticelist"] = $this->Common_db_model->get_row("", board, $sqlWhere_noti , '1 desc' , "", "");
		}elseif($mode == "update"){
			$data["idx"] = $idx;
			$data["notice"] = $this->Common_db_model->get_row("", board, array('idx' => $idx) ,'idx desc','','');
		}
		if($idx && !count($data["notice"])){
			redirect("/".admmng."/".$category);
		}
		$this->load->view('inc/header',$menu);
		//$this->load->view('mng/'.$category, $data);
		$this->load->view('mng/board', $data);
		$this->load->view('inc/footer');
	}

	public function down($category, $idx){
		$param = array();
		$param['category'] = $category;
		$param['idx'] = $idx;

		//$row = $this->Common_db_model->get_board($param);
		$row = $this->Common_db_model->get_row("", board, $param,' 1 desc', '', '');
		$data = $row[0];
		echo force_download("./upload/board/".$category."/".$data['upfile'], NULL);
		history_back();
	}


	public function excel(){
		$conn = mysqli_connect("localhost","premium_db","premium_db!@!","premium_db");
		$this->load->view('excel/excel_reader2.php');
		$this->load->view('excel/SpreadsheetReader.php');
		$import = $this->input->post('import', TRUE);

		if (isset($import)){
			$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/haansoftxlsx','application/haansoftxls'];
			if(in_array($_FILES["file"]["type"],$allowedFileType)){
				$targetPath = './upload/'.$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
				$Reader = new SpreadsheetReader($targetPath);
				$sheetCount = count($Reader->sheets());
				for($i=0;$i<$sheetCount;$i++){
					$Reader->ChangeSheet($i);
					foreach ($Reader as $Row){
						$name = "";
						if(isset($Row[0])) {
							$name = mysqli_real_escape_string($conn,$Row[0]);
						}
						$description = "";
						if(isset($Row[1])) {
							$description = mysqli_real_escape_string($conn,$Row[1]);
						}
						if (!empty($name) || !empty($description)) {
							$query = "insert into tbl_info(name,description) values('".$name."','".$description."')";
							$result = mysqli_query($conn, $query);
							if (! empty($result)) {
								$type = "success";
								$message = "Excel Data Imported into the Database";
							} else {
								$type = "error";
								$message = "Problem in Importing Excel Data";
							}
						}
					 }
				 }
			}else{
				$type = "error";
				$message = "Invalid File Type. Upload Excel File.";
			}
		}
		$data["conn"] = $conn;

		$this->load->view('inc/header');
		$this->load->view('excel',$data);
		$this->load->view('inc/footer');
	}

	// 220322 구매내역게시판 추가
	public function paycontentslist($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);
		// $data["settings"] = getSettings();

		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["searchStr"] = $searchStr;
		$sqlWhere = " 1=1 ";

		if(!empty($searchStr)){
			$searchStr = $this->db->escape_like_str($searchStr);
			$sqlWhere .= " and ( mb_id like '%". $searchStr ."%' ESCAPE '!' )";
		}
		if(empty($paging)){
			$paging = 10;
		}
		$page_per_row = $paging;
		$total = $this->Common_db_model->get_query_total(pay_contents_list, $sqlWhere);
		$no = $total - $start;
		$data['no'] = $no;
		$data['pages'] = $this->Common_db_model->get_page("/".admmng."/paycontentslist", $total, $page_per_row);
		$data["pay_contents_list"] = $this->Common_db_model->get_row("jl_pay_contents_list.* , (select subject from jl_board where idx = jl_pay_contents_list.bd_idx) as subject", pay_contents_list, $sqlWhere ,'idx desc','',$start, $page_per_row);

		$this->load->view('inc/header',$menu);
		$this->load->view('mng/paycontentslist', $data);
		$this->load->view('inc/footer');
	}

	// 220322 열람 로그 게시판 추가
	public function paycontentshistory($start=0){
		$category = $this->uri->segment(2);
		$menu["pn"] = $category;
		$data = get_title($category);

		$idx = $this->input->get('idx', TRUE);
		$searchStr = $this->input->get('searchStr', TRUE);
		$paging = $this->input->get('paging', TRUE);
		$data["paging"] = $paging;
		$data["searchStr"] = $searchStr;
        // $sqlWhere = " 1=1 ";
		$sqlWhere = " type = 'read' ";

		if(!empty($searchStr)){
			// $sqlWhere .= " and ( mb_id like '%". $searchStr ."%' or bd_idx like '%". $searchStr ."%' )";
			$searchStr = $this->db->escape_like_str($searchStr);
            $sqlWhere .= " and ( mb_id like '%". $searchStr ."%' ESCAPE '!' )";
		}
		if(empty($paging)){
			$paging = 10;
		}
		$page_per_row = $paging;
		$total = $this->Common_db_model->get_query_total(pay_contents_log, $sqlWhere);
        if ($start > $total) { $start=0; } // 검색 버그 픽스 by hiro 200914
		$no = $total - $start;
		$data['no'] = $no;
		$data['pages'] = $this->Common_db_model->get_page("/".admmng."/paycontentshistory", $total, $page_per_row);
		$data["pay_contents_log"] = $this->Common_db_model->get_row("", pay_contents_log, $sqlWhere ,'idx desc','',$start, $page_per_row);


		$this->load->view('inc/header',$menu);
		$this->load->view('mng/paycontentshistory', $data);
		$this->load->view('inc/footer');
	}
}
