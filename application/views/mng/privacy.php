
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3> 개인정보보호정책</h3>
						</div>
						<div class="widget-content">
							<form class="form-horizontal" name="privacyFrm" id="privacyFrm" method="post" action="/proc/privacyProc">
								<input type="hidden" name="mode" value="privacy">
								<div class="control-group">											
									<textarea class="span6" name="privacy" cols="70" rows="10" id="privacy" style="width:98%" data-valid="notnull" data-alert="내용" required><?=$privacy[0]["privacy"]?></textarea>	
								</div>
								<div class="form-actions">
									<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updatePrivacy();">수정</button>
								</div>
							</form>						
						</div>
					</div>
				</div>
				<div class="span12">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3> 약관</h3>
						</div>
						<div class="widget-content">
							<form class="form-horizontal" name="termsFrm" id="termsFrm" method="post" action="/proc/privacyProc">
								<input type="hidden" name="mode" value="terms">
								<div class="control-group">											
									<textarea class="span6" name="terms" cols="70" rows="10" id="terms" style="width:98%" data-valid="notnull" data-alert="내용" required><?=$privacy[0]["terms"]?></textarea>	
								</div>
								<div class="form-actions">
									<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateTerms();">수정</button>
								</div>
							</form>						
						</div>
					</div>
				</div>
				<div class="span12">
					<div class="widget ">
						<div class="widget-header">
							<i class="icon-list-alt"></i>
							<h3> 개인정보 제3자 제공동의</h3>
						</div>
						<div class="widget-content">
							<form class="form-horizontal" name="otheragreeFrm" id="otheragreeFrm" method="post" action="/proc/privacyProc">
								<input type="hidden" name="mode" value="otheragree">
								<div class="control-group">											
									<textarea class="span6" name="otheragree" cols="70" rows="10" id="otheragree" style="width:98%" data-valid="notnull" data-alert="개인정보 제3자 제공동의" required><?=$privacy[0]["otheragree"]?></textarea>	
								</div>
								<div class="form-actions">
									<button type="button" class="btn btn-primary pull-right" id="btnModify" onclick="updateOtheragree();">수정</button>
								</div>
							</form>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/assets/se/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({ oAppRef: oEditors, elPlaceHolder: "privacy", sSkinURI: "/assets/se/SmartEditor2Skin.html", fCreator: "createSEditor2"});
nhn.husky.EZCreator.createInIFrame({ oAppRef: oEditors, elPlaceHolder: "terms", sSkinURI: "/assets/se/SmartEditor2Skin.html", fCreator: "createSEditor2"});
nhn.husky.EZCreator.createInIFrame({ oAppRef: oEditors, elPlaceHolder: "otheragree", sSkinURI: "/assets/se/SmartEditor2Skin.html", fCreator: "createSEditor2"});

function updatePrivacy(){
	var form = document.getElementById("privacyFrm")

	oEditors.getById["privacy"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#privacy').val($('#privacy').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));
	var $privacy = $("#privacy").val();
	if (web.formValidation(form,true)){
		$privacy = $("#privacy").val().replace("iframe","video");
		$("#privacy").val($privacy);
		form.submit();
	}
}

function updateTerms(){
	var form = document.getElementById("termsFrm")

	oEditors.getById["terms"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#terms').val($('#terms').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));
	var $terms = $("#terms").val();
	if (web.formValidation(form,true)){
		$terms = $("#terms").val().replace("iframe","video");
		$("#terms").val($terms);
		form.submit();
	}
}
function updateOtheragree(){
	var form = document.getElementById("otheragreeFrm")

	oEditors.getById["otheragree"].exec("UPDATE_CONTENTS_FIELD", []);;
	$('#otheragree').val($('#otheragree').val().replace("<p>&nbsp;</p>","").replace("<br>?",""));
	var $otheragree = $("#otheragree").val();
	if (web.formValidation(form,true)){
		$otheragree = $("#otheragree").val().replace("iframe","video");
		$("#otheragree").val($otheragree);
		form.submit();
	}
}

</script>