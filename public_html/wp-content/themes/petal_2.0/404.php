<?php get_header(); ?>

        <div class="ks-waterfall">
        <div class="info">
        <img src="<?php bloginfo('template_url'); ?>/images/404.png" alt="404" />
				<p>很抱歉，您请求的页面不存在。<br /><a href="<?php echo home_url( '/' ); ?>">回到首页</a> - <a href="javascript:history.go(-1);">返回上页</a></p>
        </div>
        
<?php get_footer(); ?>