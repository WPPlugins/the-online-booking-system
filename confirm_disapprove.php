<?php
function confirm_disapprove_callback(){
wpobs_restrict_to_admin();
global $wpdb;
$title=get_bloginfo('name');
if(isset($_REQUEST['status']))
{
				$booking_id = intval($_REQUEST['booking']);
		    	$wpdb->query
	           (
	                	  $wpdb->prepare
	                  	  (
	                      	  "UPDATE ".$wpdb->prefix."sm_bookings SET status = %s WHERE id = %d",
	                      	  "Disapproved",
	                      	  $booking_id
	                   	   )
	            );
	        	echo "Disapproved";	   
	       		$admin_email = get_settings('admin_email');	
				$client_id = $wpdb->get_var($wpdb->prepare("SELECT client_id From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));		
				$service_id = $wpdb->get_var($wpdb->prepare("SELECT service_id From   " . $wpdb->prefix . sm_bookings . " WHERE id =  %d", $booking_id));
				$empid=$wpdb->get_var($wpdb->prepare("SELECT emp_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id)); 
	       		$emp_nam=$wpdb->get_var($wpdb->prepare("SELECT emp_name From  " . $wpdb->prefix . sm_employees . " WHERE id = %d", $empid)); 
				$day = $wpdb->get_var($wpdb->prepare("SELECT day From   " . $wpdb->prefix . sm_bookings . " WHERE id =  %d", $booking_id));
				$month = $wpdb->get_var($wpdb->prepare("SELECT month From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$year = $wpdb->get_var($wpdb->prepare("SELECT year From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$hour = $wpdb->get_var($wpdb->prepare("SELECT hour From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$minute = $wpdb->get_var($wpdb->prepare("SELECT minute From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));        
				$email = $wpdb->get_var($wpdb->prepare("SELECT email From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));
		    	$telephone = $wpdb->get_var($wpdb->prepare("SELECT mobile From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));
				$service_name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_services . " WHERE id = %d", $service_id));	    		
				$table_name = $wpdb->prefix . "sm_email_signature";
				$email_sign= $wpdb->get_var($wpdb->prepare('SELECT initial  FROM ' . $table_name));
				$title=get_bloginfo('name');
				$textual_month = date('M',mktime(0,0,0,$month,$day,$year));
	        	$date = $day." ".$textual_month." ".$year;
	        	$to = $email;    
	         	if($hour< 10)
	         	{
	            	 $hour = "0".$hour;
	        	}
	        	if($minute < 10)
	        	{
	            	 $minute = "0".$minute;
	         	}
	        	$time = $hour.":".$minute;
				
				$msg_stored = $wpdb->get_var($wpdb->prepare('SELECT content  FROM ' . $wpdb->prefix . sm_emails . ' WHERE type = "decline_client"'));
				$msg_sub = $wpdb->get_var($wpdb->prepare('SELECT subject FROM ' . $wpdb->prefix . sm_emails . ' WHERE type = "decline_client"'));
	        	$msg_1 = str_replace("[first name]", $name, $msg_stored );
	        	$msg_2 = str_replace("[service]", $service_name, $msg_1);
	       		$msg_3 = str_replace("[date]", $date, $msg_2);
	        	$msg_4= str_replace("[time]", $time, $msg_3);
				$msg_5 = str_replace("[employee_name]", $emp_nam, $msg_4);
				$msg_6 = str_replace("[signature]", $email_sign, $msg_5);
				$msg_7 = str_replace("[companyName]", $title, $msg_6);
				$headers = "From: " .$title. "<". $admin_email . ">". "\r\n";
	       		$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
	        	wp_mail($to,$msg_sub, $msg_7, $headers);       
}
else
{
				$booking_id = intval($_REQUEST['booking']);
				$wpdb->query
	           	(
	                	  $wpdb->prepare
	                  	  (
	                      	  "UPDATE ".$wpdb->prefix."sm_bookings SET status = %s WHERE id = %d",
	                      	  "Disapproved",
	                      	  $booking_id
	                   	   )
	            );
		        $admin_email = get_settings('admin_email');	
				$client_id = $wpdb->get_var($wpdb->prepare("SELECT client_id From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));		
				$service_id = $wpdb->get_var($wpdb->prepare("SELECT service_id From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$empid=$wpdb->get_var($wpdb->prepare("SELECT emp_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
		        $emp_nam=$wpdb->get_var($wpdb->prepare("SELECT emp_name From  " . $wpdb->prefix . sm_employees . " WHERE id = %d", $empid)); 
				$day = $wpdb->get_var($wpdb->prepare("SELECT day From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$month = $wpdb->get_var($wpdb->prepare("SELECT month From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$year = $wpdb->get_var($wpdb->prepare("SELECT year From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$hour = $wpdb->get_var($wpdb->prepare("SELECT hour From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$minute = $wpdb->get_var($wpdb->prepare("SELECT minute From   " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $booking_id));
				$name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));        
				$email = $wpdb->get_var($wpdb->prepare("SELECT email From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));
			    $telephone = $wpdb->get_var($wpdb->prepare("SELECT mobile From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id));
				$service_name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_services . " WHERE id = %d", $service_id));	    		
				$table_name = $wpdb->prefix . "sm_email_signature";
				$emaill_sign= $wpdb->get_var($wpdb->prepare('SELECT initial  FROM ' . $table_name));
				$textual_month = date('M',mktime(0,0,0,$month,$day,$year));
		        $date = $day." ".$textual_month." ".$year;
		        $to = $email;
		        if($hour< 10)
		        {
		             $hour = "0".$hour;
		        }
		        if($minute < 10)
		        {
		             $minute = "0".$minute;
		        }
		        $time = $hour.":".$minute;
				
				$msg_stored = $wpdb->get_var($wpdb->prepare('SELECT content  FROM ' . $wpdb->prefix . sm_emails . ' WHERE type = "decline_client"'));
				$msg_sub = $wpdb->get_var($wpdb->prepare('SELECT subject FROM ' . $wpdb->prefix . sm_emails . ' WHERE type = "decline_client"'));
		        $customer_app_disapprove = $wpdb->get_var($wpdb->prepare('SELECT app_cenceled FROM ' . $wpdb->prefix . sm_customer_notifications));
				$title=get_bloginfo('name');
				if($customer_app_disapprove==1)
				{
					    $msg_1 = str_replace("[first name]", $name, $msg_stored );
				        $msg_2 = str_replace("[service]", $service_name, $msg_1);
				        $msg_3 = str_replace("[date]", $date, $msg_2);
				        $msg_4= str_replace("[time]", $time, $msg_3);
						$msg_5 = str_replace("[employee_name]", $emp_nam, $msg_4);
						$msg_6 = str_replace("[signature]", $emaill_sign, $msg_5);
						$msg_7 = str_replace("[companyName]", $title, $msg_6);
						$headers = "From: " .$title. "<". $admin_email . ">". "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=utf-8";
						$headers .= "Content-Transfer-Encoding: quoted-printable";
       
				        wp_mail($to,$msg_sub, $msg_7, $headers); 
				}
				 echo "<p style=\"color: red; font-style: italic; clear: both;\">Booking has been disapproved successfully.
		         <br /><br />
		         Booking Details:
		         <br />
		         <br />
		         Client Name: ".$name."
		         <br />
		         Client Email: ".$email."
		         <br />
		         Client Mobile Number: ".$telephone."
		         <br />
		         Booking Date: ".$date."
		         <br />
				  Booking Time: ".$time."
		         <br />
				  Booking Service Name: ".$service_name."
		         <br />
		         Booking Service Provider: ".$emp_nam."
		         </p>";
}
die;
}
?>