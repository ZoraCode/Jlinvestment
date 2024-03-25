<style type="text/css">
.tbl_qna{}
.tbl_qna tr.tr_p{cursor:pointer;}
.tbl_qna tr.tr_p td{color: #000;}
.tbl_qna tr.tr_p td span.icon_down{float:right;margin-right: 20px;}
.tbl_qna tr td.title{color: #333333;}
.tbl_qna tr td{border-right: 0;}
.tbl_qna tr.tr_c{display:none;}
.tbl_qna tr.tr_c td{padding:20px;box-sizing:border-box;background-color:#f7f7f7;line-height:22px;}
.tbl_qna tr.tr_c td p{line-height: 25px;}
.tbl_qna tr.tr_p td:nth-child(1) span{background-color: #aaaaaa;color: #fff;padding: 1px 7px 3px 7px;border-radius: 15px;width: 25px;height: 25px;text-align: center;}
.tbl_qna tr.tr_c td:nth-child(1) span{background-color: #bc0f17;color: #fff;padding: 1px 7px 3px 7px;border-radius: 15px;width: 25px;height: 25px;text-align: center;}
</style>
			<div class="inner mt80">
				<h1 class="board_title"><?=$t2?></h1>
				<table class="tbl_board tbl_qna" cellspacing="0" cellpadding="0" border="0" width="100%">
					<col width="75px"/>
					<col width="*"/>
				  <? 
					foreach($faq as $row){
						$idx = $row["idx"];
						$subject = $row["subject"];
						$contents = $row["contents"];
				  ?>


					<tr class="tr_p">
						<td><span>Q</span></td>
						<td class="title"><?=$subject?><span class="icon_down"><img src="/images/common/ico_down.png" class="icon_arrow" alt=""></span></td>
					</tr>
					<tr class="tr_c">
						<td><span>A</span></td>
						<td class="text-left">
							<?=$contents?>
						</td>
					</tr>

				  <? } ?>
					<tr class="lst">
						<td colspan="5"></td>
					</tr>
				</table>
			</div>
<script>
$(function(){
	$("tr.tr_p").click(function(){
		$(this).next().toggle().siblings(".tr_c").hide();
		$("tr.tr_p .icon_arrow").attr("src","/images/common/ico_down.png")
		var ico = $(this).next().is(":visible")?"/images/common/ico_up.png":"/images/common/ico_down.png"
		$(this).find(".icon_arrow").attr("src",ico)
	});	
})
</script>