<?php

	$share_html = boldthemes_get_share_html( get_permalink(), 'pf', 'xsmall' );

	$dash = BoldThemesFrameworkTemplate::$pf_use_dash ? 'gray' : '';
	
	echo '<article class="btPostSingleItemStandard btPostListStandard gutter ' . esc_attr( implode( ' ', get_post_class( BoldThemesFrameworkTemplate::$class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="btArticleContentHolder">';
		
								
				if ( BoldThemesFrameworkTemplate::$media_html != '' ) {
					echo '<div class="btArticleMedia">';
					echo ' ' . BoldThemesFrameworkTemplate::$media_html;
					echo '</div><!-- /btArticleMedia -->';
				}
				

				echo '<div class="btArticleHeadline">';
				echo wp_kses_post( boldthemes_get_heading_html(
					array(
						'superheadline' => BoldThemesFrameworkTemplate::$categories_html,
						'headline' 		=> get_the_title(),
						'subheadline' 	=> '',
						'url' 			=> get_permalink(),
						'size' 			=> 'normal',
						'html_tag' 		=> 'h2',
						'dash' 			=> $dash,
						'el_style' 		=> '',
						'el_class' 		=> ''
					)									 
				) );
				echo '</div><!-- /btArticleHeadline -->';
				echo '<div class="btArticleContent">' . BoldThemesFrameworkTemplate::$content_final_html . '</div>';
					
				echo '<div class="btArticleShareEtc">';
				
					if ( $share_html != '' ) echo '<div class="btShareColumn">' . wp_kses_post( $share_html ) . '</div><!-- /Share -->';
					
					echo '<div class="btReadMoreColumn">';
						echo wp_kses_post( boldthemes_get_button_html( 
							array ( 
								'url' 	=> get_permalink(),
								'text' 	=> esc_html__( 'READ MORE', 'goldenblatt' ),
								'style' => 'clean',
								'size' 	=> 'small'
							) 
						) );
					echo '</div><!-- /ReadMores -->';
					
				echo '</div><!-- /btArticleShareEtc -->';
				
			echo '</div><!-- /btContent -->' ;
		echo '</div><!-- /port -->';	
	echo '</article>';

?>