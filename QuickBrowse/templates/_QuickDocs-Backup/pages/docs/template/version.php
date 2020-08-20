<h3 class="text-uppercase">$TEMPLATE-><?=$page;?></h3>
<p class="lead">Returns current Template Version.</p>
<p>Example:</p>
<?php
	//display function code
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/template/' . $page . '.txt';
	$QB->DISPLAY->code_from_txt($file);
?>