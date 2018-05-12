jQuery(document).ready( function($) {
    // Custom Sunset Javascript

    var carousel = '.sunset-carousel-thumb';

    sunset_get_bs_thumbs( carousel );

    $( carousel ).on('slid.bs.carousel', function() {
        sunset_get_bs_thumbs( carousel );
    });

    function sunset_get_bs_thumbs( carousel ) {
        var nextThumb = $('.item.active').find('.next-image-preview').data('image');
        var prevThumb = $('.item.active').find('.prev-image-preview').data('image');
        $(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image': 'url(' + nextThumb + ')'});
        $(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image': 'url(' + prevThumb + ')'});
    }

    /* Ajax Comment */
    $(document).on('click', '.sunset-load-more', function(e) {
        e.preventDefault();

        var page    = $(this).data('page');
        var ajaxurl = $(this).data('url');

        $.ajax({

            url     : ajaxurl,
            type    : 'post',
            data    : {

                page    : page,
                action  : 'sunset_load_more'

            },
            error   : function( response ) {
                console.log(response);
                console.log('error');
            },
            success : function( response ) {

                $('.sunset-post-container').append(response);

            }

        })

    });


} )













//
