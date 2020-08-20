<h3 class="text-uppercase">$PAGE-><?=$page;?></h3>
<p class="lead">Errors about running functions.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>