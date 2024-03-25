<meta charset="UTF-8">
<style type="text/css">
th,td{text-align:center;border:1px solid #ccc;border-collapse:collapse;}
</style>

<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
	<col width="10%">
	<col width="10%">
	<col width="10%">
	<col width="*">
	<col width="10%">
	<col width="10%">
	<col width="10%">
	<thead>
	<tr>
		<th>이름</th>
		<th>전화번호</th>
		<th>투자금</th>
		<th>상담분야</th>
		<th>제3자동의</th>
		<th>기타문의</th>
		<th>등록일</th>
	</tr>
	</thead>
	<tbody>
	<?
		foreach($list as $var){
	?>
	<tr>
		<td><?=$var["name"]?></td>
		<td><?=$var["tel"]?></td>
		<td><?=$var["price"]?></td>
		<td><?=$var["category"]?></td>
		<td><?=$var["agree3"]?></td>
		<td><?=$var["etc"]?></td>
		<td><?=$var["reg_ymd"]?></td>

	</tr>
	<?
		}
	?>
	</tbody>
</table>