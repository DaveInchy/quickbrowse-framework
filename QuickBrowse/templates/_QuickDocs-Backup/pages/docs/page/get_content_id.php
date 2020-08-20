<h3>$PAGE-><?=$page;?>()</h3>
<p class="lead">Returns the content id you saved after reloading the URL with $PAGE->set_page().</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>