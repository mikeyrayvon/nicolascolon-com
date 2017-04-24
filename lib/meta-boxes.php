<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

   $exhibition_meta = new_cmb2_box( array(
 		'id'            => $prefix . 'exhibition_metabox',
 		'title'         => esc_html__( 'Exhibition Details', 'cmb2' ),
 		'object_types'  => array( 'exhibition', ), // Post type
 	) );

  $exhibition_meta->add_field( array(
		'name' => esc_html__( 'Venue', 'cmb2' ),
		'id'   => $prefix . 'venue',
		'type' => 'text',
	) );

  $exhibition_meta->add_field( array(
		'name' => esc_html__( 'Venue Link', 'cmb2' ),
		'id'   => $prefix . 'venue_link',
		'type' => 'text_url',
	) );

  $exhibition_meta->add_field( array(
		'name' => esc_html__( 'Open Date', 'cmb2' ),
		'id'   => $prefix . 'date_open',
		'type' => 'text_date_timestamp',
	) );

  $exhibition_meta->add_field( array(
		'name' => esc_html__( 'Close Date', 'cmb2' ),
		'id'   => $prefix . 'date_close',
		'type' => 'text_date_timestamp',
	) );

  $exhibition_docu_meta = new_cmb2_box( array(
   'id'            => $prefix . 'exhibition_docu_metabox',
   'title'         => esc_html__( 'Exhibition Documentation', 'cmb2' ),
   'object_types'  => array( 'exhibition', ), // Post type
 ) );

 $exhibition_docu_meta->add_field( array(
   'id'      => $prefix . 'documentation',
   'type'    => 'wysiwyg',
   'options' => array( 'textarea_rows' => 15, ),
 ) );

 $type_meta = new_cmb2_box( array(
   'id'               => $prefix . 'type_meta',
   'title'            => esc_html__( 'Type Options', 'cmb2' ), // Doesn't output for term boxes
   'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
   'taxonomies'       => array( 'exhibition_type',), // Tells CMB2 which taxonomies should have these fields
   'new_term_section' => true, // Will display in the "Add New Category" section
 ) );

 $type_meta->add_field( array(
   'name' => esc_html__( 'Abbreviation', 'cmb2' ),
   'id'   => $prefix . 'type_abbr',
   'type' => 'text',
 ) );


}
?>
