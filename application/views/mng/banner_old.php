
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
								<col width="*">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th>제목</th>
									<th>이미지</th>
									<th>사용유무</th>
									<th>등록일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($banner)){
									foreach($banner as $var){
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/banner?mode=update&idx=<?=$var["idx"]?>'"><?=$var["title"]?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/banner?mode=update&idx=<?=$var["idx"]?>'"><img src="/upload/banner/<?=$var["img"]?>" alt="" <?if($var["img_width"]>200){?> width="200"<?}?>></td>
									<td><?=$var["is_use"]?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_banner" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="6" class="text-center">등록된 배너가 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/banner?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 회원등록 ?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/bannerProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required >
											</div>			
										</div>										
										<div class="control-group">											
											<label class="control-label" for="firstname">이미지</label>
											<div class="controls">
												<input type="file" class="span6" name="img" id="img" placeholder="이미지" value="" data-valid="notnull" data-alert="이미지" required accept=".jpg,.png,.gif">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span4" name="link" id="link" placeholder="링크" value="" data-valid="notnull" data-alert="링크" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">사용여부</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="is_use" value="Y" checked> 노출</label>
												<label class="radio inline"><input type="radio" name="is_use" value="N"> 숨김</label>
											</div>
										</div>								
										<div class="form-actions">
											<button type="button" class="btn btn-primary" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/banner" class="btn btn-invert pull-right">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm" method="post" enctype="multipart/form-data" action="/proc/bannerProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="idx" value="<?=$idx?>">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="<?=$banner[0]["title"]?>" data-valid="notnull" data-alert="제목" required >
											</div>			
										</div>										
										<div class="control-group">											
											<label class="control-label" for="firstname">이미지</label>
											<div class="controls">
												<?if(isset($banner[0]["img"])){?>
												<img src="/upload/banner/<?=$banner[0]["img"]?>" alt="" <?if($banner[0]["img_width"]>200){?> width="200"<?}?>><br>
												<?}?>
												<input type="file" class="span6" name="img" id="img" placeholder="이미지" value="" <?if(!isset($banner[0]["img"])){?>data-valid="notnull" data-alert="이미지" required accept=".jpg,.png,.gif"<?}?>>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span4" name="link" id="link" placeholder="링크" value="<?=$banner[0]["link"]?>" data-valid="notnull" data-alert="링크" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">사용여부</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="is_use" value="Y" <?if($banner[0]["is_use"]=="Y"){echo "checked";}?>> 노출</label>
												<label class="radio inline"><input type="radio" name="is_use" value="N" <?if($banner[0]["is_use"]=="N"){echo "checked";}?>> 숨김</label>
											</div>
										</div>			
										<div class="form-actions">
											<button type="button" class="btn btn-primary" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/banner" class="btn btn-invert pull-right">목록</a>
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
	var $mode = "<?=$mode?>";

	if (web.formValidation(form,true)){
		//data={id:$id,pwd:$pwd,pwd2:$pwd2,hp:$hp,name:$name,mode:$mode,level:$level,menus:$menus}
		//ajaxProcess("/proc/bannerProc",data,"/<?=admmng?>/banner");			
		form.submit();
	}	
}
<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $hp = $("#hp").val();
	var $pwd = $("#pwd").val();
	var $pwd2 = $("#pwd2").val();
	var $name = $("#name").val();
	var $level = $("#level").val();
	var $mode = "<?=$mode?>";
	var $idx = "<?=$idx?>";

	if (web.formValidation(form,true)){
		//data={pwd:$pwd,pwd2:$pwd2,hp:$hp,name:$name,mode:$mode,level:$level,idx:$idx,menus:$menus}
		//ajaxProcess("/proc/bannerProc",data,"/<?=admmng?>/banner?mode=update&idx=<?=$idx?>");
		form.submit();
	}	
}
<?}?>
$(function(){
	$(".btn_delete_banner").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/bannerProc",data,"/<?=admmng?>/banner");			
		}
	})
})
</script>