<h3 class="text-uppercase">$QUICKBROWSE-><?=$page;?></h3>
<p class="lead">Returns debug state (on/off).</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/quickbrowse/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>