(function ($) {

// Behavior to load FlexSlider
Drupal.behaviors.flexslider = {
  attach: function(context, settings) {
    var sliders = [];

    for (id in settings.flexslider.instances) {
      
      if (settings.flexslider.optionsets[settings.flexslider.instances[id]] !== undefined) {
        if (settings.flexslider.optionsets[settings.flexslider.instances[id]].asNavFor !== '') {
          // We have to initialize all the sliders which are "asNavFor" first.
          _flexslider_init(id, settings.flexslider.optionsets[settings.flexslider.instances[id]], context);
        }
        else {
          // Everyone else is second
          sliders[id] = settings.flexslider.optionsets[settings.flexslider.instances[id]];
        }
      }
    }
    // Slider set
    for (id in sliders) {
      _flexslider_init(id, settings.flexslider.optionsets[settings.flexslider.instances[id]], context);
    }
  }
};

/**
 * Initialize the flexslider instance
 */
function _flexslider_init(id, optionset, context) {
  $('#' + id, context).once('flexslider', function() {
    // Remove width/height attributes
    // @todo load the css path from the settings
    $(this).find('ul.slides > li  img').removeAttr('height');
    $(this).find('ul.slides > li  img').removeAttr('width');

	_init_animation_values(this);
	optionset.start = _animate_slide;    
	optionset.after = _animate_slide;
	optionset.before = _pre_animate_slide;
	
    if (optionset) {
      $(this).flexslider(optionset);
    }
    else {
      $(this).flexslider();
    }
  });
}

function _pre_animate_slide(fl) {
	var oset = $(fl.slides[fl.animatingTo]).find('.animation-content')[0];
	oset = $(oset);
	if (oset.data('animation-calculated')) {
		oset.find(oset.data('animation-calculated').join(',')).each(function(){ // each of the nodes in selectors, previously calculated
			$(this).hide();
		});
	}
}

function _animate_slide(fl) {
	var oset = $(fl).find('.flex-active-slide .animation-content')[0];
	oset = $(oset);
	oset.find(oset.data('animation-calculated').join(',')).each(function(){ // each of the nodes in selectors, previously calculated
		$(this).hide();
		var data = $(this).data('animation-data');
		if (data) {
			var init = data[0];
			init.options.complete = function(){
				$(this).fadeIn({queue:false});
				var data = $(this).data('animation-data');
				for (var idx = 1; idx < data.length; idx++) {
					var animation = data[idx];
					animation.options.queue = 'overlay-animation';
					$(this).animate(animation.data,animation.options);
				}
			}; // perform 1st animation hiddenly. When complete, fade in and do the rest
			init.options.queue = 'overlay-animation';
			$(this).css('position', 'absolute');
			$(this).animate(init.data, init.options);
		}
    });

}

function _init_animation_values(fl) {
	// resizing stuff
	$(fl).data('original-width',$(fl).width());
	$(fl).find('.overlay').each(function(){
		//resizing stuff
		$(this).find('img').each(function(){
			$(this).data('original-width', $(this).width())
		});
		$(this).contents()
			.filter(function() {
				return this.nodeType === 3; //Node.TEXT_NODE
			}).each(function(){
				$(this).parent().data('original-font-size', $(this).parent().css('font-size'));
			});					  		
	});
	$(fl).resize(function(){
		var original_width = $(fl).data('original-width');
		var current_width = $(fl).width();
		var resizefactor = current_width / original_width ;

		$(this).find('.overlay img').each(function(){
			$(this).width($(this).data('original-width') * resizefactor);
		});
		$(this).find('.overlay').contents()
			.filter(function() {
				return this.nodeType === 3; //Node.TEXT_NODE
			}).each(function(){
				$(this).parent().css('font-size',$(this).parent().data('original-font-size')*resizefactor);
			});					  
	});
	
	// retrieve animation data and set initial constant values
	$(fl).find('.animation-content').each(function() {
	  if ($(this).data('animation-calculated')==null) {
		  var rules = $(this).find('.overlay').attr('data-animation').split(/\|/);
		  var selectors = []; // collecting selectors
		  for (var i = 0; i< rules.length; i++) {
			  var r = rules[i];
			  var data = r.split(/#/);
			  if (data.length != 3 ) {
				  continue;
			  }
			  var selector = data[0].replace(/^\s+|\s+$/g, '');	  
			  selectors.push(selector);
	
			  var animation = {};
			  
			  // collect data for options
			  animation.options = {}; 
			  var opts = data[1].split(/,/);
			  for (var j = 0; j < opts.length; j++) {
				  fld = opts[j].split(/:/,2);
				  if (fld.length ==2) {
					  animation.options[fld[0].replace(/^\s+|\s+$/g, '')] = fld[1].replace(/^\s+|\s+$/g, '');
				  }
			  }
			  if (animation.options.duration && !animation.options.duration.match(/fast|slow/)) { 
				animation.options.duration = parseInt(animation.options.duration);
			  }
			  
			  
			  // collect data for animation 
			  var anims = data[2].split(/,/);
			  animation.data = {};
			  for (var j = 0; j < anims.length; j++) {
				  fld = anims[j].split(/:/,2);
				  if (fld.length ==2) {
					  animation.data[fld[0].replace(/^\s+|\s+$/g, '')] = fld[1].replace(/^\s+|\s+$/g, '');
				  }
			  }
			  
			  //push collected data and initial values
			  $(this).find('.overlay').find(selector).each(function(){
				  if ($(this).data('animation-data') == undefined) {
					  $(this).data('animation-data', []);
				  }
				  
					$(this).data('animation-data').push(animation);				  
			  });
		  };
		  $(this).data('animation-calculated', selectors); // calculate once per page load
	};
	});
	
}

}(jQuery));
