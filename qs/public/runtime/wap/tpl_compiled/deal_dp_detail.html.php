<div>
<div id="dp_list_click">
    <?php if ($this->_var['data']['dp_list']): ?>
    <div class="m-comment">
        <div class="comment-tit flex-box b-line">
            <p class="comment-count flex-1">评价( <?php echo $this->_var['data']['dp_count']; ?> )</p>
            <div class="star-box">
                <div class="m-start tit-start">
                    <div class="start-num" style="width: <?php echo $this->_var['data']['supplier_info']['avg_point_percent']; ?>%"></div>
                </div>
            </div>
            <p class="comment-num"><?php echo $this->_var['data']['supplier_info']['avg_point']; ?></p>
        </div>
        <!--单条点评数据-->
        <?php $_from = $this->_var['data']['dp_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'dp_item');$this->_foreach['dp_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dp_item']['total'] > 0):
    foreach ($_from AS $this->_var['dp_item']):
        $this->_foreach['dp_item']['iteration']++;
?>
        <?php if (($this->_foreach['dp_item']['iteration'] - 1) < 1): ?>
        <div class="comment-con">
            <div class="commenter flex-box">
                <img alt="用户头像" class="avatar" src="<?php echo $this->_var['dp_item']['user_avatar']; ?>" width="42">
                <p class="username"><?php echo $this->_var['dp_item']['user_name']; ?></p>
                <div class="m-start con-start">
                    <div class="start-num" style="width: <?php echo $this->_var['dp_item']['point_percent']; ?>%"></div>
                </div>
                <p class="date flex-1 tr"><?php echo $this->_var['dp_item']['format_show_date']; ?></p>
            </div>

            <div class="comment-txt">
                <?php echo $this->_var['dp_item']['content']; ?>
            </div>
            <?php if ($this->_var['dp_item']['images']): ?>
            <ul class="comment-imglist">
                <?php $_from = $this->_var['dp_item']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['dp_imgs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dp_imgs']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['dp_imgs']['iteration']++;
?>
                <?php if (($this->_foreach['dp_imgs']['iteration'] - 1) < 8): ?>
                <li class="comment-imgitem j-comment-item" data="<?php echo $this->_foreach['dp_imgs']['iteration']; ?>">
                    <img dfasf="<?php echo ($this->_foreach['dp_imgs']['iteration'] - 1); ?>" src="<?php echo $this->_var['img']; ?>" data-lingtsrc="<?php echo $this->_var['img']; ?>" width="65" alt="有图评论-1" />
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php if ($this->_var['data']['dp_count'] > 1): ?>
        <div class="more-comment">
            <a href="#tab3" class="tab-link showmorecomment j-detail" data="2" data-type="<?php echo $this->_var['data']['buy_type']; ?>">查看全部评价</a>
        </div>
        <?php endif; ?>
    </div>

    <?php endif; ?>
</div>
<div id="tab3" class="tab comment-list j-ajaxlist"  style="<?php if (! $this->_var['data']['dp_list']): ?>background:transparent;<?php endif; ?>">
    <div class="m-comment j-ajaxadd">
        <?php if ($this->_var['data']['dp_list']): ?>
        <div class="comment-tit flex-box b-line">
            <p class="comment-count flex-1">评价( <?php echo $this->_var['data']['dp_count']; ?> )</p>
            <div class="star-box">
                <div class="m-start tit-start">
                    <div class="start-num" style="width: <?php echo $this->_var['data']['supplier_info']['avg_point_percent']; ?>%"></div>
                </div>
            </div>
            <p class="comment-num"><?php echo $this->_var['data']['supplier_info']['avg_point']; ?></p>
        </div>
        <?php else: ?>
        <div class="tipimg no_data no_dp_data">
            暂无评价
        </div>
        <?php endif; ?>
        <?php $_from = $this->_var['data']['dp_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'dp_item');if (count($_from)):
    foreach ($_from AS $this->_var['dp_item']):
?>
        <div class="comment-con b-line">
            <div class="commenter flex-box">
                <img alt="用户头像" class="avatar" src="<?php echo $this->_var['dp_item']['user_avatar']; ?>" width="42">
                <p class="username"><?php echo $this->_var['dp_item']['user_name']; ?></p>
                <div class="m-start con-start">
                    <div class="start-num" style="width: <?php echo $this->_var['dp_item']['point_percent']; ?>%"></div>
                </div>
                <p class="date flex-1 tr"><?php echo $this->_var['dp_item']['format_show_date']; ?></p>
            </div>

            <div class="comment-txt">
                <?php echo $this->_var['dp_item']['content']; ?>
            </div>
            <?php if ($this->_var['dp_item']['images']): ?>
            <ul class="comment-imglist comment-imglist-nolimit">
                <?php $_from = $this->_var['dp_item']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['dp_imgs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dp_imgs']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['dp_imgs']['iteration']++;
?>
                <?php if (($this->_foreach['dp_imgs']['iteration'] - 1) < 8): ?>
                <li class="comment-imgitem j-comment-item" data="<?php echo $this->_foreach['dp_imgs']['iteration']; ?>">
                    <img dfasf="<?php echo ($this->_foreach['dp_imgs']['iteration'] - 1); ?>" src="<?php echo $this->_var['img']; ?>" data-lingtsrc="<?php echo $this->_var['img']; ?>" width="65" alt="有图评论-1" />
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <?php endif; ?>
            <?php if ($this->_var['dp_item']['reply_content']): ?>
            <div class="shop-reply">
                <div class="sjj-up"></div>
                <p><em>商家回复：</em><?php echo $this->_var['dp_item']['reply_content']; ?></p>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

    </div>
</div>
</div>