<?php
$error = '';
$success = '';
if(isset($_POST['contact_submit'])){
	
	if(!isset($_POST['contact_email']) || empty($_POST['contact_email'])){
		$error = 'Please make sure you filled in an email address.';
	}
	if(!isset($_POST['contact_subject']) || empty($_POST['contact_subject'])){
		$error = 'Please make sure you selected a subject category.';
	}
	if(!isset($_POST['contact_content']) || empty($_POST['contact_content'])){
		$error = 'Please make sure you wrote some content for us.';
	}
	if(!$QB->USER->is_logged_in()){
		$error = 'You can only contact us while logged in.';
	}
	
	//If theres no error, send email to contact
	if($error == '' || empty($error)){
		$QB->MAIL->setFrom($_POST['contact_email']);
		$QB->MAIL->addAddress('contact@quickbrow.se', 'QuickBrowse');
		$QB->MAIL->Subject = 'Contact form: ' . $_POST['contact_subject'] . ' from ' . $_POST['contact_email'];
		$QB->MAIL->Body = $_POST['contact_content'];
		if(!$QB->MAIL->send()) {
		  $error =  'Message was not sent.';
		} else {
		  $success = 'Message has been sent.';
		}
	}
}
?>