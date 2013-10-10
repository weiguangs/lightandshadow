jQuery(function() {
	// Top dropdown
	jQuery(".top-dropdown").mouseenter(function() {
			jQuery(this).click();
	});
	jQuery(".top-dropdown").click(function() {
		jQuery(this).addClass('hover');
		jQuery(this).find("ul").stop(true, true).delay(300).fadeIn(500, "easeOutCubic");
	}).mouseleave(function() {
		jQuery(this).find("ul").stop(true, true).delay(300).fadeOut(500, "easeInCubic");
	});
	// Shopping cart dropdown		
	jQuery(".mini-cart").hover(function() {
			jQuery(this).addClass('hover');
			jQuery(".mini-cart .block-content").stop(true, true).delay(300).fadeIn(500, "easeOutCubic");
		}, function() {
			jQuery(".mini-cart .block-content").stop(true, true).delay(300).fadeOut(500, "easeInCubic");
	});
	//Top menu
	if(jQuery('#default-menu #nav').length) {
	  jQuery("#default-menu #nav").superfish({
		  autoArrows: false,
		  dropShadows: false,
		  animation:   {opacity:'show',height:'show'}
	  });
	  jQuery('#superfish-menu ul#nav li li a').prepend('<span class="menu-arr"></span >');
	}	
	if(jQuery('#wide-menu #nav').length) {
	  jQuery ('#wide-menu #nav li.level-top.parent').hover (function(){
		      jQuery(this).addClass("hover").find('ul:first').stop(true, true).delay(300).fadeIn(500, "easeOutCubic");
		  }, function (){
			   jQuery(this).removeClass("hover").find('ul:first').stop(true, true).delay(300).fadeOut(500, "easeInCubic");
			  })
	}	
	// Sort by dropdown
	jQuery(".sorter .sort-by").mouseenter(function() {
			jQuery(this).click();
	});
	jQuery(".sorter .sort-by").click(function() {
		jQuery(this).addClass('hover');
		jQuery(this).find("ul").stop(true, true).delay(300).fadeIn(500, "easeOutCubic");
	}).mouseleave(function() {
		jQuery(this).find("ul").stop(true, true).delay(300).fadeOut(500, "easeInCubic");
	});	
	// Limiter dropdown
	jQuery(".sorter .limiter").mouseenter(function() {
			jQuery(this).click();
	});
	jQuery(".sorter .limiter").click(function() {
		jQuery(this).addClass('hover');
		jQuery(this).find("ul").stop(true, true).delay(300).fadeIn(500, "easeOutCubic");
	}).mouseleave(function() {
		jQuery(this).find("ul").stop(true, true).delay(300).fadeOut(500, "easeInCubic");
	});
	// product box hover
   jQuery('.home-content .products-grid li.item').hover(
		function(){
			jQuery('.socialToolBar', this).animate({opacity:1, top: '-=159'}, 400);
			jQuery('.ShowTool', this).animate({opacity:1, top: '-=159'}, 400);			
		},
		function(){
			jQuery('.socialToolBar', this).animate({opacity:0, top: '+=159'}, 400);
			jQuery('.ShowTool', this).animate({opacity:0, top: '+=159'}, 400);
		})	
	// circle box hover
   jQuery('.circles .item-01').hover(
		function(){
			jQuery('.circles .hover-01').animate({'display':'block'});
		},
		function(){
			jQuery('.circles .hover-01').animate({'display':'none'});
		})	
	jQuery('#custom-block-1').each(function(){
                                jQuery(this).addClass('active');
                                jQuery(this).toggle(function(){
                                    jQuery(this).removeClass('active').next().slideUp(200);
                                },function(){
                                    jQuery(this).addClass('active').next().slideDown(200);
                                })
                            }); 	
	jQuery('#custom-block-2').each(function(){
                                jQuery(this).addClass('active');
                                jQuery(this).toggle(function(){
                                    jQuery(this).removeClass('active').next().slideUp(200);
                                },function(){
                                    jQuery(this).addClass('active').next().slideDown(200);
                                })
                            }); 
	jQuery('#custom-block-3').each(function(){
                                jQuery(this).addClass('active');
                                jQuery(this).toggle(function(){
                                    jQuery(this).removeClass('active').next().slideUp(200);
                                },function(){
                                    jQuery(this).addClass('active').next().slideDown(200);
                                })
                            }); 
   jQuery('.quick-view').live('mouseenter', function(){
   	jQuery(this).colorbox({iframe:true, width:"780px", height:"480px", opacity:0.5});
   	});		
});