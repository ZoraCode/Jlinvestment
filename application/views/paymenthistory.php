			<div class="payment_history_layer mt80">
				<div class="inner">
					<table class="tbl_board tbl_view" cellspacing="0" cellpadding="0" border="0" width="100%">
						<col width="5%">
						<col width="15%">
						<col width="15%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="15%">
						<col width="15%">
						<thead>
						<tr class="thead">
							<th>No</th>
							<th>주문일자</th>
							<th>주문상품명</th>
							<th>결제금액</th>
							<!-- <th>결제수단</th> -->
							<th>결제상태</th>

						</tr>
						</thead>
						<?
						if(count($paymenthistory)){
							$no = count($paymenthistory);
							foreach($paymenthistory as $var){
								$pd_title = $var["price"];
								$pay_method= $var["pay_method"];
								$pay_status = $var["pay_status"];

								if($pay_method=="card"){
									$pay_method="신용카드";
								}else{
									$pay_method="계좌이체";
								}

								if($pay_status=="OK"){
									$pay_status = "<b>결제완료</b>";
								}elseif($pay_status=="READY"){
									$pay_status = "<span class='cred'>승인대기</span>";
								}
								switch($pd_title){
									case 770000   : $pd_title = "VIP서비스";break;
									case 20000000 : $pd_title = "VVIP서비스";break;
									case 3500000  : $pd_title = "VIP선물";break;
									default:break;
								}
								$startdate = $var["startdate"]=="0" ? "":date('Y-m-d', $var["startdate"]);
								$enddate = $var["enddate"]=="0" ? "":date('Y-m-d', $var["enddate"]);
								$period = !empty($startdate) && !empty($enddate) ? $startdate." ~ ". $enddate : "";
						?>
						<tr>
							<td><?=$no?></td>
							<td><?=$var["reg_dt"]?></td>
							<td><?=$pd_title?></td>
							<td><?=number_format($var["total_price"])?>원</td>
							<!-- <td><?=$pay_method?></td> -->
							<td><?=$pay_status?></td>

						</tr>
						<?
								$no--;
							}
						}
						?>
					</table>
				</div>
			</div>
