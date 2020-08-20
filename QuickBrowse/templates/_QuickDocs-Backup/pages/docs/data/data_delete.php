<h3>$DATA-><?=$page;?>()</h3>
<p class="lead">Deletes a row in the database in the given table for id.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/data/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>