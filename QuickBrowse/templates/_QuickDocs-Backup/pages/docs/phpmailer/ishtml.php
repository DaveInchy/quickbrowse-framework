<h3>$MAIL-><?=$page;?>()</h3>
<p class="lead">Set the state of the email having a html coded body.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>