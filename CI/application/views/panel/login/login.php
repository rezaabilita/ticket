<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ورود</span>
</div>

<?php if(validation_errors()): ?>
	<div class="validation_errors align-center">
		<?php echo validation_errors() ?>
	</div>
<?php endif; ?>

<?php if(isset($error)): ?>
	<div class="page_errors align-center">
		<?php echo $error ?>
	</div>
<?php endif; ?>

<?php echo form_open() ?>
	<table>
		<tr>
			<td><label for="email">پست الکترونیک</label></td>
			<td><input type="text" id="email" name="email" placeholder="پست الکترونیکی خود را وارد کنید"></td>
		</tr>
		
		<tr>
			<td><label for="password">کلمه عبور</label></td>
			<td><input type="password" id="password" name="password" placeholder="کلمه عبور خود را وارد کنید"></td>
		</tr>
		
		<tr class="align-left">
			<td></td>
			<td><input type="submit" value="ورود"></td>
		</tr>
	</table>
</form>