<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chocolita
 */

get_header(); ?>

	<section class="post-header section-padding">
		<div class="row">

			<div class="columns column-12 text-center">
				<?php
				while ( have_posts() ) : the_post();
				echo '<h2>';
					the_title();
				echo '</h2>';
				?>
			</div>

		</div><!-- .row -->
	</section><!-- section -->

	<section class="posts section-padding">
		<div class="row">

			<div class="columns column-12 text-left">
				<?php
				the_content();
				?>
			</div>

		</div><!-- .row -->
	</section><!-- section -->

	<section class="comments-area section-padding">
		<div class="row">

			<div class="columns column-12 text-left">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>

		</div><!-- .row -->
	</section><!-- section -->

<?php
get_footer();
