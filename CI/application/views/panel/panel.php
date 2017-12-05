<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page_header align-right">
	<span>تاریخچه سفر ها من</span>
</div>

<?php if(isset($my_tickets) && !is_array($my_tickets)): ?>
	<div class="page_errors align-center">
		<?php echo $my_tickets ?>
	</div>
<?php endif; ?>

<?php if(isset($my_tickets) && is_array($my_tickets)): ?>
	<table class="history_table">
		<thead>
			<tr>
				<td>نام مالک بلیط</td>
				<td>پست الکترونیکی مالک بلیط</td>
				<td>مبدا</td>
				<td>مقصد</td>
				<td>تاریخ حرکت</td>
				<td>تاریخ ثبت</td>
				<td>نام ثبت کننده</td>
			</tr>
		</thead>
		
		<tbody>
			<?php
				foreach($my_tickets as $ticket)
				{
					echo '<tr id="ticket_' . $ticket['id'] . '">';
					
					echo '<td>' . $ticket['ticket_owner'] . '</td>';
					echo '<td>' . $ticket['ticket_owner_email'] . '</td>';
					echo '<td>' . $ticket['ticket_origin'] . '-' . $ticket['ticket_origin_city'] . '</td>';
					echo '<td>' . $ticket['ticket_destination'] . '-' . $ticket['ticket_destination_city'] . '</td>';
					echo '<td>' . $ticket['ticket_date'] . '</td>';
					echo '<td>' . $ticket['ticket_issue_date'] . '</td>';
					echo '<td>' . $ticket['ticket_registrant'] . '</td>';
					
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
<?php endif; ?>


<!------------------------------------------------------>


<?php if($user_rank == 'is_owner'): ?>
	<div class="page_header align-right">
		<span>تاریخچه همه سفر ها</span>
	</div>
	
	<?php if(isset($tickets) && !is_array($tickets)): ?>
		<div class="page_errors align-center">
			<?php echo $tickets ?>
		</div>
	<?php endif; ?>

	<?php if(isset($tickets) && is_array($tickets)): ?>
		<table class="history_table">
			<thead>
				<tr>
					<td>نام مالک بلیط</td>
					<td>پست الکترونیکی مالک بلیط</td>
					<td>مبدا</td>
					<td>مقصد</td>
					<td>تاریخ حرکت</td>
					<td>تاریخ ثبت</td>
					<td>نام ثبت کننده</td>
				</tr>
			</thead>
			
			<tbody>
				<?php
					foreach($tickets as $ticket)
					{
						echo '<tr id="ticket_' . $ticket['id'] . '">';
						
						echo '<td>' . $ticket['ticket_owner'] . '</td>';
						echo '<td>' . $ticket['ticket_owner_email'] . '</td>';
						echo '<td>' . $ticket['ticket_origin'] . '-' . $ticket['ticket_origin_city'] . '</td>';
						echo '<td>' . $ticket['ticket_destination'] . '-' . $ticket['ticket_destination_city'] . '</td>';
						echo '<td>' . $ticket['ticket_date'] . '</td>';
						echo '<td>' . $ticket['ticket_issue_date'] . '</td>';
						echo '<td>' . $ticket['ticket_registrant'] . '</td>';
						
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>