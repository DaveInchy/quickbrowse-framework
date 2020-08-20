<?=$QUICKBROWSE->ASSETS->PACKAGE->header('Documentation', 'More information on how to use QuickBrowse', 'bg-gradient-purple text-center');?>
<section id="docs">
	<div class="container">
		<div class="row">
			<div class="col-md-3 order-1 order-md-0">
				<div class="row bg-light p-3 mx-1 text-center">
					<div class="input-group mb-3">
					  <input type="text" class="form-control border-primary" placeholder="Search.." aria-label="Search" aria-describedby="Search">
					  <div class="input-group-append">
						<button class="btn btn-primary" type="button" style="max-height: 45px;" id="Search">Go</button>
					  </div>
					</div>
					<a class="btn btn-block btn-danger" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/get-started#docs">Get Started</a>
					<a class="btn btn-block btn-primary" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/index#docs">Index</a>
					<p class="mt-3">Included Modules</p>
					<a class="btn btn-sm btn-outline-danger btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/page#docs">PAGE</a>
					<a class="btn btn-sm btn-outline-danger btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/data#docs">DATA</a>
					<a class="btn btn-sm btn-outline-danger btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/quickbrowse#docs">QUICKBROWSE</a>
					<a class="btn btn-sm btn-outline-danger btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/template#docs">TEMPLATE</a>
					
					<p class="mt-3">Excluded Modules</p>
					<a class="btn btn-sm btn-outline-primary btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/phpmailer#docs">MAIL</a>
					<a class="btn btn-sm btn-outline-primary btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/youtube#docs">YOUTUBE</a>
					<a class="btn btn-sm btn-outline-primary btn-block" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/user#docs">USER</a>
				</div>
			</div>
			<div class="col-md-9 order-0 order-md-1">
				<div class="row bg-light mb-3 mx-1 p-3 py-4">
					<div class="col-12">
						<h2>Docs <?=$QB->TEMPLATE->VERSION;?></h2>
						<p class="lead">Insight in QuickBrowse's Functionality</p>
						<hr>
						<?php
						//include docs page
						$url_data 		= $QB->URL_DATA;
						$dir 			= $url_data['URL_DIRS'];
						$path 			= $url_data['URL_PATH'];
						$dir_length 	= $url_data['URL_DEPTH'];
						$subdir = "";
						for($i = 1; $i <= $dir_length; $i++){
							$subdir = $subdir . $dir[$i];
						}
						echo $subdir;
						if($subdir == 'docs'){
							$docs = $QUICKBROWSE->TEMPLATE_ROOT . '/pages/docs/index.php';
						}else{
							$docs = $QUICKBROWSE->TEMPLATE_ROOT . '/pages/docs/' . $subdir . '.php';
						}
						if(file_exists($docs)){
							include_once($docs);
						}else{
							$QB->PAGE->redirect('/error/docs-not-found');
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>