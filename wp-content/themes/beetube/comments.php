<?php
/**
 * Comments Template
 *
 * Lists comments and calls the comment form.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

<?php
	/* If there are no comments are given and comments/pings are closed and viewing a page, return. */
	if( !have_comments() && !comments_open() && !pings_open() && is_page() )
		return;

	global $wp_query, $cpage;
	//$comments_by_type = &separate_comments($wp_query->comments);
	$display_pings = false; // set to true if you want to display trackbacks/pingbakcs
	$cpage = $cpage > 1 ? $cpage : 1; 
?>

<?php if (!empty($comments_by_type['comment'])) : ?>
	<div id="comments">
		<div class="section-header"><h2 class="section-title" id="comments-title"><?php comments_number( __('No Comments', 'jtheme'), __( '1 Comment', 'jtheme'), __( '% Comments', 'jtheme') ); ?></h2></div>

			<ul class="comment-list">
				<?php wp_list_comments(array('type'=>'comment', 'style'=>'ul', 'callback'=>'jtheme_comment_callback', 'avatar_size'=>48)); ?>
			</ul>
			
			<?php if(get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="comment-nav pag-nav">
				<?php paginate_comments_links(); ?>
			</div>
			<?php } ?>
	</div><!-- end #comments -->
<?php endif; ?>

<?php if (!empty($comments_by_type['pings']) && $display_pings) : ?>	
	<div id="pings">
		<h3 id="pings-title"><?php _e('Pings', 'jtheme'); ?></h3>
	
		<ol class="ping-list">
			<?php wp_list_comments(array('type'=>'pings', 'callback'=>'jtheme_ping_callback')); ?>
		</ol>
	</div><!-- end #pings -->
<?php endif; ?>
		
<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="comments-closed"><?php _e( 'Comments are closed.', 'jtheme'); ?></p>
<?php endif; ?>
<?php jtheme_comment_form(array('comment_notes_after'=>'')); ?>