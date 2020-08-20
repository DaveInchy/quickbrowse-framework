<h3>$MAIL-><?=$page;?>()</h3>
<p class="lead">Sending the $MAIL object as mail. if something went wrong, returns false and $MAIL->ErrorInfo.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>