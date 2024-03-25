document.addEventListener('DOMContentLoaded',function(){


$(function(){
	$(window).scroll(function(){
		ftm();	
	})
	$(".ftm_top").click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
	})
	ftm();
	function ftm(){
		var _topH = $(".header .top").height();

		if($(window).scrollTop()>=_topH){
			$(".nav_wrap").addClass("nav_fixed")
		}else{
			$(".nav_wrap").removeClass("nav_fixed")
		}
	}
});


$(function(){
	let secContainer = $('.sld-img');  
	let sec1Ratio = 1920/1000;

	$(window).resize(function(){
		let winWidth = $(window).width();
		let winHeight = $(window).height();
		let browserRatio = winWidth/winHeight;
		if(browserRatio < sec1Ratio){
			secContainer.css({
				height: '100%', 
				width: winHeight * sec1Ratio,
				top: 0,
				left: (winWidth - (winHeight * sec1Ratio))/2
			});
		} else{
			secContainer.css({
				width: '100%', 
				height: winWidth/sec1Ratio,
				left: 0,
				top: (winHeight - winWidth / sec1Ratio)/2
			});
		}
	});

	$(window).trigger('resize');
}); 



// next prev
const sec1Swiper = new Swiper('.mn_three', {
	slidesPerView: 1,
	autoplay: {
		delay: 9000,
	},
	direction: 'horizontal',
	loop: true,

	scrollbar: {
		el: '.swiper-scrollbar',
	},
});  

$('.sec1_prev').click(function(){
	sec1Swiper.slidePrev();
});
$('.sec1_next').click(function(){
	sec1Swiper.slideNext();
}); 



const titles = document.querySelectorAll('.sec3 .title h2, .sec3 .title h3, .sec3 .title p, .sec3 .md-logo, .sec4 .title h2, .sec4 .title h3, .sec4 .title p');

window.addEventListener('scroll', function(){
    const titleTop = window.scrollY || document.documentElement.scrollTop;

    titles.forEach(function(title){
        if(title.offsetTop - 850 <= titleTop){
            title.classList.add('move');
        }
    });
});




const TubeSwiper = new Swiper('.tube', {
  slidesPerView: 4,
  
  direction: 'horizontal',
  loop: true,
  autoplay: {
    delay: 8000,
  },
  breakpoints: {
        
    400: {
      slidesPerView:2,  //브라우저가 768보다 클 때
    },
    1024: {
      slidesPerView: 4,  //브라우저가 1024보다 클 때
    },
  },
});


document.querySelectorAll('.you_btn a').forEach(function(element) {
	element.addEventListener('click', function(e) {
			e.preventDefault();
			
			// 목표 위치 얻기
			let target = this.getAttribute('data-index');

			// sec3swiper.slideTo 호출
			TubeSwiper.slideTo(target);
	});
});





let aside = document.querySelector('.aside'),
    OST = document.querySelector('.sec2').offsetTop,
    Scroll = 0;

window.addEventListener('scroll',()=>{
  Scroll = window.scrollY; 
  if(Scroll > OST - 800){
    aside.classList.add('active');
  } else{
    aside.classList.remove('active');
  }
});


$(function(){
	let focus = $('.back_img');  
	let view = 1920/1000;

	$(window).resize(function(){
		let winWidth = $(window).width();
		let winHeight = $(window).height();
		let browserRatio = winWidth/winHeight;
		if(browserRatio < view){
			focus.css({
				height: '100%', 
				width: winHeight * view,
				top: 0,
				left: (winWidth - (winHeight * view))/2
			});
		} else{
			focus.css({
				width: '100%', 
				height: winWidth/view,
				left: 0,
				top: (winHeight - winWidth / view)/2
			});
		}
	});

	$(window).trigger('resize');
}); 




$(function () {
	$(".blur_black").bxSlider({
		minSlides: 5,
		maxSlides: 12,
		slideWidth: 3860,
		slideMargin: 0,
		ticker: true,
		// tickerHover: true,
		speed: 40000,
	});
});



// 요소가 뷰포트 내에 있는지 확인하는 함수
function isElementInViewport(el) {
	let rect = el.getBoundingClientRect();
	return (
			rect.top >= 0 &&
			rect.left >= 0 &&
			rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
			rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
}

// 카운팅 애니메이션을 시작하는 함수
function startCountingAnimation() {
	$('.nums').each(function () {
			const $this = $(this),
					countTo = $this.attr('data-count');

			$({
					countNum: $this.text()
			}).animate({
					countNum: countTo
			}, {
					duration: 2000,
					easing: 'linear',
					step: function () {
							$this.text(Math.floor(this.countNum));
					},
					complete: function () {
							$this.text(this.countNum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
					}
			});
	});
}

// 스크롤 이벤트가 발생할 때 "Text_h2o" 클래스를 가진 요소가 뷰포트 내에 있는지 확인
document.addEventListener('scroll', function () {
	let element = document.querySelector('.Text_h2o');
	if (isElementInViewport(element)) {
			startCountingAnimation();
			// 애니메이션을 한 번 트리거한 후에 이벤트 리스너를 제거합니다 (선택 사항)
			document.removeEventListener('scroll', arguments.callee);
	}
});





// .swiper-slide 요소를 선택합니다.
let swiperSlides = document.querySelectorAll('.sec6 .tube_list li');

// 각 .swiper-slide 요소에 이벤트 리스너를 추가합니다.
swiperSlides.forEach(swiperSlide => {
    // 마우스가 요소에 진입할 때
    swiperSlide.addEventListener('mouseenter', () => {
        // 해당 .swiper-slide 내부의 <a> 요소를 선택합니다.
        let link = swiperSlide.querySelector('a');
        // 선택한 <a> 요소에 'active' 클래스를 추가합니다.
        link.classList.add('active');
    });

    // 마우스가 요소를 벗어날 때
    swiperSlide.addEventListener('mouseleave', () => {
        // 해당 .swiper-slide 내부의 <a> 요소를 선택합니다.
        let link = swiperSlide.querySelector('a');
        // 선택한 <a> 요소에서 'active' 클래스를 제거합니다.
        link.classList.remove('active');
    });
});


});