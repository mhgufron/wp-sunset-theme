jQuery(document).ready( function($) {
    // Custom Sunset Script

    /* init function */
    revealPost();

    /* Variable declaration */
    var carousel    = '.sunset-carousel-thumb';
    var last_scroll = 0;

    /* Carousel functions */
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

    /* Scroll Function */
    $(window).scroll( function() {

        var scroll = $(window).scrollTop();
        if ( Math.abs( scroll - last_scroll ) > $(window).height() * 0.1 ) {
            last_scroll = scroll;

            $('.page-limit').each( function( index ) {

                if ( isVisible( $(this) ) ) {
                    console.log('visible');
                    history.replaceState( null, null, $(this).attr( "data-page" ) );
                    return false;

                }

            } )
        }

    } )

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

                setTimeout(function() {

                    that.data('page', newPage);
                    $('.sunset-post-container').append(response);

                    that.removeClass('loading').find('.text').slideDown(320);
                    that.find('.sunset-icon').removeClass('spin');

                    revealPost();

                }, 1000 );

            }

        })

    });

    /* helper function */
    function revealPost() {

        var posts   = $('article:not(.reveal)');
        var i       = 0;

        setInterval( function() {

            if ( i >= posts.length) return false;

            var el = posts[i];
            $(el).addClass('reveal').find('.sunset-carousel-thumb').carousel();
            i++;

        }, 320 )

    }

    function isVisible( element ) {

        var scroll_pos      = $(window).scrollTop();
        var window_height   = $(window).height();
        var el_top          = $(element).offset().top;
        var el_height       = $(element).height();
        var el_bottom       = el_top + el_height;
        return ( ( el_bottom - el_height*0.25 > scroll_pos ) && ( el_top < ( scroll_pos + 0.5 * window_height ) ) )

    }
	function isVisible( element ){

		var scroll_pos = $(window).scrollTop();
		var window_height = $(window).height();
		var el_top = $(element).offset().top;
		var el_height = $(element).height();
		var el_bottom = el_top + el_height;
		return ( ( el_bottom - el_height*0.25 > scroll_pos ) && ( el_top < ( scroll_pos+0.5*window_height ) ) );

	}

} )













//
