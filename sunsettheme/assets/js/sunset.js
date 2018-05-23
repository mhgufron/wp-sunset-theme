jQuery(document).ready( function($) {
    // Custom Sunset Script

    /* init function */
    revealPost();

    /* Variable declaration */
    var last_scroll = 0;

    /* Carousel functions */
    $(document).on('click', '.sunset-carousel-thumb', function () {
        var id = $('#' + $(this).attr('id'));
        $(id).on('slid.bs.carousel', function () {
            sunset_get_bs_thumbs(id);
        });
    });

    $(document).on('mouseover', '.sunset-carousel-thumb', function () {
        var id = $('#' + $(this).attr('id'));
        sunset_get_bs_thumbs(id);
    });

    function sunset_get_bs_thumbs( id ) {
        var nextThumb = $(id).find('.item.active').find('.next-image-preview').data('image');
        var prevThumb = $(id).find('.item.active').find('.prev-image-preview').data('image');
        $(id).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image': 'url(' + nextThumb + ')'});
        $(id).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image': 'url(' + prevThumb + ')'});
    }

    /* Scroll Function */
    $(window).scroll( function() {

        var scroll = $(window).scrollTop();
        if ( Math.abs( scroll - last_scroll ) > $(window).height() * 0.1 ) {
            last_scroll = scroll;

            $('.page-limit').each( function( index ) {

                if ( isVisible( $(this) ) ) {
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
        var prev    = that.data('prev');
        var archive = that.data('archive');

        if ( typeof prev === 'undefined' ) {
            prev    = 0;
        }

        if ( typeof archive === 'undefined' ) {
            archive    = 0;
        }

        console.log(prev);

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');

        $.ajax({

            url     : ajaxUrl,
            type    : 'post',
            data    : {

                page    : page,
                prev    : prev,
                archive : archive,
                action  : 'sunset_load_more'

            },
            error   : function( response ) {
                console.log(response);
                console.log('error');
            },
            success : function( response ) {

                if ( response == 0 ) {
                    $('.sunset-post-container').append('<div class="text-center"><h3>You reach the end of the line!</h3> <p>No More posts to load</p></div>')
                    that.slideUp(320);
                } else {
                    setTimeout(function() {

                        if ( prev == 1 ) {
                            $('.sunset-post-container').prepend(response);
                            newPage = page-1;
                        } else {
                            $('.sunset-post-container').append(response);
                        }

                        if ( newPage == 1 ) {
                            that.slideUp(320);
                        } else {
                            that.data('page', newPage);

                            that.removeClass('loading').find('.text').slideDown(320);
                            that.find('.sunset-icon').removeClass('spin');
                        }
                        revealPost();

                    }, 1000 );
                }


            }

        })

    });

    /* helper function */
    function revealPost() {

        $('[data-toggle="tooltip"]').tooltip();        

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
