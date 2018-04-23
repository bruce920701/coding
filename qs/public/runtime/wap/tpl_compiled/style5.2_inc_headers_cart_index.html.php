<?php if ($this->_var['app_index'] == 'app'): ?>
<header class="bar bar-nav b-line">
    <?php if ($this->_var['page_finsh']): ?>
    <a class="header-btn header-left iconfont" href="javascript:App.page_finsh();" >&#xe604;</a>
    <?php else: ?>
    <a class="header-btn header-left iconfont back">&#xe604;</a>
    <?php endif; ?>
    <h1 class="header-title">购物车</h1>
    <?php if ($this->_var['data']['cart_list']): ?><span class="header-right active header-txt j-edit-all">编辑全部</span><?php endif; ?>
</header>
<?php else: ?>
<header class="bar bar-nav b-line">
    <a class="header-btn header-left iconfont back">&#xe604;</a>
    <h1 class="header-title">购物车</h1>
    <?php if ($this->_var['data']['cart_list']): ?><span class="header-right active header-txt j-edit-all">编辑全部</span><?php endif; ?>
</header>
<?php endif; ?>