<!DOCTYPE html>
<html lang="ko">
  
<head>
    <meta charset="utf-8">
    <title><?=BASE_TITLE_ADM?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>" rel="stylesheet" type="text/css" />

<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('assets/css/pages/signin.css')?>" rel="stylesheet" type="text/css">

</head>

<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/<?=admmng?>">
				<?=BASE_TITLE_ADM?>	
			</a>		
		</div>
	</div>
</div>

<div class="account-container">
	<div class="content clearfix">
		<form class="form-signin" name="loginFrm" id="loginFrm" method="post">
			<h1>Member Login</h1>		
			<div class="login-fields">
				<div class="field">
					<label for="id">Userid</label>
					<input type="text" id="id" name="id" value="" placeholder="Userid" class="login username-field" data-valid="notnull" data-alert="아이디" required autofocus/>
				</div>
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="pwd" name="pwd" value="" placeholder="Password" class="login password-field" onkeypress="chk_ent(event);" data-valid="notnull" data-alert="비밀번호"  required/>
				</div>
			</div>
			<div class="login-actions">
<!-- 
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
 -->
			<a href="javascript:void(0);" class="button btn btn-success btn-large" onclick="loginChk();">Sign In</a>
			</div>
			
		</form>
	</div> 
</div>

<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/js/signin.js')?>"></script>
<script src="<?=base_url('assets/js/web.js')?>"></script>
<script type="text/javascript">

function chk_ent(evt){
	var keyCode = evt.which?evt.which:event.keyCode;
	if(keyCode=="13"){
		loginChk();
	}
}
function loginChk(){
	var form = document.getElementById("loginFrm")
	var $id = $("#id").val();
	var $pwd = $("#pwd").val();

	if (web.formValidation(form,true)){

		$.ajax({
			url : "/member/login_proc",
			dataType : "text",
			method: "POST",
			data : {id:$id,pwd:$pwd},
			success : function(result) {

				if(result=="success"){
					location.href = "/<?=admmng?>/index";
				}else{
					alert(result);
				}
				return false;
			},
			error : function(status) {
				alert("에러가 발생하였습니다.");	
			}
		});
	}	
}
</script>
</body>
</html>
