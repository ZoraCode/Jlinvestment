
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
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                      <th>결제번호</th>
                      <th>회원아이디</th>
                      <th>상품명</th>
                      <th>결제금액</th>
                      <th>결제일</th>
                      <th>상태</th>
                      <!-- <th>결제방법</th> -->
											<th>기능</th>
                    </tr>
                  </thead>
                  <tbody>
									<?

									foreach($paymenthistory as $var){
									$pd_title = $var["price"];
									$method = $var["pay_method"];
									$status = $var["pay_status"];
									$type_txt = "";

									switch($method){
										case "online" : $method = "무통장";break;
										case "card" : $method = "카드";break;
										default:break;
									}
									switch($status){
										case "READY" : $status = "결제대기";break;
										case "OK" : $status = "결제완료";break;
										default:break;
									}
									switch($pd_title){
										case 770000   : $pd_title = "VIP서비스";break;
										case 20000000 : $pd_title = "VVIP서비스";break;
										case 3500000  : $pd_title = "VIP선물";break;
										default:break;
									}
									?>
                  <tr data-orderno="<?=$var["orderno"]?>">
                      <td><b><span class="text-red"></span></b><?=$var["orderno"]?></td>
                      <td>
												<a href="/_jl/members?mode=update&idx=<?=$var['mb_idx']?>"><?=$var["mb_id"]?>(<?=$var["mb_name"]?>)</a>
											</td>
                      <td class="center"><?=$pd_title?></td>
                      <td class="center"><?=number_format($var["total_price"],0)?>원</td>
                      <td class="center"><?=$var["reg_dt"]?></td>
                      <td class="center"><?=$status?></td>
                      <!-- <td class="center"><?=$method?></td> -->
                      <td class="center">
												<button class="btn btn-danger btn_delete">삭제</button>
												<?if($var["pay_status"]=="READY"){?>
												<button class="btn btn-primary btn_status_proc">승인</button>
												<?}?>
											</td>
                  </tr>
									<?}?>
                </tbody>
							</table>
							<div class="paging"><?=$pages?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(".btn_status_proc").click(function(){
		var $thisOrderno = $(this).closest("tr").data("orderno");
		data={
			type:'apply',
			orderno:$thisOrderno
		}
		if($thisOrderno && confirm("해당건에 대해 결제완료처리 하시겠습니까?")){
			$.ajax({
				url : "/payment/payStatusProc",
				dataType : "text",
				method: "POST",
				data : data,
				success : function(result) {
					if(result=="success"){
						alert("정상적으로 처리되었습니다.");
						location.href = location.href;
					}else{
						alert(result);
					}
				},
				error : function(status) {
					alert("에러가 발생하였습니다.");
				}
			});
		}
	})
	$(".btn_delete").click(function(){
		var $thisOrderno = $(this).closest("tr").data("orderno");
		data={
			type:'delete',
			orderno:$thisOrderno
		}
		if($thisOrderno && confirm("삭제 하시겠습니까?")){
			$.ajax({
				url : "/payment/payStatusProc",
				dataType : "text",
				method: "POST",
				data : data,
				success : function(result) {
					if(result=="success"){
						alert("정상적으로 처리되었습니다.");
						location.href = location.href;
					}else{
						alert(result);
					}
				},
				error : function(status) {
					alert("에러가 발생하였습니다.");
				}
			});
		}
	})
})
</script>
