<?php
/**
 * Short Codes Options
 *
 * @package sunset
 * @since 1.0
 * @version 1.0
 */

function sunset_tooltip( $atts, $content = null )
{
    // [tooltip placement="top" title="This is the title"]This is The Content[/tooltip]
    // Get the attributes
    $atts = shortcode_atts(
        array (
            'placement' => 'top',
            'title' => ''
        ),
        $atts,
        'tooltip'
    );

    $title = ( $atts['title'] == '' ? $content : $atts['title'] );

    // Return HTTML

    return '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="' . $atts['placement'] . '" title="' . $title . '">' . $content . '</span>';
}

add_shortcode( 'tooltip', 'sunset_tooltip' );
