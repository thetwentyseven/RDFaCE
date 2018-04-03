<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package attirant
 */
 
 if ( ! function_exists( 'attirant_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function attirant_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array',
	    'prev_text'	=> 'Prev',
	    'next_text'	=> 'Next'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination" align="center"><ul>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div>';
	}
}endif;

if ( ! function_exists( 'attirant_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function attirant_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'attirant' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'attirant' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'attirant_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function attirant_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'attirant' ) );
		if ( $categories_list && attirant_categorized_blog() ) {
			printf( '<span class="cat-links col-lg-4 col-md-4 col-sm-12 col-xs-12"><span class="text">CATEGORIES</span>' . __( '%1$s', 'attirant' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'attirant' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links col-lg-4 col-md-4 col-sm-12 col-xs-12"><span class="text">TAGS</span>' . __( '%1$s', 'attirant' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link col-lg-4 col-md-4 col-sm-12 col-xs-12"><span class="text">COMMENTS</span>';
		comments_popup_link( __( 'Leave a comment', 'attirant' ), __( '1 Comment', 'attirant' ), __( '% Comments', 'attirant' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'attirant' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function attirant_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'attirant_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'attirant_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so attirant_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so attirant_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in attirant_categorized_blog.
 */
function attirant_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'attirant_categories' );
}
add_action( 'edit_category', 'attirant_category_transient_flusher' );
add_action( 'save_post',     'attirant_category_transient_flusher' );
