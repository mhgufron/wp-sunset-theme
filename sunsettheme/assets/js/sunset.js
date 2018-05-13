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
    $(document).on('click', '.sunset-load-more:not(.loading)', function(e) {
        e.preventDefault();

        var that    = $(this);
        var page    = $(this).data('page');
        var newPage = page+1;
        var ajaxUrl = that.data('url');

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');
        
        $.ajax({

            url     : ajaxUrl,
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

                that.data('page', newPage);
                $('.sunset-post-container').append(response);
                // that.removeClass('loading');

            }

        })

    });


} )













//
