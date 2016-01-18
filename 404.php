<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Chocolita
 */

get_header(); ?>

	<section class="error-404 section-padding">
		<div class="row">

			<div class="columns column-12 text-center">
				<h2><?php esc_html_e( 'Error 404 - \'La sapa\' is utterly confused', 'chocolita' ); ?></h2>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/sapa.jpg" />
				<h5><?php esc_html_e( 'We couldn\'t find the page you were looking for', 'chocolita' ); ?></h5>
				<h5><?php esc_html_e( 'Maybe you should return to the', 'chocolita' ); ?>&nbsp;<a href="<?php echo site_url(); ?>"><?php esc_html_e( 'Home Page', 'chocolita' );?></a>?</h5>
			</div>

		</main><!-- .row -->
	</div><!-- section -->

<?php
get_footer();
