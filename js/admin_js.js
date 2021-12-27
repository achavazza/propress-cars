(function( $ ) {
$(function() {
//$( 'body' ).on( 'submit', '#post', function() {
//$('body').on('click', '.widget-control-save',  function() {
    //alert('stop!');
    /* fix porque el repeteable no anda bien*/
    $('.cmb-repeat-table').each(function(){
    //if ( el.parent().hasClass( 'cmb2-options-page' ) ) {

        var el = $( this );
        //console.log(el);
        // Find hidden rows in repeatable groups
        el.find( '.cmb-row.hidden' ).each( function() {

            // Disable selects
            //console.log($(this));
            var hidden = $( this ).find( 'input[type=hidden]' );
            var input = $( this ).find( 'input[type=text]' );
            console.log(input, input.val());
            console.log(hidden, hidden.val());
            //alert('stop!');
            input.val('');
            hidden.val('');

        });
    })
//});
//});

/*
$( document ).on( { 'widget-added widget-updated': function ( e, widget ) {
    $(this).find( '.cmb-row.hidden' ).each( function() {
        var input = $( this ).find( 'input' );
        input.val('');
        console.log(input, input.val());
    });
}});
*/

/*
// More code using $ as alias to jQuery
$( 'body' ).on( 'submit', '#post', function() {


    // Init
    //var el = $( this );
    //console.log(el);

    // Options page?
    //console.log($('.cmb-repeat-table'));
    $('.cmb-repeat-table').each(function(){
    //if ( el.parent().hasClass( 'cmb2-options-page' ) ) {

        var el = $( this );
        //console.log(el);
        // Find hidden rows in repeatable groups
        el.find( '.cmb-row.hidden' ).each( function() {

            // Disable selects
            //console.log($(this));
            var input = $( this ).find( 'input' );
            input.prop( 'disabled', true );
            input.value(false);
            //console.log(input);
            //alert('stop!');

        });

    //}
    })

*/
//});
});
})(jQuery);


(function( window, document, $ ) {
    $( document ).on('widget-updated widget-added', function( event, widget ) {
        var $metabox = $(widget).find('.cmb2-wrap > .cmb2-metabox'),
            cmb = window.CMB2;

        $metabox
            .on('click', '.cmb-add-group-row', cmb.addGroupRow)
            .on('click', '.cmb-add-row-button', cmb.addAjaxRow)
            .on('click', '.cmb-remove-group-row', cmb.removeGroupRow)
            .on('click', '.cmb-remove-row-button', cmb.removeAjaxRow)
            .on( 'click', '.cmbhandle, .cmbhandle + .cmbhandle-title', cmb.toggleHandle );

    });
})( window, document, jQuery );
