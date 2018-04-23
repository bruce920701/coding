<?php if ($this->_var['app_index'] == 'app'): ?>

<!-- 导航下拉开始 -->
<div class="flippedout">
    <div class="m-nav-dropdown">
        <div class="nav-dropdown-con">
            <div class="flex-box func-list">
                <div class="flex-1"><i class="iconfont j-app-share-btn" data-title="<?php echo $this->_var['data']['share_title']; ?>" data-url="<?php echo $this->_var['data']['share_url']; ?>" data-img="<?php echo $this->_var['data']['share_img']; ?>" data-content="<?php echo $this->_var['data']['share_content']; ?>">&#xe60d;</i></div>
                <div class="flex-1 is_Sc j-head-collect" data-isdel="<?php if ($this->_var['data']['is_collect'] != 1): ?>0<?php else: ?>1<?php endif; ?>">
                    <?php if ($this->_var['data']['collect_count'] > 0): ?>
                    <div class="shoucan isSc">
                        <i class="iconfont <?php if ($this->_var['data']['is_collect'] == 1): ?>icon-noshoucan<?php endif; ?>">&#xe615;</i><?php if ($this->_var['data']['is_collect'] == 1): ?><i class="iconfont icon-shoucan">&#xe63d;</i><?php endif; ?><em><?php echo $this->_var['data']['collect_count']; ?></em>
                    </div>
                    <?php else: ?>
                    <i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $this->fetch('style5.2/inc/module/app-dropdown-navlist.html'); ?>
        </div>
    </div>

    <!-- 分享弹出 -->
    <div class="box_share" id="box_share">
        <div class="box_content">
            <div class="social_share">
                <!-- JiaThis Button BEGIN -->
                <div class="jiathis_style_32x32 flex-box">
                    <a class="jiathis_button_weixin flex-1"><i class="iconfont icon-pyq">&#xe636;</i><p>朋友圈</p></a>
                    <a class="jiathis_button_tsina flex-1"><i class="iconfont icon-sina">&#xe639;</i><p>新浪微博</p></a>
                    <a class="jiathis_button_qzone flex-1"><i class="iconfont icon-qzone">&#xe63a;</i><p>QQ空间</p></a>
                    <a class="jiathis_button_cqq flex-1"><i class="iconfont icon-QQ">&#xe63b;</i><p>QQ</p></a>
                </div>
                <script type="text/javascript">
                    var jiathis_config = {
                        sm:"weixin,tsina,qzone,cqq",
                        siteNum:4,
                    };
                </script>


                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=" charset="utf-8" defer="defer"></script>
                <!-- JiaThis Button END -->

            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- 分享弹出结束 -->

    <div class="cancel-shoucan">
        <div>取消收藏后将无法在我的收藏找到TA啦··</div>
        <div class="j-yes yes t-line">取消收藏</div>
        <div class="j-cancel t-line">容朕想想</div>
    </div>
    <!-- 弹出层 -->

    <div class="close-flippedout j-flippedout-close" rel="1">
        <i class="iconfont">&#xe635;</i>
    </div>
</div>

<!-- 导航下拉结束 -->


    <header class="bar bar-nav m-head-nav">
        <?php if ($this->_var['page_finsh']): ?>
        <a class="header-btn header-left iconfont" href="javascript:App.page_finsh();" >&#xe604;</a>
        <?php else: ?>
        <a class="header-btn header-left iconfont back" href="" data-no-cache="true">&#xe604;</a>
        <?php endif; ?>
        <i class="header-btn header-right iconfont j-opendropdowm">&#xe624;</i>
        <?php if ($this->_var['data']['buy_type'] == 0): ?>
        <i class="header-btn header-right iconfont j-app-share-btn" data-title="<?php echo $this->_var['data']['share_title']; ?>" data-url="<?php echo $this->_var['data']['share_url']; ?>" data-img="<?php echo $this->_var['data']['share_img']; ?>" data-content="<?php echo $this->_var['data']['share_content']; ?>">&#xe60d;</i>
        <?php endif; ?>
        <div class="buttons-tab">

            <div class="tab-list" data-type="<?php echo $this->_var['data']['buy_type']; ?>">
                <a href="#tab1" rel="0" class="tab-link button j-tab-link active">商品</a>
                <?php if ($this->_var['data']['buy_type'] == 0): ?>
                <a href="#tab1" rel="1" class="tab-link button j-tab-2 j-tab-link">详情</a>
                <?php endif; ?>
                <a href="#tab3" rel="2" class="tab-link button j-tab-link">评价</a>
                
            </div>
        </div>
        <i class="tab-line"></i>
    </header>


<?php echo $this->fetch('style5.2/inc/module/pop-light-img.html'); ?>
<script type="text/javascript">
    init_share();
</script>
<?php else: ?>




<!-- 导航下拉开始 -->
<div class="flippedout">
    <div class="m-nav-dropdown">
        <div class="nav-dropdown-con">
            <div class="flex-box func-list">
                <div class="flex-1"><i class="iconfont j-dropdown-share">&#xe60d;</i></div>
                <div class="flex-1"><a class="header-reload" href="javascript:void(0);"><i class="iconfont">&#xe630;</i></a></div>
                <div class="flex-1 is_Sc j-head-collect" data-isdel="<?php if ($this->_var['data']['is_collect'] != 1): ?>0<?php else: ?>1<?php endif; ?>">
                    <?php if ($this->_var['data']['collect_count'] > 0): ?>
                    <div class="shoucan isSc">
                        <i class="iconfont <?php if ($this->_var['data']['is_collect'] == 1): ?>icon-noshoucan<?php endif; ?>">&#xe615;</i><?php if ($this->_var['data']['is_collect'] == 1): ?><i class="iconfont icon-shoucan">&#xe63d;</i><?php endif; ?><em><?php echo $this->_var['data']['collect_count']; ?></em>
                    </div>
                    <?php else: ?>
                    <i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $this->fetch('style5.2/inc/module/dropdown-navlist.html'); ?>
        </div>
    </div>

    <!-- 分享弹出 -->
    <div class="box_share" id="box_share">
        <div class="box_content">
            <div class="social_share">
                <!-- JiaThis Button BEGIN -->
                <div class="jiathis_style_32x32 flex-box">
                    <a class="jiathis_button_weixin flex-1"><i class="iconfont icon-pyq">&#xe636;</i><p>朋友圈</p></a>
                    <a class="jiathis_button_tsina flex-1"><i class="iconfont icon-sina">&#xe639;</i><p>新浪微博</p></a>
                    <a class="jiathis_button_qzone flex-1"><i class="iconfont icon-qzone">&#xe63a;</i><p>QQ空间</p></a>
                    <a class="jiathis_button_cqq flex-1"><i class="iconfont icon-QQ">&#xe63b;</i><p>QQ</p></a>
                </div>
                <script type="text/javascript">
                    var jiathis_config = {
                            sm:"weixin,tsina,qzone,cqq",
                            siteNum:4,
                    };
                </script>

            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- 分享弹出结束 -->

    <div class="cancel-shoucan">
        <div>取消收藏后将无法在我的收藏找到TA啦··</div>
        <div class="j-yes yes t-line">取消收藏</div>
        <div class="j-cancel t-line">容朕想想</div>
    </div>
    <!-- 弹出层 -->

    <div class="close-flippedout j-flippedout-close" rel="1">
        <i class="iconfont">&#xe635;</i>
    </div>
</div>
    <header class="bar bar-nav m-head-nav">
        <a class="header-btn header-left iconfont back" data-no-cache="true">&#xe604;</a>
        <i class="header-btn header-right iconfont j-opendropdowm">&#xe624;</i>
        <?php if ($this->_var['data']['buy_type'] == 0): ?>
        <i class="header-btn header-right iconfont j-openshare">&#xe60d;</i>
        <?php endif; ?>
        <div class="buttons-tab">
            <div class="tab-list" data-type="<?php echo $this->_var['data']['buy_type']; ?>">
                <a href="#tab1" rel="0" class="tab-link button j-tab-link active">商品</a>
                <?php if ($this->_var['data']['buy_type'] == 0): ?>
                <a href="#tab1" rel="1" class="tab-link button j-tab-2 j-tab-link">详情</a>
                <?php endif; ?>
                <a href="#tab3" rel="2" class="tab-link button j-tab-link">评价</a>
                
            </div>
        </div>
        <i class="tab-line"></i>
    </header>
    <?php echo $this->fetch('style5.2/inc/module/pop-light-img.html'); ?>
<?php endif; ?>