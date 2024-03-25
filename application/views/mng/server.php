
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
							<?
							// 리스트
							if($mode==""){
							?>
							<form class="form-horizontal" name="searchFrm" id="searchFrm">
								<div class="control-group">
									<div class="input-append date pull-right">
										<select name="paging" id="paging" class="span1" onchange="document.searchFrm.submit();">
											<option value="">목록수</option>
											<option value="10" <?if($paging=="10"){echo "selected";}?>>10</option>
											<option value="20" <?if($paging=="20"){echo "selected";}?>>20</option>
											<option value="50" <?if($paging=="50"){echo "selected";}?>>50</option>
											<option value="100" <?if($paging=="100"){echo "selected";}?>>100</option>
										</select>
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered">
								<col width="10%">
								<col width="*">
								<col width="10%">
								<col width="10%">
								<col width="25%">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th>그룹명</th>
									<th>관리자</th>
									<th>타입</th>
									<th>메모</th>
									<th>등록일</th>
									<th>회원수</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($server)){
									foreach($server as $var){
										$server_type = get_server_type($var["type"]);
										$manager_list = "";
										if(count($room_manager)){
											foreach($room_manager as $var2){
												if($var["idx"] == $var2["room_idx"]){
													$managerInfo = getUserInfo($var2["manager_idx"]);
													$manager_name = $managerInfo["name"];
													$manager_id = $managerInfo["id"];
													$manager_list .= $manager_name."<BR>";
												}
											}
										}
										$room_cnt = $this->Common_db_model->get_query_total(member_list, " room_idx='". $var["idx"] ."' ");
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/server?mode=update&idx=<?=$var["idx"]?>'"><?=$var["name"]?></td>
									<td><?=$manager_list?></td>
									<td><?=$server_type?></td>
									<td class="text-nowrap"><?=$var["ment"]?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td><?=$room_cnt?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_server" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="8" class="text-center">등록된 그룹이 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/server?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 회원등록 ?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/serverProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">그룹타입</label>
											<div class="controls">
												<select name="type" id="type" data-valid="notnull" data-alert="그룹타입" required>
													<option value="1"><?=get_server_type('1')?></option>
													<option value="2"><?=get_server_type('2')?></option>
													<option value="3"><?=get_server_type('3')?></option>
												</select>
											</div>			
										</div>										
										<div class="control-group">											
											<label class="control-label" for="firstname">그룹명</label>
											<div class="controls">
												<input type="text" class="span6" name="name" id="name" placeholder="그룹명" value="" data-valid="notnull" data-alert="그룹명" required >
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="firstname">메모</label>
											<div class="controls">
												<input type="text" class="span4" name="ment" id="ment" placeholder="메모" value="" data-valid="notnull" data-alert="메모" required >
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/server" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm" method="post" enctype="multipart/form-data" action="/proc/serverProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="idx" value="<?=$idx?>">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">그룹타입</label>
											<div class="controls">
												<select name="type" id="type" data-valid="notnull" data-alert="그룹타입" required>
													<option value="1" <?if($server[0]["type"]=="1"){echo "selected";}?>><?=get_server_type('1')?></option>
													<option value="2" <?if($server[0]["type"]=="2"){echo "selected";}?>><?=get_server_type('2')?></option>
													<option value="3" <?if($server[0]["type"]=="3"){echo "selected";}?>><?=get_server_type('3')?></option>
												</select>
											</div>			
										</div>										
										<div class="control-group">											
											<label class="control-label" for="firstname">그룹명</label>
											<div class="controls">
												<input type="text" class="span6" name="name" id="name" placeholder="그룹명" value="<?=$server[0]["name"]?>" data-valid="notnull" data-alert="그룹명" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">관리자</label>
											<div class="controls">
												<select name="room_idx" id="room_idx" class="multiselect span4" size="5">
													<?foreach($manager as $var){
														$chk_inserted = false;
														if(count($room_manager)){
															foreach($room_manager as $var2){
																if($var["idx"] == $var2["manager_idx"]){
																	$chk_inserted = true;
																}
															}
														}
														if($chk_inserted){
															continue;
														}
													?>
													<option value="<?=$var["idx"]?>"><?=$var["name"]?> (<?=$var["id"]?>)</option>
													<?}?>
												</select>
												
												<input type="button" id="left" value="<" />
												<input type="button" id="right" value=">" />
											
												<select id="myroom" name="myroom" class="multiselect span4" size="5">
													<?foreach($room_manager as $var){
														$managerInfo = getUserInfo($var["manager_idx"]);
														$manager_name = $managerInfo["name"];
														$manager_id = $managerInfo["id"];
													?>
													<option value="<?=$var["manager_idx"]?>"><?=$manager_name?>(<?=$manager_id?>)</option>
													<?}?>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">메모</label>
											<div class="controls">
												<input type="text" class="span4" name="ment" id="ment" placeholder="메모" value="<?=$server[0]["ment"]?>" data-valid="notnull" data-alert="메모" required >
											</div>
										</div>

										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/server" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

function insertMem(){
	var form = document.getElementById("insertFrm")
	var $type = $("#type option:selected").val();
	var $name = $("#name").val();
	var $ment = $("#ment").val();
	var $mode = "<?=$mode?>";

	if (web.formValidation(form,true)){
		form.submit();
	}
}
<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $type = $("#type option:selected").val();
	var $name = $("#name").val();
	var $ment = $("#ment").val();
	var $mode = "<?=$mode?>";
	var $idx = "<?=$idx?>";

	if (web.formValidation(form,true)){
		form.submit();
	}	
}
function submitRoomManager(manager_idx,mode){
	var $idx = "<?=$idx?>";
	if($idx){
		data={room_idx:$idx,mode:mode,manager_idx:manager_idx}
		ajaxProcess("/proc/roomManagerProc",data,"/<?=admmng?>/manager?mode=update&idx=<?=$idx?>");
	}
}
$(function () {
	function moveItems(origin, dest,dir) {
		var $target_idx = $(origin).find(':selected').val();
		$(origin).find(':selected').appendTo(dest).prop("selected",false);
		if($target_idx!=undefined){
			submitRoomManager($target_idx,dir);
		}
	}
	$('#left').click(function () {
		moveItems('#myroom', '#room_idx','d');
	});

	$('#right').on('click', function () {
		moveItems('#room_idx', '#myroom','i');
	});

});
<?}?>
$(function(){
	$(".btn_delete_server").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/serverProc",data,"/<?=admmng?>/server");			
		}
	})
})
</script>