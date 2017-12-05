<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت بلیط</span>
	<a href="<?php echo base_url(); ?>index.php/panel">< بازگشت</a>
</div>

<div class="page_msg align-center">
	بلیط با مشخصات زیر صادر شد
</div>

<table>
	<tr>
		<td>نام مالک بلیط:</td>
		<td><?php echo $ticket_owner_name ?></td>
	</tr>
	
	<tr>
		<td>نام خانوادگی مالک بلیط:</td>
		<td><?php echo $ticket_owner_last_name ?></td>
	</tr>
	
	<tr>
		<td>پست الکترونیکی مالک بلیط:</td>
		<td><?php echo $ticket_owner_email ?></td>
	</tr>
	
	<tr>
		<td>مبدا:</td>
		<td><?php echo $ticket_origin ?> - <?php echo $ticket_origin_city ?></td>
	</tr>
	
	<tr>
		<td>مقصد:</td>
		<td><?php echo $ticket_destination ?> - <?php echo $ticket_destination_city ?></td>
	</tr>
	
	<tr>
		<td>تاریخ حرکت:</td>
		<td><?php echo $ticket_travel_date ?></td>
	</tr>
	
	<tr>
		<td>نام ثبت کننده:</td>
		<td><?php echo $ticket_registrant_name ?></td>
	</tr>
	
	<tr>
		<td>نام خانوادگی ثبت کننده:</td>
		<td><?php echo $ticket_registrant_last_name ?></td>
	</tr>
</table>