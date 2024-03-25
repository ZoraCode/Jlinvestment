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
										<input class="m-wrap" name="searchStr" id="searchStr" type="text" value="<?=$searchStr?>" placeholder="아이디를 입력해 주세요.">
										<button class="btn btn-danger" type="button" onclick="document.searchFrm.submit();">검색</button>
									</div>
								</div>
							</form>
                            <form class="form-horizontal" name="contentFrm" id="contentFrm">
							<table class="table table-striped table-bordered">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<!-- <col width="*"> -->
								<col width="*">
								<!-- <col width="10%"> -->
								<thead>
								<tr>
									<!-- <th class="text-center">#</th> -->
									<th class="text-center"><input type="checkbox" class="btn_check btn_check_group">No</th>
									<th>아이디</th>
									<th>게시글 번호</th>
									<!-- <th>투자금 / 상담분야 / 제3자동의</th> -->
									<th>제목</th>
									<!-- <th class="td-actions"></th> -->
								</tr>
								</thead>
								<tbody>
								<?if(count($pay_contents_list)){
									foreach($pay_contents_list as $var){
								?>
								<tr>
									<!-- <td class="text-center"><?=$no?></td> -->
									<td class="text-center"><input type="checkbox" class="btn_check" name="paycontentslist" data-idx="<?=$var["idx"]?>" value="<?=$var["idx"]?>"><?=$no?></td>
									<!-- <td class="text-center"><input type="checkbox" class="btn_check" name="paycontentslist[]" data-idx="<?=$var["idx"]?>" value="<?=$var["idx"]?>"><?=$no?></td> -->
									<td><?=$var["mb_id"]?></td>
									<td><?=$var["bd_idx"]?></td>
									<td><?=$var["subject"]?></td>

									<!-- <td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_paycontentslist" data-idx="<?=$var["idx"]?>"><i class="btn-icon-only icon-remove"></i></a>
									</td> -->
								</tr>
								<?
									$no--;
									}
								}else{?>
								<tr>
									<td colspan="6" class="text-center">검색된 결과가 없습니다.</td>
								</tr>
								<?}?>
								</tbody>
							</table>
                            </form>
							<div class="paging"><?=$pages?></div>
							<a href="javascript:void(0);" onclick="paycontents_list_del();" class="btn btn-danger pull-left mlr5" data-idx="<?=$var["idx"]?>">권한 일괄 삭제</a>
							<a href="#excelDump" role="button" class="btn btn-success pull-left mlr5" data-toggle="modal" id="btnExcelDump">유료강의 권한 부여</a>
							<?//if(count($pay_contents_list)){?>
							<!-- <div class="form-actions"> -->
								<!-- <a href="#memMod" role="button" class="btn btn-success pull-left mlr5" data-toggle="modal" id="btnAllMod">일괄수정</a> -->
								<!-- <button type="button" class="btn btn-success pull-left mlr5" id="btnModify" onclick="excel();">일괄삭제sss</button> -->
								<!-- <a href="javascript:void(0);" class="btn btn-danger pull-left mlr5 btn_delete_paycontentslist" data-idx="<?=$var["idx"]?>">권한 일괄 삭제</a> -->
								<!-- <a href="#excelDump" role="button" class="btn btn-success pull-left mlr5" data-toggle="modal" id="btnExcelDump">유료강의 권한 부여</a> -->
								<!-- <button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="excel();">엑셀다운</button> -->
							<!-- </div> -->
							<?//}?>

							<!-- Modal -->
							<div id="excelDump" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">유료강의 등록/수정</h3>
								</div>
								<form class="form-horizontal" name="excelFrm" id="excelFrm" action="/proc/paidContentExcel" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="control-group">
										<label class="control-label" for="firstname">파일업로드</label>
										<div class="controls">
											 <input type="file" name="file" id="file" accept=".xls,.xlsx" placeholder="엑셀파일" data-valid="notnull" data-alert="파일업로드" required>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<a href="/upload/member_PaidContent_example.xlsx" target="_blank" class="pull-left btn btn-success">예제 다운</a>
									<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
									<button class="btn btn-primary" type="submit" name="import" id="btnSubmitExcel">등록</button>
								</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

function paycontents_list_del(){

	var cidx = new Array();
	if(confirm("삭제하시겠습니까?")){
		$("input[name='paycontentslist'][type='checkbox']:checked").each(function(i,e){
			var $this_idx=$(this).data("idx");
			cidx.push($this_idx);
		});
		if(cidx.length <= 0)
	    {
	        alert("권한을 삭제할 항목을 선택해 주세요.");
	        return;
	    }
		data={cidx:cidx};
		ajaxProcess("/proc/paycontentslistDelProc",data,"/<?=admmng?>/paycontentslist");
	}

}
$(function(){
	// $(".btn_delete_paycontentslist").click(function(){
	// 	var $this_idx = $(this).data("idx");
	// 	if(confirm("삭제하시겠습니까?")){
    //         data={mode:"delete",idx:$this_idx}
    //         // data = $("#contentFrm").serializeArray();
	// 		ajaxProcess("/proc/paycontentslistDelProc",data,"/<?=admmng?>/paycontentslist");
	// 	}
	// })

	// $("input[name='paycontentslist'][type='checkbox']").change(function(){
	// 	paycontents_list_del();
	// });
	$(".btn_check_group").click(function(){
		var $is_checked = $(this).is(":checked");
		$(this).closest("table").find("input[name='paycontentslist'][type='checkbox']").prop("checked",$is_checked);
	})
})
</script>
