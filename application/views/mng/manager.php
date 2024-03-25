
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
										<input class="m-wrap" name="searchStr" id="searchStr" type="text" value="<?=$searchStr?>">
										<button class="btn btn-danger" type="button" onclick="document.searchFrm.submit();">검색</button>
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered">
								<col width="10%">
								<col width="15%">
								<col width="15%">
								<col width="*">
								<col width="10%">
								<col width="10%">
								<!-- <col width="10%"> -->
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th>이름</th>
									<th>핸드폰</th>
									<th>메뉴권한</th>
									<!-- <th>외부아이피허용</th> -->
									<th>등록일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($manager)){
									foreach($manager as $var){
										$menu_title = "";
										if(isset($var["menus"])){
											$menuArr = explode(",",$var["menus"]);
											foreach($menuArr as $key=>$var2){
												$menu_title .= !empty($var2) ? get_title($var2)["t2"] : "";
												if(count($menuArr)-1 > $key){
													$menu_title.="/";
												}
											}
										}
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/manager?mode=update&idx=<?=$var["idx"]?>'"><?=$var["id"]?>(<?=$var["name"]?>)</td>
									<td><?=$var["hp"]?></td>
									<td><?=$menu_title?></td>
									<!-- <td><?=$var["ip_pass"]?></td> -->
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_manager" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="6" class="text-center">등록된 관리자가 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/manager?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 회원등록 ?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="username">아이디</label>
											<div class="controls">
												<input type="text" class="span6" name="id" id="id" placeholder="아이디" data-valid="notnull" data-alert="아이디" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이름</label>
											<div class="controls">
												<input type="text" class="span6" name="name" id="name" placeholder="이름" data-valid="notnull" data-alert="이름" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">휴대번호</label>
											<div class="controls">
												<input type="text" class="span4" name="hp" id="hp" placeholder="휴대번호" data-valid="notnull" data-alert="휴대번호" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이메일</label>
											<div class="controls">
												<input type="text" class="span4" name="email" id="email" placeholder="이메일" data-valid="notnull" data-alert="이메일" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">비밀번호</label>
											<div class="controls">
												<input class="span4" type="password" placeholder="비밀번호" name="pwd" id="pwd" data-valid="notnull" data-alert="비밀번호" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">비밀번호확인</label>
											<div class="controls">
												<input class="span4" type="password" placeholder="비밀번호확인" name="pwd2" id="pwd2" data-valid="notnull" data-alert="비밀번호확인" required >
											</div>
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">외부아이피허용</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="ip_pass" value="Y"> 허용</label>
												<label class="radio inline"><input type="radio" name="ip_pass" value="N" checked> 비허용</label>
											</div>
										</div> -->
										<?//if($this->session->userdata('sess_level') == 10){?>
										<div class="control-group">
											<input type="hidden" name="level" id="level" value="1">
											<label class="control-label" for="firstname">메뉴권한</label>
											<div class="controls">
												<?
													$ii=1;
													foreach((array) json_decode(headers) as $key=>$val){
														foreach(json_decode(menus)[$ii-1] as $mk=>$mv){
															echo "<label class='checkbox inline'><input type='checkbox' name='menus[]' value='".$mk."'> ".$mv->name."</label>";
														}
														echo "<br>";
														$ii++;
													}
												?>
											</div>
										</div>
										<?//}?>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/manager" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="username">아이디</label>
											<div class="controls">
												<?=$manager[0]["id"]?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이름</label>
											<div class="controls">
												<input type="text" class="span6" name="name" id="name" value="<?=$manager[0]["name"]?>" data-valid="notnull" data-alert="이름" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">휴대번호</label>
											<div class="controls">
												<input type="text" class="span4" name="hp" id="hp" value="<?=$manager[0]["hp"]?>" data-valid="notnull" data-alert="휴대번호" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">이메일</label>
											<div class="controls">
												<input type="text" class="span4" name="email" id="email" value="<?=$manager[0]["email"]?>" data-valid="notnull" data-alert="이메일" required >
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
											<label class="control-label" for="firstname">서버</label>
											<div class="controls">
												<select name="room_idx" id="room_idx" class="multiselect span4" size="5">
													<?foreach($room_list as $var){
														$chk_inserted = false;
														if(count($room_manager)){
															foreach($room_manager as $var2){
																if($var["idx"] == $var2["room_idx"]){
																	$chk_inserted = true;
																}
															}
														}
														if($chk_inserted){
															continue;
														}
													?>
													<option value="<?=$var["idx"]?>"><?=$var["name"]?> (<?=$var["ment"]?>)</option>
													<?}?>
												</select>

												<input type="button" id="left" value="<" />
												<input type="button" id="right" value=">" />

												<select id="myroom" name="myroom" class="multiselect span4" size="5">
													<?foreach($room_manager as $var){
														$room = getServername($var["room_idx"]);
														$room_name = $room["name"];
													?>
													<option value="<?=$var["room_idx"]?>"><?=$room_name?>(<?=$room["ment"]?>)</option>
													<?}?>
												</select>
											</div>
										</div> -->
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">외부아이피허용</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="ip_pass" value="Y" <?if($manager[0]["ip_pass"]=="Y"){echo "checked";}?>> 허용</label>
												<label class="radio inline"><input type="radio" name="ip_pass" value="N" <?if($manager[0]["ip_pass"]=="N"){echo "checked";}?>> 비허용</label>
											</div>
										</div> -->
										<?//if($this->session->userdata('sess_level') == 10){?>
										<div class="control-group">
											<input type="hidden" name="level" id="level" value="<?=$manager[0]["level"]?>">
											<label class="control-label" for="firstname">메뉴권한</label>
											<div class="controls">
												<?
													$mymenus = $manager[0]["menus"];
													$mymenus = explode(",",$mymenus);
													$ii=1;
													foreach((array) json_decode(headers) as $key=>$val){
														foreach(json_decode(menus)[$ii-1] as $mk=>$mv){
															$chk = "";
															if(in_array($mk,$mymenus)){
																$chk = "checked";
															}
															echo "<label class='checkbox inline'><input type='checkbox' name='menus[]' value='".$mk."' $chk> ".$mv->name."</label>";
														}
														echo "<br>";
														$ii++;
													}
												?>
											</div>
										</div>
										<?//}?>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/manager" class="btn btn-invert ">목록</a>
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
	var $id = $("#id").val();
	var $hp = $("#hp").val();
	var $email = $("#email").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $name = $("#name").val();
	var $level = $("#level").val();
	// var $ip_pass = $("input[name='ip_pass']:checked").val();
	var $ip_pass = "";
	var $mode = "<?=$mode?>";
	var $menus = $.map($(':checkbox[name^=menus]:checked'), function(n, i){return n.value;}).join(',');

	if (web.formValidation(form,true)){
		if($pwd !="" && $pwd2 != "" && $pwd!=$pwd2){
			alert("비밀번호를 정확히 입력해주세요.")
			$("#pwd2").focus();
			return false;
		}
		if($("input[name='menus[]']").length && !$("input[name='menus[]']:checked").length){
			alert("메뉴권한은 최소1개이상 체크해야합니다.");
			return false;
		}
		data={id:$id,pwd:$pwd,pwd2:$pwd2,hp:$hp,email:$email,name:$name,mode:$mode,level:$level,menus:$menus,ip_pass:$ip_pass}
		ajaxProcess("/proc/managerProc",data,"/<?=admmng?>/manager");
	}
}
<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $hp = $("#hp").val();
	var $email = $("#email").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $name = $("#name").val();
	var $level = $("#level").val();
	// var $ip_pass = $("input[name='ip_pass']:checked").val();
	var $ip_pass = "";
	var $mode = "<?=$mode?>";
	var $idx = "<?=$idx?>";
	var $menus = $.map($(':checkbox[name^=menus]:checked'), function(n, i){return n.value;}).join(',');

	if (web.formValidation(form,true)){
		if($pwd !="" && $pwd2 != "" && $pwd!=$pwd2){
			alert("비밀번호를 정확히 입력해주세요.")
			$("#pwd2").focus();
			return false;
		}
		if($("input[name='menus[]']").length && !$("input[name='menus[]']:checked").length){
			alert("메뉴권한은 최소1개이상 체크해야합니다.");
			return false;
		}
		data={pwd:$pwd,pwd2:$pwd2,hp:$hp,email:$email,name:$name,mode:$mode,level:$level,idx:$idx,menus:$menus,ip_pass:$ip_pass}
		ajaxProcess("/proc/managerProc",data,"/<?=admmng?>/manager?mode=update&idx=<?=$idx?>");
	}
}
function submitRoomManager(room_idx,mode){
	var $idx = "<?=$idx?>";
	if($idx){
		data={room_idx:room_idx,mode:mode,manager_idx:$idx}
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
	$(".btn_delete_manager").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/managerProc",data,"/<?=admmng?>/manager");
		}
	})
})
</script>
