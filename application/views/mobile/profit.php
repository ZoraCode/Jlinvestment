<style>
.tbl_board{margin-bottom: 20px;}
.input_txt{width: 100%;box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 33px;}
.tbl_board td:nth-child(1){border-right: 0;}
.tbl_board tr td .subject{white-space: pre-wrap;;word-wrap: normal;overflow: hidden; text-overflow: ellipsis;}

.profit_layer{width: 100%;display: inline-block;}
.profit_layer li{width:240px;height:335px;float:left;border:1px solid #ccc;margin-right:20px;margin-bottom: 20px;cursor:pointer;box-sizing:border-box;}
.profit_layer li:nth-child(3n){margin-right:0;}
.profit_layer li .img_layer{width:240px;height:191px;overflow:hidden;position:relative;background-color:#d4d4d4;}
.profit_layer li .img_layer img{width:100%;position:absolute;left:0;right:0;top:0;bottom:0;margin:auto;}
.profit_layer li .review_contents_layer{padding: 12px;height: 144px;box-sizing: border-box;}
.profit_layer li .review_contents_layer p.title{font-weight: 600;border-bottom: 1px solid #ccc;padding-bottom: 0;display: inline-block;width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: normal;line-height: 23px;height: 3em;}
.profit_layer li .review_contents_layer p.name{margin-top: 12px;margin-bottom: 12px;}
.profit_layer li .review_contents_layer .review_contents{display: inline-block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; white-space: normal; line-height: 1.2; height: 4.6em;}
.btn_comm4{background-color: #433e54;color: #fff;padding: 13px 21px;font-size: 24px;border: 0;}
</style>
	<?if($mode == "write"){?>
		<div class="inner board_wrap pb100 pt80">
		<h1 class="board_title"><?=$t2?></h1>
			<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/boardProc">
			<table class="tbl_board tbl_view " cellspacing="0" cellpadding="0" border="0" width="100%">
				<input type="hidden" name="mode" value="write">
				<input type="hidden" name="category" value="<?=$pn?>">
				<col width="200px">
				<col width="*">
				<tr class="thead">
					<th>제목</th>
					<td><input type="text" class="input_txt" name="subject" id="subject" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required></td>
				</tr>
				<tr class="thead">
					<th>내용</th>
					<td><textarea name="contents" id="contents" cols="30" rows="10" class="input_txt" data-valid="notnull" data-alert="내용" required></textarea></td>
				</tr>
				<tr class="thead">
					<th>첨부파일</th>
					<td>
						<input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일" data-valid="notnull" data-alert="첨부파일" required>
						<p class="help-block">※ 첨부파일 최대용량 10M , size : 1024 x 1024 </p>
					</td>
				</tr>
			</table>
			<div class="btn_layer ma0 text-center">
				<button type="button" class="btn_comm mt30 btn_apply" onclick="insertMem();">등록</button>
				<a href="/<?=$pn?>"><button type="button" class="btn_comm4 mt30 btn_cancle">취소</button></a>
			</div>
			</form>
		</div>
	<?}elseif($mode=="update"){?>
		<div class="inner board_wrap pb100">
			<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/boardProc">
			<table class="tbl_board tbl_view " cellspacing="0" cellpadding="0" border="0" width="100%">
				<input type="hidden" name="idx" value="<?=$idx?>">
				<input type="hidden" name="mode" value="update">
				<input type="hidden" name="category" value="<?=$pn?>">
				<input type="hidden" name="filedel" id="filedel" value="N">
				<col width="200px">
				<col width="*">
				<tr class="thead">
					<th>제목</th>
					<td><input type="text" class="input_txt" name="subject" id="subject" placeholder="제목" value="<?=$lists[0]['subject']?>" data-valid="notnull" data-alert="제목" required></td>
				</tr>
				<tr class="thead">
					<th>내용</th>
					<td><textarea name="contents" id="contents" cols="30" rows="10" class="input_txt" data-valid="notnull" data-alert="내용" required><?=strip_tags(str_replace("<br>","\r\n",$lists[0]['contents']))?></textarea></td>
				</tr>
				<tr class="thead">
					<th>첨부파일</th>
					<td>
						<input type="file" class="span6" name="upfile" id="upfile" data-valid="notnull" data-alert="첨부파일" placeholder="첨부파일" required>
						<?if(isset($notice[0]["upfile"])){?>
							<button type="button" class="btn_comm pull-right" id="removeFile">첨부파일 삭제</button>
							<img src="/upload/board/<?=$pn?>/<?=$lists[0]['upfile']?>" class="attach_file pull-right" style="height:44px;margin:0 10px" alt="">
						<?}?>
						<p class="help-block">※ 첨부파일 최대용량 10M , size : 1024 x 1024 </p>
					</td>
				</tr>
			</table>
			<div class="btn_layer ma0 text-center">
				<button type="button" class="btn_comm mt30 btn_apply" onclick="insertMem();">수정</button>
				<a href="/<?=$pn?>/<?=$page?>/<?=$idx?>"><button type="button" class="btn_comm4 mt30 btn_cancle">취소</button></a>
			</div>
			</form>
		</div>
	<?}else{?>
		<div class="profit_layer mb100">
			<div class="inner board_wrap" style="height:auto;">
				<div class="mb100"></div>
				<!-- <div class="mb100">
					<?if(!empty($payresult)){?>
					<div>
						<a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/<?=$pn?>?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><button class="btn_comm pull-right">인증샷 올리기</button></a>
					</div>
					<?}?>
				</div> -->
				<?if($idx){?>
				<table class="tbl_board tbl_view mt50 mb20" cellspacing="0" cellpadding="0" border="0" style="border-top:0;">
					<tr>
						<td class="text-left"><div class="subject"><?=$lists[0]['subject']?></div></td>
						<td class="text-right"><?=$lists[0]['writer_name']?></td>
					</tr>
					<tr>
						<td colspan="2" class="text-right" style="border-bottom:0">조회:<?=$lists[0]['hit']?>, 작성일:<?=$lists[0]['reg_ymd']?></td>
					</tr>
<style>
.profit_contents td{text-align: inherit !important;}
.profit_contents p img{max-width: 100%;}
</style>
					<tr class="profit_contents">
						<td colspan="2" style="padding-bottom:50px !important;">
							<?if($lists[0]['upfile'] <> ""){ ?>
								<!-- <img src="/upload/board/<?=$pn?>/<?=$lists[0]['upfile']?>" class="m0a mb30" style="max-width: 100%;" alt=""> -->
								<?if(strpos($lists[0]['upfile'],"https://") === false){ ?>
                                    <img src="/upload/board/<?=$pn?>/<?=$lists[0]['upfile']?>" class="m0a mb30" style="max-width: 100%;" alt="">
                                <?}else{?>
                                    <img src="<?=$lists[0]['upfile']?>" class="m0a mb30" style="max-width: 100%;" alt="">
                                <?}?>
							<?}?>
							<?=str_replace("\r\n","<br>",$lists[0]['contents'])?>
						</td>
					</tr>


					<tr class="lst">
						<td class="">
						<?if($this->session->userdata(DB_PREFIX.'id') == $lists[0]['writer_id']){?>
							<a href="/<?=$pn?>/<?=$page?>/<?=$idx?>?mode=update"><button type="button" class="btn_comm btn_modify pull-left mr10 pl40 pr40">수정</button></a>
							<button type="button" class="btn_comm4 btn_delete pull-left pl40 pr40" data-idx="<?=$lists[0]['idx']?>">삭제</button>
						<?}else{?>
							&nbsp;
						<?}?>
						</td>
						<td ><a href="/<?=$pn?>" class="pull-right"><button class="btn_comm">목록으로</button></a></td>
					</tr>
				</table>
				<?}?>
				<ul class="profit_layer mt40">
					<?if(count($notice)){
						foreach($notice as $var){
					?>
					<li onclick="javascript:location.href='/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>'">
						<div class="img_layer">
						<?if($var['upfile'] <> ""){ ?>
							<!-- <img src="/upload/board/<?=$pn?>/<?=$var['upfile']?>" alt=""> -->
							<?if(strpos($var['upfile'],"https://") === false){ ?>
								<img src="/upload/board/<?=$pn?>/<?=$var['upfile']?>" alt="">
							<?}else{?>
								<img src="<?=$var['upfile']?>" alt="">
							<?}?>
						<?}else{?>
							<img src="/images/common/review_dummy.png" alt="">
						<?}?>
						</div>
						<div class="review_contents_layer ">
							<p class="title <?if(!empty($idx) and $idx==$var["idx"]){echo "cred";}?>"><?=$var["subject"]?></p>
							<p class="name">작성자 : <?=$var["writer_name"]?></p>
							<p class="date pull-left"><?=$var["reg_ymd"]?></p>
							<p class="hit pull-right">조회수 : <?=$var["hit"]?></p>

						</div>
					</li>
					<?
						$no--;
						}
					}

					if(!count($noticelist) and !count($notice)){
					?>
					<li style="width: 100%;border: 0;margin: 0;padding: 0;height: auto;text-align: center;">등록된 글이 없습니다.</li>
					<?}?>
				</ul>
				<div class="paging"><?=$pages?></div>

			</div>
		</div>
	<?}?>
<script>
function insertMem(){

	var form = document.getElementById("insertFrm");
	if (web.formValidation(form,true)){
		form.submit();
	}
}
<?if($this->session->userdata(DB_PREFIX.'id') == $lists[0]['writer_id']){?>
function ajaxProcess(url,data,redirect){
	var rst;
	$.ajax({
		url : url,
		dataType : "text",
		method: "POST",
		data : data,
		success : function(result) {
			if(result=="success"){
				alert("정상적으로 처리되었습니다.");
				if(redirect==""){
					location.href = location.href;
				}else{
					location.href = redirect;
				}
			}else{
				alert(result);
			}
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
	return rst;
}
$(function(){
	$(".btn_delete").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx,"category":"<?=$pn?>"}
			ajaxProcess("/proc/boardProc",data,"/<?=$pn?>");
		}
	})
	$("#removeFile").click(function(){
		$(".attach_file").remove();
		$("#upfile").val("");
		$("#filedel").val("Y");

	})
})
<?}?>
</script>
