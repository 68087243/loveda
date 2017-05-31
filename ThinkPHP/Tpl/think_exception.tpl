<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>System error.</title>
<script type="text/javascript" src="<?php echo __ROOT__;?>/Public/Admin/js/jquery-1.4.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo __ROOT__;?>/Public/Admin/images/style.css" />
</head>
<body class="ErrBody">
<table  border="0"  cellpadding="3" cellspacing="1" class="MainTbl ErrTbl" >
  <tr class="toolbar">
    <td class="tc"><span class="face">:( </span></td>
  </tr>
  <tr class="row0">
    <td><div class="error"><?php echo strip_tags($e['message']);?></div></td>
  </tr> <?php if(isset($e['file'])) {?>
  <tr class="row0">
    <td class="ErrInfo"><div class="content">
        <?php if(isset($e['file'])) {?>
        <div class="info">
          <div class="title">
            <h3>Location</h3>
          </div>
          <div class="text">
            <p>FILE: <?php echo $e['file'] ;?> &#12288;LINE: <?php echo $e['line'];?></p>
          </div>
        </div>
        <?php }?>
        <?php if(isset($e['trace'])) {?>
        <div class="info">
          <div class="title">
            <h3>TRACE</h3>
          </div>
          <div class="text">
            <p><?php echo nl2br($e['trace']);?></p>
          </div>
        </div>
        <?php }?>
      </div></td>
  </tr>
        <?php }?>
  <tr class="footer">
    <td class="tc"><input type="button" onclick="history.back()" class="btn1" value="返回" /></td>
  </tr>
</table>
</body>
</html>
</html>
