<?
exit;
	$phone = str_replace("-", "", $phone);	
	$timestamp = time();
	$rand_num = "" . sprintf("%04d", rand(0000,9999));
	
	$result = "";
	$result_msg = "";
	
	$timestamp_chk = $timestamp - 10;

	if ($phone != "") {
		$count = $this->Common_db_model->get_query_total(SMSReg_Log,"phone=$phone And `time` > $timestamp_chk");
		if ($count == 0) {		
		
			$Data = array(
			'phone' => $phone,
			'code' => $rand_num,
			'time' => $timestamp
			 );
			$rtn = $this->Common_db_model->insert(SMSReg_Log, $Data);		
			if ($rtn > 0) {
					$msg = "[". COM_NAME . "] 본인확인 인증번호[" . $rand_num . "]를 입력해 주세요.";
					
					// 대표번호 샌드몬에 인증되어 있어야함 (슈퍼관리자에서 설정 가능하도록)
					$sendresult = $this->Sendmon_model->sendSMS($phone, $msg);
					$jsonarr = json_decode($sendresult, true);					
					//print_r($jsonarr);								
					if ( $jsonarr["result"][0] == "success" ) {	
						makeResultString("success", $jsonarr["result"][0]);	
					} else {
						makeResultString("fail", "error_".$jsonarr["result"][0]);
						//샌드몬 내에서 에러 코드 가져와서 보여주기
					}
			} else {
				makeResultString("fail", "error_insert");
				// 디비 추가 오류
			}

		} else {
			makeResultString("fail", "error_60sec");
			
		}
	} else {
			makeResultString("fail", "error_phone");
			// 전화번호가 없습니다.
	}
?>
