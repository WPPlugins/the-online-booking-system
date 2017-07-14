<?php  
function confirm_callback(){
wpobs_restrict_to_admin();
global $wpdb;
    if($_REQUEST['actionappbok']=="approve")
	{
	     $book_id = intval($_REQUEST['id']);
		 $admin_email = get_settings('admin_email');
		 $wpdb->query
	     (
	            $wpdb->prepare
	            (
	                    "UPDATE ".$wpdb->prefix."sm_bookings SET status = %s WHERE id = %d",
	                    "Approved",
	                    $book_id
	             )
	      );	
      	 $client_id = $wpdb->get_var($wpdb->prepare("SELECT client_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
		 $service_id = $wpdb->get_var($wpdb->prepare("SELECT service_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
         $empid=$wpdb->get_var($wpdb->prepare("SELECT emp_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
         $emp_nam=$wpdb->get_var($wpdb->prepare("SELECT emp_name From  " . $wpdb->prefix . sm_employees . " WHERE id = %d", $empid)); 
		 $emp_email=$wpdb->get_var($wpdb->prepare("SELECT email From  " . $wpdb->prefix . sm_employees . " WHERE id = %d", $empid)); 
		 $day = $wpdb->get_var($wpdb->prepare("SELECT day From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
		 $month = $wpdb->get_var($wpdb->prepare("SELECT month From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
		 $year = $wpdb->get_var($wpdb->prepare("SELECT year From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
		 $hour = $wpdb->get_var($wpdb->prepare("SELECT hour From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
	     $minute = $wpdb->get_var($wpdb->prepare("SELECT minute From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", $book_id));
		 
	     $lastnam = $wpdb->get_var($wpdb->prepare("SELECT lastname From  " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id)); 		 
		 
		
		 $name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_clients . "  WHERE id = %d", $client_id)); 		 
		 $email = $wpdb->get_var($wpdb->prepare("SELECT email From   " . $wpdb->prefix . sm_clients . "  WHERE id = %d", $client_id)); 		 
		 $telephone = $wpdb->get_var($wpdb->prepare("SELECT mobile From   " . $wpdb->prefix . sm_clients . " WHERE id = %d", $client_id)); 		 
		 $ser_name = $wpdb->get_var($wpdb->prepare("SELECT name From  " . $wpdb->prefix . sm_services . "  WHERE id = %d", $service_id));		 
		 $table_name = $wpdb->prefix . "sm_email_signature";
		 $em_sign= $wpdb->get_var($wpdb->prepare('SELECT initial  FROM ' . $table_name));
		 $e_content = $wpdb->get_var($wpdb->prepare('SELECT content FROM  ' . $wpdb->prefix . sm_emails . ' WHERE type = "single_client_confirm"'));	
	     $subject = $wpdb->get_var($wpdb->prepare('SELECT subject FROM   ' . $wpdb->prefix . sm_emails . ' WHERE type = "single_client_confirm"'));			 
	     $title=get_bloginfo('name');
		 $textual_month = date('M',mktime(0,0,0,$month,$day,$year));
         $date = $day." ".$textual_month." ".$year;
		 $to = $email;
        if($hour < 10){
           $hour = "0".$hour;
        }
         if($minute < 10){
            $minute = "0".$minute;			
         }
        $time = $hour.":".$minute;
		
		$customer_app_confirm = $wpdb->get_var($wpdb->prepare('SELECT app_confirm FROM ' . $wpdb->prefix . sm_customer_notifications));
		if($customer_app_confirm==1)
		{
	        $message_1 = str_replace("[client_name]", $name, $e_content);
	        $message_2 = str_replace("[service_name]", $ser_name, $message_1);
	        $message_3 = str_replace("[booked_time]", $time, $message_2);
			$message_4 = str_replace("[employee_name]", $emp_nam, $message_3);
			$message_5 = str_replace("[signature]", $em_sign, $message_4);
			$message_6 = str_replace("[companyName]", $title, $message_5);
	        $message  =   str_replace("[booked_date]", $date, $message_6);
			$staff_app_booked = $wpdb->get_var($wpdb->prepare('SELECT app_booked FROM ' . $wpdb->prefix . sm_staff_notifications));
			if($staff_app_booked==1)
			{
				$headers = "From: " .$title. "<". $admin_email . ">". "\r\n";
				$headers .= "Bcc: ".$emp_email . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
			}
			else
			{
				$headers = "From: " .$title. "<". $admin_email . ">". "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
			}
			echo "<p style=\"color: green; font-style: italic; clear: both;\">Booking has been approved successfully.
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
			Booking Service Name: ".$ser_name."
	        <br />
	        Booking Service Provider: ".$emp_nam."
			</p>";
			wp_mail($to,$subject,$message,$headers); 
		}
		else
		{
				$message_1 = str_replace("[client_name]", $name, $e_content);
		        $message_2 = str_replace("[service_name]", $ser_name, $message_1);
		        $message_3 = str_replace("[booked_time]", $time, $message_2);
				$message_4 = str_replace("[employee_name]", $emp_nam, $message_3);
				$message_5 = str_replace("[signature]", $em_sign, $message_4);
				$message_6 = str_replace("[companyName]", $title, $message_5);
		        $message  =   str_replace("[booked_date]", $date, $message_6);
				$staff_app_booked = $wpdb->get_var($wpdb->prepare('SELECT app_booked FROM ' . $wpdb->prefix . sm_staff_notifications));
				if($staff_app_booked==1)
				{
				$headers = "From: " .$title. "<". $admin_email . ">". "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
				}
				echo "<p style=\"color: green; font-style: italic; clear: both;\">Booking has been approved successfully.
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
				Booking Service Name: ".$ser_name."
		        <br />
		        Booking Service Provider: ".$emp_nam."
				</p>";
				wp_mail($emp_email,$subject,$message,$headers); 
	}		
}
if($_REQUEST['actionappbok']=="disapprove")
{
				
		$client_idd = $wpdb->get_var($wpdb->prepare("SELECT client_id From  " . $wpdb->prefix . sm_bookings . " WHERE id = %d", intval($_REQUEST['id'])));   	  
		$emaill = $wpdb->get_var($wpdb->prepare("SELECT email From  " . $wpdb->prefix . sm_clients . "  WHERE id = %d", $client_idd));	  	
		?>
		<script type="text/javascript">
		function send_demail() 
		{
			
            var d_email = jQuery('#d_client_email').val();
            var d_booking = jQuery('#d_booking_id').val();
            jQuery.ajax({
                      type: "POST",
                      data: "client_email=" + d_email + "&booking=" + d_booking,
                      url : '<?php echo admin_url('admin-ajax.php'); ?>' + "?action=confirm_disapprove",
                      success: function(data) 
                      { 
							jQuery("#demail_send_success").html(data);
                      }                            
                   });
         }	
		</script>
		<input type="hidden" id="d_client_email" value="<?php echo  $emaill; ?>" />
		<input type="hidden" id="d_booking_id" value="<?php echo intval($_REQUEST['id']); ?>" />
		<span id="demail_send_success" style="color: green; font-style: italic; position: relative; top: 12px;"></span>
		<script type="text/javascript">send_demail();</script>
<?php
}
die;
}
?>