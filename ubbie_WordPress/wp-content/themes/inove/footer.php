	</div>
	<!-- main END -->

	<?php
		$options = get_option('inove_options');
		global $inove_nosidebar;
		if(!$options['nosidebar'] && !$inove_nosidebar) {
			get_sidebar();
		}
	?>
	<div class="fixed"></div>
</div>
<!-- content END -->

<!-- footer START -->
<div id="footer">
	<a id="gotop" href="#" onclick="MGJS.goTop();return false;"><?php _e('Top', 'inove'); ?></a>
	<a id="powered" href="http://wordpress.org/">WordPress</a>
	<div id="copyright">
		<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'inove') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';

				echo $copyright;
				bloginfo('name');
			}
		?>
	</div>
    
    <div><a href="http://ubbie.net/">返回首页</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ubabytv.com.cn">宝贝家官方网站</a></div>
	<!--<div id="themeinfo">
		<?php /*?><?php printf(__('Theme by <a href="%1$s">NeoEase</a>. Valid <a href="%2$s">XHTML 1.1</a> and <a href="%3$s">CSS 3</a>.', 'inove'), 'http://www.neoease.com/', 'http://validator.w3.org/check?uri=referer', 'http://jigsaw.w3.org/css-validator/check/referer?profile=css3'); ?><?php */?>
	</div>-->
</div>
<!-- footer END -->

</div>
<!-- container END -->
</div>
<!-- wrap END -->

<?php
	wp_footer();

	$options = get_option('inove_options');
	if ($options['analytics']) {
		echo($options['analytics_content']);
	}
?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fdb62c1adad5af4521715922eceb2a29c' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34217596-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>

