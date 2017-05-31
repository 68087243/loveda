<?php if (!defined('THINK_PATH')) exit();?>
<?php
 if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waiting...</title>
<script type="text/javascript" src="<?php echo '';?>/Public/Admin/js/jquery-1.4.4.min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo '';?>/Public/Admin/images/style.css" />
</head>
<body  class="ErrBody"> 
  
<table  border="0"  cellpadding="3" cellspacing="1" class="MainTbl ErrTbl" >
   
     <tr class="toolbar">
      <td class="tc">
 <?php if(isset($message)): ?><span class="face">:) </span>
<?php else: ?>
<span class="face">:( </span><?php endif; ?>
</td>
    </tr> 
     
    <tr class="row0">
    <td><?php if(isset($message)): ?><div class="success"><?php echo($message); ?></div>
<?php else: ?>

<div class="error"><?php echo($error); ?></div><?php endif; ?></td>
    </tr>
    
    <tr class="row0">
      <td class="ErrInfo"> 
<p class="jump">
  <a id="href" href="<?php echo($jumpUrl); ?>">Page automatically jump</a> Waiting： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
 </td>
    </tr> 
    <tr class="footer">
      <td class="tc"><input type="button" onclick="history.back()" class="btn1" value="Back" />
        </td>
    </tr> 
  </table>  
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>