<h3>$PAGE-><?=$page;?>()</h3>
<p class="lead">Returns the page's file name without '.php'.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>