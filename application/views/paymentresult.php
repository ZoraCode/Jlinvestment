<style>
.payment_result_layer h4.txt_result1{font-size: 40px;font-weight: 600;text-align: center;padding-bottom: 50px;display: block;line-height: 25px;color: #333333;letter-spacing: -1px;}
.payment_result_layer p.txt_result2{font-size: 20px;text-align: center;border-bottom: 1px solid #000;padding-bottom: 30px;display: block;line-height: 25px;color: #333333;}
.tbl_board{margin-bottom: 20px;}
.tbl_view th{text-align: center;padding-left: 0 !important;}
.form-check-label{display: inline-block;margin-left: 10px;margin-right: 15px;}
input[type='radio']{width: 20px;height: 20px;}
tr.paymethod{display: none;}
</style>

			<div class="payment_result_layer mt80 mb100">
				<div class="inner">
					<h4 class="txt_result1">결제가 정상적으로 완료되었습니다.</h4>
					<?if($payresult[0]["pay_method"]=="card"){?>
						<p class="txt_result2">신용카드 결제내역는 아래와 같습니다.</p>
					<?}else{?>
						<p class="txt_result2">입금계좌정보는 아래와 같습니다.</p>
					<?}?>
					<table class="tbl_board tbl_view mt30" cellspacing="0" cellpadding="0" border="0" width="100%">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr class="thead">
							<th>주문번호</th>
							<td colspan="3"><?=$orderno?></td>
						</tr>
						<?if($payresult[0]["pay_method"]=="online"){?>
						<tr class="thead">
							<th>입금하실 은행</th>
							<td colspan="3"><?=$settings["bank"]?></td>
						</tr>
						<tr class="thead">
							<th>입금하실 계좌번호</th>
							<td colspan="3"><?=$settings["bank_no"]?></td>
						</tr>
						<tr class="thead">
							<th>예금주명</th>
							<td colspan="3"><?=$settings["bank_owner"]?></td>
						</tr>
						<?}elseif($payresult[0]["pay_method"]=="card"){?>
						<tr class="thead">
							<th>결제방법</th>
							<td colspan="3">신용카드</td>
						</tr>
						<tr class="thead">
							<th>결제카드</th>
							<td colspan="3"><?=$payresult[0]["bank_name"]?></td>
						</tr>
						<tr class="thead">
							<th>결제일시</th>
							<td colspan="3"><?=$payresult[0]["reg_dt"]?></td>
						</tr>
						<?}?>
						<tr class="thead">
							<th>결제금액</th>
							<td colspan="3"><?=number_format($payresult[0]["total_price"])?>원</td>
						</tr>
					</table>
					<div class="btn_layer text-center mb70 mt10">
						<a href="/paymenthistory"><button type="button" class="btn_comm" id="btn_payment">확인완료</button></a>
					</div>
				</div>
			</div>
