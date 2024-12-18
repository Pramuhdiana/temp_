<?php

class bt_bb_price_list extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'icon'			=> '',
			'title'			=> '',
			'currency'		=> '',
			'price'			=> '',
			'text'			=> '',
			'color_scheme'	=> ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );

		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}

		$icon_html = bt_bb_icon::get_html( $icon, '' );
		
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';
			// ICON
			if ( $icon != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . $icon_html . '</div>';

			// TITLE
			if ( $title != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_title">' . $title . '</div>';
			
			// PRICE
			$output .= '<div class="' . esc_attr( $this->shortcode ) . '_price">';
				if ( $currency != '' ) $output .= '<span class="' . esc_attr( $this->shortcode ) . '_currency">' . $currency . '</span>';
				if ( $price != '' ) $output .= '<span class="' . esc_attr( $this->shortcode ) . '_amount">' . $price . '</span>';
			$output .= '</div>';
			
			// TEXT
			if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_text">' . $text . '</div>';

		$output .= '</div>';

		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		if ( function_exists('boldthemes_get_icon_fonts_bb_array') ) {
			$icon_arr = boldthemes_get_icon_fonts_bb_array();
		} else {
			require_once( dirname(__FILE__) . '/../../content_elements_misc/fa_icons.php' );
			require_once( dirname(__FILE__) . '/../../content_elements_misc/s7_icons.php' );
			$icon_arr = array( 'Font Awesome' => bt_bb_fa_icons(), 'S7' => bt_bb_s7_icons() );
		}
		
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Price List', 'goldenblatt' ), 'description' => esc_html__( 'List of items with total price', 'goldenblatt' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'goldenblatt' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'currency', 'type' => 'textfield', 'heading' => esc_html__( 'Currency', 'goldenblatt' ) ),
				array( 'param_name' => 'price', 'type' => 'textfield', 'heading' => esc_html__( 'Price', 'goldenblatt' ) ),				
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'goldenblatt' ) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'goldenblatt' ), 'value' => $color_scheme_arr, 'preview' => true ),			
			)
		) );
	}
}