<h3 class="text-uppercase">$USER</h3>
<p class="lead">Module for handling User data and sessions.</p>
<p><span class="text-danger">Requirements:</span> You need to require User in your require.php for your Template.<br>You can find an Example on <a href="<?=$QUICKBROWSE->DOMAIN;?>/docs/get-started"><?=$QUICKBROWSE->DOMAIN;?>/docs/get-started</a>.</p>
<p>Example:</p>
<?php
	//Display code example
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/modules/user.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<p>Variables:</p>
<ul>
	<li><a href="./user/info">INFO</a></li>
	<li><a href="./user/error">ERROR</a></li>
</ul>
<p>Functions:</p>
<ul>
	<li><a href="./user/login">login()</a></li>
	<li><a href="./user/logout">logout()</a></li>
	<li><a href="./user/get_id">get_id()</a></li>
	<li><a href="./user/is_logged_in">is_logged_in()</a></li>
</ul>