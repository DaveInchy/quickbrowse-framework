<h3>$MAIL-><?=$page;?>()</h3>
<p class="lead">Adds an attachment by strings like generated PDF's or other generated files, give the attached string a filename to show up as attached file.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/phpmailer/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>