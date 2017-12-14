
/* GNB */
var gnbController = function() 
{
	var that = this;
	this.closerTimer = null;
	this.currentAnchor = null;
	this.currentNode = null;
	this.hoverclass = 'hover';
	this.onclass = 'on';
	this.menuheight = 0;

	this.currentCode = parseInt(window.pagecode.split("-")[0],10) - 1;
	this.initialize = function()
	{
		that.gnb = $(that["opts"].gnbobj);
		that.sub = $(that["opts"].gnbsubContent);

		var dummyTimer = null;
		
		if(that["opts"].variousClass) 
		{
			this.hoverclass = that["opts"].variousClass.hoverclass;
			this.onclass = that["opts"].variousClass.onclass;
		}

		that.gnbChildren = that.gnb.find('>ul>li>a');
		that.subChildren = that.sub.find('>div');

		that.currentActivior();
		
		that.gnbChildren.live('focus mouseenter',function(e) 
		{
            if(e.preventDefault) e.preventDefault();
			else e.returnValue = false; 
            e.stopPropagation();

			if(that.currentNode) if(that.currentNode.get(0) === this) return;
			that.hoverfn(this);
		});
		that.gnb.live('mouseleave',function(e) { that.leavefn(); });
		
		that.subChildren.last().bind('focusin',function(e) { clearTimeout(dummyTimer); });
		that.subChildren.last().bind('focusout',function(e) { dummyTimer = setTimeout(function() { that.leavefn() },100); });
		
	}
}

gnbController.prototype = 
{
	hidemenu : function(target)
	{
		target.css({display:'none'});
	},
	showmenu : function(target)
	{
		
		target.css({display:'block'});
	},
	hoverfn : function(self)
	{
		
		if(this.closerTimer) clearTimeout(this.closerTimer);
		if(this.currentAnchor)
		{
			this.currentAnchor.parent().removeClass(this.hoverclass).removeClass(this.onclass);
			if(this.currentNode) this.hidemenu.call(this,this.currentNode); 
		}

		this.currentAnchor = $(self);
		this.currentNode = $(this.currentAnchor.attr('name'));
		
		this.currentAnchor.parent().addClass(this.hoverclass);
		this.showmenu.call(this,this.currentNode);
	},
	leavefn : function()
	{
		var that = this;
		if(this.closerTimer) clearTimeout(this.closerTimer);
		this.closerTimer = setTimeout(function()
		{
			if(that.currentNode)
			{
				that.currentAnchor.parent().removeClass(that.hoverclass);
				that.hidemenu.call(that,that.currentNode); 
			}
			that.currentAnchor = null;
			that.currentNode = null;

			that.currentActivior();
		},100);
	},
	currentActivior : function() 
	{
		if(this.currentCode<0) return;
		if(this.currentAnchor) this.currentAnchor.parent().removeClass(this.onclass);
		
		this.currentAnchor = this.gnbChildren.eq(this.currentCode);
		this.currentAnchor.parent().addClass(this.onclass);
	}
}


/* 서브 로케이션 FIXED */
$(function(d) {
	var init = function(Obj, Opt){
		var option = {
			speed 	: 300,
			callback : function() {
			}
		}
		if(Opt) {
			d.extend(option, Opt);
		};
		var that = d(Obj);
		var Root = this;
		var offsetTop = that.find('.shop').offset().top;
		$(window).scroll(function(){
			scrollFn();
		});
		$(window).load(function(){
			scrollFn();
		});
		function scrollFn(){
			Root.myTop = $(window).scrollTop();
			if(Root.myTop > offsetTop) {
				navSticky();
			}else{
				that.removeClass('fixed');
			}
		};

		function navSticky(){
			that.addClass('fixed');
			$('.shop_search label').removeClass('txt_out');
			$('.shop_search').find('input[type=text]').val('');
		};

		$('.open_search').bind('click',function(e){
			e.preventDefault();
			$(this).next().show();
		});
		$('.shop_search .close').bind('click',function(e){
			e.preventDefault();
			$('.fixe_layout .shop_search').hide();
		});
	};
	$.fn.navFn= function (o) {
		return new init(this, o);
	}
}(jQuery));


$(function(){

	/* 관련사이트 바로가기 */
	$(".wrap_site a").click(function() {
		$(".wrap_family").toggle();
	});

	/* 전체메뉴 보기 */
	$("#menuAll").click(function() {
		$(".menuAll").show();
	});
	$(".menuAll .close").click(function() {
		$(".menuAll").hide();
	});


	/* tab */
	$(".tab li").eq(0).find("a").addClass("active");
	$(".tab li").click(function(){
		var compus = $(this).find("a").attr("href");
		$(this).find("a").addClass("active");
		$(this).siblings().find("a").removeClass("active");
	});

	$('#location').navFn(); //로케이션 고정

});


/* input value */
function blank(a) { if(a.value == a.defaultValue) a.value = ""; }
function unblank(a) { if(a.value == "") a.value = a.defaultValue; }


function initMoving_click(){
	$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
}

function initMoving(target, position, topLimit, btmLimit) {
	if (!target)
		return false;

	var obj = target;
	obj.initTop = position;
	obj.topLimit = topLimit;
	obj.bottomLimit = document.documentElement.scrollHeight - btmLimit;

	obj.style.position = "relative";
	obj.top = obj.initTop;
	obj.left = obj.initLeft;

	if (typeof(window.pageYOffset) == "number") {
		obj.getTop = function() {
			return window.pageYOffset;
		}
	} else if (typeof(document.documentElement.scrollTop) == "number") {
		obj.getTop = function() {
			return document.documentElement.scrollTop;
		}
	} else {
		obj.getTop = function() {
			return 0;
		}
	}

	if (self.innerHeight) {
		obj.getHeight = function() {
			return self.innerHeight;
		}
	} else if(document.documentElement.clientHeight) {
		obj.getHeight = function() {
			return document.documentElement.clientHeight;
		}
	} else {
		obj.getHeight = function() {
			return 500;
		}
	}

	obj.move = setInterval(function() {
		if (obj.initTop > 0) {
			pos = obj.getTop() + obj.initTop;
		} else {
			pos = obj.getTop() + obj.getHeight() + obj.initTop;
		}

		if (pos > obj.bottomLimit)
			pos = obj.bottomLimit;
		if (pos < obj.topLimit)
			pos = obj.topLimit;

		interval = obj.top - pos;
		obj.top = obj.top - interval / 3;
		obj.style.top = obj.top + "px";
	}, 30)
}
