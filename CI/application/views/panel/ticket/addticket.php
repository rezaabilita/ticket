<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>ثبت بلیط</span>
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
			<td><label for="ticket_owner">مالک بلیط</label></td>
			<td><input type="text" id="ticket_owner" name="ticket_owner" placeholder="آدرس ایمیل صاحب بلیط"></td>
		</tr>
		
		<tr class="form_custom_row">
			<td><label for="ticket_origin">مبدا</label></td>
			<td>
				<select id="ticket_origin" name="ticket_origin">
					<?php
					foreach($provinces as $key => $value)
						echo '<option value='. $key .'>' . $value . '</option>';
					?>
				</select>
				
				<?php
				foreach($provinces as $key => $value)
				{
					echo '<select id="ticket_origin_city_'. $key .'" class="origin_city" style="display:none">';
					
					foreach($cities[$key] as $key1 => $value1)
						echo '<option value='. $key1 .'>' . $value1 . '</option>';
					
					echo '</select>';
				}
				?>
			</td>
		</tr>
		
		<tr class="form_custom_row">
			<td><label for="ticket_destination">مقصد</label></td>
			<td>
				<select id="ticket_destination" name="ticket_destination">
					<?php
					foreach($provinces as $key => $value)
						echo '<option value='. $key .'>' . $value . '</option>';
					?>
				</select>
				
				<?php
				foreach($provinces as $key => $value)
				{
					echo '<select id="ticket_destination_city_'. $key .'" class="destination_city" style="display:none">';
					
					foreach($cities[$key] as $key1 => $value1)
						echo '<option value='. $key1 .'>' . $value1 . '</option>';
					
					echo '</select>';
				}
				?>
			</td>
		</tr>
		
		<tr>
			<td><label for="travel_date">تاریخ حرکت</label></td>
			<td><input type="date" name="travel_date"></td>
		</tr>
		
		<tr class="align-left">
			<td></td>
			<td><input type="submit" value="ثبت بلیط"></td>
		</tr>
	</table>	
</form>

<script>
	$('.origin_city:first').attr('name', 'ticket_origin_city').show();
	
	$('#ticket_origin').on('change', function() {
		var province = this.value;
		$('.origin_city').removeAttr('name').hide();
		$('#ticket_origin_city_' + province).attr('name', 'ticket_origin_city').show();
	});
	
	/*-----------*/
	
	$('.destination_city:first').attr('name', 'ticket_destination_city').show();
	
	$('#ticket_destination').on('change', function() {
		var province = this.value;
		$('.destination_city').removeAttr('name').hide();
		$('#ticket_destination_city_' + province).attr('name', 'ticket_destination_city').show();
	});
</script>