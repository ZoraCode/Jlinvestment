<style>
.input_txt{width: 100%;box-sizing: border-box;padding: 13px 5px;}
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
							<table class="table table-striped table-bordered">
								<col width="*">
								<col width="15%">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<col width="10%">
								<thead>
								<tr>
									<th class="text-center">상품명</th>
									<th>가격(원)</th>
									<th>기간(개월)</th>
									<!-- <th>할인율(%)</th> -->
									<th>할인가격(원)</th>
									<th class="td-actions"></th>
								</tr>
								</thead>
								<tbody>
								<?if(count($product)){
									foreach($product as $var){
								?>
								<tr>
									<td><input type="text" class="input_txt" name="pd_title" value="<?=$var["pd_title"]?>"></td>
									<td><input type="text" class="span2" name="pd_price" value="<?=$var["pd_price"]?>"></td>
									<td>
										<select class="span2" name="pd_period">
											<?for($i=1;$i<=12;$i++){?>
											<option value="<?=$i?>" <?if($var["pd_period"] == $i){echo "selected";}?>><?=$i?>개월</option>
											<?}?>
										</select>
									</td>
									<!-- <td><input type="text" class="span1" name="pd_ratio" value="<?=$var["pd_ratio"]?>"></td> -->
									<td><input type="text" class="span1" name="pd_discount" value="<?=$var["pd_discount"]?>"></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_modify" data-idx="<?=$var["idx"]?>" title="수정"><i class="btn-icon-only icon-edit"></i></a>
										<a href="javascript:void(0);" class="btn btn-danger btn-small btn_delete_product" data-idx="<?=$var["idx"]?>" title="삭제"><i class="btn-icon-only icon-remove"></i></a>
									</td>
								</tr>
								<?
									}
								}else{?>
								<tr>
									<td colspan="5" class="text-center">등록된 상품이 없습니다.</td>
								</tr>
								<?}?>
								<tr>
									<td colspan="5"><hr></td>
								</tr>
								<tr>
									<td><input type="text" class="input_txt" name="n_pd_title" id="n_pd_title" value=""></td>
									<td><input type="text" class="span2" name="n_pd_price" id="n_pd_price" value=""></td>
									<td>
										<select class="span2" name="n_pd_period" id="n_pd_period">
											<?for($i=1;$i<=12;$i++){?>
											<option value="<?=$i?>"><?=$i?>개월</option>
											<?}?>
										</select>
									</td>
									<!-- <td><input type="text" class="span1" name="n_pd_ratio" id="n_pd_ratio" value="0"></td> -->
									<td><input type="text" class="span1" name="n_pd_discount" id="n_pd_discount" value="0"></td>
									<td class="td-actions text-center">
										<a href="javascript:void(0);" class="btn btn-info btn-small btn_insert" title="등록"><i class="btn-icon-only icon-ok"></i></a>
									</td>
								</tr>	
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(".btn_insert").click(function(){
		var $pd_title = $("#n_pd_title").val();	
		var $pd_price = $("#n_pd_price").val();	
		var $pd_period = $("#n_pd_period option:selected").val();
		//var $pd_ratio = $("#n_pd_ratio").val();	
		var $pd_discount = $("#n_pd_discount").val();	
		if(!$pd_title){
			alert("상품명을 입력해주세요.");
			$("#n_pd_title").focus();
			return false;
		}
		if(!$pd_price){
			alert("가격을 입력해주세요.");
			$("#n_pd_price").focus();
			return false;
		}
		if(!$pd_period){
			alert("기간을 입력해주세요.");
			$("#n_pd_period").focus();
			return false;
		}
		data={
			'mode':'write',
			pd_title:$pd_title,
			pd_price:$pd_price,
			pd_period:$pd_period,
			//pd_ratio:$pd_ratio,
			pd_discount:$pd_discount
		}
		ajaxProcess("/proc/productProc",data,"/<?=admmng?>/product");
	})	
	$(".btn_modify").click(function(){
		var $target = $(this).closest("tr");
		var $pd_title = $target.find("input[name='pd_title']").val();	
		var $pd_price = $target.find("input[name='pd_price']").val();	
		var $pd_period = $target.find("[name='pd_period'] option:selected").val();	
	
		//var $pd_ratio = $target.find("input[name='pd_ratio']").val();	
		var $pd_discount = $target.find("input[name='pd_discount']").val();
		var $idx = $(this).data("idx");
		if(!$pd_title){
			alert("상품명을 입력해주세요.");
			$("#pd_title").focus();
			return false;
		}
		if(!$pd_price){
			alert("가격을 입력해주세요.");
			$("#pd_price").focus();
			return false;
		}
		if(!$pd_period){
			alert("기간을 입력해주세요.");
			$("#pd_period").focus();
			return false;
		}
		data={
			'mode':'update',
			'idx':$idx,
			pd_title:$pd_title,
			pd_price:$pd_price,
			pd_period:$pd_period,
			//pd_ratio:$pd_ratio,
			pd_discount:$pd_discount
		}
		ajaxProcess("/proc/productProc",data,"/<?=admmng?>/product");
	})	
	$(".btn_delete_product").click(function(){
		var $thisIdx = $(this).data("idx");
		if(confirm("삭제하시겠습니까?")){
			data={mode:"delete",idx:$thisIdx}
			ajaxProcess("/proc/productProc",data,"/<?=admmng?>/product");			
		}
	})
})
</script>