<!--
    PAGE : INDEX PAGE
    Copyright (c)  2016  NHN KCP Inc.   All Rights Reserverd.
//-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
<link href="sample/css/style.css" rel="stylesheet" media="all" id="cssLink">
<script type="text/javascript">
  var controlCss = "mobile_sample/css/style_mobile.css";
  var isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };

  if( isMobile.any() )
    document.getElementById("cssLink").setAttribute("href", controlCss);
</script>
</head>
<body style="background:#0e66a4;">
<div id="sample_index">
  <h1>PAYMENT SAMPLE</h1>
  <div class="btnSet">
    <a href="/pay/kcp/order" class="btn1" >&sdot; 결제 요청 <span>&rarr;</span></a>
    <a href="mobile_sample/order_mobile.php" class="btn2">&sdot; 스마트폰 결제 요청 <span>&rarr;</span></a>
  </div>
  <!--footer-->
  <div class="footer">
    Copyright (c) NHN KCP INC. All Rights reserved.
  </div>
  <!--//footer-->
</div>
</body>
</html>