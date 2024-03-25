var rolling;
$(function(){
	var $moveW = 264;
	var $vcnt = 4;
	var $li_f;
	var $li_e;
	var $speed=600;
	var $tot = $(".review_list>li").length;
	if($tot>4){
		$(".review_list").css("width",$tot*100+"%")
		$(".btn_arrow_l").click(function(){
			if($(".review_list>li").is(":animated")){
				return false;
			}
			var $li1 = $(".review_list>li:eq(0)");
			$li_f = $li1.clone();
			$(".review_list>li").stop().animate({"left":"-="+$moveW},$speed,function(){
				$li1.remove();
				$(".review_list>li").css("left",0)
				$(".review_list").append($li_f)
			}).queue("arrow_l",function(){
				var self = this;
				setTimeout(function() {
					$(self).dequeue("arrow_l");
				}, $speed+400);
			})
		})
		$(".btn_arrow_r").click(function(){
			if($(".review_list>li").is(":animated")){
				return false;
			}
			var $li2 = $(".review_list>li:last-child");
			$li2.css("left","-"+parseInt($moveW*$tot)+"px");
			$li_e = $li2.clone();

			$(".review_list>li").stop().animate({"left":"+="+$moveW},$speed,function(){
				$(".review_list").prepend($li_e)
				$li2.remove();
				$(".review_list>li").css("left",0)
			}).queue("arrow_r",function(){
				var self = this;
				setTimeout(function() {
					$(self).dequeue("arrow_r");
				}, $speed+400);
			})
		})
		
		rolling = setInterval(function(){ $(".btn_arrow_l").click(); }, 4000);
		$(".review_layer").hover(function(){
	//		clearInterval(rolling);
		},function(){
	//		rolling = setInterval(function(){ $(".btn_arrow_l").click(); }, 4000);		
		})
	}
})