 <?php echo $this->fetch('style5.2/inc/module/totop.html'); ?> <?php if ($this->_var['is_show_down']): ?>
<?php
    $this->_var['entry_name'] = ENTRY_NAME;
?>
    <div class="shade"></div>
    <div class="Client" style="top: 0px;">
        <div class="Client_de-top">
            <a href="javascript:void(0);" class="close_but close-top">
                <i class="iconfont">&#xe635;</i>
            </a>
            <!--关闭扭-->
            <img class="app-dian" src="<?php echo $this->_var['TMPL']; ?>/images/app-dian.png">
            <div class="transcript">
                <!-- <div class="index_footer_logo"></div> -->
                <div class="app-logo">
                    <img class="logo" <?php if ($this->_var['entry_name'] == 'cssh_o2o'): ?>src="<?php echo $this->_var['TMPL']; ?>/images/logo.png" <?php else: ?> src="<?php echo $this->_var['TMPL']; ?>/images/app_logo.png" <?php endif; ?>>
                </div>
                <div class="app-text">
                    <p class="app-txt"><?php echo $this->_var['data']['entry_name_cssh_shop_title']; ?></p>
                    <p class="app-txt">APP万种商品等您来！</p>
                </div>
            </div>
            <a href="<?php echo $this->_var['data']['mobile_btns_download']; ?>" class="go_download">
                
            </a>
        </div>
        <div class="Client_de-center">
            <div class="app-logo">
                <img class="logo" <?php if ($this->_var['entry_name'] == 'cssh_o2o'): ?>src="<?php echo $this->_var['TMPL']; ?>/images/logo.png" <?php else: ?>src="<?php echo $this->_var['TMPL']; ?>/images/app_logo.png" <?php endif; ?>>
            </div>
            <div class="app-center-text">
                <p class="app-center-title">“<?php echo $this->_var['data']['entry_name_cssh_shop_title']; ?>”</p>
                <p class="app-center-label">欢迎您</p>
                <p class="app-center-desc">下载APP万种商品等您来！</p>
            </div>
            <a href="<?php echo $this->_var['data']['mobile_btns_download']; ?>" class="app-center-btn">下载<?php echo $this->_var['data']['entry_name_cssh_shop_title']; ?>APP</a>
        </div>
        <a href="javascript:void(0);" class="close_but close-bottom">
                <i class="iconfont">&#xe68e;</i>
            </a>
        <!--关闭扭-->
    </div>
    <?php endif; ?>
    <div class="go_back_url" url='<?php echo $this->_var['back_url']; ?>'></div>
    </div>
    <script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['foot_pagejs'],
  'c' => 'foot_cpagejs',
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
    <script type="text/javascript">
    $.init();
    </script>
    </body>

    </html>