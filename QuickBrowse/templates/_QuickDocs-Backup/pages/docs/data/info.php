<h3 class="text-uppercase">$DATA-><?=$page;?></h3>
<p class="lead">Info about running functions.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>