<?php get_header(); ?>
<?php $options = get_option('inove_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div id="postpath">
		<a title="<?php _e('Go to homepage', 'inove'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'inove'); ?></a>
		 &gt; <?php the_category(', '); ?>
		 &gt; <?php the_title(); ?>
	</div>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		<div class="info">
			<span class="date"><?php the_time(__('F jS, Y', 'inove')) ?></span>
			<?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?>
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
			<?php if ($comments || comments_open()) : ?>
				<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'inove'); ?></a></span>
				<span class="comments"><a href="#comments"><?php _e('Go to comments', 'inove'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<?php the_content(); ?>
			<div class="fixed"></div>
		</div>
       
        
		<div class="under">
			<?php if ($options['categories']) : ?><span class="categories"><?php _e('Categories: ', 'inove'); ?></span><span><?php the_category(', '); ?></span><?php endif; ?>
			<?php if ($options['tags']) : ?><span class="tags"><?php _e('Tags: ', 'inove'); ?></span><span><?php the_tags('', ', ', ''); ?></span><?php endif; ?>
		</div>
        
        <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
        <span class="bds_more">更多</span>
		<a class="shareCount"></a>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=1401837" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->
	</div>

	<!-- related posts START -->
	<?php
		// when related posts with title
		if(function_exists('wp23_related_posts')) {
			echo '<div id="related_posts">';
			wp23_related_posts();
			echo '</div>';
			echo '<div class="fixed"></div>';
		}
		/*
		// when related posts without title
		if(function_exists('wp23_related_posts')) {
			echo '<div class="boxcaption">';
			echo '<h3>Related Posts</h3>';
			echo '</div>';
			echo '<div id="related_posts" class="box">';
			wp23_related_posts();
			echo '</div>';
			echo '<div class="fixed"></div>';
		}
		*/
	?>
	<!-- related posts END -->

	<?php include('templates/comments.php'); ?>

	<div id="postnavi">
		<span class="prev"><?php next_post_link('%link') ?></span>
		<span class="next"><?php previous_post_link('%link') ?></span>
		<div class="fixed"></div>
	</div>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
