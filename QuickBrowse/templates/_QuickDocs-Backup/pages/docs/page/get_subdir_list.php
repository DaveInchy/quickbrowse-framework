<h3>$PAGE-><?=$page;?>()</h3>
<p class="lead">Returns an single-dimensional Array with sub-directories in the current URL.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>