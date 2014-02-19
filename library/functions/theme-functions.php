<?php

/* ---------------------------------------------------------------------- */
/*	Render Listing Detail
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_listing_detail' ) ) {

	function sp_listing_detail( $post_meta_keys, $thum_size ) {
	
		global $post, $smof_data;
	
		$output = '<article class="listing-' . get_the_ID() . '">';
		$output .= '<div class="one_half">'; 

		$output .= '<div id="listing-info">';
		$output .= '<h2 class="listing-name">' . get_the_title() . '</h2>';
		$output .= sp_address_listing($post_meta_keys);
		$output .= sp_get_comm_line($post_meta_keys);
		
		$output .= '</div><!-- end #listing-info -->';

		$output .= '<div class="categories">';
		$output .= get_the_term_list( $post->ID, 'listing-type', '<span>', '</span><span>', '</span>');
		$output .= '</div><!-- end .categories -->';
		
		$output .= '</div><!-- end .one_half -->';
		
		$output .= '<div class="one_half last">';
		
		if ( $smof_data['show_listing_map'] ) :
			$output .= sp_single_map('listing-location');
		endif;
		$output .= '</div><!-- end .one_half .last -->';
		
		$output .= '<div class="clear"></div>';
		
		$output .= '</article>';
			
		return $output;	
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Render Listing Detail
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_event_detail' ) ) {

	function sp_event_detail( $post_meta_keys, $thum_size ) {
	
		global $post, $smof_data;
			
		$output = '<article class="listing-' . get_the_ID() . '">';
		
		$output .= '<div id="listing-info">';
		
		$output .= '<div class="two_third">';
		$output .= '<h2 class="listing-name">' . get_the_title() . '</h2>';
		$output .= sp_address_listing($post_meta_keys);
		$output .= '</div><!-- end .two_third -->';
		
		$output .= '<div class="one_third last">';
		$output .= '<p class="organisor"><span>' . __('Organisor', 'sptheme') . '</span><a href="' . get_permalink($post_meta_keys['sp_organized_by'][0]) . '">' . get_the_title($post_meta_keys['sp_organized_by'][0]) . '</a></p>';
		$output .= '</div><!-- end .one_third .last-->';	
		$output .= '<div class="clear"></div>';
		
		$output .= '<div class="one_third">';
		
		if ( sp_post_image($thum_size) ) :
		$output .= '<img src="' . sp_post_image($thum_size) . '" />'; 
		endif;
		
		$output .= '<div class="social-links"><span>' . __( 'Join this event on:', 'sptheme' ) . '</span>' . sp_get_social_networking( 'yes', '16', $post_meta_keys ) . '</div><!-- end .social-links -->';
		
		$output .= '<div class="categories">';
		$output .= get_the_term_list( $post->ID, 'event-type', '<span>', '</span><span>', '</span>');
		$output .= '</div><!-- end .categories -->';
		
		$output .= '</div><!-- end .one_third -->';
		
		$output .= '<div class="two_third last">';
		$output .= '<h5>' . __( 'Contact Infomation', 'sptheme' ) . '</h5>';
		$output .= sp_get_comm_line($post_meta_keys);
		
		$output .= '<h5>' . __( 'Event Date', 'sptheme' ) . '</h5>';
		$output .= sp_get_event_info($post_meta_keys);
		
		if( $smof_data[ 'share_post' ] ) :
		$output .= '<span class="social-share">' . __( 'Share on: ', 'spthemem' ) . '</span>';
		$output .= sp_social_share();
		endif;
		
		$output .= '</div><!-- end .two_third .last -->';
		$output .= '<div class="clear"></div>';
		
		$output .= '</div><!-- end #listing-info -->';
		
		if ( $smof_data['show_listing_map'] ) :
		$output .= sp_single_map('event-location');
		endif;
		
		$output .= sp_single_description();
		
		$output .= '</article>';
			
		return $output;	
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Address listing
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_address_listing' ) ) {

	function sp_address_listing($post_meta_keys) {
		
		global $post;
		
		$output = '<address>' . $post_meta_keys['sp_address'][0] . '</address>';
		
		return $output;
	}

}

/* ---------------------------------------------------------------------- */
/*	Map Homepage
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_map_homepage' ) ) {

	function sp_map_homepage() {
		
		global $post;
		
		$output = '<div id="map-home">';
		$output .= '<div id="map-home-container"></div>';
		$output .= '<div id="dir-container"></div>';
		$output .= '</div><!-- end #map-home -->';	
		
		return  $output;
	}

}

/* ---------------------------------------------------------------------- */
/*	Map listing
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_single_map' ) ) {

	function sp_single_map($tax_id = null) {
		
		global $post;
		
		$output = '<div id="listing-map">';
		$output .= '<div id="single-map"></div>';
		$output .= '<div id="dir-container"></div>';
		$output .= '<span class="location-info">' . __( 'Location ', 'sptheme' ) . '<small>' . get_the_term_list( $post->ID, $tax_id, 'in ', ', ', '') . '</small></span>';
		$output .= '</div><!-- end .listing-map -->';	
		
		return  $output;
	}

}		

/* ---------------------------------------------------------------------- */
/*	Show Communication Line
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_get_comm_line')) {

	function sp_get_comm_line($post_meta_keys) {
		
		global $post, $commLine;
		
		$contact_infos = maybe_unserialize(get_post_meta( $post->ID, 'sp_comm_line', true ));
		$output = '<ul class="comm">';
		
		foreach ( $contact_infos as $i => $line ) :
		
			$comm_type = $line['comm-type'];
			$comm_value = $line['comm-value'];
		
			if ($line['comm-type'] == 'website') {
				$output .= '<li><span class="attr">' . ucfirst($comm_type) . '</span><span class="value"><a href="' . $comm_value . '" target="_blank">' . substr($comm_value, 7) . '</a></span></li>';
			} elseif ($line['comm-type'] == 'e-mail') {
				$output .= '<li><span class="attr">' . ucfirst($comm_type) . '</span><span class="value"><a href="mailto:' . antispambot($comm_value) . '">' . antispambot($comm_value) . '</a></span></li>';
			} elseif ($line['comm-type'] == 'pobox') {
				$output .= '<li><span class="attr">P.O. Box</span><span class="value">' . $comm_value . '</span></li>';
			} else {
			$output .= '<li><span class="attr">' . ucfirst($comm_type) . '</span><span class="value">' . $comm_value . '</span></li>';
			}
		endforeach;
		
		$output .= '</ul>';
		
		return $output;
	}
}	

/* ---------------------------------------------------------------------- */
/*	Show opening attribute
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_get_opening_attr')) {

	function sp_get_opening_attr($post_meta_keys) {
		
		global $openHourAttr;
		
		$hours = maybe_unserialize($post_meta_keys['sp_open_hour'][0]);
		$output = '<ul class="open-hour">';
		
		foreach ( $hours as $hour ) :
			
			switch($hour['day-select']){
				case 0:
					$day_attr = $openHourAttr['0'];
					break;
				
				case 1:
					$day_attr = $openHourAttr['1'];	
					break;
					
				case 2:
					$day_attr = $openHourAttr['2'];
					break;
					
				case 3:
					$day_attr = $openHourAttr['3'];
					break;
					
				default:
					break;	
			}
		
			$output .= '<li>' . $day_attr . ': ' . $hour['start-hour'] . ' - ' . $hour['end-hour'] . '</li>';
		endforeach;
		
		$output .= '</ul>';
		
		return $output;
	}
}

/* ---------------------------------------------------------------------- */
/*	Show event date and time
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_get_event_info')) {

	function sp_get_event_info($post_meta_keys) {
		
		global $eventRepeatOptions;
		
		$is_repeat = $post_meta_keys['sp_is_repeat'][0];
		$repeat_every = $post_meta_keys['sp_repeat_options'][0];
		
		$event_start = explode(' ', $post_meta_keys['sp_evt_start'][0]);
		$event_end = explode(' ', $post_meta_keys['sp_evt_end'][0]);
								
		$output = '<ul class="event-date clearfix">';
		$output .= '<li><span class="icons date"></span><span>' . __('Start Date: ', 'sptheme') . '</span>' . date('F j, Y', strtotime($event_start[0])) . '</li>';
		$output .= '<li><span class="icons date"></span><span>' . __('End Date: ', 'sptheme') . '</span>' . date('F j, Y', strtotime($event_end[0])) . '</li>';
		$output .= '<li><span class="icons time"></span><span>' . __('Time: ', 'sptheme') . '</span>' . $event_start[1] . ' to ' . $event_end[1] . '</li>';
		if ( ($is_repeat == 1) && !empty($repeat_every))
			$output .= '<li><span class="icons repeat"></span><span>' . __('Will do: ', 'sptheme') . '</span>' . $eventRepeatOptions[$repeat_every] . '</li>';
		$output .= '</ul>';
		
		return $output;
	}
}	

/* ---------------------------------------------------------------------- */
/*	Taxonomy list
/* ---------------------------------------------------------------------- */
/*
	* Taxonomy list - returns array [slug => name]
	*
	* $args = ARRAY [see below for options]
	*/
	if ( ! function_exists( 'sp_tax_array' ) ) {
		function sp_tax_array( $args = array() ) {
			$args = wp_parse_args( $args, array(
					'all'          => true, //whether to display "all" option
					'allCountPost' => 'post', //post type to count posts for "all" option, if left empty, the posts count will not be displayed
					'allText'      => __( 'All posts', 'sptheme_admin' ), //"all" option text
					'hierarchical' => '1', //whether taxonomy is hierarchical
					'orderBy'      => 'name', //in which order the taxonomy titles should appear
					'parentsOnly'  => false, //will return only parent (highest level) categories
					'return'       => 'slug', //what to return as a value (slug, or term_id?)
					'tax'          => 'category', //taxonomy name
				) );

			$outArray = array();
			$terms    = get_terms( $args['tax'], 'orderby=' . $args['orderBy'] . '&hide_empty=0&hierarchical=' . $args['hierarchical'] );

			if ( $args['all'] ) {
				if ( ! $args['allCountPost'] ) {
					$allCount = '';
				} else {
					$allCount = wp_count_posts( $args['allCountPost'], 'readable' );
					$allCount = ' (' . absint( $allCount->publish ) . ')';
				}
				$outArray[''] = '- ' . $args['allText'] . $allCount . ' -';
			}

			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( ! $args['parentsOnly'] ) {
						$outArray[$term->$args['return']] = $term->name;
						$outArray[$term->$args['return']] .= ( ! $args['allCountPost'] ) ? ( '' ) : ( ' (' . $term->count . ')' );
					} elseif ( $args['parentsOnly'] && ! $term->parent ) { //get only parent categories, no children
						$outArray[$term->$args['return']] = $term->name;
						$outArray[$term->$args['return']] .= ( ! $args['allCountPost'] ) ? ( '' ) : ( ' (' . $term->count . ')' );
					}
				}
			}

			return $outArray;
		}
	} // /sp_tax_array
	
/* ---------------------------------------------------------------------- */
/*	Pages list
/* ---------------------------------------------------------------------- */	
	/*
	* Pages list - returns array [post_name (slug) => name]
	*
	* $return  = 'post_name' OR 'ID'
	*/
	if ( ! function_exists( 'sp_pages' ) ) {
		function sp_pages( $return = 'post_name' ) {
			$pages       = get_pages();
			$outArray    = array();
			$outArray[0] = __( '- Select page -', 'sptheme_admin' );

			foreach ( $pages as $page ) {
				$indents = $pagePath = '';
				$ancestors = get_post_ancestors( $page->ID );

				if ( ! empty( $ancestors ) ) {
					$indent = ( $page->post_parent ) ? ( '&ndash; ' ) : ( '' );
					foreach ( $ancestors as $ancestor ) {
						if ( 'post_name' == $return ) {
							$parent = get_page( $ancestor );
							$pagePath .= $parent->post_name . '/';
						}
						$indents .= $indent;
					}
				}

				$pagePath .= $page->post_name;
				$returnParam = ( 'post_name' == $return ) ? ( $pagePath ) : ( $page->ID );

				$outArray[$returnParam] = $indents . strip_tags( $page->post_title );
			}

			return $outArray;
		}
	} // /sp_pages

/* ---------------------------------------------------------------------- */
/*	Blog navigation
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_pagination') ) {

	function sp_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'sptheme') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Previous', 'sptheme') . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Next', 'sptheme') . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'sptheme') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}

	


