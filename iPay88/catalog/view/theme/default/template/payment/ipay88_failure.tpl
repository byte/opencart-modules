<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>" xml:lang="<?php echo $language; ?>">
<head>
<title>Payment Declined Page</title>
<base href="<?php echo $base; ?>" />
</head>
<body>
<div style="text-align: center;">
  <h2>Unfortunately !</h2>
  <h2>Your Transaction has Declined !</h2>
</div>
<script type="text/javascript"><!--
setTimeout('location = \'<?php echo $continue; ?>\';', 2500);
//--></script>
</body>
</html>