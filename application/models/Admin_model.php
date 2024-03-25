<?
class Admin_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function login_admin($id, $pw){
		$this->db->from(admin_list);
		//$this->db->where(array('id' => $id, 'pwd' => md5($pw)));
		$this->db->where(array('id' => $id));
		
		return $this->db->get()->row_array();
	}
	public function find_admin($id, $hp){
		$this->db->from(admin_list);
		$this->db->where(array('id' => $id, 'hp' => $hp));
		
		return $this->db->get()->row_array();
	}

	public function member_login_log($pg, $id, $memo = ''){
		$data = array(
			'page_name' => $pg,
			'id' => $id,
			'reg_ip' => $this->input->ip_address(),
			'referer' => $this->agent->referrer(),
			'agent' => $this->agent->agent_string(),
			'browser' => $this->agent->browser(),
			'os' => $this->agent->platform(),
			'memo' => $memo,
			'reg_dt' => date('Y-m-d H:i:s')
		);

		$this->db->insert(conn_log, $data);
	}

}
?>