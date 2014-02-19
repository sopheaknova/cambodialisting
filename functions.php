<?php 

/* ---------------------------------------------------------------------- */
/*	Basic Theme Settings
/* ---------------------------------------------------------------------- */
$shortname = get_template();

	//WP 3.4+ only
	$themeData     = wp_get_theme( $shortname );
	$themeName     = $themeData->Name;
	$themeVersion  = $themeData->Version;
	$pageTemplates = wp_get_theme()->get_page_templates();

	if( ! $themeVersion )
		$themeVersion = '';

	$shortname = str_replace( '-v' . $themeVersion, '', $shortname );

	//Basic constants	
	define( 'SP_THEME_NAME',      $themeName );
	define( 'SP_THEME_SHORTNAME', $shortname );
	define( 'SP_THEME_VERSION',   $themeVersion );	
	define( 'SP_SCRIPTS_VERSION', 20130605 );
	define( 'SP_ADMIN_LIST_THUMB', '64x64' ); //thumbnail size (width x height) on post/page/custom post listings
	
	define( 'SP_BASE_DIR',   get_template_directory() . '/' );
	define( 'SP_BASE_URL',     get_template_directory_uri() . '/' );
	define( 'SP_ASSETS_THEME', get_template_directory_uri() . '/assets/' );
	define( 'SP_ASSETS_ADMIN', get_template_directory_uri() . '/library/assets/' );


	//Custom post WordPress admin menu position - 30, 33, 39, 42, 45, 48
	if ( ! isset( $cpMenuPosition ) )
		$cpMenuPosition = array(
				'listing'		=> 30
			);
			
	//Social network link 
	if ( ! isset( $commLine ) )
		$commLine = array(
				'tel'		=> 'Telephone',
				'mobile'		=> 'Mobile',
				'e-mail'		=> 'E-mail',
				'fax'		=> 'Fax',
				'website'		=> 'Website',
				'swift'		=> 'Swift',
				'pobox'		=> 'P.O. Box',
			);						


//Theme settings
require_once( SP_BASE_DIR . 'library/functions/setup-theme.php' );
require_once( SP_BASE_DIR . 'library/functions/theme-functions.php' );
//Theme Admin
require_once( SP_BASE_DIR . 'library/functions/admin-functions.php' );

