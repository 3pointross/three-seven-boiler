<?php get_header(); ?>
<div class="container">
	<section id="primary" class="row content-area" role="main">
        <main id="main" class="col-lg-8 site-main" role="main">


        <header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'brideview' ); ?></h1>
			</header>

			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'brideview' ); ?></p>

			<?php get_search_form(); ?>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<?php if ( threeseven_boiler_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
			<div class="widget widget_categories">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'brideview' ); ?></h2>
				<ul>
				<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
				?>
				</ul>
			</div><!-- .widget -->
			<?php endif; ?>

			<?php
			/* translators: %1$s: smiley */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'brideview' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>

        </main>

        <?php get_sidebar(); ?>

    </section>
</div>

<?php
get_footer();