<?php

		$field_name = $_POST['name'];
		$field_email = $_POST['email'];
		$field_website = $_POST['web'];
		$field_message = $_POST['message'];

		$mail_to = 'brynvillegas@gmail.com';

		$subject = 'Message from a site visitor ' . $field_name;

		$body_message = 'From: '.$field_name."\n";
		$body_message .= 'E-mail: '.$field_email."\n";
		$body_message .= 'Website: '.$field_website."\n";
		$body_message .= 'Message: '.$field_message;

		$headers = "From: $email\r\n";
		$headers .= "Reply-To: $email\r\n";
		
        $captcha;
		if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h3 style="text-align: center; margin:0;">Please check the the captcha form.</h3>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeO4wUTAAAAAHCFJP4tWhdjMUBEy1e1-_cGojWw&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h3 style="text-align: center; margin:0;">Sorry please try again.</h3>';
        }else
        {
          echo '<h3 style="text-align: center;">Thank you for the message. I will contact you shortly.</h3>';
		  $mail_status = mail($mail_to, $subject, $body_message, $headers);
        }
?>
