<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script>
$(document).ready(function() {
	init_list_scroll_bottom();//下拉刷新加载
});
</script>
<div class="page page-current" id="uc_score">
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
  <div class="content infinite-scroll infinite-scroll-bottom">
  		<!-- 页面主体 -->
  		<div class="score-now flex-box">
        <div class="score-box"   <?php if ($this->_var['SCORE_RECHARGE_SWITCH']): ?> style="width: 50%;"<?php endif; ?>>
          <p class="score-tip">可用积分</p>
          <p class="score-num"><?php echo $this->_var['user_info']['user_score']; ?></p>
        </div>
        <?php if ($this->_var['SCORE_RECHARGE_SWITCH']): ?>
            <div class="score-box" style="width: 50%;">
                <p class="score-tip">冻结积分</p>
                <p class="score-num"><?php echo $this->_var['user_info']['frozen_score']; ?></p>
            </div>
        <?php endif; ?>
      </div>
      <div class="score-list j-ajaxlist">
        <?php if ($this->_var['list']): ?>
        <ul class="j-ajaxadd">
          <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['list']):
?>
          <li class="b-line flex-box">
            <div class="score-info">
              <p class="goods-name"><?php echo $this->_var['list']['log_info']; ?></p>
              <p class="time"><?php echo $this->_var['list']['flog_time']; ?></p>
            </div>
            <?php if ($this->_var['list']['score'] > 0): ?>
            <p class="score-num add flex-1">+<?php echo $this->_var['list']['score']; ?></p>
            <?php elseif ($this->_var['list']['frozen_score'] != 0): ?>
              <?php if ($this->_var['list']['frozen_score'] > 0): ?>
                <p class="score-num add flex-1">+<?php echo $this->_var['list']['frozen_score']; ?></p>
              <?php else: ?>
                <p class="score-num min flex-1"><?php echo $this->_var['list']['frozen_score']; ?></p>
              <?php endif; ?>
            <?php else: ?>
            <p class="score-num min flex-1"><?php echo $this->_var['list']['score']; ?></p>
            <?php endif; ?>
          </li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <?php else: ?>
        <div class="tipimg no_data">暂无数据</div>
        <?php endif; ?>
        <div class="pages hide"><?php echo $this->_var['pages']; ?></div>
      </div>
  </div>
</div>
<?php echo $this->fetch('style5.2/inc/footer.html'); ?>