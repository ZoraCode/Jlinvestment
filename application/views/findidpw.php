<style>
.input_txt{width: 100%;box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 33px;}
.idpw_layer h3{font-size: 25px;font-weight: bold;letter-spacing: -3px;}
.tbl_board td:nth-child(1){padding-left: 0 !important;text-align: center !important;}
</style>
		<div class="idpw_layer mt80 mb60">
			<div class="inner">
				<h3>아이디 찾기</h3>
				<form name="findidFrm" id="findidFrm" class="mb50">
					<table class="tbl_board tbl_view mt10 mb30" cellspacing="0" cellpadding="0" border="0" width="100%">
						<col width="200px">
						<col width="*">
						<tr class="thead">
							<td>이름</td>
							<td><input type="text" class="input_txt" name="name" id="name" placeholder="이름" value="" data-valid="notnull" data-alert="이름" required></td>
						</tr>
						<tr class="thead">
							<td>전화번호</td>
							<td>
								<input type="text" class="input_txt w100px" name="hp1" id="hp1" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp2" id="hp2" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp3" id="hp3" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							</td>
						</tr>
					</table>
					<button type="button" class="btn_comm m0a btn_check" onclick="findid();" style="width:270px; height:60px; font-size:20px;">아이디 찾기</button>
				</form>

				<h3>비밀번호 찾기</h3>
				<form name="findpwFrm" id="findpwFrm">
					<table class="tbl_board tbl_view mt10 mb30" cellspacing="0" cellpadding="0" border="0" width="100%">
						<col width="200px">
						<col width="*">
						<tr class="thead">
							<td>아이디</td>
							<td>
								<input type="text" class="input_txt" name="id" id="id" placeholder="아이디" value="" data-valid="notnull" data-alert="아이디" required>
							</td>
						</tr>
						<tr class="thead">
							<td>이름</td>
							<td><input type="text" class="input_txt" name="name" id="name" placeholder="이름" value="" data-valid="notnull" data-alert="이름" required></td>
						</tr>
						<tr class="thead">
							<td>전화번호</td>
							<td>
								<input type="text" class="input_txt w100px" name="hp1" id="hp1" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp2" id="hp2" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4"> -
								<input type="text" class="input_txt w100px" name="hp3" id="hp3" placeholder="" value="" data-valid="notnull" data-alert="전화번호" required maxlength="4">
							</td>
						</tr>
					</table>
					<button type="button" class="btn_comm m0a btn_check" onclick="findpw();" style="width:270px; height:60px; font-size:20px; padding:13px 6px;">비밀번호찾기</button>
				</form>
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
	if(!$id.val().length){
		alert("아이디를 입력해주세요.")
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
			},
			error : function(status) {
				alert("에러가 발생하였습니다.");
			}
		});
	}
}
</script>
