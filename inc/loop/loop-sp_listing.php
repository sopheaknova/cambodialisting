<?php
	
	$post_meta_keys = get_post_meta( get_the_ID() ); //get all meta post values 
	
	echo sp_listing_detail( $post_meta_keys, 'sp-medium'); 
?>
    
