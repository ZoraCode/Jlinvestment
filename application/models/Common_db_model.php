<?
class Common_db_model extends CI_Model{

	private $query_on = 0;
	public function __construct(){
		$this->load->database();
	}

	// SELECT
	// count(*)

	public function get_query_total($tbl,$w){
		// echo $w;
		// exit;
		$this->db->from($tbl);
		$this->db->where($w);
		$query = $this->db->get();

		return $query->num_rows();
	}
	// row list
	public function get_row($c = "*", $f, $w = "1=1", $o = "1 desc", $s, $l, $page_per_row = PAGE_PER_ROW){
		$this->db->select($c);
		$this->db->from($f);

		if(!is_array($w)) {
		//	$w = str_replace("'", "''", remove_invisible_characters($w, FALSE));
			//	$w1 = $this->db->escape_like_str($w);
			//		echo $w1;
		}

		$this->db->where($w);
		$this->db->order_by($o);

		if($s !="" && $l==""){
			$this->db->limit($s);
		}else{
			if(!is_null($l)){
				$this->db->limit($page_per_row, $l);
			}
		}

		$query = $this->db->get();
		if($this->query_on){
			echo $this->db->last_query();
		}
		if($s=="1" && $l==""){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}
	public function get_from_query($query){
		$result = $this->db->query($query);
	    $result = $result->result_array();
		return $result;
	}
	public function insert($table, $data){

		$data['reg_dt'] = date('Y-m-d H:i:s');
		$data['reg_ymd'] = date('Y-m-d');
		$data['reg_ip'] = $this->input->ip_address();

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function insert_update($table, $data, $where = '1=1'){

		$count = $this->get_query_total($table, $where);

		if ($count > 0 ) {
			return $this->db->update($table, $data, $where);
		}

		// 인서트할때만 시간 기록
		$data['reg_dt'] = date('Y-m-d H:i:s');
		$data['reg_ymd'] = date('Y-m-d');
		$data['reg_ip'] = $this->input->ip_address();

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($table, $data, $where = '1=1'){
		return $this->db->update($table, $data, $where);
	}


	public function insert_board($table, $data){

		$data['reg_dt'] = date('Y-m-d H:i:s');
		$data['reg_ymd'] = date('Y-m-d');
		$data['reg_ip'] = $this->input->ip_address();

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update_board($table, $data, $where = '1=1'){
		return $this->db->update($table, $data, $where);
	}

	public function delete_board($table, $where = array('1' => 1)){
		$this->db->delete($table, $where);
	}

	public function add_hit($idx){
		$sql = "update ".board.
				" set hit = hit + 1
				where idx = ".$idx;
		$this->db->query($sql);
	}
	public function get_page($url, $total, $page_per_row = PAGE_PER_ROW,$uri_seg = 0){
		$config['base_url'] = $url;
		$config['total_rows'] = $total;
		$config['per_page'] = $page_per_row;
		$config['uri_segment'] = $uri_seg; //몇번째 segment에 페이징 값을 입력할지 설정한다.
		$config['num_links'] = BLOCK_PER_PAGE; // 선택된 페이지번호 좌우로 몇개의 “숫자”링크를 보여줄지 설정
		$config['reuse_query_string'] = true;


		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	public function setLogs($page='', $msg, $memo='', $alert_type=''){
		if(!$this->session->userdata('sess_idx')){
			//redirect('/');
			//exit;
		}else{
			$data = array(
				'member_idx' => $this->session->userdata('sess_idx'),
				'page' => $page,
				'msg' => $msg,
				'memo' => $memo,
				'alert_type' => $alert_type,
				'reg_dt' => date('Y-m-d H:i:s'),
				'reg_ymd' => date('Y-m-d'),
				'reg_ip' => $this->input->ip_address()
			);
			$this->db->insert(logs, $data);
		}
	}
	public function setSmsLog($type, $title='', $msg, $sno, $rno){
		$data = array(
			'type' => $type,
			'title' => $title,
			'msg' => $msg,
			'sno' => $sno,
			'rno' => $rno,
			'reg_dt' => date('Y-m-d H:i:s'),
			'reg_ymd' => date('Y-m-d'),
			'reg_ip' => $this->input->ip_address()
		);
		$this->db->insert(send_log, $data);
	}
	public function get_param(){
		$param = array();
		if(count($_GET)){
			$param = $_GET;
		}
		if(count($_POST)){
			$param = $_POST;
		}
		return $param;
	}
	public function create_table($tbl_name){

		if(!empty($tbl_name)){
			$this->load->dbforge();
			$fields = array(
				'idx' => array('type' => 'INT','constraint' => 11,'unsigned' => TRUE,'auto_increment' => TRUE),
				'member_idx' => array('type' => 'INT','constraint' => 11,'default' => '100'),
				'type' => array('type' => 'INT','constraint' => 11,'default' => '100'),
				'phone' => array('type' =>'VARCHAR','constraint' => '100','default' => NULL,'null' => TRUE),
				'nick' => array('type' =>'VARCHAR','constraint' => '100','default' => NULL,'null' => TRUE),
				'image' => array('type' =>'VARCHAR','constraint' => '500','default' => ''),
				'message' => array('type' => 'TEXT'),
				'whisper_idx' => array('type' => 'INT','constraint' => 11,'default' => '0'),
				'is_danger' => array('type' => 'INT','constraint' => 11,'default' => '0'),
				'is_hide' => array('type' => 'INT','constraint' => 11,'default' => '0'),
				'reg_dt' => array('type' => 'datetime','default' => '0000-00-00 00:00:00'),
				'reg_ymd' => array('type' => 'date','default' => '0000-00-00'),
				'reg_ip' => array('type' => 'VARCHAR','constraint' => '15','default' => '')
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('idx', TRUE);
			$attributes = array('ENGINE' => 'InnoDB');
			$this->dbforge->create_table($tbl_name, FALSE, $attributes);
		}
	}
	public function drop_table($tbl_name){

		if(!empty($tbl_name)){
			$this->load->dbforge();
			$this->dbforge->drop_table($tbl_name, TRUE);
		}
	}

	public function pay_contents_join($idx){
		$this->db->select("jl_pay_contents_list.idx , jl_pay_contents_list.bd_idx , IFNULL(jl_board.subject,'잘못된 게시글 정보입니다.') as subject");
		$this->db->from(pay_contents_list);
		$this->db->join(board, "jl_pay_contents_list.bd_idx = jl_board.idx and jl_board.category = 'payclass'", 'left');
		$this->db->where(" jl_pay_contents_list.mb_idx = ".$idx);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function user_payclass_list($mb_id){
		$this->db->select("bd_idx");
		$this->db->from(pay_contents_log);
		$this->db->where(array('type'=>'read', 'mb_id'=>$mb_id));
		$this->db->group_by(array('mb_idx', 'bd_idx'));

		$query = $this->db->get();
		return $query->result_array();

	}
}
?>
