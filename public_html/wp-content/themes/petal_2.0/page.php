<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( 'Page %s' , max( $paged, $page ) );
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo home_url( '/' ); ?>favicon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.3.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/build/kissy.js"></script>


<?php
	wp_enqueue_script('jquery');
	wp_head();
?>
<?php if ( is_singular() ){ ?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script><?php } ?>

</head>

<div class="sub_main"  id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="sub_bar"><div class="co">
    <div class="bar">
    			    <div class=" bar_l"><?php previous_post_link( '%link  / ', '&nbsp;' ); ?></div>
    <div class=" bar_r"><?php next_post_link( '%link', '&nbsp;' ); ?></div>
    </div>
    <div class="bar">分享到：</div>
    <div class="bar"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/bar_sina.gif"></a></div>
    <div class="bar"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/bar_dou.gif"></a></div>
</div></div>
    <div class="sub_left">
        <div class="sub_top"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>
        <?php get_sidebar(); ?>        
    <div style="clear:both"></div>
    </div>
<div class="sub_right">

    <div class="sub_top">
        <div class="serach">
            <div class="serach_bar">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<input type="text" class="inputs" value="搜索" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="搜索"  class="inputs2" />
					</form>
            </div>
            <div class="serach_log">
                <ul>
                <li><a href="<?php echo home_url( '/' ); ?>">首页</a></li>
                <li><a href="<?php echo $zine_rss; ?>" target="_blank">订阅</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sub_nav">
    <h2><?php bloginfo('description'); ?></h2>
    <ul>
    <li class="on"><a href="<?php echo home_url( '/' ); ?>">返回网站首页</a></li>
    <li><a href="<?php echo $zine_rss; ?>" target="_blank">订阅</a></li>
    </ul>
    </div>
    
    <div class="sub_co">
        <div class="sub_co_top">
        <h1><?php the_title(); ?></h1>
        </div>
        <div class="sub_co_d"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ico_zhuanbo.gif" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/ico_pinglun.gif" /></a>
        </div>
        
        <div class="sub_co_art">

			<div class="entry-content"id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
				<?php edit_post_link('编辑', '[ ', ' ]'); ?>
			</div>



        </div>
        
        
    </div>

    <div class="sub_co">
    		<?php if(function_exists('st_related_posts')) { ?>
		<div id="related_posts">
			<?php st_related_posts(); ?>
		</div>
		<?php } ?>
    
 <?php comments_template( '', true ); ?>   
                  
    </div>
    <div style="clear:both"></div>
</div>

<div style="clear:both"></div>

<?php endwhile; ?>        



<?php get_footer(); ?>