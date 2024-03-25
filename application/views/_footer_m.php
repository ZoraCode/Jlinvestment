		</div>
<style media="screen">

</style>
		<div class="footer">
			<div class="inner">
			<img src="/images/mobile/main/footer.png" alt="">
				<!-- <div class="ftxts">
					<p>당해 업체는 금융투자업자가 아닌 유사투자자자문업자로, 개별적인 투자상담과<br/>자금운용이 불가능합니다. 투자결과에 따라 투자원금의 손실이<br/>발생 할 수 있으며, 그 손실은 투자자에게 귀속 됩니다.</p>
					<p style="margin-top:10px;">(주)제이엘투자그룹｜대표자:고태욱｜주소:서울 서초구 방배천로 24길11 명림빌딩7층</p>
<p>통신판매업신고:2020-서울서초-0787호｜사업자등록번호:676-87-01641</p>
<p>이메일:jl_investment@naver.com｜대표전화:02-6246-3535｜팩스번호:02-6246-3536</p>
				</div> -->
			</div>
		<!-- </div>
		<div id="privacyPop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
			</div> -->
		</div>
<!-- 
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
			</div> -->
		</div>



<style>
.rbanner{position: fixed;left: 50%;top: 300px;margin-left: 600px;z-index: 999;}
.rbanner ul{}
.rbanner ul li{margin-top: 5px;}

</style>
		<div class="rbanner">
			<ul>
				<li><a href="/vipapply"><img src="/images/common/btn_rb.png" alt=""></a></li>
				<li><img src="/images/common/btn_gotop.png" alt="" id="ontop" class="curp"></li>
				<?if(isset($pn) and $pn=="review"){?>
				<li>
					<a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/review?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><img src="/images/common/btn_review_w.jpg" alt=""></a>
				</li>
				<?}?>
				<?if(isset($pn) and $pn=="profit"){?>
				<li><a <?if($this->session->userdata(DB_PREFIX.'id')){?>href="/profit?mode=write"<?}else{?>href="javascript:go_login();"<?}?>><img src="/images/common/btn_profit_w.jpg" alt=""></a></li>
				<?}?>
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
