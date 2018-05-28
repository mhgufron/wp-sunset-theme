<?php
/**
 * Short Codes Options
 *
 * @package sunset
 * @since 1.0
 * @version 1.0
 */

/*
    ========================================================
        Tooltip Shortcode
    ========================================================
*/

function sunset_tooltip( $atts, $content = null )
{
    // Use this code: [tooltip placement="top" title="This is the title"]This is The Content[/tooltip]
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

/*
    ========================================================
        Popover Shortcode
    ========================================================
*/

function sunset_popover( $atts, $text = null )
{

    // Use this code: [popover placement="top" title="Popover title" content="Popover Content" trigger="click"]This is The Content[/popover]
    // Get the attributes
    $atts = shortcode_atts(
        array (
            'placement' => 'top',
            'trigger'   => 'click',
            'title'     => '',
            'content'   => ''
        ),
        $atts,
        'popover'
    );

    $data_content = ( $atts['content'] == '' ? 'Content of ' . $text : $atts['content'] );

    // Return HTTML

    return '<a class="sunset-popover" data-toggle="popover" data-trigger="' . $atts['trigger'] . '" data-placement="' . $atts['placement'] . '" title="' . $atts['title'] . '" data-content="' . $data_content . '">' . $text . '</a>';
}
add_shortcode( 'popover', 'sunset_popover' );

/*
    ========================================================
        Contact Form shortcode
    ========================================================
*/
function sunset_contact_form( $atts, $content = null )
{
    // Use this code: [contact_form]
    // Get the attributes
    $atts = shortcode_atts(
        array (),
        $atts,
        'contact_form'
    );

    // Return HTTML

    ob_start(); /* output buffering */
    require_once 'templates/contact-form.php';
    return ob_get_clean();
}
add_shortcode( 'contact_form', 'sunset_contact_form' );





















/* My Subcomment */
