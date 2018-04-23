
    <link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['pagecss'],
  'c' => $this->_var['cpagecss'],
);
echo $k['name']($k['v'],$k['c']);
?>" />
    <script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['pagejs'],
  'c' => $this->_var['cpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
    <script type="text/javascript" src="https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>
	

</head>
<body>
<div class="page-group">
<script>
$("head title").html('<?php echo $this->_var['data']['page_title']; ?>');
var back_url='<?php echo $this->_var['back_url']; ?>';
</script> 
<?php echo $this->fetch('style5.2/inc/wx_share.html'); ?>