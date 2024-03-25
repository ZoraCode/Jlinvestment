<!DOCTYPE html>
<html lang="ko">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=no">
<head>
<style type="text/css">
A:link, A:visited {
    text-decoration: true;
    color: blue
}

A:active, a:hover {
    text-decoration: true;
    color: red
}

html, body {width:100%; height:100%; margin:0; padding:0; }

body, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, p, legend{ margin : 0; padding : 0; }
body {
	 scrollbar-highlight-color:#FFFFFF;
	 scrollbar-3dlight-color:#828282;
	 scrollbar-face-color:#F4F5EE;
	 scrollbar-shadow-color:#828282;
	 scrollbar-darkshadow-color:#FFFFFF;
	 scrollbar-track-color:#FAFAFA;
	 scrollbar-arrow-color:#828282;
	 width: 100%;
	 line-height: 1.4;
	 font-family: Malgun Gothic;
	 overflow-x: hidden;
	 overflow-y: hidden;
	 font-size: 15px;
	 color: #555;
	 letter-spacing: -0.5px;
	 -webkit-text-size-adjust: none;
	 -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	 cursor:normal;
}

iframe {
	width:100%;
}
div img{ 
	width: 100%;
	height:auto;
}

#title {
color:#000;
margin-top:10px;
margin-left:10px;
margin-right:10px;
margin-bottom:5px;
font-size: 15px;
font-weight:bold;

position:relative; 
}

#wraper {
position:relative; 
margin-bottom:5px;
height:10px;
}

#nadmin {
margin-left:10px;
color:#828282;
position:absolute; 
left:0;
font-size:0.8em;
}

#ndate {
margin-right:10px;
color:#8C8C8C;
position:absolute;
right:0;
font-size:0.8em;
}

#wraper2 {
position:relative; 
width=100%;
height:5px;
}

#content {
position:relative; 
border-top:1px solid #D5D5D5;
border-bottom:1px solid #D5D5D5;
margin-left:10px;
margin-right:10px;
margin-top:15px;
margin-bottom:15px;
font-size: 14px;
}

</style>
</head>
<script>

	function init() {
		window.document.onkeydown=KeyCheck; 
	}
	// Creat
	function KeyCheck() {
			
		if (event.srcElement.tagName == "INPUT" && event.srcElement.readOnly) {
					event.keyCode = 0;
	  			return false;
	  }	
	  
	  if (event.srcElement.tagName == "TEXTAREA" && event.srcElement.readOnly) {
	  			event.keyCode = 0;
	  			return false;
	  }	
	  
	  if (event.srcElement.tagName != "INPUT" && event.srcElement.tagName != "TEXTAREA" ) {
	  	 if(event.keyCode == 8) {  // backspace
    				event.keyCode = 0;
    				return false;
   		 }
   	  }
		
		if (event.srcElement.tagName == "TEXTAREA" && (event.keyCode == 13) ) {
				 if (	event.shiftKey == true ) {
							event.shiftKey == true;
						return true;
				 }  else {
		 			event.keyCode = 0;
		 			
		 		}
	  			return false;
	  }	
	  
    if(event.keyCode == 116) {   //f5 새로고침
         event.keyCode = 0;
         return false;
    }
   
   	if ((event.keyCode == 70) && (event.ctrlKey == true)) {  // Ctrl + f   찾기
   			 event.keyCode = 0;
   		 	return false;
    }
    
    if ((event.keyCode == 78) && (event.ctrlKey == true)) {  // Ctrl + n   새창열기
   			 event.keyCode = 0;
   		 	return false;
    }
		
		if ((event.keyCode == 76) && (event.ctrlKey == true)) {  // Ctrl + L    새로열기
   			 event.keyCode = 0;
   		 	return false;
    }
    
    if ((event.keyCode == 79) && (event.ctrlKey == true)) {  // Ctrl + O    새로열기
   			 event.keyCode = 0;
   		 	return false;
    }
    
    if ((event.keyCode == 82) && (event.ctrlKey == true)) {  // Ctrl + r    새로고침
   			 event.keyCode = 0;
   		 	return false;
    }
    
    if ((event.keyCode == 80) && (event.ctrlKey == true)) {  // Ctrl + p     프린트
   			 event.keyCode = 0;
   		 	return false;
    }
    
    if (event.ctrlKey == false)		{
			//alert(event.keyCode);
	}
	  
}
</script>

<body onload="init();"oncontextmenu="return false" onselectstart="return false" leftmargin=0 topmargin=0>
<div id="title"><? echo $board[0]["subject"] ?></div>
<div id="wraper">
	<div id="nadmin"><? echo $board[0]["writer_name"] ?></div>
	<div id="ndate"><? echo $board[0]["reg_ymd"] ?></div>
</div>

<div id="content" class="content">
<? echo $board[0]["contents"] ?>

</div>
</br>
</body>


</html>