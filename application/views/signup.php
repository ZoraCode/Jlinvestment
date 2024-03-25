<style>
.join_layer .txt_pp{width: 100%;padding: 10px;box-sizing: border-box;max-height: 240px;overflow: auto;line-height: 22px;border: 1px solid #ccc;margin-top:5px;}
.join_layer h1.tit1{font-size: 25px;font-weight: bold;letter-spacing: -2px;margin-bottom: 10px;}
.join_layer p.tit2{font-size: 17px;letter-spacing: -2px;margin-bottom: 10px;}
.join_layer #agree,
.join_layer #agree3{width: 20px;height: 20px;}

.tbl_board{margin-bottom: 20px;}
.input_txt{width: 100%;box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 43px;}
.tbl_view th{text-align: center;padding-left: 0 !important;}
.form-check-label{display: inline-block;margin-left: 10px;margin-right: 15px;}
input[type='radio']{width: 20px;height: 20px;}

.join_final h1{font-size: 30px;margin-bottom: 30px;}
.pp_tab{width: 100%;display: inline-block;}
.pp_tab li{width: 33.3%;float: left;border:1px solid #c9c9c9;padding: 20px 0;text-align: center;font-size: 16px;box-sizing:border-box;cursor: pointer;}
.pp_tab li.active{color: #ffffff; background-color: #424445;}
.txt_pp{width: 100%;padding: 10px;box-sizing: border-box;max-height: 240px;overflow: auto;line-height: 22px;border: 1px solid #ccc;margin-top:5px;min-height: 240px;}
.txt_pp_2{display: none;}
.txt_pp_3{display: none;}

.agree{text-align: right;}
</style>
		<div class="join_layer">
			<div class="inner">
			<?if($step==""){?>
				<form action="" name="joinFrm" id="joinFrm" method="post">
					<input type="hidden" name="step" value="1">

					<img src="/images/signup/join_nav_01.png"  class="mt80 mb50" alt="">
					<ul class="pp_tab">
						<li class="active">이용약관</li>
						<li>개인정보 취급방침</li>
						<li>개인정보 제3자 제공동의</li>
					</ul>
				
					<div class="txt_pp txt_pp_1"><?=$pp[0]["terms"]?></div>
					<div class="txt_pp txt_pp_2"><?=$pp[0]["privacy"]?></div>
					<div class="txt_pp txt_pp_3"><?=$pp[0]["otheragree"]?></div>
					
					<div class="agree mt10">
						<input type="checkbox" name="agree" id="agree"><label for="" class="form-check-label">약관에 동의합니다.</label>
					</div>

					<div class="btn_layer text-center mb70">
						<a href="/"><button class="btn_comm2 mt30 btn_cancle" type="button" style="width:270px; height:60px; font-size:20px;">이전</button></a>
						<button class="btn_comm mt30" type="button" id="btn_apply" style="width:270px; height:60px; font-size:20px;">다음</button>
					</div>
					
				</form>
			<?}elseif($step=="1"){?>
				<form action="" name="joinFrm" id="joinFrm" method="post">
					<input type="hidden" name="step" value="2">
					<input type="hidden" name="check_hp" id="check_hp">
					<input type="hidden" name="check_id" id="check_id">
					<input type="hidden" name="check_nick" id="check_nick">
					<input type="hidden" name="requestNo" id="requestNo">
					<img src="/images/signup/join_nav_02.png"  class="mt80 mb50" alt="">
					<p class="tit2">회원가입에 필요한 아래 항목들을 작성하시기 바랍니다.</p>


					<table class="tbl_board tbl_view mt30" cellspacing="0" cellpadding="0" border="0" width="100%">
						<col width="200px">
						<col width="*">
						<tr class="thead">
							<th>이름</th>
							<td><input type="text" class="input_txt" name="name" id="name" placeholder="이름" value="" data-valid="notnull" data-alert="이름" required></td>
						</tr>
						<tr class="thead">
							<th>아이디</th>
							<td>
								<input type="text" class="input_txt w77p" name="id" id="id" placeholder="아이디" value="" data-valid="notnull" data-alert="아이디" maxlength="12" required>
								<button type="button" class="btn_comm2" id="btn_check_id">중복확인</button>
							</td>
						</tr>
						<tr class="thead">
							<th>닉네임</th>
							<td>
								<input type="text" class="input_txt w77p" name="nick" id="nick" placeholder="닉네임" value="" data-valid="notnull" data-alert="닉네임" required>
								<button type="button" class="btn_comm2" id="btn_check_nick">중복확인</button>
							</td>
						</tr>
						<tr class="thead">
							<th>비밀번호</th>
							<td>
								<input type="password" class="input_txt w50p" name="pwd" id="pwd" placeholder="비밀번호" value="" data-valid="notnull" data-alert="비밀번호" required>
								 <small class="text-muted">※ 비밀번호는 4자 이상으로 입력해주세요.</small>
							</td>
						</tr>
						<tr class="thead">
							<th>비밀번호확인</th>
							<td>
								<input type="password" class="input_txt w50p" name="pwd2" id="pwd2" placeholder="비밀번호확인" value="" data-valid="notnull" data-alert="비밀번호확인" required>
								 <small class="text-muted">※ 설정하신 비밀번호를 한번 더 입력해주세요.</small>
							</td>
						</tr>
						<tr class="thead">
							<th>이메일</th>
							<td>
								<input type="text" class="input_txt w200px" name="email1" id="email1" placeholder="" value="" data-valid="notnull" data-alert="이메일" required> @
								<input type="text" class="input_txt w250px" name="email2" id="email2" placeholder="" value="" data-valid="notnull" data-alert="이메일" required>
								<select class="input_txt w250px" name="selectEmail" id="selectEmail">
									<option value="1" selected>직접입력</option>
									<option value="naver.com" >naver.com</option>
									<option value="hanmail.net">hanmail.net</option>
									<option value="hotmail.com">hotmail.com</option>
									<option value="nate.com">nate.com</option>
									<option value="yahoo.co.kr">yahoo.co.kr</option>
 								</select>


								<div class="agree_layer mt10">
									<span class="mr20">메일수신동의</span>
									<input type="radio" name="mail_agree" id="mail_agree1" value="Y" checked><label for="mail_agree1" class="form-check-label">예</label>
									<input type="radio" name="mail_agree" id="mail_agree2" value="N"><label for="mail_agree2" class="form-check-label">아니오</label>
								</div>

							</td>
						</tr>
						<tr class="thead">
							<th>전화번호</th>
							<td>
								<input type="text" class="input_txt w100px" name="hp1" id="hp1" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp2" id="hp2" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp3" id="hp3" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
								<button type="button" class="btn_comm2" id="sendConfirm">인증번호 전송</button>
								<div class="telAuth mt10 hid">
									<input type="text" class="input_txt" style="width:336px !important" name="authNo" id="authNo" placeholder="" value="" data-valid="notnull" data-alert="인증번호" >
									<button type="button" class="btn_comm" id="checkNo">인증번호 확인</button>
								</div>
								<div class="agree_layer mt10">
									<span class="mr20">SMS 동의</span>
									<input type="radio" name="tel_agree" id="tel_agree1" value="Y" checked><label for="tel_agree1" class="form-check-label">예</label>
									<input type="radio" name="tel_agree" id="tel_agree2" value="N"><label for="tel_agree2" class="form-check-label">아니오</label>
								</div>
							</td>
						</tr>

					</table>
					<div class="btn_layer text-center mb70 mt10">
						<a href="/"><button type="button" class="btn_comm2  btn_cancle">취소</button></a>
						<button type="button" class="btn_comm " id="btn_apply">다음</button>
					</div>
				</form>
			<?}elseif($step=="2"){?>
				<img src="/images/signup/join_nav_03.png"  class="mt80 mb50" alt="">
				<div class="join_final">
					<h1 class="text-center">가입이 완료되었습니다.</h1>
					<h1 class="text-center">JL투자그룹의 무료회원가입을 축하드립니다.</h1>

				</div>
				<div class="btn_layer text-center mb70 mt50">
					<a href="/login"><button type="button" class="btn_comm" id="btn_apply">로그인</button></a>
				</div>
			<?}?>
			</div>
		</div>
<script>
$(".pp_tab li").click(function(){
	var $thisNo = $(this).index()+1;
	$(this).addClass("active").siblings().removeClass("active")
	$(".txt_pp").hide()
	$(".txt_pp_"+$thisNo).show();
});

$('#selectEmail').change(function(){ $("#selectEmail option:selected").each(function () {
	if($(this).val()== '1'){ //직접입력일 경우
		$("#email2").val(''); //값 초기화
		$("#email2").attr("disabled",false); //활성화
	}else{ //직접입력이 아닐경우
		$("#email2").val($(this).text()); //선택값 입력
		$("#email2").attr("disabled",true); //비활성화
	 } }); });

$("#btn_apply").click(function(){
	var form = document.getElementById("joinFrm")
	<?if($step==""){?>
		if(!$("#agree").is(":checked")){
			alert("이용약관에 동의해주세요.");
			$("#agree").focus();
			return false;
		}

		form.submit();
	<?}elseif($step=="1"){?>
		loginChk();
	<?}elseif($step=="2"){?>

	<?}?>

})
<?if($step=="1"){?>
function loginChk(){
	var form = document.getElementById("joinFrm")
	var $id = $("#id").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $name = $("#name").val();
	var $nick = $("#nick").val();
	var $hp1 = $("#hp1").val();
	var $hp2 = $("#hp2").val();
	var $hp3 = $("#hp3").val();
	var $email1 = $("#email1").val();
	var $email2 = $("#email2").val();
	var $check_hp = $("#check_hp").val();
	var $check_id = $("#check_id").val();
	var $check_nick = $("#check_nick").val();

	if($name.length < 2){
		alert("이름을 2자리 이상으로 입력해주세요.")
		$("#name").focus();
		return false;
	}
	var idReg = /^[a-zA-Z]+[a-z0-9]{3,11}$/g;
	if( !idReg.test( $id ) ) {
		alert("아이디는 영문자로 시작하는 4~12자 영문자 또는 숫자이어야 합니다.");
		$("#id").focus();
		return;
	}
	if($check_id != "1"){
		alert("아이디 중복확인을 해주세요.");
		return false;
	}
	if($nick.length < 2){
		alert("닉네임을 2자리 이상으로 입력해주세요.")
		$("#nick").focus();
		return false;
	}
	if($check_nick != "1"){
		alert("닉네임 중복확인을 해주세요.");
		return false;
	}
	if($pwd.length < 4){
		alert("비밀번호는 4자리 이상으로 입력해주세요.")
		$("#pwd").focus();
		return false;
	}
	if($pwd!=$pwd2){
		alert("비밀번호를 정확히 입력해주세요.")
		$("#pwd2").focus();
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

	var $agreesms = $("input[name='tel_agree']:checked").val();
	var $agreeemail = $("input[name='mail_agree']:checked").val();
	if($check_hp!="1"){
		alert("핸드폰번호를 인증해주세요.");
		return false;
	}
	if (web.formValidation(form,true)){
		$.ajax({
			url : "/proc/signupProc",
			dataType : "text",
			method: "POST",
			data : {step:'<?=$step?>',id:$id,pwd:$pwd,pwd2:$pwd2,name:$name,nick:$nick,hp:$hp,email:$email,agreesms:$agreesms,agreeemail:$agreeemail,check_hp:$check_hp,check_id:$check_id,check_nick:$check_nick},
			success : function(result) {

				if(result=="success"){

					//alert($id+"아이디가 생성되었습니다.");
					//location.href = "/login";
					form.submit();
				}else{
					alert(result);
				}
			},
			error : function(status) {
				alert("에러가 발생하였습니다.");
			}
		});

	}
}

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
		alert("휴대폰번호를 숫자만 입력해주세요.");
		$("#hp1").focus();
		return false;
	}
	if(!regExpNo.test($hp2)){
		alert("휴대폰번호를 숫자만 입력해주세요.");
		$("#hp2").focus();
		return false;
	}
	if(!regExpNo.test($hp3)){
		alert("휴대폰번호를 숫자만 입력해주세요.");
		$("#hp3").focus();
		return false;
	}

	var $hp = $hp1+"-"+$hp2+"-"+$hp3;
	var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;
	if(!regExpHp.test($hp)){
		alert("휴대폰번호를 정확히 입력해주세요.");
		return false;
	}

	$.ajax({
		url : "/proc/sendHpConfirmNo",
		dataType : "text",
		method: "POST",
		data : {hp:$hp,'mode':'join'},
		success : function(result) {
			if(result.indexOf(":")!= -1){
				var rstArr = result.split(":");
				if(rstArr[0]=="success"){
					alert("인증번호가 발송되었습니다.\n인증번호를 입력해주세요.");
					$("#joinFrm").find("#requestNo").val(rstArr[1])
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
	var $responseNo = $("#joinFrm").find("#authNo").val();
	var $requestNo = $("#joinFrm").find("#requestNo").val();
	$.ajax({
		url : "/proc/sendHpConfirmNoCheck",
		dataType : "text",
		method: "POST",
		data : {requestNo:$requestNo,responseNo:$responseNo,'mode':'join'},
		success : function(result) {
			if(result=="success"){
				alert("정상적으로 인증되었습니다.");
				$("#check_hp").val("1");
			}else{
				alert(result);
				$("#check_hp").val("0");
			}
			return false;
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})
$("#btn_check_id").click(function(){
	var $id = $("#id").val();
	if(!$.trim($id)){
		alert("아이디를 입력해주세요.");
		$("#id").focus();
		return false;
	}
	var idReg = /^[a-zA-Z]+[a-z0-9]{3,11}$/g;
	if( !idReg.test( $id ) ) {
		alert("아이디는 영문자로 시작하는 4~12자 영문자 또는 숫자이어야 합니다.");
		$("#id").focus();
		return;
	}
	$.ajax({
		url : "/proc/checkConfirmProc",
		dataType : "text",
		method: "POST",
		data : {'mode':'id',id:$id},
		success : function(result) {
			if(result=="success"){
				alert("사용가능한 아이디입니다.");
				//$("#id").prop("readonly",true)
				$("#check_id").val("1");
			}else{
				alert(result);
				$("#check_id").val("0");
			}
			return false;
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})
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
				//$("#nick").prop("readonly",true)
				$("#check_nick").val("1");
			}else{
				alert(result);
				$("#check_nick").val("0");
			}
			return false;
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
})
$("#id").keyup(function(){
	$("#check_id").val("0");
})
$("#nick").keyup(function(){
	$("#check_nick").val("0");
})
$("#hp1,#hp2,#hp3").keyup(function(){
	$("#check_hp").val("0");
})

<?}?>
</script>
