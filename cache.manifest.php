<?php
  header('Content-type: text/cache-manifest');
  // This generates an md5 tag representing the state of the directory;
  // when we update any code, the tag is bumped and this manifest changes
  // which signals browsers to recache the application.
  $dir = escapeshellarg(dirname(__FILE__));
  exec("find $dir -path '*/.git*' -o \\( -type f -print \\)", $output);
  $md5_tag = md5(implode(' ', array_map('md5_file', $output)));
?>
CACHE MANIFEST
# <?php echo "$md5_tag\n" ?>
CACHE:
/images/reddit_icon.gif
/images/rss.png
/images/chillax.png
/images/favicon.png
/js/jquery-ui-1.8.6.min.js
/js/jquery-1.4.2.min.js
/js/jquery.jfeed.js
/js/chillax.js
/js/date.js
/css/chillax.css
/css/syngrey/jquery-ui-1.8.6.custom.css
/css/syngrey/images/ui-bg_flat_75_ffffff_40x100.png
/css/syngrey/images/ui-bg_glass_55_e6fae6_1x400.png
/css/syngrey/images/ui-icons_1b7019_256x240.png
/css/syngrey/images/ui-bg_highlight-soft_50_d1d1d1_1x100.png
/css/syngrey/images/ui-icons_000000_256x240.png
/css/syngrey/images/ui-icons_888888_256x240.png
/css/syngrey/images/ui-bg_highlight-hard_75_e6e6e6_1x100.png
/css/syngrey/images/ui-bg_inset-soft_95_fef1ec_1x100.png
/css/syngrey/images/ui-bg_flat_100_666666_40x100.png
/css/syngrey/images/ui-bg_flat_30_454545_40x100.png
/css/syngrey/images/ui-bg_inset-hard_60_bdbdbd_1x100.png
/css/syngrey/images/ui-icons_454545_256x240.png
/css/syngrey/images/ui-icons_222222_256x240.png
/css/syngrey/images/ui-icons_cd0a0a_256x240.png
/css/syngrey/images/ui-bg_highlight-hard_75_ededed_1x100.png
NETWORK:
/proxy.php
*