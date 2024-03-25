<style>
.tbl_board{margin-bottom: 20px;}
.input_txt{width: 100%;box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 33px;}
.tbl_board tr td{border-right: 0;}
.tbl_board tr td:nth-child(1){padding: 10px 0 !important;}
.tbl_board tr td:nth-child(2){padding-left: 50px;}
.tbl_board tr td .thumb_layer{padding: 9px 0 !important;overflow:hidden;position: relative;height: 204px;width: 249px;background-color: #d4d4d4;}
.tbl_board tr td .thumb_layer img{width: 100%;position: absolute;left: 0;right: 0;top:0;bottom:0;margin: auto;}
.tbl_board tr td .subject{white-space: nowrap;word-wrap: normal;overflow: hidden;width: 900px;text-overflow: ellipsis;}
.review_contents_layer p.name{font-weight: 600;}
.review_contents_layer p.title{font-weight: 600;white-space: nowrap;word-wrap: normal;overflow: hidden;width: 780px;text-overflow: ellipsis;}
.review_contents_layer .review_contents{display: inline-block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; white-space: normal;line-height: 1.6; }
.pb1{padding-bottom: 1px;}
#wrapper .nonHeight{height: auto !important;}
.list_btn{
	width: 200px;
	height: 44px;
	background-color: #bd0f18;
	color: #fff;
	font-size: 14px;
	border: 0;
	border-radius: 10px;
	}
</style>
	<?if($mode == "write"){
		if(!$this->session->userdata(DB_PREFIX.'idx')){
			error_move("로그인이 필요한 페이지입니다.","/login");
		}
	?>
		<div class="inner pb100 pt80">
		<h1 class="board_title"><?=$t2?></h1>
			<form class="form-horizontal" name="insertFrm" id="insertFrm" method="post" enctype="multipart/form-data" action="/proc/boardProc">
			<table class="tbl_board tbl_view " cellspacing="0" cellpadding="0" border="0" width="100%">
				<input type="hidden" name="mode" value="write">
				<input type="hidden" name="category" value="<?=$pn?>">
				<col width="200px">
				<col width="*">
				<tr class="thead">
					<th>제목</th>
					<td><input type="text" class="input_txt form-control" name="subject" id="subject" placeholder="제목" value="" data-valid="notnull" data-alert="제목" required></td>
				</tr>
				<tr class="thead">
					<th>내용</th>
					<td><textarea name="contents" id="contents" cols="30" rows="10" class="input_txt" data-valid="notnull" data-alert="내용" required></textarea></td>
				</tr>
				<tr class="thead">
					<th>첨부파일</th>
					<td>
						<input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일">
						<p class="help-block">※ 첨부파일 최대용량 10M , size : 1024 x 1024 </p>
					</td>
				</tr>
			</table>
			<div class="btn_layer ma0 text-center">
				<button type="button" class="btn_comm mt30 btn_apply" onclick="insertMem();">등록</button>
				<a href="/<?=$pn?>"><button type="button" class="btn_comm2 mt30 btn_cancle">취소</button></a>
			</div>
			</form>
		</div>

	<?}elseif($mode=="update"){?>
		<div class="inner pb100 pt80 nonHeight">
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
						<input type="file" class="span6" name="upfile" id="upfile" placeholder="첨부파일">
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
				<a href="/<?=$pn?>/<?=$page?>/<?=$idx?>"><button type="button" class="btn_comm2 mt30 btn_cancle">취소</button></a>
			</div>
			</form>
		</div>
	<?}else{?>

		<div class="inner nonHeight">
			<div class="mt100 mb100 pb1"></div>
			<!-- <div class="mt100 mb100 pb1">
				<?if(!empty($payresult)){?>
				<div>
					<a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/<?=$pn?>?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><button class="btn_comm pull-right">이용 후기 올리기</button></a>
				</div>
				<?}?>
			</div> -->
			<?if($idx){?>

			<table class="tbl_board tbl_view mt50 mb20" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-top:0;">

				<tr>
					<!-- <td class="text-left"><div class="subject"><?=$lists[0]['subject']?></div></td> -->
                    <td class="text-left"><div class="subject"><?=nl2br(unescape_web_txt($lists[0]['subject']))?></div></td>
					<td class="text-right"><?=$lists[0]['writer_name']?></td>
				</tr>
				<tr>
					<td colspan="2" class="text-right" style="border-bottom:0">조회:<?=$lists[0]['hit']?>, 작성일:<?=$lists[0]['reg_ymd']?></td>
				</tr>
<style>
.review_contents p img{max-width: 100%;}
</style>
				<tr class="review_contents">
					<td colspan="2" style="padding-bottom:50px !important;text-align: initial;">
						<?if($lists[0]['upfile'] <> ""){ ?>
							<img src="/upload/board/<?=$pn?>/<?=$lists[0]['upfile']?>" class="m0a mb30" alt="">
						<?}?>
						<!-- <?=str_replace("\r\n","<br>",$lists[0]['contents'])?> -->
                        <?=nl2br(unescape_web_txt($lists[0]['contents']))?>
					</td>
				</tr>


				<tr class="lst">
					<td class="">
						<?if($this->session->userdata(DB_PREFIX.'id') == $lists[0]['writer_id']){?>
							<a href="/<?=$pn?>/<?=$page?>/<?=$idx?>?mode=update"><button type="button" class="btn_comm btn_modify pull-left mr10 pl40 pr40">수정</button></a>
							<button type="button" class="btn_comm3 btn_delete pull-left pl40 pr40" data-idx="<?=$lists[0]['idx']?>">삭제</button>
						<?}else{?>
							&nbsp;
						<?}?>
					</td>
					<td ><a href="/<?=$pn?>" class="pull-right"><button class="list_btn">목록으로</button></a></td>
				</tr>
			</table>
			<?}?>

			<table class="tbl_board mt10" cellspacing="0" cellpadding="0" border="0" width="100%">
				 <col width="85px">
					<col width="*">
					<col width="120px">
					<col width="85px">
					<tbody>
					<tr class="thead">
						<th>No</th>
						<th>제목</th>
						<th>작성일</th>
						<th>작성자</th>
						<!--<th>조회수</th>-->
					</tr>
				<?if(count($notice)){
					foreach($notice as $var){
				?>
				<tr class="curp" onclick="javascript:location.href='/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>'">
					<td><?=$no?></td>
						<!-- <td class="title"><a href="/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>"><?=$var["subject"]?></a></td> -->
                        <td class="title"><a href="/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>"><?=nl2br(unescape_web_txt($var["subject"]))?></a></td>
						<td><?=$var["reg_ymd"]?></td>
						 <td><?=$var["writer_name"]?></td>

						<!--<td><?=$var["hit"]?></td>-->
				</tr>
				<?
					$no--;
					}
				}
				if(!count($noticelist) and !count($notice)){
				?>
				<tr>
					<td colspan="5" class="text-center">등록된 글이 없습니다.</td>
				</tr>
				<?}?>

				<tr class="lst">
					<td colspan="5">
						<div class="paging"><?=$pages?></div>

					</td>
				</tr>
			    </tbody>
			</table>
		</div>
	<?}?>
<script type="text/javascript">
function insertMem(){
	var form = document.getElementById("insertFrm")
	if (web.formValidation(form,true)){
		form.submit();
	}
}

</script>
<script>

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
