<link href="<?=base_url('assets/css/datepicker3.css')?>" rel="stylesheet">
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
								<input type="hidden" name="mode" id="mode">
								<div class="control-group">
									<div class="input-append date pull-right">
										<select name="paging" id="paging" class="span1" onchange="document.searchFrm.submit();">
											<option value="">목록수</option>
											<option value="10" <?if($paging=="10"){echo "selected";}?>>10</option>
											<option value="20" <?if($paging=="20"){echo "selected";}?>>20</option>
											<option value="50" <?if($paging=="50"){echo "selected";}?>>50</option>
											<option value="100" <?if($paging=="100"){echo "selected";}?>>100</option>
										</select>
										<input class="span2 m-wrap" name="startdate" id="startdate" type="text" placeholder="시작일" value="<?=$startdate?>"> ~ <input class="span2 m-wrap" name="enddate" id="enddate" type="text" placeholder="종료일" value="<?=$enddate?>">
										<input class="m-wrap" name="searchStr" id="searchStr" type="text" value="<?=$searchStr?>" placeholder="이름 or 전화번호 검색">
										<button class="btn btn-danger" type="button" onclick="document.searchFrm.submit();">검색</button>
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<col width="*">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">#</th>
									<th>이름</th>
									<th>전화번호</th>
									<th>투자금 / 상담분야 / 제3자동의</th>
									<th>등록일</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($apply)){
									foreach($apply as $var){
										$agree3 = $var["agree3"];
								?>
								<tr>
									<td class="text-center"><?=$no?></td>
									<td><?=$var["name"]?></td>
									<td><?=$var["tel"]?></td>
									<td>
										<?=$var["price"]?> / <?=$var["category"]?> / <?=$agree3?>
										<?if($var["etc"]){?>
										<br><hr>
										<b>기타문의: </b><?=$var["etc"]?>
										<?}?>
									</td>
									<td><?=$var["reg_ymd"]?></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_apply" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="6" class="text-center">등록된 신청이 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
							<div class="paging"><?=$pages?></div>
							<?if(count($apply)){?>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="excel();">엑셀다운</button>
							</div>
							<?}?>
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
<script type="text/javascript">
function excel(){
	var form = document.getElementById("searchFrm");
	form.mode.value="excel";
	form.action = "/<?=admmng?>/applyexceldown";
	form.submit();
	form.mode.value="";
	form.action = "";
	//location.href = location.href;
}
$(function(){
	$('#startdate,#enddate').datepicker({
		format: "yyyy-mm-dd",
		language: "kr"
	});
	$(".btn_delete_apply").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/applyDelProc",data,"/<?=admmng?>/apply");			
		}
	})
})
</script>