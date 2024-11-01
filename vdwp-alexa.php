<?php
/*
Plugin Name: vdwp-alexa
Plugin URI: http://sogemaskineoptimering.com/blog/extensions
Description: This widget will display Alexa rank and Google Pagerank.
Version: 1.2
Author: Mark Pedersen
Author URI: http://sogemaskineoptimering.com/
License: GPLv2 or later.
*/


add_action( 'widgets_init', 'vdwp_alexa' );


function vdwp_alexa() {
	register_widget( 'vdwp_alexa' );
}

class vdwp_alexa extends WP_Widget {

	function vdwp_alexa() {
		$widget_ops = array( 'classname' => 'alexa', 'description' => __('A widget that displays the rank of ', 'alexa') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'alexa-widget' );
		
		$this->WP_Widget( 'alexa-widget', __('alexa Widget', 'alexa'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title;
			?> 
			<script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/t/a?url=<?php echo $title;?>"></script> 
			<img src="http://pagerankbuttons.com/buttons/pagerank-button.php?url=<?php echo $title;?>&design=1" alt="Pagerank" />
			<?php ;
			echo $after_title;

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('alexa website', 'alexa'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Website (with www):', 'alexa'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	
		
		

	<?php
	}
}

?>