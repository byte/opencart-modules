<?php

echo '<p><a href="http://www.ipay88.com" target="New"><img src="./admin/view/image/payment/ipay88.png" alt="iPay88" title="iPay88" style="border: 1px solid #EEEEEE;" /></a></p>';
echo '<p><b>'."Please note that your Payment is processed by Mobile88.com Sdn Bhd. The Name of Mobile88.com will be shown on your Credit Card / Bank Statement and you will also receive a notification e-mail from Mobile88 on this Transaction.".'</p></b>';

?>




<form action="<?php echo $action; ?>" method="post" id="checkout">
	<input type="hidden" name="MerchantCode" value="<?php echo $MerchantCode; ?>" />	
	<input type="hidden" name="RefNo" value="<?php echo $RefNo; ?>" />
	<input type="hidden" name="Amount" value="<?php echo $Amount; ?>" />
	<input type="hidden" name="Currency" value="<?php echo $Currency; ?>" />
	<input type="hidden" name="ProdDesc" value="<?php echo $ProdDesc; ?>" />
	<input type="hidden" name="UserName" value="<?php echo $UserName; ?>" />
	<input type="hidden" name="UserEmail" value="<?php echo $UserEmail; ?>" />
	<input type="hidden" name="UserContact" value="<?php echo $UserContact; ?>" />
	<input type="hidden" name="Remark" value="<?php echo $Remark; ?>" />
	<input type="hidden" name="Lang" value="<?php echo $Lang; ?>" />
	<input type="hidden" name="Signature" value="<?php echo $Signature; ?>" />
 </form>

 <div class="buttons">
  <table>
    <tr>
      <td align="left"><a onclick="location='<?php echo $back; ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
      <td align="right"><a onclick="$('#checkout').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></td>
    </tr>

  </table>
</div>
