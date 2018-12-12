$(window).scroll(function() {
	var scroll = $(window).scrollTop();
	//alert($("header").height());  
	if (scroll > $("header").height()*0.9) {
	  $("#mainNav").css('background-color','#F4F2F3');
	  //$("#mainNav").css('position','relative');
	  $("#mainNav").addClass("navbar-fixed-top");
	 // $("#mainNav").css('margin','0 0 0 0');
	  $(".navbar-nav li .dropdown-menu").css('background-color','#F4F2F3');
	  //alert($("header").height()); 
	} else {
		//$("#mainNav").css('margin-top','0');
		$("#mainNav").removeClass("navbar-fixed-top");
		$("#mainNav").css('background-color','#F4F2F3');
		//$("#mainNav").css('margin','');
		$(".navbar-nav li .dropdown-menu").css('background-color','#F4F2F3');
		
	}
  });

 $('ul.nav li.dropdown').hover(function() {
  $(this).find('#drop1').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('#drop1').stop(true, true).delay(200).fadeOut(500);
});
 $('ul.nav li.dropdown ul.dropdown-menu li.dropdown-submenu').hover(function() {
	   $(this).find('#drop2').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('#drop2').stop(true, true).delay(200).fadeOut(500);
	 
 })


$('#mainNav').find('a[href^="#"]').on('click', function(event) {
	//alert(window.location.href);
	//if(window.location.href == '
	//alert(window.location.pathname);
	if(window.location.pathname === "/"){

    var target = $(this).attr("href").replace(/^#+/, "");
	//alert(target);
	var idma = $(this).attr("href");
	 if(target.indexOf("-")!==-1){
    target = target.slice(0,target.indexOf("-"));
	//$('#bookcat-269').removeClass('active');
	//$('.list-group').find(idma).addClass('active');
	$(idma+' >a').click();

	
    }
	//console.log($('#listbomon').attr('class'));
	if( target.length ) {
      //  event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: $(target).offset().top-$('#mainNav').height()
        }, 1000);
		
    }
	}
	else{
		    var target = $(this).attr("href").replace(/^#+/, "");
	
		window.location.href = 'http://localhost:8000/#C_'+target ;
		
	

	}
});

$(window).resize(function(){
if($(window).width() <=997){
	$('#mainNav').css('font-size','12px');	
}
else{
	$('#mainNav').css('font-size','15px');
}

})

$(document).ready(function() {
	var target = window.location.hash; 
 if(target.indexOf("_")!==-1){
	 var target_f ="";
    target = target.slice(target.indexOf("_")+1,target.length);
	//alert(target.indexOf("-"));
	if(target.indexOf("-")===-1){
		target_f = target;
		

	}
	else{
		target_f = target.slice(0,target.indexOf("-"));
	}
	//alert(target_f);
	//alert(target);
   $('html, body').stop().animate({
     scrollTop: $(target_f).offset().top-$('#mainNav').height()
        }, 1000);
		
	$('.list-group > a').removeClass('active');
	$('#'+target).addClass('active');
	//alert(target);
	setTimeout(function () {
		$(target + '> a').click();
	},4000) 	
		
	
    }
     
	
})




$(document).ready(function () {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });


    $('.dropdown a.test').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

	$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
		e.preventDefault();
		$(this).siblings('a.active').removeClass("active");
		$(this).addClass("active");
		var index = $(this).index();
		$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
		$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	});
});
