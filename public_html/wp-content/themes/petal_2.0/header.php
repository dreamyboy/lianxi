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

<script src="<?php bloginfo('template_directory'); ?>/js/weibo.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.6.1.min.js?ver=3.3"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.masonry.min.js?ver=3.3"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.infinitescroll.js"></script>

<script type="text/javascript">
<!--
function goTopEx(){
		var obj=document.getElementById("goTopBtn");
		function getScrollTop(){
				return document.documentElement.scrollTop;
			}
		function setScrollTop(value){
				document.documentElement.scrollTop=value;
			}	
		window.onscroll=function(){getScrollTop()>0?obj.style.display="":obj.style.display="none";}
		obj.onclick=function(){
			var goTop=setInterval(scrollMove,18);
			function scrollMove(){
					setScrollTop(getScrollTop()/2.3);
					if(getScrollTop()<1)clearInterval(goTop);
				}
		}
	}
-->
</script>
<script type="text/javascript">
$(function () {
$('.imgs img').hover(
function() {$(this).fadeTo("fast", 0.9);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>


<script>
  $(function(){
    
    var $container = $('#container');
	
    $container.imagesLoaded(function(){
      $container.masonry({
    itemSelector : '.ks-waterfall',
    columnWidth : 220,
    gutterWidth: 10

      });
    });
    
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation 
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.ks-waterfall',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
      }
    );
    
  });
</script>

<?php
	wp_enqueue_script('jquery');
	wp_head();
?>
<?php if ( is_singular() ){ ?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script><?php } ?>
<style>
<?php if ($zine_opacity == "true") { ?>
.post, .page .page,.commentlist li.depth-1,h4.widget-title,#author,#email,#url,#comment{background-color:rgba(255,255,255,.9)}
#toolbar{opacity:.9}
#comments h3, #related_posts h3 ,#comments h3 span, #related_posts h3 span{background:none}
#header,#nav,#footer{border-color:rgba(255,255,255,.8)}
#nav,#footer{-webkit-box-shadow:0 0 12px rgba(0,0,0,.2);-moz-box-shadow:0 0 12px rgba(0,0,0,.2);box-shadow:0 0 12px rgba(0,0,0,.2)}
<?php } ?>
<?php if ($zine_light == "true") { ?>
#sidebar .widget li,#sidebar .widget li a{color:#DDD}
#sidebar .widget li a:hover, #sidebar .widget li:hover a{color:#FFF;text-shadow:1px 1px 0 #000}
#sidebar .widget li:hover{background:rgba(0,0,0,.4)}
#comments-title a,#comments h3, #related_posts h3{color:#FFF;text-shadow:0 0 4px rgba(0,0,0,.7)}
#site-description,.must-log-in,.logged-in-as{color:white;text-shadow:1px 1px 1px rgba(0,0,0,.7)}
<?php } ?>
<?php if ($zine_cat2col == "true") echo "#sidebar .widget_categories li{width:95px;float:left}"; ?>
<?php if ($zine_link2col == "true") echo "#sidebar .widget_links li{width:95px;float:left}"; ?>
</style>
</head>

<body <?php body_class(); ?>>
<div id="goTopBtn" style="display:none;z-index:1"></div>
<script type="text/javascript">goTopEx();</script>


<div class="top" id="top">
     <div class="top_c">
     
     <?php $heading_tag = ( is_home() || is_front_page() || is_archive() || is_search() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="logo">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>" rel="home"><img alt="<?php bloginfo('name'); ?>" src="<?php bloginfo('template_url'); ?>/images/logo.png" /></a>
			</<?php echo $heading_tag; ?>>
            
 <!--    <h1><img src="images/logo.png" /></h1>-->
     
     
            <div class="serach">
            <div class="serach_bar">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<input type="text" class="inputs" value="搜一下让改变发生" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="搜索"  class="inputs2" />
					</form>
                    
                                    <!--<input type="text"  value="输入搜索词" />-->
            </div>
            <div class="serach_log">
                <ul>
                <li><a href="<?php echo home_url( '/' ); ?>">首页</a></li>
                <li><a href="<?php echo $zine_rss; ?>" target="_blank">订阅</a></li>
                </ul>
            </div>
        </div>

     </div>
</div>

<div class="s_nav">
    
   <?php /*?> <h2><?php bloginfo('description'); ?></h2><?php */?>
     <?php wp_nav_menu( array('container_id' => 'menu-container', 'walker' => new description_walker())); ?>
</div>


<div id='container' style="position: relative;">
   <div class="ks-waterfall tag-cloud">
   <?php wp_tag_cloud('smallest=8&largest=22&number=45&order=DESC'); ?>
   </div>


