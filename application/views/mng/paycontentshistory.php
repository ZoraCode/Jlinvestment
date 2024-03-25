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
							<table class="table table-striped table-bordered">
								<col width="5%">
								<col width="8%">
								<col width="8%">
								<col width="*">
								<col width="10%">
								<col width="15%">
								<thead>
								<tr>
									<!-- <th class="text-center">#</th> -->
									<th class="text-center">NO</th>
									<th>아이디</th>
									<th>게시글 번호</th>
                                    <th>제목</th>
									<th>IP</th>
                                    <th>열람일</th>
									<!-- <th class="td-actions"></th> -->
								</tr>
								</thead>
								<tbody>
								<?if(count($pay_contents_log)){
									foreach($pay_contents_log as $var){
										// $agree3 = $var["agree3"];
								?>
								<tr>
									<!-- <td class="text-center"><?=$no?></td> -->
									<td class="text-center"><?=$no?></td>
									<td><?=$var["mb_id"]?></td>
									<td><?=$var["bd_idx"]?></td>
                                    <td><?=$var["bd_subject"]?></td>
									<td><?=$var["reg_ip"]?></td>
                                    <td><?=$var["reg_ymd"]?></td>
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
							<div class="paging"><?=$pages?></div>
							<!-- <?if(count($pay_contents_log)){?>
							<div class="form-actions">
								<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="excel();">엑셀다운</button>
							</div>
							<?}?> -->


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
