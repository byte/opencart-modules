<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('view/image/module.png');"><?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
	<?php foreach ($languages as $language) { ?>
	<tr> 
	<td><?php echo $entry_title; ?></td> 
	  <td> 
	    <input type="text" name="mymodule_title<?php echo $language['language_id']; ?>" id="mymodule_title<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'mymodule_title' . $language['language_id']}; ?>" />
	    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
     	  </td>
	</tr>
	<?php } ?> 
	<tr> 
	  <td><?php echo $entry_header; ?></td> 
	  <td> 
	    <?php 
		if($mymodule_header) { 
		   $checked1 = ' checked="checked"'; 
		   $checked0 = ''; 
		}else{ 
		   $checked1 = ''; 
		   $checked0 = ' checked="checked"'; 
	    } ?> 
		<label for="mymodule_header_1"><?php echo $entry_yes; ?></label> 
		<input type="radio"<?php echo $checked1; ?> id="mymodule_header_1" name="mymodule_header" value="1" /> 
		<label for="mymodule_header_0"><?php echo $entry_no; ?></label> 
		<input type="radio"<?php echo $checked0; ?> id="mymodule_header_0" name="mymodule_header" value="0" /> 
	  </td> 
	</tr>
	<?php foreach ($languages as $language) { ?> 
        <tr>
	  <td><?php echo $entry_code; ?></td>
          <td><textarea name="mymodule_code<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'mymodule_code' . $language['language_id']}) ? ${'mymodule_code' . $language['language_id']} : ''; ?></textarea>
	<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
          </td>
        </tr>
	<?php } ?>
        <tr>
          <td><?php echo $entry_position; ?></td>
          <td><select name="mymodule_position">
              <?php if ($mymodule_position == 'left') { ?>
              <option value="left" selected="selected"><?php echo $text_left; ?></option>
              <?php } else { ?>
              <option value="left"><?php echo $text_left; ?></option>
              <?php } ?>
              <?php if ($mymodule_position == 'right') { ?>
              <option value="right" selected="selected"><?php echo $text_right; ?></option>
              <?php } else { ?>
              <option value="right"><?php echo $text_right; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="mymodule_status">
              <?php if ($mymodule_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td><?php echo $entry_sort_order; ?></td>
          <td><input type="text" name="mymodule_sort_order" value="<?php echo $mymodule_sort_order; ?>" size="1" /></td>
        </tr>
      </table>
    </form>
  </div>
	<div style="text-align:center; color:#666666;"> 
		Simple HTML Module v<?php echo $mymodule_version; ?> 
	</div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('mymodule_code<?php echo $language['language_id']; ?>');
<?php } ?>
//--></script>
<?php echo $footer; ?>
