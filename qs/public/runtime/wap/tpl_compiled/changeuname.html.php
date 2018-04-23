<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<script type="text/javascript">
    var AJAX_URL = '<?php
echo parse_url_tag("u:index|ajax|"."".""); 
?>';
</script>
<div class="page page-index" id="changeuname">
    <?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
    <div class="content">
        <div class="user-form" style="padding: 0 1.25rem">
            <form id="ph_getuname" action="<?php
echo parse_url_tag("u:index|user|"."".""); 
?>">
            <div class="phone-login">
                <ul class="form-list">
                    <li class="b-line">
                        <input type="text" name="user_name" class="form-text" placeholder="请输入昵称" value="<?php echo $this->_var['data']['user_info']['user_name']; ?>">
                    </li>
                </ul>
                <input type="hidden" name="act" value="dochangeuname" />
                <input type="button" value="确定" class="userBtn userBtn-yellow">
            </div>
            </form>
        </div>

    </div>
    
</div>


<?php echo $this->fetch('style5.2/inc/footer.html'); ?>