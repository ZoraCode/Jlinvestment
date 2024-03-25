<?
exit;
	$phone = str_replace("-", "", $phone);		

	$result = "";
	$result_msg = "";
	
	//코드 유효시간 3분
	$timestamp_chk = time() - 180;

	$row = $this->Common_db_model->get_row("", "SMSReg_Log","phone=$phone", "id desc", 1, 0);
	
	if (count($row) == 0) {
		makeResultString("fail", "error_nodata");
		// 발송된 문자가 없습니다. 재발송후 시도해 주세요.
	} else {
	
		if ($row["code"] == $code) {
			
			
				
				// 사용자 추가 및 업데이트				
			 	$count = $this->Common_db_model->get_query_total(Member,"phone=$phone");
			 	
			 	
			 	if ($count > 0 ) { //update
			 		$User = array(
			 			'phone' => $phone,
						'lastlogtime' => time(),
						'loginkey' => $login_key
					);
					
					$rtn = $this->Common_db_model->insert_update(Member, $User,"phone=$phone");					
					if ($rtn > 0) {
						makeResultString("success", $login_key);
						//성공시 로그인키 전송
					} else {
						makeResultString("faile", "error_update");
					}	

			 	} 
			} else {
				
			}
			
		} else {
			
		}
	}	

?>