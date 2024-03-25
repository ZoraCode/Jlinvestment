<?
if($this->session->userdata(DB_PREFIX.'idx')!=""){
	$userInfo = getUserInfoByIdx($this->session->userdata(DB_PREFIX.'idx'));
	if(!count($userInfo)){
		error_move("로그인이 필요한 페이지입니다.","/login");
		//redirect("/");
	}
}else{
	//redirect("/");
	error_move("로그인이 필요한 페이지입니다.","/login");
}
include site_conf_inc;
$orderNo = getOrderNo();
$get_pd = $_GET["pd"];

?>
<style>
.payment_layer h4.tbl_title{font-size: 25px;font-weight: bold;text-align: center;border-bottom: 1px solid #000;padding-bottom: 10px;display: block;line-height: 25px;color: #333333;}
.tbl_board{margin-bottom: 20px;}
.tbl_view th{text-align: center;padding-left: 0 !important;}
.form-check-label{display: inline-block;margin-left: 10px;margin-right: 15px;}
input[type='radio']{width: 20px;height: 20px;}
/* tr.paymethod{display: none;} */
</style>
			<div class="payment_layer mt80">
				<div class="inner">
					<form role="form" name="payFrm" id="payFrm">
						<input type="hidden" name="orderno" id="orderno" value="<?=$orderNo?>">
						<input type="hidden" name="period" id="period">
						<input type="hidden" name="price" id="price">
						<input type="hidden" name="discount" id="discount">
						<input type="hidden" name="total_price" id="total_price">
						<input type="hidden" name="pay_method" id="pay_method" value="online">

						<h4 class="tbl_title">결제자 정보</h4>
						<table class="tbl_board tbl_view mt30" cellspacing="0" cellpadding="0" border="0" width="100%">
							<col width="20%">
							<col width="30%">
							<col width="20%">
							<col width="30%">
							<tr class="thead">
								<th>이름</th>
								<td><?=$userInfo["mb_name"]?></td>
								<th>연락처</th>
								<td><?=$userInfo["mb_hp"]?></td>
							</tr>
							<tr class="thead">
								<th>이메일</th>
								<td colspan="3"><?=$userInfo["mb_email"]?></td>
							</tr>
						</table>
						<h4 class="tbl_title">결제 정보</h4>
						<table class="tbl_board tbl_view mt30" cellspacing="0" cellpadding="0" border="0" width="100%">
							<col width="20%">
							<col width="30%">
							<col width="20%">
							<col width="30%">
							<tr class="thead">
								<th>기간</th>
								<td>
									<select name="pay_period" id="pay_period">
										<?foreach($product as $var){
											if($get_pd == "all"){?>
												<option value="<?=$var["pd_period"]?>" data-price="<?=$var["pd_price"]?>" data-discount="<?=$var["pd_discount"]?>"><?=$var["pd_title"]?> (<?=$var["pd_period"]?>개월)</option>
									 <?}else if($get_pd == $var["pd_price"]){?>
											<option value="<?=$var["pd_period"]?>" data-price="<?=$var["pd_price"]?>" data-discount="<?=$var["pd_discount"]?>"><?=$var["pd_title"]?> (<?=$var["pd_period"]?>개월)</option>
										<?}
									}?>
									</select>
								</td>
								<th>결제금액</th>
								<td id="txt_price" colspan="3">원</td>
							</tr>

						</table>

						<h4 class="tbl_title">결제 수단</h4>
						<table class="tbl_board tbl_view mt30" cellspacing="0" cellpadding="0" border="0" width="100%">
							<col width="20%">
							<col width="*">
							<!-- <tr>
								<td class="text-left" colspan="2">
									<input type="radio" name="method" id="method1" value="card"><label for="method1" class="form-check-label">신용카드</label>
									<input type="radio" name="method" id="method2" value="online"><label for="method2" class="form-check-label">무통장 입금</label>
								</td>
							</tr> -->
							<tr>
								<td class="text-left" colspan="2">
									무통장 입금
								</td>
							</tr>
							<tr class="thead paymethod">
								<th>입금은행</th>
								<td><?=$settings["bank"]?></td>
							</tr>
							<tr class="thead paymethod">
								<th>계좌번호</th>
								<td><?=$settings["bank_no"]?></td>
							</tr>
							<tr class="thead paymethod">
								<th>예금주</th>
								<td><?=$settings["bank_owner"]?></td>
							</tr>
						</table>
						<div class="btn_layer text-center mb70 mt10">
							<button type="button" class="btn_comm" id="btn_payment">결제하기</button>
						</div>
					</form>
				</div>
			</div>
<script>
Number.prototype.format = function(){
    if(this==0) return 0;

    var reg = /(^[+-]?\d+)(\d{3})/;
    var n = (this + '');
    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');
    return n;
};
function check_pay(){
	// if(!$("input[name='method']").is(":checked")){
	// 	alert("결제방법을 선택해주세요.");
	// 	return false;
	// }
	document.order_info.pay_method.value = "100000000000";
	jsf__pay(document.order_info);
	return ;
}

$(function(){
	init_orderid();
	$("#pay_period").change(function(){
		var $target = $("#pay_period option:selected");
		//var $ratio = $target.data("ratio");
		var $period = $target.val();
		var $price = $target.data("price");
		var $discount = $target.data("discount");
		var $int_discount = "0원";
		if($discount!="0"){
			$int_discount = comma($discount) + "원";
		}
		$("#txt_ratio").text($int_discount);
		$("#txt_price").text(comma($price)+"원");
		$("#rst_price").text(comma($price)+"원");
		$("#rst_discount").text($int_discount);
		$("#rst_total_price").text(comma($price-$discount)+"원");
		document.order_info.good_mny.value = $price-$discount;
		document.order_info.cost.value = $price-$discount;

		document.order_info.period.value = $period;
		document.order_info.price.value = $price;
		document.order_info.discount.value = $discount;
		document.order_info.total_price.value = $price-$discount;

		document.payFrm.period.value = $period;
		document.payFrm.price.value = $price;
		document.payFrm.discount.value = $discount;
		document.payFrm.total_price.value = $price-$discount;

	}).change();
	// $("input[name='method']").click(function(){
	// 	var $thisVal = $(this).val();
	// 	if($thisVal=="card"){
	// 		$("tr.paymethod").hide()
	// 	}else{
	// 		$("tr.paymethod").show()
	// 	}
	// })
	$("#btn_payment").click(function(){
		var $target = $("#payFrm");
		var $price = $target.find("#price").val();
		var $discount = $target.find("#discount").val();
		var $total_price = $target.find("#total_price").val();
		var $period = $target.find("#period").val();
		var $pay_method = "online";
		//var $pay_method = $target.find("#pay_method").val();
		// if(!$("input[name='method']").is(":checked")){
		// 	alert("결제방법을 선택해주세요.");
		// 	return false;
		// }
		data = {
			'orderno' : '<?=$orderNo?>',
			'period' : $period,
			'price' : $price,
			'discount' : $discount,
			'total_price' : $total_price,
			'pay_method' : $pay_method
		}

	//	if($("input[name='method']:checked").val()=="online"){
			//if(confirm("무통장결제를 진행하시겠습니까?")){
				$.ajax({
					url : "/payment/payment_proc",
					dataType : "text",
					method: "POST",
					data : data,
					success : function(result) {
						result = JSON.parse(result);
						if(result.status=="success"){
							alert("결제가 정상적으로 저장되었습니다.");
							location.href = result.redirect;
						}else{
							alert(result.msg);
						}
					},
					error : function(status) {
						alert("에러가 발생하였습니다.");
					}
				});

			//}
		// }else{
		// 	check_pay();
		// 	return false;
		// }

	})
})
</script>
<script type="text/javascript">
		/****************************************************************/
        /* m_Completepayment  설명                                      */
        /****************************************************************/
        /* 인증완료시 재귀 함수                                         */
        /* 해당 함수명은 절대 변경하면 안됩니다.                        */
        /* 해당 함수의 위치는 payplus.js 보다먼저 선언되어여 합니다.    */
        /* Web 방식의 경우 리턴 값이 form 으로 넘어옴                   */
        /* EXE 방식의 경우 리턴 값이 json 으로 넘어옴                   */
        /****************************************************************/
		function m_Completepayment( FormOrJson, closeEvent )
        {
            var frm = document.order_info;

            /********************************************************************/
            /* FormOrJson은 가맹점 임의 활용 금지                               */
            /* frm 값에 FormOrJson 값이 설정 됨 frm 값으로 활용 하셔야 됩니다.  */
            /* FormOrJson 값을 활용 하시려면 기술지원팀으로 문의바랍니다.       */
            /********************************************************************/
            GetField( frm, FormOrJson );

            console.log(FormOrJson)
            console.log(closeEvent)
            if( frm.res_cd.value == "0000" )
            {
			    //alert("결제 승인 요청 전,\n\n반드시 결제창에서 고객님이 결제 인증 완료 후\n\n리턴 받은 ordr_chk 와 업체 측 주문정보를\n\n다시 한번 검증 후 결제 승인 요청하시기 바랍니다."); //업체 연동 시 필수 확인 사항.
                /*
                    가맹점 리턴값 처리 영역
                */

                frm.submit();
            }
            else
            {
                alert( "[" + frm.res_cd.value + "] " + frm.res_msg.value );

                closeEvent();
            }
        }
</script>
<?
    /* ============================================================================== */
    /* =   Javascript source Include                                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.php파일을 수정하시기 바랍니다.     = */
    /* = -------------------------------------------------------------------------- = */
?>
    <script type="text/javascript" src='<?=$g_conf_js_url?>'></script>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   Javascript source Include END                                            = */
    /* ============================================================================== */
?>
    <script type="text/javascript">
        /* 플러그인 설치(확인) */
        //kcpTx_install(); // Plugin 결제창 호출 방식인 경우 적용하시기 바랍니다.

        /* Payplus Plug-in 실행 */
        function jsf__pay( form )
        {
            try
            {
                KCP_Pay_Execute( form );
            }
            catch (e)
            {
                /* IE 에서 결제 정상종료시 throw로 스크립트 종료 */
            }
        }

        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth() + 1;
            var date  = today.getDate();
            var time  = today.getTime();

            if(parseInt(month) < 10) {
                month = "0" + month;
            }

            if(parseInt(date) < 10) {
                date = "0" + date;
            }

            var order_idxx = year + "" + month + "" + date + "" + time;
			document.order_info.ordr_idxx.value = order_idxx;
			//return order_idxx;
        }

    </script>

<!-- 주문정보 입력 form : order_info -->
<form name="order_info" method="post" action="<?=kcp_root?>/lib/pp_cli_hub.php" >

<?
    /* ============================================================================== */
    /* =   1. 주문 정보 입력                                                        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
	<input type="hidden" name="pay_method" alt="지불방법"/>
	<input type="hidden" name="ordr_idxx" alt="주문번호"/>
	<input type="hidden" name="good_name" value="상품결제_<?=$this->session->userdata(DB_PREFIX.'id')?>" alt="상품명"/>
	<input type="hidden" name="good_mny" alt="결제금액"/>
	<input type="hidden" name="buyr_name" value="<?=$this->session->userdata(DB_PREFIX.'name')?>" alt="주문자명"/>
	<input type="hidden" name="buyr_mail" value="<?=$this->session->userdata(DB_PREFIX.'email')?>" alt="주문자"/>
	<input type="hidden" name="buyr_tel1" value="<?=$this->session->userdata(DB_PREFIX.'hp')?>" alt="전화번호"/>
	<input type="hidden" name="buyr_tel2" value="<?=$this->session->userdata(DB_PREFIX.'hp')?>" alt="휴대폰번호"/>
	<input type="hidden" name="cost" />

	<input type="hidden" name="orderno" id="orderno" value="<?=$orderNo?>">
	<input type="hidden" name="period" id="period">
	<input type="hidden" name="price" id="price">
	<input type="hidden" name="discount" id="discount">
	<input type="hidden" name="total_price" id="total_price">

<?
    /* = -------------------------------------------------------------------------- = */
    /* =   1. 주문 정보 입력 END                                                    = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   2. 가맹점 필수 정보 설정                                                 = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수 - 결제에 반드시 필요한 정보입니다.                               = */
    /* =   site_conf_inc.php 파일을 참고하셔서 수정하시기 바랍니다.                 = */
    /* = -------------------------------------------------------------------------- = */
    // 요청종류 : 승인(pay)/취소,매입(mod) 요청시 사용
?>
    <input type="hidden" name="req_tx"          value="pay" />
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
    <input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />

<?
    /*
    할부옵션 : Payplus Plug-in에서 카드결제시 최대로 표시할 할부개월 수를 설정합니다.(0 ~ 18 까지 설정 가능)
    ※ 주의  - 할부 선택은 결제금액이 50,000원 이상일 경우에만 가능, 50000원 미만의 금액은 일시불로만 표기됩니다
               예) value 값을 "5" 로 설정했을 경우 => 카드결제시 결제창에 일시불부터 5개월까지 선택가능
    */
?>
    <input type="hidden" name="quotaopt"        value="0"/>

	<!-- 필수 항목 : 결제 금액/화폐단위 -->
    <input type="hidden" name="currency"        value="WON"/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   2. 가맹점 필수 정보 설정 END                                             = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   3. Payplus Plugin 필수 정보(변경 불가)                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
    <!-- PLUGIN 설정 정보입니다(변경 불가) -->
    <input type="hidden" name="module_type"     value="<?=$module_type ?>"/>
<!--
      ※ 필 수
          필수 항목 : Payplus Plugin에서 값을 설정하는 부분으로 반드시 포함되어야 합니다
          값을 설정하지 마십시오
-->
    <input type="hidden" name="res_cd"          value=""/>
    <input type="hidden" name="res_msg"         value=""/>
    <input type="hidden" name="enc_info"        value=""/>
    <input type="hidden" name="enc_data"        value=""/>
    <input type="hidden" name="ret_pay_method"  value=""/>
    <input type="hidden" name="tran_cd"         value=""/>
    <input type="hidden" name="use_pay_method"  value=""/>
	<!-- 주문정보 검증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
	<input type="hidden" name="ordr_chk"        value=""/>
    <!--  현금영수증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
    <input type="hidden" name="cash_yn"         value=""/>
    <input type="hidden" name="cash_tr_code"    value=""/>
    <input type="hidden" name="cash_id_info"    value=""/>
	<!-- 2012년 8월 18일 전자상거래법 개정 관련 설정 부분 -->
	<!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
	<input type="hidden" name="good_expr" value="0">
</form>
