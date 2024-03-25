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
									<div class=" pull-right">
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
								<col width="5%">
                                <?if($pn=="payclass"){?>
                                <col width="7%">
                                <?}?>
								<col width="*">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">#</th>
                                    <?if($pn=="payclass"){?>
                                    <th class="text-center">게시글 번호</th>
                                    <?}?>
									<th>제목</th>
									<th>등록일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?
									foreach($noticelist as $var){
										$is_notice = $var["is_notice"] == "Y" ? "[공지]" : "";
								?>
								<tr class="curp">
									<td class="text-center">&nbsp;</td>
									<td onclick="javascript:location.href='/<?=admmng?>/<?=$pn?>?mode=update&idx=<?=$var["idx"]?>'"><?=hc($is_notice.$var["subject"],60)?></td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_notice" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?}?>
								<?if(count($notice)){
									foreach($notice as $var){
										$is_notice = $var["is_notice"] == "Y" ? "[공지]" : "";
								?>
								<tr class="curp">
									<td class="text-center"><?=$no?></td>
                                    <?if($pn=="payclass"){?>
                                        <td class="text-center"><?=$var["idx"]?></td>
                                    <?}?>
									<td onclick="javascript:location.href='/<?=admmng?>/<?=$pn?>?mode=update&idx=<?=$var["idx"]?>'"><?=hc($is_notice.$var["subject"],60)?></td>
									<td><?=$var["reg_ymd"]?></td>

									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_notice" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>

								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="4" class="text-center">등록된 글이 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="location.href='/<?=admmng?>/<?=$pn?>?mode=write'">생성</button>
							</div>
							<?}elseif($mode=="write"){ // 공지등록?>
								<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/boardProc">
									<input type="hidden" name="category" value="<?=$pn?>">
									<input type="hidden" name="mode" value="<?=$mode?>">

									<fieldset>
										<?if($t2 == "공지사항"){?>
											<?if($pn!="payclass"){?>
												<div class="control-group">
													<label class="control-label" for="firstname">공지</label>
													<div class="controls">
														<input type="checkbox" name="is_notice" id="is_notice" value="Y">
													</div>
												</div>
											<?}?>
										<?}?>
										<div class="control-group">
											<label class="control-label" for="firstname">작성자</label>
											<div class="controls">
												<input type="text" class="span6" name="writer_name" id="writer_name" placeholder="작성자" value="<?=$this->session->userdata('sess_name')?>" data-valid="notnull" data-alert="작성자" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="subject" id="subject" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required>
											</div>
										</div>
										<?if($pn=="interview" || $pn=="payclass"){?>
										<div class="control-group">
											<label class="control-label" for="firstname">영상 링크</label>
											<div class="controls">
												<input type="text" class="span6" name="etc1" id="etc1" value="" data-alert="영상 링크" required>
												<?if ($pn=="interview") {?>
													<a href="#" id="modal_btn" data-toggle="modal" data-target="#link"><img src="/images/contents/board/question_mark.png" alt=""></a>
												<?}?>
											</div>
										</div>
										<?}?>
										<div class="control-group">
											<label class="control-label" for="firstname">내용</label>
											<div class="controls">
												<textarea class="span6" name="contents" cols="70" rows="10" id="contents" style="width:98%" data-valid="notnull" data-alert="내용" required></textarea>
											</div>
										</div>
										<?if($pn!="faq"){?>
										<div class="control-group">
											<?if($pn!="interview" && $pn!="payclass"){?>
												<label class="control-label" for="firstname">첨부파일 </label>
											<?} else{?>
												<label class="control-label" for="firstname">썸네일 </label>
											<?}?>
											<div class="controls">
												<input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일" <?if($pn=="profit" || $pn=="interview" || $pn=="payclass"){?>data-valid="notnull" data-alert="첨부파일" required<?}?>>
												<button type="button" class="btn btn-danger" id="removeFile">첨부파일 삭제</button>
												<p class="help-block">※ 첨부파일 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>
										<?}?>
										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="insertMem();">등록</button>
											<a href="/<?=admmng?>/<?=$pn?>" class="btn btn-invert ">목록</a>
										</div>
									</fieldset>
								</form>
							<?}elseif($mode=="update"){ // 공지수정?>
								<form class="form-horizontal" name="modFrm" id="modFrm" method="post" enctype="multipart/form-data" action="/proc/boardProc">
									<input type="hidden" name="category" value="<?=$pn?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="idx" value="<?=$idx?>">
									<input type="hidden" name="filedel" id="filedel" value="N">
									<fieldset>
										<?if($pn!="payclass"){?>
											<div class="control-group">
												<label class="control-label" for="firstname">공지</label>
												<div class="controls">
													<input type="checkbox" name="is_notice" id="is_notice" value="Y" <?if($notice[0]["is_notice"]=="Y"){echo "checked";}?>>
												</div>
											</div>
										<?}?>
										<div class="control-group">
											<label class="control-label" for="firstname">작성자</label>
											<div class="controls">
												<input type="text" class="span6" name="writer_name" id="writer_name" placeholder="작성자" value="<?=$notice[0]["writer_name"]?>" data-valid="notnull" data-alert="작성자" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="firstname">제목</label>
											<div class="controls">
												<input type="text" class="span6" name="subject" id="subject" placeholder="제목" value="<?=$notice[0]["subject"]?>" data-valid="notnull" data-alert="제목" required>
											</div>
										</div>
										<?if($pn=="interview" || $pn=="payclass"){?>
										<div class="control-group">
											<label class="control-label" for="firstname">영상 링크</label>
											<div class="controls">
												<input type="text" class="span6" name="etc1" id="etc1" value="<?=$notice[0]["etc1"]?>" data-alert="영상 링크" required>
												<?if ($pn=="interview") {?>
													<a href="#" id="modal_btn" data-toggle="modal" data-target="#link"><img src="/images/contents/board/question_mark.png" alt=""></a>
												<?}?>
											</div>
										</div>
										<?}?>
										<div class="control-group">
											<label class="control-label" for="firstname">내용</label>
											<div class="controls">
												<textarea class="span6" name="contents" cols="70" rows="10" id="contents" style="width:98%" data-valid="notnull" data-alert="내용" required><?=str_replace("\r\n","<br>",$notice[0]["contents"])?></textarea>
											</div>
										</div>
										<div class="control-group">
											<?if($pn!="interview" && $pn!="payclass"){?>
												<label class="control-label" for="firstname">첨부파일</label>
											<?} else {?>
												<label class="control-label" for="firstname">썸네일</label>
											<?}?>
											<div class="controls">
												<?if(isset($notice[0]["upfile"])){?>
												<a href="/attach/<?=$pn?>/down/<?=$idx?>" class="attach_file"><?=$notice[0]["upfile"]?></a><br>
												<?}?>
												<!-- <input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일" <?if($pn=="profit" || $pn=="interview" || $pn=="payclass"){?>data-valid="notnull" data-alert="첨부파일" required<?}?>> -->
												<input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일" onchange="upfile_del_chk();">
												<button type="button" class="btn btn-danger" id="removeFile">첨부파일 삭제</button>
												<p class="help-block">※ 첨부파일 최대용량 10M , size : 1024 x 1024 </p>
											</div>
										</div>

										<div class="form-actions">
											<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateMemChk();">수정</button>
											<a href="/<?=admmng?>/<?=$pn?>" class="btn btn-invert ">목록</a>
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
<style>
	.modal{width: 1100px;}
	/* .modal.fade.in {top: 35%;} */
	.modal-header{display: flex; justify-content: space-between;align-items: center;}
	#myModalLabel{display: inline-block; line-height: 32px;}
	.modal-footer .btn, .modal-header .btn{padding: 0 20px; border: 1px solid #000; border-radius: 0;}
	.modal-header .btn {padding: 0 10px;}
	.modal-body {max-height: 610px;}
	.modal-body .control-group {margin-bottom: 0;}
</style>
<div id="link" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel">영상 링크 첨부하는 방법</h3>
		<button class="btn" data-dismiss="modal" aria-hidden="true">X</button>
		<!-- <img src="/images/modal/btn_close_off.png" alt=""> -->
	</div>
	<div class="modal-body">
		<div class="control-group" style="height:610px;overflow: auto;line-height:22px">
			<img src="/images/contents/board/popup.png" alt="" style="margin:0 auto; display:block;">
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
		<!-- <img src="/images/modal/btn_exit_off.png" alt=""> -->
	</div>
</div>
<script type="text/javascript" src="/assets/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
$("#modal_btn").click(function(){
	$("#link").css({
		'margin-top':function(){
			return - ($(this).height() / 2);
		},
		'margin-left':function(){
			return - ($(this).width() / 2);
		}
	})
})

<?if($mode!=""){?>
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({ oAppRef: oEditors, elPlaceHolder: "contents", sSkinURI: "/assets/se/SmartEditor2Skin.html", fCreator: "createSEditor2"});
<?}?>

function insertMem(){
	var form = document.getElementById("insertFrm")

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
	oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#contents').val($('#contents').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));
	var $contents = $("#contents").val();
	if (web.formValidation(form,true)){
		$contents = $("#contents").val().replace("iframe","video");
		$("#contents").val($contents);
		form.submit();
	}
}
function upfile_del_chk(){
	if($('#filedel').val() == "Y")
	{
		$('#filedel').val("N");
	}
}
<?}?>
$(function(){
	$(".btn_delete_notice").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx,"category":"<?=$pn?>"}
			ajaxProcess("/proc/boardProc",data,"/<?=admmng?>/<?=$pn?>");
		}
	})
	$("#removeFile").click(function(){
		$(".attach_file").remove();
		$("#upfile").val("");
		$("#filedel").val("Y");

		$("#upfile").attr('data-valid','notnull');
		$("#upfile").attr('data-alert','첨부파일');
		$("#upfile").attr('required', true);
	})
})
</script>
