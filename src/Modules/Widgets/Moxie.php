<?php namespace LeanNs\Modules\Widgets;

use Lean\Widgets\Models\AbstractWidget;
use Timber\Timber;

/**
 * Class Moxie
 * This is a sample Widget. You can delete it if you don't want it!
 *
 * @package LeanNs\Modules\Widgets
 */
class Moxie extends AbstractWidget
{
	/**
	 * Moxie constructor.
	 */
	public function __construct() {
		parent::__construct( 'Moxie', 'Display the Moxie logo' );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		Widgets::esc_widget_wrapper_e( $args['before_widget'] );

		if ( $instance['title'] ) {
			Widgets::esc_widget_wrapper_e( $args['before_title'] );
			echo esc_html( $instance['title'] );
			Widgets::esc_widget_wrapper_e( $args['after_title'] );
		}

		Timber::render( 'molecules/widgets/moxie.twig' );

		Widgets::esc_widget_wrapper_e( $args['after_widget'] );
	}
}
