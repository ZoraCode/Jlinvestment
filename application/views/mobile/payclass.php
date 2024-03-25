<style>
.tbl_board{margin-bottom: 20px;}
.input_txt{width: 100%;box-sizing: border-box;padding: 2px 10px;margin: 0px;min-height: 33px;}
/* .tbl_board td:nth-child(1){border-right: 0;} */
.tbl_board tr td .subject{white-space: pre-wrap;;word-wrap: normal;overflow: hidden; text-overflow: ellipsis;}
.tbl_board tr td:nth-child(1) {width: 30%; vertical-align: middle;}
.tbl_board tr td:nth-child(2){width: 70%;text-align: left; padding-left: 30px;}
.tbl_board tr:nth-child(1){border-top: 1px solid #c9c9c9;}
.tbl_board tr:last-child td {border: 0;}
.tbl_board tr:nth-child(3) td {border: 0;}
/* .tbl_board tr:nth-child(3) td p {line-height: 30px;} */

.payvideo_layer{width: 100%;display: inline-block;}
.payvideo_layer li{width:240px;height:315px;float:left;border:1px solid #ccc;margin-right:20px;margin-bottom: 20px;cursor:pointer;box-sizing:border-box;}
.payvideo_layer li:nth-child(3n){margin-right:0;}
.payvideo_layer li .img_layer{width:240px;height:191px;overflow:hidden;position:relative;background-color:#d4d4d4;}
.payvideo_layer li .img_layer img{width:100%;position:absolute;left:0;right:0;top:0;bottom:0;margin:auto;}
.payvideo_layer li .review_contents_layer{padding: 12px;height: 122px;box-sizing: border-box;}
.payvideo_layer li .review_contents_layer p.title{font-weight: 600;border-bottom: 1px solid #ccc;padding-bottom: 0;display: inline-block;width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: normal;line-height: 23px;height: 3em;}
.payvideo_layer li .review_contents_layer p.name{margin-top: 12px;margin-bottom: 12px;}
.payvideo_layer li .review_contents_layer .review_contents{display: inline-block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; white-space: normal; line-height: 1.2; height: 4.6em;}
.payvideo_layer li .review_contents_layer .review_contents img{width: 760px;}
.payvideo_contents td{text-align: inherit !important;}
.payvideo_contents p img{max-width: 100%;}
.open {border: 1px solid; padding: 5px; margin-top: 16px;}
.pt22 {padding-top: 22px;}
.btn_comm {background-color:#444444; padding: 13px 40px;}
</style>

<div class="payvideo_layer mb100">
	<div class="inner board_wrap" style="height:auto;">

		<?if($idx){?>
			<!-- 열람권한 확인 -->
            <?if(count($pay_contents) < 1){?>
                <script>
                    alert("유료 결제가 필요합니다.");
                    history.back();
                </script>
            <?}?>
		<table class="tbl_board tbl_view mt50 mb20" cellspacing="0" cellpadding="0" border="0" style="border-top:0;">
			<tr>
				<!-- <td class="text-left"><div class="subject"><?=$lists[0]['subject']?></div></td>
				<td class="text-right"><?=$lists[0]['writer_name']?></td> -->
				<td>제목</td>
				<td><?=$lists[0]['subject']?></td>
			</tr>
			<tr>
				<!-- <td colspan="2" class="text-right" style="border-bottom:0">조회:<?=$lists[0]['hit']?>, 작성일:<?=$lists[0]['reg_ymd']?></td> -->
				<td>등록일</td>
				<td><?=$lists[0]['reg_ymd']?></td>
			</tr>
			<tr class="payvideo_contents">
				<td colspan="2" style="padding-bottom:50px !important;">
					<?if($lists[0]['etc1'] <> ""){ ?>
						<iframe class="m0a mb30" width="760" height="450" src="<?=$lists[0]['etc1']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?}?>
					<?=str_replace("\r\n","<br>",$lists[0]['contents'])?>
				</td>
			</tr>
			<tr class="lst">
				<td>&nbsp;</td>
				<td ><a href="/<?=$pn?>" class="pull-right"><button class="btn_comm">목록</button></a></td>
			</tr>
		</table>
		<?}?>
		<ul class="payvideo_layer mt40">
			<?if(count($notice)){
				foreach($notice as $var){
			?>
			<li class="payvideo_layer_btn" <?if($this->session->userdata(DB_PREFIX.'id')){?>onclick="javascript:location.href='/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>'"<?}else{?>onclick="javascript:go_login();"<?}?>>
				<div class="img_layer">
				<?if($var['upfile'] <> ""){ ?>
					<img src="/upload/board/<?=$pn?>/<?=$var['upfile']?>" alt="">
				<?}else{?>
					<img src="/images/common/review_dummy.png" alt="">
				<?}?>
				</div>
				<div class="review_contents_layer ">
					<p class="title <?if(!empty($idx) and $idx==$var["idx"]){echo "cred";}?>"><?=$var["subject"]?></p>
					<!-- <p class="name">작성자 : <?=$var["writer_name"]?></p> -->
					<p class="date pull-left pt22"><?=$var["reg_ymd"]?></p>
					<?
					if(isset($user_pay_list)){
						if(in_array($var["idx"],$user_pay_list)){
					?>
						<p class="hit pull-right cred open">열람완료</p>
					<?
						}
					}
					?>

				</div>
			</li>
			<?
				$no--;
				}
			}

			if(!count($noticelist) and !count($notice)){
			?>
			<li style="width: 100%;border: 0;margin: 0;padding: 0;height: auto;text-align: center;">등록된 글이 없습니다.</li>
			<?}?>
		</ul>
		<div class="paging"><?=$pages?></div>

	</div>
</div>

<script>
	function go_login(){
		if(confirm("로그인이 필요합니다.\n로그인 하시겠습니까?")){
			location.href = "/login";
		}
	}
</script>
