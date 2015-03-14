<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
			<h1 class="entry-title">未找到内容</h1>
			<div class="entry-content">
				<p>很抱歉，你请求的页面不存在。<br /><a href="<?php echo home_url( '/' ); ?>">回到首页</a> - <a href="javascript:history.go(-1);">返回上页</a></p>
			</div>
		</div>
<?php endif; ?>

<?php $count = 1; ?>
<?php while ( have_posts() ) : the_post(); ?> 
       <div class="ks-waterfall"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="info">
        <div class="pinglun">
            <div class="ico_1"><a href="javascript:void(0)" onclick="postToWb();return false;" class="tmblog"><img src="<?php bloginfo('template_directory'); ?>/images/ico_zhuanbo.gif" border="0" alt="转播到腾讯微博" ></a></div>
            <div class="ico_2"><a href="<?php the_permalink() ?>#pinglun" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><img src="<?php bloginfo('template_directory'); ?>/images/ico_pinglun.gif" /></a></div>
        </div>
        
        <div class="imgs">

		<?php if(get_post_meta($post->ID, 'thumbnail', true)!="") : ?>
			<a class="img" href="<?php the_permalink(); ?>" target="_blank"><?php echo get_post_meta($post->ID, 'thumbnail', true);?></a>
		<?php else : ?>
			<a class="noimg" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><span><?php the_title(); ?></span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"...");?></a>
		<?php endif; ?>
        <div style="clear:both"></div>
        </div>
        

        <p class="arctitle"><a href="<?php the_permalink() ?>" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><?php the_title(); ?></a></p>
        <p><?php the_tags('标签：', ', ', '  '); ?></p>
        </div>
        
        <div class="txts">
        <p>
        分类：<?php the_category(', '); ?> , <?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?><br />
        <span><?php edit_post_link('编辑', '  ', ' | '); ?></span>
        <?php if( current_user_can('level_10') ) {if(function_exists('the_views')) { the_views(); }} ?>
        </p>
        <div style="clear:both"></div>
        </div>
    </div>


<?php endwhile; ?>

