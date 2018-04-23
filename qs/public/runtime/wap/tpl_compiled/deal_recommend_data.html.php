<div id="recommend_data">
<?php if ($this->_var['data']['recommend_data']): ?>
    <div class="m-promote">
        <em class="promote-tit">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-tuijian"></use>
        </svg><?php if ($this->_var['data']['is_shop'] == 1): ?>推荐商品<?php else: ?>推荐团购<?php endif; ?></em>
    </div>
    <?php if ($this->_var['data']['is_shop'] == 1): ?>
    <div class="m-goods-list">

        <!-- 商品列表 -->
        <ul class="type-cube clearfix"><!-- 豆腐块列表 -->
            <?php $_from = $this->_var['data']['recommend_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 're_item');if (count($_from)):
    foreach ($_from AS $this->_var['re_item']):
?>
            <li>
                <a href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['re_item']['id']."".""); 
?>">
                <div class="goods-img"><img alt="" src="<?php echo $this->_var['re_item']['f_icon']; ?>"/></div>
                <div class="goods-info">
                    <h2 class="goods-name"><?php echo $this->_var['re_item']['name']; ?></h2>
                    <div class="sale-info">
						<p class="price"><span>&yen;</span><?php echo $this->_var['re_item']['f_current_price_arr']['0']; ?>.<span><?php echo $this->_var['re_item']['f_current_price_arr']['1']; ?></span><del class="p-price"><?php echo $this->_var['re_item']['f_origin_price']; ?></del></p>
                        <?php if ($this->_var['re_item']['buy_count']): ?>
                        <p class="sale" style="display:block;">已售<?php echo $this->_var['re_item']['buy_count']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                </a>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <?php else: ?>
    <!-- 团购列表 -->
    <div class="m-goods-list m-tuan-list">
        <ul class="type-cube clearfix"><!-- 豆腐块列表 -->
            <?php $_from = $this->_var['data']['recommend_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 're_item');if (count($_from)):
    foreach ($_from AS $this->_var['re_item']):
?>
            <li>
                <a href="<?php
echo parse_url_tag("u:index|deal#index|"."data_id=".$this->_var['re_item']['id']."".""); 
?>">
                <div class="goods-img">
                    <img alt="" src="<?php echo $this->_var['re_item']['f_icon']; ?>"/>
                </div>

                <div class="goods-info">
                    <div class="tuan-name"><h2><?php echo $this->_var['re_item']['sub_name']; ?></h2><p class="distance"><?php echo $this->_var['re_item']['distance']; ?></p></div>
                    <p class="tuan-tip"><?php echo $this->_var['re_item']['brief']; ?></p>
                    <div class="sale-info">
                        <p class="price"><span>&yen;</span> <?php echo $this->_var['re_item']['f_current_price_arr']['0']; ?>.<span><?php echo $this->_var['re_item']['f_current_price_arr']['1']; ?></span><del class="p-price"><?php echo $this->_var['re_item']['f_origin_price']; ?></del></p>
                        <p class="sale"><?php if ($this->_var['re_item']['buy_count']): ?>已售<?php echo $this->_var['re_item']['buy_count']; ?><?php endif; ?></p>
                    </div>
                </div>
                </a>
            </li>

            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <?php endif; ?>
<?php endif; ?>
</div>