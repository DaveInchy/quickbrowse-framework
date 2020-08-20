<h3 class="text-uppercase">$MAIL</h3>
<p class="lead">Module for handling mail related functions, Powered by PHPMailer.</p>
<p><span class="text-danger">Requirements:</span> You need to require PHPMailer in your require.php for your Template.<br>You can find an Example on <a href="<?=$QUICKBROWSE->DOMAIN;?>/docs/get-started"><?=$QUICKBROWSE->DOMAIN;?>/docs/get-started</a>.</p>
<p>Example:</p>
<?php
	//Display code example
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/modules/phpmailer.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<p>Variables:</p>
<ul>
	<li><a href="./phpmailer/errorinfo">ErrorInfo</a></li>
	<li><a href="./phpmailer/subject">Subject</a></li>
	<li><a href="./phpmailer/body">Body</a></li>
	<li><a href="./phpmailer/altbody">AltBody</a></li>
</ul>
<p>Functions:</p>
<ul>
	<li><a href="./phpmailer/setfrom">setFrom()</a></li>
	<li><a href="./phpmailer/addaddress">addAddress()</a></li>
	<li><a href="./phpmailer/ishtml">isHTML()</a></li>
	<li><a href="./phpmailer/addattachment">addAttachment()</a></li>
	<li><a href="./phpmailer/addstringattachment">addStringAttachment()</a></li>
	<li><a href="./phpmailer/addembeddedimage">addEmbeddedImage()</a></li>
	<li><a href="./phpmailer/send">send()</a></li>
</ul>