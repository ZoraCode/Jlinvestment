

<style>
#wrapper .nonHeight{height: auto !important;}
</style>
		<div class="inner nonHeight">
			<?if($t2 == "투자성과"){?>
				<img src="/images/contents/board/performance.png" class="main_contents_01" alt="">
				<table class="tbl_board mt80" cellspacing="0" cellpadding="0" border="0" width="100%">
			<?}else{?>
				<h1 class="board_title mt80"><?=$t2?></h1>
			<?}?>

			<?if(!$idx){?>

				<table class="tbl_board" cellspacing="0" cellpadding="0" border="0" width="100%">
					<col width="85px">
					<col width="*">
					<col width="120px">
					<col width="85px">
					<tbody>
					<tr class="thead">
						<th>No</th>
						<th>제목</th>
						<th>작성일</th>
						<th>조회수</th>
					</tr>
					<?
						foreach($noticelist as $var){
							$is_notice = $var["is_notice"] == "Y" ? "[공지]" : "";
					?>
					<tr>
						<td>&nbsp;</td>
						<td class="title"><a href="/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>"><?=$is_notice." ".$var["subject"]?></a></td>
						<td><?=$var["reg_ymd"]?></td>
						<td><?=$var["hit"]?></td>
					</tr>
					<?}?>
					<?if(count($notice)){
						foreach($notice as $var){
							$is_notice = $var["is_notice"] == "Y" ? "[공지]" : "";
							$category = $this->uri->segment(1);
							if($category == $var["category"]){

					?>
					<tr>
						<td><?=$no?></td>
						<td class="title"><a href="/<?=$pn?>/<?=$page?>/<?=$var["idx"]?>"><?=$var["subject"]?></a></td>
						<td><?=$var["reg_ymd"]?></td>
						<td><?=$var["hit"]?></td>
					</tr>
					<?
						$no--;
						}else{

						}
					 }
					}
					if(!count($noticelist) and !count($notice)){
					?>
					<tr>
						<td colspan="2" class="text-center">등록된 글이 없습니다.</td>
					</tr>
					<?}?>

					<tr class="lst">
						<td colspan="4">
							<form class="form-horizontal" name="searchFrm" id="searchFrm">
								<div class="control-group">
									<div class=" ">
										<input style="padding: 12px 15px;width: 380px;" name="searchStr" id="searchStr" type="text" value="<?=$searchStr?>">
										<button class="btn_comm" type="button" onclick="document.searchFrm.submit();">검색</button>
									</div>
								</div>
							</form>
							<div class="paging"><?=$pages?></div>
						</td>
					</tr>
				</tbody>
			</table>
		<?}else{?>
			<table class="tbl_board tbl_view " cellspacing="0" cellpadding="0" border="0" width="100%">
				<col width="200px">
				<col width="*">
				<tr class="thead">
					<th>제목</th>
					<td><?=$lists[0]['subject']?></td>
				</tr>
				<tr class="thead">
					<th>등록일</th>
					<td><?=$lists[0]['reg_ymd']?></td>
				</tr>
				<?if(isset($lists[0]['upfile']) and !empty($lists[0]['upfile'])){ ?>
				<tr class="thead">
					<th>첨부파일 </th>
					<td>
						<a href="/attach/<?=$pn?>/down/<?=$lists[0]['idx'] ?>" >[첨부파일] <img src="/images/common/ico_download.png" class="ivam" alt=""></a>
					</td>
				</tr>
				<? } ?>
<style>
.board_contents td{text-align: inherit !important;}
.board_contents p img{max-width: 100%;}
</style>
				<tr class="board_contents">
					<td colspan="2">
						<?=$lists[0]['contents']?>
					</td>
				</tr>

				<?if(isset($prev_idx)){?>
				<tr class="prevnext top">
					<td>이전글</td>
					<td><a href="/<?=$pn?>/<?=$page?>/<?=$prev_idx["idx"] ?>"> <span class="subject"><?=hc($prev_idx["subject"], 32, '...')?></span></a></td>
				</tr>
				<?}else{?>
				<tr class="prevnext top">
					<td>이전글</td>
					<td>이전글이 없습니다.</td>
				</tr>
				<?}?>
				<?if(isset($next_idx)){?>
				<tr class="prevnext">
					<td>다음글</td>
					<td><a href="/<?=$pn?>/<?=$page?>/<?=$next_idx["idx"]?>"> <span class="subject"><?=hc($next_idx["subject"], 32, '...')?></span></a></td>
				</tr>
				<?}else{?>
				<tr class="prevnext">
					<td>다음글</td>
					<td>다음글이 없습니다.</td>
				</tr>
				<?}?>

				<tr class="lst" style="height:120px">
					<td colspan="2"><a href="/<?=$pn?>/<?=$page?>"><button class="btn_comm">목록으로</button></a></td>
				</tr>
			</table>
		<?}?>
		</div>
