<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
    var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
</script>
<div class="page page-index" id="changepassword">
    <?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
    <div class="content">

        <div class="user-form" style="padding: 0 1.25rem">
            <form id="ph_getpassword" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
            <div class="phone-login">
                <ul class="form-list">
                    <li class="b-line flex-box">
                        <i class="iconfont">&#xe660;</i>
                        <input type="tel" name="format_mobile" class="form-text flex-1 phonenumer" placeholder="请输入手机号码" <?php if ($this->_var['user_info']['mobile']): ?>value="<?php echo $this->_var['user_info']['format_mobile']; ?>" readonly <?php endif; ?>>
                    </li>
                    <li class="b-line flex-box">
                        <i class="iconfont">&#xe661;</i>
                        <input type="number" name="sms_verify" class="form-text flex-1" placeholder="请输入手机验证码">
                        <input type="button" id="btn"  unique="2" lesstime="<?php echo $this->_var['sms_lesstime']; ?>" class="sendBtn noUseful  j-sendBtn" value="发送验证码">
                    </li>
                    <li class="b-line flex-box">
                        <i class="iconfont">&#xe662;</i>
                        <input type="password" name="user_pwd" class="form-text flex-1" placeholder="请输入新密码">
                    </li>
                </ul>
                <input type="hidden" name="user_mobile" id="phonenumer" value="<?php echo $this->_var['user_info']['mobile']; ?>">
                <input type="hidden" name="act" value="dochangepassword" />
                <input type="button" value="确定" class="userBtn userBtn-yellow">
            </div>
            </form>
        </div>

    </div>

    <?php echo $this->fetch('style5.2/inc/module/sms_verify_code.html'); ?>

</div>


<?php echo $this->fetch('style5.2/inc/footer.html'); ?>