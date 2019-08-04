jQuery(document).ready(function(){
	"use strict";

	/*------------------------------------------
			HEADER FIVE NAVIGATION
	------------------------------------------*/
	var _btnnav = jQuery('#tg-btnnav');
	var _wrapper = $('#tg-wrapper');
	_btnnav.on('click', function () {
		_wrapper.toggleClass('tg-sidenavshow');
	});
	/*------------------------------------------
			TOGGLE NAV BUTTON
	------------------------------------------*/
	var toggles = document.querySelectorAll(".tg-btnnav");
		for (var i = toggles.length - 1; i >= 0; i--) {
		var toggle = toggles[i];
		toggleHandler(toggle);
	};
	function toggleHandler(toggle) {
		toggle.addEventListener( "click", function(e) {
		e.preventDefault();
		(this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
		});
	}


	/* -------------------------------------
			TAB ON HOVER
	-------------------------------------- */
	var _multiSelector = jQuery('.tg-femalecategorynav li a, .tg-malecategorynav li a, .tg-kidscategorynav li a');
	_multiSelector.on('mouseenter',function() {
		$(this).tab('show');
	});
	/* -------------------------------------
			HOME SLIDER VERSION THREE
	-------------------------------------- */

	var $container = $('.tg-featuredproducts');
	var $optionSets = $('.option-set');
	var $optionLinks = $optionSets.find('a');
	function doIsotopeFilter() {
		if ($().isotope) {
			var isotopeFilter = '';
			$optionLinks.each(function () {
				var selector = $(this).attr('data-filter');
				var link = window.location.href;
				var firstIndex = link.indexOf('filter=');
				if (firstIndex > 0) {
					var id = link.substring(firstIndex + 7, link.length);
					if ('.' + id == selector) {
						isotopeFilter = '.' + id;
					}
				}
			});
			//$(window).load(function () {
				$container.isotope({
					//itemSelector: '.tg-productitem',
					filter: isotopeFilter
				});
			//});
			$optionLinks.each(function () {
				var $this = $(this);
				var selector = $this.attr('data-filter');
				if (selector == isotopeFilter) {
					if (!$this.hasClass('tg-active')) {
						var $optionSet = $this.parents('.option-set');
						$optionSet.find('.tg-active').removeClass('tg-active');
						$this.addClass('tg-active');
					}
				}
			});
			$optionLinks.on('click', function () {
				var $this = $(this);
				var selector = $this.attr('data-filter');
				$container.isotope({itemSelector: '.tg-project', filter: selector});
				if (!$this.hasClass('tg-active')) {
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.tg-active').removeClass('tg-active');
					$this.addClass('tg-active');
				}
				return false;
			});
		}
	}
	var isotopeTimer = window.setTimeout(function () {
		window.clearTimeout(isotopeTimer);
		doIsotopeFilter();
	}, 1000);
	/* -------------------------------------
			COLLAPSE NAVIGATION
	-------------------------------------- */
	function collapseNav(){
		var _hasdropdown = jQuery('.tg-navigation ul li.tg-hasdropdown');
		_hasdropdown.prepend('<span class="tg-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
		var _eventselector = jQuery('.tg-navigation ul li.tg-hasdropdown span');
		_eventselector.on('click', function(){
			jQuery(this).next().next().slideToggle(300);
		});
	}
	collapseNav();
	/* -------------------------------------
			LOCATION MAP
	-------------------------------------- */

	/* -------------------------------------
			THEME ACCORDION
	-------------------------------------- */
	$(function() {
		$('.tg-panelcontent').hide();
		$('#tg-accordion h4:first').addClass('active').next().slideDown('slow');
		$('#tg-accordion h4').on('click',function() {
			if($(this).next().is(':hidden')) {
				$('#tg-accordion h4').removeClass('active').next().slideUp('slow');
				$(this).toggleClass('active').next().slideDown('slow');
			}
		});
	});



	/*------------------------------------------
			PRODUCT INCREASE
	------------------------------------------*/
	var _minusone = jQuery('em.minus');
	var _plusone = jQuery('em.plus');
	var _quantity = jQuery('#quantity1');
	_minusone.on('click', function () {
		_quantity.val(parseInt(_quantity.val(), 10) - 1);
	});
	_plusone.on('click', function () {
		_quantity.val(parseInt(_quantity.val(), 10) + 1);
	});
	/* ---------------------------------------
			DIRECTION AWARE HOVER
	--------------------------------------- */
	jQuery('.tg-portfolio').each(function () {
		jQuery(this).hoverdir();
	});
	/* ---------------------------------------
			FULL PAGE SEARCH
	--------------------------------------- */
	var _btnsearch = jQuery('a[href="#tg-search"]');
	var _search = jQuery('#tg-search');
	var _inputfocus = jQuery('#tg-search > form > fieldset > input[type="search"]');
	_btnsearch.on('click', function(event) {
		event.preventDefault();
		_search.addClass('open');
		_inputfocus.focus();
	});
	var _hidesearch = jQuery('#tg-search, #tg-search button.close');
	_hidesearch.on('click keyup', function(event) {
		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			jQuery(this).removeClass('open');
		}
	});
/*	jQuery('form').submit(function(event) {
		event.preventDefault();
		return false;
	});   */
	/* ---------------------------------------
		CATEGORY MEGA MENU
	--------------------------------------- */
	var _btncategory = jQuery('#tg-btncategory');
	var _category = jQuery('#tg-category');
	_btncategory.on('click', function(event) {
		event.preventDefault();
		_category.slideToggle(300);
		_category.parent().toggleClass('tg-open');
	});
	var _btncategory2 = jQuery('#tg-btncategory2');
	var _category2 = jQuery('#tg-category2');
	_btncategory2.on('click', function(event) {
		event.preventDefault();
		_category2.slideToggle(300);
		_category2.parent().toggleClass('tg-open');
	});
	/* ---------------------------------------
		HOME PAGE SEVEN NAVIGATION
	--------------------------------------- */
	var _closenav = jQuery('#tg-closenav');
	var _navigation = jQuery('#tg-navigation');
	_closenav.on('click', function(event) {
		event.preventDefault();
		_navigation.removeClass('in');
	});
});

// Čišćenje veb konzole i prikazivanje sigurnosne poruke
console.clear()
console.log("%cPažljivo! Ne biste trebali biti ovde. ❌❌❌ ", "background: red; color: yellow; font-weight: 800; font-size: x-large");
console.log("%cOvo je funkcija internet pregledača namenjena programerima. ", "background: red; color: yellow; font-weight: 800; font-size: medium");
console.log("%cAko vam je neko rekao da tekst nalepite ovde ovde da biste omogućili neku funkciju na e-aukcije.rs to je verovatno prevara. 😠", "background: red; color: yellow; font-weight: 800; font-size: medium");
console.log("%cZa više informacija pročitajte:https://e-aukcije.rs/blog-konzola-sigurnost/", "background: red; color: yellow; font-weight: 800; font-size: medium");

// Blokiranje korišćenja desnog klika


// Blokiranje tastera F12
$(document).keydown(function(e){
    if(e.which === 123){
       return false;
    }
});
