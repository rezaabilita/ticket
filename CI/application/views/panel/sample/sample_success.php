<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت سمپل</span>
	<a href="<?php echo base_url(); ?>index.php/panel/sample">< بازگشت</a>
</div>

<div class="page_msg align-center">
	سمپل با مشخصات زیر ساخته شد
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
</table>