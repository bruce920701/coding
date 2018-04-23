
<?php echo $this->fetch('style5.2/inc/header1.html'); ?>
<?php echo $this->fetch('style5.2/inc/header2.html'); ?>
<div class="page page-index page-current" id="nodata">
<script>
	<?php if ($this->_var['suijump']): ?>
    <?php echo $this->_var['suijump']; ?>
    <?php endif; ?>
</script>
<?php echo $this->fetch('style5.2/inc/auto_header.html'); ?>
<div class="content">

<div class="tipimg no_data"></div>

</div>
</div>

<?php echo $this->fetch('style5.2/inc/footer.html'); ?>