<h3>$DATA-><?=$page;?>()</h3>
<p class="lead">Returns a multi-dimensional Array with keys for the given table.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/data/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>