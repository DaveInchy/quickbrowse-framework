<h3 class="text-uppercase">$YOUTUBE</h3>
<p class="lead">Module for handling the Youtube API V3.</p>
<p><span class="text-danger">Requirements:</span> You need to require Youtube in your require.php for your Template.<br>You can find an Example on <a href="<?=$QUICKBROWSE->DOMAIN;?>/docs/get-started"><?=$QUICKBROWSE->DOMAIN;?>/docs/get-started</a>.</p>
<p>Example:</p>
<?php
	//Display code example
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/modules/youtube.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<p>Variables:</p>
<ul>
	<li><a href="./youtube/info">INFO</a></li>
	<li><a href="./youtube/error">ERROR</a></li>
</ul>
<p>Functions:</p>
<ul>
	<li><a href="./youtube/get_raw_data">get_raw_data()</a></li>
	<li><a href="./youtube/get_like_rating">get_like_rating()</a></li>
	<li><a href="./youtube/get_key">get_key()</a></li>
</ul>