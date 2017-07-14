<?php

function calendar30_callback(){
	global $wpdb;
	if (isset($_REQUEST['method'])) 
	{
		$val = intval($_POST['empId']);
		$cservice = intval($_POST['cservice']);
		$month = intval($_POST['cmonth']);
		$day = intval($_POST['cday']);
		$year = intval($_POST['cyear']);
		emptimings($val, $day, $month, $year, $cservice);
	}
	else
	{ 
		if (isset($_POST['years'])) 
		{
			$calendar = "";
			$val = intval($_POST['empId']);
			$month = intval($_POST['cmonth']);
			$day = intval($_POST['cday']);
			$year = intval($_POST['cyear']);
			$cservice = intval($_POST['cservice']);
			draw_calendar($month, $year, $val, $cservice);
			emptimings($val, $day, $month, $year, $cservice);
			echo $val .  $day .  $month . $year .  $cservice;
		}
		else 
		{
			echo draw_calendar(intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), intval($_REQUEST['empId']), intval($_POST['cservice']));
		}
	}
	die;
}
function draw_calendar($month, $year, $val, $cservice) {

	/* draw table */
	$calendar = '<table cellpadding="0"  cellspacing="0" class="calendar-front" >';
	/* table headings */
	$headings = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	$calendar .= '<tr class="calendar-front-row "><td class="calendar-front-day-head">' . implode('</td><td class="calendar-front-day-head">', $headings) . '</td></tr>';
	/* days and weeks vars now ... */
	$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
	$days_in_this_week = 1;
	$dates_array = array();
	$curr_day = date("d");
	$curr_month = date("m");
	$curr_year = date("Y");
	$print_sday = false;

	/* row for week one */
	$calendar .= '<tr class="calendar-front-row ">';
	/* print "blank" days until the first of the current week */
	for ($x = 0; $x < $running_day; $x++) :
		$calendar .= '<td class="calendar-front-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;
	/* keep going with days.... */
	for ($list_day = 1; $list_day <= $days_in_month; $list_day++) :
			
		if ($list_day == $curr_day && $month == $curr_month && $year == $curr_year && intval($_REQUEST['cday']) == $curr_day ) 
		{
			global $wpdb;
			$selected_day = date('D', mktime(0, 0, 0, $month, $list_day, $year));
			$dattimeee = $wpdb -> get_var($wpdb->prepare('SELECT count(day) FROM ' . $wpdb -> prefix . sm_block_date . ' where month= %d and day = %d and year= %d  and emp_id= %d order by day ASC', $month, $list_day, $year, $val));
			$count = $wpdb -> get_var($wpdb->prepare('SELECT count(id) FROM ' . $wpdb -> prefix . sm_timings . ' WHERE day = %s AND  emp_id = %d AND  blocked =1', $selected_day, $val));
				if ($dattimeeee > 0 || $count ==0 ) 
			{
				$sel = "style=\"background-color: #f90;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			}
			else 
			{
			
				$sel = "style=\"background-color: #f90;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: white\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			}
		}
	
		else if ($month == $curr_month && $year == $curr_year && $list_day >= $curr_day) 
		{
			global $wpdb;
			$selected_day = date('D', mktime(0, 0, 0, $month, $list_day, $year));
			$dattimeee = $wpdb -> get_var($wpdb->prepare('SELECT count(day) FROM ' . $wpdb -> prefix . sm_block_date . ' where month= %d and day = %d and year= %d  and emp_id= %d order by day ASC', $month, $list_day, $year, $val));
			$count = $wpdb -> get_var($wpdb->prepare('SELECT count(id) FROM ' . $wpdb -> prefix . sm_timings . ' WHERE day = %s AND  emp_id = %d AND  blocked =1', $selected_day, $val));
			
			if ($count == 0) 
			{
				$sel = "style=\"cursor: default;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
				/* add in the day number */
			} 
			else if ($dattimeee > 0) 
			{
				$sel = "style=\"cursor: default;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
				$calendar .= '<div  onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			} 
			else if ($count > 0 && intval($_REQUEST['cday']) == $list_day) 
			{
			
				$sel = "style=\"background-color: #f90;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: white\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			
			} 
			else 
			{
			
				
				$calendar .= '<td class="calendar-front-day">';
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front">' . $list_day . '</div>';
				
			}
		} 
		else if ($month == $curr_month && $year == $curr_year && $list_day < $curr_day) 
		{
			$sel = "style=\"cursor: default;\"";
			$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
			/* add in the day number */
			$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
			$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
		}
		else if ($year < $curr_year) 
		{
			$sel = "style=\"cursor: default;\"";
			$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
			/* add in the day number */
			$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
			$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';

		} 
		else if ($month < $curr_month && $year == $curr_year) 
		{
			
			$sel = "style=\"cursor: default;\"";
			$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
			/* add in the day number */
			$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
			$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
		} 
		else
		{
			global $wpdb;
			$selected_day = date('D', mktime(0, 0, 0, $month, $list_day, $year));
			$dattimeee = $wpdb -> get_var($wpdb->prepare('SELECT count(day) FROM ' . $wpdb -> prefix . sm_block_date . ' where month= %d and day = %d and year= %d and emp_id= %d order by day ASC', $month, $list_day, $year, $val));
			$count = $wpdb -> get_var($wpdb->prepare('SELECT count(id) FROM ' . $wpdb -> prefix . sm_timings . ' WHERE day = %s AND  emp_id = %d AND  blocked =1', $selected_day, $val));
			
			if ($count == 0) 
			{
				$sel = "style=\"cursor: default;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
				/* add in the day number */
			} 
			else if ($dattimeee > 0) 
			{
				$sel = "style=\"cursor: default;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: #DEDEDE; text-decoration: line-through;\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			}
			else if ($count > 0 && intval($_REQUEST['cday']) == $list_day) 
			{
			
				$sel = "style=\"background-color: #f90;\"";
				$calendar .= '<td class="calendar-front-day" ' . $sel . '>';
				/* add in the day number */
				$sel = "style=\"color: white\"";
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front" ' . $sel . '>' . $list_day . '</div>';
			
			}  
			else 
			{
				$calendar .= '<td class="calendar-front-day">';
				$calendar .= '<div onclick="DayClick(this);" id="day_number_' . $list_day . '" class="day-number-front">' . $list_day . '</div>';
			}
		} 
		
		/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		//      $calendar.= str_repeat('<p>&nbsp;</p>',2);
		$calendar .= '</td>';
		if ($running_day == 6) :
			$calendar .= '</tr>';
			if (($day_counter + 1) != $days_in_month) :
				$calendar .= '<tr class="calendar-front-row ">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++;
		$running_day++;
		$day_counter++;
	endfor;
	/* finish the rest of the days in the week */
	if ($days_in_this_week < 8) :
		for ($x = 1; $x <= (8 - $days_in_this_week); $x++) :
			$calendar .= '<td class="calendar-front-day-np">&nbsp;</td>';
		endfor;
	endif;
	/* final row */
	$calendar .= '</tr>';
	/* end the table */
	$calendar .= '</table>';
	/* all done, return result */
	echo $calendar;
}

function emptimings($val, $day, $month, $year, $cservice) 
{
	global $wpdb;
	$timefrt = $wpdb -> get_var($wpdb->prepare('SELECT TimeFormat   FROM ' . $wpdb -> prefix . sm_settings));
	$serid = $cservice;
	$table_name = $wpdb -> prefix . "sm_services_time";
	$serhours = $wpdb -> get_var($wpdb->prepare('SELECT hours FROM ' . $table_name . ' WHERE service_id = %d', $serid));
	$sermins = $wpdb -> get_var($wpdb->prepare('SELECT minutes FROM ' . $table_name . ' WHERE service_id = %d', $serid);
	
	if ($sermins > 0 && $sermins < 30) 
	{
		$sermins = 30;
	}
	if ($sermins > 30 && $sermins < 60) 
	{
		$sermins = 0;
		$serhours++;
	}
	if($sermins=="0")
	{
		$sermins = 0;
	}
	$Sertime = $serhours * 60 + $sermins;
	$serinterval = $Sertime / 30;

	$selected_date = $day . ", " . $month . ", " . $year;
	$time = 1;
	$booked = $wpdb->get_results
	(
			$wpdb->prepare
			(
					"SELECT service_id, day, month, year, hour, minute, emp_id FROM ".$wpdb->prefix."sm_bookings WHERE day = %d AND month = %d AND year = %d AND emp_id = %d AND status != %s",
					$day,
					$month,
					$year,
					$val,
					"Disapproved"
			)
	);
	
	if (!empty($day)) 
	{
		$selected_day = date('D', mktime(0, 0, 0, $month, $day, $year));
		$day_time = $wpdb->get_row
		(
				$wpdb->prepare
				(
						"SELECT * FROM ".$wpdb->prefix."sm_timings WHERE day = %s  AND emp_id = %d",
						$selected_day,
						$val
				)
		);
		$count = $wpdb -> get_var($wpdb->prepare('SELECT count(id) FROM ' . $wpdb -> prefix . sm_timings . ' WHERE day = %s AND  emp_id = %d AND  blocked =1', $selected_day, $val));
	}
	$dattimeee = $wpdb -> get_var($wpdb->prepare('SELECT count(day) FROM ' . $wpdb -> prefix . sm_block_date . ' WHERE day = %d AND month = %d AND year = %d AND emp_id = %d', intval($_REQUEST['cday']), intval($_REQUEST['cmonth']),  intval($_REQUEST['cyear']), $val));
	$minute_started = false;
	$curr_day = date("d");
	$curr_month = date("m");
	$curr_year = date("Y");
	$check = 1;
		if($dattimeee > 0 || $count == 0)
	{
		echo " <div style='text-align:center;font-size:12px;font-solid;float:left;padding:80px;'>Bookings are not available for this date.</div>";
		$check = 0;
	}
	else if ($month < $curr_month && $year <= $curr_year)
	{
		echo " <div style='text-align:center;font-size:12px;font-solid;float:left;padding:80px;'>Bookings are not available for this date.</div>";
		$check = 0;
	}
	else if($month == $curr_month && $year == $curr_year)
	{
		if($day < $curr_day)
		{
			echo " <div style='text-align:center;font-size:12px;font-solid;float:left;padding:80px;'>Bookings are not available for this date.</div>";
			$check = 0;
		}
		else
		{
			$check = 1;
		}

	}
	if ($timefrt == "0" && $check == 1) 
	{
		for ($hour = $day_time -> start_hour; $hour <= $day_time -> end_hour; $hour++) 
		{
			for ($minute = 0; $minute <= 30; $minute += 30) 
			{
				for ($matched = 0; $matched <= count($booked); $matched++) 
				{
					if ($hour == $booked[$matched] -> hour && $minute == $booked[$matched] -> minute) {
						$serid = $cservice;
						$table_name = $wpdb -> prefix . "sm_services_time";
						$serhours = $wpdb -> get_var($wpdb->prepare('SELECT hours FROM ' . $table_name . ' WHERE service_id = %d', $serid));
						$sermins = $wpdb -> get_var($wpdb->prepare('SELECT minutes FROM ' . $table_name . ' WHERE service_id = %d', $serid));
						
						if ($sermins > 0 && $sermins <= 30) {
							$sermins = 30;
						}
						else
						{
							$sermins = 0;
							$serhours++;
						}
						$Sertime = $serhours * 60 + $sermins;
						$serinterval = $Sertime / 30;
						$service = $wpdb->get_row
						(
								$wpdb->prepare
								(
										"SELECT * FROM ".$wpdb->prefix."sm_services_time WHERE service_id = %d ",
										$booked[$matched] -> service_id
										
								)
						);
						$service_time_h = $service -> hours;
						$service_time_m = $service -> minutes;
						if ($service_time_h > 0) 
						{
							$service_time_h *= 60;
						}
					
						$service_time = $service_time_h + $service_time_m;
						$time_intervals = $service_time / 30;
						
						$service_gap_sh = $service -> gap_start_hour;
						$service_gap_sm = $service -> gap_start_minute;
						$service_gap_eh = $service -> gap_end_hour;
						$service_gap_em = $service -> gap_end_minute;
						
						$gap_hour = 0;
						$gap_minute = 0;
						for ($i = 0; $i < $time_intervals; $i++) {
							if ($minute > 30) {
								$hour++;
								$minute = 0;
							}
							if ($gap_minute > 30) {
								$gap_hour++;
								$gap_minute = 0;
							}
							$tempEnd = $day_time -> end_hour * 60 +  $day_time -> end_minute;
							
							$tempStart = $hour * 60 + $minute;
							
							if ($tempStart <= $tempEnd) {
								if (!($service_gap_sh == 0 && $service_gap_sm == 0 && $service_gap_eh == 0 && $service_gap_em == 0)) {
									$gap_starting = ($service_gap_sh * 60) + $service_gap_sm;
									
									$gap_ending = ($service_gap_eh * 60) + $service_gap_em;
									
									$gap_interval = ($gap_ending - $gap_starting) / 30;
									
									if (($service_gap_sh == $gap_hour) && ($service_gap_sm == $gap_minute)) {
										for ($j = 0; $j < $gap_interval; $j++) {
											if ($minute > 30) 
											{
												$hour++;
												$minute = 0;
											}
											if ($minute < $day_time -> start_minute && $minute_started == false) 
											{

											} 
											else 
											{
												if ($hour == $day_time -> end_hour && $minute > $day_time -> end_minute) {
													break 5;
												}
												$tottim = $serhours * 60 + $sermins;
												$gap = $gap_ending - $gap_starting;
												$blktm = $hour . ":" . $minute . ":00";
												$booking = $wpdb -> get_var($wpdb->prepare('SELECT count(service_id) FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE day = %d AND hour = %d AND emp_id = %d AND minute = %d AND month = %d AND year = %d AND status != "Disapproved" order by hour,minute ASC', intval($_REQUEST['cday']), $hour, $val, $minute, intval($_REQUEST['cmonth']), intval($_REQUEST['cyear'])));
												$blktime = $wpdb -> get_var($wpdb->prepare('SELECT block_time FROM ' . $wpdb -> prefix . sm_block_time . ' WHERE  day = %s AND month = %d AND year = %d AND block_time = %d AND emp_id = %d', $day, $month, $year, $blktm, $val));
												if ($blktime != "") 
												{
													echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "0" . $minute : $minute) . "</a>";
												}
												else if ($booking == 0) 
												{
													if ($gap >= $tottim) 
													{
														echo "<a class=\"hourschoice_res \" rel=\"1\" id=\"time_$time\" href='#' onclick='TimeClick(this);'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "00" : $minute) . "</a>";
													}
													else 
													{
														echo "<a class=\"hourschoice_res1 \" rel=\"1\" href='#' >" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "0" . $minute : $minute) . "</a>";
													}
												}
												else 
												{
													echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "0" . $minute : $minute) . "</a>";
												}
												$minute += 30;
												$time++;
												$i++;
												$minute_started = true;
												if ($minute > 30) 
												{
													$minute = 0;
													$hour++;
												}
												if ($gap_minute > 30) 
												{
													$gap_minute = 0;
													$gap_hour++;
												}
											}
										}
									}
								}
								if ($minute < $day_time -> start_minute && $minute_started == false) 
								{
									
								} 
								else 
								{
									if ($hour == $day_time -> end_hour && $minute > $day_time -> end_minute) 
									{
										break 4;
									}
									if ($i < $time_intervals) 
									{
										if ($minute > 30) {
											$hour++;
											$minute = 0;
										}
										if ($gap_minute > 30) {
											$gap_hour++;
											$gap_minute = 0;
										}
										echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "0" . $minute : $minute) . "</a>";
										$minute += 30;
										$time++;
										$gap_minute += 30;
										$minute_started = true;
									}
								}
							}
						}
					}
				}

					$tempEnd = $day_time -> end_hour * 60 +  $day_time -> end_minute;
							$tempStart = $hour * 60 + $minute;
							if ($tempStart <= $tempEnd) {
					$bookinggg = 0;
					if ($minute > 30) {
						$hour++;
						$minute = 0;
					}
					$hrs = $hour;
					$mins = $minute;
					if ($hour == "") {
						$bookinggg = -1;
					} else {
						for ($intervl = 1; $intervl <= $serinterval; $intervl++) {
							if ($mins > 30) {
								$mins = 0;
								$hrs++;
							}
							if ($hrs <= $day_time -> end_hour) {
								$bookinggg = $wpdb -> get_var($wpdb->prepare('SELECT count(service_id) FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE day = %d AND hour = %d AND minute = %d AND month = %d AND year = %d AND emp_id = %d AND status != "Disapproved" order by hour,minute ASC', intval($_REQUEST['cday']), $hrs, $mins, intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), $val));
								$mins = $mins + 30;
								if ($bookinggg > 0) {
									break;
								}
							} else {
								$bookinggg = 1;
								break;
							}
						}
					}
					$blktm = $hour . ":" . $minute . ":00";
					$blktime = $wpdb -> get_var($wpdb->prepare('SELECT block_time FROM ' . $wpdb -> prefix . sm_block_time . ' WHERE  day = %d AND month = %d AND year = %d AND block_time = %d AND emp_id = %d', intval($_REQUEST['cday']), intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), $blktm, $val));

					if ($blktime != "") 
					{
						echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#' >" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "0" . $minute : $minute) . "</a>";
					} 
					else if ($bookinggg > 0) 
					{
						echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "00" : $minute) . "</a>";
					} 
					else if ($bookinggg == 0) 
					{
						echo "<a class=\"hourschoice_res \" rel=\"1\" id=\"time_$time\" href='#' onclick='TimeClick(this);'>" . ($hour < 10 ? "0" . $hour : $hour) . ":" . ($minute < 30 ? "00" : $minute) . "</a>";
					} 
					else 
					{
						echo "<div style='text-align:center;font-size:12px;font-solid;float:left;padding:80px'>Bookings are not available for this date.</div>";
						break;
					}
					$time++;
					$minute_started = true;
					$serinterval--;
				}
			}
		}
	} 
	else if ($timefrt == "1" && $check == 1) 
	{
		for ($hour = $day_time -> start_hour; $hour <= $day_time -> end_hour; $hour++) {
			for ($minute = 0; $minute <= 30; $minute += 30) {
				for ($matched = 0; $matched <= count($booked); $matched++) {
					if ($hour == $booked[$matched] -> hour && $minute == $booked[$matched] -> minute) {
						$serid = $cservice;
						$table_name = $wpdb -> prefix . "sm_services_time";
						$serhours = $wpdb -> get_var($wpdb->prepare('SELECT hours FROM ' . $table_name . ' WHERE service_id = %d', $serid));
						$sermins = $wpdb -> get_var($wpdb->prepare('SELECT minutes FROM ' . $table_name . ' WHERE service_id = %d', $serid));
						
						if ($sermins > 0 && $sermins <= 30) {
							$sermins = 30;
						}
						else
						{
							$sermins = 0;
							$serhours++;
						}
						$Sertime = $serhours * 60 + $sermins;
						$serinterval = $Sertime / 30;
						
						$service = $wpdb->get_row
						(
								$wpdb->prepare
								(
										"SELECT * FROM ".$wpdb->prefix."sm_services_time WHERE service_id = %d ",
										$booked[$matched] -> service_id
										
								)
						);
						$service_time_h = $service -> hours;
						$service_time_m = $service -> minutes;
						if ($service_time_h > 0) 
						{
							$service_time_h *= 60;
						}
					
						$service_time = $service_time_h + $service_time_m;
						$time_intervals = $service_time / 30;
						
						$service_gap_sh = $service -> gap_start_hour;
						$service_gap_sm = $service -> gap_start_minute;
						$service_gap_eh = $service -> gap_end_hour;
						$service_gap_em = $service -> gap_end_minute;
						
						$gap_hour = 0;
						$gap_minute = 0;
						for ($i = 0; $i < $time_intervals; $i++) {
							if ($minute > 30) {
								$hour++;
								$minute = 0;
							}
							if ($gap_minute > 30) {
								$gap_hour++;
								$gap_minute = 0;
							}
							$tempEnd = $day_time -> end_hour * 60 +  $day_time -> end_minute;
							
							$tempStart = $hour * 60 + $minute;
							
							if ($tempStart <= $tempEnd) {
								if (!($service_gap_sh == 0 && $service_gap_sm == 0 && $service_gap_eh == 0 && $service_gap_em == 0)) {
									$gap_starting = ($service_gap_sh * 60) + $service_gap_sm;
									
									$gap_ending = ($service_gap_eh * 60) + $service_gap_em;
									
									$gap_interval = ($gap_ending - $gap_starting) / 30;
									
									if (($service_gap_sh == $gap_hour) && ($service_gap_sm == $gap_minute)) {
										for ($j = 0; $j < $gap_interval; $j++) {
											if ($minute > 30) 
											{
												$hour++;
												$minute = 0;
											}
											if ($minute < $day_time -> start_minute && $minute_started == false) 
											{

											} 
											else 
											{
												if ($hour == $day_time -> end_hour && $minute > $day_time -> end_minute) {
													break 5;
												}

												$tottim = $serhours * 60 + $sermins;
												
												$gap = $gap_ending - $gap_starting;
											
												$booking = $wpdb -> get_var($wpdb->prepare('SELECT count(service_id) FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE day = %d AND hour = %d AND emp_id = %d AND minute = %d AND month = %d AND year = %d AND status != "Disapproved" order by hour,minute ASC', intval($_REQUEST['cday']), $hour, $val, $minute, intval($_REQUEST['cmonth']), intval($_REQUEST['cyear'])));
												
												$hourcheck = $hour;
												$mincheck = $minute;
												$blktm = $hour . ":" . $minute . ":00";
												
												if ($hourcheck > 12) 
												{
													$hourcheck = $hour - 12;

												}
												if ($hour < 12) 
												{
													$minute = $minute . "AM";
													$mntt = "00AM";
												} 
												else 
												{
													$minute = $minute . "PM";
													$mntt = "00PM";
												}
												
												$blktime = $wpdb -> get_var($wpdb->prepare('SELECT block_time FROM ' . $wpdb -> prefix . sm_block_time . ' WHERE  day = %d AND month = %d AND year = %d AND block_time = %d AND emp_id = %d', intval($_REQUEST['cday']), intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), $blktm, $val));
												$btime = explode(':', $blktime);
												$blkktime = $btime[0] . ":" . $btime[1];
												if ($blktime != "") 
												{
													echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
												} 
												else if ($booking == 0) 
												{
													if ($gap >= $tottim) 
													{
														echo "<a class=\"hourschoice_res \" rel=\"1\" id=\"time_$time\" href='#' onclick='TimeClick(this);'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
													} 
													else 
													{
														echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#' >" . ($hour < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
													}
												} 
												else
												{
													echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hour < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
												}
												$minute += 30;
												$time++;
												$i++;
												$minute_started = true;
												if ($minute > 30) {
													$minute = 0;
													$hour++;
												}
												if ($gap_minute > 30) {
													$gap_minute = 0;
													$gap_hour++;
												}
											}
										}
									}
								}
								if ($minute < $day_time -> start_minute && $minute_started == false) 
								{
								} 
								else 
								{
									if ($hour == $day_time -> end_hour && $minute > $day_time -> end_minute) 
									{
										break 4;
									}
									if ($i < $time_intervals) 
									{
										if ($minute > 30) 
										{
											$hour++;
											$minute = 0;
										}
										if ($gap_minute > 30) {
											$gap_hour++;
											$gap_minute = 0;
										}
										$hourcheck = $hour;
										$mincheck = $minute;
										if ($hourcheck > 12) 
										{
											$hourcheck = $hour - 12;
										}
										if ($hour < 12) 
										{
											$minute = $minute . "AM";
											$mntt = "00AM";
										} 
										else 
										{
											$minute = $minute . "PM";
											$mntt = "00PM";
										}

										echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
										$minute += 30;
										$time++;
										$gap_minute += 30;
										$minute_started = true;
									}
								}
							}
						}
					}
				}
							$tempEnd = $day_time -> end_hour * 60 +  $day_time -> end_minute;
							$tempStart = $hour * 60 + $minute;
							if ($tempStart <= $tempEnd) 
							{
					$bookinggg = 0;
					$blktm = $hour . ":" . $minute . ":00";
					if ($minute > 30) 
					{
						$hour++;
						$minute = 0;
					}
					$tm = $hour . ":" . $minute;
					$hrs = $hour;
					$mins = $minute;
					if ($hour == "") 
					{
						$bookinggg = -1;
					} 
					else 
					{
						for ($intervl = 1; $intervl <= $serinterval; $intervl++) 
						{
							if ($mins > 30) 
							{
								$mins = 0;
								$hrs++;
							}
							if ($hrs <= $day_time -> end_hour) 
							{
								$bookinggg = $wpdb -> get_var($wpdb->prepare('SELECT count(service_id) FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE day = %d AND hour = %d AND minute = %d AND month = %d AND year = %d AND emp_id = %d AND status != "Disapproved" order by hour,minute ASC', intval($_REQUEST['cday']), $hrs, $mins, intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), $val));

								$mins = $mins + 30;
								if ($bookinggg > 0) 
								{
									break;
								}
							}
							else 
							{
								$bookinggg = 1;
								break;
							}
						}
					}
					
					$hourcheck = $hour;
					$mincheck = $minute;
					
					if ($hourcheck > 12) 
					{
					
						$hourcheck = $hour - 12;
						
					}
					if ($hour < 12) 
					{
						$minute = $minute . "AM";
						$mntt = "00AM";
					} 
					else 
					{
						$minute = $minute . "PM";
						$mntt = "00PM";
					}
					
					$blktime = $wpdb -> get_var($wpdb->prepare('SELECT block_time FROM ' . $wpdb -> prefix . sm_block_time . ' WHERE  day = %d AND month = %d AND year = %d AND block_time = %d AND emp_id = %d', intval($_REQUEST['cday']), intval($_REQUEST['cmonth']), intval($_REQUEST['cyear']), $blktm, $val));
					
					if ($blktime != "") {
						echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
					} else if ($bookinggg > 0) {
						echo "<a class=\"hourschoice_res1 \" rel=\"1\"  href='#'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
					} else if ($bookinggg == 0) {
						echo "<a class=\"hourschoice_res \" rel=\"1\" id=\"time_$time\" href='#' onclick='TimeClick(this);'>" . ($hourcheck < 10 ? "0" . $hourcheck : $hourcheck) . ":" . ($minute < 30 ? $mntt : $minute) . "</a>";
					} else {
						echo " <div style='text-align:center;font-size:12px;font-solid;float:left;padding:80px'>Bookings are not available for this date.</div>";
						break;
					}
					$time++;
					$minute_started = true;
					$serinterval--;
				}

			}
		}
	}
}
?>