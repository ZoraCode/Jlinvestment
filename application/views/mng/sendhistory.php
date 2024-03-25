<style>
.tdtit{background-color: #F3F3F3;}
</style>
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
							<?if(COM_YESBIT_KEY!=""){?>
							<form class="form-horizontal" name="searchFrm" id="searchFrm" method="post">
								<fieldset>
									<div class="control-group">
										<label class="control-label" for="firstname">문자발송 대상 방선택</label>
										<div class="controls">

											<select name="search_room_idx" id="search_room_idx" onchange="document.searchFrm.submit();">
												<option value="">검색할 유형을 선택해주세요.</option>
												<option value="all" <?if($search_room_idx=="all"){echo "selected";}?>>전체회원</option>
												<option value="free" <?if($search_room_idx=="free"){echo "selected";}?>>무료회원</option>
												<option value="pay" <?if($search_room_idx=="pay"){echo "selected";}?>>유료회원</option>
												<?foreach($pdt_list as $var){
												?>
												<option value="<?=$var["idx"]?>" <?if($search_room_idx==$var["idx"]){echo "selected";}?>><?=$var["pd_title"]?></option>
												<?}?>
											</select>
										</div>
									</div>
								</fieldset>
							</form>
								<table class="table table-striped table-bordered">
									<col width="10%">
									<col width="*">
									<col width="15%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<thead>
									<tr>
										<th class="text-center"></th>
										<th>메세지</th>
										<th>발송일</th>
										<th>타입</th>
										<th>총건수</th>
										<th>성공/대기/실패</th>
									</tr>
									</thead>
									<tbody>
									<?

										if(!empty($search_room_idx) && $history_list != "no result"){

										$no = count($history_list);
										foreach($history_list as $var){
									?>
									<tr class="curp detailview" data-uniqid="<?=$var->uniq_id?>" data-usedcd="<?=$var->used_cd?>">
										<td class="text-center"><?=$no?></td>
										<td><?=$var->title?></td>
										<td class="nick curp"><?=$var->senddate?></td>
										<td><?=$var->type?></td>
										<td><?=$var->total?></td>
										<td><?=$var->success?>/<?=$var->wait?>/<?=$var->fail?></td>

									</tr>
									<?
										$no--;
										}
									}else{?>
									<tr>
										<td colspan="6" class="text-center">발송내역이 없습니다.</td>
									</tr>
									<?}?>
									</tbody>
								</table>
								<!-- Modal -->
								<div id="detailPop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:800px;margin-left:-400px">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">발송내역</h3>
									</div>
									<div class="modal-body">
										<table class="table table-dark" id="tbl_detail">
											<col width="15%">
											<col width="18%">
											<col width="15%">
											<col width="18%">
											<col width="15%">
											<col width="18%">
										  <tbody>
											<tr>
											  <th class="tdtit">제목</th>
											  <td colspan="5" id="title">단문</td>
											</tr>
											<tr>
											  <th class="tdtit">내용</th>
											  <td colspan="5" id="msg">단문</td>
											</tr>
											<tr>
											  <th class="tdtit">발송일시</th>
											  <td colspan="5" id="senddate">단문</td>
											</tr>
											<!-- <tr>
											  <th class="tdtit">발신번호</th>
											  <td colspan="5" id="caller">단문</td>
											</tr> -->
											<tr>
											  <th class="tdtit">전송유형</th>
											  <td colspan="5" id="type">단문</td>
											</tr>
											<tr>
											  <th class="tdtit">총건수</th>
											  <td colspan="5" id="total">4건</td>
											</tr>
											<tr>
											  <th class="tdtit">성공</th>
											  <td id="success">1건</td>
											  <th class="tdtit">진행중</th>
											  <td id="wait">1건</td>
											  <th class="tdtit">실패</th>
											  <td id="fail">1건</td>
											</tr>
											<tr>
											  <th class="tdtit">소요캐시</th>
											  <td colspan="5" id="cash">4건</td>
											</tr>
											<tr><td colspan="6" height="1">&nbsp;</td></tr>
										  </tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
									</div>
								</div>

							<?}else{?>
								<a href="/<?=admmng?>/settings">APIKEY를 등록해주세요.</a>
							<?}?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on("click",".detailview",function(){
		var $uniq_id = $(this).data("uniqid");
		var $used_cd = $(this).data("usedcd");
		$.ajax({
			url : "/proc/getListSmsDetail",
			dataType : "text",
			method: "POST",
			data : {"uniq_id":$uniq_id,"used_cd":$used_cd},
			success : function(result) {
				// {"type":"00","title":"test","msg":"test","total":"3","success":"1","wait":"2","fail":"0","cash":"10.78","senddate":"2018.09.28 17:37","caller":"18999172"}
				if(result.length){
					result = JSON.parse(result)
					console.log(result);
					var caller =result[0].caller;
					$("#tbl_detail").find("#type").text(result[0].type);
					$("#tbl_detail").find("#title").text(result[0].title);
					$("#tbl_detail").find("#msg").text(result[0].msg);
					$("#tbl_detail").find("#total").text(result[0].total+"건");
					$("#tbl_detail").find("#success").text(result[0].success+"건");
					$("#tbl_detail").find("#wait").text(result[0].wait+"건");
					$("#tbl_detail").find("#fail").text(result[0].fail+"건");
					$("#tbl_detail").find("#cash").text(result[0].cash+"원");
					$("#tbl_detail").find("#senddate").text(result[0].senddate);
					$("#tbl_detail").find("#caller").text(result[0].caller);
					var trHtml="";
					$("#tbl_detail").find(".detail_result").remove();
					for(var i=1;i<result.length;i++){
						status = result[i].status;
						if(status=="success")status="성공";
						if(status=="ing")status="대기";
						trHtml = "<tr class='detail_result'><td class='tdtit'>수신번호</td><td>"+result[i].rno+"</td><td class='tdtit'>결과</td><td>"+status+"</td><td class='tdtit'>발송일시</td><td>"+result[i].sendtime+"</td></tr>"
						$("#tbl_detail").append(trHtml);
					}


					$("#detailPop").modal();
				}
			},
			error : function(status) {
				alert("에러가 발생하였습니다.");
			}
		});
	})
})
</script>
