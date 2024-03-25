<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
if($this->input->ip_address()!="1.227.74.148"){
//	movescript('about:blank');
}
$navbar_m = json_decode(navbar_m);

if(isset($cate)){
	$cateKey = get_key($cate)+1;
}

?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=800, user-scalable=no">
	<meta name="robots" content="index,follow">
	<meta name="format-detection" content="telephone=no">
	<meta name="naver-site-verification" content="f832e14825364ab99edaeb6a8bd97f7910f51f44"/>
	<link rel="icon" href="/images/favicon.ico?v=<?=getUpdateDate()?>">
	<link rel="canonical" href="https://www.jlinvestment.co.kr"/>
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
	<link href="<?=base_url('assets/css/mobile.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/base.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/jl_mobile.css?v='.getUpdateDate())?>" rel="stylesheet">
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="<?=base_url('assets/js/bootstrap.2.3.2.js')?>"></script>
	<script src="<?=base_url('assets/js/web.js')?>"></script>
	<script src="<?=base_url('assets/js/jl.js')?>"></script>
	<script src="<?=base_url('assets/js/swiper.js')?>"></script>
	<link href="<?=base_url('assets/css/swiper.css')?>" rel="stylesheet">
	<link href="<?=base_url('../dist/css/swiper.min.css')?>" rel="stylesheet">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NP368KZ');</script>
	<!-- End Google Tag Manager -->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="<?=base_url('assets/js/html5.js')?>"></script>
<![endif]-->
</head>
<body>
	<div id="wrapper">
		<div class="header">
			<div class="top">
				<div class="inner">
					<!-- <a href="/vipapply"><img src="/images/mobile/main/top_bann_lt.png" id="bann_lt" alt=""></a> -->
					<span class="main-menu"><img src="/images/mobile/main/icon/menu.png"></span>
					<a href="/"><img src="/images/mobile/main/top_logo.png" id="main_logo" alt=""></a>
					<ul class="topnavs">
						<?if(!$this->session->userdata(DB_PREFIX.'idx')){?>
						<li class="rb"><a href="/login"><img src="/images/mobile/main/top_login.png" class="" alt="main_login"></a></li>
						<!-- <li class="rb"><a href="/signup">회원가입</a></li>
						<li><a href="/findidpw">아이디/비밀번호 찾기</a></li> -->
						<?}else{?>
						<li class="rb"><a href="/logout"><img src="/images/mobile/main/top_logout.png"  alt=""></a></li>
						<li><a href="/mypage"><img src="/images/mobile/main/top_mypage.png"  alt=""></a></li>
						<?}?>
						<!-- <li><a href="https://www.facebook.com/amazingstock" target="_blank"><img src="/images/common/ico_fb.png" alt=""></a></li>  -->
					</ul>
				</div>
			</div>
			

			<div class="nav_wrap">
				<div class="inner">
					<ul class="nav_gnb">
						<?
						$navbars_m = (array) json_decode(navbars_m);
						$ii=1;
						foreach($navbars_m as $key=>$val){
						?>
						<li <?if(isset($cate) && $cateKey==$ii){echo "class='on'";}?>><a href="/<?=$key?>"><?=$val->super?></a></li>
						<?$ii++;}?>
					</ul>
					<!-- <div class="nav_gnb_sub">
						<?
						for($i=0;$i<count($navbars_m);$i++){
							$innerHtml = "<div class='subnav_wrap'><ul>";
							foreach($navbar_m[$i] as $mk=>$mv){
								$active = "";
								if(isset($pn) and $pn==$mk){
									$active = "class='active'";
								}
								$innerHtml .= "<li ".$active."><a href='/$mk'>".$mv->name."</a></li>";
							}
							echo $innerHtml."</ul></div>";
						}
						?>
					</div> -->
				</div>
			</div>

<?
	if( $pn == "" or $pn == "jlvip" or $pn == "login"  ){
	}else{?>
	<div class="sub_wrap" style="background: url('/images/mobile/sub/<?=$pn?>.png') no-repeat 50% 0%; position: relative;">
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
						 <li <?if($pn=="mypage"){echo "class='active'";}?> style="width:50%"><a href="/mypage">회원정보수정</a></li>
 						<li <?if($pn=="paymenthistory"){echo "class='active'";}?> style="width:50%"><a href="/paymenthistory">결제내역확인</a></li>

					 </ul>
				</div>
			</div>
<?
}
if(isset($pn)){
$navbar_m = json_decode(navbar_m);

$key = get_key_front_m($pn);
// echo "<script>alert('".$pn.' '.$key."');</script>";
	if($key !== ""){

		$sub_nav = $navbar_m[$key];
		$is_sub = $sub_nav->$pn->sub;

		if(!empty($is_sub)){
?>
<!-- <script type="text/javascript">alert("<?=$is_sub?>");	</script> -->
			<div class="sub_lnb_wrap">
				<div class="inner">
					<ul class="sub_lnb">

						<?
						$width = "50%";
						foreach($sub_nav as $k=>$v){
							?>
							<li <?if($k==$pn){echo "class='active'";}?> style="width:<?=$width;?>"><a href="/<?=$k?>"><?=$v->name?> </a></li>
						<?}?>
					</ul>

					<!-- <?
						$headers = (array) json_decode(headers);
						$ii=1;
						foreach($headers as $key=>$val){
						?>
						<a href="/<?=$key?>"  <?if(isset($cate) && $cateKey==$ii){echo "class='on'";}?>><?=$val->super?></a>
						<?$ii++;}?> -->
					 <!-- <ul class="sub_lnb">
						<li class="sub_lnb2_wrap"><?=$sub_nav->$pn->name?>
							<ul class="sub_lnb2">
								<?foreach($sub_nav as $k=>$v){?>
								<li <?if($k==$pn){echo "class='active'";}?>><a href="/<?=$k?>"><?=$v->name?></a></li>
								<?}?>
							</ul>
						</li>
					 </ul> -->
				</div>
			</div>
<?
		}else{
		//echo "<pre>".print_r($navbar_m)."</pre>";
		//echo "<script>alert('".$sub_nav."');	</script>";
		}
	}
}
?>
		</div>

		<!-- 메뉴 추가++ -->
		<div class="main-menu-in">
					<div class="menu-in-top">
						<p class="menu-top-text">
							<strong>현명한 투자파트너</strong><br>
							JLINVESTMENT
						</p>
					</div>

					<ul class="menu-in-sub">
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/company">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon1.svg"></span>
								<span class="sub-right">회사소개</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/oneminute">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon2.svg"></span>
								<span class="sub-right">투자정보</span>
							</a>
						</li>
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/vipapply">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon7.svg"></span>
								<span class="sub-right">VIP체험신청</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/jlvip">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon8.svg"></span>
								<span class="sub-right">VIP서비스</span>
							</a>
						</li>
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/performance">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon4.svg"></span>
								<span class="sub-right">투자성과</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/profit">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon5.svg"></span>
								<span class="sub-right">수익인증</span>
							</a>
						</li>
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/review">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon6.svg"></span>
								<span class="sub-right">이용후기</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/milestones">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon9.svg"></span>
								<span class="sub-right">연혁</span>
							</a>
						</li>
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/payclass">
								<span class="sub-left"><img src="/images/mobile/main/icon/q-icon3.svg"></span>
								<span class="sub-right">교육강의</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/award">
									<span class="sub-left"><img src="/images/mobile/main/icon/q-icon10.svg"></span>
									<span class="sub-right">수상내역</span>
							</a>
						</li>
						<li class="in-sub-left">
							<a href="https://jlinvestment.co.kr/notice">
								<span class="sub-left"><img src="/images/mobile/main/icon/icon-notice.svg"></span>
								<span class="sub-right">공지사항</span>
							</a>
						</li>
						<li>
							<a href="https://jlinvestment.co.kr/h2o">
								<span class="sub-left"><img src="/images/mobile/main/icon/icon-h2o.svg"></span>
								<span class="sub-right">기부행사</span>
							</a>
						</li>
					</ul>

					<div class="menu-event">
						<p class="main-name">기업 REPORT</p>
						<a href="https://jlinvestment.co.kr/issue"><img src="/images/mobile/main/report.png"></a>
					</div>
			</div>
			<div class="menu-esc"><img src="/images/mobile/main/icon/esc.png"></div>
			<div class="menu-bg"></div>

			<script>
				$(".main-menu").click(function(){
					$(".main-menu-in").css({"left":"0"});
					$(".menu-esc").css({"right":"30px"});
					$(".menu-bg").fadeIn();
					$(".header").css({"z-index":"1"})
				})
				$(".menu-esc").click(function(){
					$(".main-menu-in").css({"left":"-150%"});
					$(".menu-esc").css({"right":"-150%"});
					$(".menu-bg").fadeOut();
					$(".header").css({"z-index":"999"})
				})
				$(".menu-bg").click(function(){
					$(".main-menu-in").css({"left":"-150%"});
					$(".menu-esc").css({"right":"-150%"});
					$(".menu-bg").fadeOut();
					$(".header").css({"z-index":"999"})
				})

			</script>
			<!-- 메뉴 추가 End -->
		<div class="contents">
