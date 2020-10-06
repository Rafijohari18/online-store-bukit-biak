jQuery(document).ready(function($){
    
      
    //FILBOX
    $('.thumbnail-img img').fillBox(); 
	
	//Fixed-header
	 $(window).on('scroll', function () {
		   function headerFixed() {
			   
				if ($(window).scrollTop() >= 50) {
					$('.main-header').addClass('header-fixed');
				} else {
					$('.main-header').removeClass('header-fixed');
				}
			   
			   
				// if ($(window).scrollTop() >= 300) {
				// 	$('.main-header').addClass('bg-fixed');
				// } else {
				// 	$('.main-header').removeClass('bg-fixed');
				// }
			   
				// if ($(window).width() < 992) {
				// 	if ($(window).scrollTop() >= 10) {
				// 		$('.main-header').addClass('bg-fixed');
				// 	} else {
				// 		$('.main-header').removeClass('bg-fixed');
				// 	}
				// }
			};
			headerFixed();
	   });
	
	//MAGIC-LINE
   /* $("#hover-line").append("<li id='magic-line'></li>");
    
    var $magicLine = $("#magic-line");
    
    $magicLine
        .width($(".current-nav").width())
        .css("left", $(".current-nav a").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());
        
    $("#hover-line > li").hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.width();
        
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        }, 200);
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        }, 200);    
    });*/
    
    //MENU-HOVER
	
	// Large devices <large desktops, 992px and up>
	if ($(window).width() > 992) {
		$('.has-dropdown, .has-sub-dropdown, .has-subs-dropdown').mouseenter(function(){ 
			var $this = $(this); 

				$this.addClass('is-opened')

		}).mouseleave(function(){

			var $this = $(this);

				$this.removeClass('is-opened')

		});   
	}
	
	// Medium devices <landscape phones, 576px and up>
		$(".has-dropdown > a").click(function () { 
			if ($(this).parent().hasClass('is-opened')) {

				$(".has-dropdown.is-opened").removeClass("is-opened");

			} else {

				$(".has-dropdown.is-opened").removeClass("is-opened");

				if ($(this)) {

					$(this).parent().addClass("is-opened");
				}
			}
		});
	
		$(".has-sub-dropdown > a").click(function () { 
			if ($(this).parent().hasClass('is-opened')) {

				$(".has-sub-dropdown.is-opened").removeClass("is-opened");

			} else {

				$(".has-sub-dropdown.is-opened").removeClass("is-opened");

				if ($(this)) {

					$(this).parent().addClass("is-opened");
				}
			}
		}); 
	
		$(".has-subs-dropdown > a").click(function () { 
			if ($(this).parent().hasClass('is-opened')) {

				$(".has-subs-dropdown.is-opened").removeClass("is-opened");

			} else {

				$(".has-subs-dropdown.is-opened").removeClass("is-opened");

				if ($(this)) {

					$(this).parent().addClass("is-opened");
				}
			}
		});

	
	//MOVE SECTION ACTION
	if ($(window).width() < 1198.98) {
		$(".top-header .list-nav li").each(function(event){
			$(this).appendTo(".main-header .list-nav");
		});
		
		$(".top-header .language-bar").each(function(event){
			$(this).prependTo(".main-header .main-nav");
		});
		
		$(".top-header .topbar-item").each(function(event){
			$(this).appendTo(".main-header .main-nav");
		});
	
	}

    
    //BURGER-MENU
    $('.navigation-burger, .main-nav .btn-close').click(function() {
        navigationToggle();
    });

    function navigationToggle() {
        $('.navigation-burger').toggleClass('is-active');
        $('.menubar-center').toggleClass('bar-is-opened');
        $('body').toggleClass('scroll-lock');
		$(".has-dropdown.is-opened").removeClass("is-opened");
		$('body').removeClass('big-search');
		$('.search-nav').removeClass('active');
    }
	
	
	//SEARCH-NAV
	$('.search-nav').click(function() {
        searchToggle();
		
    });
	

    function searchToggle() {
        $('.search-nav').toggleClass('active');
        $('body').toggleClass('big-search');
        setTimeout (function(){
			if ($('body').hasClass('big-search')) {
				$('#search-header').focus();
			} else {
				$('#search-header').val('');
			}
		}, 300);
    }
	
	$('.btn-story').click(function() {
        storyToggle();
		
    });
	
	 function storyToggle() {
        $('.nav-story').toggleClass('is-opened');
        
    }
	
	$('.btn-awarding').click(function() {
        awardingToggle();
		
    });
	
	 function awardingToggle() {
        $('.nav-awarding').toggleClass('is-opened');
        
    }
	
	$('.detect-btn').click(function() {
        detectToggle();
		
    });
	
	function detectToggle() {
        $('.detect-browser').removeClass('is-active');
        
    }
	
	$(document).mouseup(function (e) {
		// body...
		var var_search = $("span[class='search-btn']");//ubah ke class button nya
		if (!var_search.is(e.target) && $('body').hasClass('big-search')&& ( !$("div[class='search-wrap']").is(e.target) && !$("#search-header").is(e.target) ) ) {
			searchToggle();
		}
		
		var var_story = $(".btn-story");//ubah ke class button nya
		if (!var_story.is(e.target) && $('.nav-story').hasClass('is-opened')&& ( !$(".btn-story *").is(e.target)) ) {
			storyToggle();
		}
		
		var var_awarding = $(".btn-awarding");//ubah ke class button nya
		if (!var_awarding.is(e.target) && $('.nav-awarding').hasClass('is-opened')&& ( !$(".btn-awarding *").is(e.target)) ) {
			awardingToggle();
		}
	});
	
	
	//PARALAX BG
	$(window).scroll(function() {
		var pixs = $(window).scrollTop(),
			scale = (pixs / 16000) + 1,
			opacity = 1 - pixs / 1900;
		$(".banner-breadcrumb .thumbnail-img").css({
			"transform": "translate3d(0, "+pixs/4+"px, 0)"
		});
	});
	
	
	
	//BACK TOP
	var btn = $('#button');

	$(window).scroll(function() {
	  if ($(window).scrollTop() > 300) {
		btn.addClass('show');
	  } else {
		btn.removeClass('show');
	  }
	});

	btn.on('click', function(e) {
	  e.preventDefault();
	  $('html, body').animate({scrollTop:0}, 750);
	});


	//FOOTER COLLAPSE
	if ($(window).width() > 767){
		$(".footer .collapse").on("hide.bs.collapse", function(e){
			e.preventDefault();
		});
		$(".footer .collapse").addClass("show");
	}
    
});