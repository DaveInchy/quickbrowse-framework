<h3>$DATA-><?=$page;?>()</h3>
<p class="lead">Creates a row in the database with data for the given table.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/data/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>