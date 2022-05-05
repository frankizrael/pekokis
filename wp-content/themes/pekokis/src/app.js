// Import styles
import './scss/app.scss';
// Import scripts
import TweenMax from "gsap/TweenMax";
import CSSPlugin from "gsap/CSSPlugin";
import TweenLite from "gsap/TweenLite";
//header
	function scrollAnimated(){
		var lastScrollTop = 0, delta = 20;
		$(window).on('scroll',function(){
			var nowScrollTop = $(this).scrollTop();
			if (nowScrollTop > 50){
				$('.bot-nav').addClass('animated');
			} else {
				$('.bot-nav').removeClass('animated');
			}
		});
	}
	scrollAnimated();
//another ios
	var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	if (iOS) {
	 	//
	}
//scroll
	$('.anchor a').on('click', function(event){
      	event.preventDefault();
      	let $this = $(this);
      	let href = $this.attr('href');
      	$('html, body').stop().animate({scrollTop: $(href).offset().top - 130}, 800);
 	});
	
//header animation
	$('.nav_menu_icon').on('click',function(){
		$('.nav__menu ul').toggleClass('active');
	});
//forms input
	
//menu
	$('.openSearch').on('click',function(){
		$('.searchInputContent').addClass('active');
	});
	$('.searchInputContent').on('mouseleave',function(){
		$('.searchInputContent').removeClass('active');
	});
//animation header
	$('.MenuDisplay').on('click',function(){
		$(this).toggleClass('active');
		$('.fixMenu').toggleClass('active');
	});

	$('.jsListCat').on('click',function(){
		const $this = $(this);
		const slugCat = $this.attr('data');
		const idCat = $this.attr('data-id');
		const linkcategory = $this.attr('linkcategory');
		$.ajax({
			type: "post",
			dataType: "json",
			url: ajaxUrl,
			data: {
				action: "send_myproducts",
				category_slug: slugCat,
				category_id: idCat
			},
			beforeSend: function(response){
				$('#allContentForCat').html('');
				$('#allContentForCat').addClass('charge');
			},
			success: function(response) {
				const $main = $('#allContentForCat');
				const allproducts = response.allproducts;
				const featuredproducts = response.featuredproducts;
				let templateList = '<div class="leftList"></div>';
				let templateOffert = '<div class="RightList"></div>';
				let itemProduct = '';
				if (allproducts) {
					for (let i=0;i<allproducts.length;i++) {
						const itemsegred = `<li class="itemproduct"><a href="${allproducts[i].link}" data="${allproducts[i].id}">${allproducts[i].name}</a></li>`;
						itemProduct = itemProduct+itemsegred;
					}
					templateList = `<div class="leftList"><ul>${itemProduct}</ul><a href="${linkcategory}" class="btn">VER TODOS<i>
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="7" cy="7" r="7" fill="white"/>
						<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
						<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</i></a></div>`;
				}	
				let itemFeatureProduct = '';
				if (featuredproducts) {
					for (let i=0;i<featuredproducts.length;i++) {
						const itemsegredFeatured = `<div class="offerProducts" data="${featuredproducts[i].id}" style="background-image:url(${featuredproducts[i].background});">
						<div class="offerProducts__content">
							<p class="discont">${featuredproducts[i].percent}</p>
							<h3>${featuredproducts[i].name}</h3>
							<a href="${featuredproducts[i].link}" class="btn">
								Comprar 
								<i>
									<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="7" cy="7" r="7" fill="white"/>
										<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
										<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</i>
							</a>
						</div>
					</div>`;
						itemFeatureProduct = itemFeatureProduct+itemsegredFeatured;
					}
					templateOffert = `<div class="RightList">${itemFeatureProduct}</div>`;
				}				
				const finalTemplate = `<div class="allListContent">${templateList}${templateOffert}</div>`;
				$('#allContentForCat').html('');
				$('#allContentForCat').html(finalTemplate);
			},
			complete: function(response) {
				$('#allContentForCat').removeClass('charge');
			}
		});		
		$('.jsListCat').removeClass('active');
		$this.addClass('active');
	});
	$('.jsListCat').eq(0).trigger('click');

	$('.jsListCatMobile').on('click',function(){
		const $this = $(this);
		const slugCat = $this.attr('data');
		const idCat = $this.attr('data-id');
		const name = $this.attr('data-name');
		const linkcategory = $this.attr('linkcategory');
		$.ajax({
			type: "post",
			dataType: "json",
			url: ajaxUrl,
			data: {
				action: "send_myproducts",
				category_slug: slugCat,
				category_id: idCat
			},
			beforeSend: function(response){
				$('#mainMobile').html('');
				$('#mainMobile').addClass('charge');
			},
			success: function(response) {
				const $main = $('#mainMobile');
				const allproducts = response.allproducts;
				const featuredproducts = response.featuredproducts;
				let templateList = '<div class="leftList"></div>';
				let itemProduct = '';
				if (allproducts) {
					for (let i=0;i<allproducts.length;i++) {
						const itemsegred = `<li class="itemproduct"><a href="${allproducts[i].link}" data="${allproducts[i].id}">${allproducts[i].name}</a></li>`;
						itemProduct = itemProduct+itemsegred;
					}
					templateList = `<div class="leftList"><ul>${itemProduct}</ul><a href="${linkcategory}" class="btn">VER TODOS<i>
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="7" cy="7" r="7" fill="white"/>
						<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
						<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</i></a></div>`;
				}				
				const finalTemplate = `<div class="allListContent">${templateList}</div>`;
				$('#mainMobile').html('');
				$('#mainMobile').html(finalTemplate);
			},
			complete: function(response) {
				$('#mainMobile').removeClass('charge');
				$('#menuHeaderMobileTitle').html(name);
				$('.mobileMenuHeaderFilter__absolute').addClass('active');
			}
		});	
	});

	$('.backMenuMobile').on('click',function(){		
		$('.mobileMenuHeaderFilter__absolute').removeClass('active');
	});

//add modal in card
	$('.jsOpenModal').on('click',function(){
		const $this = $(this);
		const $li = $this.closest('.jsProduct');
		const $modal = $li.find('.myProductModal');
		$('.myProductModal').removeClass('active');
		$modal.addClass('active');
	});
	$('.myProductModal__close').on('click',function(){
		$('.myProductModal').removeClass('active');
	});

//menumobile
	$('.MenuDisplayMobile').on('click',function(){
		$('.mobileMenuHeader').show();
		setTimeout(function(){
			$('.mobileMenuHeaderFilter').addClass('active');
		},200);
	});
	$('.closeMobile').on('click',function(){
		$('.mobileMenuHeaderFilter').removeClass('active');
		setTimeout(function(){
			$('.mobileMenuHeader').hide();
		},500);
	});

//preload animation
	/*$('.nav__mobile').on('click',function(){
		$('header').toggleClass('active3');
		$('.nav__menu').toggleClass('active');
	});*/
	function bodyClass(searchClass) {
		if ($('body').hasClass(searchClass)) {
			console.log(searchClass);
			$('.topHeader .menuAllFight').addClass('opacity');
		}
	}
	bodyClass('woocommerce-cart');	
	bodyClass('woocommerce-checkout');

//credits
console.log("ღ Maquinarias! ღ \n Dev con Amor por wampy para Arya");

/* MENU RESPONSIVE */

