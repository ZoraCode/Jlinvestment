<style>
label {font-size: 32px;}
.idpw_layer h3{font-size: 40px;font-weight: bold;letter-spacing: -3px;}
.input_txt{box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 67px;font-size: 32px;}

.join_final h1{font-size: 30px;margin-bottom: 30px;}
.footer	p {
		font-size: 22px;
		line-height: 30px !important;
    letter-spacing: -1.5px;
    font-family: 'Noto Sans KR', sans-serif;
	}
</style>
		<div class="idpw_layer mt80 mb60">
			<div class="inner">
				<div>
					<div class="txtCenter">
						<h3>아이디 찾기</h3>
					</div>
					<form name="findidFrm" id="findidFrm" class="mt50 mb50">
						<div class="ml20 mb50">
							<label for="name" class="pb20">이름</label>
							<input type="text" class="input_txt w760px" name="name" id="name" placeholder="이름" value="" data-valid="notnull" data-alert="이름" required>
						</div>
						<div class="ml20 mb50">
							<label for="hp1" class="pb20">전화번호</label>
							<input type="text" class="input_txt w250px" name="hp1" id="hp1" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							<input type="text" class="input_txt w250px" name="hp2" id="hp2" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							<input type="text" class="input_txt w250px" name="hp3" id="hp3" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
						</div>
						<div class="btn_layer text-center mb70 mt50">
							<button type="button" class="btn_comm m0a btn_check" onclick="findid();" style="width:270px; height:60px; font-size:20px;">아이디 찾기</button>
						</div>
					</form>
				</div>
				<hr>

				<div class="mt50">
					<div class="mt50 txtCenter">
						<h3>비밀번호 찾기</h3>
					</div>
					<form name="findpwFrm" id="findpwFrm">
						<div class="ml20 mb50">
							<label for="id" class="pb20">아이디</label>
							<input type="text" class="input_txt w760px" name="id" id="id" placeholder="아이디" value="" data-valid="notnull" data-alert="아이디" maxlength="12" required>
						</div>
						<div class="ml20 mb50 mt50">
							<label for="name" class="pb20">이름</label>
							<input type="text" class="input_txt w760px" name="name" id="name" placeholder="이름" value="" data-valid="notnull" data-alert="이름" required>
						</div>

						<div class="ml20 mb50">
							<label for="hp1" class="pb20">전화번호</label>
							<input type="text" class="input_txt w250px" name="hp1" id="hp1" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							<input type="text" class="input_txt w250px" name="hp2" id="hp2" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							<input type="text" class="input_txt w250px" name="hp3" id="hp3" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
						</div>
						<div class="btn_layer text-center mb70 mt50">
							<button type="button" class="btn_comm m0a btn_check" onclick="findpw();" style="width:270px; height:60px; font-size:20px; padding:13px 6px;">비밀번호찾기</button>
						</div>
					</form>
				</div>


			</div>
		</div>


<script>
function findid(){
	var form = document.getElementById("findidFrm")
	var $name = $("#findidFrm").find("#name");
	var $hp1 = $("#findidFrm").find("#hp1");
	var $hp2 = $("#findidFrm").find("#hp2");
	var $hp3 = $("#findidFrm").find("#hp3");
	if($name.val().length < 2){
		alert("이름을 2자리 이상으로 입력해주세요.")
		$name.focus();
		return false;
	}
	if(!$hp1.val()){
		alert("전화번호를 입력해주세요.");
		$hp1.focus();
		return false;
	}
	if(!$hp2.val()){
		alert("전화번호를 입력해주세요.");
		$hp2.focus();
		return false;
	}
	if(!$hp3.val()){
		alert("전화번호를 입력해주세요.");
		$hp3.focus();
		return false;
	}

	var regExpNo = /^[0-9]+$/;
	if(!regExpNo.test($hp1.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp1.focus();
		return false;
	}
	if(!regExpNo.test($hp2.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp2.focus();
		return false;
	}
	if(!regExpNo.test($hp3.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp3.focus();
		return false;
	}

	var $hp = $hp1.val()+"-"+$hp2.val()+"-"+$hp3.val();
	var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;
	if(!regExpHp.test($hp)){
		alert("전화번호를 정확히 입력해주세요.");
		return false;
	}

	if (web.formValidation(form,true)){
		data = {mode:"id",name : $name.val(),hp : $hp}
		$.ajax({
			url : "/proc/findidpwProc",
			dataType : "text",
			method: "POST",
			data : data,
			success : function(result) {
				alert(result)
				return false;
			},
			error : function(status) {
				alert("에러가 발생하였습니다.");
			}
		});
	}
}
function findpw(){
	var form = document.getElementById("findpwFrm")
	var $id = $("#findpwFrm").find("#id");
	var $name = $("#findpwFrm").find("#name");
	var $hp1 = $("#findpwFrm").find("#hp1");
	var $hp2 = $("#findpwFrm").find("#hp2");
	var $hp3 = $("#findpwFrm").find("#hp3");
	if(!$id.val()){
		alert("아이디를 입력해주세요.");
		$id.focus();
		return false;
	}
	if($name.val().length < 2){
		alert("이름을 2자리 이상으로 입력해주세요.")
		$name.focus();
		return false;
	}
	if(!$hp1.val()){
		alert("전화번호를 입력해주세요.");
		$hp1.focus();
		return false;
	}
	if(!$hp2.val()){
		alert("전화번호를 입력해주세요.");
		$hp2.focus();
		return false;
	}
	if(!$hp3.val()){
		alert("전화번호를 입력해주세요.");
		$hp3.focus();
		return false;
	}

	var regExpNo = /^[0-9]+$/;
	if(!regExpNo.test($hp1.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp1.focus();
		return false;
	}
	if(!regExpNo.test($hp2.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp2.focus();
		return false;
	}
	if(!regExpNo.test($hp3.val())){
		alert("전화번호는 숫자만 입력해주세요.");
		$hp3.focus();
		return false;
	}

	var $hp = $hp1.val()+"-"+$hp2.val()+"-"+$hp3.val();
	var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;
	if(!regExpHp.test($hp)){
		alert("전화번호를 정확히 입력해주세요.");
		return false;
	}

	if (web.formValidation(form,true)){
		data = {mode:"pw",id : $id.val(),name : $name.val(),hp : $hp}
		$.ajax({
			url : "/proc/findidpwProc",
			dataType : "text",
			method: "POST",
			data : data,
			success : function(result) {
				if(result.indexOf(":")!= -1){
					var rstArr = result.split(":");
					if(rstArr[0]=="success"){
							alert("임시 비밀번호가 발송되었습니다.");
					}
				}else{
					alert(result);
				}
			}
			,
			error : function(status) {
				alert("에러가 발생하였습니다.");
			}
		});
	}
}
</script>
