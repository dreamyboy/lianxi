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
<script src="<?php bloginfo('template_directory'); ?>/js/weibo.js"></script>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" type="text/css" media="screen" />

<?php
	wp_enqueue_script('jquery');
	wp_head();
?>
<?php if ( is_singular() ){ ?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script><?php } ?>

</head>

<body <?php body_class(); ?>>
<div class="sub_main"  id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="sub_bar"><div class="co">
    <div class="bar">
    			    <div class=" bar_l"><?php previous_post_link( '%link  / ', '&nbsp;' ); ?></div>
    <div class=" bar_r"><?php next_post_link( '%link', '&nbsp;' ); ?></div>
    </div>
    <div class="bar">分享到：</div>
    <div class="bar">
<script type="text/javascript" charset="utf-8">
(function(){
  var _w = 32 , _h = 32;
  var param = {
    url:location.href,
    type:'1',
    count:'', /**是否显示分享数，1显示(可选)*/
    appkey:'344522489', /**您申请的应用appkey,显示分享来源(可选)*/
    title:'', /**分享的文字内容(可选，默认为所在页面的title)*/
    pic:'', /**分享图片的路径(可选)*/
    ralateUid:'', /**关联用户的UID，分享微博会@该用户(可选)*/
	language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
    rnd:new Date().valueOf()
  }
  var temp = [];
  for( var p in param ){
    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
  }
  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
})()
</script>

    </div>
    <div class="bar">
    
 <a href="javascript:void(0)" onClick="postToWb();return false;" style="height:32px;font-size:18px;line-height:32px;"><img src="http://v.t.qq.com/share/images/s/weiboicon32.png" align="absmiddle" border="0" alt="" /></a>

    
    </div>
</div></div>
    <div class="sub_left">
        <div class="sub_top"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>
        
        
        <div class="sub_piclist">
        <h1>热门推荐</h1>
        <ul>
        
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'meta_key' => 'views',
					'orderby'   => 'meta_value_num',
					'paged' => $paged,
					'order' => DESC,
					'showposts' => 9
				);
				query_posts($args);
					while (have_posts()) : the_post();
					$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $imgs); 
					$cnt = count($imgs);
				?>
				<li>
				<?php if ( $cnt > 0 ) {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$imgs[1].'&amp;w=60&amp;h=60&amp;zc=1" />';?></a>
				<?php } else {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php bloginfo('template_url'); ?>/images/default.jpg&amp;w=60&amp;h=60&amp;zc=1" /></a>
				<?php } ?>
				</li>
				<?php endwhile; wp_reset_query(); ?>
            
            
                <script type="text/javascript">
                $(".picss img").load(function(){
                w=this.width;
                h=this.height;
                if(w>h)
                {
                this.height =61;
                this.width = (w/h) * 61;
                }
                else
                {
                this.width=61;
                this.height=(h/w) * 61;
                }
                });
                </script>

                
                
        <div style="clear:both"></div>
        </ul>
        </div>
                
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
            <div class="l"><div class="imgs"><?php echo get_avatar( get_the_author_email(), 60 ); ?></div></div>
            <div class="r"><h1><?php the_title(); ?></h1><p><span class="entry-date"><span class="entry-month"><?php the_time('Y-n'); ?></span><span class="sl">-</span><span class="entry-day"><?php the_time('j'); ?></span></span>
				分类：<?php the_category(', '); ?> | 
				<span class="comments-link"><?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?></span>
				<?php edit_post_link('编辑', ' | ', ' | '); ?>
				<?php if( current_user_can('level_10') ) {if(function_exists('the_views')) { the_views(); }} ?></p></div>
            <div style="clear:both"></div>
        </div>
        <div class="sub_co_d">
        
<a href="javascript:void(0)" onClick="postToWb();return false;" class="tmblog"><img src="<?php bloginfo('template_directory'); ?>/images/ico_zhuanbo.gif" border="0" alt="转播到腾讯微博" ></a>      
        
        &nbsp;&nbsp;&nbsp;&nbsp;<a href="#pinglun"><img src="<?php bloginfo('template_directory'); ?>/images/ico_pinglun.gif" /></a>
        </div>
        
        
        <div class="sub_co_buy">
       方便提醒：现在点下面的图片即可去淘宝直接购买咯！<img src="http://www.mxfaner.com/wp-content/uploads/2012/08/head_ico4.png" alt="去淘宝购买"/>
        </div>
        <div class="sub_co_art" id="postImgs">

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<div class="entry-content">
				<?php the_content('阅读全文...'); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>
		
        <p><?php the_tags('标签：', ', ', ' '); ?></p>
        <p>
</p>
        </div>
    </div>



    <div class="sub_co">
		<?php if(function_exists('st_related_posts')) { ?>
		<div id="related_posts">
			<?php st_related_posts(); ?>
		</div>
		<?php } ?>
    
 <?php comments_template( '', true ); ?>   
        <a name="pinglun"></a>            
    </div>
    <div style="clear:both"></div>
</div>




<script src="<?php bloginfo('template_directory'); ?>/js/scripts.js" type="text/javascript"></script>
<script>
jQuery.noConflict(); 
jQuery(document).ready(function(){ 
			
	molitorscripts(); 
	
	//PRETTY PHOTO
	function prettyP(){
		jQuery("a[href$='jpg'],a[href$='png'],a[href$='gif']").attr({rel: "prettyPhoto"});
		jQuery(".gallery-icon > a[href$='jpg'],.gallery-icon > a[href$='png'],.gallery-icon > a[href$='gif'], .postImg").attr({rel: "prettyPhoto[pp_gal]"});
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal', // fast/slow/normal 
			opacity: 0.35, // Value betwee 0 and 1 
			show_title: false, // true/false 
			allow_resize: true, // true/false 
			overlay_gallery: false,
			counter_separator_label: ' of ', // The separator for the gallery counter 1 "of" 2 
			//theme: 'light_rounded', // light_rounded / dark_rounded / light_square / dark_square 
			hideflash: true, // Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto 
			modal: false // If set to true, only the close button will close the window 
		});
	}		
	prettyP();
	
	// infinitescroll
	jQuery('#listing,.listing').infinitescroll({
		navSelector  : ".navigation",            
 		nextSelector : ".pagenav a",     
		itemSelector : ".post, .page",          
  		loadingImg   : "http://www.hunzaibeijing.com/wp-content/themes/wpbm/scripts/loader_light.gif",          
		loadingText  : ""      
	},function( newElements ) {
		jQuery(this).masonry({ 
			appendedContent: jQuery( newElements ) 
		});
	    prettyP();
	});
		
	jQuery("#videoEmbed").next("#postImgs").css({"marginTop":"430px"});
});
</script>



<div style="clear:both"></div>

<?php endwhile; ?>        


<?php get_footer(); ?>