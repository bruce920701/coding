<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->_var['data']['page_title']; ?></title>
    <!-- Mobile Devices Support @begin -->
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="false" name="twcClient" id="twcClient">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <!--允许全屏模式-->
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <!--指定sari的样式-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="wap-font-scale" content="no">
    <meta content="telephone=no" name="format-detection" />
    <!-- Mobile Devices Support @end -->
    <?php
/*页面上常使用的变量 */
$this->_var['load_image']=$this->_var['TMPL_REAL'].'/style5.2/images/loading/no-image.png';
    $this->_var['no_image']=$this->_var['TMPL'].'/style5.2/images/loading/no-image.png';
    /*页面上常使用的变量 end*/
    ?>

    <script type="text/javascript">
        var tmpl = '<?php echo $this->_var['tmpl']; ?>';
        var __HASH_KEY__ = "<?php echo $this->_var['hash_key']; ?>";
        var load_image="<?php echo $this->_var['load_image']; ?>";
        var no_image="<?php echo $this->_var['no_image']; ?>";
        var sitename ='<?php echo $this->_var['sitename']; ?>';
        var back_url ='<?php echo $this->_var['back_url']; ?>';
        var is_app='<?php echo $this->_var['is_app']; ?>';
        var login_url = '<?php
echo parse_url_tag("u:index|user#login|"."".""); 
?>';
        var AJAX_URL='<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
        var tmpl_path = '<?php echo $this->_var['tmpl_path']; ?>';
        var is_login = '<?php echo $this->_var['is_login']; ?>';
        var app_index = '<?php echo $this->_var['app_index']; ?>';
        var jia_url=  "<?php echo $this->_var['tmpl_path']; ?>js/jia/jia.js";
        var VERIFICATION_CODE_URL='<?php
echo parse_url_tag("u:index|ajax#verification_code|"."".""); 
?>';
    </script>
    <script src="//at.alicdn.com/t/font_44cuergmcp11nhfr.js"></script>

    <?php
        $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/sui/sm.min.css";
    $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/sui/sm-extend.min.css";
    $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/public.css";
    $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/style5.2/css/dist/fanwe.css";




    $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/sui/zepto.min.js";
    $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/sui/zepto.cookie.min.js";
    $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/swiper.min.js";
    $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/module/fanweui.js";
    $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/module/public.js";
    /* $this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/luyou/public.js"; */


    $this->_var['foot_pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/sui/sm.min.js";
    $this->_var['foot_pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/sui/sm-extend.min.js";
    $this->_var['foot_pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/sui/zepto.cookie.min.js";
    $this->_var['foot_pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/dist/fanwe.js";
    /* $this->_var['foot_pagejs'][] = $this->_var['TMPL_REAL']."/style5.2/js/jia.js"; */






    ?>
