<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?

//if($this->input->ip_address()!="1.227.74.148"){
//	move('about:blank');
//}
$navbar = json_decode(navbar);
if(isset($cate)){
	$cateKey = get_key($cate)+1;
}



?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<meta name="robots" content="index,follow">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="x-ua-compatible" content="IE=edge" >
	<link rel="canonical" href="https://www.jlinvestment.co.kr"/>
	<meta name="naver-site-verification" content="f832e14825364ab99edaeb6a8bd97f7910f51f44"/>
	<meta name="keywords" content="제이엘투자그룹,JL투자그룹,주식,증권,전업투자,무료주식상담,급등주,테마주,종목상담,투자기법">
	<meta name="description" content="제이엘투자그룹,JL투자그룹,주식,증권,전업투자,무료주식상담,급등주,테마주,종목상담,투자기법">
	<meta property="og:type" content="website">
	<meta property="og:title" content="제이엘투자그룹">
	<meta property="og:site_name" content="제이엘투자그룹">
	<meta property="og:description" content="제이엘투자그룹,JL투자그룹,주식,증권,전업투자,무료주식상담,급등주,테마주,종목상담,투자기법">
	<meta property="og:image" content="https://www.jlinvestment.co.kr/images/jllogo2.png">
	<meta property="og:url" content="https://www.jlinvestment.co.kr">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="제이엘투자그룹">
	<meta name="twitter:description" content="제이엘투자그룹,JL투자그룹,주식,증권,전업투자,무료주식상담,급등주,테마주,종목상담,투자기법">
	<meta name="twitter:image" content="http://www.jlinvestment.co.kr">
	<meta name="twitter:domain" content="제이엘투자그룹">

	<title>JL투자그룹</title>
	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/base.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/jl.css?v='.getUpdateDate())?>" rel="stylesheet">
	

<!-- sjy link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer"> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css"><!-- bx slider -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/><!--font awesome-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://webfontworld.github.io/pretendard/Pretendard.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
	<!--파비콘-->
	<link rel="apple-touch-icon" sizes="57x57" href="../../images/main/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../../images/main/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../../images/main/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../../images/main/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../../images/main/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../../images/main/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../../images/main/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../../images/main/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../../images/main/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="../../images/main/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../../images/main/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../../images/main/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../../images/main/favicon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<!-- sjy link -->


	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- bx slider -->
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script><!-- bx slider -->
	<script src="<?=base_url('assets/js/bootstrap.2.3.2.js')?>"></script>
	<script src="<?=base_url('assets/js/web.js')?>"></script>
	<script src="<?=base_url('assets/js/jl.js')?>"></script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NP368KZ');</script>
	<!-- End Google Tag Manager -->
	<style>
		/* @font-face{
		font-family:s3;
		src:url(/font/SCDream3.woff)
	}
	@font-face{
		font-family:s4;
		src:url(/font/SCDream4.woff)
	}
	@font-face{
		font-family:s5;
		src:url(/font/SCDream5.woff)
	}
	@font-face{
		font-family:s6;
		src:url(/font/SCDream6.woff)
	} */
	/* @font-face{
    font-family:gm3;
    src:url(/font/GmarketSansTTFBold.woff)
}
@font-face{
    font-family:gm1;
    src:url(/font/GmarketSansTTFLight.woff)
}
@font-face{
    font-family:gm2;
    src:url(/font/GmarketSansTTFMedium.woff)
} */
	</style>
</head>
<body>
	<div id="wrapper">
		<div class="header">


					<!-- 헤드 Surcle -->
					<svg width="4" height="2" viewBox="0 0 4 2" fill="none" xmlns="http://www.w3.org/2000/svg">
      	<circle cx="1" cy="1" r="1" fill="#ffffff"/>
  		</svg>

			<div class="top">
				<div class="inner top_point">
					<a href="/">
						<h1>
							<img src="/images/common/main_logo.png" id="main_logo" alt="">
							<p class="top_p">JL INVESTMENT</p>
						</h1>
					</a>
					
					<ul class="topnavs">
						<?if(!$this->session->userdata(DB_PREFIX.'idx')){?>
						<li class="rb"><a href="/login">로그인</a></li>
						<li class="rb"><a href="/signup">회원가입</a></li>
						<li><a href="/findidpw">아이디 / 비밀번호 찾기</a></li>
						<?}else{?>
						<li class="rb"><a href="/logout">로그아웃</a></li>
						<li><a href="/mypage">마이페이지</a></li>
						<?}?>
					</ul>
				</div>
			</div>

			<div class="nav_wrap">
				<div class="inner">
					<ul class="nav_gnb">
						<?
						$navbars = (array) json_decode(navbars);
						$ii=1;
						foreach($navbars as $key=>$val){
						?>
						<li <?if(isset($cate) && $cateKey==$ii){echo "class='on'";}?>><a href="/<?=$key?>"><?=$val->super?></a></li>
						<?$ii++;}?>
					</ul>

					<!-- Double header -->
					<div class="nav_gnb_sub">
						<?
						for($i=0;$i<count($navbars);$i++){
							$innerHtml = "<div class='subnav_wrap'><ul>";
							foreach($navbar[$i] as $mk=>$mv){
								$active = "";
								// $active = "class='active'";
								if(isset($pn) and $pn==$mk){$active = "class='active'";}
								$innerHtml .= "<li ".$active."><a href='/$mk'>".$mv->name."</a></li>";
							}
							echo $innerHtml."</ul></div>";
						}
						?>
					</div>
				</div>
			</div>

<?

if( $pn == "" or $pn == "jlvip" or $pn == "login" or  $pn == "signup" ){
}else{?>
	<div class="sub_wrap" style="background: url('/images/sub/<?=$pn?>.png') no-repeat 50% 0%; position: relative;">
		<div class="inner">
		</div>
	</div>

<?}
if($pn=="mypage" or $pn=="paymenthistory"){
	$sub_title = $pn=="paymenthistory"?"결제내역확인":"회원정보수정";
?>
			<div class="sub_lnb_wrap">
				<div class="inner">
					 <ul class="sub_lnb">
						<li><a href="/"><img src="/images/common/ico_home.png" alt=""></a>HOME</li>
						<li>마이페이지</li>
						<li class="sub_lnb2_wrap"><?=$sub_title?>
							<ul class="sub_lnb2">
								<li <?if($pn=="mypage"){echo "class='active'";}?>><a href="/mypage">회원정보수정</a></li>
								<li <?if($pn=="paymenthistory"){echo "class='active'";}?>><a href="/paymenthistory">결제내역확인</a></li>
							</ul>
						</li>
					 </ul>
				</div>
			</div>
<?
}

if(isset($pn)){
$navbar = json_decode(navbar);
$key = get_key_front($pn);

	if($key !== ""){
		$sub_nav = $navbar[$key];
		$is_sub = $sub_nav->$pn->sub;
		if(!empty($is_sub)){
?>
			<div class="sub_lnb_wrap">
				<div class="inner">
					 <ul class="sub_lnb">
						<li><a href="/"><img src="/images/common/ico_home.png" alt=""></a> HOME</li>
						<li><?=$sub_nav->$pn->super?></li>
						<li class="sub_lnb2_wrap"><?=$sub_nav->$pn->name?>
							<ul class="sub_lnb2">
								<?foreach($sub_nav as $k=>$v){?>
								<li <?if($k==$pn){echo "class='active'";}?>><a href="/<?=$k?>"><?=$v->name?></a></li>
								<?}?>
							</ul>
						</li>
					 </ul>
				</div>
			</div>
<?
		}
	}
}
?>
		</div>
		<div class="contents">
