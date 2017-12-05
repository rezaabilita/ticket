<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت کاربر</span>
	<a href="<?php echo base_url(); ?>index.php/panel">< بازگشت</a>
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
			<td><label for="first_name">نام</label></td>
			<td><input type="text" id="first_name" name="first_name" placeholder="نام"></td>
		</tr>
		
		<tr>
			<td><label for="last_name">نام خانوادگی</label></td>
			<td><input type="text" id="last_name" name="last_name" placeholder="نام خانوادگی"></td>
		</tr>
		
		<tr>
			<td><label for="email">پست الکترونیک</label></td>
			<td><input type="text" id="email" name="email" placeholder="پست الکترونیک"></td>
		</tr>
		
		<tr>
			<td><label for="password">کلمه عبور</label></td>
			<td><input type="password" id="password" name="password" placeholder="کلمه عبور"></td>
		</tr>
		
		<tr>
			<td><label for="password2">تکرار کلمه عبور</label></td>
			<td><input type="password" id="password2" name="password2" placeholder="تکرار کلمه عبور"></td>
		</tr>
		
		<tr>
			<td><label for="role">نقش</label></td>
			<td>
				<select id="role" name="role">
					<option value="1" selected>کاربر</option>
					<option value="5">مدیر</option>
				</select>
			</td>
		</tr>
		
		<tr class="align-left">
			<td></td>
			<td><input type="submit" value="ثبت نام"></td>
		</tr>
	</table>
</form>