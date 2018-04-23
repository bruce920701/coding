<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<style type="text/css">
    a.totop{
        bottom: 5.2rem;
    }
</style>
<div class="page page-index" id="uc_refund_list">
    <?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
    
    <div class="content infinite-scroll  infinite-scroll-bottom" style="background: #fff">
        <div class="blank5"></div>
        <?php if ($this->_var['data']['item']): ?>
        <div class="list-block m-cart j-ajaxlist">
            
            <div class="j-ajaxadd">
                <?php $_from = $this->_var['data']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <div class="m-conBox m-check-order m-modify refund_view" data-src="<?php
echo parse_url_tag("u:index|uc_order#refund_view|"."data_id=".$this->_var['item']['mid']."&did=".$this->_var['item']['id']."".""); 
?>">
                        <!--列表头部开始-->
                        <div class="m-title  item-content b-line">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title"><i class="iconfont u-shop-icon u-icon">&#xe616;</i><?php echo $this->_var['item']['supplier_name']; ?><i class="iconfont u-icon">&#xe607;</i></div>
                                </div>
                                <span class="refund_state"><?php echo $this->_var['item']['status_str']; ?></span>
                            </div>
                        </div>
                        <!--列表头部结束-->
                        <ul class="m-cart-list j-select-body">
                            <li class="item-content b-line">
                                <div class="item-inner">
                                    <div class="item-media shopImg">
                                        <img src="<?php echo $this->_var['item']['deal_icon']; ?>">
                                        <!-- <p class="u-surplus">仅剩3件</p> -->
                                    </div>
                                    <div class="z-opera z-opera-sure">
                                        <div class="item-subtitle shopTi">
                                            <a href="#"><?php echo $this->_var['item']['name']; ?></a>
                                            <?php if ($this->_var['item']['attr_str']): ?><p class="sizes"><?php echo $this->_var['item']['attr_str']; ?></p><?php endif; ?>
                                        </div>
                                        <div class="shop_price tr">
                                            <p class="u-sm-price"><span class="u-money">¥<i><?php echo $this->_var['item']['unit_price']; ?></i></span></p>
                                            <p class="shop-count">x<i><?php echo $this->_var['item']['number']; ?></i></p>
                                        </div>
                                    </div>

                                </div>
                            </li>
                        </ul>
                        <?php if ($this->_var['item']['refund_status'] == 2): ?>
						<div class="refund_money">
                            <p>退款金额：¥<?php echo $this->_var['item']['refund_money']; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="blank5"></div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
            <div class="pages hide"><?php echo $this->_var['pages']; ?></div>

        </div>
        <?php else: ?>
        <div class="tipimg no_data">
            暂无退款记录
        </div>
        <?php endif; ?>
    </div>


</div>

</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>

