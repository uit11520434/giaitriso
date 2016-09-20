<?php
/**
 * The Template for displaying all single posts.
 *
 * @package BeeeTube
 * @subpackage Template
 * @since deTbue 1.0
 */

global $post;

// Get video layout
$video_layout = get_post_meta($post->ID, 'jtheme_video_layout', true);
if(!$video_layout)
	$video_layout = get_option('jtheme_single_video_layout');
if(!$video_layout)
	$video_layout = 'standard';

// Check the current post is a video post and get template based on the video layout
if(is_video()) {
	if($video_layout == 'full-width')
		get_template_part('single-video-full-width'); 
	else
		get_template_part('single-video'); 
	
	return;
}

get_header(); 

$info_toggle = (int)get_option('jtheme_info_toggle');

$featuredVideo =  get_option('jtheme_single_stand_status');
$relatedVideo =  get_option('jtheme_related_status');
?>
<?php
if($featuredVideo == true){
 get_template_part('related-posts'); 
 }else{
 echo '<br /><br />';
 }
 ?>
<div class="entry-header wrap cf">
	<div class="inner cf">
		
	
		
	</div><!-- end .entry-header>.inner -->
	</div><!-- end .entry-header -->
<div id="main"><div class="wrap cf">
	
	
	
	<div id="content" role="main">
		<?php while (have_posts()) : the_post(); global $post;?>
		
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
		<div id="video">
			<div class="screen fluid-width-video-wrapper">
				<?php
				jtheme_thumb_html_single('custom-full');
				?>
			</div><!-- end .screen -->
		</div><!-- end #video-->
		<br clear="all" />
		<div class="entry-header cf">
			<div class="inner cf">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-meta">
							<span class="author"><?php _e('', 'jtheme'); ?> <?php the_author_posts_link(); ?></span>
							<span class="time"><?php the_date('jS M, Y') ?></span>
							<span class="stats"><?php echo jtheme_get_post_stats(); ?></span>
							
							
			</div>
			<?php jtheme_post_actions($post->ID); ?>
				
			</div><!-- end .entry-header>.inner -->
		</div><!-- end .entry-header -->
		<div id="details" class="section-box">
			<div class="section-content">
			<div id="info"<?php if(!empty($info_toggle)) echo ' class="more-less" data-less-height="'.$info_toggle.'"'; ?>>
				

				<div class="entry-content rich-content">
					<?php the_content(); ?>
					
					<?php wp_link_pages(array('before' => '<p class="entry-nav pag-nav"><span>'.__('Pages:', 'jtheme').'</span> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                    
				</div><!-- end .entry-content -->
			 
				<div id="extras">
				<div>
					<h4><?php _e('Category:', 'jtheme'); ?></h4> <?php the_category(', '); ?>
				</div>
					<?php the_tags('<h4>'.__('Tags:', 'jtheme').'</h4>', ', ', ''); ?>
				</div>
				
			</div><!-- end #info -->
			</div><!-- end .section-content -->
			
			<?php if($info_toggle > 0) { ?>
			<div class="info-toggle">
				<a href="#" class="info-toggle-button info-more-button">
					<span class="more-text"><?php _e('Show more', 'jtheme'); ?></span> 
					<span class="less-text"><?php _e('Show less', 'jtheme'); ?></span>
				</a>
			</div>
			<?php } ?>
		</div><!--end #deatils-->
		
		</div><!-- end #post-<?php the_ID(); ?> -->
		
		<?php 
		if($relatedVideo == true){
			jtheme_related_posts(array(
				'number'=>get_option('jtheme_related_posts'), 
				'view'=>get_option('jtheme_related_posts_view', 'grid-mini')
			)); 
		}
		?>

        <?php comments_template('', true); 
		$bottomAdcode =  get_option('jtheme_bottom_adcode');
		$bottomAdimg =  get_option('jtheme_bottom_adimg');
		if(!empty($bottomAdcode) && empty($bottomAdimg)){
		?>
		<div class="single-banner">
			<?php echo $bottomAdcode; ?>
		</div>
		<?php
		}
		
		if(empty($bottomAdcode) && !empty($bottomAdimg)){
			?>
		<div class="single-banner">
				<img src="<?php echo $bottomAdimg; ?>" />
		</div>
		<?php
		}
		?>
		<?php endwhile; ?>
	</div><!-- end #content -->

	<?php get_sidebar(); ?>

</div></div><!-- end #main -->
	
<?php get_footer(); ?>