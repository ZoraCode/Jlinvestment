<style>
label{font-size: 33px !important;}
.tbl_board{margin-bottom: 20px;}
.input_txt{box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 67px;font-size: 32px;}

.form-check-label{display: inline-block;margin-left: 10px;margin-right: 15px;}
.pp_tab{width: 100%;display: inline-block; }
.pp_tab li{width: 50%;float: left;border:1px solid #c9c9c9;padding: 20px 0;text-align: center;font-size: 23px;box-sizing:border-box;cursor: pointer;}
.pp_tab li.active{color: #ffffff; background-color: #424445;}
.txt_pp{width: 95%;padding: 10px;margin: auto;box-sizing: border-box;max-height: 240px;overflow: auto;line-height: 22px;border: 1px solid #ccc;margin-top:5px;min-height: 240px;}
.txt_pp_2{display: none;}

.agree{text-align: right;}
.btn_comm {width: 100%; height: 130px; font-size: 2.3em;}

</style>

<script src="https://www.google.com/recaptcha/api.js?render=6Ld7o-AUAAAAAN_OZjOnUOrqWAHCsp8s9q-wV8se"></script>
		<div class="inner pb100 pt80">
			<div class="txtCenter">
				<img src="/images/mobile/common/vipapply_top.png" class="mb50" alt="">
			</div>
			<div class="ml20 mb50">
				<label for="name" class="pb20">이름</label>
				<input type="text" name="name" id="name" class="input_txt w760px">
			</div>
			<div class="ml20 mb50">
				<label for="name" class="pb20">전화번호</label>
				<input type="text" name="tel1" id="tel1" class="input_txt w250px" maxlength="4">
				<input type="text" name="tel2" id="tel2" class="input_txt w250px" maxlength="4">
				<input type="text" name="tel3" id="tel3" class="input_txt w250px" maxlength="4">
			</div>
			<div class=" ml20 mb50">
				<label for="price" class="pb35">투자금</label>
				<input type="radio" name="price" id="price1" value="1천~3천"><label for="price1" class="form-check-label">1천~3천</label>
				<input type="radio" name="price" id="price2" value="3천~5천"><label for="price2" class="form-check-label">3천~5천</label>
				<input type="radio" name="price" id="price3" value="5천~1억"><label for="price3" class="form-check-label">5천~1억</label>
				<input type="radio" name="price" id="price4" value="1억이상"><label for="price4" class="form-check-label">1억이상</label>
			</div>
			<div class="ml20 mb50">
				<label for="category" class="pb35">상담분야</label>
				<input type="checkbox" name="category" id="category1" value="주식"><label for="category1" class="form-check-label">주식</label>
				<input type="checkbox" name="category" id="category2" value="선물옵션"><label for="category2" class="form-check-label">선물옵션</label>
			</div>
			<div class="ml20 mb50">
				<label for="etc" class="pb35">문의내용</label>
				<textarea name="etc" id="etc" cols="30" rows="10" class="input_txt w760px"></textarea>
			</div>
			<div class="mb50">
				<ul class="pp_tab mb20">
					<li class="active">개인정보취급방침 동의</li>
					<li>개인정보 제3자 제공동의</li>
				</ul>
				<div class="txt_pp txt_pp_1"><?=$pp[0]["privacy"]?></div>
				<div class="txt_pp txt_pp_2"><?=$pp[0]["otheragree"]?></div>
			</div>

			<div class="agree pb35">
				<input type="checkbox" name="agree" id="agree"><label for="agree" class="form-check-label">약관에 동의합니다.</label>
			</div>
			<div class="txtCenter">
				<input type="hidden" id="g-recaptcha" name="g-recaptcha">
				<button class="btn_comm m0a mt30 btn_apply w760px">VIP 체험 신청 하기</button>
				<a href="https://open.kakao.com/o/sEvPtX0b"><img src="/images/mobile/common/vipapply_kakao.png" class="mb50 mt30" alt=""></a>
			</div>
		</div>

<script type="text/javascript">
grecaptcha.ready(function() {
	grecaptcha.execute('6Ld7o-AUAAAAAN_OZjOnUOrqWAHCsp8s9q-wV8se', {action: 'homepage'}).then(function(token) {
		// 토큰을 받아다가 g-recaptcha 에다가 값을 넣어줍니다.
		document.getElementById('g-recaptcha').value = token;
	});
});
$(".pp_tab li").click(function(){
	var $thisNo = $(this).index()+1;
	$(this).addClass("active").siblings().removeClass("active")
	$(".txt_pp").hide()
	$(".txt_pp_"+$thisNo).show();
})

$("#tel1").on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});
$("#tel2").on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});
$("#tel3").on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});




$(".btn_apply").click(function(){
	var $name = $("#name");
	var $tel1 = $("#tel1");
	var $tel2 = $("#tel2");
	var $tel3 = $("#tel3");
	var $price = $("input[name='price']:checked");
	var $category = $("input[name='category']:checked");
	var $etc = $("#etc");
	var $captcha = $("input[name='g-recaptcha']").val();

	if(!$.trim($name.val())){
		alert("이름을 입력해주세요.");
		$name.focus();
		return
	}
	if(!$.trim($tel1.val())){
		alert("연락처를 입력해주세요.");
		$tel1.focus();
		return
	}
	if(!$.trim($tel2.val())){
		alert("연락처를 입력해주세요.");
		$tel2.focus();
		return
	}
	if(!$.trim($tel3.val())){
		alert("연락처를 입력해주세요.");
		$tel3.focus();
		return
	}
	var $tel = $tel1.val() + "-" + $tel2.val() + "-" + $tel3.val();
	if(!$price.length){
		alert("투자금을 선택해주세요.");
		return
	}
	if(!$category.length){
		alert("상담분야를 선택해주세요.");
		return
	}
	if(!$("#agree").is(":checked")){
		alert("개인정보 수집에 동의해주세요.");
		return false;
	}
	var categoryval = $.map($(':checkbox[name=category]:checked'), function(n, i){
		  return n.value;
	}).join(',');

	data = {
		name : $name.val(),
		tel : $tel,
		price : $price.val(),
		category : categoryval,
		etc : $etc.val(),
		agree3:$("#agree3").is(":checked")?"Y":"N",
		captcha : $captcha

	}

	$.ajax({
		url : "/proc/applyProc",
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
})
</script>
