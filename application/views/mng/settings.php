
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3> <?=$t2?></h3>
						</div>
						<div class="widget-content">
							<form class="form-horizontal" name="settingFrm" id="settingFrm" method="post">
								<fieldset>
									<div class="control-group">
										<label class="control-label" for="username">입금은행</label>
										<div class="controls">
											<input type="text" class="span8" name="bank" id="bank" placeholder="입금은행" value="<?=$settings["bank"]?>">
										</div>			
									</div>
									<div class="control-group">
										<label class="control-label" for="username">계좌번호</label>
										<div class="controls">
											<input type="text" class="span8" name="bank_no" id="bank_no" placeholder="계좌번호" value="<?=$settings["bank_no"]?>">
										</div>			
									</div>
									<div class="control-group">
										<label class="control-label" for="username">예금주</label>
										<div class="controls">
											<input type="text" class="span8" name="bank_owner" id="bank_owner" placeholder="예금주" value="<?=$settings["bank_owner"]?>">
										</div>			
									</div>
									<div class="control-group">
										<label class="control-label" for="username">허용IP</label>
										<div class="controls">
											<textarea name="ip_allow" id="ip_allow" cols="30" rows="10" class="span4"><?=str_replace(",","\n",$settings["ip_allow"])?></textarea>
											<p class="help-block">※ 접속을 허용할 아이피를 입력해주세요. ( 엔터로 구분 )</p>
										</div>			
									</div>
									<div class="form-actions">
										<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateApikey();">등록</button>
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

<script>
function updateApikey(){
	var form = document.getElementById("settingFrm")
	var $sms_apikey = $("#sms_apikey").val();
	var $ip_allow = $("#ip_allow").val();
	$ip_allow_arr = $ip_allow.split("\n").filter(removeEmpty);
	$ip_allow = $ip_allow_arr.join(",");

	if (web.formValidation(form,true)){
		$("#ip_allow").val($ip_allow);
		data=$(form).serialize();
		ajaxProcess("/proc/settingProc",data,"/<?=admmng?>/settings");
		
	}	
}
function removeEmpty(value){
  return value != "";
}
</script>