<h3>$MAIL-><?=$page;?></h3>
<p class="lead">Returns the error of $MAIL after $MAIL->send();</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>