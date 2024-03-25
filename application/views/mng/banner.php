
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
								<?if(count($banner)){
									foreach($banner as $var){
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
									<td onclick="javascript:location.href='/<?=admmng?>/banner?mode=update&idx=<?=$var["idx"]?>'"><?=$var["title"]?></td>
									<td><?=$var["view"]?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_popup" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
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
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/banner?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 회원등록 ?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" action="/proc/bannerProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
                                    <input type="hidden" name="type2" value="banner">
									<input type="hidden" name="link" value="">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required >
											</div>			
										</div>
										<div class="control-group">											
											<label class="control-label" for="username">내용</label>
											<div class="controls">
												<textarea class="span6" name="contents" cols="70" rows="10" id="contents" data-valid="notnull" data-alert="내용" required></textarea>			
											</div>			
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span6" name="link" id="link" placeholder="링크" >
											</div>
										</div> -->
										<div class="control-group">
											<label class="control-label" for="firstname">새창</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="tab" value="_blank" checked> 새창</label>
												<label class="radio inline"><input type="radio" name="tab" value="_self"> 현재창</label>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">노출</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="view" value="Y" checked> 노출</label>
												<label class="radio inline"><input type="radio" name="view" value="N"> 숨김</label>
											</div>
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">팝업</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="type" value="window" checked> 윈도우</label>
												<label class="radio inline"><input type="radio" name="type" value="layer"> 레이어</label>
											</div>
										</div> -->
                                        <input type="hidden" name="type" value="layer" />
										<div class="control-group">
											<label class="control-label" for="firstname">사이즈</label>
											<div class="controls">
												<input type="text" class="span1" name="x_size" id="x_size" placeholder="width" value="" data-valid="notnull" data-alert="사이즈_width" required >
												<input type="text" class="span1" name="y_size" id="y_size" placeholder="height" value="" data-valid="notnull" data-alert="사이즈_height" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">팝업위치</label>
											<div class="controls">
												<input type="text" class="span1" name="x_pos" id="x_pos" placeholder="x position" value="" data-valid="notnull" data-alert="팝업위치 x" required >
												<input type="text" class="span1" name="y_pos" id="y_pos" placeholder="y position" value="" data-valid="notnull" data-alert="팝업위치 y" required >
											</div>
										</div>										
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/banner" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 회원수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm" method="post" action="/proc/bannerProc">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="idx" value="<?=$idx?>">
									<input type="hidden" name="link" value="">
									<fieldset>										
										<div class="control-group">											
											<label class="control-label" for="username">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="title" id="title" placeholder="제목" value="<?=$banner[0]["title"]?>" data-valid="notnull" data-alert="제목" required >
											</div>			
										</div>
										<div class="control-group">											
											<label class="control-label" for="username">내용</label>
											<div class="controls">
												<textarea class="span6" name="contents" cols="70" rows="10" id="contents" style="width:98%" data-valid="notnull" data-alert="내용" required><?=$banner[0]["contents"]?></textarea>			
											</div>			
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">링크</label>
											<div class="controls">
												<input type="text" class="span6" name="link" id="link" placeholder="링크" value="<?=$banner[0]["link"]?>" >
											</div>
										</div> -->
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">새창</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="tab" value="_blank" <?if($banner[0]["tab"]=="_blank"){echo "checked";}?>> 새창</label>
												<label class="radio inline"><input type="radio" name="tab" value="_self" <?if($banner[0]["tab"]=="_self"){echo "checked";}?>> 현재창</label>
											</div>
										</div> -->
										<div class="control-group">
											<label class="control-label" for="firstname">노출</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="view" value="Y" <?if($banner[0]["view"]=="Y"){echo "checked";}?>> 노출</label>
												<label class="radio inline"><input type="radio" name="view" value="N" <?if($banner[0]["view"]=="N"){echo "checked";}?>> 숨김</label>
											</div>
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="firstname">팝업</label>
											<div class="controls">
												<label class="radio inline"><input type="radio" name="type" value="window" <?if($banner[0]["type"]=="window"){echo "checked";}?>> 윈도우</label>
												<label class="radio inline"><input type="radio" name="type" value="layer" <?if($banner[0]["type"]=="layer"){echo "checked";}?>> 레이어</label>
											</div>
										</div> -->
                                        <input type="hidden" name="type" value="layer" />
										<div class="control-group">
											<label class="control-label" for="firstname">사이즈</label>
											<div class="controls">
												<input type="text" class="span1" name="x_size" id="x_size" placeholder="width" value="<?=$banner[0]["x_size"]?>" data-valid="notnull" data-alert="사이즈_width" required >
												<input type="text" class="span1" name="y_size" id="y_size" placeholder="height" value="<?=$banner[0]["y_size"]?>" data-valid="notnull" data-alert="사이즈_height" required >
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">배너위치</label>
											<div class="controls">
												<input type="text" class="span1" name="x_pos" id="x_pos" placeholder="x position" value="<?=$banner[0]["x_pos"]?>" data-valid="notnull" data-alert="팝업위치 x" required >
												<input type="text" class="span1" name="y_pos" id="y_pos" placeholder="y position" value="<?=$banner[0]["y_pos"]?>" data-valid="notnull" data-alert="팝업위치 y" required >
											</div>
										</div>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/banner" class="btn btn-invert ">목록</a>
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

<script type="text/javascript" src="/assets/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
<?if($mode!=""){?>
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({ oAppRef: oEditors, elPlaceHolder: "contents", sSkinURI: "/assets/se/SmartEditor2Skin.html", fCreator: "createSEditor2"});
<?}?>
function insertMem(){
	var form = document.getElementById("insertFrm")
	var $mode = "<?=$mode?>";
	
	oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#contents').val($('#contents').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));

	var $contents = $("#contents").val();

	if (web.formValidation(form,true)){
		$contents = $("#contents").val().replace("iframe","video");
		$("#contents").val($contents);
		form.submit();
	}	
}
<?if(isset($idx)){?>
function updateMemChk(){
	var form = document.getElementById("modFrm")
	var $mode = "<?=$mode?>";
	var $idx = "<?=$idx?>";

	oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#contents').val($('#contents').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));
	var $contents = $("#contents").val();
	if (web.formValidation(form,true)){
		$contents = $("#contents").val().replace("iframe","video");
		$("#contents").val($contents);
		form.submit();
	}	
}
<?}?>
$(function(){
	$(".btn_delete_popup").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/bannerProc",data,"/<?=admmng?>/banner");			
		}
	})
})
</script>