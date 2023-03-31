<?php

/**
 * Widget Name: Recent Post
 */

if (!class_exists('Mygrace_Core_Widget_Posts')) {
	class Mygrace_Core_Widget_Posts extends WP_Widget {

		function __construct() {
			parent::__construct(
				false,
				esc_html__('Mygrace - Recent Posts', 'mygrace_core'),
				array(
					'classname' => 'widget_mygrace_core_post_thumb',
					'description' => esc_html__('Allows you to display a list of the most recent posts with thumbnail, excerpt and post date', 'mygrace_core')
				)
			);
		}

		function widget( $args, $instance ) {
			extract($args);
			
			global $post;
			
			echo mygrace_core_sanitize_text_field( $before_widget );
			
			if ($instance['widget_title'] !== '') {
				echo mygrace_core_sanitize_text_field( $before_title . $instance['widget_title'] . $after_title );
			}
			
			$orderby = $instance['orderby'];
			
			$postsArgs = array(
				'showposts'     	=> $instance['posts_widget_number'],
				'offset'          	=> 0,
				'orderby'         	=> $orderby,
				'order'           	=> 'DESC',
				'post_type'       	=> 'post',
				'post_status'     	=> 'publish',
				'ignore_sticky_posts' => 1
			);

			if( $instance['category'] ) $postsArgs['category_name'] = $instance['category'];
			$output = '';
			
			$wp_query_posts = new WP_Query();
			$wp_query_posts->query( $postsArgs );
			
			$i = 1;

			while ( $wp_query_posts->have_posts() ) : $wp_query_posts->the_post();
				
				$classes 		= '';
				$categories 	= get_the_category( $post->ID );
				if( ! empty( $categories ) ) {
					$classes 	.= ' category-' . esc_attr( $categories[0]->slug );
				}
				$thumb_url 		= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$classes 		.= !empty( $thumb_url ) ? ' has_thumb' : '';
				$permalink 		= get_permalink();
				$title 			= get_the_title();
					
				$output .= '<li class="' . esc_attr( $classes ) . '">';
					$output .= '<div class="recent_posts_wrapper">';

						if ( has_post_thumbnail() ) {
							$output .= mygrace_post_thumbnail( 'mygrace-thumb-recent-post-widget', array( 'echo' => false ) );
						}

						$output .= '<div class="recent_posts_content">';
							$output .= '<a class="recent_post_title" href="' . esc_url( $permalink ) . '">' . esc_html( $title ) . '</a>';
							$output .= '<div class="entry-meta">';
								$output .= mygrace_posted_on( array( 'prefix' => '', 'echo' => false ) );
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</li>';
			
				$i++;

			endwhile;
			
			wp_reset_postdata();

			echo '<ul class="recent_posts_list clearfix">' . $output . '</ul>';

			echo mygrace_core_sanitize_text_field( $after_widget );
		}


		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['widget_title'] 			= strip_tags( $new_instance['widget_title'] );
			$instance['category'] 				= strip_tags( $new_instance['category'] );
			$instance['orderby'] 				= strip_tags( $new_instance['orderby'] );
			$instance['posts_widget_number'] 	= strip_tags( $new_instance['posts_widget_number'] );

			return $instance;
		}

		function form( $instance ) {
			$defaultValues = array(
				'widget_title' 			=> 'Recent Posts',
				'orderby'				=> 'date',
				'posts_widget_number' 	=> '4',
			);
			$instance = wp_parse_args((array) $instance, $defaultValues);
			$category	= isset( $instance['category']) ? esc_attr( $instance['category'] ) : '';
			
		?>
			<table class="fullwidth">
				<tr>
					<td><?php esc_html_e('Title:', 'mygrace_core'); ?></td>
					<td><input type='text' class="fullwidth" name='<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>' value='<?php echo esc_attr( $instance['widget_title'] ); ?>'/></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Category:', 'mygrace_core'); ?></td>
					<td>
						<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
							<?php 
								$categories = mygrace_core_get_categories( 'category' );
								foreach( $categories as $k=>$v ){
									$selected = ( $category == $k ) ? 'selected="selected"' : false;
									echo '<option value="'. $k .'" '. $selected .'>'. $v .'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e('Order by:', 'mygrace_core'); ?></td>
					<td>
						<select id="<?php echo esc_attr( $this->get_field_id('orderby') ); ?>" name="<?php echo esc_attr( $this->get_field_name('orderby') ); ?>"  value="<?php echo esc_attr( $instance['orderby'] ); ?>" >
							<option value ='rand' <?php if ($instance['orderby'] == 'rand') echo 'selected'; ?>><?php esc_html_e('Random', 'mygrace_core'); ?></option>
							<option value ='date' <?php if ($instance['orderby'] == 'date') echo 'selected'; ?>><?php esc_html_e('Date', 'mygrace_core'); ?></option>
							<option value ='comment_count' <?php if ($instance['orderby'] == 'comment_count') echo 'selected'; ?>><?php esc_html_e('Comment count', 'mygrace_core'); ?></option>
							<option value ='title' <?php if ($instance['orderby'] == 'title') echo 'selected'; ?>><?php esc_html_e('Title', 'mygrace_core'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e('Number:', 'mygrace_core'); ?></td>
					<td><input type='text' class="fullwidth" name='<?php echo esc_attr( $this->get_field_name( 'posts_widget_number' ) ); ?>' value='<?php echo esc_attr( $instance['posts_widget_number'] ); ?>'/></td>
				</tr>
			</table>
		<?php
		}
	}

	function mygrace_core_get_categories( $category ) {
		$categories = get_categories( array( 'taxonomy' => $category ));
		
		$array = array( '' => esc_html__( 'All', 'mygrace_core' ) );	
		foreach( $categories as $cat ){
			if( is_object($cat) ) $array[$cat->slug] = $cat->name;
		}
			
		return $array;
	}

}