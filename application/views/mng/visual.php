
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
								<col width="*">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th>제목</th>
									<th>노출여부</th>
									<th>등록일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($visual)){
									foreach($visual as $var){
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/visual?mode=update&idx=<?=$var["idx"]?>'"><?=$var["title"]?></td>
									<td><?=$var["view"]?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_visual" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="6" class="text-center">등록된 팝업이 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/visual?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 회원등록 ?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/visualProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span6" name="link" id="link" placeholder="링크" >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">노출</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="view" value="Y" checked> 노출</label>
												<label class="radio inline"><input type="radio" name="view" value="N"> 숨김</label>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="firstname">배경이미지</label>
											<div class="controls">
												<input type="file" class="span6" name="upfile" id="upfile" placeholder="배경이미지" data-valid="notnull" data-alert="배경이미지" required>
												<p class="help-block">※ 배경이미지 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">매인이미지</label>
											<div class="controls">
												<input type="file" class="span6" name="upfile_bg" id="upfile_bg" placeholder="매인이미지" data-valid="notnull" data-alert="매인이미지" required>
												<p class="help-block">※ 매인이미지 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/visual" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm" method="post" enctype="multipart/form-data" action="/proc/visualProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="idx" value="<?=$idx?>">
									<input type="hidden" name="filedel" id="filedel" value="N">
									<input type="hidden" name="filedel_bg" id="filedel_bg" value="N">
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="<?=$visual[0]["title"]?>" data-valid="notnull" data-alert="제목" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span6" name="link" id="link" placeholder="링크" value="<?=$visual[0]["link"]?>" >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">노출</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="view" value="Y" <?if($visual[0]["view"]=="Y"){echo "checked";}?>> 노출</label>
												<label class="radio inline"><input type="radio" name="view" value="N" <?if($visual[0]["view"]=="N"){echo "checked";}?>> 숨김</label>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">배경이미지</label>
											<div class="controls">

												<input type="file" class="span6" name="upfile" id="upfile" placeholder="배경이미지">
												<button type="button" class="btn btn-danger pull-right" id="removeFile">배경이미지 삭제</button>
												<?if(isset($visual[0]["upfile"])){?>
												<img src="/upload/board/<?=$pn?>/<?=$visual[0]['upfile']?>" class="attach_file pull-right" style="height:44px;margin:0 10px" alt="">
												<?}?>
												<p class="help-block ">※ 배경이미지 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">매인이미지</label>
											<div class="controls">
												<input type="file" class="span6" name="upfile_bg" id="upfile_bg" placeholder="매인이미지">
												<button type="button" class="btn btn-danger pull-right" id="removeFile_bg">매인이미지 삭제</button>
												<?if(isset($visual[0]["upfile_bg"])){?>
												<img src="/upload/board/<?=$pn?>/<?=$visual[0]['upfile_bg']?>" class="attach_file_bg pull-right" style="height:44px;margin:0 10px" alt="">
												<?}?>
												<p class="help-block">※ 매인이미지 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/visual" class="btn btn-invert ">목록</a>
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

<script type="text/javascript">
function insertMem(){
	var form = document.getElementById("insertFrm")

	if (web.formValidation(form,true)){
		form.submit();
	}
}
<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	if (web.formValidation(form,true)){
		form.submit();
	}
}
<?}?>
$(function(){
	$(".btn_delete_visual").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/visualProc",data,"/<?=admmng?>/visual");
		}
	})
	$("#removeFile").click(function(){
		$(".attach_file").remove();
		$("#upfile").val("");
		$("#filedel").val("Y");
	})
	$("#removeFile_bg").click(function(){
		$(".attach_file_bg").remove();
		$("#upfile_bg").val("");
		$("#filedel_bg").val("Y");
	})
})
</script>
