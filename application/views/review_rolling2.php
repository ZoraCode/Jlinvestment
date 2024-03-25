<?
$review = $this->Common_db_model->get_row("", board, array('category' => 'profit') ,'idx desc','12','');
if(count($review)){
?>
<style>
.review_layer{background-color:#2C2D2E;   }
.back_img{background-image: url("/images/main/contents02.png");}
.review_layer .main_review_layer_txt{margin: 0 auto 30px;display: block;position: relative;}
.review_layer .btn_arrow_l{position: absolute;left: 20px;top: 320px;z-index: 9;}
.review_layer .btn_arrow_r{position: absolute;right: 20px;top: 320px;z-index: 9;}
.review_layer .review_wrap{margin-bottom: 70px;position: relative;width: 1060px;overflow:hidden;margin-left: 50px;}
.review_layer .review_wrap .review_list{overflow:hidden;width: 5060px;position: relative;width: 400%;z-index: 8;margin-top: 200px;}
.review_layer .review_wrap .review_list li{position: relative; float: left; width: 256px; height: 360px; margin: 0 4px; box-sizing: border-box;}
.review_layer .review_wrap .review_list li .ico_avatar{margin: 0 auto 23px;display: block;}
.review_layer .review_wrap .review_list li h4{text-align: center;margin-bottom: 24px;color: #000;font-size: 18px;line-height: 1.3;height: 2.6em;overflow: hidden;text-overflow: ellipsis;}
.review_layer .review_wrap .review_list li p{text-align: center;margin-bottom: 34px;color: #626262;display: inline-block;overflow: hidden;text-overflow: ellipsis;white-space: normal;line-height: 1.2;height: 3.6em;}
.review_layer .review_wrap .review_list li span.date{text-align: center;color: #c7c7c7;display: block;}

</style>
				<div class="review_layer contents_layer">
					<div class="inner">
						<div class="back_img">
						<img src="/images/main/arrow_l.png" class="btn_arrow_l curp" alt="">
						<div class="review_wrap">
							<ul class="review_list">
								<li class="0 curp">
									<img src="/images/main/contents02_1.png" class="ico_avatar" alt="">
								</li>
								<li class="0 curp">
									<img src="/images/main/contents02_2.png" class="ico_avatar" alt="">
								</li>
								<li class="0 curp">
									<img src="/images/main/contents02_3.png" class="ico_avatar" alt="">
								</li>
								<li class="0 curp">
									<img src="/images/main/contents02_4.png" class="ico_avatar" alt="">
								</li>
								<li class="0 curp">
									<img src="/images/main/contents02_5.png" class="ico_avatar" alt="">
								</li>
								<li class="0 curp">
									<img src="/images/main/contents02_6.png" class="ico_avatar" alt="">
								</li>
							</ul>
						</div>
						<img src="/images/main/arrow_r.png" class="btn_arrow_r curp" alt="">
					</div>
				</div>
					<script src="<?=base_url('assets/js/review.js?v='.getUpdateDate())?>"></script>
				</div>
<?}?>
