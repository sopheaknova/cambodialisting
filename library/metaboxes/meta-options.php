<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'sp_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function sp_register_meta_boxes( $meta_boxes )
{
	$prefix = 'sp_';
		
	/* ---------------------------------------------------------------------- */
	/*	Listing meta box
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'company-info-settings',
		'title'    => __('Company Info', 'sptheme_admin'),
		'pages'    => array('sp_listing'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
				
			array(
					'name' => __('Address', 'sptheme_admin'),
					'id'   => $prefix . 'address',
					'type' => 'textarea',
					'std'  => '',
					'desc' => 'e.g: No. 29B, Mao Tse Toung Blvd, Sangkat Boeung Keng Kang I, Khan Chamkar Morn, 12302 Phnom Penh'
				),
			
			
			array(
					'id'            => 'location',
					'name'          => __( 'Location', 'sptheme_admin' ),
					'type'          => 'map',
					'std'           => '11.576086,104.92306,12',     // 'latitude,longitude[,zoom]' (zoom is optional)
					'style'         => 'width: 99%; height: 350px',
					'address_field' => 'sp_address',                     // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
				),
				
			array(
				'type' => 'heading',
				'name' => __( 'Contact Information', 'sptheme_admin' ),
				'id'   => 'fake_id', // Not used but needed for plugin
			),
			
			array(
					'name' => __('Communication Line', 'sptheme_admin'),
					'id'   => $prefix . 'comm_line',
					'type' => 'contact_info',
					'std'  => ''
				),
		)
	);	
	return $meta_boxes;
}