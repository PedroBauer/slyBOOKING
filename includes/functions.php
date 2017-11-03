<?php 

function print_booking_table($mode = "FUTURE") {
	GLOBAL $db;
	if ($mode == "FUTURE") {
		$query = "SELECT *,booking.id as bookingid  FROM booking LEFT JOIN room ON booking.room_id=room.ID JOIN user ON booking.user_id=user.ID WHERE booking.`date` >= CURDATE() ORDER BY booking.`date`";
	} else {
		$query = "SELECT *,booking.id as bookingid  FROM booking LEFT JOIN room ON booking.room_id=room.ID JOIN user ON booking.user_id=user.ID WHERE booking.`date` < CURDATE() ORDER BY booking.`date` DESC";
	}
	$db_query=mysqli_query($db,$query);
	if ( ! $db_query )
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	
?>
					<table class="order">
						<tr class="topRail">
							<th align="left">Nr.</th>
							<th align="left">Raum</th>
							<th align="left">Kunde</th>
							<th align="left">Datum</th>
							<th align="left">Tageszeit</th>
							<th align="left">Preis</th>
							<th align="left"></th>
							<th align="left"></th>
						</tr>
						<?php while($booking = mysqli_fetch_array($db_query, MYSQL_ASSOC)){
							if($booking['time_of_day']=='morning'){
								$bookingDaytime="Vormittag";
							}
							if($booking['time_of_day']=='afternoon'){
								$bookingDaytime="Abend";
							}
							if($booking['time_of_day']=='wholeDay'){
								$bookingDaytime="Ganzer Tag";
							}
						?>	
						<tr>
							<td class="orderInfo"><?php echo $booking['bookingid'];?></td>
							<td class="orderInfo"><?php echo $booking['name'];?></td>
							<td class="orderInfo"><?php echo $booking['first_name']." ".$booking['last_name'];?></td>
							<td class="orderInfo"><?php echo date('d.m.Y',strtotime($booking['date']));?></td>
							<td class="orderInfo"><?php echo $bookingDaytime;?></td>
							<td class="orderInfo"><?php echo $booking['price'];?> CHF</td>
							<?php if($booking['cancel']==0){?>
							<td class="orderInfoOverview"><a href="bookingOverview.php?bookingid=<?php echo $booking['bookingid'];?>"><div id="uebersicht">&Uuml;bersicht</div></a></td>
							<td class="orderInfoDelete"><a href="index.php?bookingid=<?php echo $booking['bookingid'];?>"><div id="delete">Stornieren</div></a></td>
							<?php }else{?>
							<td class="orderInfoDelete"><div id="delete">STORNIERT!!!</div></td>
							<?php }?>
						</tr>
						<?php } ?>
					</table>
<?php }?>