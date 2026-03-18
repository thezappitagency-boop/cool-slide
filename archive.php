<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agntix
 */


get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-xl-8 col-lg-8' : 'col-xl-12 col-lg-12';
$sidebar_sytem = get_theme_mod('agntix_blog_sidebar_system', 'right');

$blog_column_alignment = $sidebar_sytem == 'left' ? 'flex-row-reverse' : '';
$sidebar_off = $sidebar_sytem == 'no_sidebar' ? false : true;

?>

<section class="tp-blogpost-area postbox-area pt-110 pb-80" style="background-color: #0E0F11">
	<div class="container container-1330">
		<div class="row <?php echo esc_attr($blog_column_alignment); ?> justify-content-center">
			<div class="<?php print esc_attr($blog_column); ?>">
				<div class="postbox-wrapper">
					<?php
					if (have_posts()):
						if (is_home() && !is_front_page()):
							?>
							<header>
								<h1 class="page-title screen-reader-text">
									<?php single_post_title(); ?>
								</h1>
							</header>
							<?php
						endif; ?>

						<?php
						/* Start the Loop */
						while (have_posts()):
							the_post(); ?>
							<?php
							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */

							if (has_post_format('quote')) {
								get_template_part('template-parts/content-quote');
							} else {
								get_template_part('template-parts/content');
							}
							?>
							<?php
						endwhile;
						?>

						<div class="tp-pagination basic-pagination mt-50 mb-0">
							<?php agntix_pagination('<i class="fa-regular fa-angle-left"></i>', '<i class="fa-regular fa-angle-right"></i>', '', ['class' => '']); ?>
						</div>
						<?php
					else:
						get_template_part('template-parts/content', 'none');
					endif;
					?>
				</div>
			</div>

			<?php if (is_active_sidebar('blog-sidebar') && $sidebar_off): ?>

				<div class="col-xl-4 col-lg-4">
					<div class="sidebar-wrapper">
						<?php get_sidebar(); ?>
					</div>
				</div>

			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();