<?php

class bt_bb_column_inner extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'width'    		   			=> '',
			'align'   		   			=> 'left',
			'vertical_align'   			=> 'top',
			'animation'		   			=> '',
			'padding'          			=> 'normal',
			
			'icon'						=> '',
			'icon_color_scheme'  		=> '',

			'top_border'				=> '',
			'bottom_border'				=> '',
			'left_border'				=> '',
			'right_border'				=> '',
			'border_color'          	=> '',
			
			'background_image'      	=> '',
			'lazy_load'  				=> 'no',
			'inner_background_image'    => '',
			'background_color' 			=> '',
			'inner_background_color' 	=> '',
			'opacity'	       			=> '',
			'color_scheme'  			=> '',
			'inner_color_scheme'  		=> ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = 'id="' . esc_attr( $el_id ) . '"';
		}

		if ( $icon != '' ) {
			$class[] = "btWithIcon";
		}

		$array = explode( '/', $width );

		if ( empty( $array ) || $array[0] == 0 || $array[1] == 0 ) {
			$width = 12;
		} else {
			$top = $array[0];
			$bottom = $array[1];
			
			$width = 12 * $top / $bottom;
			
			if ( ! is_int( $width ) || $width < 1 || $width > 12 ) {
				$width = 12;
			}
		}

		if ( $width == 2 ) {
			$class[] = 'col-md-2 col-sm-4 col-ms-12';
		} else if ( $width == 3 ) {
			$class[] = 'col-md-3 col-sm-6 col-ms-12';
		} else if ( $width == 4 ) {
			$class[] = 'col-md-4 col-ms-12';
		} else if ( $width == 6 ) {
			$class[] = 'col-md-6 col-sm-12';
		} else if ( $width == 8 ) {
			$class[] = 'col-md-8 col-ms-12';
		} else {
			$class[] = 'col-md-' . $width . ' ' . 'col-ms-12';
		}
		
		if ( $align != '' ) {
			$class[] = $this->prefix . 'align' . '_' . $align;
		}
		
		if ( $vertical_align != '' ) {
			$class[] = $this->prefix . 'vertical_align' . '_' . $vertical_align;
		}
		
		if ( $animation != 'no_animation' && $animation != '' ) {
			$class[] = $this->prefix . 'animation' . '_' . $animation;
			$class[] = 'animate';
		}

		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}

		if ( $inner_color_scheme != '' ) {
			$class[] = $this->prefix . 'inner_color_scheme_' . bt_bb_get_color_scheme_id( $inner_color_scheme );
		}

		if ( $icon_color_scheme != '' ) {
			$class[] = $this->prefix . 'icon_color_scheme_' . bt_bb_get_color_scheme_id( $icon_color_scheme );
		}

		if ( $padding != '' ) {
			$class[] = $this->prefix . 'padding' . '_' . $padding;
		}

		if ( $top_border != '' ) {
			$class[] = "bt_bb_top_border";
		}

		if ( $border_color != '' ) {
			$class[] = $this->prefix . 'border_color' . '_' . $border_color;
		}

		if ( $bottom_border != '' ) {
			$class[] = "bt_bb_bottom_border";
		}

		if ( $left_border != '' ) {
			$class[] = "bt_bb_left_border";
		}

		if ( $right_border != '' ) {
			$class[] = "bt_bb_right_border";
		}
		
		if ( $background_color != '' ) {
			$background_color = bt_bb_column::hex2rgb( $background_color );
			if ( $opacity == '' ) {
				$opacity = 1;
			}
			$el_style .= 'background-color: rgba(' . $background_color[0] . ', ' . $background_color[1] . ', ' . $background_color[2] . ', ' . $opacity . ');';
		}

		$el_inner_style = '';
		
		if ( $inner_background_color != '' ) {
			$inner_background_color = bt_bb_column::hex2rgb( $inner_background_color );
			if ( $opacity == '' ) {
				$opacity = 1;
			}
			$el_inner_style .= '"background-color: rgba(' . $inner_background_color[0] . ', ' . $inner_background_color[1] . ', ' . $inner_background_color[2] . ', ' . $opacity . ');" ';
		}
		
		$inner_class = array( $this->shortcode . '_content' );
		$background_data_attr = '';
		$inner_background_data_attr = '';
		
		if ( $background_image != '' ) {
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
			$background_image_url = $background_image[0];
			if ( $lazy_load == 'yes' ) {
				$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
				$el_style .= 'background-image:url(\'' . $blank_image_src . '\');';
				$background_data_attr .= ' data-background_image_src=\'' . $background_image_url . '\'';
				$class[] = 'btLazyLoadBackground';
			} else {
				$el_style .= 'background-image:url(\'' . $background_image_url . '\');';
			}
			$class[] = 'bt_bb_column_inner_background_image';
		}
		
		if ( $inner_background_image != '' ) {
			$inner_background_image = wp_get_attachment_image_src( $inner_background_image, 'full' );
			$inner_background_image_url = $inner_background_image[0];
			if ( $lazy_load == 'yes' ) {
				$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
				$el_inner_style .= 'background-image:url(\'' . $blank_image_src . '\');';
				$inner_background_data_attr .= ' data-background_image_src="' . esc_attr( $inner_background_image_url ) . '"';
				$inner_class[] = 'btLazyLoadBackground';
			} else {
				$el_inner_style .= 'background-image:url(\'' . $inner_background_image_url . '\');';
			}
			$class[] = 'bt_bb_column_inner_inner_background_image';
		}
		
		if ( $el_inner_style != "" ) $el_inner_style = ' style=' . $el_inner_style;
		
		$style_attr = '';

		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$icon_html = bt_bb_icon::get_html( $icon, '' );	
	
		$output = '<div ' . $id_attr . ' class="' . implode( ' ', $class ) . '" ' . $style_attr . $background_data_attr . ' data-width="' . esc_attr( $width ) . '">';
			
			// ICON
				if ( $icon != '' ) $output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . $icon_html . '</div>';
			$output .= '<div class="' . implode( ' ', $inner_class ) . '"' . $el_inner_style . $inner_background_data_attr . '>';
				$output .= do_shortcode( $content );
			$output .= '</div>';

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
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Inner Column', 'goldenblatt' ), 'description' => esc_html__( 'Inner Column element', 'goldenblatt' ), 'width_param' => 'width', 'container' => 'vertical', 
			'accept' => array( 'bt_bb_section' => false, 'bt_bb_row' => false, 'bt_bb_row_inner' => false, 'bt_bb_column' => false, 'bt_bb_column_inner' => false, 'bt_bb_tab_item' => false, 'bt_bb_accordion_item' => false, 'bt_bb_cost_calculator_item' => false, 'bt_cc_group' => false, 'bt_cc_multiply' => false, 'bt_cc_item' => false, 'bt_bb_content_slider_item' => false, 'bt_bb_google_maps_location' => false, '_content' => false ),
			'accept_all' => true, 'toggle' => true, 'show_settings_on_create' => false, 'icon' => 'bt_bb_icon_bt_bb_row_inner',
			'params' => array(
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Align', 'goldenblatt' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Left', 'goldenblatt' ) 		=> 'left',
						esc_html__( 'Right', 'goldenblatt' ) 		=> 'right',
						esc_html__( 'Center', 'goldenblatt' ) 		=> 'center'
					) 
				),
				array( 'param_name' => 'padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Padding', 'goldenblatt' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Normal', 'goldenblatt' ) 		=> 'normal',
						esc_html__( 'Double', 'goldenblatt' ) 		=> 'double',
						esc_html__( 'Text Indent', 'goldenblatt' ) 	=> 'text_indent',
						esc_html__( '0px', 'goldenblatt' ) 			=> '0',
						esc_html__( '5px', 'goldenblatt' ) 			=> '5',
						esc_html__( '10px', 'goldenblatt' ) 		=> '10',
						esc_html__( '15px', 'goldenblatt' ) 		=> '15',
						esc_html__( '20px', 'goldenblatt' ) 		=> '20',
						esc_html__( '25px', 'goldenblatt' ) 		=> '25',
						esc_html__( '30px', 'goldenblatt' ) 		=> '30',
						esc_html__( '35px', 'goldenblatt' ) 		=> '35',
						esc_html__( '40px', 'goldenblatt' ) 		=> '40',
						esc_html__( '45px', 'goldenblatt' ) 		=> '45',
						esc_html__( '50px', 'goldenblatt' ) 		=> '50',
						esc_html__( '60px', 'goldenblatt' ) 		=> '60',
						esc_html__( '70px', 'goldenblatt' ) 		=> '70',
						esc_html__( '80px', 'goldenblatt' ) 		=> '80',
						esc_html__( '90px', 'goldenblatt' ) 		=> '90',
						esc_html__( '100px', 'goldenblatt' ) 		=> '100',
						esc_html__( '110px', 'goldenblatt' ) 		=> '110',
						esc_html__( '120px', 'goldenblatt' ) 		=> '120',
						esc_html__( '130px', 'goldenblatt' ) 		=> '130',
						esc_html__( '140px', 'goldenblatt' ) 		=> '140',
						esc_html__( '150px', 'goldenblatt' ) 		=> '150'
					) 
				),				
				array( 'param_name' => 'vertical_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical Align', 'goldenblatt' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Top', 'goldenblatt' )     		=> 'top',
						esc_html__( 'Middle', 'goldenblatt' )  		=> 'middle',
						esc_html__( 'Bottom', 'goldenblatt' )  		=> 'bottom'
					) 
				),
				array( 'param_name' => 'animation', 'type' => 'dropdown', 'heading' => esc_html__( 'Animation', 'goldenblatt' ), 'preview' => true,
					'value' => array(
						esc_html__( 'No Animation', 'goldenblatt' ) 			=> 'no_animation',
						esc_html__( 'Fade In', 'goldenblatt' ) 					=> 'fade_in',
						esc_html__( 'Move Up', 'goldenblatt' ) 					=> 'move_up',
						esc_html__( 'Move Left', 'goldenblatt' ) 				=> 'move_left',
						esc_html__( 'Move Right', 'goldenblatt' ) 				=> 'move_right',
						esc_html__( 'Move Down', 'goldenblatt' ) 				=> 'move_down',
						esc_html__( 'Zoom in', 'goldenblatt' ) 					=> 'zoom_in',
						esc_html__( 'Zoom out', 'goldenblatt' ) 				=> 'zoom_out',
						esc_html__( 'Fade In / Move Up', 'goldenblatt' ) 		=> 'fade_in move_up',
						esc_html__( 'Fade In / Move Left', 'goldenblatt' ) 		=> 'fade_in move_left',
						esc_html__( 'Fade In / Move Right', 'goldenblatt' ) 	=> 'fade_in move_right',
						esc_html__( 'Fade In / Move Down', 'goldenblatt' ) 		=> 'fade_in move_down',
						esc_html__( 'Fade In / Zoom in', 'goldenblatt' ) 		=> 'fade_in zoom_in',
						esc_html__( 'Fade In / Zoom out', 'goldenblatt' ) 		=> 'fade_in zoom_out'
					)
				),

				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'goldenblatt' ), 'group' => esc_html__( 'Icon', 'goldenblatt' ), 'value' => $icon_arr, 'preview' => true ),
				array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Color scheme', 'goldenblatt' ), 'group' => esc_html__( 'Icon', 'goldenblatt' ), 'value' => $color_scheme_arr ),

				array( 'param_name' => 'top_border', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'goldenblatt' ) => 'top_border' ), 'group' => esc_html__( 'Borders', 'goldenblatt' ), 'heading' => esc_html__( 'Top Border', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'bottom_border', 'type' => 'checkbox', 'group' => esc_html__( 'Borders', 'goldenblatt' ), 'value' => array( esc_html__( 'Yes', 'goldenblatt' ) => 'bottom_border' ), 'heading' => esc_html__( 'Bottom Border', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'left_border', 'type' => 'checkbox', 'group' => esc_html__( 'Borders', 'goldenblatt' ), 'value' => array( esc_html__( 'Yes', 'goldenblatt' ) => 'left_border' ), 'heading' => esc_html__( 'Left Border', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'right_border', 'type' => 'checkbox', 'group' => esc_html__( 'Borders', 'goldenblatt' ), 'value' => array( esc_html__( 'Yes', 'goldenblatt' ) => 'right_border' ), 'heading' => esc_html__( 'Right Border', 'goldenblatt' ), 'preview' => true ),
				array( 'param_name' => 'border_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Border color', 'goldenblatt' ), 'group' => esc_html__( 'Borders', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'Light', 'goldenblatt' ) 		=> '',
						esc_html__( 'Dark', 'goldenblatt' ) 		=> 'dark',
						esc_html__( 'Accent', 'goldenblatt' ) 		=> 'accent'
					)
				),
				
				array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'inner_background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Inner background image', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load background image', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ),
					'value' => array(
						esc_html__( 'No', 'goldenblatt' ) 		=> 'no',
						esc_html__( 'Yes', 'goldenblatt' ) 		=> 'yes'
					)
				),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'inner_background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Inner background color', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'opacity', 'type' => 'textfield', 'heading' => esc_html__( 'Opacity (0 - 1, e.g. 0.4)', 'goldenblatt' ), 'group' => esc_html__( 'Design', 'goldenblatt' ) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'goldenblatt' ), 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' ), 'weight' => 0, 'value' => $color_scheme_arr ),
				array( 'param_name' => 'inner_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Inner Color scheme', 'goldenblatt' ), 'preview' => true, 'group' => esc_html__( 'Design', 'goldenblatt' ), 'weight' => 1, 'value' => $color_scheme_arr )
			)
		) );
	}
}