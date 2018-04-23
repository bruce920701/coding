<?php if ($this->_var['data']['ref_list']): ?>
<div class="m-promote">
    <em class="promote-tit"><i class="promote-icon"></i>为您推荐</em>
    <!-- <em class="promote-tit"><i class="promote-icon"></i>团购推荐</em> -->
</div>
<div class="m-goods-list">
    <ul class="type-cube clearfix"><!-- 豆腐块列表 -->
        <!-- 	<ul class="type-list clearfix">常规列表 -->
        <?php $_from = $this->_var['data']['ref_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'deal');if (count($_from)):
    foreach ($_from AS $this->_var['deal']):
?>
        <li>
            <a data-no-cache="true" href="<?php
echo parse_url_tag("u:index|deal|"."data_id=".$this->_var['deal']['id']."".""); 
?>">
            <div class="goods-img"><img alt="<?php echo $this->_var['deal']['name']; ?>" src="<?php echo $this->_var['deal']['f_icon']; ?>"/></div>
            <div class="goods-info">
                <h2 class="goods-name"><?php echo $this->_var['deal']['name']; ?></h2>
                <div class="sale-info">
                    <p class="price"><?php 
$k = array (
  'name' => 'format_price_html',
  'v' => $this->_var['deal']['current_price'],
);
echo $k['name']($k['v']);
?><del class="p-price"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['origin_price'],
);
echo $k['name']($k['v']);
?></del></p>
                    <?php if ($this->_var['deal']['buy_count'] > 0): ?>
                    <p class="sale">已售<?php echo $this->_var['deal']['buy_count']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            </a>
        </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
</div>
<?php endif; ?>