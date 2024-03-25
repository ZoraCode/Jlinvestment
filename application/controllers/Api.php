<?
class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function privacy() {
		$data["privacy"] = $this->Common_db_model->get_row("", siteinfo, "1=1",'idx desc','','');
		$this->load->view('api/privacy', $data);
	}
	
	public function terms() {
	//msg_siteinfo
		$data["privacy"] = $this->Common_db_model->get_row("", siteinfo, "1=1",'idx desc','','');
		$this->load->view('api/terms', $data);
	}
	
	
	public function updateCheck() {  // 업데이트 체크
		$version = $this->input->post('v', TRUE);	
		$type = $this->input->post('t', TRUE);	// 0: 관리자 1: 안드로이드 2: 아이폰
		//makeResultString("success", "NewUpdate");
		makeResultString("success", "End");		
	}
	
	public function smsReg(){  // sms 본인확인 인증번호 발송	

			$phone = $this->input->post('phone', TRUE);
			$phone = str_replace("-", "", $phone);				
			$timestamp_chk = time() - 1;
			
			$Data = array(
			'phone' => $phone,
			'code' => "" . sprintf("%04d", rand(0000,9999)),
			'time' => time()
			 );
			 
			 if ( array_search("",$Data) != "")  // 공백값 여부 확인
				makeResultString("fail", "error_".array_search("",$Data));
	
	
			$count = $this->Common_db_model->get_query_total(sms_join_log,"`phone`='$phone' And `time` > $timestamp_chk");	
			
			if ($count == 0) {	
			 	$rtn = $this->Common_db_model->insert(sms_join_log, $Data);		
			 	if ($rtn > 0) {
					$msg = "[". COM_NAME . "] 본인확인 인증번호[" . $Data["code"] . "]를 입력해 주세요.";					
					// 대표번호 샌드몬에 인증되어 있어야함 (슈퍼관리자에서 설정 가능하도록)
					$sendresult = $this->Sendmon_model->sendSMS($phone, $msg);
					$jsonarr = json_decode($sendresult, true);					
					//echo $sendresult;								
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
				//1분후에 재발송가능 합니다.
			}			
	}
	
	public function smsAuth() { // sms 본인확인 인증번호 확인
	
			$phone = $this->input->post('phone', TRUE);	
			$phone = str_replace("-", "", $phone);		
			$code = $this->input->post('code', TRUE);
			
			//코드 유효시간 3분
			$timestamp_chk = time() - 180;
					 
			$row = $this->Common_db_model->get_row("", sms_join_log, array("phone"=>$phone), "idx desc", 1, 0);
			 
			if (count($row) == 0) {
				makeResultString("fail", "error_nodata");
				// 발송된 문자가 없습니다. 재발송후 시도해 주세요.
			} else {
					if ($row["code"] != $code) {
						makeResultString("faile", "error_code");
						//인증번호 불일치
					} else {
						
						if ($row["time"] < $timestamp_chk) {
							makeResultString("faile", "error_time");
							// 인증번호의 유효시간이 초과되었습니다. 재발송후 시도해 주세요.
						} else {
							// 사용자 추가 및 업데이트	
							$login_key = md5("YesBit" . Time() . $phone);			
			 				$User = array(
			 				'phone' => $phone,
							'lastlogtime' => time(),
							'loginkey' => $login_key
							);
							
							if ( array_search("", $User) != "")  // 공백값 여부 확인
								makeResultString("fail", "error_".array_search("",$Data));
					
							$rtn = $this->Common_db_model->insert_update(member_list, $User, array("phone"=>$phone));					
							if ($rtn > 0) {
								makeResultString("success", $login_key);
								//성공시 로그인키 전송
							} else {
								makeResultString("faile", "error_insert");
							}	
						}						
					}
			 }			 
	}
	

	
	public function updateProfile() { // 닉네임 및 사진 등록 하기 
			$key = $this->input->post('key', TRUE);	
			$nick = $this->input->post('nick', TRUE);	
			$default = $this->input->post('default', TRUE);	
			$Data["loginkey"] = $key;			
			$Data["nick"] = $nick;

			//error_notuse  사용할수 없는 닉네임입니다.
			if ( array_search("",$Data) != "")  // 공백값 여부 확인
				makeResultString("fail", "error_".array_search("",$Data));

			if ($key == "") {
				makeResultString("fail", "error_auth");
				// 인증이 만료되었습니다. 종료후 다시 인증해 주세요.
				exit;
			}
			
			$row = $this->Common_db_model->get_row("", member_list, array("loginkey"=>$key), "idx desc", 1, 0);
			if (count($row) == 0) {
					makeResultString("fail", "error_auth");
					// 인증이 만료되었습니다. 종료후 다시 인증해 주세요.
			}			
		/*
			 <form action="/api/updateProfile/?key=<?=$key?>&nick=<?=$nick?>" method="post" enctype="multipart/form-data">
            	<div>
                <label>Choose image File</label> <input type="file" name="imagefile" id="imagefile" accept=".png">
                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>        
            	</div>
       		 </form>
		*/
				$config['upload_path']          = './upload/profile/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 4096;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['overwrite']           = true;
                //$config['encrypt_name'] = TRUE;
				$config['file_name'] = md5(time(). $nick) . ".png";
				
                $this->load->library('upload', $config);
                //$this->upload->initialize($config);
                
                if ( $this->upload->do_upload("imagefile") ) {
                	$Data["image"] = $this->upload->data()["file_name"];	
                } else {
                	if ($default == 1) {
                		$Data["image"] = "";
                	}
                }
                
                $rtn = $this->Common_db_model->update(member_list, $Data, array("loginkey"=>$key));
                
                if ($rtn > 0) {
					makeResultString("success", "success");
				} else {
					makeResultString("fail", "error_update");
				}
				
	}
	
	
	public function slidebannerlist() {
				$row = $this->Common_db_model->get_row("", banner, array("is_use"=>"Y"), "idx desc", "", "");
				
				if ( 0 < count($row) ) {
				
					echo "{\"appSlide\":[";
					$nc = 1;
					
					foreach($row as $var) {
						
						echo "{\"idx\": \"" . $var["idx"] . "\", \"link\": \"" . $var["link"] . "\", \"image\": \"" . $var["img"] . "\", \"title\": \"" . $var["title"] . "\"}";
						if ($nc != count($row) ) {
							echo ", ";
						}
						$nc +=1;
					}
					
					echo "]}";
				} else {
					echo "nodata";
				}
	}
	
	// 로그인키 인증
	private function authRun($key) {	

			if ($key == "") {
				makeResultString("fail", "error_auth");
				return null;
			}
			//$row = $this->Common_db_model->get_row("", member_list," loginkey='$key' ", "idx desc", 1, 0);
			//0aa4051c41a3bcdb015e2ce4b8c3a031
			$row = $this->Common_db_model->get_row("", member_list, array("loginkey"=>$key), "idx desc", 1, 0);
			if (count($row) == 0) {
					makeResultString("fail", "error_auth");
					return null;
			}
			return $row;
	}


	public function registerDevice() { // 기기 및 푸시키 등록하기
			//푸시키 연결 하기 
			$key = $this->input->post('key', TRUE);	
			$device = $this->input->post('device', TRUE);	
			$pushos = $this->input->post('pushos', TRUE);
			$pushkey = $this->input->post('pushkey', TRUE);	

			if ($this->authRun($key) == null) {
				exit;
			}

			$Data = array(
						'device' => $device,
						'pushos' => $pushos,
						'pushkey' => $pushkey
			);
						
			if ( array_search("",$Data) != "")  // 공백값 여부 확인
				makeResultString("fail", "error_".array_search("",$Data));
											
			$rtn = $this->Common_db_model->update(member_list, $Data, array("loginkey"=>$key));		
			
			if ($rtn > 0) {
				makeResultString("success", "success");
			} else {
				makeResultString("fail", "error_update");
			}
	}
	
	public function auth() {
	
			$key = $this->input->post('key', TRUE);	
			
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}
			$idx = $row["idx"];
			$room_idx = $row["room_idx"];
			$room_open_idx = $row["room_open_idx"];
			$phone = $row["phone"];
			$nick = $row["nick"];
			$image = $row["image"];
			$startdate = $row["startdate"];
			$enddate = $row["enddate"];
			
			echo "{ \"result\": \"success\",\"result_msg\": \"success\", ";
			echo "\"user\": {\"idx\":" . $idx . ", \"room_idx\":" . $room_idx .", \"room_open_idx\":". $room_open_idx . ", \"phone\": \"" . $phone . "\""; 
			echo ", \"nick\":\"" . $nick . "\", \"image\":\"" . $image . "\", \"startdate\":". $startdate . ", \"enddate\":" . $enddate . "}";
			echo ", \"rooms\":[";
			
			$row = $this->Common_db_model->get_row("", room_list,"is_use='Y'", "idx asc", "", "");
			if ( 0 < count($row) ) {
					$nc = 1;
					foreach($row as $var) {
						
						echo "{\"idx\":" . $var["idx"] . ", \"type\":" . $var["type"] . ", \"name\": \"" . $var["name"] . "\", \"ment\": \"" . $var["ment"] . "\", \"image\": \"" . $var["image"] . "\", \"nowuser\":" . $var["nowuser"] . ", \"maxuser\":" . $var["maxuser"] . ", \"is_use_userlist\": \"" . $var["is_use_userlist"] . "\"}";
						if ($nc != count($row) ) {
							echo ", ";
						}
						$nc +=1;
					}
			}
			
			echo "]";			
			echo "}";
	}
	
		
	public function sendMessage() {
	
			$key = $this->input->post('key', TRUE);	
			$message = $this->input->post('msg', TRUE);	
			
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}			
			if ($message == "") {
				makeResultString("fail", "error_message");
				exit;
			}
						
			$idx = $row["idx"];			
			$phone = $row["phone"];
			$nick = $row["nick"];
			$image = $row["image"];			
			$is_danger = $row["is_danger"];
			
			if (  $row["room_idx"] != -1 ||  $row["room_open_idx"] != -1 ) { //  방에 들어간 경우에만 진행 			
				if ($row["room_idx"] == -1 ) {
					$room_idx = $row["room_open_idx"];
				} else {
					$room_idx = $row["room_idx"];
				}
				
				$Data = array(
					'member_idx' => $idx,					
					'type' => 10,
					'phone' => $phone,				
					'nick' => $nick ,
					'image' => $image,
					'message' => $message,
					'is_danger' => $is_danger 
				 );
				
				$rtn = $this->Common_db_model->insert(chat_log . $room_idx, $Data);		

					if ($rtn > 0) {
						makeResultString("success", "success");
								//성공시 로그인키 전송
					} else {
						makeResultString("faile", "error_insert");
					}	
					
			} else {
				makeResultString("fail", "error_room");
			}
	
	}
	public function getMessage() {
	
		$key = $this->input->post('key', TRUE);	
		$day = $this->input->post('day', TRUE);	
		$web_idx = $this->input->post('idx', TRUE);	
		
		if ($day == "") {
			$day = date("Y-m-d");
		}
	
		if ($web_idx == "") {
			$web_idx = 0;
		}
		
		if ($key == "") {
				makeResultString("fail", "error_key");
				exit;
		}
		
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}			
	
			$idx = $row["idx"];			
			$phone = $row["phone"];
			$nick = $row["nick"];
			$image = $row["image"];			
			$is_danger = $row["is_danger"];
			
			if (  $row["room_idx"] != -1 ||  $row["room_open_idx"] != -1 ) { //  방에 들어간 경우에만 진행 		
				
				if ($row["room_idx"] == -1 ) {
					$room_idx = $row["room_open_idx"];
				} else {
					$room_idx = $row["room_idx"];
				}
				$nc = 1;
				
				$server_chat=0; // 유저간 채팅 금지 
				
				$chatjson = "";
				$hidejson = "";
				$row = $this->Common_db_model->get_row("", chat_log . $room_idx, "idx>$web_idx and date(reg_dt) = STR_TO_DATE('".$day."','%Y-%m-%d')", "idx asc", "500", "");
				
				if ( 0 < count($row) ) {

					foreach($row as $var) {
					
						if ($var["member_idx"] == $idx) { //내 대화는 모두 보인다.
						
							if ($chatjson != "" ) { $chatjson .=  ", "; }
						    $chatjson .= "{\"idx\":" . $var["idx"] . ", \"member_idx\":" . $var["member_idx"] . ", \"type\": " . $var["type"] . ", \"room_idx\": " . $room_idx . ", \"nick\": \""  . $var["nick"] . "\", \"image\": \""  . $var["image"] . "\", \"message\": \"" . $var["message"] . "\", \"time\": \"" . $var["reg_dt"] . "\"}";

						
						} else {
							if ( $var["is_hide"] ==  0 ) { // 관리자가 숨겼는지 여부
							
								if ($server_chat == 1 )  { //유저간 채팅 금지
								
									if ($var["type"] != 10) { // 유저채팅 제외하고 보임
										if ($chatjson != "" ) { $chatjson .=  ", "; }
						   				 	$chatjson .= "{\"idx\":" . $var["idx"] . ", \"member_idx\":" . $var["member_idx"] . ", \"type\": " . $var["type"] . ", \"room_idx\": " . $room_idx . ", \"nick\": \""  . $var["nick"] . "\", \"image\": \""  . $var["image"] . "\", \"message\": \"" . $var["message"] . "\", \"time\": \"" . $var["reg_dt"] . "\"}";
										} else {
											if ($hidejson != "" ) { $hidejson.=  ", "; }
											$hidejson .= "{\"idx\":" . $var["idx"] . "}";
									}
								
								} else { // 유저간 채팅 금지가 아닐 경우

										if ($var["is_danger"] ==0 )  {  // 위험회원 아닐경우 보임
											if ($chatjson != "" ) { $chatjson .=  ", "; }
						   					 $chatjson .= "{\"idx\":" . $var["idx"] . ", \"member_idx\":" . $var["member_idx"] . ", \"type\": " . $var["type"] . ", \"room_idx\": " . $room_idx . ", \"nick\": \""  . $var["nick"] . "\", \"image\": \""  . $var["image"] . "\", \"message\": \"" . $var["message"] . "\", \"time\": \"" . $var["reg_dt"] . "\"}";									
										} else {  //위험회원일 경우 숨김
											if ($hidejson != "" ) { $hidejson.=  ", "; }
											$hidejson .= "{\"idx\":" . $var["idx"] . "}";
										}
								}
							} else {
								// 숨김일 경우 지움
								if ($hidejson != "" ) { $hidejson.=  ", "; }
									$hidejson .= "{\"idx\":" . $var["idx"] . "}";
									
							}
						}	
					}					
				}	
				echo "{ \"result\": \"success\",\"result_msg\": \"success\", ";
					
				echo "\"message\":[";
				echo $chatjson . "], \"delete\":[";
				echo $hidejson . "]}";			
			}
	}
	
	private function getBoard($idx , $where) {
	
	
			$boardejson = "";	
	
				$row = $this->Common_db_model->get_row("", board, $where, "idx desc", "15", "");				
				if ( 0 < count($row) ) {
					foreach($row as $var) {
					if ($boardejson != "" ) { $boardejson.=  ", "; }
						 $boardejson .= "{\"idx\":" . $var["idx"] . ", \"subject\":\"" . $var["subject"] . "\", \"writer_name\":\"" . $var["writer_name"] . "\", \"reg_ymd\":\"" . $var["reg_ymd"] . "\"}";	 
					}
				}				
			echo "{ \"result\": \"success\",\"result_msg\": \"success\", ";
			echo "\"message\":[";
			echo $boardejson . "]}";	
			
	}
	
	public function getNotice() {
	
			$key = $this->input->post('key', TRUE);	
			$idx = $this->input->post('idx', TRUE);	
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}		
	
			$noticejson = "";
			
			$where = " category='notice' ";
			
			if ($idx != 0) {
				$where = $where . " and idx < ". $idx ." ";
			}
			
			$this->getBoard($idx, $where);
	}
	
	
	public function getInvest() {
			$key = $this->input->post('key', TRUE);	
			$idx = $this->input->post('idx', TRUE);	
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}		
	
					
			$where = " category='invest' ";
			
			if ($idx != 0) {
				$where = $where . " and idx < ". $idx ." ";
			}
			
			$this->getBoard($idx, $where);
	}
	
	public function boardView() {
	//msg_siteinfo
			$key = $this->input->get('key', TRUE);	
			$idx = $this->input->get('idx', TRUE);	
			$row = $this->authRun($key);
			if ( $row== null) {
				exit;
			}	
			
		$data["board"] = $this->Common_db_model->get_row("", board, array("idx"=>$idx), "idx desc", "", "");	
		$this->load->view('api/boardview', $data);
	}

	public function getDisplay() {
	
			$key = $this->input->post('key', TRUE);	
			$roomidx = $this->input->post('roomidx', TRUE);	
			
			if ($roomidx == "") {
				makeResultString("fail", "error_roomidx");
				exit;
			}
			$user = $this->authRun($key);
			if ( $user== null) {
				exit;
			}	
			
			$nowstockjson = "";
			$oldstockjson = "";
				
			$row = $this->Common_db_model->get_row("", display_main," roomidx=$roomidx", "newtime asc", "", "");	
			if ( 0 < count($row) ) {

					foreach($row as $var) {
					
							if ( $var["status"] == 0) {
								if ($nowstockjson != "" ) { $nowstockjson .=  ", "; }
								$stock = $this->Common_db_model->get_row("", display_stock, " code='" . $var["code"] . "' ", "idx asc", "1", "0");									
								$nprice = $stock[0]["price"];
						    	$nowstockjson .= "{\"idx\":" . $var["idx"] . ", \"roomidx\":" . $var["roomidx"] . ", \"iskrx\": " . $var["iskrx"] . ", \"name\": \"" . $var["name"] . "\", \"code\": \""  . $var["code"] . "\", \"nprice\": "  . $nprice . ", \"mprice\": " . $var["mprice"] . ", \"status\": " . $var["status"] . "}";
							} else {
								if ($oldstockjson != "" ) { $oldstockjson .=  ", "; }
						    	$oldstockjson .= "{\"idx\":" . $var["idx"] . ", \"roomidx\":" . $var["roomidx"] . ", \"iskrx\": " . $var["iskrx"] . ", \"name\": \"" . $var["name"] . "\", \"code\": \""  . $var["code"] . "\", \"nprice\": "  . $var["nprice"] . ", \"mprice\": " . $var["mprice"] . ", \"status\": " . $var["status"] . "}";
							}							
					}
			}
			echo "{ \"result\": \"success\",\"result_msg\": \"success\", ";
					
				echo "\"nowstock\":[";
				echo $nowstockjson . "], \"oldstock\":[";
				echo $oldstockjson . "]}";	
	
	}
	
	public function getDisplayDetail() {
	
			$key = $this->input->post('key', TRUE);	
			$idx = $this->input->post('idx', TRUE);	
			
			if ($idx == "") {
				makeResultString("fail", "error_idx");
				exit;
			}
			$user = $this->authRun($key);
			if ( $user== null) {
				exit;
			}	
			
			$total_mpoint = 0;
			$oldstockjson = "";
			$row = $this->Common_db_model->get_row("", display_sub," tidx=$idx ", "time asc", "", "");	

				if ( 0 < count($row) ) {
					foreach($row as $var) {
						if ($oldstockjson != "" ) { $oldstockjson .=  ", "; }
						
						$time = $var["time"];
						if ($var["type"] == 1) {
	   		    			$total_mpoint += $var["point"];
	   		    		}
	   		    		$time = date("y.m.d", strtotime( $time ) );
					  	$oldstockjson .= "{\"idx\":" . $var["idx"] . ", \"type\":" . $var["type"] . ", \"price\": " . $var["price"] . ", \"point\": " . $var["point"] . ", \"time\": \""  . $time . "\" }";
					}
				}
				
				$data = $this->Common_db_model->get_row("", display_main," idx=$idx ", "idx asc", "", "");	
				
				if ( 0 < count($data) ) {
					$oidx = $data[0]["idx"];
	   				$roomidx = $data[0]["roomidx"];
	   				$dName = $data[0]["name"];
	   				$dCode = $data[0]["code"];
	   				$nprice = $data[0]["nprice"];
	   				$tprice = $data[0]["tprice"];
	   				$sprice = $data[0]["sprice"];
	   				$mprice = $data[0]["mprice"];
	   				$dState = $data[0]["status"];
	   					   				
	   				// 거래중일경우 실시간 시세 가져오기   
	   				if ($dCode != "" && $dState== 0) {
	   					$stock = $this->Common_db_model->get_row("", display_stock, " code='" . $dCode  . "' ", "idx asc", "1", "0");									
						$nprice = $stock[0]["price"];	   		   		
	   		 		}
	   		 		
	   		 		// 수익률
	   		 		$dPer = "0.00";	   		 		
	   		 		if ($nprice != 0 && $mprice != 0) {
	   		 			$dPer = ($nprice - $mprice) / $mprice * 100;
	   		 			$dPer = number_format($dPer,2);
	   		 		}
	   		 		
	   		 		// 보유일
	   		 		if ( $dState == 0 ) {
	   		 			$bodata = $this->Common_db_model->get_row("", display_sub," tidx=$idx and type=1 ", "time asc", "", "");
	   		 			if ( 0 < count($bodata) ) {
	   		 				$time = $bodata[0]["time"]; 
	   		 				$stime = date("Y-m-d", strtotime( $time ) );	
	   		 				$etime = "";  		    	  		    	  		    
	  		    			$start = new DateTime($stime);
							$end = new DateTime(date('Y-m-d'));
							$day = round(($end->format('U') - $start->format('U')) / (60*60*24));
	   		 			} else {
	   		 				$day = 0;
	   		 				$stime = "";
	   		 				$etime = "";  
	   		 			}
	   		 		} else {
	   		 			$sdata = $this->Common_db_model->get_row("", display_sub," tidx=$idx and type=1 ", "time asc", "", "");
	   		 			$edata = $this->Common_db_model->get_row("", display_sub," tidx=$idx and type=2 ", "time desc", "", "");
	   		 			
	   		 			if ( 0 < count($sdata) && 0 < count($edata) ) {
	   		 				$stime = $sdata[0]["time"];
	   		 				$etime = $edata[0]["time"]; 
	   		 				$stime = date("Y-m-d", strtotime( $stime ) );	 
	  		   	    		$etime = date("Y-m-d", strtotime( $etime ) );	 		    	  		    	  		    
	  		    			$start = new DateTime($stime);
							$end = new DateTime($etime);
							$day = round(($end->format('U') - $start->format('U')) / (60*60*24));
	   		 			} else {
	   		 				$day = 0;
	   		 				$stime = "";
	   		 				$etime = "";  
	   		 			}
	   		 		
	   		 		}
	   		 		$toprice = 50000000 * ($total_mpoint / 100);				
					$stockcount = round($toprice / $mprice);
					$toprice =  $mprice * $stockcount;				
					$suprice = round($toprice * ($dPer / 100));			
				}
				
				echo "{ \"result\": \"success\",\"result_msg\": \"success\", ";
				echo  "{\"idx\":" . $oidx . ", \"tidx\":" . $idx . ", \"name\": \"" . $dName . "\" , ";
				echo  "\"nprice\":" . $nprice . ", \"mprice\":" . $mprice . ", \"sprice\":" . $sprice . ", \"tprice\":" . $tprice . ", ";
				echo  "\"suik\": \"" . $dPer . "\", \"day\":" . $day . ", \"stime\": \"" . $stime . "\", \"etime\":\"" . $etime . "\", ";
				echo  "\"stockcount\": " . $stockcount . ", \"toprice\":" . $toprice . ", \"suprice\": \"" . $suprice . "\", \"status\":\"" . $dState . "\", ";
				echo " \"memelist\":[" . $oldstockjson . "]}";	
			
	}
	
	
	public function joinRoom() {
			
			$key = $this->input->post('key', TRUE);	
			$roomidx = $this->input->post('roomidx', TRUE);	
			
			if ($roomidx == "") {
				makeResultString("fail", "error_roomidx");
				exit;
			}
			$user = $this->authRun($key);
			if ( $user== null) {
				exit;
			}		

			$row = $this->Common_db_model->get_row("", room_list," is_use='Y' and idx=$roomidx ", "idx asc", "1", "0");	

			if ( 0 < count($row) ) {
				
							$maxuser = $row[0]["maxuser"];
							$nowuser = $row[0]["nowuser"];
							$name = $row[0]["name"];
							$welcome = $row[0]["welcome"];
							$topnoti = $row[0]["topnoti"];
							
							$is_use_userlist = $row[0]["is_use_userlist"];
							$is_use_display = $row[0]["is_use_display"];
							
						if ($row[0]["type"] == 1) { // 공개방

							if ($nowuser >= $maxuser) {
								makeResultString("fail", "error_maxuser"); // 이미 방이 가득 찼습니다.
								exit;
							} else {
								// 유저 공개방 업데이트 
								$Data["room_open_idx"] = $roomidx;
								$rtn = $this->Common_db_model->update(member_list, $Data, array("loginkey"=>$key));					
								if ($rtn > 0) {
									echo "{ \"result\": \"success\",\"result_msg\": \"success\", \"name\": \"" . $name . "\", \"welcome\": \"" . $welcome .  "\", \"topnoti\": \"" . $topnoti . "\", \"userlist\": \"" . $is_use_userlist . "\", \"display\": \"" . $is_use_display . "\" }";			
								} else {
									makeResultString("faile", "error_update");
								}	
							}
						} else { // 체험 vip 
								
								if ( $user["room_idx"] == $roomidx ) {
									
									if ( time() >  $user["enddate"] ) {// 기간 초과시 접속 불가
									
										// echo time() .  " / " .
										$Data["room_idx"] = -1;
										$rtn = $this->Common_db_model->update(member_list, $Data, array("loginkey"=>$key));	
										if ($rtn > 0) {
											makeResultString("faile", "error_enddate");
										} else {
											makeResultString("faile", "error_update");
										} 
										
									} else {
									
										$Data["room_open_idx"] = -1;  // 공개방 접속기능 초기화 
										$rtn = $this->Common_db_model->update(member_list, $Data, array("loginkey"=>$key));	
										
										if ($rtn > 0) {
											echo "{ \"result\": \"success\",\"result_msg\": \"success\", \"name\": \"" . $name . "\", \"welcome\": \"" . $welcome .  "\", \"topnoti\": \"" . $topnoti . "\", \"userlist\": \"" . $is_use_userlist . "\", \"display\": \"" . $is_use_display . "\" }";													
										} else {										
											makeResultString("faile", "error_update");										
										}
										
									}
									
								} else {
									makeResultString("faile", "error_roomauth");
								}
						}
			} else {
				makeResultString("fail", "error_roomidx");
			}
	
	}
	
	public function exitRoom() {
	
	}

}

?>