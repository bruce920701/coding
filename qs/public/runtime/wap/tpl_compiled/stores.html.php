<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>

<div class="page page-current" id="stores">
<script>
var geo_url='<?php
echo parse_url_tag("u:index|userxypoint#do_position|"."".""); 
?>';
var html_id='stores';
var ctl_name='<?php echo $this->_var['MODULE_NAME']; ?>';
var address='<?php echo $this->_var['address']; ?>';
var key = '<?php echo $this->_var['keyword']; ?>';
var TENCENT_MAP_APPKEY="<?php echo app_conf("TENCENT_MAP_APPKEY"); ?>";
</script>
 	  <?php echo $this->fetch('style5.2/inc/module/search_header.html'); ?>
  	<div class="content infinite-scroll infinite-scroll-bottom">
   		<!-- 页面主体 -->
        <div class="m-screen-bar b-line flex-box" data-type="<?php echo $this->_var['param']['order_type']; ?>">
          <ul class="flex-box flex-1">
            <li class="screen-item">
              <a class="screen-all" href="javascript:void(0)" data-id="<?php echo $this->_var['default_cate_id']; ?>">
                <p><?php if ($this->_var['request']['catename']): ?><?php echo $this->_var['request']['catename']; ?><?php else: ?>全部分类 <?php endif; ?></p><i class="iconfont arrow-down">&#xe608;</i><i class="iconfont arrow-up">&#xe606;</i>
              </a>
            </li>
            <li class="screen-item">
              <a class="screen-area" href="javascript:void(0)" data-id="<?php echo $this->_var['default_qid']; ?>">
                <p><?php if ($this->_var['request']['quanname']): ?><?php echo $this->_var['request']['quanname']; ?><?php else: ?>全城 <?php endif; ?></p><i class="iconfont arrow-down">&#xe608;</i><i class="iconfont arrow-up">&#xe606;</i>
              </a>
            </li>
            <li class="screen-item j-zj">
              <a data-type="distance" class="screen-link j-listchoose <?php if ($this->_var['request']['order_type'] == 'distance'): ?>active<?php endif; ?>" date-href="<?php echo $this->_var['data']['navs']['distance']['url']; ?>" href="javascript:void(0);">
                <p>距离</p>
              </a>
            </li>
            <li class="screen-item j-zx">
              <a data-type="newest" class="screen-link j-listchoose <?php if ($this->_var['request']['order_type'] == 'newest'): ?>active<?php endif; ?>" date-href="<?php echo $this->_var['data']['navs']['newest']['url']; ?>" href="javascript:void(0);">
                <p>最新</p>
              </a>
            </li>
            <li class="screen-item j-pj">
              <a data-type="avg_point" class="screen-link j-listchoose <?php if ($this->_var['request']['order_type'] == 'avg_point'): ?>active<?php endif; ?>" date-href="<?php echo $this->_var['data']['navs']['avg_point']['url']; ?>" href="javascript:void(0);">
                <p>评分</p>
              </a>
            </li>
          </ul>
        </div>
        <div class="m-screen-list">
          <div class="all-screen" id="all-goods">
            <ul class="goods-type r-line">
              <?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['goods-type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods-type']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['goods-type']['iteration']++;
?>
              <?php if ($this->_var['cate']['bcate_type']['0']['count'] > 0): ?>
              <li class="b-line" data-id="<?php echo ($this->_foreach['goods-type']['iteration'] - 1); ?>" ><?php echo $this->_var['cate']['name']; ?></li>
              <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <div class="type-detail flex-1">
            <?php $_from = $this->_var['data']['bcate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');$this->_foreach['goods-type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods-type']['total'] > 0):
    foreach ($_from AS $this->_var['cate']):
        $this->_foreach['goods-type']['iteration']++;
?>
              
              <ul data-id="<?php echo ($this->_foreach['goods-type']['iteration'] - 1); ?>">
              <?php $_from = $this->_var['cate']['bcate_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'blist');if (count($_from)):
    foreach ($_from AS $this->_var['blist']):
?>
                <?php if ($this->_var['blist']['count'] > 0): ?>
                <li class="j-listchoose flex-box <?php if ($this->_var['blist']['id'] == $this->_var['request']['tid'] && $this->_var['cate']['id'] == $this->_var['request']['cate_id']): ?>active<?php endif; ?>" data-cid="<?php echo $this->_var['cate']['id']; ?>" data-tid="<?php echo $this->_var['blist']['id']; ?>">
                  <p class="flex-1"><?php echo $this->_var['blist']['name']; ?></p>
                    <p class="goods-num"><?php echo $this->_var['blist']['count']; ?></p>
                </li>
                <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </ul>
              
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
          </div>
          <div class="all-screen" id="area-screen">
            <ul class="goods-type r-line">
              <?php $_from = $this->_var['data']['quan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'quan');$this->_foreach['quan_num'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['quan_num']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['quan']):
        $this->_foreach['quan_num']['iteration']++;
?>
                <li class="b-line" data-id="<?php echo ($this->_foreach['quan_num']['iteration'] - 1); ?>"><?php echo $this->_var['quan']['name']; ?></li>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <div class="type-detail flex-1">
            <?php $_from = $this->_var['data']['quan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'quan');$this->_foreach['quan_num'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['quan_num']['total'] > 0):
    foreach ($_from AS $this->_var['quan']):
        $this->_foreach['quan_num']['iteration']++;
?>
              <ul data-id="<?php echo ($this->_foreach['quan_num']['iteration'] - 1); ?>">
              <?php $_from = $this->_var['quan']['quan_sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'qlist');if (count($_from)):
    foreach ($_from AS $this->_var['qlist']):
?>
                <?php if ($this->_var['qlist']['count'] > 0): ?>
                <li class="j-listchoose flex-box <?php if ($this->_var['qlist']['id'] == $this->_var['request']['qid']): ?>active<?php endif; ?>" data-qid="<?php echo $this->_var['qlist']['id']; ?>"><p class="flex-1"><?php echo $this->_var['qlist']['name']; ?></p><p class="goods-num"><?php echo $this->_var['qlist']['count']; ?></p></li>
                <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </ul>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
          </div>
        </div>
        <div class="address-info flex-box">
          <p class="flex-1 address"><i class="iconfont">&#xe62f;</i><?php echo $this->_var['geo']['address']; ?></p><i class="iconfont refresh">&#xe630;</i>
        </div>
        <?php if ($this->_var['data']['item']): ?>
        <div class="m-stores-list j-ajaxlist">
          <ul class="j-ajaxadd">
          <?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store');if (count($_from)):
    foreach ($_from AS $this->_var['store']):
?>
            <li class="stores-item">
              <a href="<?php
echo parse_url_tag("u:index|store#index|"."data_id=".$this->_var['store']['id']."".""); 
?>" class="store-detail flex-box" data-no-cache="true">
                <div class="store-img"><img alt="" date-load="1" data-src="<?php echo $this->_var['store']['preview']; ?>" src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/loading/no-image.png"/></div>
                <div class="store-info flex-1">
                  <div class="store-tit flex-box">
                    <h2><?php echo $this->_var['store']['name']; ?></h2>
                    <?php if ($this->_var['store']['is_verify'] == 1): ?>
                      <div class="store-tip flex-box"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/renzheng.png" alt="认证"></div>
                    <?php endif; ?>
                    <?php if ($this->_var['store']['open_store_payment'] == "1"): ?>
                      <div class="store-tip flex-box"><img src="<?php echo $this->_var['TMPL']; ?>/style5.2/images/static/maidan.png" alt="买单"></div>
                    <?php endif; ?>
                  </div>
                  <?php if ($this->_var['store']['avg_point'] == 0): ?>
                    <div class="no-point">暂无评分</div>
                  <?php else: ?>
                    <div class="store-star flex-box" data="<?php echo $this->_var['store']['format_point']; ?>">
                      <?php echo $this->fetch('style5.2/inc/unit/start.html'); ?>
                      
                        <p class="point"><?php echo $this->_var['store']['avg_point']; ?></p>
                      
                    </div>
                  <?php endif; ?>
                  <div class="store-other flex-box">
                    <p class="store-type"><?php echo $this->_var['store']['store_type']; ?></p>
                    <p class="address-quan flex-1"><?php echo $this->_var['store']['quan_name']; ?></p>
                    <?php if ($this->_var['store']['distance']): ?>
                      <!-- 没有定位坐标不显示 -->
                      &nbsp;&nbsp;<p class="distance"><?php echo $this->_var['store']['distance']; ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </a>
              <?php if ($this->_var['store']['open_store_payment'] == "1"): ?>
                
                <a href="<?php echo $this->_var['store']['promote_url']; ?>" class="youhui flex-box t-line">
                  <div class="flex-box youhui-tip"><i class="iconfont">&#xe8b7;</i>优惠买单</div>
                  <p class="flex-1"><?php if ($this->_var['store']['promote_info']): ?><?php echo $this->_var['store']['promote_info']; ?><?php endif; ?></p>
                  <i class="iconfont">&#xe607;</i>
                </a>
                
              <?php endif; ?>
            </li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </ul>
          <div class="pages hide"><?php echo $this->_var['pages']; ?></div>
        </div>
        <?php else: ?>
        <div class="tipimg no_data">暂无详情</div>
        <?php endif; ?>
         <div class="blank"></div>
  	</div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>
