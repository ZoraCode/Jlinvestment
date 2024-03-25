<style>
.form-check-label{display: inline-block;margin-left: 10px;margin-right: 15px;}
.w370px{width: 370px !important;}
/* .main {border-bottom: 0; padding-bottom: 0;} */
/* .main2 {margin-top: 30px;} */
.main2 {margin-top: 30px;}
.connect_main {margin-top: 0;}
</style>
<link href="<?=base_url('assets/css/datepicker3.css')?>" rel="stylesheet">
<? if($mode=="update"){ ?>
<div class="main2">
<? } else { ?>
<div class="main">
<? } ?>
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
							<?
							// 리스트
							if($mode==""){
							?>
							<form class="form-horizontal" name="searchFrm" id="searchFrm">
								<input type="hidden" name="targetidxs" id="targetidxs">
								<div class="control-group form-actions" style="margin-top:0;">
									<div class=" pull-right">
										<select name="paging" id="paging" class="span1" onchange="document.searchFrm.submit();">
											<option value="">목록수</option>
											<option value="10" <?if($paging=="10"){echo "selected";}?>>10</option>
											<option value="20" <?if($paging=="20"){echo "selected";}?>>20</option>
											<option value="50" <?if($paging=="50"){echo "selected";}?>>50</option>
											<option value="100" <?if($paging=="100"){echo "selected";}?>>100</option>
										</select>
										<select name="search_room_idx" id="search_room_idx">
											<option value="">검색할 유형을 선택해주세요.</option>
											<option value="free" <?if($search_room_idx=="free"){echo "selected";}?>>무료회원</option>
											<option value="pay" <?if($search_room_idx=="pay"){echo "selected";}?>>유료회원</option>
											<?foreach($pdt_list as $var){?>
												<option value="<?=$var["idx"]?>" <?if($search_room_idx==$var["idx"]){echo "selected";}?>><?=$var["pd_title"]?> (<?=$var["pd_period"]?>개월)</option>
											<?}?>

										</select>
										<input class="span2 m-wrap" name="startdate" id="startdate" type="text" placeholder="시작일" value="<?=$startdate?>"> ~ <input class="span2 m-wrap" name="enddate" id="enddate" type="text" placeholder="종료일" value="<?=$enddate?>">

										<input class="m-wrap" name="searchStr" id="searchStr" type="text" value="<?=$searchStr?>" placeholder="검색어(ex 이름,핸드폰)">
										<button class="btn btn-danger" type="button" onclick="document.searchFrm.submit();">검색</button>
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered">
								<col width="10%">
								<col width="15%">
								<col width="15%">
								<col width="15%">
								<col width="20%">
								<col width="15%">
								<col width="15%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center"><input type="checkbox" class="btn_check btn_check_group">All</th>
									<th>이름</th>
									<th>아이디</th>
									<th>핸드폰</th>
									<th>상품</th>
									<th>서비스 이용기간</th>
									<th>가입일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($members)){
									foreach($members as $var){
										//$menus_list = get_title()
										$menu_title = "";
										if(isset($var["menus"])){
											$menuArr = explode(",",$var["menus"]);
											foreach($menuArr as $key=>$var2){
												$menu_title .= get_title($var2)["t2"];
												if(count($menuArr)-1 > $key){
													$menu_title.="/";
												}
											}
										};
										$startdate = $var["startdate"]=="0" ? "":date('Y-m-d', $var["startdate"]);
										$enddate = $var["enddate"]=="0" ? "":date('Y-m-d', $var["enddate"]);
										$period = !empty($startdate) && !empty($enddate) ? $startdate." ~ ". $enddate : "";
										$room_idx = $var["room_idx"];
										$pdt_name = "";
										if($room_idx){
											foreach($pdt_list as $item){
												if($room_idx == $item['idx']){
														$pdt_name = $item["pd_title"];
														$pdt_name = $pdt_name."<span class='cred'>(".$item["pd_period"]."개월 : ".$item["pd_price"].")</span>";
												}
											}

										}

								?>
								<tr class="curp" onclick="javascript:location.href='/<?=admmng?>/members?mode=update&idx=<?=$var["idx"]?>'" data-idx="<?=$var["idx"]?>">
									<td class="text-center"><input type="checkbox" class="btn_check" name="members" data-idx="<?=$var["idx"]?>"><?=$no?></td>
									<td class="nick"><?=$var["mb_name"]?>(<?=$var["mb_nick"]?>)</td>
									<td><?=$var["mb_id"]?></td>
									<td><?=$var["mb_hp"]?></td>
									<td><?=$pdt_name?></td>
									<td><?=$period?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_members" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>

								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="7" class="text-center">등록된 회원이 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<!-- <button type="button" class="btn btn-primary pull-left" onclick="excel();">엑셀다운</button> -->
								<a href="#memMod" role="button" class="btn btn-success pull-left mlr5" data-toggle="modal" id="btnAllMod">일괄수정</a>
								<!-- <a href="#excelDump" role="button" class="btn btn-success pull-left mlr5" data-toggle="modal" id="btnExcelDump">엑셀 일괄등록</a> -->
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/members?mode=write'">생성</button>
							</div>

							<!-- Modal -->
							<div id="memMod" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">회원 일괄수정</h3>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" name="batchFrm" id="batchFrm">
										<div class="control-group">
											<label class="control-label" for="firstname">대상</label>
											<div class="controls">
												<span class="target_list"></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="radiobtns">기간 </label>
											<div class="controls">
												<input class="span2 m-wrap" name="startdate" id="startdate" type="text" style="width:73px;" placeholder="시작일" data-valid="null" data-alert="시작일" required> ~
												<input class="span2 m-wrap" name="enddate" id="enddate" type="text" style="width:73px;" placeholder="종료일" data-valid="null" data-alert="종료일" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">상품</label>
											<div class="controls">
												<select name="room_idx w400px" id="room_idx" data-valid="null" data-alert="그룹" required>
													<option value="">상품을 선택해주세요.</option>
													<?foreach($pdt_list as $var){?>
													<option value="<?=$var["idx"]?>"><?=$var["pd_title"]?> (<?=$var["pd_period"]?>개월 : <?=$var["pd_price"]?>)</option>
													<?}?>
												</select>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
									<button class="btn btn-primary" id="btnBatchMod">일괄수정</button>
								</div>
							</div>

							<!-- Modal -->
							<div id="excelDump" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">엑셀 일괄등록/수정</h3>
								</div>
								<form class="form-horizontal" name="excelFrm" id="excelFrm" action="/proc/memberExcel" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="control-group">
										<label class="control-label" for="firstname">파일업로드</label>
										<div class="controls">
											 <input type="file" name="file" id="file" accept=".xls,.xlsx" placeholder="엑셀파일" data-valid="notnull" data-alert="파일업로드" required>
										</div>
									</div>

								</div>
								<div class="modal-footer">
									<a href="/upload/member_batch_example.xls" target="_blank" class="pull-left btn btn-success">예제엑셀 다운받기</a>
									<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
									<button class="btn btn-primary" type="submit" name="import" id="btnSubmitExcel">등록</button>
								</div>
								</form>
							</div>

							<?}elseif($mode=="write"){ // 회원등록?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="firstname">아이디</label>
											<div class="controls">
												<input type="text" class="span6" name="mb_id" id="mb_id">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이름</label>
											<div class="controls">
												<input type="text" class="span6" name="mb_name" id="mb_name">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">비밀번호</label>
											<div class="controls">
												<input type="text" class="span6" name="pwd" id="pwd">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">닉네임</label>
											<div class="controls">
												<input type="text" class="span6" name="nick" id="nick">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">휴대번호</label>
											<div class="controls">
												<input type="text" class="span4" name="phone" id="phone" data-valid="notnull" data-alert="휴대번호" required >
												<div class="agree_layer mt10">
													<span class="mr20">SMS 동의</span>
													<input type="radio" name="tel_agree" id="tel_agree1" value="Y" checked><label for="tel_agree1" class="form-check-label">예</label>
													<input type="radio" name="tel_agree" id="tel_agree2" value="N"><label for="tel_agree2" class="form-check-label">아니오</label>
												</div>

											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이메일</label>
											<div class="controls">
												<input type="text" class="span4" name="email" id="email" value="" data-valid="notnull" data-alert="이메일" required >
												<div class="agree_layer mt10">
													<span class="mr20">메일수신동의</span>
													<input type="radio" name="mail_agree" id="mail_agree1" value="Y" checked><label for="mail_agree1" class="form-check-label">예</label>
													<input type="radio" name="mail_agree" id="mail_agree2" value="N"><label for="mail_agree2" class="form-check-label">아니오</label>
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="firstname">상품</label>
											<div class="controls">
												<select name="room_idx w370px" id="room_idx">
													<option value="">상품을 선택해주세요.</option>
													<?foreach($pdt_list as $var){?>
													<option value="<?=$var["idx"]?>"><?=$var["pd_title"]?> (<?=$var["ment"]?>)</option>
													<?}?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="radiobtns">기간 </label>
											<div class="controls">
												<div class="input-append date" >
													<input class="span2 m-wrap" id="startdate" type="text" >
													<button class="btn btn-success" type="button">시작일</button>
												</div> ~
												<div class="input-append date" >
													<input class="span2 m-wrap" id="enddate" type="text" >
													<button class="btn btn-success" type="button">종료일</button>
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="firstname">메모</label>
											<div class="controls">
												<textarea name="memo" id="memo" cols="30" rows="10" class="span8"></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/members" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정
								?>
								<form class="form-horizontal" name="modFrm" id="modFrm">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="firstname">아이디</label>
											<div class="controls"><?=$members[0]["mb_id"]?></div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이름</label>
											<div class="controls"><?=$members[0]["mb_name"]?></div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">비밀번호</label>
											<div class="controls">
												<input type="text" class="span6" name="pwd" id="pwd">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">닉네임</label>
											<div class="controls">
												<input type="text" class="span6" name="nick" id="nick" value="<?=$members[0]["mb_nick"]?>" data-valid="notnull" data-alert="이름" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">휴대번호</label>
											<div class="controls">
												<input type="text" class="span4" name="phone" id="phone" value="<?=$members[0]["mb_hp"]?>" data-valid="notnull" data-alert="휴대번호" required >
												<div class="agree_layer mt10">
													<span class="mr20">SMS 동의</span>
													<input type="radio" name="tel_agree" id="tel_agree1" value="Y" <?if($members[0]["agree_sms"]=="Y"){echo "checked";}?>><label for="tel_agree1" class="form-check-label">예</label>
													<input type="radio" name="tel_agree" id="tel_agree2" value="N" <?if($members[0]["agree_sms"]=="N"){echo "checked";}?>><label for="tel_agree2" class="form-check-label">아니오</label>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이메일</label>
											<div class="controls">
												<input type="text" class="span4" name="email" id="email" value="<?=$members[0]["mb_email"]?>" data-valid="notnull" data-alert="이메일" required >
												<div class="agree_layer mt10">
													<span class="mr20">메일수신동의</span>
													<input type="radio" name="mail_agree" id="mail_agree1" value="Y" <?if($members[0]["agree_email"]=="Y"){echo "checked";}?>><label for="mail_agree1" class="form-check-label">예</label>
													<input type="radio" name="mail_agree" id="mail_agree2" value="N" <?if($members[0]["agree_email"]=="N"){echo "checked";}?>><label for="mail_agree2" class="form-check-label">아니오</label>
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="firstname">상품</label>
											<div class="controls">
												<select name="room_idx w370px" id="room_idx">
													<option value="">상품을 선택해주세요.</option>
													<?foreach($pdt_list as $var){?>
													<option value="<?=$var["idx"]?>" <?if($members[0]["room_idx"]==$var["idx"]){echo "selected";}?>><?=$var["pd_title"]?> (<?=$var["pd_period"]?>개월 : <?=$var["pd_price"]?>)</option>
													<?}?>
												</select>
											</div>
										</div>
										<div class="control-group">
												<label class="control-label" for="radiobtns">기간 </label>
												<div class="controls">
													<div class="input-append date" >
														<input class="span2 m-wrap" id="startdate" type="text" <?if($members[0]["startdate"]!="0"){?>value="<?=date('Y-m-d', $members[0]["startdate"])?>"<?}?>>
														<button class="btn btn-success" type="button">시작일</button>
													</div> ~
													<div class="input-append date" >
														<input class="span2 m-wrap" id="enddate" type="text"
														<?if($members[0]["enddate"]!="0"){?>value="<?=date('Y-m-d', $members[0]["enddate"])?>"<?}?>>
														<button class="btn btn-success" type="button">종료일</button>
													</div>
												</div>
											</div>
										<div class="control-group">
											<label class="control-label" for="firstname">메모</label>
											<div class="controls">
												<textarea name="memo" id="memo" cols="30" rows="10" class="span8"><?=$members[0]["memo"]?></textarea>
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/members" class="btn btn-invert ">목록</a>
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

<div class="main2 connect_main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3>접속권한</h3>
						</div>
						<div class="widget-content">
							<form class="form-horizontal" name="authorityfrm" id="authorityfrm">
								<fieldset>
									<div class="form-actions bd_add">
										<label class="bd_idx">게시글 번호
										<input type="text" id="bd_idx"></label>
										<button type="button" class="btn btn-success" id="btnModify" onclick="paycontents_authority_grant();">추가</button>

									</div>
								</fieldset>
								<?foreach($paycontents as $var){?>
									<div class="bd_wrap">
										<label class="control-label" for="radiobtns">-</label>
										<div class="bd_subject"><?=$var["subject"]?></div>
										<a href="javascript:void(0);" class="btn btn-danger btn_delete_paycontents" data-idx="<?=$var["idx"]?>">삭제</a>
									</div>
								<?}?>
							</form>
							<?}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?=base_url('assets/js/bootstrap-datepicker.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap-datepicker.kr.js')?>"></script>
<script>
function excel(){
	var form = document.getElementById("searchFrm");
	form.action = "/<?=admmng?>/membersexceldown";
	if(selectedItem.length>0){
		form.targetidxs.value = selectedItem.join(",");
	}
	form.submit();
	form.action = "";
	form.targetidxs.value = "";
	return false;

}
function insertMem(){
	var form = document.getElementById("insertFrm")
	var $phone = $("#phone").val();
	var $nick = $("#nick").val();
	var $pwd = $("#pwd").val();
	var $startdate = $("#startdate").val();
	var $enddate = $("#enddate").val();
	var $room_idx = $("#room_idx option:selected").val();
	var $mode = "<?=$mode?>";
	var $agreesms = $("input[name='tel_agree']:checked").val();
	var $agreeemail = $("input[name='mail_agree']:checked").val();
	var $memo = $("#memo").val();
	var $email = $("#email").val();
	var $mb_id = $("#mb_id").val();
	var $mb_name = $("#mb_name").val();

	if (web.formValidation(form,true)){
		data={phone:$phone,nick:$nick,mode:$mode,room_idx:$room_idx,startdate:$startdate,enddate:$enddate,memo:$memo,pwd:$pwd,email:$email,agreesms:$agreesms,agreeemail:$agreeemail,mb_id:$mb_id,mb_name:$mb_name}
		ajaxProcess("/proc/membersProc",data,"/<?=admmng?>/members");
	}
}

<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $phone = $("#phone").val();
	var $nick = $("#nick").val();
	var $pwd = $("#pwd").val();
	var $email = $("#email").val();
	var $startdate = $("#startdate").val();
	var $enddate = $("#enddate").val();
	var $room_idx = $("#room_idx option:selected").val();
	var $memo = $("#memo").val();
	var $mode = "<?=$mode?>";
	var $idx = "<?=$idx?>";
	var $agreesms = $("input[name='tel_agree']:checked").val();
	var $agreeemail = $("input[name='mail_agree']:checked").val();

	if (web.formValidation(form,true)){
		data={phone:$phone,nick:$nick,mode:$mode,room_idx:$room_idx,idx:$idx,startdate:$startdate,enddate:$enddate,memo:$memo,pwd:$pwd,email:$email,agreesms:$agreesms,agreeemail:$agreeemail}
		ajaxProcess("/proc/membersProc",data,"/<?=admmng?>/members?mode=update&idx=<?=$idx?>");
	}
}

function paycontents_authority_grant() {
	var form = document.getElementById("authorityfrm")
	var $idx = "<?=$idx?>";
	var $bd_idx = $("#bd_idx").val();
	var $mb_id = "<?=$members[0]["mb_id"]?>";

	if($bd_idx == "")
	{
		alert("게시글 번호를 입력해주세요.");
		return;
	}

	if(isNaN($bd_idx)==true)
	{
		alert("숫자만 입력가능합니다.");
		return;
	}

	if (web.formValidation(form,true)){
		data={mb_idx:$idx,bd_idx:$bd_idx,mb_id:$mb_id}
		ajaxProcess("/proc/paycontents_authority_grant",data,"");
	}
}

$(".btn_delete_paycontents").click(function(){
	var $thisIdx = $(this).data("idx");
	if(confirm("게시글 열람 권한을 삭제하시겠습니까?")){
		data={idx:$thisIdx}
		ajaxProcess("/proc/paycontents_authority_del",data,"/<?=admmng?>/members?mode=update&idx=<?=$idx?>");
	}
})


<?}?>
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
$(function(){
	$('#startdate,#enddate').datepicker({
		format: "yyyy-mm-dd",
		language: "kr"
	});
	$(".btn_delete_members").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/membersProc",data,"/<?=admmng?>/members");
		}
	})
	$("input[name='members'][type='checkbox']").change(function(){
		selectedMinercheck();
	});
	$(".btn_check_group").click(function(){
		var $isChecked = $(this).is(":checked");
		$(this).closest("table").find("input[name='members'][type='checkbox']").prop("checked",$isChecked);
		selectedMinercheck();
	})
	$("#btnAllMod").click(function(){
		if(selectedItem.length==0){
			alert("수정대상을 선택해주세요.");
			return false;
		}
		var $inner_html = "대상("+selectedItem.length+")명<br>";
		$.each(selectedItem,function(i,v){
			var $nick = $("tr[data-idx='"+v+"']").find(".nick").text()
			$inner_html = $inner_html + "<span class='badge badge-secondary'>" + $nick + "</span>";
		})

		$("#batchFrm").find(".target_list").html($inner_html)

	})
	$(document).on("click","#btnBatchMod",function(){
		var form = document.getElementById("batchFrm")
		var $startdate = $("#batchFrm").find("#startdate").val();
		var $enddate = $("#batchFrm").find("#enddate").val();
		var $room_idx = $("#batchFrm").find("#room_idx option:selected").val();

		if (web.formValidation(form,true)){
			if(confirm("저장하시겠습니까?"))	{
				data = {
					mode:"batch",
					target : selectedItem.join(","),
					startdate : $startdate,
					enddate : $enddate,
					room_idx : $room_idx
				}
				ajaxProcess("/proc/membersProc",data,"/<?=admmng?>/members");
			}
		}
	})
/*
	$(document).on("click","#btnSubmitExcel",function(){
		var form = document.getElementById("excelFrm")
		if (web.formValidation(form,true)){
			form.submit();
		}
	})
*/
})
</script>
