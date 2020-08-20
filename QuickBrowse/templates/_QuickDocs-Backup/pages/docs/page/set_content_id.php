<h3>$PAGE-><?=$page;?>()</h3>
<p class="lead">Set the content id of your page before reloading the URL with $PAGE->set_page().</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/page/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>