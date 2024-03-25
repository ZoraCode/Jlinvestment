

<div class="main_popup">
      
      <div class="layer_cont">
        <div class="img_wrap">
			<a href="https://jlinvestad.com/ad/future1/index.html?l_idkey=1000000045">
          		<img src="/images/mobile/main/popup.png" alt="">
			</a>
        </div>
        <div class="btn_wrap">
          <!-- 오늘 하루 보지 않기 --->
          <button class="btn_today_close"><span>오늘 하루 보지 않기</span></button>
          <!-- 그냥 닫기 --->
          <button class="btn_close">닫기</button>
        </div>
      </div>
    
    </div>


    <script>

var toggleMainPopup = function() {
  
  /* 쿠키 제어 함수 정의 */
  var handleCookie = {
    // 쿠키 쓰기
    // 이름, 값, 만료일
    setCookie: function (name, val, exp) {
      var date = new Date();
      
      // 만료 시간 구하기(exp를 ms단위로 변경)
      date.setTime(date.getTime() + exp * 24 * 60 * 60 * 1000);
      console.log(name + "=" + val + ";expires=" + date.toUTCString() + ";path=/");
      
      // 실제로 쿠키 작성하기
      document.cookie = name + "=" + val + ";expires=" + date.toUTCString() + ";";
    },
    // 쿠키 읽어오기(정규식 이용해서 가져오기)
    getCookie: function (name) {
      var value = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
      return value ? value[2] : null;
    }
  };
  console.log(handleCookie.getCookie("today"));
  
  // 쿠키 읽고 화면 보이게
  if (handleCookie.getCookie("today") == "y") {
    $(".main_popup").removeClass("on");
  } else {
    $(".main_popup").addClass("on");
  }

  // 오늘하루 보지 않기 버튼
  $(".main_popup").on("click", ".btn_today_close", function () {
    handleCookie.setCookie("today", "y", 1);
    $(this).parents(".main_popup.on").removeClass("on");
  });

  // 일반 버튼
  $(".main_popup").on("click", ".btn_close", function () {
    $(this).parents(".main_popup.on").removeClass("on");
  });
}

$(function() {
  toggleMainPopup();
});

    </script>


<?  
	if(!empty($banner)){
		foreach($banner as $val){
			if($val["type"]=="layer"){
?>
			<div class="bannerLayer banner_<?=$val["idx"]?>" style="width:<?=$val['x_size']?>px;height:<?=$val['y_size']?>px;position:absolute;z-index:999999;left:<?=$val['x_pos']?>px;top:<?=$val['y_pos']?>px;display:block;overflow: hidden;background-color: #fff;box-sizing: border-box;box-shadow: 2px 2px 5px #7b7b7b;">

				<?if($val["link"]){?>
					<a href="<?=$val["link"]?>" target="<?=$val["tab"]?>" class="banner_wrapper" style="display: block;width: 100%;height:<?=$val['y_size']?>px;position: relative;border: 1px solid #ddd;box-sizing: border-box;"><?=$val["contents"]?></a>
				<?}else{?>
					<?=$val["contents"]?>
				<?}?>
			</div>
<?
            }
        }
    }
?>

<link href="<?=base_url('assets/css/jquery.slidem.css')?>" rel="stylesheet">

<style>
.contents_wrap{line-height: 0;}
.contents_wrap .contents_05{background-color:#324162;height: 155px;}
.contents_wrap .contents_05 .btn_direct_link{color: #e0ecf8;border: 1px solid #e0ecf8;padding: 26px 0px;display: block;margin: 0 auto;width: 312px;text-align: center;top: 53px;position: relative;font-size: 22px;letter-spacing: -2px;}
.contents_wrap .contents_06{background-color:#222222;}
.contents_wrap .contents_06{background-color:#fec200;height: 155px;}
.contents_wrap .contents_06 .btn_direct_link{color: #000;border: 1px solid #000;padding: 26px 0px;display: block;margin: 0 auto;width: 312px;text-align: center;top: 53px;position: relative;font-size: 22px;letter-spacing: -2px;}
.contents_wrap .contents_07{background-color:#ffffff;}
.contents_wrap .contents_08{background-color:#2d85bf;height: 155px;}
.contents_wrap .contents_08 .btn_direct_link{color: #fff;border: 1px solid #fff;padding: 26px 0px;display: block;margin: 0 auto;width: 312px;text-align: center;top: 53px;position: relative;font-size: 22px;letter-spacing: -2px;}
</style>
			<div class="visual_layer">
				<!-- <div class="slide">
					<ul class="ofh">
						<li data-bg="/images/mobile/main/main_visual1.png" onclick="location.href='/performance'" style="cursor:pointer"></li>
						<li data-bg="/images/mobile/main/main_visual3.png" onclick="location.href='/notice'" style="cursor:pointer"></li>
						<li data-bg="/images/mobile/main/main_visual2.png" onclick="location.href='/notice/0/4280'" style="cursor:pointer"></li>
					</ul>
				</div> -->
				<div class="slide slide1">
					<div class="gallery1">
						<div class="swiper-wrapper">
							<div class="swiper-slide v1"><img src="/images/mobile/main/main_visual6.png" onclick="location.href='/award'" alt="."></div>
							<div class="swiper-slide v2"><img src="/images/mobile/main/main_visual5.png" onclick="location.href='/profit'" alt="."></div>
							<div class="swiper-slide v3"><img src="/images/mobile/main/main_visual1.png" onclick="location.href='/performance'" alt="."></div>
							<div class="swiper-slide v4"><img src="/images/mobile/main/main_visual3.png" onclick="location.href='/notice/0/7425'" alt="."></div>
							<div class="swiper-slide v5"><img src="/images/mobile/main/main_visual2.png" onclick="location.href='/notice/0/4943'" alt="."></div>
						</div>
					</div>
				</div>


				<div class="qick-icon">
					<div class="inner">
						<ui class="q-icon main-box">
							<li>
								<a href="https://jlinvestment.co.kr/company">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon1.svg"></span>
									<span class="q-name">회사소개</span>
								</a>
							</li>
							<li>
								<a href="https://jlinvestment.co.kr/oneminute">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon2.svg"></span>
									<span class="q-name">투자정보</span>
								</a>
							</li>
							<li>
								<a href="https://jlinvestment.co.kr/payclass">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon3.svg"></span>
									<span class="q-name">교육강의</span>
								</a>
							</li>
							<li>
								<a href="https://jlinvestment.co.kr/performance">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon4.svg"></span>
									<span class="q-name">투자성과</span>
								</a>
							</li>
							<li>
								<a href="https://jlinvestment.co.kr/profit">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon5.svg"></span>
									<span class="q-name">수익인증</span>
								</a>
							</li>
							<li>
								<a href="https://jlinvestment.co.kr/review">
									<span class="q-img"><img src="/images/mobile/main/icon/q-icon6.svg"></span>
									<span class="q-name">이용후기</span>
								</a>
							</li>
						</ul>

					</div>
				</div>
				<div class="main-jl main-box">
					<div class="index-in">
						<p class="main-name">제이엘의 다짐</p>
						<span class="main-contents">
							전문성으로 신뢰를 얻는 약속<br>
							JL투자그룹은 고객에게 최상의 서비스를 제공하기 위해<br>
							전문성과 투명한 업무처리를 우선합니다.
						</span>
					</div>
				</div>

				<div class="main-jlnews main-box">
					<div class="index-in">
						<p class="main-name">제이엘 소식</p>
						<div class="main-news main-news3">
							<a href="/h2o">
								<ul>
									<li class="main-news-left">
										<img src="/images/mobile/main/news3.png">
									</li>
									<li class="main-news-right">
										<p class="main-news-tit main-news-tit1">고객과 함께하는 선한 영향력</p>
										Help Together Others 이름으로<br>
										진행되고 있는 기부 캠페인입니다.
									</li>
								</ul>
							</a>
						</div>
						<div class="main-news">
							<a href="/award">
								<ul>
									<li class="main-news-left">
										<img src="/images/mobile/main/news1.png">
									</li>
									<li class="main-news-right">
										<p class="main-news-tit main-news-tit1">고객만족 브랜드 대상</p>
										높은 브랜드 가치를 인정받아<br>
										2023 소비자 만족 브랜드 대상 수상
									</li>
								</ul>
							</a>
						</div>
						<div class="main-news main-news2">
							<a href="/notice/0/4280">
								<ul>
									<li class="main-news-left">
										<img src="/images/mobile/main/news2.png">
									</li>
									<li class="main-news-right">
										<p class="main-news-tit main-news-tit2">회사 사칭 경고</p>
										저희 회사를 사칭한 사기 행위가<br>
										증가하고 있습니다. 개인정보 제공은<br>
										삼가해주세요.
									</li>
								</ul>
							</a>
						</div>
					</div>
				</div>

				<div class="main-vip index-in">
					<p class="main-name">VIP 체험신청</p>
				</div>
					<a class="main-vip-img" href="https://jlinvestment.co.kr/vipapply"><img src="/images/mobile/main/go-vip.png"></a>

				<div class="main-is main-box">
					<div class="index-in">
						<p class="main-name">언론속 제이엘</p>
						<div class="slide">
							<div class="gallery2">
								<div class="swiper-wrapper">
									<div class="swiper-slide"><img src="/images/mobile/main/main-news1.png" onclick="location.href='/notice/0/7181'" alt="."></div>
									<div class="swiper-slide"><img src="/images/mobile/main/main-news2.png" onclick="location.href='/performance/0/7597'" alt="."></div>
									<div class="swiper-slide"><img src="/images/mobile/main/main-news3.png" onclick="location.href='/notice/0/7425'" alt="."></div>
									<div class="swiper-slide"><img src="/images/mobile/main/main-news4.png" onclick="location.href='/notice/0/7626'" alt="."></div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>


<script src="<?=base_url('assets/js/jquery.slide.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.slide').slide({'slideSpeed': 3000,'isShowArrow': true,'dotsEvent': 'mouseenter','isLoadAllImgs': true,'isHoverShowArrow':false});
	$(".visual_layer img").show();
});
</script>


<script type="text/javascript">
	$(function () {

		var mySwiper1 = new Swiper ('.gallery1', {
		 loop: true, //순환유무	 
		 pagination: '.nav3', //네비게이션class명
		 grabCursor: true, //커서 손모양
		 autoplay: 6000, //자동진행
		 effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
		 slidesPerView: 1, // 슬라이드를 한번에 3개를 보여준다
         slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
		 spaceBetween:  0, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
		 loopFillGroupWithBlank : true,
	
		 //이전 다음 버튼
		 nextButton: '.swiper-button-next',
		 prevButton: '.swiper-button-prev',
	   });


		var mySwiper1 = new Swiper ('.gallery2', {
			loop: true, //순환유무	 
			pagination: '.nav3', //네비게이션class명
			grabCursor: true, //커서 손모양
			autoplay: 4000, //자동진행
			effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
			slidesPerView: 1, // 슬라이드를 한번에 3개를 보여준다
			slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
			spaceBetween:  30, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
			loopFillGroupWithBlank : true,
		
			//이전 다음 버튼
			nextButton: 'none',
			prevButton: 'none',
		});

		var mySwiper1 = new Swiper ('.gallery3', {
		 loop: true, //순환유무	 
		 pagination: '.nav3', //네비게이션class명
		 grabCursor: true, //커서 손모양
		 autoplay: 4000, //자동진행
		 effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
		 slidesPerView: 1, // 슬라이드를 한번에 3개를 보여준다
         slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
		 spaceBetween:  0, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
		 loopFillGroupWithBlank : true,
	
		 //이전 다음 버튼
		 nextButton: '.swiper-button-next',
		 prevButton: '.swiper-button-prev',

	   });

	});
</script>