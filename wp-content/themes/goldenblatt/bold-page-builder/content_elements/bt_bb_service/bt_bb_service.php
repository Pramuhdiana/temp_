<?php

class bt_bb_service extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'icon'					=> '',
			'title'					=> '',
			'text'					=> '',
			'arrow'					=> '',
			'url'           		=> '',
			'target'        		=> '',
			'color_scheme'  		=> '',
			'title_color_scheme'  	=> '',
			'title_font_weight'  	=> '',
			'style'         		=> '',
			'size'          		=> '',
			'shape'         		=> '',
			'align'         		=> ''
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

		if ( $title_color_scheme != '' ) {
			$class[] = $this->prefix . 'title_color_scheme_' . bt_bb_get_color_scheme_id( $title_color_scheme );
		}

		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}

		if ( $title_font_weight != '' ) {
			$class[] = $this->prefix . 'font_weight' . '_' . $title_font_weight;
		}

		if ( $size != '' ) {
			$class[] = $this->prefix . 'size' . '_' . $size;
		}

		if ( $arrow != '' ) {
			$class[] = $this->prefix . 'arrow' . '_' . $arrow;
		}

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}
		
		if ( $align != '' ) {
			$class[] = $this->prefix . 'align' . '_' . $align;
		}
		
		$link = bt_bb_get_url( $url );

		$icon_title = wp_strip_all_tags($title);
		
		$icon = bt_bb_icon::get_html( $icon, '', $link, $icon_title, $target );

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = $icon;

		
		if ( $link != '' ) {
			$output .= '<div class="' . esc_attr( $this->shortcode ) . '_content"><a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">';
				if ( $title != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_title">' . $title . '</div>';
				if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_text">' . nl2br( $text ) . '</div>';
				if ( $arrow != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_arrow"></div>';
			$output .= '</a></div>';
		} else {
			$output .= '<div class="' . esc_attr( $this->shortcode ) . '_content">';
				if ( $title != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_title">' . $title . '</div>';
				if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_text">' . nl2br( $text ) . '</div>';
				if ( $arrow != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_arrow"></div>';
			$output .= '</div>';
		}


		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . $output . '</div>';
		
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

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Service', 'goldenblatt' ), 'description' => esc_html__( 'Icon with text', 'goldenblatt' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'goldenblatt' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'goldenblatt' ) ),
				array( 'param_name' => 'arrow', 'type' => 'dropdown', 'heading' => esc_html__( 'Show Arrow', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'No', 'goldenblatt' ) 		=> '',
						esc_html__( 'Yes', 'goldenblatt' ) 		=> 'visible',
					)
				),
				array( 'param_name' => 'url', 'type' => 'textfield', 'heading' => esc_html__( 'URL', 'goldenblatt' ), 'description' => esc_html__( 'Enter full or local URL (eg. https://www.bold-themes.com or /pages/about-us) or post slug (eg. about-us)', 'goldenblatt' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'goldenblatt' ) 	=> '_self',
						esc_html__( 'Blank (open in new tab)', 'goldenblatt' ) 	=> '_blank',
					)
				),
				



				array( 'param_name' => 'size', 'type' => 'dropdown', 'default' => 'normal', 'heading' => esc_html__( 'Icon size', 'goldenblatt' ), 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Extra small', 'goldenblatt' ) 	=> 'xsmall',
						esc_html__( 'Small', 'goldenblatt' ) 		=> 'small',
						esc_html__( 'Normal', 'goldenblatt' ) 		=> 'normal',
						esc_html__( 'Large', 'goldenblatt' ) 		=> 'large',
						esc_html__( 'Extra large', 'goldenblatt' ) 	=> 'xlarge'
					)
				),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon style', 'goldenblatt' ), 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Outline', 'goldenblatt' ) 		=> 'outline',
						esc_html__( 'Filled', 'goldenblatt' ) 		=> 'filled',
						esc_html__( 'Borderless', 'goldenblatt' ) 	=> 'borderless'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon color scheme', 'goldenblatt' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon alignment', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Inherit', 'goldenblatt' ) 	=> 'inherit',
						esc_html__( 'Left', 'goldenblatt' )		=> 'left',
						esc_html__( 'Right', 'goldenblatt' ) 	=> 'right'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'default' => 'square', 'heading' => esc_html__( 'Icon shape', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Circle', 'goldenblatt' ) 			=> 'circle',
						esc_html__( 'Square', 'goldenblatt' ) 			=> 'square',
						esc_html__( 'Rounded Square', 'goldenblatt' ) 	=> 'round'
					)
				),

				array( 'param_name' => 'title_font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Title font weight', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Default', 'goldenblatt' ) 		=> '',
						esc_html__( 'Thin', 'goldenblatt' ) 		=> 'thin',
						esc_html__( 'Lighter', 'goldenblatt' ) 		=> 'lighter',
						esc_html__( 'Light', 'goldenblatt' ) 		=> 'light',
						esc_html__( 'Normal', 'goldenblatt' ) 		=> 'normal',
						esc_html__( 'Medium', 'goldenblatt' ) 		=> 'medium',
						esc_html__( 'Semi bold', 'goldenblatt' ) 	=> 'semi-bold',
						esc_html__( 'Bold', 'goldenblatt' ) 		=> 'bold',
						esc_html__( 'Bolder', 'goldenblatt' ) 		=> 'bolder',
						esc_html__( 'Black', 'goldenblatt' ) 		=> 'black'
					)
				),
				array( 'param_name' => 'title_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Title color scheme', 'goldenblatt' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' )
				)
			)
		) );
	}
}