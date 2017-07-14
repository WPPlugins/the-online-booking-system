<?php
error_reporting(0);
function installDatabase()
{
		 
    global $wpdb;
    $table_name = $wpdb->prefix . "sm_services";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) 
	{
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            name VARCHAR(100),
            cost DECIMAL(10, 2),
			rank INTEGER(5),
            PRIMARY KEY (id)
            )';
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option('service_manager_version', '1.0');
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_services ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX services_index ON ".$wpdb->prefix."sm_services (id)"
			    )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_services CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);
	}	
    $table_name = $wpdb->prefix . "sm_services_time";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) 
	{
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            service_id INTEGER(10),
            hours INT(2),
            minutes INT(2),
            gap_start_hour INT(2),
            gap_start_minute INT(2),
            gap_end_hour INT(2),
            gap_end_minute INT(2),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_services_time ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX services_time_index ON ".$wpdb->prefix."sm_services_time (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_services_time CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			    )
			);
	}		
    $table_name = $wpdb->prefix . "sm_clients";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name){
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            name VARCHAR(100),
			lastname VARCHAR(50),
            email VARCHAR(100),
            telephone VARCHAR(100),
			addressLine1 VARCHAR(50),
			addressLine2 VARCHAR(50),
			city VARCHAR(20),
			postalcode VARCHAR(10),
			country VARCHAR(50),
            comments TEXT,
			mobile VARCHAR(20),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_clients ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX clients_index ON ".$wpdb->prefix."sm_clients (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_clients CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);
	}	
    $table_name = $wpdb->prefix . "sm_bookings";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name)
	{
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            service_id INTEGER(10),
            client_id INTEGER(10),
			StartTime DATETIME,
			EndTime DATETIME,
            day INT(2),
            month INT(2),
            year INT(4),
            hour INT(2),
            minute INT(2),
			Date DATE NULL,
			color VARCHAR(20),
            status VARCHAR(100),
			emp_id INT(10),
			note VARCHAR(250),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_bookings ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX bookings_index ON ".$wpdb->prefix."sm_bookings (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_bookings CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);
	}	
    $table_name = $wpdb->prefix . "sm_timings";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name){
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            day VARCHAR(10),
            start_hour INT(2),
            start_minute INT(2),
            end_hour INT(2),
            end_minute INT(2),
            blocked TINYINT(1),
			timing_id INT(10),
			emp_id INT(10),
            PRIMARY KEY (id)
            )';
          dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_timings ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX timings_index ON ".$wpdb->prefix."sm_timings (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_timings CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_allocate_serv";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            emp_id INT(10),
			serv_id INT(10),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_allocate_serv ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX allocate_serv_index ON ".$wpdb->prefix."sm_allocate_serv (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_allocate_serv CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
	}	
    $table_name = $wpdb->prefix . "sm_block_date";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			day INT(10),
			month INT(10),
			year INT(10),
			block_date DATE,
            emp_id INT(10),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
		if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_block_date ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX block_date_index ON ".$wpdb->prefix."sm_block_date (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_date CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_employees";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            emp_name VARCHAR(30),
			emp_code VARCHAR(20),
			email VARCHAR(50),
			phone VARCHAR(25),
			emp_color VARCHAR(20),
			status VARCHAR(20),
			image VARCHAR(100),
            PRIMARY KEY (id)
            )';
		dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_employees ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX employees_index ON ".$wpdb->prefix."sm_employees (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_employees CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_emails";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            content TEXT,
            type VARCHAR(100),
			subject VARCHAR(200),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(type) FROM ' . $wpdb->prefix . sm_emails);
       if ($cont == 0) {
		
					
			$wpdb->insert($table_name, array('type' => "single_client", 'content' => "<p></p><p style=\"margin-right: 0cm; margin-left: 0cm; font-family: 'Times New Roman', serif;\"><span style=\"font-size: 8.5pt; font-family: Arial, sans-serif;\">Hi </span> <span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px;\">[client_name],</span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><span style=\"font-size: 8.5pt; font-family: Arial, sans-serif;\">This email is just to let you know that i have received your booking request and it is now Pending Confirmation. <br><br>Shortly you should receive from me a confirmation e-mail. (Please ensure to check your Spam / Junk folders as sometimes emails might be caught there for no reason)<br><strong><br>You booking request details:</strong><br>Coming in for: </span> <span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px;\">[service_name]</span> <span style=\"font-size: 8.5pt; font-family: Arial, sans-serif;\"><br>Request Date: </span> <span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px;\">[booked_date] </span> <span style=\"font-size: 8.5pt; font-family: Arial, sans-serif;\"><br>Request Time: </span> <span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px;\">[booked_time]</span><span style=\"font-size: 8.5pt; font-family: Arial, sans-serif;\"><br>Employee Name: </span> <span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">[employee_name]</span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><br><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\"></span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\"><br></span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \">[employee_name]</span>
			</p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \"><br></span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">[signature]</span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman',serif;\"><br></p>", 'subject' => "Your Booking is now Pending Confirmation"));
           
			$wpdb->insert($table_name, array('type' => "single_client_confirm", 'content' => "<p><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">Dear [client_name],</span></p><p></p><p><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">Your booking for [service_name] on [booked_date] at [booked_time] is now <span style=\"font-weight: bold; color: #008000;\">CONFIRMED!</span></span></p><p><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">I look forward to seeing you, please ensure to be 5 minutes early for your appointment.</span></p><p><span style=\"color: #ff0000; font-size: 11px; font-family: arial,helvetica,sans-serif;\">**<span style=\"text-decoration: underline;\">Cancellation Policy:</span> Booking must be cancelled at least 48hours prior to your appointment.</span></p><p></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman', serif; \"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \"><br></span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman', serif; \"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \">[employee_name]</span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman', serif; \"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \"><br></span></p><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-family: 'Times New Roman', serif; \"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px; \">[signature]</span></p><p></p>", 'subject' => "CONFIRMATION for Booking - Thank you"));
          
			$wpdb->insert($table_name, array('type' => "admin", 'content' => "<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p>Dear Admin<br><br>A new booking request was made by [client_name] for [service_name] on the [booked_date] at [booked_time] .</p><p></p><p>Their contact details are:</p><p>Email: [email_address]<br>Mobile: [mobile_number]</p><p></p><p>You now need to [approve] or [deny] the booking.<br> </p>", 'subject' => "Hi Admin - A New Booking was made"));
            $wpdb->insert($table_name, array('type' => "decline_client", 'content' => "<p><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">Hi [first name]</span></p><p><span style=\"font-family: arial,helvetica,sans-serif; font-size: 11px;\">Sorry but your appointment for [service] on [date] of at [time] is unfortunately unavailable.<br> <br>You are receiving this email because the Administrator has just decline your appointment which can be for a verity of different reasons that has to do with availability on that specific time or service.<br> <br>We recommend that you either try to book for another time or date or alternatively contact us for further information.<br> <br>Thank you for your understanding and we look forward seeing soon.</span></p><p><span style=\"font-family: arial, helvetica, sans-serif; font-size: 11px;\">[employee_name]<br>[signature]</span></p>", 'subject' => "Booking Cancellation Notice"));  
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_emails ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX emails_index ON ".$wpdb->prefix."sm_emails (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_emails CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
	$table_name = $wpdb->prefix . "sm_currency";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) 
	{
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            currency  VARCHAR(50),
			currency_used  INTEGER(1),
			currency_sign  VARCHAR(10) character set utf8 NOT NULL,
			PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(currency) FROM ' . $wpdb->prefix . sm_currency);
        if ($cont == 0) 
		{
            $wpdb->query
			(
			      $wpdb->prepare
			      (
			          "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			          "Australian Dollar",
			          "0",
			          "$"
			      )
			);
            $wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			           "Canadian Dollar",
			           "0",
			           "$"
			       )
			);
			
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			           "Denmark Krone",
			           "0",
			           "Kr."
			
			        )
			);
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			           "Euro",
			           "0",
			           "&#128"
				   )
			);	
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			   	       "Japan Yen",
			   	       "0",
			   	       "&yen"
				   )
			);
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			           "British Pound",
			           "0",
			           "&pound"
                   )
			);
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_currency(currency,currency_used,currency_sign) VALUES(%s, %d, %s)",
			           "United States Dollar",
			           "1",
			           "$"	
			       )
			);
            
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_currency ."'") == $table_name);
	{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX currency_index ON ".$wpdb->prefix."sm_currency (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_currency CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
	}	
    $table_name = $wpdb->prefix . "sm_settings";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) 
	{
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            fb_api  VARCHAR(100),
			fb_secret VARCHAR(100),
			wp_secret VARCHAR(100),
			book_header TEXT,
			fbradio varchar(1),
			TimeFormat varchar(1),
			minuteformat varchar(1),
			thanks TEXT NOT NULL,
			PRIMARY KEY (id)
            )';
			dbDelta($sql);
		 $cont = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . sm_settings);
		if ($cont == 0) 
		{
			$wpdb->query
			(
			      $wpdb->prepare
			       (
			           "INSERT INTO ".$wpdb->prefix."sm_settings(fbradio,TimeFormat,minuteformat,book_header,thanks) VALUES(%s, %s, %s, %s, %s)",
			           "0",
			           "1",
			           "1",
			           "You can change this title from your \"setting\" tab to anything you want.",
			           "Thank you for requesting an appointment with us.<br>You will shortly receive an email acknowledging your request  and a member of staff will later contact you to confirm your<br>appointment has been booked.<br>(Please ensure to check your Spam / Junk folders as sometimes emails are caught there).<br><br>Thank you for using our online booking service.<br>The Support Team"	
			       )
			);	
		}
	}
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_settings ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX settings_index ON ".$wpdb->prefix."sm_settings (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_settings CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_settings ADD minuteformat varchar(1)"
			     )
			);	
			$minu = $wpdb->get_var('SELECT minuteformat FROM ' . $wpdb->prefix . sm_settings . ' where id = 1');
			if($minu==" " && $minu== null)
			{
				$wpdb->query
				(
				    $wpdb->prepare
				    (
				         "UPDATE ".$wpdb->prefix."sm_settings SET minuteformat = %d",
				         1
				     )
				);	
				
			}
		}	
    $table_name = $wpdb->prefix . "sm_booking_link_img";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(4) UNSIGNED AUTO_INCREMENT,
            image  VARCHAR(50),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(image) FROM ' . $wpdb->prefix . sm_booking_link_img);
        if ($cont == 0) 
        {
        	$wpdb->query
			(
			    $wpdb->prepare
			    (
			          "INSERT INTO ".$wpdb->prefix."sm_booking_link_img(image) VALUES(%s)",
			          "book_online_hover.png"
			    )
			);
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_booking_link_img ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX booking_link_img_index ON ".$wpdb->prefix."sm_booking_link_img (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_booking_link_img CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
			
		}
    $table_name = $wpdb->prefix . "sm_cuntry";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			name VARCHAR(80),
			used INT(1),
			deflt INT(1),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(name) FROM ' . $wpdb->prefix . sm_cuntry);
        if ($cont == 0) 
        {
        	
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Afganisthan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Aland Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Albania",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Algeria",
		                0,
		                0		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "American Samoa",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Andorra",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Angola",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Anguilla",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Antarctica",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Antigua and Barbuda",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Argentina",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Armenia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Aruba",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Australia",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Austria",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Azerbaijan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bahamas",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bahrain",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bangladesh",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Barbados",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Belarus",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Belgium",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Belize",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Benin",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bermuda",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bhutan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bolivia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bosnia and Herzegovina",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Botswana",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bouvet Island",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Brazil",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "British Indian Ocean territory",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Brunei Darussalam",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Bulgaria",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Burkina Faso",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Burundi",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cambodia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cameroon",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Canada",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cape Verde",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cayman Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Central African Republic",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Chad",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Chile",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "China",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Christmas Island",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cocos (Keeling) Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Colombia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Comoros",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Congo",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Democratic Republic",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cook Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Costa Rica",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Côte d Ivoire (Ivory Coast)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Croatia (Hrvatska)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cuba",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Cyprus",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Czech Republic",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Denmark",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Djibouti",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Dominica",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Dominican Republic",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "East Timor",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Ecuador",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Egypt",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "El Salvador",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Equatorial Guinea",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Eritrea",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Estonia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Ethiopia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Falkland Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Faroe Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Fiji",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Finland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "France",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "French Guiana",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "French Polynesia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "French Southern Territories",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Gabon",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Gambia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Georgia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Germany",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Ghana",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Gibraltar",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Greece",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Greenland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Grenada",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guadeloupe",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guam",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guatemala",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guinea",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guinea-Bissau",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Guyana",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Haiti",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Heard and McDonald Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Honduras",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Hong Kong",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Hungary",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Iceland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "India",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Indonesia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Iran",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Iraq",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Ireland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Israel",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Italy",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Jamaica",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Japan",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Jordan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Kazakhstan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Kenya",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Kiribati",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Korea (north)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Korea (south)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Kuwait",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Kyrgyzstan",
		                "0",
		                "0"		  
				  ) 
			
			
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Lao Peoples Democratic Republic",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Latvia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Lebanon",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Lesotho",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Liberia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Libyan Arab Jamahiriya",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Liechtenstein",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Lithuania",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Luxembourg",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Macao",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Macedonia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Madagascar",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Malawi",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Malaysia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Maldives",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mali",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Malta",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Marshall Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Martinique",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mauritania",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mauritius",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mayotte",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mexico",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Micronesia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Moldova",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Monaco",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mongolia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Montserrat",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Morocco",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Mozambique",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Myanmar",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Namibia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Nauru",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Nepal",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Netherlands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Netherlands Antilles",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "New Caledonia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "New Zealand",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Nicaragua",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Niger",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Nigeria",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Niue",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Norfolk Island",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Northern Mariana Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Norway",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Oman",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Pakistan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Palau",
		                "0",
		                "0"		  
				  ) 
			
			
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Palestinian Territories",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Panama",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Papua New Guinea",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Paraguay",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Peru",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Philippines",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Pitcairn",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Poland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Portugal",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Puerto Rico",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Qatar",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Réunion",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Romania",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Russian Federation",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Rwanda",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saint Helena",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saint Kitts and Nevis",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saint Lucia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saint Pierre and Miquelon",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saint Vincent and the Grenadines",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Samoa",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Sao Tome and Principe",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Saudi Arabia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Senegal",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Serbia and Montenegro",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Seychelles",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Sierra Leone",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Singapore",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Slovakia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Slovenia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Solomon Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Somalia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "South Africa",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "South Georgia and the South Sandwich Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Sri Lanka",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Sudan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Suriname",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Svalbard and Jan Mayen Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Swaziland",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Syria",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Taiwan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tajikistan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tanzania",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Thailand",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Togo",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tokelau",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tonga",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Trinidad and Tobago",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tunisia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Turkey",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Turkmenistan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Turks and Caicos Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Tuvalu",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Uganda",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Ukraine",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "United Arab Emirates",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "United Kingdom",
		                "0",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "United States of America",
		                "1",
		                "1"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Uruguay",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Uzbekistan",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Vanuatu",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Vatican City",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Venezuela",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Vietnam",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Virgin Islands (British)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Virgin Islands (US)",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Wallis and Futuna Islands",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Western Sahara",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Yemen",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Zaire",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Zambia",
		                "0",
		                "0"		  
				  ) 
			);
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_cuntry(name,used,deflt)VALUES(%s, %d, %d)",
		                "Zimbabwe",
		                "0",
		                "0"		  
				  ) 
			);
			
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_cuntry ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX cuntry_index ON ".$wpdb->prefix."sm_cuntry (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_cuntry CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);		
		}	
    $table_name = $wpdb->prefix . " sm_customer_notifications";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            app_booked INT(1),
			app_cenceled INT(1),
			app_edit INT(1),
			app_confirm INT(1),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_customer_notifications ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX customer_notifications_index ON ".$wpdb->prefix."sm_customer_notifications (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_customer_notifications CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_email_signature";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(4) UNSIGNED AUTO_INCREMENT,
			initial TEXT,
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(initial) FROM ' . $wpdb->prefix . sm_email_signature);
        if ($cont == 0) 
		{
			$wpdb->query
			(
			      $wpdb->prepare
		 	      (
		                "INSERT INTO ". $wpdb->prefix . "sm_email_signature(initial)VALUES(%s)",
		                "Your Global E-mail Signature<br>[This is your main email signature It can be changed to anything you want and will appear in all emails sent from the website You can change it from the Admin panel under the “Email Templates” tab &gt;&gt;&gt; Email signature]"
		          ) 
			);	
           
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_email_signature ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX email_signature_index ON ".$wpdb->prefix."sm_email_signature (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_email_signature CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_staff_notifications";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(4) UNSIGNED AUTO_INCREMENT,
			app_booked INT(1),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(app_booked) FROM ' . $wpdb->prefix . sm_staff_notifications);
        if ($cont == 0) 
        {
        	$wpdb->query
            (
                  $wpdb->prepare
                  (
                        "INSERT INTO ".$wpdb->prefix."sm_staff_notifications(app_booked)VALUE(%d)",
                        1
				  )
			);	
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_staff_notifications ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX staff_notifications_index ON ".$wpdb->prefix."sm_staff_notifications (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_staff_notifications CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
    $table_name = $wpdb->prefix . "sm_customer_notifications";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(4) UNSIGNED AUTO_INCREMENT,
			app_booked INT(1),
			app_cenceled INT(1),
			app_edit INT(1),
			app_confirm INT(1),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(app_booked) FROM ' . $wpdb->prefix . sm_customer_notifications);
        if ($cont == 0) 
        {
        	$wpdb->query
	        (
			      $wpdb->prepare
			      (
			            "INSERT INTO ". $wpdb->prefix."sm_customer_notifications(app_booked,app_cenceled,app_edit,app_confirm)values(%d, %d,%d,%d)",
			            "1", 
			            "1",
			            "1",
			            "1"  
			      
				  )
			);	
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_customer_notifications ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX customer_notifications_index ON ".$wpdb->prefix."sm_customer_notifications (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_customer_notifications CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
		}	
	 $table_name = $wpdb->prefix . "sm_block_time";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			day INT(2),
			month INT(2),
			year INT(4),
			emp_id INT(5),
			block_time TIME,
			hour INT(2),
			minute INT(2),
			blocked  INT(1),
			block_date_id INT(5),
			timeof  DATETIME,
			endtime  DATETIME,
			PRIMARY KEY (id)
            )';
        dbDelta($sql);
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_block_time ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX block_time_index ON ".$wpdb->prefix."sm_block_time (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_time CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);	
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_time ADD timeof DATETIME"
			     )
			);	
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_time ADD endtime DATETIME"
			     )
			);	
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_time ADD blocked INT(1)"
			     )
			);	
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_block_time ADD block_date_id INT(5)"
			     )
			);
		}	
    $table_name = $wpdb->prefix . "sm_booking_field";
    if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			field_name VARCHAR(100),
			field_name2 VARCHAR(100),
			status INT(1),
			required INT(1),
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(field_name) FROM ' . $wpdb->prefix . sm_booking_field);
        if ($cont == 0) 
        {
        	$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix. "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Email :",
		                "Email :",
		                "1",
		                "1"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "First Name :",
		                "First Name :",
		                "1",
		                "1"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Last Name :",
		                "Last Name :",
		                "1",
		                "1"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Mobile :",
		                "Mobile :",
		                "1",
		                "0"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Phone :",
		                "Phone :",
		                "1",
		                "0"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Address Line1 :",
		                "Address Line1 :",
		                "1",
		                "0"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Address Line2 :",
		                "Address Line2 :",
		                "1",
		                "0"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "City :",
		                "City :",
		                "1",
		                "0"
		          )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Zip/Post Code :",
		                "Zip/Post Code :",
		                "1",
		                "0"
		         )
			);
			$wpdb->query
			(      
			      $wpdb->prepare
			      (
		                "INSERT INTO ".$wpdb->prefix . "sm_booking_field(field_name,field_name2,status,required)VALUES(%s, %s, %d, %d)",
		                "Country :",
		                "Country :",
		                "1",
		                "0"
		          )
			);	
			
        }
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_booking_field ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX booking_field_index ON ".$wpdb->prefix."sm_booking_field (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_booking_field CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);
		}	
		$table_name = $wpdb->prefix . "sm_translation";
    	if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
        $sql = 'CREATE TABLE ' . $table_name . '( 
			id INTEGER(4) UNSIGNED AUTO_INCREMENT,
			item VARCHAR(500),
			value TEXT,
			translate TEXT NOT NULL,
            PRIMARY KEY (id)
            )';
        dbDelta($sql);
        $cont = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . sm_translation);
        if ($cont == 0)
        {
        	$wpdb->query
			(
                  $wpdb->prepare
                  ( 
                        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s, %s, %s)",
                        "ChooseService",
                        "Choose Service",
                        "Choose Service"
				  ) 			
			);
			
			
			$wpdb->query
			(
                  $wpdb->prepare
                  ( 
                        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s, %s, %s)",
                        "ChooseProvider",
                        "Choose Provider",
                        "Choose Provider"
				  ) 			
			);
			
			$wpdb->query
			(
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s, %s, %s)",
				        "DateandTime",
				        "Date and Time",
				        "Date & Time"
				  )
			
			);
			
			
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "YourInformation",
				        "Your Information",
				        "Your Information"
				        
				  ) 
			
			);
			
			
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ReviewandConfirm",
				        "Review and Confirm",
				        "Review & Confirm"
				        
				  ) 
			
			);
			
			
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "BookanAppointmentNow",
				        "Book an Appointment Now",
				        "Book an Appointment Now"
				        
				  ) 
			
			);
			
			
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ChooseaService",
				        "Choose a Service",
				        "Choose a Service "
				        
				  ) 
			
			);
			
			
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "Duration",
				        "Duration",
				        "Duration "
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "Price",
				        "Price",
				        "Price"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "NextStep",
				        "Next Step",
				        "Next Step"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ChooseyourServiceProvider",
				        "Choose your Service Provider",
				        "Choose your Service Provider"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "BackStep",
				        "Back Step",
				        "Back Step"
				 ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ChooseyourDate",
				        "Choose your Date",
				        "Choose your Date"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ChooseyourSlot",
				        "Choose your Slot",
				        "Choose your Slot "
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "BookItNow!",
				        "Book It Now!",
				        "Book It Now!"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ThankyouforBookinganAppointment",
				        "Thank you for Booking an Appointment",
				        "Thank you for Booking an Appointment"
				 ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "Sorry,youaretryingtobookandappointmentthatexceedtheopeninghoursofourbusiness.Pleasetryanearliertimeorcontactusdirectly.",
				        "Sorry, you are trying to book and appointment that exceed the opening hours of our business. Please try an earlier time or contact us directly.",
				        "Sorry, you are trying to book and appointment that exceed the opening hours of our business. Please try an earlier time or contact us directly."
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "Sorry,youaretryingtobookanappointmentwhichexceedsavailableservicetimings.",
				        "Sorry, you are trying to book an appointment which exceeds available service timings.",
				        "Sorry, you are trying to book an appointment which exceeds available service timings."
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "APPOINTMENTSCALENDAR",
				        "APPOINTMENTS CALENDAR",
				        "APPOINTMENTS CALENDAR"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "CustomerType:",
				        "Customer Type :",
				        "Customer Type :"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "NewCustomer",
				        "New Customer",
				        "New Customer"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ExistingCustomer",
				        "Existing Customer",
				        "Existing Customer"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ServiceName:",
				        "Service Name :",
				        "Service Name :"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "ServiceProvider:",
				        "Service Provider :",
				        "Service Provider :"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "BookingDate:",
				        "Booking Date :",
				        "Booking Date :"
				  ) 
			);
			$wpdb->query
			( 
			      $wpdb->prepare
			      (
				        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
				        "BookingTime:",
				        "Booking Time :",
				        "Booking Time :"
				  ) 
			);
		}
    }
	if($wpdb->get_var('SHOW TABLES LIKE ' .  "'" . $wpdb->prefix . sm_translation ."'") == $table_name);
		{
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "CREATE INDEX translation_index ON ".$wpdb->prefix."sm_translation (id)"
			     )
			);
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "ALTER TABLE ".$wpdb->prefix."sm_translation CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci"
			     )
			);
			$conts = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . sm_translation);
			if($conts == 18)
			{
				$wpdb->query
                (
                       $wpdb->prepare
                       (
                             "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
                             "APPOINTMENTSCALENDAR",
                             "APPOINTMENTS CALENDAR",
                             "APPOINTMENTS CALENDAR"					   
					   )                 
                );
			}
			$conts = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . sm_translation);
			if($conts == 19)
			{
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "CustomerType:",
					        "Customer Type :",
					        "Customer Type :"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "NewCustomer",
					        "New Customer",
					        "New Customer"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "ExistingCustomer",
					        "Existing Customer",
					        "Existing Customer"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "ServiceName:",
					        "Service Name :",
					        "Service Name :"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "ServiceProvider:",
					        "Service Provider :",
					        "Service Provider :"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "BookingDate:",
					        "Booking Date :",
					        "Booking Date :"
					  ) 
				);
				$wpdb->query
				( 
				      $wpdb->prepare
				      (
					        "INSERT INTO ".$wpdb->prefix."sm_translation(item,value,translate)VALUES(%s,%s,%s)",
					        "BookingTime:",
					        "Booking Time :",
					        "Booking Time :"
					  ) 
				);  	
			}
			$tempVriable1 = "DateandTime";
			$tempVriable2 = "Date and Time";
			$tempVriable3 = "Date&Time";
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "UPDATE ".$wpdb->prefix."sm_translation SET item = %s, value  = %s WHERE item =%s",
			         $tempVriable1,
			         $tempVriable2,
			         $tempVriable3
			     )
			);
			$tempVriable11 = "ReviewandConfirm";
			$tempVriable21 = "Review and Confirm";
			$tempVriable31 = "Review&Confirm";
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "UPDATE ".$wpdb->prefix."sm_translation SET item = %s, value  = %s WHERE item =%s",
			         $tempVriable11,
			         $tempVriable21,
			         $tempVriable31
			     )
			);
			$trns1 = "Sorry,youaretryingtobookandappointmentthatexceedtheopeninghoursofourbusiness.Pleasetryanearliertimeorcontactusdirectly.";
			$trans2 = "Sorry, you are trying to book and appointment that exceed the opening hours of our business. Please try an earlier time or contact us directly.";
			$wpdb->query
			(
			    $wpdb->prepare
			    (
			         "UPDATE ".$wpdb->prefix."sm_translation SET item = %s WHERE value =%s",
			         $trns1,
			         $trans2
			     )
			);
		}
}
?>