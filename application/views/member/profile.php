<style>
.table-bordered th{font-size: 12px;}
</style>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span8">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3> Profile </h3>
						</div>
						<div class="widget-content">
							<div class="widget big-stats-container">
								<form class="form-horizontal" name="modFrm" id="modFrm">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">아이디</label>
											<div class="controls">
												<?=$profile[0]["id"]?>
											</div>			
										</div>										
										<div class="control-group">											
											<label class="control-label" for="firstname">이름</label>
											<div class="controls">
												<input type="text" class="span6" name="name" id="name" value="<?=$profile[0]["name"]?>" data-valid="notnull" data-alert="이름" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">휴대번호</label>
											<div class="controls">
												<input type="text" class="span4" name="hp" id="hp" value="<?=$profile[0]["hp"]?>" data-valid="notnull" data-alert="휴대번호" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이메일</label>
											<div class="controls">
												<input type="text" class="span4" name="email" id="email" value="<?=$profile[0]["email"]?>" data-valid="notnull" data-alert="이메일" required >
											</div>
										</div>
										<div class="control-group">											
											<label class="control-label" for="firstname">비밀번호</label>
											<div class="controls">
												<input class="span4" type="password" placeholder="비밀번호" name="pwd" id="pwd" > 
											</div>
										</div>
										<div class="control-group">											
											<label class="control-label" for="firstname">비밀번호확인</label>
											<div class="controls">
												<input class="span4" type="password" placeholder="비밀번호확인" name="pwd2" id="pwd2" > 
											</div>
										</div>
										<!-- <div class="control-group">											
											<label class="control-label" for="firstname">외부아이피허용</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="ip_pass" value="Y" <?if($profile[0]["ip_pass"]=="Y"){echo "checked";}?>> 허용</label>
												<label class="radio inline"><input type="radio" name="ip_pass" value="N" <?if($profile[0]["ip_pass"]=="N"){echo "checked";}?>> 비허용</label>
											</div>
										</div> -->
										<div class="form-actions">
											<button type="button" class="btn btn-primary" id="btnModify" onclick="updateMemChk();">수정</button>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $hp = $("#hp").val();
	var $email = $("#email").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $name = $("#name").val();
	var $ip_pass = $("input[name='ip_pass']:checked").val();

	if (web.formValidation(form,true)){
		if($pwd !="" && $pwd2 != "" && $pwd!=$pwd2){
			alert("비밀번호를 정확히 입력해주세요.")
			$("#pwd2").focus();
			return false;
		}
		data={pwd:$pwd,pwd2:$pwd2,hp:$hp,email:$email,name:$name,mode:"update",ip_pass:$ip_pass}
		ajaxProcess("/proc/managerProc",data,"/<?=admmng?>/profile");
	}	
}
</script>