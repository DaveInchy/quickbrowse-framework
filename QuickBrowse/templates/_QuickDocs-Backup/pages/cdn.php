<?=$QUICKBROWSE->ASSETS->PACKAGE->header('Assets', 'All Assets included in QuickBrowse', 'bg-gradient-purple text-center');?>
<section id="cdn-list">
	<div class="container">
		<h2>CDN</h2>
		<p class="lead">A list with all types of assets included in QuickBrowse.</p>
		<?=$QUICKBROWSE->ASSETS->print_assets();?>
	</div>
</section>