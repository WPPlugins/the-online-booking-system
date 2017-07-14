<?php
function bookingstatus_callback(){
wpobs_restrict_to_admin();
global $wpdb;
if(isset($_REQUEST['method']))
{
		if($_REQUEST['method'] == 'delbook')
		{
				$idd = intval($_REQUEST['idd']);
				$wpdb->query
			  	(
			  		$wpdb->prepare
			    	(
			    		"DELETE FROM ".$wpdb->prefix."sm_bookings WHERE id = %d",
			       		 $idd
			   		 )
			 	 );
		}
		else if($_REQUEST['method'] == 'cancelbook')
		{
				$id = intval($_REQUEST['id']);
				$wpdb->query
			  	(
			  		$wpdb->prepare
			    	(
			    		"UPDATE ".$wpdb->prefix."sm_bookings SET status = %s where id = %d",
			    		"Cancelled",
			       		 $id
			   		 )
			 	 );
			
		}
		
}
else 
{?>
<script>
var redirect = "<?php echo  site_url(); ?>"; 
function deletebook(b)
{
	
 var idd=b;
	action = confirm("Are you sure you want to delete this Booking?");
	if(action == true)
	{
		
	jQuery.ajax
			({
				type: "POST",
				data:"idd="+idd+"&method=delbook",
				url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=bookingstatus",
				success: function(data)
				{
					window.location.href = redirect+"/wp-admin/admin.php?page=TabBooking";
				}
			});
	}
 	
}
function bookstatus(e)
{
	
 var id=e;
 
	action = confirm("Are you sure you want to Cancel this Booking?");
	if(action == true)
	{
		
	jQuery.ajax
			({
				type: "POST",
				data:"id="+id+"&method=cancelbook",
				url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=bookingstatus",
				success: function(data)
				{
					window.location.href = redirect+"/wp-admin/admin.php?page=TabBooking";
				}
			});
	}
 	
}		
function resendbooking(a)
{
	
 var reid=a;
 
	action = confirm("Are you sure you want to Resend Booking Email to the Client?");
	if(action == true)
	{
		
	jQuery.ajax
			({
				type: "POST",
				data:"reid="+reid+"&method=resend",
				url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=resendbooking",
				success: function(data)
				{
					window.location.href = redirect+"/wp-admin/admin.php?page=TabBooking";
				}
			});
	}
 	
}
function approve(d)
{
	var iid=d; 
	action = confirm("Are you sure you want to Approve this Booking");
	if(action == true)
	{
		
	jQuery.ajax
			({
				type: "POST",
				data:"iid="+iid+"&method=approve",
				url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=resendbooking",
				success: function(data)
				{
					window.location.href = redirect+"/wp-admin/admin.php?page=TabBooking";
				}
			});
	}

}	
function disapprove(p)
{
	var idd=p;
 
	action = confirm("Are you sure you want to Dissapprove this Booking");
	if(action == true)
	{
		
	jQuery.ajax
			({
				type: "POST",
				data:"idd="+idd+"&method=disapprove",
				url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=resendbooking",
				success: function(data)
				{
					window.location.href = redirect+"/wp-admin/admin.php?page=TabBooking";
				}
			});
	}
}
</script>
<div class="widget-wp-obs" style="margin: 20px;">
					<div class="widget-wp-obs_title">
						<span class="iconsweet">b</span>
						<h5>Calendar Agenda </h5>
						</div>
						
						<div id="customertable" class="widget-wp-obs_body" >
<table class="activity_datatable"  width="100%" border="0" cellspacing="0" cellpadding="8">
									<tbody>
										<tr>
											<th>Client Name</th>
						                    <th>Client Mobile</th>
						                    <th>Service Booked</th>
											<th>Employee Name</th>
											<th>Booking Date</th>
						                    <th>Time Booked</th>
						                    <th>Booking Status</th>
						                    <th>Delete Booking</th> 		
											<th>Cancel Appointment</th>
											<th>Resend Bookings</th>
										</tr>
										
									<?php 
									global $wpdb;
									$curdate = date('Y-m-d');
  									$date = $curdate;
									$newdate = strtotime ( '+1 month' , strtotime ( $date ) ) ;
									$newdate = date ( 'Y-m-j' , $newdate );
									$bookings = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . sm_bookings . " where (Date  BETWEEN  %s AND %s) AND (status = 'Approval Pending' OR status = 'Approved' OR status = 'Cancelled' OR status = 'Disapproved') order by Date,hour,minute", $curdate, $newdate));
									for($i=0; $i< count($bookings); $i++)
									{
											$clientname = $wpdb->get_var($wpdb->prepare('SELECT name FROM ' . $wpdb->prefix . sm_clients . ' WHERE id = %d', $bookings[$i]->client_id));
											
											$clientmobile = $wpdb->get_var($wpdb->prepare('SELECT mobile  FROM ' . $wpdb->prefix . sm_clients . ' WHERE id = %d', $bookings[$i]->client_id));
											$servname = $wpdb->get_var($wpdb->prepare('SELECT name  FROM ' . $wpdb->prefix . sm_services . ' WHERE id = %d', $bookings[$i]->service_id));
											$empname = $wpdb->get_var($wpdb->prepare('SELECT emp_name  FROM ' . $wpdb->prefix . sm_employees . ' WHERE id = %d', $bookings[$i]->emp_id));
											$stat = $wpdb->get_var($wpdb->prepare('SELECT status FROM ' . $wpdb->prefix . sm_bookings . ' WHERE id = %d', $bookings[$i]->id));
											$bd= $wpdb->get_var($wpdb->prepare('SELECT Date FROM ' . $wpdb->prefix . sm_bookings . ' WHERE id = %d', $bookings[$i]->id));
											
										echo "<tr>
											<td style=\"text-align: center;\">$clientname</td>
											<td style=\"text-align: center;\">$clientmobile</td>
											<td style=\"text-align: center;\">$servname</td>
											<td style=\"text-align: center;\">$empname</td>
											<td style=\"text-align: center;\">$bd</td>
											<td style=\"text-align: center;\">".($bookings[$i]->hour<10 ? "0".$bookings[$i]->hour : $bookings[$i]->hour).":".($bookings[$i]->minute<10 ? "0".$bookings[$i]->minute : $bookings[$i]->minute)."</td>
											<td style=\"text-align: center;\">". ($bookings[$i]->status=="Cancelled" ? "Cancelled" : ($bookings[$i]->status=="Approval Pending" ? "<a style=\"color:Blue !important;text-decoration:underline !important\" id=\"approve_".$bookings[$i]->id."\" onclick=\" approve(".$bookings[$i]->id.");\" href=\"javascript: \">Approve</a> / <a style=\"color:Blue !important;text-decoration:underline !important\" id=\"disapprove_".$bookings[$i]->id."\" onclick=\" disapprove(".$bookings[$i]->id.");\" href=\"#\">Disapprove</a>" : ($bookings[$i]->status=="Approved" ? "Approved" : "Disapproved")))."</td>
											<td style=\"text-align: center;\"><span class=\"data_actions iconsweet\"><a class=\"tip_north\" original-title=\"Delete Booking\" id=".$bookings[$i]->id ." onClick=\"deletebook(".($bookings[$i]->id).")\" style=\"cursor:pointer;\">X</a></span></td>
											<td style=\"text-align: center;\"><span class=\"data_actions iconsweet\"><a class=\"tip_north\" original-title=\"Cancel Booking\" id=". $bookings[$i]->id." onClick=\"bookstatus(".($bookings[$i]->id).")\" style=\"cursor:pointer;\">X</a></span></td>
											<td  style=\"text-align: center;\">". ($bookings[$i]->status == "Approved" ? "<span class=\"data_actions iconsweet\"><a onclick=\"resendbooking(".($bookings[$i]->id).")\" id=\"Resend_".$bookings[$i]->id."\" href=\"javascript:=\">A</a></span>" : "")."</td>
											
										</tr>";
										
										}
										?>
										
							</tbody>	
					</table>
					</div>
					</div>
<?php
}
}
?>