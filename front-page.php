<?php get_header(); ?>

			<?php 
			$args = array( 'numberposts' => '5',
						   'order' => 'ASC' );

			$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

			$count = 0;
			foreach( $recent_posts as $post ){
				$thumb_id = get_post_thumbnail_id($post['ID']);	
				$url = wp_get_attachment_url($thumb_id);			
				$recent_posts[$count]["img"] = $url;
				$count++;
			}


			//$current_site = get_current_site();
			$current_site_name = "WatzThis?";
			$localized_vars = array("siteName"=> $current_site_name);
			js_localize(php_vars,$localized_vars); 
			?>


			<script type="text/javascript">
		    var recentPosts = <?php echo json_encode($recent_posts); ?>;
			

			require.config({baseUrl: '<?php echo get_template_directory_uri(); ?>/src/'});
			require(['main']);
			</script>


			

<?php get_footer(); ?>
