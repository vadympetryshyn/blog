<?php

/*
 * functions that are directly available in WordPress themes (and plugins)
 */

/**
 * return ad content
 *
 * @since 1.0.0
 * @param int $id id of the ad (post)
 * @param arr $args additional arguments
 */
function get_ad($id = 0, $args = array()){
	if ( defined( 'ADVANCED_ADS_DISABLE_CHANGE' ) && ADVANCED_ADS_DISABLE_CHANGE ) {
		$args = array();
	}

	return Advanced_Ads_Select::get_instance()->get_ad_by_method( $id, 'id', $args );
}

/**
 * echo an ad
 *
 * @since 1.0.0
 * @param int $id id of the ad (post)
 * @param arr $args additional arguments
 */
function the_ad($id = 0, $args = array()){
	echo get_ad( $id, $args );
}

/**
 * return an ad from an ad group based on ad weight
 *
 * @since 1.0.0
 * @param int $id id of the ad group (taxonomy)
 *
 */
function get_ad_group( $id = 0, $args = array() ) {
	if ( defined( 'ADVANCED_ADS_DISABLE_CHANGE' ) && ADVANCED_ADS_DISABLE_CHANGE ) {
		$args = array();
	}
	return Advanced_Ads_Select::get_instance()->get_ad_by_method( $id, 'group', $args );
}

/**
 * echo an ad from an ad group
 *
 * @since 1.0.0
 * @param int $id id of the ad (post)
 */
function the_ad_group($id = 0){
	echo get_ad_group( $id );
}

/**
 * return content of an ad placement
 *
 * @since 1.1.0
 * @param string $id slug of the ad placement
 *
 */
function get_ad_placement( $id = '', $args = array() ) {
	if ( defined( 'ADVANCED_ADS_DISABLE_CHANGE' ) && ADVANCED_ADS_DISABLE_CHANGE ) {
		$args = array();
	}
	return Advanced_Ads_Select::get_instance()->get_ad_by_method( $id, 'placement', $args );
}

/**
 * return content of an ad placement
 *
 * @since 1.1.0
 * @param string $id slug of the ad placement
 */
function the_ad_placement($id = ''){
	echo get_ad_placement( $id );
}

/**
 * return true if ads can be displayed
 *
 * @since 1.4.9
 * @return bool, true if ads can be displayed
 */
function advads_can_display_ads(){
    return Advanced_Ads::get_instance()->can_display_ads();
}

/**
 * Are we currently on an AMP URL?
 * Will always return `false` and show PHP Notice if called before the `parse_query` hook.
 *
 * @return bool true if amp url, false otherwise
 */
function advads_is_amp() {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return false;
	}

	if ( ! did_action( 'wp' ) ) {
		Advanced_Ads::log( sprintf( esc_html( '%1$s was called before the %2$s action. %3$s' ),
			'advads_is_amp()', 'wp', wp_debug_backtrace_summary() )
		);
		return false;
	}

	return ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() )
	|| ( function_exists( 'is_wp_amp' ) && is_wp_amp() )
	|| ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() )
	|| isset( $_GET [ 'wpamp' ] );
}

/**
 * Test if a placement has ads.
 *
 * @return bool
 */
function placement_has_ads( $id = '' ) {
	$args = array(
		'global_output' => false,
		'cache-busting' => 'ignore',
	);
	return Advanced_Ads_Select::get_instance()->get_ad_by_method( $id, 'placement', $args ) != '';

}

/**
 * Test if a group has ads.
 *
 * @return bool
 */
function group_has_ads( $id = '' ) {
	$args = array(
		'global_output' => false,
		'cache-busting' => 'ignore',
	);
	return Advanced_Ads_Select::get_instance()->get_ad_by_method( $id, 'group', $args ) != '';
}
