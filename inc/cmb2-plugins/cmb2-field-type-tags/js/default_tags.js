(function($){

cmb_tags = {

	init : function() {

		var t = this, ajaxtag = $('.cmb-type-default-tags div.ajaxtag'), start_pos;

		//$('.cmb-type-default-tags .hide-if-no-js').removeClass('hide-if-no-js');
		//$('.cmb-type-default-tags textarea').hide();

    	$( ".cmb-type-default-tags .tagchecklist" ).sortable({
    		start: function(event, ui) {
		        start_pos = ui.item.index();
		    },
		    stop: function(event, ui) {
		        cmb_tags.updateTags(
                    $(this).closest('.cmb-type-default-tags'), start_pos, ui.item.index()
                );
		    }
       	});
        /*
    	$( ".cmb-type-default-tags .tagchecklist" ).disableSelection();
	    $('.cmb-type-default-tags').each( function() {
	        cmb_tags.quickClicks(this);
	    });

		$('input.button', ajaxtag).click(function(){
			t.flushTags( $(this).closest('.cmb-type-default-tags') );
		});

		$('input.new', ajaxtag).keyup(function(e){
			if ( 13 == e.which ) {
				cmb_tags.flushTags( $(this).closest('.cmb-type-default-tags') );
				return false;
			}
		}).keypress(function(e){
			if ( 13 == e.which ) {
				e.preventDefault();
				return false;
			}
		});

	    // save tags on post save/publish
        */
        $('#post').submit(function(){
			$('.cmb-type-default-tags').each( function() {
	        	cmb_tags.flushTags(this, false, 1);
			});
		});

	},
	clean : function(tags) {
        console.log(tags);
		return tags.replace(/\s*,\s*/g, ',').replace(/,+/g, ',').replace(/[,\s]+$/, '').replace(/^[,\s]+/, '');
	},
	parseTags : function(el) {
		var id = el.id,
            num = id.split('-check-num-')[1],
            taxbox = $(el).closest('.cmb-type-default-tags'),
            thetags = taxbox.find('textarea'),
            current_tags = thetags.val().split(','),
            new_tags = [];

		delete current_tags[num];

		$.each( current_tags, function(key, val) {
			val = $.trim(val);
			if ( val ) {
				new_tags.push(val);
			}
		});
        //console.log(thetags);
		thetags.val( this.clean( new_tags.join(',') ) );

		//this.quickClicks(taxbox);
		return false;
	},

	updateTags : function(el, start_pos, stop_pos) {
        var thetags = $('textarea', el),
			current_tags, sorted_tags;

		if ( !thetags.length )
			return;

		current_tags = thetags.val().split(',');

		current_tags.move( start_pos, stop_pos );
		for (var i = 0; i < current_tags.length; i++) {
			if (i==0) sorted_tags = ''; else sorted_tags += ',';
			sorted_tags += current_tags[i];
		}

		thetags.val(sorted_tags);
	},
    /*
	quickClicks : function(el) {
		var thetags = $('textarea', el),
			tagchecklist = $('.tagchecklist', el),
			id = $(el).attr('id'),
			current_tags, disabled;

		if ( !thetags.length )
			return;

		disabled = thetags.prop('disabled');

		current_tags = thetags.val().split(';');
		tagchecklist.empty();
		$.each( current_tags, function( key, val ) {

			var span, xbutton;

			val = $.trim( val );

			if ( ! val )
				return;

			// Create a new span, and ensure the text is properly escaped.
			span = $('<span />').text( val );

			// If tags editing isn't disabled, create the X button.
			if ( ! disabled ) {

                xbutton = $( '<button type="button" id="' + id + '-check-num-' + key + '" class="ntdelbutton"><span class="remove-tag-icon" aria-hidden="true"></span></button>' );
				//xbutton = $( '<a id="' + id + '-check-num-' + key + '" class="ntdelbutton">X</a>' );
				xbutton.click( function(){ cmb_tags.parseTags(this); });
				span.prepend('&nbsp;').prepend( xbutton );
			}

			// Append the span to the tag list.
			tagchecklist.append( span );
		});
	},
    */

	//called on add tag, called on save
	flushTags : function(el, a, f) {

		a = a || false;
		var text,
            tags = $('textarea', el),
            newtag = $('input.new', el),
            newtags;

		text = a ? $(a).text() : newtag.val();

		tagsval = tags.val();
		newtags = tagsval ? tagsval + ',' + text : text;
		newtags = this.clean( newtags );
		newtags = array_unique_noempty( newtags.split(',') ).join(',');

		tags.val(newtags);
        /*

		//this.quickClicks(el);

        */
		if ( !a )
			newtag.val('');
		if ( 'undefined' == typeof(f) )
			newtag.focus();

		return false;
	}

}

Array.prototype.move = function (old_index, new_index) {
    if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
            this.push(undefined);
        }
    }
    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
};
})(jQuery);

jQuery(document).ready(function($) {
	cmb_tags.init();
});
