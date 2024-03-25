

<!-- <div class="main_popup">
      
      <div class="layer_cont">
        <div class="img_wrap">
			<a href="https://jlinvestad.com/ad/future1/index.html?l_idkey=1000000045">
				<div>
					<p>Text</p>
				</div>
			</a>
        </div>
        <div class="btn_wrap">
					

          <button class="btn_today_close"><span>오늘 하루 보지 않기</span></button>

  
          <button class="btn_close">닫기</button>
        </div>
      </div>
    
</div> -->


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

<link href="<?=base_url('assets/css/jquery.slide.css')?>" rel="stylesheet">
<style>
.vip2{background: url('/images/main/contents02_bg.png') no-repeat  50%; position: relative;}
/* .contents_03{background: url('/images/main/contents03_bg.png') no-repeat  50%; position: relative;} */
.contents_04{background-color:#fff; position: relative;}
</style>



<!-- Body -->


<section class="sec1">

	<div class="swiper mn_three">

		<div class="swiper-wrapper">
			
	
			<div class="swiper-slide">
				<div class="sld-img">
					<video class="ima" src="/images/main/pexels-tima-miroshnichenko-7578609.mp4" preload="auto" muted autoplay loop></video>
				</div>

				<div class="title">
					<h2>"JL 투자그룹" 필란트로피 클럽 가입 <br>
					후원을 넘어, 가치를 실현?</h2>
					<div class="line"></div>
					<h3>기아대책 후원자 리딩그룹, 1억원 이상을 기부, 약정한 후원자 기업</h3>
				</div>
			</div>

			
			<div class="swiper-slide">
				<div class="sld-img">
					<img  class="ima" src="/images/main/Main2.png" alt="">
				</div>

				<div class="title">
					<h2>2024 대한민국 소비자만족도 1위 <br>
					올해의 소비자 브랜드 대상</h2>
					<div class="line"></div>
					<h3>제이엘투자그룹은 보다 나은 브랜드와 만족도를 높이기 위해 끊임없이 노력한 결과,<br>
					 그 가치를 인정받아 중앙일보가 후원하는 브랜드 대상 1위에 선정되었습니다.</h3>
				</div>
			</div>


			<div class="swiper-slide">
				<div class="sld-img">
					<img  class="ima" src="/images/main/Main3.png" alt="">
				</div>

				<div class="title">
					<h2>제이엘투자그룹 사칭 안내</h2>
					<div class="line"></div>
					<h3>최근 제이엘투자그룹을 사칭하여 해외선물 대여계좌 알선, 코인 권유 등의 행위를 포착하였습니다. <br>
					 현재 수천만원의 피해액이 확인 되었고, 저희 제이엘투자그룹은 해외선물 대여계좌 알선과 코인 권유 등을 하지 않습니다. <br>
					 각별히 주의해주시기 바라며 공지사항을 꼭 필독해주시기 바랍니다.</h3>
				</div>
			</div>

		</div>


		<div class="buton">
			<div class="sec1_prev swiper-button-prev"></div>
			<div class="swiper-scrollbar"></div>
			<div class="sec1_next swiper-button-next"></div>
		</div>
		

	</div>
</section>



<section class="kospi">
	<div></div>
</section>



<section class="sec2">

	<div class="report"><a href="https://jlinvestment.co.kr/issue">
		<h2>기업 report</h2>
		<h3>다양한 기업의 최신 정보를 한눈에 확인해보세요!</h3>

		<button class="button">view more</button>
	</a></div>


	<div class="investment"><a href="https://jlinvestment.co.kr/performance">
		<h2>투자 성과</h2>
		<h3>VIP 회원님들의 실제 수익률을 투명하게 공개합니다.</h3>

		<button class="button">view more</button>
	</a></div>


	<div class="awarded"><a href="https://jlinvestment.co.kr/award">
		<h2>수상 내역</h2>
		<h3>소비자만족 브랜드 대상 <br>
		중앙일보가 후원하는 2023 소비자 만족 브랜드 1위</h3>

		<button>view more</button>
	</a></div>

</section>



<div class="animation">
	
	<div class="brand">
		<img src="../../images/main/teba.png" alt="브랜드 대상">
		<div class="ttl">
			<h2>소비자만족 브랜드 대상</h2>	
			<p>중앙일보가 후원하는 2023 <br>
			소비자만족 브랜드 대상 1위</p>
		</div>
	</div>
	
	<div class="brand">
		<img src="../../images/main/gia.png" alt="브랜드 대상">
		<div class="ttl">
			<h2>필란트로피 위촉</h2>	
			<p>1억원 이상을 기부 또는<br>
			약정한 개인 후원자 모임</p>
		</div>
	</div>

	<div class="brand">
		<img src="../../images/main/kcsba.png" alt="브랜드 대상">
		<div class="ttl">
			<h2>고객만족 브랜드 대상</h2>	
			<p>2022년 소비자에 높은<br>
			만족감을 제공 <br>
			대한민국 고객만족도 1위</p>
		</div>
	</div>

	<div class="brand">
		<img src="../../images/main/gz.png" alt="브랜드 대상">
		<div class="ttl">
			<h2>광주광역시장 표창</h2>	
			<p>2021년 장애인 복지증진,<br>
			권잉향상장애인복지 유공에수상</p>
		</div>
	</div>
	

</div>

<!-- 
<div class="animation">
	
	<div class=""><p>JL investment group. We seek trust as a core value.</p></div>
	<div class=""><p>PERSONALIZED STOCK CONSULTING..</p></div>
	<div class=""><p>JL investment group. We seek trust as a core value.</p></div>
	<div class=""><p>PERSONALIZED STOCK CONSULTING..</p></div>
</div>
-->


<section class="sec4">
	<div class="title">
		<p class="ops op">VIP 회원님들의 100% 리얼 후기</p>
		<h2 class="ops op">직접 확인해 보세요 <br>
		<span>실시간</span> 회원의 리뷰 <i class="fa-regular fa-comment"></i></h2>
		<!-- <h3 class="ops op">" JL투자그룹은 <span>전문성과 신뢰</span>를 통해 고객만족을 이행할 것을 약속하며 새로운 변화에 대한 꿈을 이루어 드립니다. "</h3> -->
	</div>

	<div class="review container">

		<div class="con_one">
			
			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/1s.png" alt=""></div>
				<div class="text">
					<h4>스탁파이터</h4>
						<div class="d-flex">
							<p>수익률 : <span>+25%</span></p> 
							<p>수익금 : <span>+5,500,000</span></p>
						</div>
						<p class="they">대표님~!! 선물의 달인으로 인정합니다. 회사업무도 바쁘고 수차례 고민하다가 솔직한 심정의 수익후기 올려드립니다.</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/2s.png" alt=""></div>
				<div class="text">
					<h4>수잔</h4>
						<div class="d-flex">
							<p>수익률 : <span>+15%</span></p> 
							<p>수익금 : <span>+5,600,000</span></p>
						</div>
						<p class="they">수익으로 기분좋게 사전결제 해봅니다. 이젠 계좌수익도 넘쳐나길 ~</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/3s.png" alt=""></div>
				<div class="text">
					<h4>대박화이팅</h4>
						<div class="d-flex">
							<p>수익률 : <span>+8%</span></p> 
							<p>수익금 : <span>+3,000,000</span></p>
						</div>
						<p class="they">이제는 좀 수익이 되길~ 1000만원으로 잘 따라가고 있습니다. 곧 1500만원으로 하려구요</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit"> 
				<div class="img"><img class="" src="/images/main/4s.png" alt=""></div>
				<div class="text">
					<h4>가브리엘</h4>
						<div class="d-flex">
							<p>수익률 : <span>+28%</span></p>
							<p>수익금 : <span>+16,200,000</span></p>
						</div>
						<p class="they">대표님을 첨부터 만났으면 얼마나 좋았을까요 ㅠㅜㅜ 그럼 저게 다 수익이였을텐데!!!까비까비 앞으로 더 잘부탁드려용ㅋㅋ</p>
				</div>
			</a></div>


		</div>

		<div class="con_two">
			
			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/5s.png" alt=""></div>
				<div class="text">
					<h4>흑돈</h4>
						<div class="d-flex">
							<p>수익률 : <span>+16%</span></p> 
							<p>수익금 : <span>+26,460,000</span></p>
						</div>
						<p class="they">머라 설명할 말이 없네요^^ 직접 체험하시는 수밖에!! 후기 믿지 않았지만 제가 올리게 되네요! 대표님 대박입니다!</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/6s.png" alt=""></div>
				<div class="text">
					<h4>가브리엘</h4>
						<div class="d-flex">
							<p>수익률 : <span>+17%</span></p> 
							<p>수익금 : <span>+8,900,000</span></p>
						</div>
						<p class="they">투자금 늘리지마자 하락장에 마이너스 늪에 빠져서 이게 맞나싶을정도로 충격적이였는데 전 이제서야 본전됐어요^^;; 박프로님도 좋았지만 미래예측불가능한건 맞지만 몇번 반복되고 돈삭제되니 멘붕이였거든요 ㅠㅠ 대표님으로 바뀌고부터 본전 빠른시간에 되찾아서 다시 jl맹신!! 기한이 얼마안남아서 가입비용+수익 났으면 좋겠어요!! 그래서 재가입하고싶습니다!! 대표님 감사해요 매니저님두여^^</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit">
				<div class="img"><img class="" src="/images/main/7s.png" alt=""></div>
				<div class="text">
					<h4>무야</h4>
						<div class="d-flex">
							<p>수익률 : <span>+14%</span></p> 
							<p>수익금 : <span>+15,230,000</span></p>
						</div>
						<p class="they">제이얼 선물은 전국최고실력 인정합니다.</p>
				</div>
			</a></div>

			<div class="click"><a href="https://jlinvestment.co.kr/profit"> 
				<div class="img"><img class="" src="/images/main/8s.png" alt=""></div>
				<div class="text">
					<h4>돌맹</h4>
						<div class="d-flex">
							<p>수익률 : <span>+19%</span></p>
							<p>수익금 : <span>+34,440,000</span></p>
						</div>
						<p class="they">3천만원 넘게 수익 신기하네요 역시 대표님리딩</p>
				</div>
			</a></div>


		</div>

	</div>

</section>


<section class="sec5">
	<h2><strong>뛰어난 전문가</strong>와 함께 성장하는 <span>VIP</span> <br>
	<span>JL 투자그룹</span>은 전문성으로 <strong>증명</strong>합니다.</h2>

	<div class="d-flex">
		<h3>JL 투자그룹의 <strong>VIP 체험신청</strong>은 모든 과정이 <strong>무료</strong>로 진행됩니다.</h3>

		<button><a href="https://jlinvestment.co.kr/vipapply">신청하기</a></button>
	</div>
</section>


<section class="help">

	<div class="help_box">
	
		<div class="back_img">
			<img src="../../images/main/h2o_3.png" alt="">
		</div>

		<div class="container">
			<img class="lin" src="../../images/main/text.png" alt="">
		</div>

	</div>


</section>



<section class="sec3">
	<div class="background"></div>
	
		<div class="d-flex container">
		<!-- <div class="title">
			<p class="ops op">H2O 캠페인</p>
			<h2 class="ops op">제이엘 기부 <span>&amp;</span> 봉사활동</h2>
			<h3 class="ops op"><strong>JL 투자그룹</strong>은 기업과 투자자 수익금의 일부를 <br>
				도움이 필요한곳에 <strong>사회환원</strong>을 하며<br>
				<strong>H2O 캠페인</strong>으로 희망의 손을 뻗어왔습니다. <br><br>
				올바른 투자문화 정착 뿐만 아니라, 더멀리 나아가 <br>
				<strong>기업</strong>이 가져야할 <strong>사회적 책임, 윤리적책임</strong> 등의 <br>
				<strong>의무</strong>를 다하여 모두가 <strong>행복한 세상</strong> 을 만들겠습니다. <br><br>
				<strong class="str">위대한 나눔에 여러분도 함께 손을 모아주세요.</strong></h3> 
		</div> -->

		<!-- <div class="md-logo ops op">
			<img class="heart_a" src="/images/main/Heart_A.svg" alt="">
			<img class="heart_b" src="/images/main/Heart_B.svg" alt="">
		</div> -->
	</div>
	<div class="camp">
		<div class="blur_black">
			<img src="../../images/main/mho_1.png" alt="">
			<img src="../../images/main/mho_2.png" alt="">
			<img src="../../images/main/mho_3.png" alt="">
			<img src="../../images/main/mho_4.png" alt="">
			<img src="../../images/main/mho_5.png" alt="">
			<img src="../../images/main/mho_6.png" alt="">
			<img src="../../images/main/mho_7.png" alt="">
			<img src="../../images/main/mho_8.png" alt="">
			<img src="../../images/main/mho_9.png" alt="">
			<img src="../../images/main/mho_10.png" alt="">
			<img src="../../images/main/mho_11.png" alt="">
			<img src="../../images/main/mho_12.png" alt="">
		</div>

		<div class="Text_h2o">
			<h4><strong>h</strong>elp <strong>t</strong>ogether <strong>o</strong>thers</h4>
			<h5>JL 기부 및 봉사활동 사례</h5>
			<h6>총 <strong class="nums" data-count="15">0</strong> 회 기부 금액 : <span class="nums" data-count="150"></span><span>,000,000원</span></h6>
		
		</div>

	</div>

</section>

<section class="sec6">
	<div class="title container">
		<p>JLINVESTMENT STORY</p>
		<h2>제이엘 컨텐츠로<br>다양한 정보도 확인해보세요!</h2>
	</div>

	<ul class="you_btn container">
		<li class=""><a href="" data-index="0">새로운 소식</a></li>
		<li class=""><a href="" data-index="4">기부 행사</a></li>
		<li class=""><a href="" data-index="9">공지 사항</a></li>
  </ul>

	<div class="swiper tube container">
		
		<!-- Additional required wrapper -->
		<ul class="swiper-wrapper tube_list">
			<!-- Slides -->
			<li class="swiper-slide"><a href="https://www.youtube.com/@JLINVESTMENT" target="_blank"><img src="/images/main/tube_a.png" alt="유뷰트 이미지"></a></li>
			<li class="swiper-slide"><a href="https://www.youtube.com/@JLINVESTMENT" target="_blank"><img src="/images/main/tube_b.png" alt="유뷰트 이미지"></a></li>
			<li class="swiper-slide"><a href="https://www.youtube.com/@JLINVESTMENT" target="_blank"><img src="/images/main/tube_c.png" alt="유뷰트 이미지"></a></li>
			<li class="swiper-slide"><a href="https://www.youtube.com/@JLINVESTMENT" target="_blank"><img src="/images/main/tube_d.png" alt="유뷰트 이미지"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/h2o" target="_blank"><img src="/images/main/tube_e.png" alt="기부행사 이미지"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/h2o" target="_blank"><img src="/images/main/tube_f.png" alt="기부행사 이미지"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/h2o" target="_blank"><img src="/images/main/tube_g.png" alt="기부행사 이미지"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/h2o" target="_blank"><img src="/images/main/tube_h.png" alt="기부행사 이미지"></a></li>
			<!-- <li class="swiper-slide"><a href="https://jlinvestment.co.kr/h2o"><img src="/images/main/tube_i.png" alt="기부행사 이미지"></a></li> -->
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/notice" target="_blank"><img src="/images/main/tube_j.png" alt="공지사항"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/notice" target="_blank"><img src="/images/main/tube_k.png" alt="공지사항"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/notice" target="_blank"><img src="/images/main/tube_l.png" alt="공지사항"></a></li>
			<li class="swiper-slide"><a href="https://jlinvestment.co.kr/notice" target="_blank"><img src="/images/main/tube_m.png" alt="공지사항"></a></li>
		</ul>
	</div>

</section>




<aside class="aside opm">
	<div class="kakao">
		<a href="https://open.kakao.com/o/sWuh4l9c" target="_blank">
			<img src="/images/main/kakao.png" alt="카카오">
		</a>
		<p>카카오톡</p>
	</div>
	<div class="blog">
		<a href="https://blog.naver.com/jl_investment" target="_blank">
			<img src="/images/main/blog.png" alt="블로그">
		</a>
		<p>블로그</p>
	</div>
	<div class="betu">
		<a href="https://www.youtube.com/@JLINVESTMENT" target="_blank">
			<img src="/images/main/tube.png" alt="유튜브">
		</a>
		<p>유튜브</p>
	</div>
	<div class="Top">
		<a class="top_up" href="#">
			<img src="/images/main/call.png" alt="탑버튼">
		</a>
		<p>홈으로</p>
	</div>
</aside>


<!-- Body -->


<script src="<?=base_url('assets/js/jquery.slide.js')?>"></script>
<!-- <script type="text/javascript">
$(function() {
	$('.slide').slide({'slideSpeed': 3000,'isShowArrow': true,'dotsEvent': 'mouseenter','isLoadAllImgs': true,'isHoverShowArrow':false});
	$(".visual_layer img").show();
});
</script> -->

<script type="text/javascript">
	// $(function () {

	// 	var mySwiper1 = new Swiper ('.gallery1', {
	// 	 loop: true, //순환유무	 
	// 	 pagination: '.nav3', //네비게이션class명
	// 	 grabCursor: true, //커서 손모양
	// 	 autoplay: 6000, //자동진행
	// 	 effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
	// 	 slidesPerView: 1, // 슬라이드를 한번에 3개를 보여준다
  //        slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
	// 	 spaceBetween:  0, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
	// 	 loopFillGroupWithBlank : true,
	
	// 	 //이전 다음 버튼
	// 	 nextButton: '.swiper-button-next',
	// 	 prevButton: '.swiper-button-prev',
	//    });


	// 	var mySwiper1 = new Swiper ('.gallery2', {
	// 		loop: true, //순환유무	 
	// 		pagination: '.nav3', //네비게이션class명
	// 		grabCursor: true, //커서 손모양
	// 		autoplay: 4000, //자동진행
	// 		effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
	// 		slidesPerView: 3, // 슬라이드를 한번에 3개를 보여준다
	// 		slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
	// 		spaceBetween:  40, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
	// 		loopFillGroupWithBlank : true,
		
	// 		//이전 다음 버튼
	// 		nextButton: 'none',
	// 		prevButton: 'none',
	// 	});

	// 	var mySwiper1 = new Swiper ('.gallery3', {
	// 	 loop: true, //순환유무	 
	// 	 pagination: '.nav3', //네비게이션class명
	// 	 grabCursor: true, //커서 손모양
	// 	 autoplay: 4000, //자동진행
	// 	 effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
	// 	 slidesPerView: 2, // 슬라이드를 한번에 3개를 보여준다
  //        slidesPerGroup : 2, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
	// 	 spaceBetween:  40, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
	// 	 loopFillGroupWithBlank : true,
	
	// 	 //이전 다음 버튼
	// 	 nextButton: '.swiper-button-next',
	// 	 prevButton: '.swiper-button-prev',

	//    });

	//    var mySwiper1 = new Swiper ('.gallery11', {
	// 	 loop: true, //순환유무	 
	// 	 pagination: '.nav3', //네비게이션class명
	// 	 grabCursor: true, //커서 손모양
	// 	 autoplay: 4000, //자동진행
	// 	 effect: 'slide', // 'slide' or 'fade' or 'cube' or 'coverflow' or 'flip'
	// 	 slidesPerView: 3, // 슬라이드를 한번에 3개를 보여준다
  //        slidesPerGroup : 1, // 그룹으로 묶을 수, slidesPerView 와 같은 값을 지정하는게 좋음
	// 	 spaceBetween:  0, // 슬라이드간 padding 값 30px 씩 떨어뜨려줌
	// 	 loopFillGroupWithBlank : true,
	
	// 	 //이전 다음 버튼
	// 	 nextButton: '.swiper-button-next',
	// 	 prevButton: '.swiper-button-prev',
	//    });
	// });


</script>