<h3>$MAIL-><?=$page;?></h3>
<p class="lead">Used for setting the alternative body content of the email when $MAIL->isHTML() is true but the reciever isn't able to process HTML.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>