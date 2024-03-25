		</div>

		<div class="footer">
			<div class="inner">
				<img src="/images/common/footer.png" alt="">
				<!-- <div class="flogo"><img src="/images/common/footer_logo.png" alt=""></div>
				<div class="ftxts">
					<h5><a href="/company">회사소개</a> &verbar; <a href="#" data-toggle="modal" data-target="#privacyPop" >이용약관</a> | <a href="#" data-toggle="modal" data-target="#policyPop" style="color:#e10000">개인정보취급방침</a> | <a href="/notice">공지사항</a></h5>
					<p>상호 : (주)OK인베스트　　대표자 : 박귀상　　사업자등록번호 : 204-86-58258</p>
					<p>대표전화 : 010-8338-9764　　팩스번호 : 031-8084-3416</p>
					<p>통신판매업신고 : 제2016-서울서초-0225호　　주소 : 경기도 의왕시 이미로 40, 인덕원 IT 벨리 B동 401호</p>
				</div>
				<ul class="snsicos">
					<li><a href="https://www.facebook.com/amazingstock" target="_blank"><img src="/images/common/ico_fb2.png" alt=""></a></li>
					<li><a href="https://band.us/band/66011768" target="_blank"><img src="/images/common/ico_bd.png" alt=""></a></li>
					<li><a href="https://blog.naver.com/joooople" target="_blank"><img src="/images/common/ico_bg.png" alt=""></a></li>
				</ul> -->
			</div>
		</div>
		<!-- <div id="privacyPop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">이용약관</h3>
			</div>
			<div class="modal-body">
				<div class="control-group" style="height:300px;overflow: auto;padding: 20px;line-height:22px">
					<?$settings = getSettings();?>
					<?=$settings["terms"]?>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
			</div>
		</div>

		<div id="policyPop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">개인정보처리방침</h3>
			</div>
			<div class="modal-body">
				<div class="control-group" style="height:300px;overflow: auto;padding: 20px;line-height:22px">
					<?$settings = getSettings();?>
					<?=$settings["privacy"]?>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">닫기</button>
			</div>
		</div>-->



<style>
.rbanner{
	position: fixed;
	left: 50%;
	top: 680px;
	margin-left: 620px;
	z-index: 999;
	display: none;
}
.rbanner ul{}
.rbanner ul li{}
.rbanner ul li img { width: 230px;}
</style>
		<div class="rbanner">
			<ul>
				<!-- <li><a href="/vipapply"><img src="/images/common/btn_rb.png" alt=""></a></li> -->
				<!-- <li><img src="/images/common/btn_gotop.png" alt="" id="ontop" class="curp"></li> -->
				<!--<?if(isset($pn) and $pn=="review"){?>
				<li>
					<a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/review?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><img src="/images/common/btn_review_w.jpg" alt=""></a>
				</li>
				<?}?>
				<?if(isset($pn) and $pn=="profit"){?>
				<li><a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/profit?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><img src="/images/common/btn_profit_w.jpg" alt=""></a></li>
				<?}?>-->
			</ul>
		</div>
	</div>
<script>
$(function(){
	var $header = $(".header").height();
	var $footer = $(".footer").height();
	var extrah = $header+$footer;
	$(".contents").css("min-height",$(window).height()-extrah)
	$(".nav_gnb li").hover(function(){
		var $thisNo = $(this).index();
		$(".nav_gnb_sub ul").hide().eq($thisNo).show();
	},function(){
		//var $thisNo = $(this).index();
		//$(".nav_gnb_sub ul").eq($thisNo).hide();
	});
	$(".nav_wrap .inner").mouseleave(function(){
		$(".nav_gnb_sub ul").hide();
	})
	$(".subnav_wrap").mouseleave(function(){
		$(this).find("ul").hide();
	})

	$("#ontop").click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
	})
})
if($(".sub_lnb2_wrap").length){
	$(document).on("click",".sub_lnb2_wrap",function(){
		$(".sub_lnb2").toggle();
	})
}
</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NP368KZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>
