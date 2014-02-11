<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to hurry_comment() which is
 * located in the functions.php file.
 */
?>
	<div id="container-comments">

	<?php if ( have_comments() ) : ?>
		<header>
			<a href="#" class="comments-open"><h2>
				<?php
					printf( _n( '1 kommentar', '%1$s kommentarer', get_comments_number(), 'hurry' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2></a>
		</header>
		<div class="comment-container">
		    <div class="container-padding">
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-above" style="display: none;">
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hurry' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hurry' ) ); ?></div>
				</nav>
				<?php endif; // check for comment navigation ?>
		        <ol class="comment-list clearfix">
					<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use hurry_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define hurry_comment() and that will be used instead.
						 * See hurry_comment() in hurry/functions.php for more.
						 */
						wp_list_comments( array( 'callback' => 'hurry_comment' ) );
					?>
				</ol>

	<?php else: ?>
		<header>
			<a href="#" class="comments-open"><h2>
				<?php _e( 'Der er endnu ikke kommenteret på dette indlæg.' , 'hurry' ); ?>
			</h2></a>
		</header>
		<div class="comment-container">
		    <div class="container-padding">	
	<?php endif; // have_comments() ?>
				<div class="comments-form">
					<?php comment_form(); ?>
                </div><!-- end .comment-form -->
            </div><!-- end .container-padding -->
        </div><!-- end .comment-container -->

	</div><!-- #container-comments -->
