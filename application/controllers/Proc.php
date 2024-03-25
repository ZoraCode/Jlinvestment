<?
class Proc extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function managerProc(){

		if($this->session->userdata('sess_id') == "" || $this->session->userdata('sess_level') == ""){
			echo "access denied";
			exit;
		}

		$idx = $this->input->post('idx', TRUE);
		$id = $this->input->post('id', TRUE);
		$name = $this->input->post('name', TRUE);
		$hp = $this->input->post('hp', TRUE);
		$email = $this->input->post('email', TRUE);
		$pwd = $this->input->post('pwd', TRUE);
		$pwd2 = $this->input->post('pwd2', TRUE);
		$level = $this->input->post('level', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$room_idx = $this->input->post('room_idx', TRUE);
		$ip_pass = $this->input->post('ip_pass', TRUE);
		$menus = $this->input->post('menus', TRUE);

		if($mode == "update"){
			if( (isset($name) or !empty($name)) and (isset($hp) or !empty($hp))){
				$data = array(
					'hp' => $hp,
					'email' => $email,
					'name' => $name,
					'ip_pass' => $ip_pass
				);
				if(!empty($menus)){
					$data["menus"] = $menus;
				}
				if($pwd != "" and $pwd2 != ""){
					if($pwd == $pwd2){
						$data["pwd"] = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
					}else{
						echo "비밀번호가 일치하지 않습니다.";
						exit;
					}
				}
				if($idx != ""){
					$data["level"] = $level;
				}

				$member_idx = $idx != "" ? $idx : $this->session->userdata('sess_idx');
				$data = $this->Common_db_model->update_board(admin_list, $data, "idx='".$member_idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs('manager','수정',$this->session->userdata('sess_id'));
					echo "success";
				}else{
					echo "잠시후 다시 이용해주세요.";
				}

			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}elseif($mode == "write"){
			if($pwd == $pwd2){
				$options = ['cost' => 12];
				$userPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

				$data = array(
					'id'=> $id,
					'pwd'=> $userPwd,
					'name'=> $name,
					'ip_pass'=> $ip_pass,
					'hp'=> $hp,
					'email'=> $email,
					'level'=> $level,
					'menus' => $menus
				);

				// $data = $this->Common_db_model->insert_board(admin_list, $data);
				// 220412 아이디 중복체크 - usher
				$data2 = $this->Common_db_model->get_query_total(admin_list, array("id"=>$id));
				if(empty($data2)){
					$data = $this->Common_db_model->insert_board(admin_list, $data);
					$this->Common_db_model->setLogs('manager','추가',$this->session->userdata('sess_id'));
					echo "success";
				}else{
					echo "중복된 아이디가 있습니다.";
				}
			}else{
				echo "비밀번호가 일치하지 않습니다.";
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(admin_list, 'idx='.$idx);
				$this->Common_db_model->delete_board(room_manager, 'manager_idx='.$idx);
				$this->Common_db_model->setLogs('manager','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}

	public function roomManagerProc(){
		$room_idx = $this->input->post('room_idx', TRUE);
		$manager_idx = $this->input->post('manager_idx', TRUE);
		$mode = $this->input->post('mode', TRUE);

		if($mode=="i"){
			if($room_idx!="" and $manager_idx != ""){
				$room_mng_data = $this->Common_db_model->insert_board(room_manager, array('room_idx'=>$room_idx, 'manager_idx'=>$manager_idx));
				if($room_mng_data){
					$this->Common_db_model->setLogs('manager','room->manager할당','room:'.$room_idx.',manager:'.$manager_idx);
					echo "추가되었습니다.";
				}else{
					echo "잠시후 다시 이용해주세요.";
				}
			}else{
				echo "잘못된 접근입니다.";
			}
		}elseif($mode=="d"){
			if($room_idx!="" and $manager_idx != ""){
				$this->Common_db_model->delete_board(room_manager, 'room_idx='.$room_idx.' and manager_idx='.$manager_idx);
				$this->Common_db_model->setLogs('manager','room->manager삭제','room:'.$room_idx.',manager:'.$manager_idx);
				echo "삭제되었습니다.";
			}else{
				echo "잘못된 접근입니다.";
			}
		}else{
			echo "잘못된 접근입니다.";
		}
	}
	public function membersProc(){
		$idx = $this->input->post('idx', TRUE);
		$nick = $this->input->post('nick', TRUE);
		$phone = $this->input->post('phone', TRUE);
		$startdate = $this->input->post('startdate', TRUE);
		$enddate = $this->input->post('enddate', TRUE);
		$room_idx = $this->input->post('room_idx', TRUE);
		$memo = $this->input->post('memo', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$target = $this->input->post('target', TRUE);
		$email = $this->input->post('email', TRUE);
		$pwd = $this->input->post('pwd', TRUE);
		$agreesms = $this->input->post('agreesms', TRUE);
		$agreeemail = $this->input->post('agreeemail', TRUE);
		$mb_id = $this->input->post('mb_id', TRUE);
		$mb_name = $this->input->post('mb_name', TRUE);

		if($mode == "update"){
			if( (isset($nick) or !empty($nick)) and (isset($phone) or !empty($phone))){

				$startdate_timestamp = "";
				$enddate_timestamp = "";
				if($startdate != ""){
					$startdate = $startdate." 00:00:00";
					$startdate_timestamp = strtotime($startdate);
				}
				if($enddate != ""){
					$enddate = $enddate." 00:00:00";
					$enddate_timestamp = strtotime($enddate);
				}

				$data = array(
					'mb_email' => $email,
					'mb_hp' => $phone,
					'mb_nick' => $nick,
					'startdate' => $startdate_timestamp,
					'enddate' => $enddate_timestamp,
					'room_idx' => $room_idx,
					'memo' => $memo,
					'agree_email' => $agreeemail,
					'agree_sms' => $agreesms
				);
				if(!empty($pwd)){
					$data["mb_pwd"] = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]);
				}
				$total = $this->Common_db_model->get_query_total(member_list, " mb_hp='". $phone ."' and idx <> '".$idx."' ");
				if($total==0){
					$data = $this->Common_db_model->update_board(member_list, $data, "idx='".$idx."'");
					if($data==true ){
						$this->Common_db_model->setLogs('members','수정',$this->session->userdata('sess_id'));
						echo "success";
					}else{
						echo "잠시후 다시 이용해주세요.";
					}
				}else{
					echo "이미 가입된 휴대번호입니다.";
				}

			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}elseif($mode == "batch"){
			if( (isset($target) or !empty($target)) and (isset($startdate) or !empty($startdate)) and (isset($enddate) or !empty($enddate)) and (isset($room_idx) or !empty($room_idx))){
				$startdate_timestamp = "";
				$enddate_timestamp = "";
				if($startdate != ""){
					$startdate = $startdate." 00:00:00";
					$startdate_timestamp = strtotime($startdate);
				}
				if($enddate != ""){
					$enddate = $enddate." 00:00:00";
					$enddate_timestamp = strtotime($enddate);
				}
				$data = array(
					'startdate' => $startdate_timestamp,
					'enddate' => $enddate_timestamp,
					'room_idx' => $room_idx
				);

				$data = $this->Common_db_model->update_board(member_list, $data, "idx in (".$target.")");
				if($data==true ){
					$this->Common_db_model->setLogs('members','수정',$this->session->userdata('sess_id'));
					echo "success";
				}else{
					echo "잠시후 다시 이용해주세요.";
				}

			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}elseif($mode == "write"){
			if( (isset($nick) or !empty($nick)) and (isset($phone) or !empty($phone))){
				$startdate_timestamp = "";
				$enddate_timestamp = "";
				if($startdate != ""){
					$startdate = $startdate." 00:00:00";
					$startdate_timestamp = strtotime($startdate);
				}
				if($enddate != ""){
					$enddate = $enddate." 23:59:59";
					$enddate_timestamp = strtotime($enddate);
				}

				$data = array(
					'mb_id' => $mb_id,
					'mb_name' => $mb_name,
					'mb_nick' => $nick,
					'mb_hp' => $phone,
					'mb_email' => $email,
					'mb_pwd' => password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 12]),
					'startdate' => $startdate_timestamp,
					'enddate' => $enddate_timestamp,
					'room_idx' => $room_idx,
					'memo' => $memo,
					'agree_email' => $agreeemail,
					'agree_sms' => $agreesms
				);
				$total = $this->Common_db_model->get_query_total(member_list, " mb_hp='". $phone ."' ");
				if($total==0){
					$data = $this->Common_db_model->insert_board(member_list, $data);
					if($data){
						$this->Common_db_model->setLogs('members','추가',$this->session->userdata('sess_id'));
						echo "success";
					}else{
						echo "잠시후 다시 이용해주세요.";
					}
				}else{
					echo "이미 가입된 휴대번호입니다.";
				}
			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(member_list, 'idx='.$idx);
				$this->Common_db_model->setLogs('members','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}

	public function serverProc(){
		$idx = $this->input->post('idx', TRUE);
		$type = $this->input->post('type', TRUE);
		$name = $this->input->post('name', TRUE);
		$ment = $this->input->post('ment', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$is_use = $this->input->post('is_use', TRUE);
		$title = $this->input->post('title', TRUE);
		$welcome = $this->input->post('welcome', TRUE);
		$topnoti = $this->input->post('topnoti', TRUE);
		$image = $this->input->post('image', TRUE);

		$config['upload_path']          = './upload/server/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10240;
		$config['max_width']            = 1024;
		$config['max_height']           = 1024;
		$config['encrypt_name']         = true;

		if($mode == "update"){
			if( (isset($name) or !empty($name)) and (isset($ment) or !empty($ment)) and (isset($type) or !empty($type))){

				$data = array(
					'type' => $type,
					'ment' => $ment,
					'name' => $name,
					'title'=> $title
				);
				$this->load->library('upload', $config);
				if($this->upload->do_upload("image")){
					$upload_data = array('upload_data' => $this->upload->data());
					$img = $upload_data["upload_data"]["file_name"];
					$data["image"] = $img;
				}

				$this->Common_db_model->setLogs('server','수정',$this->session->userdata('sess_id'));
				$data = $this->Common_db_model->update_board(room_list, $data, "idx='".$idx."'");
				if($data==true ){
					error_move("정상적으로 수정되었습니다.","/".admmng."/server?mode=update&idx=$idx");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/server");
				}

			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/server");
			}
		}elseif($mode == "write"){
			if( (isset($name) or !empty($name)) and (isset($ment) or !empty($ment)) and (isset($type) or !empty($type))){

				if(!is_dir($config['upload_path'])){
					mkdir($config['upload_path'], 0777);
				}

				$this->load->library('upload', $config);
				if($this->upload->do_upload("image")){
					$data = array('upload_data' => $this->upload->data());
					$image = $data["upload_data"]["file_name"];
				}
				$data = array(
					'type'=> $type,
					'name'=> $name,
					'ment'=> $ment,
					'image'=> $image,
					'title'=> $title
				);

				$data = $this->Common_db_model->insert_board(room_list, $data);
				if($data){
					$this->Common_db_model->create_table(chat_log.$data);
					$this->Common_db_model->setLogs('server','등록',$this->session->userdata('sess_id'));
					error_move("정상적으로 등록되었습니다.","/".admmng."/server");
				}else{
					error_move("정상적으로 등록되었습니다.","/".admmng."/server");
				}

			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/server");
			}

		}elseif($mode == "delete"){
			if($idx){
				$total = $this->Common_db_model->get_query_total(member_list, array("room_idx"=>$idx));
				if($total>0){
					echo "그룹회원이 존재합니다. 소속 회원들의 그룹을 변경후 삭제해주세요.";
				}else{
					$this->Common_db_model->delete_board(room_list, 'idx='.$idx);
					$this->Common_db_model->delete_board(room_manager, 'room_idx='.$idx);
					$this->Common_db_model->drop_table(chat_log.$idx);
					$this->Common_db_model->setLogs('server','삭제',$this->session->userdata('sess_id'));
					echo 'success';
				}
			}else{
				echo 'error';
			}
		}
	}

	public function bannerProc_old(){
		$idx = $this->input->post('idx', TRUE);
		$title = $this->input->post('title', TRUE);
		$img = $this->input->post('img', TRUE);
		$link = $this->input->post('link', TRUE);
		$is_use = $this->input->post('is_use', TRUE);
		$mode = $this->input->post('mode', TRUE);

		$config['upload_path']          = './upload/banner/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10240;
		$config['max_width']            = 1024;
		$config['max_height']           = 1024;
		$config['encrypt_name']         = true;

		if($mode == "update"){
			$this->load->library('upload', $config);
			$data = array(
				'title' => $title,
				'link' => $link,
				'is_use' => $is_use
			);

			if($this->upload->do_upload("img")){
				$upload_data = array('upload_data' => $this->upload->data());
				$img = $upload_data["upload_data"]["file_name"];
				$img_width = $upload_data["upload_data"]["image_width"];
				$img_height = $upload_data["upload_data"]["image_height"];

				$data["img"] = $img;
				$data["img_width"] = $img_width;
				$data["img_height"] = $img_height;
			}

			if( isset($title) or !empty($title)){
				$data = $this->Common_db_model->update_board(banner, $data, "idx='".$idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs('banner','수정',$this->session->userdata('sess_id'));
					error_move("정상적으로 수정되었습니다.","/".admmng."/banner?mode=update&idx=$idx");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/banner");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/banner");
			}
		}elseif($mode == "write"){

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("img")){
				$error = array('error' => $this->upload->display_errors());
				error_move(strip_tags($error["error"]),"/banner");
			}else{
				$data = array('upload_data' => $this->upload->data());
				$img = $data["upload_data"]["file_name"];
				$img_width = $data["upload_data"]["image_width"];
				$img_height = $data["upload_data"]["image_height"];
				if( (isset($img) or !empty($img)) and (isset($title) or !empty($title))){
					$data = array(
						'title' => $title,
						'img' => $img,
						'img_width' => $img_width,
						'img_height' => $img_height,
						'link' => $link,
						'is_use' => $is_use
					);
					$data = $this->Common_db_model->insert_board(banner, $data);
					if($data){
						$this->Common_db_model->setLogs('banner','추가',$this->session->userdata('sess_id'));
						error_move("정상적으로 등록되었습니다.","/".admmng."/banner");
					}else{
						error_move("잠시후 다시 이용해주세요.","/".admmng."/banner");
					}
				}else{
					error_move("유효하지 않은 접근입니다.","/".admmng."/banner");
				}
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(banner, 'idx='.$idx);
				$this->Common_db_model->setLogs('banner','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}
	public function applyDelProc(){
		$idx = $this->input->post('idx', TRUE);
		if($idx){
			$this->Common_db_model->delete_board(apply, 'idx='.$idx);
			$this->Common_db_model->setLogs('apply','삭제',$this->session->userdata('sess_id'));
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function popupProc(){
		$idx = $this->input->post('idx', TRUE);
		$title = $this->input->post('title', TRUE);
		$contents = $this->input->post('contents', TRUE);
		$link = $this->input->post('link', TRUE);
		$tab = $this->input->post('tab', TRUE);
		$view = $this->input->post('view', TRUE);
		$type = $this->input->post('type', TRUE);
        $type2 = $this->input->post('type2', TRUE);
		$x_size = $this->input->post('x_size', TRUE);
		$y_size = $this->input->post('y_size', TRUE);
		$x_pos = $this->input->post('x_pos', TRUE);
		$y_pos = $this->input->post('y_pos', TRUE);
		$mode = $this->input->post('mode', TRUE);

		if($mode == "update"){
			if( (isset($title) or !empty($title)) and (isset($contents) or !empty($contents))){
				$data = array(
					'title' => $title,
					'contents' => $contents,
					'link' => $link,
					'tab' => $tab,
					'view' => $view,
					'type' => $type,
                    // 'type2' => $type2,
					'x_size' => $x_size,
					'y_size' => $y_size,
					'x_pos' => $x_pos,
					'y_pos' => $y_pos
				);

				$data = $this->Common_db_model->update_board(popup, $data, "idx='".$idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs('popup','수정',$this->session->userdata('sess_id'));
					error_move("정상적으로 수정되었습니다.","/".admmng."/popup?mode=update&idx=$idx");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/popup");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/popup");
			}
		}elseif($mode == "write"){
			if( (isset($title) or !empty($title)) and (isset($contents) or !empty($contents))){
				$data = array(
					'title' => $title,
					'contents' => $contents,
					'link' => $link,
					'tab' => $tab,
					'view' => $view,
					'type' => $type,
                    'type2' => $type2,
					'x_size' => $x_size,
					'y_size' => $y_size,
					'x_pos' => $x_pos,
					'y_pos' => $y_pos
				);
				$data = $this->Common_db_model->insert_board(popup, $data);
				if($data){
					$this->Common_db_model->setLogs('popup','추가',$this->session->userdata('sess_id'));
					error_move("정상적으로 등록되었습니다.","/".admmng."/popup");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/popup");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/popup");
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(popup, 'idx='.$idx);
				$this->Common_db_model->setLogs('popup','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}

    public function bannerProc(){
		$idx = $this->input->post('idx', TRUE);
		$title = $this->input->post('title', TRUE);
		$contents = $this->input->post('contents', TRUE);
		$link = $this->input->post('link', TRUE);
		$tab = $this->input->post('tab', TRUE);
		$view = $this->input->post('view', TRUE);
		$type = $this->input->post('type', TRUE);
        $type2 = $this->input->post('type2', TRUE);
		$x_size = $this->input->post('x_size', TRUE);
		$y_size = $this->input->post('y_size', TRUE);
		$x_pos = $this->input->post('x_pos', TRUE);
		$y_pos = $this->input->post('y_pos', TRUE);
		$mode = $this->input->post('mode', TRUE);

		if($mode == "update"){
			if( (isset($title) or !empty($title)) and (isset($contents) or !empty($contents))){
				$data = array(
					'title' => $title,
					'contents' => $contents,
					'link' => $link,
					'tab' => $tab,
					'view' => $view,
					'type' => $type,
                    // 'type2' => $type2,
					'x_size' => $x_size,
					'y_size' => $y_size,
					'x_pos' => $x_pos,
					'y_pos' => $y_pos
				);

				$data = $this->Common_db_model->update_board(popup, $data, "idx='".$idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs('banner','수정',$this->session->userdata('sess_id'));
					error_move("정상적으로 수정되었습니다.","/".admmng."/banner?mode=update&idx=$idx");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/banner");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/banner");
			}
		}elseif($mode == "write"){
			if( (isset($title) or !empty($title)) and (isset($contents) or !empty($contents))){
				$data = array(
					'title' => $title,
					'contents' => $contents,
					'link' => $link,
					'tab' => $tab,
					'view' => $view,
					'type' => $type,
                    'type2' => $type2,
					'x_size' => $x_size,
					'y_size' => $y_size,
					'x_pos' => $x_pos,
					'y_pos' => $y_pos
				);
				$data = $this->Common_db_model->insert_board(popup, $data);
				if($data){
					$this->Common_db_model->setLogs('banner','추가',$this->session->userdata('sess_id'));
					error_move("정상적으로 등록되었습니다.","/".admmng."/banner");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/banner");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/banner");
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(popup, 'idx='.$idx);
				$this->Common_db_model->setLogs('popup','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}


	public function visualProc(){
		$idx = $this->input->post('idx', TRUE);
		$title = $this->input->post('title', TRUE);
		$link = $this->input->post('link', TRUE);
		$view = $this->input->post('view', TRUE);

		$upfile = $this->input->post('upfile', TRUE);
		$upfile_bg = $this->input->post('upfile_bg', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$filedel = $this->input->post('filedel', TRUE);
		$filedel_bg = $this->input->post('filedel_bg', TRUE);
		$upload_path = './upload/board/visual/';
		if(isset($_FILES['upfile']['name'])){
			if(!is_dir($upload_path)){
				mkdir($upload_path, 0777);
			}
		}
		$config['upload_path']          = $upload_path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10240;
		$config['encrypt_name']         = true;
		if(!is_dir("./upload/board/")){
			mkdir("./upload/board/", 0777);
		}


		if($mode == "update"){
			if( (isset($title) or !empty($title)) and (isset($link) or !empty($link))){
				$data = array(
					'title' => $title,
					'link' => $link,
					'view' => $view
				);

				$this->load->library('upload', $config);
				if($_FILES['upfile']['name']) {
					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777);
					}
					if($this->upload->do_upload("upfile")){
						$upload_data = array('upload_data' => $this->upload->data());
						$data["upfile"] = $upload_data["upload_data"]["file_name"];
					}else{
						$error = array('error' => $this->upload->display_errors());
						alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
					}
				}
				if($filedel=="Y"){
					$data["upfile"] = "";
				}
				if($_FILES['upfile_bg']['name']) {
					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777);
					}
					if($this->upload->do_upload("upfile_bg")){
						$upload_data = array('upload_data' => $this->upload->data());
						$data["upfile_bg"] = $upload_data["upload_data"]["file_name"];
					}else{
						$error = array('error' => $this->upload->display_errors());
						alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
					}
				}
				if($filedel_bg=="Y"){
					$data["upfile_bg"] = "";
				}

				$data = $this->Common_db_model->update_board(main_visual, $data, "idx='".$idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs('visual','수정',$this->session->userdata('sess_id'));
					error_move("정상적으로 수정되었습니다.","/".admmng."/visual?mode=update&idx=$idx");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/visual");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/visual");
			}
		}elseif($mode == "write"){
			if( (isset($title) or !empty($title)) and (isset($link) or !empty($link))){
				$data = array(
					'title' => $title,
					'link' => $link,
					'view' => $view
				);
				$this->load->library('upload', $config);
				if($_FILES['upfile']['name']) {

					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777);
					}
					if($this->upload->do_upload("upfile")){
						$upload_data = array('upload_data' => $this->upload->data());
						$data["upfile"] = $upload_data["upload_data"]["file_name"];
					}else{
						$error = array('error' => $this->upload->display_errors());
						alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
						exit;
					}
				}
				if($_FILES['upfile_bg']['name']) {
					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777);
					}
					if($this->upload->do_upload("upfile_bg")){
						$upload_data = array('upload_data' => $this->upload->data());
						$data["upfile_bg"] = $upload_data["upload_data"]["file_name"];
					}else{
						$error = array('error' => $this->upload->display_errors());
						alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
					}
				}
				if($filedel_bg=="Y"){
					$data["upfile_bg"] = "";
				}

				$data = $this->Common_db_model->insert_board(main_visual, $data);
				if($data){
					$this->Common_db_model->setLogs('visual','추가',$this->session->userdata('sess_id'));
					error_move("정상적으로 등록되었습니다.","/".admmng."/visual");
				}else{
					error_move("잠시후 다시 이용해주세요.","/".admmng."/visual");
				}
			}else{
				error_move("유효하지 않은 접근입니다.","/".admmng."/visual");
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(main_visual, 'idx='.$idx);
				$this->Common_db_model->setLogs('visual','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}
	}
	public function productProc(){
		$mode = $this->input->post('mode', TRUE);
		$pd_title = $this->input->post('pd_title', TRUE);
		$pd_price = $this->input->post('pd_price', TRUE);
		$pd_period = $this->input->post('pd_period', TRUE);
		$pd_ratio = $this->input->post('pd_ratio', TRUE);
		$pd_discount = $this->input->post('pd_discount', TRUE);
		$idx = $this->input->post('idx', TRUE);
		$data = array(
			'pd_title'=>$pd_title,
			'pd_price'=>$pd_price,
			'pd_period'=>$pd_period,
			'pd_discount'=>$pd_discount
		);
		if($mode=="write"){
			$data = $this->Common_db_model->insert_board(product, $data);
			if($data){
				$this->Common_db_model->setLogs('product','추가',$this->session->userdata('sess_id'));
				echo "success";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}elseif($mode=="update"){
			$data = $this->Common_db_model->update_board(product, $data, "idx='".$idx."'");
			if($data==true ){
				$this->Common_db_model->setLogs('product','수정',$this->session->userdata('sess_id'));
				echo "정상적으로 수정되었습니다.";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}elseif($mode=="delete"){
			if($idx){
				$this->Common_db_model->delete_board(product, 'idx='.$idx);
				$this->Common_db_model->setLogs('product','삭제',$this->session->userdata('sess_id'));
				echo 'success';
			}else{
				echo 'error';
			}
		}else{
			echo "유효하지 않은 접근입니다.";
		}
	}
	public function privacyProc(){
		$mode = $this->input->post('mode', TRUE);
		$privacy = $this->input->post('privacy', TRUE);
		$terms = $this->input->post('terms', TRUE);
		$otheragree = $this->input->post('otheragree', TRUE);

		if( (isset($mode) or !empty($mode)) ){
			if((isset($privacy) or !empty($privacy))){
				$data["privacy"] = $privacy;
			}
			if((isset($terms) or !empty($terms))){
				$data["terms"] = $terms;
			}
			if((isset($otheragree) or !empty($otheragree))){
				$data["otheragree"] = $otheragree;
			}

			$data = $this->Common_db_model->update_board(siteinfo, $data, "idx=1");
			if($data==true ){
				$this->Common_db_model->setLogs('privacy','수정',$this->session->userdata('sess_id'));
				error_move("정상적으로 수정되었습니다.","/".admmng."/privacy");
			}else{
				error_move("잠시후 다시 이용해주세요.","/".admmng."/privacy");
			}
		}else{
			error_move("유효하지 않은 접근입니다.","/".admmng."/privacy");
		}
	}
	public function settingProc(){
		$data = $this->Common_db_model->get_param();

		if(count($data)){
			$data = $this->Common_db_model->update_board(siteinfo, $data, "idx=1");
			if($data==true ){
				$this->Common_db_model->setLogs('apikey','수정',$this->session->userdata('sess_id'));
				echo "success";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}else{
			echo "유효하지 않은 접근입니다.";
		}

	}

	public function smsChargeProc(){
		$price = $this->input->post('price', TRUE);
		$price = $price*10000;
		echo request_charge($price);
	}

	public function sendProc(){
		$target = $this->input->post('target', TRUE);
		$push = $this->input->post('push', TRUE);
		$type = $this->input->post('type', TRUE);
		$title = $this->input->post('title', TRUE);
		$contents = $this->input->post('contents', TRUE);
		$members = $this->input->post('members', TRUE);
		$settings = getSettings();

		if($target && $type && $title && $contents){
			$sqlWhere = " 1=1 ";
			if($target=="free"){
				$sqlWhere .= " and room_idx = '0' ";
			}elseif($target=="pay"){
				$sqlWhere .= " and room_idx <> '0' ";
			}elseif($target=="all"){
				$sqlWhere .= " and 1=1 ";
			}else{
				$sqlWhere .= " and room_idx = '". $target ."' ";
			}

			$target_list = $this->Common_db_model->get_row("", member_list, $sqlWhere ,'','',null);

			if(count($target_list)){
				$phone = array();
				$to = array();
				foreach($target_list as $var){
					array_push($phone, $var["mb_hp"]);
					if(isset($var["pushkey"]) && $push =="Y"){
						array_push($to, $var["pushkey"]);
					}
				}
			}
			if(is_array($phone)){
				$phone = implode(",",$phone);
			}

			$sms_result = send_sms($type,$title,$contents,"",$phone,$target);
			$this->Common_db_model->setSmsLog($type,$title,$contents,COM_NUMBER,$phone,$target);
			$result = json_decode($sms_result);
			$send_result = $result->result;
			if($push =="Y"){
				if(count($to)){
					$sms_result = send_fcm($title, $contents, $target, $to);
					$sms_result = json_decode($sms_result);
					if($sms_result->success){
						$send_result = "success";
					}
				}
			}
			echo $send_result;
			exit;
		}else{
			echo "잘못된 접근입니다.";
			exit;
		}
	}
	// 문자발송detail
	public function getListSmsDetail(){
		$uniq_id = $this->input->post('uniq_id', TRUE);
		$used_cd = $this->input->post('used_cd', TRUE);

		$data["history_list"] = "";
		if(!empty($uniq_id) && !empty($used_cd)){
			$history = send_sms("detail",$uniq_id,"","","",$used_cd,"history");
			$history = preg_replace("/[\r\n]+/", " ", $history);
			$history_result = json_decode($history);

			$history_list = $history_result->result;
			$history_list2 = isset($history_result->result2)?$history_result->result2:null;

			$history_result = $history_list2!=null?array_merge($history_list,$history_list2):$history_list;

			echo json_encode($history_result);

			//$data["history_list"] = $history_list;

		}else{
			echo "잘못된 접근입니다.";
		}

	}
	public function applyProc(){
		$name = $this->input->post('name', TRUE);
		$tel = $this->input->post('tel', TRUE);
		$price = $this->input->post('price', TRUE);
		$category = $this->input->post('category', TRUE);
		$etc = $this->input->post('etc', TRUE);
		$agree3 = $this->input->post('agree3', TRUE);
		$captcha = $this->input->post('captcha', TRUE);
		//echo "applyProc : ".$captcha;

		$secretKey = '6Ld7o-AUAAAAAE5KiCS97lKz8xlvzlm0m4BGvnMy'; // 위에서 발급 받은 "비밀 키"를 넣어줍니다.
		$captchaData = array(
			  'secret' => $secretKey,
			  'response' => $captcha
		);
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $captchaData);
		$response = curl_exec($ch);
		curl_close($ch);


		$responseKeys = json_decode($response, true);


		if ($responseKeys["success"]) {

			if(!empty($name) and !empty($tel)){
				$data = array(
					'name'=> $name,
					'tel'=> $tel,
					'price'=> $price,
					'category'=> $category,
					'agree3'=> $agree3,
					'etc'=> $etc
				);
				$data = $this->Common_db_model->insert_board(apply, $data);

				if($data){
					echo "success";
				}else{
					echo "잠시후 다시 이용해주세요.";
				}
			}else{
				echo "잘못된 접근입니다.";
			}

		} else {
			echo "사용자 인증이 실패해습니다. : ".$responseKeys["error-codes"][0];
		}



	}
	public function boardProc(){
		$idx = $this->input->post('idx', TRUE);
		$subject = $this->input->post('subject', TRUE);
		$contents = $this->input->post('contents');
		$category = $this->input->post('category', TRUE);
		$is_notice = $this->input->post('is_notice', TRUE);
		$is_notice = $is_notice == "" ? "N" : $is_notice;

		$writer_name = $this->input->post('writer_name', TRUE);
		$etc1 = $this->input->post('etc1', TRUE);
		if(empty($writer_name)){
			if(strpos($this->agent->referrer(),admmng)!==false){
				$writer_name = $this->session->userdata('sess_name');
			}else{
				$writer_name = $this->session->userdata(DB_PREFIX.'name');
			}
		}

		if(strpos($this->agent->referrer(),admmng)!==false){
			$writer_id = $this->session->userdata('sess_id');
		}else{
			$writer_id = $this->session->userdata(DB_PREFIX.'id');
		}

		$upfile = $this->input->post('upfile', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$filedel = $this->input->post('filedel', TRUE);
		$upload_path = './upload/board/'.$category.'/';
		if(isset($_FILES['upfile']['name'])){
			if(!is_dir($upload_path)){
				mkdir($upload_path, 0777);
			}
		}
		$config['upload_path']          = $upload_path;
		$config['allowed_types']        = 'gif|jpg|png|xls|xlsx|doc|docx|hwp';
		$config['max_size']             = 10240;
		$config['max_width']            = 1024;
		$config['max_height']           = 1024;
		$config['encrypt_name']         = true;
		if(!is_dir("./upload/board/")){
			mkdir("./upload/board/", 0777);
		}

		if(strpos($this->agent->referrer(),admmng) !== false){
			$redirect = "/".admmng."/".$category;
			$refadm = true;
		}else{
			$redirect = "/".$category;
			$refadm = false;
		}

		if($mode == "update"){
			$data = array(
				'subject' => $subject,
				'contents' => $contents,
				'writer_name' => $writer_name,
				//'writer_id' => $writer_id,
				'is_notice' => $is_notice,
				'etc1' => $etc1
			);
			$this->load->library('upload', $config);
			if($_FILES['upfile']['name']) {

				if(!is_dir($upload_path)){
					mkdir($upload_path, 0777);
				}
				if($this->upload->do_upload("upfile")){
					$upload_data = array('upload_data' => $this->upload->data());
					$data["upfile"] = $upload_data["upload_data"]["file_name"];
				}else{
					$error = array('error' => $this->upload->display_errors());

					//error_move(strip_tags($error["error"]),$redirect."/0/".$idx);
					//error_move("파일용량 or 이미지사이즈를 확인해주세요.",$redirect."/0/".$idx."?mode=update");
					alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
					//cus_alert("파일용량 or 이미지사이즈를 확인해주세요.");
					//history_back();
					//error_move("파일용량 or 이미지사이즈를 확인해주세요.","/".admmng."/".$category."?mode=update&idx=$idx");
				}
			}
			if($filedel=="Y"){
				$data["upfile"] = "";
			}

			if( (isset($subject) or !empty($subject)) and (isset($contents) or !empty($contents))){
				$data = $this->Common_db_model->update_board(board, $data, "idx='".$idx."'");
				if($data==true ){
					$this->Common_db_model->setLogs($category,'수정',$this->session->userdata('sess_id'));
					if($refadm){
						$redirect = $redirect."?mode=update&idx=$idx";
					}else{
						$redirect = $redirect."/0/".$idx;
					}
					error_move("정상적으로 수정되었습니다.",$redirect);
				}else{
					error_move("잠시후 다시 이용해주세요.",$redirect);
				}
			}else{
				error_move("유효하지 않은 접근입니다.",$redirect);
			}
		}elseif($mode == "write"){

			if( (isset($subject) or !empty($subject)) and (isset($contents) or !empty($contents)) and (isset($mode) or !empty($mode))){
				$data = array(
					'subject' => $subject,
					'contents' => $contents,
					'category' => $category,
					'writer_name' => $writer_name,
					'writer_id' => $writer_id,
					'is_notice' => $is_notice,
					'upfile' => $upfile,
					'etc1' => $etc1
				);

				$this->load->library('upload', $config);
				if($_FILES['upfile']['name']) {

					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777);
					}
					if($this->upload->do_upload("upfile")){
						$upload_data = array('upload_data' => $this->upload->data());
						$data["upfile"] = $upload_data["upload_data"]["file_name"];
					}else{
						//echo $this->upload->display_errors('<p>', '</p>');
						$error = array('error' => $this->upload->display_errors());

						alert_history_back("파일용량 or 파일사이즈를 확인해주세요.");
						exit;
						//error_move("파일용량 or 이미지사이즈를 확인해주세요.","/".admmng."/".$category."?mode=update&idx=$idx");
					}
				}

				$data = $this->Common_db_model->insert_board(board, $data);

				if($data){
					$this->Common_db_model->setLogs($category,'추가',$this->session->userdata('sess_id'));
					error_move("정상적으로 등록되었습니다.",$redirect);
				}else{
					error_move("잠시후 다시 이용해주세요.",$redirect);
				}
			}else{
				error_move("유효하지 않은 접근입니다.",$redirect);
			}
		}elseif($mode == "delete"){
			if($idx){
				$this->Common_db_model->delete_board(board, 'idx='.$idx);
				$this->Common_db_model->setLogs($category,'삭제',$this->session->userdata('sess_id'));
				echo 'success';
				exit;
			}else{
				echo 'error';
			}
		}
	}

	public function signupProc(){
		$param = $this->Common_db_model->get_param();

		if(!empty($param["check_hp"]) and !empty($param["check_id"]) and !empty($param["check_nick"]) and $param["step"] =="1"){
		//if(!empty($param["check_hp"]) and !empty($param["check_id"]) and !empty($param["check_nick"])){
			if($param["pwd"] == $param["pwd2"]){

				$data = array(
					'mb_id'=> $param["id"]
					,'mb_pwd'=> password_hash($param["pwd"], PASSWORD_BCRYPT, ['cost' => 12])
					,'mb_name'=> $param["name"]
					,'mb_nick'=> $param["nick"]
					,'mb_hp'=> $param["hp"]
					,'mb_email'=> $param["email"]
					,'agree_sms'=> $param["agreesms"]
					,'agree_email'=> $param["agreeemail"]
					,'startdate'=>''
					,'enddate'=>''
					,'memo'=>''
				);
				$data = $this->Common_db_model->insert_board(member_list, $data);
				if($data==true ){
					echo "success";
				}else{
					echo "잠시후 다시 이용해주세요.";
				}
			}else{
				echo "비밀번호가 일치하지 않습니다.";
			}
		}else{
			echo "잘못된 접근입니다.";
		}
		exit;
	}

	public function loginProc(){
		$id = $this->input->post('id', TRUE);
		$pw = $this->input->post('pwd', TRUE);

		$data = $this->Common_db_model->get_row("", member_list, array('mb_id' => $id) ,'','1','');
		if(isset($data['mb_id']) && password_verify($pw, $data["mb_pwd"])){
			$this->session->set_userdata(DB_PREFIX.'idx', $data['idx']);
			$this->session->set_userdata(DB_PREFIX.'id', $data['mb_id']);
			$this->session->set_userdata(DB_PREFIX.'name', $data['mb_name']);
			$this->session->set_userdata(DB_PREFIX.'hp', $data['mb_hp']);
			$this->session->set_userdata(DB_PREFIX.'email', $data['mb_email']);
			$this->session->set_userdata(DB_PREFIX.'level', $data['level']);
			$this->session->set_userdata(DB_PREFIX.'room_idx', $data['room_idx']);

			$this->Admin_model->member_login_log('로그인', $data['mb_id']);

			echo "success";
		} else {
			echo "일치하는 회원 정보가 없습니다.";
		}
	}
	// mypage - 회원정보수정
	public function memModProc(){
		$nick = $this->input->post('nick', TRUE);
		$hp = $this->input->post('hp', TRUE);
		$pw = $this->input->post('pwd', TRUE);
		$pw2 = $this->input->post('pwd2', TRUE);
		$email = $this->input->post('email', TRUE);
		$agreesms = $this->input->post('agreesms', TRUE);
		$agreeemail = $this->input->post('agreeemail', TRUE);

		if($pw == $pw2){
			$data = array(
				'agree_email' => $agreeemail,
				'agree_sms' => $agreesms,
				'mb_nick' => $nick,
				'mb_hp' => $hp,
				'mb_pwd' => password_hash($pw, PASSWORD_BCRYPT, ['cost' => 12]),
				'mb_email' => $email,
				'mod_dt' => date('Y-m-d H:i:s')
			);
			//$this->Common_db_model->setLogs('mypage','회원정보수정',$this->session->userdata(DB_PREFIX.'id'));
			$data = $this->Common_db_model->update_board(member_list, $data, "mb_id='".$this->session->userdata(DB_PREFIX.'id')."'");
			if($data==true ){
				echo "success";
			}else{
				echo "잠시후 다시 이용해주세요.";
			}
		}else{
			echo "비밀번호가 일치하지 않습니다.";
		}
	}
	public function memWithdraw(){
		$thisIdx = $this->session->userdata(DB_PREFIX.'idx');
		if($thisIdx){
			$this->db->select("*");
			$this->db->from(member_list);
			$this->db->where("idx=".$thisIdx);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$row->del_dt = date('Y-m-d H:i:s');
				$this->db->insert(member_list_withdraw,$row);
			}
			$this->Common_db_model->delete_board(member_list, "idx=".$thisIdx);
			$this->session->sess_destroy();
			echo "success";
		}else{
			echo "문제가 발생했습니다.잠시후 다시 이용해주세요.";
		}
	}
	public function sendHpConfirmNo(){
		$hp = $this->input->post('hp', TRUE);
		$mode = $this->input->post('mode', TRUE);

		if($mode=="join"){
			$data = $this->Common_db_model->get_row("", member_list, array('mb_hp' => $hp, 'mb_hp !='=>'010-3692-1269') ,'','1','');
			if($data){
				echo "이미 가입된 휴대폰번호입니다.";
				exit;
			}
		}elseif($mode=="mypage"){
			$memberInfo = getUserInfoByIdx($this->session->userdata(DB_PREFIX.'idx'));
			$data = $this->Common_db_model->get_row("", member_list, array('mb_hp' => $hp, 'mb_hp !='=>$memberInfo["mb_hp"]) ,'','1','');
			if($data){
				echo "이미 가입된 휴대폰번호입니다.";
				exit;
			}
		}else{
			echo "잘못된 접근입니다.";
			exit;
		}

		$rndNo = generateRandomNumber(4);
		$options = ['cost' => 12];
		$sendNo = password_hash($rndNo, PASSWORD_BCRYPT, $options);

		$settings = getSettings();
		$sms_result = send_sms("sms","","[".BASE_TITLE."]\n인증번호 : ".$rndNo,COM_NUMBER,$hp);
		$this->Common_db_model->setSmsLog("sms","","[".BASE_TITLE."]\n인증번호 : ".$rndNo,COM_NUMBER,$hp);

		$result = json_decode($sms_result);
		echo $result->loginRstMsg.":".$sendNo;

	}
	public function sendHpConfirmNoCheck(){
		$responseNo = $this->input->post('responseNo', TRUE);
		$requestNo = $this->input->post('requestNo', TRUE);
		$userHp = $this->input->post('userHp', TRUE);
		$mode = $this->input->post('mode', TRUE);

		if(password_verify($responseNo, $requestNo)){
			if($mode=="mypage"){

			}
			echo "success";
		}else{
			echo "인증번호가 맞지 않습니다. 정확한 인증번호를 입력해주세요.";
		}
	}

	public function findidpwProc(){
		$mode = $this->input->post('mode', TRUE);
		$name = $this->input->post('name', TRUE);
		$id = $this->input->post('id', TRUE);
		$hp = $this->input->post('hp', TRUE);

		if($mode=="id"){
			if(!empty($name) and !empty($hp)){
				$data = $this->Common_db_model->get_row("", member_list, array('mb_name' => $name,'mb_hp' => $hp) ,'','1','');
				if($data){
					echo $name."님의 아이디는 ".$data["mb_id"]." 입니다.";
				}else{
					echo "일치하는 회원 정보가 없습니다.";
				}
			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}elseif($mode=="pw"){
			if(!empty($name) and !empty($hp) and !empty($id)){
				$data = $this->Common_db_model->get_row("", member_list, array('mb_name' => $name,'mb_hp' => $hp,'mb_id' => $id) ,'','1','');
				if($data){
					$newPass = generateRandomString(5);
					$newPass2 = password_hash($newPass, PASSWORD_BCRYPT, ['cost' => 12]);
					$this->Common_db_model->update_board(member_list, array('mb_pwd' => $newPass2), "idx=".$data["idx"]);

					if(!empty($data["mb_hp"])){
						$sms_result = send_sms("sms","","[".BASE_TITLE."]\n임시 비빌번호는 : ".$newPass,COM_NUMBER,$hp);
						$this->Common_db_model->setSmsLog("sms","","[".BASE_TITLE."]\n임시비밀번호 : ".$newPass,COM_NUMBER,$hp);

						$result = json_decode($sms_result);
						echo $result->loginRstMsg.":".$newPass;

						//send_mail($data["mb_email"], '['.BASE_TITLE.']비밀번호 변경 알림입니다.', cnv_mailform($name." 님의 임시 비밀번호는 [ ". $newPass . " ] 입니다."));
						echo $name."님의 임시비밀번호가  ".$data["mb_hp"]."로 발송되었습니다.";
					}else{
						echo $name."님의 비밀번호는  ".$data["mb_hp"]."로 발송되었습니다.";
					}
				}else{
					echo "일치하는 회원 정보가 없습니다.";
				}
			}else{
				echo "유효하지 않은 접근입니다.";
			}
		}else{
			echo "유효하지 않은 접근입니다.";
		}
	}
	public function checkConfirmProc(){
		$mode = $this->input->post('mode', TRUE);
		$nick = $this->input->post('nick', TRUE);
		$id = $this->input->post('id', TRUE);
		if($mode=="id"){

			$idReserve = "admin,administrator, abstract, and, array, as, break, callable, case, catch, class, clone, const, continue, declare, default, die, do, echo, else, elseif, empty, enddeclare, endfor, endforeach, endif, endswitch, endwhile, eval, exit, extends, final, for, foreach, function, global, goto, if, implements, include, instanceof, insteadof, interface, isset, list, namespace, new, or, print, private, protected, public, require, return, static, switch, throw, trait, try, unset, use, var, while, xor, test";
			$idArr = array();

			$idArr = splitArr($idArr,$idReserve,",");
			if( strlen($id) < 4){
				echo "아이디는 영문자로 시작하는 4~12자 영문자 또는 숫자이어야 합니다.";
				exit;
			}
			if(!preg_match("/^[a-z]/i", $id)) {
				echo "아이디의 첫글자는 영문이어야 합니다.";
				exit;
			}
			foreach($idArr as $val){
				if(strpos($val,$id) !== false){
					echo "사용할수 없는 아이디입니다.";
					exit;
					break;
				}
			}

			$cnt = $this->Common_db_model->get_query_total(member_list, " mb_id='". $id ."' ");
			if($cnt==0){
				echo "success";
			}else{
				echo $id."는 사용중인 아이디입니다.";
			}
		}elseif($mode=="nick"){
			$sqlWhere = "";
			if($this->session->userdata(DB_PREFIX.'idx')){
				$sqlWhere = " and idx <> ".$this->session->userdata(DB_PREFIX.'idx');
			}
			$cnt = $this->Common_db_model->get_query_total(member_list, " mb_nick='". $nick ."' ".$sqlWhere);
			if($cnt==0){
				echo "success";
			}else{
				echo $nick."는 사용중인 닉네임입니다.";
			}
		}else{
			echo "유효하지 않은 접근입니다.";
		}
	}
	public function memberExcel(){
		$conn = mysqli_connect("localhost","premium_db","premium_db!@!","premium_db");
		$this->load->view('excel/excel_reader2.php');
		$this->load->view('excel/SpreadsheetReader.php');
		$import = $this->input->post('import', TRUE);

		if (isset($import)){
			$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/haansoftxlsx','application/haansoftxls'];
			if(in_array($_FILES["file"]["type"],$allowedFileType)){

				$config['upload_path']          = './upload/excel/';
				$config['allowed_types']        = 'xls|xlsx';
				$config['max_size']             = 102400;
				$config['encrypt_name']         = true;
				if(!is_dir($config['upload_path'])){
					mkdir($config['upload_path'], 0777);
				}
				$targetPath = $config['upload_path'].$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
				$Reader = new SpreadsheetReader($targetPath);
				$sheetCount = count($Reader->sheets());
				$succ_cnt = 0;
				$mod_cnt = 0;
				$err_cnt = 0;
				for($i=0;$i<$sheetCount;$i++){
					$Reader->ChangeSheet($i);
					foreach ($Reader as $k=>$Row){
						if($Row[0]!="닉네임" and !empty($Row[0])){
							$nick = "";
							if(isset($Row[0])) {
								$nick = mysqli_real_escape_string($conn,$Row[0]);
							}

							$phone = "";
							if(isset($Row[1])) {
								$phone = mysqli_real_escape_string($conn,$Row[1]);
							}
							$startdate = "";
							$startdate_timestamp = "";
							if(isset($Row[2])) {
								$startdate = mysqli_real_escape_string($conn,$Row[2]);
								$startdate = $startdate." 00:00:00";
								$startdate_timestamp = strtotime($startdate);
							}
							$enddate = "";
							$enddate_timestamp = "";
							if(isset($Row[3])) {
								$enddate = mysqli_real_escape_string($conn,$Row[3]);
								$enddate = $enddate." 00:00:00";
								$enddate_timestamp = strtotime($enddate);
							}
							$room_idx = "";
							if(isset($Row[4])) {
								$room_idx = mysqli_real_escape_string($conn,$Row[4]);
							}
							$room_list = $this->Common_db_model->get_row("", room_list, array(' idx ' => $room_idx) ,'idx desc','','');

							if(count($room_list)){
								if (!empty($nick) || !empty($phone) || !empty($startdate) || !empty($enddate) || !empty($room_idx)) {
									$data = array(
										'nick'=>$nick,
										'phone'=>$phone,
										'startdate'=>$startdate_timestamp,
										'enddate'=>$enddate_timestamp,
										'room_idx'=>$room_idx,
										'device'=>'web'
									);

									$total = $this->Common_db_model->get_query_total(member_list, " phone='". $phone ."' ");
									if($total==0){
										$data = $this->Common_db_model->insert_board(member_list, $data);
										if($data){
											$this->Common_db_model->setLogs('memberExcel','엑셀추가',$this->session->userdata('sess_id'));
											$succ_cnt++;
										}else{
											$err_cnt++;
										}
									}else{
										$data = $this->Common_db_model->update_board(member_list, $data, "phone = '".$phone."'");
										if($data==true ){
											$this->Common_db_model->setLogs('memberExcel','엑셀수정',$this->session->userdata('sess_id'));
											$mod_cnt++;
										}else{
											$err_cnt++;
										}
									}
								}
							}else{
								$this->Common_db_model->setLogs('memberExcel','방번호오류',$this->session->userdata('sess_id'));
								$err_cnt++;
							}
						}
					 }
				 }
				 error_move("모든 데이타가 반영되었습니다.추가(".$succ_cnt."), 수정(".$mod_cnt."), 에러(".$err_cnt.")","/".admmng."/members");
			}else{
				error_move("허용되지 않는 파일 타입니다.","/".admmng."/members");
			}
		}else{
			error_move("유효하지 않은 접근입니다.","/".admmng."/members");
		}

	}

    public function paidContentExcel(){
		$conn = mysqli_connect("localhost","premium_db","premium_db!@!","premium_db");
		$this->load->view('excel/excel_reader2.php');
		$this->load->view('excel/SpreadsheetReader.php');
		$import = $this->input->post('import', TRUE);

		if (isset($import)){
			$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/haansoftxlsx','application/haansoftxls'];
			if(in_array($_FILES["file"]["type"],$allowedFileType)){

				$config['upload_path']          = './upload/excel/';
				$config['allowed_types']        = 'xls|xlsx';
				$config['max_size']             = 102400;
				$config['encrypt_name']         = true;
				if(!is_dir($config['upload_path'])){
					mkdir($config['upload_path'], 0777);
				}
				$targetPath = $config['upload_path'].$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
				$Reader = new SpreadsheetReader($targetPath);
				$sheetCount = count($Reader->sheets());
				$succ_cnt = 0;
				$dup_cnt = 0;
				$err_cnt = 0;
				for($i=0;$i<$sheetCount;$i++){
					$Reader->ChangeSheet($i);
					foreach ($Reader as $k=>$Row){
						if($Row[0]!="아이디" and !empty($Row[0])){
							$mb_id = "";
							if(isset($Row[0])) {
								$mb_id = mysqli_real_escape_string($conn,$Row[0]);
							}

							$bd_idx = "";
							if(isset($Row[1])) {
								$bd_idx = mysqli_real_escape_string($conn,$Row[1]);
							}

                            //유저 정보
                            $mb_info = $room_list = $this->Common_db_model->get_row("", member_list, array("mb_id" => $mb_id) ,"idx desc","","");
                            //게시글 정보
                            $bd_info = $room_list = $this->Common_db_model->get_row("", board, array("idx" => $bd_idx , "category" => "payclass") ,"idx desc","","");

                            if(count($mb_info) < 1 || count($bd_info) < 1){
                                //사용자 정보 , 게시글 정보 오류
                                $err_cnt++;
                            }else{
                                $total = $this->Common_db_model->get_query_total(pay_contents_list,  array("mb_id" => $mb_id , "bd_idx" => $bd_idx));
                                if($total == 0){
                                    $data = array(
                                        'mb_idx' => $mb_info[0]["idx"],
                                        'mb_id' => $mb_id,
                                        'bd_idx' => $bd_idx,
                                        'reg_id' => $this->session->userdata('sess_id'),
                                    );
                                    $result = $this->Common_db_model->insert(pay_contents_list, $data);
                                    if($result){
                                        //유료 강의 권한 추가 로그
                                        $data["type"] = "insert";
                                        $this->Common_db_model->insert(pay_contents_log, $data);
                                        $succ_cnt++;
                                    }else{
                                        $err_cnt++;
                                    }
                                }else{
                                    //이미 존재하는 데이터
                                    $dup_cnt++;
                                }
                            }

						}
                    }
                }
                error_move("모든 데이타가 반영되었습니다.추가(".$succ_cnt."), 중복(".$dup_cnt."), 에러(".$err_cnt.")","/".admmng."/paycontentslist");
			}else{
				error_move("허용되지 않는 파일 타입니다.","/".admmng."/paycontentslist");
			}
		}else{
			error_move("유효하지 않은 접근입니다.","/".admmng."/paycontentslist");
		}

	}

	// 220322 구매내역게시판 권한삭제 기능 추가
	public function paycontentslistDelProc(){
		// $idx = $this->input->post('idx', TRUE);
		$cidx = $this->input->post('cidx', TRUE);

        // In Query 사용해서 일괄 삭제
        //파라매터를 배열로 받아오기
        //로그 삽입은 insert_batch 활용
		// if($idx){
		// 	$this->Common_db_model->delete_board(pay_contents_list, 'idx='.$idx);
		// 	// $this->Common_db_model->setLogs('pay_contents_list','삭제',$this->session->userdata('sess_id'));
		// 	echo 'success';
		// }else{
		// 	echo 'error';
		// }
		if(count($cidx) > 0)
		{
			for($i = 0 ; $i < count($cidx) ; $i++){
				if ( $cidx[$i] != "" ) {
					$pay_contents = $this->Common_db_model->get_row("", pay_contents_list, array("idx" => $cidx[$i]) ,"idx desc","","");
					$log_data = array(
						'mb_idx' => $pay_contents[0]["mb_idx"],
						'mb_id'  => $pay_contents[0]["mb_id"],
						'bd_idx' => $pay_contents[0]["bd_idx"],
						'type'   => 'delete',
						'reg_id' => $this->session->userdata('sess_id')
					);
					$this->Common_db_model->delete_board(pay_contents_list, 'idx='.$cidx[$i]);
					$this->Common_db_model->insert(pay_contents_log, $log_data);
				}
			}
			echo 'success';
		} else {
			echo 'error';
		}

		// if(count($cidx) > 0) {
		// 	echo 'success';
		// }

	}

	// 220325 회원관리 권한추가 기능
	function paycontents_authority_grant()
	{
		$mb_idx = $this->input->post('mb_idx', TRUE);
		$mb_id = $this->input->post('mb_id', TRUE);
		$bd_idx = $this->input->post('bd_idx', TRUE);
		$bd_info = $this->Common_db_model->get_row("", board, array("idx" => $bd_idx , "category" => "payclass") ,"idx desc","","");
		if(count($bd_info) < 1){
			echo "존재하지 않은 게시글 번호입니다. 다시 입력해주세요.";
			exit;
		}
		else {
			$total = $this->Common_db_model->get_query_total(pay_contents_list,  array("mb_id" => $mb_id ,"bd_idx" => $bd_idx));
			if($total == 0){
				$data = array(
					'mb_idx' => $mb_idx,
					'mb_id' => $mb_id,
					'bd_idx' => $bd_idx,
					'reg_id' => $this->session->userdata('sess_id'),
				);
				$result = $this->Common_db_model->insert(pay_contents_list, $data);
				if($result){
					$data["type"] = "insert";
					$this->Common_db_model->insert(pay_contents_log, $data);
					echo "success";
				}
			}else{
				echo "이미 권한이 부여된 게시글입니다.";
			}
		}
	}

	// 220325 회원관리 권한삭제 기능
	public function paycontents_authority_del()
	{
		$idx = $this->input->post('idx', TRUE);
		if($idx){
			$pay_contents = $this->Common_db_model->get_row("", pay_contents_list, array("idx" => $idx) ,"idx desc","","");
			$log_data = array(
				'mb_idx' => $pay_contents[0]["mb_idx"],
				'mb_id'  => $pay_contents[0]["mb_id"],
				'bd_idx' => $pay_contents[0]["bd_idx"],
				'type'   => 'delete',
				'reg_id' => $this->session->userdata('sess_id')
			);
			$this->Common_db_model->delete_board(pay_contents_list, 'idx='.$idx);
			$this->Common_db_model->insert(pay_contents_log, $log_data);
			// $this->Common_db_model->setLogs('pay_contents_list', $idx,$this->session->userdata('sess_id'));
			echo 'success';
		}else{
			echo 'error';
		}
	}
}
