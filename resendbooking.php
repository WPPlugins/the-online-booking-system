<?php
function resendbooking_callback(){
wpobs_restrict_to_admin();
global $wpdb;
if (isset($_REQUEST['method'])) {
	if ($_REQUEST['method'] == "resend") {
		$admin_email = get_settings('admin_email');
		$resendid = intval($_REQUEST['reid']);
		$clientid = $wpdb -> get_var($wpdb->prepare('SELECT client_id  FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$service_id = $wpdb -> get_var($wpdb->prepare('SELECT service_id   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$re_hour = $wpdb -> get_var($wpdb->prepare('SELECT hour   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$re_minute = $wpdb -> get_var($wpdb->prepare('SELECT minute   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$emp_id = $wpdb -> get_var($wpdb->prepare('SELECT emp_id   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$day = $wpdb -> get_var($wpdb->prepare('SELECT day   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$month = $wpdb -> get_var($wpdb->prepare('SELECT month   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$year = $wpdb -> get_var($wpdb->prepare('SELECT year   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		$date = $day . "/" . $month . "/" . $year;
		$booktime = $re_hour . ":" . $re_minute;
		$clientname = $wpdb -> get_var($wpdb->prepare('SELECT name  FROM ' . $wpdb -> prefix . sm_clients . ' WHERE id = %d', $clientid));
		$clientemail = $wpdb -> get_var($wpdb->prepare('SELECT email  FROM ' . $wpdb -> prefix . sm_clients . ' WHERE id = %d', $clientid));
		$servicename = $wpdb -> get_var($wpdb->prepare('SELECT name  FROM ' . $wpdb -> prefix . sm_services . ' WHERE id = %d', $clientid));
		$e_content = $wpdb -> get_var($wpdb->prepare('SELECT content  FROM ' . $wpdb -> prefix . sm_emails . ' WHERE type = "single_client_confirm"'));
		$subject_stored = $wpdb -> get_var($wpdb->prepare('SELECT subject  FROM ' . $wpdb -> prefix . sm_emails . ' WHERE type = "single_client_confirm"'));
		$em_signature = $wpdb -> get_var($wpdb->prepare('SELECT initial  FROM ' . $wpdb -> prefix . sm_email_signature));
		$title = get_bloginfo('name');
		$table_name = $wpdb -> prefix . "sm_employees";
		$emp_nam = $wpdb -> get_var($wpdb->prepare('SELECT emp_name  FROM ' . $table_name . ' WHERE id = %d', $emp_id));
		$status = $wpdb -> get_var($wpdb->prepare('SELECT status   FROM ' . $wpdb -> prefix . sm_bookings . ' WHERE id = %d', $resendid));
		if ($status == "Approved") {
			$customer_app_confirm = $wpdb -> get_var($wpdb->prepare('SELECT app_confirm FROM ' . $wpdb -> prefix . sm_customer_notifications));
			if ($customer_app_confirm == 1) {
				$message_1 = str_replace("[client_name]", $name, $e_content);
				$message_2 = str_replace("[service_name]", $ser_name, $message_1);
				$message_3 = str_replace("[booked_time]", $time, $message_2);
				$message_4 = str_replace("[employee_name]", $emp_nam, $message_3);
				$message_5 = str_replace("[signature]", $em_sign, $message_4);
				$message_6 = str_replace("[companyName]", $title, $message_5);
				$message = str_replace("[booked_date]", $date, $message_6);
				$staff_app_booked = $wpdb -> get_var($wpdb->prepare('SELECT app_booked FROM ' . $wpdb -> prefix . sm_staff_notifications));
				if ($staff_app_booked == 1) {
					$headers = "From: " . $title . "<" . $admin_email . ">" . "\r\n";
					$headers .= "Bcc: " . $emp_email . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=utf-8";
					$headers .= "Content-Transfer-Encoding: quoted-printable";
				} else {
					$headers = "From: " . $title . "<" . $admin_email . ">" . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=utf-8";
					$headers .= "Content-Transfer-Encoding: quoted-printable";
				}
				wp_mail($clientemail, $subject_stored, $message, $headers);
			}
		}

	} else if ($_REQUEST["method"] == "approve") {
		$book_id = intval($_REQUEST['iid']);
		$admin_email = get_settings('admin_email');
		$wpdb -> query($wpdb -> prepare("UPDATE " . $wpdb -> prefix . "sm_bookings SET status = %s WHERE id = %d", "Approved", $book_id));
		$client_id = $wpdb -> get_var($wpdb->prepare("SELECT client_id From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$service_id = $wpdb -> get_var($wpdb->prepare("SELECT service_id From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$empid = $wpdb -> get_var($wpdb->prepare("SELECT emp_id From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$emp_nam = $wpdb -> get_var($wpdb->prepare("SELECT emp_name From  " . $wpdb -> prefix . sm_employees . " WHERE id = %d", $empid));
		$emp_email = $wpdb -> get_var($wpdb->prepare("SELECT email From  " . $wpdb -> prefix . sm_employees . " WHERE id = %d", $empid));
		$day = $wpdb -> get_var($wpdb->prepare("SELECT day From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$month = $wpdb -> get_var($wpdb->prepare("SELECT month From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$year = $wpdb -> get_var($wpdb->prepare("SELECT year From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$hour = $wpdb -> get_var($wpdb->prepare("SELECT hour From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$minute = $wpdb -> get_var($wpdb->prepare("SELECT minute From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $book_id));
		$lastnam = $wpdb -> get_var($wpdb->prepare("SELECT lastname From  " . $wpdb -> prefix . sm_clients . " WHERE id = %d", $client_id));
		$name = $wpdb -> get_var($wpdb->prepare("SELECT name From  " . $wpdb -> prefix . sm_clients . "  WHERE id = %d", $client_id));
		$email = $wpdb -> get_var($wpdb->prepare("SELECT email From   " . $wpdb -> prefix . sm_clients . "  WHERE id = %d", $client_id));
		$telephone = $wpdb -> get_var($wpdb->prepare("SELECT mobile From   " . $wpdb -> prefix . sm_clients . " WHERE id = %d", $client_id));
		$ser_name = $wpdb -> get_var($wpdb->prepare("SELECT name From  " . $wpdb -> prefix . sm_services . "  WHERE id = %d", $service_id));
		$table_name = $wpdb -> prefix . "sm_email_signature";
		$em_sign = $wpdb -> get_var($wpdb->prepare('SELECT initial  FROM ' . $table_name));
		$e_content = $wpdb -> get_var($wpdb->prepare('SELECT content FROM  ' . $wpdb -> prefix . sm_emails . ' WHERE type = "single_client_confirm"'));
		$subject = $wpdb -> get_var($wpdb->prepare('SELECT subject FROM   ' . $wpdb -> prefix . sm_emails . ' WHERE type = "single_client_confirm"'));
		$title = get_bloginfo('name');
		$textual_month = date('M', mktime(0, 0, 0, $month, $day, $year));
		$date = $day . " " . $textual_month . " " . $year;
		$to = $email;
		if ($hour < 10) {
			$hour = "0" . $hour;
		}
		if ($minute < 10) {
			$minute = "0" . $minute;
		}
		$time = $hour . ":" . $minute;
		$customer_app_confirm = $wpdb -> get_var($wpdb->prepare('SELECT app_confirm FROM ' . $wpdb -> prefix . sm_customer_notifications));
		if ($customer_app_confirm == 1) {
			$message_1 = str_replace("[client_name]", $name, $e_content);
			$message_2 = str_replace("[service_name]", $ser_name, $message_1);
			$message_3 = str_replace("[booked_time]", $time, $message_2);
			$message_4 = str_replace("[employee_name]", $emp_nam, $message_3);
			$message_5 = str_replace("[signature]", $em_sign, $message_4);
			$message_6 = str_replace("[companyName]", $title, $message_5);
			$message = str_replace("[booked_date]", $date, $message_6);
			$staff_app_booked = $wpdb -> get_var($wpdb->prepare('SELECT app_booked FROM ' . $wpdb -> prefix . sm_staff_notifications));
			if ($staff_app_booked == 1) {
				$headers = "From: " . $title . "<" . $admin_email . ">" . "\r\n";
				$headers .= "Bcc: " . $emp_email . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
			} else {
				$headers = "From: " . $title . "<" . $admin_email . ">" . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8";
				$headers .= "Content-Transfer-Encoding: quoted-printable";
			}
			wp_mail($to, $subject, $message, $headers);
		}
	} else if ($_REQUEST["method"] == "disapprove") {
		$booking_id = intval($_REQUEST['idd']);
		$wpdb -> query($wpdb -> prepare("UPDATE " . $wpdb -> prefix . "sm_bookings SET status = %s WHERE id = %d", "Disapproved", $booking_id));
		$admin_email = get_settings('admin_email');
		$client_id = $wpdb -> get_var($wpdb->prepare("SELECT client_id From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$service_id = $wpdb -> get_var($wpdb->prepare("SELECT service_id From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$empid = $wpdb -> get_var($wpdb->prepare("SELECT emp_id From  " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$emp_nam = $wpdb -> get_var($wpdb->prepare("SELECT emp_name From  " . $wpdb -> prefix . sm_employees . " WHERE id = %d", $empid));
		$day = $wpdb -> get_var($wpdb->prepare("SELECT day From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$month = $wpdb -> get_var($wpdb->prepare("SELECT month From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$year = $wpdb -> get_var($wpdb->prepare("SELECT year From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$hour = $wpdb -> get_var($wpdb->prepare("SELECT hour From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$minute = $wpdb -> get_var($wpdb->prepare("SELECT minute From   " . $wpdb -> prefix . sm_bookings . " WHERE id = %d", $booking_id));
		$name = $wpdb -> get_var($wpdb->prepare("SELECT name From  " . $wpdb -> prefix . sm_clients . " WHERE id = %d", $client_id));
		$email = $wpdb -> get_var($wpdb->prepare("SELECT email From  " . $wpdb -> prefix . sm_clients . " WHERE id = %d", $client_id));
		$telephone = $wpdb -> get_var($wpdb->prepare("SELECT mobile From  " . $wpdb -> prefix . sm_clients . " WHERE id = %d", $client_id));
		$service_name = $wpdb -> get_var($wpdb->prepare("SELECT name From  " . $wpdb -> prefix . sm_services . " WHERE id = %d", $service_id));
		$table_name = $wpdb -> prefix . "sm_email_signature";
		$email_sign = $wpdb -> get_var($wpdb->prepare('SELECT initial  FROM ' . $table_name));
		$title = get_bloginfo('name');
		$textual_month = date('M', mktime(0, 0, 0, $month, $day, $year));
		$date = $day . " " . $textual_month . " " . $year;
		$to = $email;
		if ($hour < 10) {
			$hour = "0" . $hour;
		}
		if ($minute < 10) {
			$minute = "0" . $minute;
		}
		$time = $hour . ":" . $minute;
		$msg_stored = $wpdb -> get_var($wpdb->prepare('SELECT content  FROM ' . $wpdb -> prefix . sm_emails . ' WHERE type = "decline_client"'));
		$msg_sub = $wpdb -> get_var($wpdb->prepare('SELECT subject FROM ' . $wpdb -> prefix . sm_emails . ' WHERE type = "decline_client"'));
		$msg_1 = str_replace("[first name]", $name, $msg_stored);
		$msg_2 = str_replace("[service]", $service_name, $msg_1);
		$msg_3 = str_replace("[date]", $date, $msg_2);
		$msg_4 = str_replace("[time]", $time, $msg_3);
		$msg_5 = str_replace("[employee_name]", $emp_nam, $msg_4);
		$msg_6 = str_replace("[signature]", $email_sign, $msg_5);
		$msg_7 = str_replace("[companyName]", $title, $msg_6);
		$headers = "From: " . $title . "<" . $admin_email . ">" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8";
		$headers .= "Content-Transfer-Encoding: quoted-printable";
		wp_mail($to, $msg_sub, $msg_7, $headers);

	}
}
die;
}
?>