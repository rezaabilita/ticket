<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت کاربر</span>
	<a href="<?php echo base_url(); ?>index.php/panel">< بازگشت</a>
</div>

<div class="page_msg align-center">
	کاربر با مشخصات زیر ساخته شد
</div>

<table>
	<tr>
		<td>نام:</td>
		<td><?php echo $first_name ?></td>
	</tr>
	
	<tr>
		<td>نام خانوادگی:</td>
		<td><?php echo $last_name ?></td>
	</tr>
	
	<tr>
		<td>پست الکترونیک:</td>
		<td><?php echo $email ?></td>
	</tr>
	
	<tr>
		<td>کلمه عبور:</td>
		<td><?php echo $password ?></td>
	</tr>
	
	<tr>
		<td>نقش:</td>
		<td><?php echo $role ?></td>
	</tr>
</table>