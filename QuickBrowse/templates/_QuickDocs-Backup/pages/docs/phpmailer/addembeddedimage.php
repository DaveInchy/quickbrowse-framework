<h3>$MAIL-><?=$page;?>()</h3>
<p class="lead">Link an already attached image to a content identifier that could be used in the body if $MAIL->isHTML() (example content id: 'image_1').</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>