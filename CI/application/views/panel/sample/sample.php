<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت سمپل</span>
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
		
		<tr class="align-left">
			<td></td>
			<td><input type="submit" value="ثبت سمپل"></td>
		</tr>
	</table>
</form>

<div class="page_header align-right">
	<span>همه سمپل ها</span>
</div>

<?php if(isset($samples) && !is_array($samples)): ?>
	<div class="page_errors align-center">
		<?php echo $samples ?>
	</div>
<?php endif; ?>
<?php if(isset($samples) && is_array($samples)): ?>
	<table class="history_table">
		<thead>
			<tr>
				<td>نام</td>
				<td>نام خانوادگی</td>
			</tr>
		</thead>
		
		<tbody>
			<?php
				foreach($samples as $sample)
				{
					echo '<tr id="sample_' . $sample['id'] . '">';
					
					echo '<td>' . $ticket['name'] . '</td>';
					echo '<td>' . $ticket['family'] . '</td>';
					
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
<?php endif; ?>