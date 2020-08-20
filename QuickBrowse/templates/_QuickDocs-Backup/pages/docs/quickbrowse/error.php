<h3 class="text-uppercase">$QUICKBROWSE-><?=$page;?></h3>
<p class="lead">Errors about running functions.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/quickbrowse/' . $page . '.txt';
	$DISPLAY->code_from_txt($file);
?>