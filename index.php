<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chocolita
 */

get_header(); ?>

	<section class="main-event section-padding">
		<div class="row">

			<div class="columns column-5 text-center">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logoE16.png" /><!-- FIXME -->
			</div>

			<div class="columns column-7">
				<?php 
					$val	= 'portada_option_name'; //desired values to be fetched
					$opt 	= $wpdb -> get_row("SELECT * FROM $wpdb->options WHERE option_name = '$val'");
					$opts 	= $opt -> option_value;
					$array 	= unserialize($opts); 
					//Printing out featured event details ?>
					<ul class="main-event-list">
						<li><?php echo $array['event_date']; ?></li>
						<li><?php echo $array['event_name']; ?></li>
						<li><?php echo $array['event_venue']; ?></li>
						<li><?php echo $array['event_desc']; ?></li>
					</ul>
					<a href="<?php echo $array['event_url']; ?>"><button class="main-event-button"><?php echo $array['event_btn']; ?></button></a>
			</div>

		</div><!-- .row -->
		<a name="acerca-de"></a>
	</section><!-- section -->

	
	<section class="about-us section-padding">
		<div class="row">

			<?php dynamic_sidebar( 'home_about_us' ); ?>

		</div><!-- .row -->
		<a name="eventos"></a>
	</section><!-- section -->

	
	<section class="past-events section-padding">
		<div class="row">

			
				<h2 class="text-center"><?php esc_html_e( 'Previous events', 'chocolita' ); ?></h2> 
				<?php
				$args = array( 'post_type' => 'eventos', 'posts_per_page' => 0 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
				  <div class="columns column-4 text-center">
					<a href="<?php echo get_post_meta($post->ID, "_url", true); ?>"><?php the_post_thumbnail(); ?></a>
					<h2><?php the_title(); ?></h2>
					<h5><?php echo get_post_meta($post->ID, "_location", true); ?></h5>
				  </div>
				<?php endwhile;
			?>

		</div><!-- .row -->
	</section><!-- section -->

<?php
get_footer();
