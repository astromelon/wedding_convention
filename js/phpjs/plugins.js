/****************************************/
/*	Name:  Press Arbitration Commission
/*	PART: SCRIPT
/*	Version: 1.0
/*	Author: [내가그린기린그림 퍼블리싱팀] 양혜민
/****************************************/

$(function(){

	$(".locWrap li").hover(function(e){
		$(this).children("ul").show(200);
		$(this).find("a").addClass("active");
	},function(){
		$(this).children("ul").hide();
		$(this).find("a").removeClass("active");
	});

});

function js_goPage(url) {
	document.location.href = url;
}