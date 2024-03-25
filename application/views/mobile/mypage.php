<style>
label {font-size: 32px;}
p{font-size: 28px; margin-top: 15px;}

.input_txt{box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 67px;font-size: 32px;}
.footer	p {
		font-size: 22px;
		line-height: 30px !important;
    letter-spacing: -1.5px;
    font-family: 'Noto Sans KR', sans-serif;
	}
</style>
		<div class="mypage_layer mt80">
			<div class="inner">
				<form action="" name="modFrm" id="modFrm" method="post">
					<input type="hidden" name="step" value="2">
					<input type="hidden" name="check_hp" id="check_hp">
					<input type="hidden" name="check_id" id="check_id">
					<input type="hidden" name="check_nick" id="check_nick">
					<input type="hidden" name="requestNo" id="requestNo">
					<div class="ml20 mb50">
						<label for="" class="pb20">이름</label>
						<input type="text" name="" class="input_txt w760px" value="<?=$mypage["mb_name"]?>" disabled>
					</div>
					<div class="ml20 mb50">
						<label for="" class="pb20">아이디</label>
						<input type="text" name="" class="input_txt w760px" value="<?=$mypage["mb_id"]?>" disabled>
					</div>
					<?if($mypage["room_idx"]>0){
						$startdate = $mypage["startdate"]=="0" ? "":date('Y-m-d', $mypage["startdate"]);
						$enddate = $mypage["enddate"]=="0" ? "":date('Y-m-d', $mypage["enddate"]);
						$pd_title = $mypage["room_idx"];
						$period = !empty($startdate) && !empty($enddate) ? $startdate." ~ ". $enddate : "";
						switch($pd_title){
							case 3   : $pd_title = "VIP서비스";break;
							case 1 : $pd_title = "VVIP서비스";break;
							case 2  : $pd_title = "VIP선물";break;
							default:break;
						}
					?>
					<div class="ml20 mb50">
						<label for="" class="pb20">이용상품</label>
						<input type="text" name="" class="input_txt w760px" value="<?=$pd_title?> (<?=$period?>)" disabled>
					</div>
					<?}?>
					<div class="ml20 mb50">
						<label for="nick" class="pb20">닉네임</label>
						<input type="text" class="input_txt w500px" name="nick" id="nick" placeholder="닉네임" value="<?=$mypage["mb_nick"]?>" data-valid="notnull" data-alert="닉네임" required>
						<button type="button" class="btn_comm2" id="btn_check_nick">중복확인</button>
					</div>
					<div class="ml20 mb50">
						<label for="nick" class="pb20">비밀번호</label>
						<input type="password" class="input_txt w760px" name="pwd" id="pwd" placeholder="비밀번호" data-valid="notnull" data-alert="비밀번호" >
						 <p class="text-muted">※ 비밀번호는 4자 이상으로 입력해주세요.</p>
					</div>
					<div class="ml20 mb50">
						<label for="nick" class="pb20">비밀번호 확인</label>
						<input type="password" class="input_txt w760px" name="pwd2" id="pwd2" placeholder="비밀번호확인" data-valid="notnull" data-alert="비밀번호확인" >
						 <p class="text-muted">※ 설정하신 비밀번호를 한번 더 입력해주세요.</p>
					</div>
					<div class="ml20 mb50">
						<label for="nick" class="pb20">이메일</label>
						<?
						$emailArr = explode("@",$mypage["mb_email"]);
						?>
						<input type="text" class="input_txt w250px" name="email1" id="email1" placeholder="" value="<?=$emailArr[0]?>"> @
						<input type="text" class="input_txt w500px" name="email2" id="email2" placeholder="" value="<?=$emailArr[1]?>">
						<div class="agree_layer mt50">
							<label name="mail_agree" class="pb35">메일수신동의</label>
							<input type="radio" name="mail_agree" id="mail_agree1" value="Y" <?if($mypage["agree_sms"]=="Y"){echo "checked";}?>><label for="mail_agree1" class="form-check-label">예</label>
							<input type="radio" name="mail_agree" id="mail_agree2" value="N" <?if($mypage["agree_sms"]=="N"){echo "checked";}?>><label for="mail_agree2" class="form-check-label">아니오</label>
						</div>
					</div>
					<div class="ml20 mb50">
						<label for="nick" class="pb20">전화번호</label>
						<?
						$hp1="";
						$hp2="";
						$hp3="";
						$hpArr = explode("-",$mypage["mb_hp"]);
						if(count($hpArr)==3){
							$hp1=$hpArr[0];
							$hp2=$hpArr[1];
							$hp3=$hpArr[2];
						}
						?>
						<input type="text" class="input_txt w250px" name="hp1" id="hp1" placeholder="" value="<?=$hp1?>" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
						<input type="text" class="input_txt w250px" name="hp2" id="hp2" placeholder="" value="<?=$hp2?>" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
						<input type="text" class="input_txt w250px" name="hp3" id="hp3" placeholder="" value="<?=$hp3?>" data-valid="notnull" data-alert="전화번호" required maxlength="4">
						<button type="button" class="btn_comm2 mt20" id="sendConfirm">인증번호 전송</button>
						<div class="telAuth mt10 hid">
							<input type="text" class="input_txt w500px" name="authNo" id="authNo" placeholder="" value="" >
							<button type="button" class="btn_comm mt20" id="checkNo">인증번호 확인</button>
						</div>
						<div class="agree_layer mt50">
							<label for="radio" class="pb35">SMS 동의</label>
							<input type="radio" name="tel_agree" id="tel_agree1" value="Y" <?if($mypage["agree_email"]=="Y"){echo "checked";}?>><label for="tel_agree1" class="form-check-label">예</label>
							<input type="radio" name="tel_agree" id="tel_agree2" value="N" <?if($mypage["agree_email"]=="N"){echo "checked";}?>><label for="tel_agree2" class="form-check-label">아니오</label>
						</div>
					</div>

					<div class="btn_layer text-center mb70 mt10">
						<button type="button" class="btn_comm" onclick="updateMemChk();">정보수정</button>
						<a href="/"><button type="button" class="btn_comm2">취소</button></a>
						<!-- <button type="button" class="btn_comm3  pull-right" onclick="withdraw();">회원탈퇴</button> -->
					</div>
				</form>
			</div>
		</div>

<script>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $nick = $("#nick").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $email1 = $("#email1").val();
	var $email2 = $("#email2").val();
	var $hp1 = $("#hp1").val();
	var $hp2 = $("#hp2").val();
	var $hp3 = $("#hp3").val();
	var $agreesms = $("input[name='tel_agree']:checked").val();
	var $agreeemail = $("input[name='mail_agree']:checked").val();

	var $check_hp = $("#check_hp").val();
	var $check_nick = $("#check_nick").val();

	if($nick != "<?=$mypage['mb_nick']?>" && $check_nick !="1"){
		alert("닉네임 중복확인을 해주세요.");
		return false;
	}
	if(!$email1){
		alert("이메일을 입력해주세요.");
		$("#email1").focus();
		return false;
	}
	if(!$email2){
		alert("이메일을 입력해주세요.");
		$("#email2").focus();
		return false;
	}
	var $email = $email1+"@"+$email2;
	var regExpEmail = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	if(!regExpEmail.test($email)){
		alert("이메일 주소를 형식에 맞게 입력해주세요.")
		$("#email").focus();
		return false;
	}

	if(!$hp1){
		alert("전화번호를 입력해주세요.");
		$("#hp1").focus();
		return false;
	}
	if(!$hp2){
		alert("전화번호를 입력해주세요.");
		$("#hp2").focus();
		return false;
	}
	if(!$hp3){
		alert("전화번호를 입력해주세요.");
		$("#hp3").focus();
		return false;
	}

	var regExpNo = /^[0-9]+$/;
	if(!regExpNo.test($hp1)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp1").focus();
		return false;
	}
	if(!regExpNo.test($hp2)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp2").focus();
		return false;
	}
	if(!regExpNo.test($hp3)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp3").focus();
		return false;
	}

	var $hp = $hp1+"-"+$hp2+"-"+$hp3;
	var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;
	if(!regExpHp.test($hp)){
		alert("전화번호를 정확히 입력해주세요.");
		return false;
	}
	if($hp != "<?=$mypage['mb_hp']?>" && $check_hp!="1"){
		alert("핸드폰번호를 인증해주세요.");
		return false;
	}

	if (web.formValidation(form,true)){
		if($pwd!=$pwd2){
			alert("비밀번호를 정확히 입력해주세요.")
			$("#pwd2").focus();
			return false;
		}else{
			data={pwd:$pwd,pwd2:$pwd2,hp:$hp,email:$email,agreesms:$agreesms,agreeemail:$agreeemail,nick:$nick}
			ajaxProcess("/proc/memModProc",data,"");
		}
	}
}
function withdraw(){
	if(confirm("정말로 탈퇴하시겠습니까?")){
		ajaxProcess("/proc/memWithdraw","","/");
	}
}
function ajaxProcess(url,data, redirect){
	var rst;
	$.ajax({
		url : url,
		dataType : "text",
		method: "POST",
		data : data,
		success : function(result) {
			if(result=="success"){
				alert("정상적으로 처리되었습니다.");
				if(redirect==""){
					location.href = location.href;
				}else{
					location.href = redirect;
				}
			}else{
				alert(result);
			}
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
	return rst;
}
$("#btn_check_nick").click(function(){
	var $nick = $("#nick").val();
	if(!$.trim($nick)){
		alert("닉네임을 입력해주세요.");
		$("#nick").focus();
		return false;
	}
	$.ajax({
		url : "/proc/checkConfirmProc",
		dataType : "text",
		method: "POST",
		data : {'mode':'nick',nick:$nick},
		success : function(result) {
			if(result=="success"){
				alert("사용가능한 닉네임입니다.");
				$("#check_nick").val("1");
			}else{
				alert(result);
			}
			return false;
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})

$("#sendConfirm").click(function(){
	var $hp1 = $("#hp1").val();
	var $hp2 = $("#hp2").val();
	var $hp3 = $("#hp3").val();
	var $hp = $hp1+"-"+$hp2+"-"+$hp3;
	if(!$hp1){
		alert("전화번호를 입력해주세요.");
		$("#hp1").focus();
		return false;
	}
	if(!$hp2){
		alert("전화번호를 입력해주세요.");
		$("#hp2").focus();
		return false;
	}
	if(!$hp3){
		alert("전화번호를 입력해주세요.");
		$("#hp3").focus();
		return false;
	}

	var regExpNo = /^[0-9]+$/;
	if(!regExpNo.test($hp1)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp1").focus();
		return false;
	}
	if(!regExpNo.test($hp2)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp2").focus();
		return false;
	}
	if(!regExpNo.test($hp3)){
		alert("전화번호는 숫자만 입력해주세요.");
		$("#hp3").focus();
		return false;
	}

	var $hp = $hp1+"-"+$hp2+"-"+$hp3;
	var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;
	if(!regExpHp.test($hp)){
		alert("전화번호를 정확히 입력해주세요.");
		return false;
	}
	if($hp == "<?=$mypage['mb_hp']?>"){
		alert("전화번호가 변경되지 않았습니다.");
		return false;
	}
	$.ajax({
		url : "/proc/sendHpConfirmNo",
		dataType : "text",
		method: "POST",
		data : {hp:$hp,'mode':'mypage'},
		success : function(result) {
			if(result.indexOf(":")!= -1){
				var rstArr = result.split(":");
				if(rstArr[0]=="success"){
					alert("인증번호가 발송되었습니다.\n인증번호를 입력해주세요.");
					$("#modFrm").find("#requestNo").val(rstArr[1])
					$(".telAuth").show();
				}
			}else{
				alert(result);
			}
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})
$("#checkNo").click(function(){
	var $responseNo = $("#modFrm").find("#authNo").val();
	var $requestNo = $("#modFrm").find("#requestNo").val();
	$.ajax({
		url : "/proc/sendHpConfirmNoCheck",
		dataType : "text",
		method: "POST",
		data : {requestNo:$requestNo,responseNo:$responseNo,'mode':'mypage'},
		success : function(result) {
			if(result=="success"){
				alert("정상적으로 인증되었습니다.");
				$("#check_hp").val("1");
			}else{
				alert(result);
			}
			return false;
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})
</script>
