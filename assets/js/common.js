function ajaxProcess(url,data,redirect){
	var rst;
	$.ajax({
		url : url,
		dataType : "text",
		method: "POST",
		data : data,
		success : function(result) {
			if(result=="success"){
				alert("정상적으로 처리되었습니다.");
				if(redirect==""){
					location.href = location.href;
				}else{
					location.href = redirect;
				}
			}else{
				alert(result);
			}
		},
		error : function(status) {
			alert("에러가 발생하였습니다.");
		}
	});
	return rst;
}
$(function(){
	var $navbar = $(".navbar").height();
	var $subnavbar = $(".subnavbar").height();
	var $extra = $(".extra").height();
	var $footer = $(".footer").height();
	var extrah = $navbar+$subnavbar+$footer+56;

	$(".main").css("min-height",$(window).height()-extrah)
})
