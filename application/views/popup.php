<?
if(count($popup)){
	foreach($popup as $val){
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$val["title"]?></title>
<style>
@import url('https://fonts.googleapis.com/earlyaccess/nanumgothic.css');
body,html,*{margin:0;padding:0;;}
body{height:100%;}
div.wrap{display:block;margin:0 auto;padding:0px;font-size:12px;}
div.wrap .close_layer{position: absolute;right: 5px;bottom: 5px;}

.wrap a.popup_wrapper{display: block;width: 100%;height:<?=$val["y_size"]?>px;position: relative;background-color: #ccc;border: 1px solid #ddd;box-sizing: border-box;}
.wrap a.popup_wrapper p{height: 100%;}
.wrap a.popup_wrapper img{position: absolute;left: 0;top: 0;right: 0;bottom:0;width: 100%;margin: auto;}

</style>
</head>
<body>
	<div class="wrap">
		<?if($val["link"]){?>
			<a href="<?=$val["link"]?>" target="<?=$val["tab"]?>" class="popup_wrapper" onclick="javascript:self.close();"><?=$val["contents"]?></a>
		<?}else{?>
			<?=$val["contents"]?>
		<?}?>

		<div class="close_layer">
			<font color="#ccc">오늘 하루 이 창을 열지 않음</font>	<input type="checkbox" name="tclose" id="tclose" onclick="close_popup();">
		</div>
	</div>
<script src="<?=BASE_JS?>/jquery.min.js"></script>
<script src="<?=BASE_JS?>/web.js"></script>
<script>
function close_popup(){
	if($("#tclose").is(":checked")){
		setCookie("popup_<?=$val["idx"]?>","1","1");
	}
	self.close();
}
</script>
</body>
</html>
<?
	}
}else{
?>
<script>
self.close();
</script>
<?
}
?>