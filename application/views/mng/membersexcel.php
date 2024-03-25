<meta charset="UTF-8">
<style type="text/css">
th,td{text-align:center;border:1px solid #ccc;border-collapse:collapse;}
</style>
<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0" border="0">
	<col width="10%">
	<col width="15%">
	<col width="15%">
	<col width="15%">
	<col width="15%">
	<col width="20%">
	<col width="15%">
	<thead>
	<tr>
		<th>이름</th>
		<th>아이디</th>
		<th>핸드폰</th>
		<th>이메일</th>
		<th>기간</th>
		<th>상품</th>
		<th>가입일</th>
	</tr>
	</thead>
	<tbody>
	<?

		foreach($list as $var){

			$menu_title = "";
			if(isset($var["menus"])){
				$menuArr = explode(",",$var["menus"]);
				foreach($menuArr as $key=>$var2){
					$menu_title .= get_title($var2)["t2"];
					if(count($menuArr)-1 > $key){
						$menu_title.="/";
					}
				}
			};
			$startdate = $var["startdate"]=="0" ? "":date('Y-m-d', $var["startdate"]);
			$enddate = $var["enddate"]=="0" ? "":date('Y-m-d', $var["enddate"]);
			$period = !empty($startdate) && !empty($enddate) ? $startdate." ~ ". $enddate : "";

			$pd_title = $var["room_idx"];
			switch($pd_title){
				case 3   : $pd_title = "VIP서비스";break;
				case 1 : $pd_title = "VVIP서비스";break;
				case 2  : $pd_title = "VIP선물";break;
				default:break;
			}

	?>
	<tr >
		<td class="nick curp"><?=$var["mb_name"]?>(<?=$var["mb_nick"]?>)</td>
		<td><?=$var["mb_id"]?></td>
		<td><?=$var["mb_hp"]?></td>
		<td><?=$var["mb_email"]?></td>
		<td><?=$period?></td>
		<td><?=$pd_title?></td>
		<td><?=$var["reg_dt"]?></td>
	</tr>
	<?
		}
	?>
	</tbody>
</table>
