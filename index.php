<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpfamous
 */

get_header(); ?>

			<?php 
			$args = array( 'numberposts' => '5',
						   'order' => 'ASC' );

			$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

			$count = 0;
			foreach( $recent_posts as $post ){
				$thumb_id = get_post_thumbnail_id($post['ID']);	
				$url = wp_get_attachment_url($thumb_id);			
				$recent_posts[$count]["img"] = $url;
				$recent_posts[$count]["permalink"] = get_permalink( $post['ID'] );
				$count++;
			}
			?>



			<script type="text/javascript">
		    var recentPosts = <?php echo json_encode($recent_posts); ?>;
			

			require.config({baseUrl: '<?php echo get_template_directory_uri(); ?>/src/'});
			require(['main']);
			</script>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
