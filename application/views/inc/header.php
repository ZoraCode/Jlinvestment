<?
if($this->session->userdata('sess_id') == ""){
	redirect('/member/login');
}

$menus = json_decode(menus);
if(isset($pn)){
	$cateKey = get_key($pn)+1;
}
$mkey = get_key($pn);
if(!checkMenuPms($pn) and !empty($mkey)){
	redirect('/'.admmng);
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?=BASE_TITLE_ADM?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/pages/dashboard.css')?>" rel="stylesheet">
<link rel="icon" href="/images/favicon.ico?v=<?=getUpdateDate()?>">
<script src="//code.jquery.com/jquery-latest.min.js"></script>
<script src="<?=base_url('assets/js/bootstrap.2.3.2.js')?>"></script>
<script src="<?=base_url('assets/js/web.js')?>"></script>
<script src="<?=base_url('assets/js/common.js')?>"></script>



</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
			<a class="brand" href="/<?=admmng?>"><?=BASE_TITLE_ADM?></a>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?=$this->session->userdata('sess_name')?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/<?=admmng?>/profile"><i class="icon-group"></i> Profile</a></li>
						<li><a href="/member/logout"><i class="icon-list"></i> Logout</a></li>
					</ul>
					</li>
				</ul>

			</div>
		</div>
	</div>
</div>

<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
			<?
				$headers = (array) json_decode(headers);
				$ii=1;
				$userInfo = getUserInfo($this->session->userdata('sess_idx'));
				$mymenus = isset($userInfo["menus"]) ? explode(",",$userInfo["menus"]) : [];

				foreach($headers as $key=>$val){
					$isDepth1 = false;
					$isDepth2 = false;
					$active = "";
					$subHtml = "<ul class='dropdown-menu'>";
					if(isset($pn) && $cateKey==$ii){
						$active = "active";
					}
					if($this->session->userdata('sess_level') == 10){
						echo "<li class='dropdown ".$active."'><a href='javascript:;' class='dropdown-toggle' data-toggle='dropdown'><i class='".$val->icon."'></i><span>".$val->super."</span><b class='caret'></b></a>";
						echo "<ul class='dropdown-menu'>";
							foreach($menus[$ii-1] as $mk=>$mv){
								$active = "";
								if($pn==$mk){
									$active = "class='active'";
								}
								echo "<li ".$active."><a href='/".admmng."/$mk'>".$mv->name."</a></li>";
							}
						echo "</ul></li>";
					}else{
						foreach($menus[$ii-1] as $mk=>$mv){
							if(count($mymenus) > 0 and in_array($mk,$mymenus) and !$isDepth1){
								echo "<li class='dropdown ".$active."'><a href='javascript:;' class='dropdown-toggle' data-toggle='dropdown'><i class='".$val->icon."'></i><span>".$val->super."</span><b class='caret'></b></a>";
								$isDepth1 = true;
								continue;
							}

						}
						if($isDepth1){
							foreach($menus[$ii-1] as $mk=>$mv){
								if(count($mymenus) > 0){
									if(in_array($mk,$mymenus)){
										$isDepth2 = true;
										$active = "";
										if($pn==$mk){
											$active = "class='active'";
										}
										$subHtml.=	"<li ".$active."><a href='/".admmng."/$mk'>".$mv->name."</a></li>";
									}
								}
							}
							if($isDepth2){
								echo $subHtml."</ul>";
							}
							$subHtml = "";
							echo "</li>";
						}
					}
					$ii++;
				}
			?>
			</ul>
		</div>
	</div>
</div>
