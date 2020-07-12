<?php
defined( 'ABSPATH' ) || exit; //prevent direct file access

class WCSE_Emirates implements WCSE_Country {
	/**
	 * United Arab Emirates city list
	 *
	 * @return array|bool|mixed
	 */
	public function states() {
		$cities = array(
			'Abu Dhabi'      => esc_html__( 'Abu Dhabi', 'wcse' ),
			'Ajman'          => esc_html__( 'Ajman', 'wcse' ),
			'Al Ain'         => esc_html__( 'Al Ain', 'wcse' ),
			'Dubai'          => esc_html__( 'Dubai', 'wcse' ),
			'Fujairah'       => esc_html__( 'Fujairah', 'wcse' ),
			'Rak'            => esc_html__( 'Rak', 'wcse' ),
			'Sharjah'        => esc_html__( 'Sharjah', 'wcse' ),
			'Umm al-Quwain'  => esc_html__( 'Umm al-Quwain', 'wcse' ),
			'Western Region' => esc_html__( 'Western Region', 'wcse' )
		);

		return apply_filters( 'wcse_emirates_cities', $cities );
	}
}