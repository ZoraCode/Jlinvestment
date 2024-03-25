<?
//echo send_fcm('title test','message test','server','en11eJR1Bwo:APA91bESFGJTxYM0Lf2AiOuTey8oiy2lQuE9KY9L8UKgrNfSsLXpZqwWO1hNmOZsYH3ZcUtBLrZep5uGB8uZBV4aVUqwHBCRQxT27LPT4cU-3Bo7cU3bUNttDRPctbyLC_L_6enPQqiz');
?>

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
							<?if(COM_YESBIT_KEY!=""){?>
							<div class="form-actions">
								 <span class='badge badge-secondary'><span class="cred">CASH</span> <?=number_format($cash)?>원</span>
								 <span class='badge badge-secondary'><span class="cred">SMS</span> <?=number_format($sms)?>건</span>
								 <span class='badge badge-secondary'><span class="cred">LMS</span> <?=number_format($lms)?>건</span>
								 <span class='badge badge-secondary'><span class="cred">MMS</span> <?=number_format($mms)?>건</span>
								 <a href="#chargePop" role="button" class="btn btn-danger pull-right mlr5" data-toggle="modal">충전하기</a>
								 <a href="#chargeListPop" role="button" class="btn btn-info pull-right mlr5" id="btnChargeList" data-toggle="modal">결제내역</a>
							</div>
							<!-- Modal -->
							<div id="chargePop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">충전요청</h3>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" name="batchFrm" id="batchFrm">
										<div class="control-group">
											<label class="control-label" for="firstname">충전가격</label>
											<div class="controls">
												<select name="price" id="price" data-valid="notnull" data-alert="충전가격" required>
													<option value="100">100만원</option>
													<option value="300">300만원</option>
													<option value="500">500만원</option>
													<option value="1000">1000만원</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">입금정보</label>
											<div class="controls">
												<p class="card-text">국민 / 070101-04-102155 / (주)예스빗</p>
											</div>

										</div>

									</form>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
									<button class="btn btn-danger" id="btnRecharge">충전요청하기</button>
								</div>
							</div>
							<div id="chargeListPop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:800px;margin-left:-400px">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">충전목록</h3>
								</div>
								<div class="modal-body">
									<table class="table table-striped table-bordered">
										<col width="8%">
										<col width="*">
										<col width="15%">
										<col width="15%">
										<col width="10%">
										<col width="15%">
										<col width="17%">
										<thead>
										<tr>
											<th class="text-center">번호</th>
											<th>결제일</th>
											<th>결제수단</th>
											<th>금액</th>
											<th>Cash</th>
											<th>상태</th>
											<th>요청일</th>
										</tr>
										</thead>
										<?
										if(count($settleList)){
											foreach($settleList as $var){
										?>
										<tr>
											<td><?=$var->vnum?></td>
											<td><?=$var->paydate?></td>
											<td><?=$var->paymethod?></td>
											<td><?=$var->price?></td>
											<td><?=$var->cash?></td>
											<td><?=$var->status?></td>
											<td><?=$var->regdate?></td>
										</tr>
										<?

											}
										}else{
										?>
										<tr>
											<td colspan="7" class="text-center">결제내역이 없습니다.</td>
										</tr>
										<?}?>
										</tbody>
									</table>

								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
								</div>
							</div>

							<form class="form-horizontal" name="sendFrm" id="sendFrm" method="post">
								<fieldset>
									<div class="control-group">
										<label class="control-label" for="firstname">발송대상</label>
										<div class="controls">
										<?
											$allcnt = $this->Common_db_model->get_query_total(member_list, array(" 1 "=>"1"));
											$freecnt = $this->Common_db_model->get_query_total(member_list, array(" room_idx "=>"0"));
											$paycnt = $this->Common_db_model->get_query_total(member_list, array(" room_idx <> "=>"0"));
										?>
											<select name="target" id="target" data-valid="notnull" data-alert="발송대상" required>
												<option value="">검색할 유형을 선택해주세요.</option>
												<option value="all" <?if($search_room_idx=="all"){echo "selected";}?>>전체회원 (<?=$allcnt?>)</option>
												<option value="free" <?if($search_room_idx=="free"){echo "selected";}?>>무료회원 (<?=$freecnt?>)</option>
												<option value="pay" <?if($search_room_idx=="pay"){echo "selected";}?>>유료회원 (<?=$paycnt?>)</option>
												<?foreach($pdt_list as $var){
													$cnt = $this->Common_db_model->get_query_total(member_list, array("room_idx"=>$var["idx"]));
												?>
												<option value="<?=$var["idx"]?>" <?if($search_room_idx==$var["idx"]){echo "selected";}?>><?=$var["pd_title"]?> (<?=$cnt?>)</option>
												<?}?>
											</select>
										</div>
									</div>
									<!-- <div class="control-group">
										<label class="control-label" for="firstname">앱푸시</label>
										<div class="controls">
											<label class="checkbox inline"><input type="checkbox" name="push" value="Y" <?if($push=="Y"){echo "checked";}?>> Y</label>
										</div>
									</div>	 -->
									<div class="control-group">
										<label class="control-label" for="firstname">문자타입</label>
										<div class="controls">
											<label class="radio inline"><input type="radio" name="type" value="sms" checked> sms</label>
											<label class="radio inline"><input type="radio" name="type" value="lms"> lms</label>
											<!-- <label class="radio inline"><i class="icon-remove-sign recheck curp" style="font-size:12px">체크해제</i></label> -->
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="username">제목</label>
										<div class="controls">
											<input type="text" class="span6" name="title" id="title" placeholder="제목" value="<?=$title?>" data-valid="notnull" data-alert="제목" required >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="firstname">내용</label>
										<div class="controls">
											<textarea name="contents" id="contents" cols="30" rows="8" class="span6" placeholder="내용" data-valid="notnull" data-alert="내용" required onkeyup="javascript:checkMsg(this);" maxlength="2000"><?=$contents?></textarea>
											<div class="byte" id="smsLengSpan"></div>
										</div>
									</div>
									<div class="form-actions">
										<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="sendSms();">전송</button>
									</div>
								</fieldset>
							</form>
							<?}else{?>
								<a href="/<?=admmng?>/settings">APIKEY를 등록해주세요.</a>
							<?}?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
var selectedItem = Array();
function selectedMinercheck(){
	selectedItem=[];
	$("input[name='members'][type='checkbox']").each(function(i,e){
		var $thisIdx=$(this).data("idx");
		if($(this).is(":checked")){
			selectedItem.push($thisIdx);
		}
	})
}
function sendSms(){
	var form = document.getElementById("sendFrm")
	var $push = $("input[name='push']").is(":checked")?"Y":"N"
	var $target = $("#target option:selected").val();
	var $type = $("input[name='type']:checked").val();
	var $title = $("#title").val();
	var $contents = $("#contents").val();

	if (web.formValidation(form,true)){
		if($push=="N" && !$("input[name='type']:checked").length){
			alert("앱푸시 또는 문자타입을 선택해주세요.");
			return false;
		}
		data={type:$type,title:$title,contents:$contents,members:selectedItem,push:$push,target:$target}
		ajaxProcess("/proc/sendProc",data,"/<?=admmng?>/sendsms");
	}
}
function checkSearchForm(){
	document.searchFrm.push.value = document.sendFrm.push.value
	document.searchFrm.type.value = document.sendFrm.type.value
	document.searchFrm.title.value = document.sendFrm.title.value
	document.searchFrm.contents.value = document.sendFrm.contents.value
	document.searchFrm.submit();
}

function checkMsg(){
	var $txtMsg = document.sendFrm.contents;
	var bodyVal = $txtMsg.value;
	var bodyLen = bodyVal.length;

	var bytesLen = 0;
	var validBodyLen = 0;
	var validBytesLen = 0;
	var bytesVal;
	var maxlenover = false;

	for (var i = 0; i < bodyLen; i++) {
		var oneChar = bodyVal.charAt(i);
		if (escape(oneChar).length > 4) {
			bytesLen += 2;
		} else if (oneChar === "·" || oneChar === "\\") {
			bytesLen += 2;
		} else if (oneChar === "\r") {
			continue;
		} else {
			bytesLen++;
		}
		validBodyLen = i + 1;
		validBytesLen = bytesLen;
	}
	max_len = 2000;
	$("input[name='type']").prop({"disabled":false})

	if (bytesLen<=90){
		//$("input[name='type']").eq(0).prop("checked",true)
		$("input[name='type']").eq(1).prop("disabled",true)
		max_len = 90;
		maxlenover = false;
	}else{
		//$("input[name='type']").eq(1).prop("checked",true)
		$("input[name='type']").eq(0).prop("disabled",true)
		if(bytesLen>max_len && !maxlenover){
			CutChar($txtMsg,max_len);
			checkMsg();
		}
	}
	bytesVal = bytesLen>2000 ? '<b>'+ bytesLen +'</b>' : bytesLen;
	$("#smsLengSpan").html("" + bytesVal + "/" + max_len + "Byte")
}
function CutChar(obj, maxbyte)	{
	var frm = document.sendFrm;

	var str,msg;
	var len=0;
	var temp;
	var count;
	count = 0;

	msg = frm.contents.value;

	str = new String(msg);
	len = str.length;

	for(k=0 ; k<len ; k++){
		temp = str.charAt(k);
		if(escape(temp).length > 4 ){
			count += 2;
		}else if (temp != '\n'){
			count++;
		}else if (temp == '\n'){
			count++;
		}
		if(count > maxbyte)	{
			str = str.substring(0, k-1);
			break;
		}
	}
	obj.value = str;
}
$(function(){
	$("input[name='members'][type='checkbox']").change(function(){
		selectedMinercheck();
	});
	$(".btn_check_group").click(function(){
		var $isChecked = $(this).is(":checked");
		$(this).closest("table").find("input[name='members'][type='checkbox']").prop("checked",$isChecked);
		selectedMinercheck();
	})
	$("#btnRecharge").click(function(){
		var $price = $("#price option:selected").val();
		if(confirm($price+"만원 충전요청을 하시겠습니까?")){
			data={price:$price}
			ajaxProcess("/proc/smsChargeProc",data,"/<?=admmng?>/sendsms");
		}
	})
	$(".recheck").click(function(){
		$("input[name='type']").prop({"checked":false})
	})
})
</script>
