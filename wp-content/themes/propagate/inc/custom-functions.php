<?php
function the_slug() {

	$post_data 	= get_post( $post->ID, ARRAY_A );
	$slug 		= $post_data[ 'post_name' ];

	return $slug;

}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function threeseven_boiler_posted_on() {

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    /*
if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
*/

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        _x( 'Posted on %s', 'post date', 'threeseven_boiler' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        _x( 'by %s', 'post author', 'threeseven_boiler' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function threeseven_boiler_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'threeseven_boiler_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'threeseven_boiler_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so threeseven_boiler_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so threeseven_boiler_categorized_blog should return false.
        return false;
    }
}

/**
 * Display navigation to next/previous set of posts when applicable.
 */
function threeseven_boiler_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }
    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'threeseven_boiler' ); ?></h1>
        <div class="nav-links">

            <?php if ( get_next_posts_link() ) : ?>
                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'threeseven_boiler' ) ); ?></div>
            <?php endif; ?>

            <?php if ( get_previous_posts_link() ) : ?>
                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'threeseven_boiler' ) ); ?></div>
            <?php endif; ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
<?php
}
