<?php

function layers_pro_apply_control_button_styling( $prefix, $selectors ) {

	$css = array();

	// Prep: Background.
	if ( 'transparent' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Transparent Background.
		 */

		$css['background']   = 'transparent';
	}
	else if ( 'gradient' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Gradient Background.
		 */

		if (
			'' != layers_get_theme_mod( "{$prefix}-background-gradient-start-color", FALSE ) &&
			'' != layers_get_theme_mod( "{$prefix}-background-gradient-end-color", FALSE )
			) {

			$gradient_start_color = layers_get_theme_mod( "{$prefix}-background-gradient-start-color", FALSE );
			$gradient_end_color   = layers_get_theme_mod( "{$prefix}-background-gradient-end-color", FALSE );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( '' != layers_get_theme_mod( "{$prefix}-background-gradient-direction", FALSE ) ) ? layers_get_theme_mod( "{$prefix}-background-gradient-direction", FALSE ) . 'deg, ' : '';
			$css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Solid Background.
		 */

		if ( '' != layers_get_theme_mod( "{$prefix}-background-color", FALSE ) ) {

			$css['background'] = layers_get_theme_mod( "{$prefix}-background-color", FALSE );
		}
	}

	// Prep: Text Color.
	if ( layers_get_theme_mod( "{$prefix}-text-color", FALSE ) ) {
		$css['color'] = layers_get_theme_mod( "{$prefix}-text-color");
	}

	// Prep: Text Shadow.
	if ( layers_get_theme_mod( "{$prefix}-text-shadow", FALSE ) ) {
		if ( 'top' == layers_get_theme_mod( "{$prefix}-text-shadow") ) $css['text-shadow'] = '0 -1px rgba(0,0,0,0.3)';
		if ( 'bottom' == layers_get_theme_mod( "{$prefix}-text-shadow") ) $css['text-shadow'] = '0 1px rgba(0,0,0,0.3)';
	}

	// Prep: Text Transform.
	if ( layers_get_theme_mod( "{$prefix}-text-transform" ) ) {
		$css['text-transform'] = layers_get_theme_mod( "{$prefix}-text-transform" );
	}

	// Prep: Shadow.
	if ( layers_get_theme_mod( "{$prefix}-shadow", FALSE ) ) {
		if ( 'small' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}

	// Prep: Border Width.
	if ( '' != layers_get_theme_mod( "{$prefix}-border-width", FALSE ) ) {
		$css['border-width'] = layers_get_theme_mod( "{$prefix}-border-width") . 'px';
	}

	// Prep: Border Color.
	if ( '' !== layers_get_theme_mod( "{$prefix}-border-color") ) {
		$css['border-color'] = layers_get_theme_mod( "{$prefix}-border-color", FALSE );
	}

	// Prep: Border Radius.
	if ( '' !== layers_get_theme_mod( "{$prefix}-border-radius" ) && 0 !== layers_get_theme_mod( "{$prefix}-border-radius") ) {
		$css['border-radius'] = layers_get_theme_mod( "{$prefix}-border-radius") . 'px';
	}

	/**
	 * Apply Button Styling
	 */
	layers_pro_apply_button_styling( $selectors, $css, TRUE );
}

function layers_pro_apply_widget_button_styling( $widget, $item, $selectors ) {

	// Make sure the 'buttons' values are at the root of the item instance, not nested deeper in 'design' - so it is one size fits all.
	if ( isset( $item['design'] ) ) {
		foreach ( $item['design'] as $key => $value ) {
			if ( -1 < strpos( $key, 'buttons-' ) && isset( $item['design'] ) ) {
				$item = $item['design'];
			}
		}
	}
	
	/*
	 * Button Main Styling.
	 */
	
	$css = array();

	// Prep: Background.
	if ( 'transparent' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		// Transparent Background.
		$css['background']       = 'transparent';
	}
	else if ( 'gradient' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		if (
				NULL != $widget->check_and_return( $item, 'buttons-background-gradient-start-color' ) &&
				NULL != $widget->check_and_return( $item, 'buttons-background-gradient-end-color' )
			) {

			// Gradient Background.
			$gradient_start_color = $widget->check_and_return( $item, 'buttons-background-gradient-start-color' );
			$gradient_end_color   = $widget->check_and_return( $item, 'buttons-background-gradient-end-color' );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( NULL != $widget->check_and_return( $item, 'buttons-background-gradient-direction' ) ) ? $widget->check_and_return( $item, 'buttons-background-gradient-direction' ) . 'deg, ' : '';
			$css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		// Solid Background.
		if ( NULL != $widget->check_and_return( $item, 'buttons-background-color' ) ) {
			$css['background'] = $widget->check_and_return( $item, 'buttons-background-color' );
		}
	}

	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-color' ) ) {
		$css['color'] = $widget->check_and_return( $item, 'buttons-text-color');
	}
	
	// Prep: Text Transform.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-transform' ) ) {
		$css['text-transform'] = $widget->check_and_return( $item, 'buttons-text-transform' );
	}

	// Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'width' ) ) {
		
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-style', 'width' ) . 'px';
		
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'style' ) ) {
			$css['border-style'] = $widget->check_and_return( $item, 'buttons-border-style', 'style' );
		}
		else {
			$css['border-style'] = 'solid';
		}
		
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'radius' ) ) {
		$css['border-radius'] = $widget->check_and_return( $item, 'buttons-border-style', 'radius' ) . 'px';
	}
	
	// Prep: Border Width - Individual Borders.
	if (
			isset( $css['border-width'] ) &&
			(
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'top' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'right' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'bottom' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'left' )
			)
		) {
		
		// Save the border width, then unset it.
		$border_width = $css['border-width'];
		unset( $css['border-width'] );
		
		// Set the individual border widths.
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'top' ) ) {
			$css['border-top-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'right' ) ) {
			$css['border-right-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'bottom' ) ) {
			$css['border-bottom-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'left' ) ) {
			$css['border-left-width'] = $border_width;
		}
	}
	
	// Prep: Border Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-color') ) {
		$css['border-color'] = $widget->check_and_return( $item, 'buttons-border-color');
	}
	
	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-color' ) ) {
		$css['color'] = $widget->check_and_return( $item, 'buttons-text-color');
	}
	
	// Prep: Font Size.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'font-size' ) ) {
		$font_size = ( $widget->check_and_return( $item, 'buttons-text-size', 'font-size' ) ) / 10;
		$css['font-size'] = $font_size . 'rem';
	}
	
	// Prep: Line Height.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'line-height' ) ) {
		$css['line-height'] = $widget->check_and_return( $item, 'buttons-text-size', 'line-height' ) . 'px';
	}
	
	// Prep: Letter Spacing.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'letter-spacing' ) ) {
		$css['letter-spacing'] = $widget->check_and_return( $item, 'buttons-text-size', 'letter-spacing' ) . 'px';
	}
	
	// Prep: Font Weight.
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
		
		if ( 'light' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = '300';
		}
		elseif ( 'normal' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = 'normal';
		}
		elseif ( 'bold' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = '700';
		}
	}
	
	// Prep: Font Style.
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'italic' ) ) {
		$css['font-style'] = 'italic';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'underline' ) ) {
		$css['text-decoration'] = 'underline';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'strikethrough' ) ) {
		$css['text-decoration'] = 'line-through';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'uppercase' ) ) {
		$css['text-transform'] = 'uppercase';
	}
	
	// Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow-color' ) ) {
		
		$shadow_color = $widget->check_and_return( $item, 'buttons-shadow-color' );
		$shadow_x = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'x' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'x' ) . 'px' : '0px' ;
		$shadow_y = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'y' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'y' ) . 'px' : '1px' ;
		$shadow_blur = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'blur' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'blur' ) . 'px' : '3px' ;
		$shadow_spread = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'spread' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'spread' ) . 'px' : '' ;
		
		$css['box-shadow'] = "{$shadow_x} {$shadow_y} {$shadow_blur} {$shadow_spread} {$shadow_color}";
	}
	
	// (OLD) Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-width' ) ) {
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-width') . 'px';
	}
	
	// (OLD) Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-width' ) ) {
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-width') . 'px';
	}

	// (OLD) Prep: Border Radius.
	if ( $widget->check_and_return( $item, 'buttons-border-radius' ) && 0 !== $widget->check_and_return( $item, 'buttons-border-radius') ) {
		$css['border-radius'] = $widget->check_and_return( $item, 'buttons-border-radius') . 'px';
	}
	
	// (OLD) Prep: Text Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-shadow' ) ) {
		if ( 'top' == $widget->check_and_return( $item, 'buttons-text-shadow') ) $css['text-shadow'] = '0 -1px rgba(0,0,0,0.3)';
		if ( 'bottom' == $widget->check_and_return( $item, 'buttons-text-shadow') ) $css['text-shadow'] = '0 1px rgba(0,0,0,0.3)';
	}
	
	// (OLD) Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow' ) ) {
		if ( 'small' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}
	
	// (OLD) Prep: Text Transform.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-transform' ) ) {
		$css['text-transform'] = $widget->check_and_return( $item, 'buttons-text-transform' );
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-padding' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){

			if ( NULL != $widget->check_and_return( $item, 'buttons-padding', $trbl ) )
				$css[ 'padding-' . $trbl ] = $widget->check_and_return( $item, 'buttons-padding', $trbl ) . 'px';

		}
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-margin' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){
		
			if ( NULL != $widget->check_and_return( $item, 'buttons-margin', $trbl ) )
				$css[ 'margin-' . $trbl ] = $widget->check_and_return( $item, 'buttons-margin', $trbl ) . 'px';

		}
	}

	
	// (OLD) Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow' ) ) {
		if ( 'small' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}
	
	/*
	 * Button Hover Styling.
	 */
	
	$hover_css = array();

	// Prep: Background.
	if ( 'transparent' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		// Transparent Background.
		$hover_css['background']       = 'transparent';
	}
	else if ( 'gradient' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		if (
				NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-start-color' ) &&
				NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-end-color' )
			) {

			// Gradient Background.
			$gradient_start_color = $widget->check_and_return( $item, 'buttons-hover-background-gradient-start-color' );
			$gradient_end_color   = $widget->check_and_return( $item, 'buttons-hover-background-gradient-end-color' );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-direction' ) ) ? $widget->check_and_return( $item, 'buttons-hover-background-gradient-direction' ) . 'deg, ' : '';
			$hover_css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		// Solid Background.
		if ( NULL != $widget->check_and_return( $item, 'buttons-hover-background-color' ) ) {
			$hover_css['background'] = $widget->check_and_return( $item, 'buttons-hover-background-color' );
		}
	}
	
	// Prep: Button Border Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-border-color') ) {
		$hover_css['border-color'] = $widget->check_and_return( $item, 'buttons-hover-border-color');
	}
	
	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-text-color' ) ) {
		$hover_css['color'] = $widget->check_and_return( $item, 'buttons-hover-text-color');
	}
	
	// Prep: Font Weight.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
		
		if ( 'light' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = '300';
		}
		elseif ( 'normal' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = 'normal';
		}
		elseif ( 'bold' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = '700';
		}
	}
	
	// Prep: Font Style.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'italic' ) ) {
		$hover_css['font-style'] = 'italic';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'underline' ) ) {
		$hover_css['text-decoration'] = 'underline';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'strikethrough' ) ) {
		$hover_css['text-decoration'] = 'line-through';
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-padding' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){
		
			if ( NULL != $widget->check_and_return( $item, 'buttons-hover-padding', $trbl ) )
				$hover_css[ 'padding-' . $trbl ] = $widget->check_and_return( $item, 'buttons-hover-padding', $trbl ) . 'px';

		}
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-margin' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){

			if ( NULL != $widget->check_and_return( $item, 'buttons-hover-margin', $trbl ) )
				$hover_css[ 'margin-' . $trbl ] = $widget->check_and_return( $item, 'buttons-hover-margin', $trbl ) . 'px';

		}
	}

	
	// Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-color' ) ) {
		
		$shadow_color = $widget->check_and_return( $item, 'buttons-hover-shadow-color' );
		$shadow_x = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'x' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'x' ) . 'px' : '0px' ;
		$shadow_y = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'y' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'y' ) . 'px' : '1px' ;
		$shadow_blur = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'blur' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'blur' ) . 'px' : '3px' ;
		$shadow_spread = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'spread' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'spread' ) . 'px' : '' ;
		
		$hover_css['box-shadow'] = "{$shadow_x} {$shadow_y} {$shadow_blur} {$shadow_spread} {$shadow_color}";
	}
	
	/**
	 * Apply Button Styling
	 */
	return layers_pro_apply_button_styling( $selectors, $css, $hover_css );
}

function layers_pro_apply_button_styling( $selectors, $css, $hover_css = FALSE ) {

	$styles = '';

	/**
	 * Apply Main Styles
	 */

	$styles .= layers_inline_styles( implode( ', ', $selectors ), array( 'css' => $css ) );

	/**
	 * Apply Main Styles :before & :after.
	 */

	$before_and_after_css = array();
	if ( isset( $css['color'] ) ) $before_and_after_css['color'] = $css['color'];
	if ( isset( $css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $css['text-shadow'];
	$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );

	/**
	 * Apply Hover Styles
	 */
	
	if ( TRUE === $hover_css || is_array( $hover_css ) ) {
		
		if ( TRUE === $hover_css ) {
			
			/**
			 * Optionally create hover styles dynamically.
			 */
			
			$hover_css = array();

			// Background Color.
			if ( isset( $css['background'] ) ) {

				if ( 0 === strpos( $css['background'], '#' ) ) {

					// Background is a #hex color - so set background to a lighter shade of that color.
					// $hover_css['background'] = layers_too_light_then_dark( $css['background'] );
					$hover_css['background'] = layers_adjust_brightness( $css['background'], 35, true );
				}
			}

			// Text Color.
			if ( isset( $css['border-color'] ) ) {

				if (
						0 === strpos( $css['border-color'], '#' ) &&
						isset( $css['border-width'] ) && 0 !== ( (int) $css['border-width'] )
					) {
					// $hover_css['border-color'] = layers_too_light_then_dark( $css['border-color'] );
					$hover_css['border-color'] = layers_adjust_brightness( $css['border-color'], -55, true );
				}
			}

			// Text Color.
			if ( isset( $css['color'] ) && ! isset( $hover_css['color'] ) ) {
				/*
				// $hover_css['color'] = layers_too_light_then_dark( $css['color'] );
				$hover_css['color'] = layers_adjust_brightness( $css['color'], 35, true );
				*/
			}
		}
		
		/**
		 * Apply Hover Styles.
		 */
		$styles .= layers_inline_styles( implode( ':hover, ', $selectors ) . ':hover', array( 'css' => $hover_css ) );

		/**
		 * Apply Hover Styles :before & :after.
		 */
		$before_and_after_css = array();
		if ( isset( $hover_css['color'] ) ) $before_and_after_css['color'] = $hover_css['color'];
		if ( isset( $hover_css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $hover_css['text-shadow'];
		$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );
	}

	// Debugging:
	global $wp_customize;
	if ( $wp_customize && ( ( bool ) layers_get_theme_mod( 'dev-switch-button-css-testing' ) ) ) {

		echo '<pre style="font-size:11px;">';

		if ( 0 === strpos( $selectors[0], '#' ) )
			print_r( $selectors );
		else
			echo "GLOBAL\n";

		echo "button -----------------------\n";
		if ( empty( $css ) )
			echo '';
		else
			foreach ( $css as $key => $value )
				echo "$key: $value\n";

		echo "button:hover -----------------\n";
		if ( empty( $hover_css ) )
			echo '';
		else
			foreach ( $hover_css as $key => $value )
				echo "$key: $value\n";

		echo '</pre>';
	}

	return $styles;
}


function layers_pro_replace_customizer_css( $search, $replace ) {
	
	// Only do this if we getting a customizer partial.
	if ( isset( $_POST['partials'] ) ) {
		?>
		<script type="text/javascript">
			layers_replace_customizer_css( '<?php echo addslashes( $search ); ?>', '<?php echo rawurlencode( $replace ); ?>' );
		</script>
		<?php
	}
}

function layers_pro_get_controls( $prefix, $args = array() ) {
	
	/**
	 * Set defaults.
	 */
	
	$defaults = array(
		'options'          => array(),
		'type'             => 'controls',
		'accordion'        => FALSE,
		'hover'            => FALSE,
		'partial'          => FALSE,
		'background-image' => FALSE,
	);
	$args = wp_parse_args( $args, $defaults );
	
	/**
	 * Get Controls.
	 */
	
	$controls = array(); // Collect Controls.
	$settings = array(); // Collect Settings.
	
	foreach ( $args['options'] as $option ) {
		
		/**
		 * Background.
		 */
		
		if ( 'background' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-background-accordion-start"] = array(
					'label' => ( $args['background-image'] ? __( 'Background Color', 'layers-pro' ) : __( 'Background', 'layers-pro' ) ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
			
			$controls["{$prefix}-background-style"] = array(
				'type'  => 'layers-select',
				'label' => '',
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'solid' => __( 'Solid', 'layers-pro' ),
					'transparent' => __( 'Transparent', 'layers-pro' ),
					'gradient' => __( 'Gradient', 'layers-pro' ),
				),
				'default' => 'solid',
			);
			$controls["{$prefix}-background-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'solid',
				),
			);
			$controls["{$prefix}-background-gradient-start-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Start Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			$controls["{$prefix}-background-gradient-end-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'End Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			$controls["{$prefix}-background-gradient-direction"] = array(
				'type' => 'layers-number',
				'label' => __( 'Gradient Angle', 'layers-pro' ),
				'class' => 'group',
				'default' => 0,
				'min' => '0',
				'max' => '360',
				'step' => '1',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-background-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
			
			/**
			 * If background-image.
			 */
			
			if ( $args['background-image'] ) {
				
				if ( $args['accordion'] ) {
					$controls["{$prefix}-background-image-accordion-start"] = array(
						'label' => ( $args['background-image'] ? __( 'Background Image', 'layers-pro' ) : __( 'Background', 'layers-pro' ) ),
						'type' => 'layers-accordion-start',
						'class' => 'group',
					);
				}
				
				$controls["{$prefix}-background-image"] = array(
					'label' => __( 'Background Image', 'layers-pro' ),
					'type' => 'layers-select-images',
					'class' => 'group',
				);
				$controls["{$prefix}-background-repeat"] = array(
					'label' => __( 'Repeat', 'layers-pro' ),
					'type' => 'layers-select',
					'class' => 'group',
					'default' => 'no-repeat',
					'choices' => array(
						'no-repeat' => __( 'No Repeat', 'layers-pro' ),
						'repeat' => __( 'Repeat', 'layers-pro' ),
						'repeat-x' => __( 'Repeat Horizontal', 'layers-pro' ),
						'repeat-y' => __( 'Repeat Vertical', 'layers-pro' )
					),
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				$controls["{$prefix}-background-position"] = array(
					'label' => __( 'Position', 'layers-pro' ),
					'type' => 'layers-select',
					'class' => 'group',
					'default' => 'center',
					'choices' => array(
						'center' => __( 'Center', 'layers-pro' ),
						'top' => __( 'Top', 'layers-pro' ),
						'bottom' => __( 'Bottom', 'layers-pro' ),
						'left' => __( 'Left', 'layers-pro' ),
						'right' => __( 'Right', 'layers-pro' )
					),
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				$controls["{$prefix}-background-size"] = array(
					'type'   => 'layers-checkbox',
					'label'  => __( 'Stretch', 'layers-pro' ),
					'default' => TRUE,
					'class' => 'group',
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				
				if ( $args['accordion'] ) {
					$controls["{$prefix}-background-image-accordion-end"] = array(
						'type' => 'layers-accordion-end',
						'class' => 'group',
					);
				}
			}
		}
		
		
		/**
		 * Font.
		 */
		
		if ( 'font' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-font-accordion-start"] = array(
					'label' => __( 'Font Style', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group accordion-open-NOT',
				);
			}
				
			$controls["{$prefix}-font-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( ! $args['hover'] ) {
				
				$controls["{$prefix}-font-size"] = array(
					'type' => 'layers-inline-numbers-fields',
					'label' => '',
					'class' => 'group',
					'input_class' => 'inline-fields-flush',
					'fields' => array(
						'size' => 'Size',
						'line-height' => 'Line Height',
						'letter-spacing' => 'Spacing',
					),
				);
				
				$controls["{$prefix}-font-weight"] = array(
					'type' => 'layers-select-icons',
					// 'multi_select' => TRUE,
					'allow_inactive' => TRUE,
					'label' => '',
					'choices' => array(
						'light' => array(
							'name' => __( 'Light', 'layers-pro' ),
							'class' => 'icon-font-weight-light',
							'data' => '',
						),
						'normal' => array(
							'name' => __( 'Normal', 'layers-pro' ),
							'class' => 'icon-font-weight-normal',
							'data' => '',
						),
						'bold' => array(
							'name' => __( 'Bold', 'layers-pro' ),
							'class' => 'icon-font-weight-bold',
							'data' => '',
						),
					),
					'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
					// 'class' => 'group layers-icon-group-inline',
					// 'class' => 'group',
				);
			}
			
			$controls["{$prefix}-font-style"] = array(
				'type' => 'layers-select-icons',
				'multi_select' => TRUE,
				'label' => '',
				// 'default' => 'underline',
				'choices' => array(
					'italic' => array(
						'name' => __( 'Italic', 'layers-pro' ),
						'class' => 'icon-font-italic',
						'data' => '',
					),
					'underline' => array(
						'name' => __( 'Underline', 'layers-pro' ),
						'class' => 'icon-font-underline',
						'data' => '',
					),
					'strike-through' => array(
						'name' => __( 'Strikethrough', 'layers-pro' ),
						'class' => 'icon-font-strike-through',
						'data' => '',
					),
					'text-transform' => array(
						'name' => __( 'Uppercase', 'layers-pro' ),
						'class' => 'icon-font-text-transform',
						'data' => '',
					),
				),
				'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
				// 'class' => 'group layers-icon-group-inline',
				// 'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-font-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Border.
		 */
		
		if ( 'border' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-border-accordion-start"] = array(
					'label' => __( 'Borders', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
			
			if ( ! $args['hover'] ) {
				
				$controls["{$prefix}-borders-active"] = array(
					'type' => 'layers-select-icons',
					'multi_select' => TRUE,
					'label' => '',
					'choices' => array(
						'top' => array(
							'name' => __( 'Top', 'layers-pro' ),
							'class' => 'icon-border-top',
							'data' => '',
						),
						'right' => array(
							'name' => __( 'Right', 'layers-pro' ),
							'class' => 'icon-border-right',
							'data' => '',
						),
						'bottom' => array(
							'name' => __( 'Bottom', 'layers-pro' ),
							'class' => 'icon-border-bottom',
							'data' => '',
						),
						'left' => array(
							'name' => __( 'Left', 'layers-pro' ),
							'class' => 'icon-border-left',
							'data' => '',
						),
					),
					'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
					// 'class' => 'group layers-icon-group-inline',
					// 'class' => 'group',
				);
			
				$controls["{$prefix}-border-style"] = array(
					'type' => 'layers-border-style-fields',
					'label' => '',
					'class' => 'group',
				);
			}
			
			$controls["{$prefix}-border-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-border-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Margin.
		 */
		
		if ( 'margin' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-margin-accordion-start"] = array(
					'label' => __( 'Margin', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-margin"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-margin-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Padding.
		 */
		
		if ( 'padding' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-padding-accordion-start"] = array(
					'label' => __( 'Padding', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-padding"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-padding-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Shadow.
		 */
		
		if ( 'shadow' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-shadow-accordion-start"] = array(
					'label' => __( 'Shadow', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-shadow-style"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
				'fields' => array(
					'x' => 'X',
					'y' => 'Y',
					'blur' => 'Blur',
					'spread' => 'Spread',
					'opacity' => 'Opacity',
				),
			);
			
			$controls["{$prefix}-shadow-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Shadow Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-shadow-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
	}
	
	
	/**
	 * Set partial key.
	 */
	
	if ( $args['partial'] ) {
		$controls = layers_set_partial_keys( $args['partial'], $controls );
	}
	
	
	return $controls;
}

/**
 * Get the Layers Pro HTML element.
 *
 * @return   string   Pro Badge HTML.
 */
function layers_get_controls_pro_badge() {
	
	return '';
}

/**
 * Convert instances.
 */
function layers_modify_widget_instance( $instance, $key, $instance_key ) {
	global $wp_customize;
	
	// Convert button size `Small | Medium | ...` to a Font Size if Layers Pro is installed.
	if ( isset( $instance['design']['buttons-size'] ) ) {
		
		if ( 'small' == $instance['design']['buttons-size'] ) {
			
			$instance['design']['buttons-text-size']['font-size'] = '12';
			$instance['design']['buttons-padding']['top'] = '2';
			$instance['design']['buttons-padding']['right'] = '10';
			$instance['design']['buttons-padding']['bottom'] = '2';
			$instance['design']['buttons-padding']['left'] = '10';
		}
		else if ( 'medium' == $instance['design']['buttons-size'] ) {
			
			$instance['design']['buttons-text-size']['font-size'] = '15';
			$instance['design']['buttons-padding']['top'] = '5';
			$instance['design']['buttons-padding']['right'] = '15';
			$instance['design']['buttons-padding']['bottom'] = '5';
			$instance['design']['buttons-padding']['left'] = '15';
		}
		else if ( 'large' == $instance['design']['buttons-size'] ) {
			
			$instance['design']['buttons-text-size']['font-size'] = '18';
			$instance['design']['buttons-padding']['top'] = '10';
			$instance['design']['buttons-padding']['right'] = '25';
			$instance['design']['buttons-padding']['bottom'] = '10';
			$instance['design']['buttons-padding']['left'] = '25';
		}
		else if ( 'massive' == $instance['design']['buttons-size'] ) {
			
			$instance['design']['buttons-text-size']['font-size'] = '20';
			$instance['design']['buttons-padding']['top'] = '15';
			$instance['design']['buttons-padding']['right'] = '30';
			$instance['design']['buttons-padding']['bottom'] = '15';
			$instance['design']['buttons-padding']['left'] = '30';
		}
		
		unset( $instance['design']['buttons-size'] );
	}
	
	return $instance;
}
add_filter( 'layers_modify_widget_instance', 'layers_modify_widget_instance', 10, 3 );
