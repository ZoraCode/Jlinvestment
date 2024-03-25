<?
$refe = $this->agent->referrer();
?>
<style>
.login_layer h1{font-size: 50px;text-align: center;margin-top: 100px;margin-bottom: 40px;}
.login_layer p{text-align: center;margin-bottom: 60px;}
.login_layer #loginFrm{margin: 0 auto 30px; text-align: center;}

.login_layer #loginFrm #id{background: url('/images/signup/ico_id.png') no-repeat 20px 50%;padding-left: 50px;}
.login_layer #loginFrm #pwd{background: url('/images/signup/ico_pw.png') no-repeat 20px 50%;padding-left: 50px;}
.login_layer #loginFrm .btn_login{font-size: 32px; min-height:80px;}
.login_layer #loginFrm .btn_group{display: inline-block;float: right;margin:50px 30px 50px; color: #000;}
.login_layer #loginFrm .btn_group a {font-size: 28px;}
p{font-size: 28px; margin-top: 15px;}

.input_txt{box-sizing: border-box;padding: 0px 5px;margin: 0px;min-height: 110px;font-size: 32px;}
.footer	p {
		font-size: 22px;
		line-height: 30px !important;
    letter-spacing: -1.5px;
    font-family: 'Noto Sans KR', sans-serif;
	}

</style>
		<div class="login_layer">
			<div class="inner">
				<h1>로그인</h1>
				<p>로그인을 위하여 아래 아이디와 비밀번호를 입력하여 주세요.</p>
				<form name="loginFrm" id="loginFrm" method="post" action="/proc/loginProc">
					<input type="text" name="id" id="id" class="input_txt mb10 w760px" placeholder="아이디" value="" data-valid="notnull" data-alert="아이디" >
					<input type="password" name="pwd" id="pwd" class="input_txt mb10 w760px" placeholder="비밀번호" value="" style="height:36px;" data-valid="notnull" data-alert="비밀번호" onkeypress="chk_ent(event);" required>
					<div class="btn_group">
						<a href="/signup">회원가입 ·</a><a href="/findidpw"> 아이디 · 비밀번호 찾기</a>
					</div>
					<button type="button" class="btn_comm btn_login w100p mb10 w760px" style="height:60px;">로그인</button>
				</form>


			</div>
		</div>
<script>
function chk_ent(evt){
	var keyCode = evt.which?evt.which:event.keyCode;
	if(keyCode=="13"){
		$(".btn_login").click();
	}
}
$(".btn_login").click(function(){
	var form = document.getElementById("loginFrm")
	var $id = $("#id").val();
	var $pwd = $("#pwd").val();
	if (web.formValidation(form,true)){
		$.ajax({
			url : "/proc/loginProc",
			dataType : "text",
			method: "POST",
			data : {id:$id,pwd:$pwd},
			success : function(result) {
				if(result=="success"){
					<?if($refe){?>
					location.href = "<?=$refe?>";
					<?}else{?>
					location.href = "/";
					<?}?>
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
</script>
