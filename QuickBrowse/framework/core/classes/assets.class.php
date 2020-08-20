<?php

class Assets{

	private $QB;
	
	public $CDN_URL = 'https://quickbrow.se/QuickBrowse/assets/';
	
	public $ROOT_DIR;
	public $ROOT_URL;
	
	public $PACKAGE;
	public $ASSET;

	public $INFO = "";
	
	private $ASSET_LIST = Array
	(
		'css/' => Array
		(
			'responsive.css',
			'utility.css'
		),
		'css/lib/animate/' => Array
		(
			'animate.css'
		),
		'css/lib/bootstrap/' => Array
		(
			'bootstrap.min.css',
			'bootstrap-navbar.css'
		),
		'bootswatch/' => Array
		(
			'bootstrap.css',
			'cerulean.css',
			'cosmo.css',
			'cyborg.css',
			'darkly.css',
			'flatly.css',
			'journal.css',
			'litera.css',
			'lumen.css',
			'lux.css',
			'materia.css',
			'minty.css',
			'pulse.css',
			'sandstone.css',
			'simplex.css',
			'sketchy.css',
			'slate.css',
			'spacelab.css',
			'superhero.css',
			'united.css',
			'yeti.css',
		),
		'js/' => Array
		(
			'client.js'
		),
		'js/lib/wowjs/' => Array
		(
			'wow.min.js'
		),
		'js/lib/jquery/' => Array
		(
			'jquery.min.js',
			'jquery-slim.min.js',
			'jquery-easing.min.js'
		),
		'js/lib/bootstrap/' => Array
		(
			'bootstrap.js',
			'bootstrap-navbar.js'
		),
		'img/animated/' => Array
		(
			'circle-broken.svg'
		),
		'img/pattern/' => Array
		(
			'chalkboard.jpg',
			'figures.png',
			
			'stars.svg',
			'stripes.svg',
			'triangles.svg'
		),
		'img/background/' => Array
		(
			
			'space.svg',
			
			'mountains-blue.svg',
			'mountains-dark.svg',
			'mountains-green.svg',
			'mountains-light.svg',
			'mountains-purple.svg',
			'mountains-red.svg',
			'mountains-yellow.svg',
			
			'sharp-gradient-blue.svg',
			'sharp-gradient-dark.svg',
			'sharp-gradient-green.svg',
			'sharp-gradient-light.svg',
			'sharp-gradient-purple.svg',
			'sharp-gradient-red.svg',
			'sharp-gradient-yellow.svg',
			
			'tile-blue.svg',
			'tile-dark.svg',
			'tile-green.svg',
			'tile-light.svg',
			'tile-purple.svg',
			'tile-red.svg',
			'tile-yellow.svg'
		),
		'img/icon/' => Array
		(
			'favicon.ico',
			'favicon-16.png',
			'favicon-32.png',
			'favicon-96.png',
			'favicon-192.png'
		),
		'img/logo/' => Array
		(
			'logo.png',
			
			'logo-doonline-sm.png',
			'logo-webbouwerz-sm.png',
			
			'logo-bootstrap-sm.png',
			'logo-bootswatch-sm.png',
			'logo-bootswatch-lg.png',
			'logo-bootstrap-lg.png',
		)
	);

	function __construct($QUICKBROWSE, $ROOT_URL, $ROOT_DIR, $CDN = false){
		$this->QB = $QUICKBROWSE;
		$this->ROOT_URL = $ROOT_URL;
		$this->ROOT_DIR = $ROOT_DIR;
		if(!$this->load_assets($CDN)){
			$this->QB->DEBUG->error(__METHOD__, "Cannot load assets, Assets constructor failed.");
			return false;
		}
		$this->PACKAGE = new Package($QUICKBROWSE);
		if(!isset($this->PACKAGE) || !$this->PACKAGE){
			$this->QB->DEBUG->error(__METHOD__, "Cannot create Package object, Assets constructor failed.");
			return false;
		}
		return true;
	}

	private function load_assets(){
			foreach($this->ASSET_LIST as $loc => $files){
				foreach($files as $file){
					if(!$this->add_asset($file, $loc)){
						return false;
					}
				}
			}
		return true;
	}

	private function asset_exists($asset){
		$this->INFO = $this->INFO . "\n Checking if asset " . $asset . " exists.";
		if(!isset($this->ASSET[$asset])){
			$this->QB->DEBUG->error(__METHOD__, "No asset found named: " . $asset . ".");
			return false;
		}
		return true;
	}

	function add_asset($file, $location){
		$this->QB->DEBUG->log( "saving asset: " . $location . $file);
		$find = str_replace($this->QB->TEMPLATE_ROOT . '/', '', $location, $i);
		if($i == 0){
			$use_cdn = false;
			$asset = strstr($file, '.', true);
			$asset = strstr($location, '/', true) . '-' . $asset;
			$asset = strtoupper($asset);
			$cdn_url = $this->CDN_URL . $location . $file;
			$url = $this->ROOT_URL . $location . $file;
			$filepath = $this->ROOT_DIR . $location . $file;
			$this->QB->DEBUG->log( "Finished setting data for ASSET with file: " . $location . $file . "");
		}else{
			$use_cdn = $this->QB->USE_CDN;
			$asset = strstr($file, '.', true);
			$asset = 'template-' . $asset;
			$asset = strtoupper($asset);
			$cdn_url = null;
			$url = $this->QB->DOMAIN . '/QuickBrowse/templates/' . $this->QB->TEMPLATE_DIR . '/' . $location . $file;
			$filepath = $this->QB->TEMPLATE_ROOT . $location . $file;
			$this->QB->DEBUG->log( "Finished setting data for ASSET with file: " . $location . $file . "");
		}
		if($use_cdn == false){
			if(!file_exists($filepath)){
				$this->QB->DEBUG->error(__METHOD__, "Couldn't find asset: " . $filepath . ".");
				return false;
			}
			$this->ASSET[$asset] = $url;
			$this->QB->DEBUG->log( "Added an asset to: " . $url . " into QB->ASSETS->ASSET List.");
		}else{
			$this->ASSET[$asset] = $cdn_url;
			$this->QB->DEBUG->log( "Used CDN for file: " . $url . " into QB->ASSETS->ASSET List.");
		}
		return true;
	}

	function get_asset($asset){
		$this->INFO = $this->INFO . "\n Trying to return asset " . $asset . ".";
		if(!$this->asset_exists($asset)){
			$this->QB->DEBUG->error(__METHOD__, "Failed to return asset, asset " . $asset . " does not exist");
			return false;
		}
		return $this->ASSET[$asset];
	}
	
	function reload_assets(){
		return $this->load_assets();
	}

	function print_assets(){
		?><pre class="bg-chalk text-light"><?php
		$c = 0;
		foreach($this->ASSET as $key => $file){
			$c++;
			$space = '		';
			if(strlen($c) <= 1){
				$c = '0' . $c;
			}
			if(strlen($key) <= 12){
				$space = '	' . $space;
			}
			if(strlen($key) > 20){
				$space = '	';
			}
			?><span class="line" data-line-number="<?=$c;?>">TYPE: <?=$key;?><?=$space;?><?=$file;?></span><br><?php
		}
		?></pre><?php
	}
}

class Package{
	
	private $QB;
	
	function __construct($QUICKBROWSE){
		$this->QB = $QUICKBROWSE;
		return true;
	}
	
	function icons(){
		?>
			<!-- QuickBrowse Package - Icons -->
			<link rel="icon" type="image/png" sizes="192x192" href="<?=$this->QB->ASSETS->get_asset('IMG-FAVICON-192');?>">
			<link rel="icon" type="image/png" sizes="96x96" href="<?=$this->QB->ASSETS->get_asset('IMG-FAVICON-96');?>">
			<link rel="icon" type="image/png" sizes="32x32" href="<?=$this->QB->ASSETS->get_asset('IMG-FAVICON-32');?>">
			<link rel="icon" type="image/png" sizes="16x16" href="<?=$this->QB->ASSETS->get_asset('IMG-FAVICON-16');?>">
		<?php
	}

	function css($THEME = 'BOOTSWATCH-SKETCHY'){
		$this->bootstrap('css', $THEME);
		?>
		<!-- QuickBrowse Style Package - QuickBrowse CSS -->
		<link type="text/css" href="<?=$this->QB->ASSETS->get_asset('CSS-ANIMATE');?>" rel="stylesheet">
		<link type="text/css" href="<?=$this->QB->ASSETS->get_asset('CSS-RESPONSIVE');?>" rel="stylesheet">
		<link type="text/css" href="<?=$this->QB->ASSETS->get_asset('CSS-UTILITY');?>" rel="stylesheet">
		<?php
	}

	function js(){
		$this->bootstrap('js');
		$QB_DATA = $this->QB->client_json(isset($this->QB->USER));
		if(is_array(json_decode($QB_DATA, true))){
		?>
			<!-- QuickBrowse Javascript Package - QuickBrowse JS -->
			<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-CLIENT');?>"></script>
			<script type="application/javascript">new QB_CLIENT().Init(<?=$QB_DATA;?>);</script>
			<!-- QuickBrowse Component - Scroll Animator wow.js -->
			<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-WOW');?>"></script>
		<?php
		}
		unset($QB_DATA);
	}

	function meta($title = 'Website build with ease because of https://QuickBrow.se', $description = 'Visit https://QuickBrow.se/get-started for more information.', $author = 'doOnline.nl', $theme_color = '#dc3545'){
		?>
			<!-- QuickBrowse Package - Metadata SEO -->
			<meta charset="utf-8">
			<title><?=$title;?></title>
			<meta name="description" content="<?=$description;?>">
			<meta name="author" content="<?=$author;?>">
			<!-- QuickBrowse Package - Mobile Options -->
			<meta name="theme-color" content="<?=$theme_color;?>">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php
	}

	function bootstrap($filetype = 'css', $theme = 'BOOTSWATCH-SKETCHY'){
		switch(strtoupper($filetype)){
			case 'CSS':
				?>
					<!-- QuickBrowse Bootstrap Package - Main CSS -->
					<link type="text/css" href="<?=$this->QB->ASSETS->get_asset('CSS-BOOTSTRAP');?>" rel="stylesheet">
					<!-- QuickBrowse Bootstrap Package - Navbar CSS -->
					<link type="text/css" href="<?=$this->QB->ASSETS->get_asset('CSS-BOOTSTRAP-NAVBAR');?>" rel="stylesheet">
				<?php
				if($theme != 'none'){
				?>
					<!-- QuickBrowse Bootstrap Package - Bootswatch CSS -->
					<link type="text/css" href="<?=$this->QB->ASSETS->get_asset(strtoupper($theme));?>" rel="stylesheet">
				<?php
				}
			break;

			case 'JS':
				?>
					<!-- QuickBrowse Bootstrap Package - JQuery JS -->
					<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-JQUERY');?>"></script>
					<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-JQUERY-EASING');?>"></script>
					<!-- QuickBrowse Bootstrap Package - Main JS -->
					<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-BOOTSTRAP');?>"></script>
					<!-- QuickBrowse Bootstrap Package - Navbar JS -->
					<script type="application/javascript" src="<?=$this->QB->ASSETS->get_asset('JS-BOOTSTRAP-NAVBAR');?>"></script>
				<?php
			break;
		}
	}
	
	function lipsum(){
		return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pellentesque velit at vulputate cursus. Mauris vel turpis tortor. Nulla facilisi. Donec augue velit, blandit vitae consequat eu, gravida nec tellus. Donec tempus dui eu venenatis hendrerit. Morbi ac pretium arcu, et faucibus est. Cras congue non ante nec maximus. Nulla venenatis vel ipsum vehicula eleifend. Pellentesque consectetur mollis metus, sed congue enim. Aliquam fermentum neque eu mattis consectetur. Ut bibendum rutrum est eu gravida. Sed non consequat mi. ';
	}
	
	function img($asset = 'LOGO', $size = '75px', $classes = ''){
		?><img width="<?=$size;?>" class="img-fluid <?=$classes;?>" src="<?=$this->QB->ASSETS->get_asset($asset);?>" alt="<?=$asset;?>"/><?php
	}
	
	function banner($TYPE = 'default', $banner_class = 'bg-sharp-gradient-purple', $text_class = 'text-light font-weight-light', $text = 'Informative Documentation, It should get you started', $link = 'https://quickbrow.se/docs/'){
		try{
			switch($TYPE){
				
				case 'contact':
					?>
					<section id="notify-contact-<?=rand(0, 100);?>" class="<?=$banner_class;?> py-5">
						<div class="container text-center">
							<h3 class="lead my-5 <?=$text_class;?>"><span class="my-3 my-md-0">Want to reach <a href="<?=$this->QB->TEMPLATE->AUTHOR_URL;?>" class="text-light font-weight-bold"><?=$this->QB->TEMPLATE->AUTHOR;?></a>? you might get to know us better.</span>
																	<span class="d-none d-md-inline my-3 my-md-0">Contact us with our contact form @ <a href="<?=$this->QB->TEMPLATE->AUTHOR_URL;?>/contact?refferal=<?=urlencode($this->QB->DOMAIN);?>" class="text-light font-weight-bold">Contact</a>.</h3>
						</div>
					</section>
					<?php
				break;
				
				case 'download':
					?>
					<section id="notify-download-<?=rand(0, 100);?>" class="<?=$banner_class;?> py-5">
						<div class="container text-center">
							<h3 class="lead my-5 <?=$text_class;?>"><span class="my-3 my-md-0 d-block d-md-inline text-truncate">Create web-apps Quick &amp; easy</span> <a href="https://quickbrow.se/downloads?refferal=<?=urlencode($this->QB->DOMAIN);?>" class="text-light mx-5 btn btn btn-primary">Download</a> <span class="my-3 my-md-0 d-none d-md-inline">QuickBrowse web Framework</span></h3>
						</div>
					</section>
					<?php
				break;
				
				default:
					?>
					<section id="notify-visit-<?=rand(0, 100);?>" class="<?=$banner_class;?> py-5">
						<div class="container text-center">
							<h3 class="my-5"><a href="<?=$link;?>" class="my-3 my-md-0 d-block d-md-inline text-truncate <?=$text_class;?>"><?=$text;?></a></h3>
						</div>
					</section>
					<?php
				break;
				
			}
		}catch(Exception $e){
			$this->ERROR = $this->ERROR . 'Caught Exception: ' . $e->getMessage();
			return false;
		}
		return;
	}
	
	function video_playlist($playlist = 'UUVDclw75RsDHumNAaCmXM_w', $limit = 4, $txt_class = 'text-light lead'){
		try{
			$YOUTUBE = isset($this->QB->YOUTUBE) ? $this->QB->YOUTUBE : false;
			if(!$YOUTUBE){
				echo 'error';
			}
			if($YOUTUBE){
				$items = $YOUTUBE->return_data('uploads', $playlist, $limit);
				$c = 0;
				foreach($items as $upload){
					$c++;
					if($c <= $limit){
						$uploadId = $upload['snippet']['resourceId']['videoId'];
						$videodata = $YOUTUBE->return_data('video', $uploadId);
						if(!$videodata){
							$this->ERROR = $YOUTUBE->ERROR;
							return false;
						}
						?>
						<div class="col-lg-3 mt-3" style="padding: 5px; padding-top: 0px; padding-bottom: 0px;">
						  <a class="my-0 mx-0 m-0" href="<?=$this->QB->DOMAIN;?>/youtube/video/<?=$uploadId;?>">
							<div class="jumbotron my-3 embed-responsive embed-responsive-16by9 bg-light" style="background-image: url('<?=$videodata['thumbnail_url'];?>') !important; background-size: cover !important; background-position: center !important; ">
								<div class="jumbotron width-10 height-10 bg-gradient-dark transparent-25" style="position: absolute; top: 0; left: 0; padding: 5px;"></div>
							</div>
						  </a>
						  <p class="text-center text-uppercase text-truncate mb-2 <?=$txt_class;?>"><?=$videodata['title'];?></p>
						</div>
						<?php
					}
				}
			}else{
				return false;
			}
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}
	
	function video($vid, $txt_color = 'dark'){
		global $QB;
		try{
			$YOUTUBE = isset($this->QB->YOUTUBE) ? $this->QB->YOUTUBE : Array('error' => "Couldn't find YOUTUBE Object in QB->TEMPLATE");
			if(!is_object($YOUTUBE)){
				$this->ERROR = $this->ERROR . "\n Couldn't find youtube object while trying to PACKAGE Youtube video...\n...Got error: " . $YOUTUBE['error'];
				return false;
			}
			$videodata = $YOUTUBE->return_data('video', $vid);
			$videodata['youtube'] = $YOUTUBE->return_data('youtube', $vid);
			if(!$videodata){
				$this->ERROR = $YOUTUBE->ERROR;
				return false;
			}
			?>
			<h3 class="text-truncate py-3 text-<?=$txt_color;?>"><?=$videodata['title'];?></h3>
			<div class="embed-responsive embed-responsive-16by9 text-center">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$vid;?>?autoplay=1&controls=0&enablejsapi=1&fs=0&modestbranding=1&start=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="row">
				<div class="col-8">
					<h4 class="mt-3 text-left text-<?=$txt_color;?>">
						Author: <a class="text-secondary" href="<?=$videodata['author_url'];?>"><?=$videodata['author_name'];?></a>
					</h4>
				</div>
				<div class="col-4">
					<h4 class="mt-3 text-right text-<?=$txt_color;?>">
						Views: <span class="text-secondary"><?=$videodata['youtube']['items'][0]['statistics']['viewCount'];?></span>
					</h4>
				</div>
			</div>
			<?php
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function alert_danger($message = ''){
		if(!empty($message)){
			?>
			<div class="alert alert-dismissible alert-danger bg-gradient-red">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Oops! </strong><?=$message;?>
			</div>
			<?php
		}
	}

	function alert_success($message = ''){
		if(!empty($message)){
			?>
			<div class="alert alert-dismissible alert-success bg-gradient-green">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Hooray! </strong><?=$message;?>
			</div>
			<?php
		}
	}

	function header($heading = 'title', $lead = 'description', $css_classes_header = 'bg-space-purple text-light center-2d-old', $css_text = 'text-light text-center'){
		?>
		<header class="<?=$css_classes_header;?>">
			<div class="container">
				<h1 class="text-truncate text-uppercase font-weight-light <?=$css_text;?>"><?=$heading;?></h1>
				<p class="lead <?=$css_text;?>"><?=$lead;?></p>
			</div>
		</header>
		<?php
	}

	function pagination($CURRENT_INDEX = 0, $HARD_INDEX_LIMIT = 10, $ITEMS_PER_PAGE = 3, $TOTAL_ITEMS, $START_URL = './group/', $URL_INDEX = './group/page/'){
		?>
		<nav id="nav-pagination">
		  <ul class="pagination" style="justify-content: center;">
			<li class="page-item <?php if($CURRENT_INDEX + 1 <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$START_URL;?>">First</a>
			</li>
			<li class="page-item <?php if($CURRENT_INDEX + 1 <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?php if($CURRENT_INDEX <= 1){ echo $START_URL; }else{ echo $URL_INDEX . ($CURRENT_INDEX - 1); };?>"><i class="fas fa-chevron-left"></i></a>
			</li>
			<?php
			//set index limit based on how many posts there are
			$INDEX_LIMIT = ceil($TOTAL_ITEMS / $ITEMS_PER_PAGE);

			//check if there are not to many pages, hard limit from old $INDEX_LIMIT = 10?
			if($INDEX_LIMIT > $HARD_INDEX_LIMIT){
				$INDEX_LIMIT = $HARD_INDEX_LIMIT;
			}

			//Add amount of pages to the pagination bar
			for($i = 0; $i < $INDEX_LIMIT; $i++){
				$active = false;
				if($i == $CURRENT_INDEX){
					$active = true;
				}
				?>
				<li class="page-item <?php if($active){ echo 'active'; } ?>">
					<?php
					if($i <= 0){
						?><a class="page-link" href="<?=$START_URL;?>"><?=$i+1;?></a><?php
					}else{
						?><a class="page-link" href="<?=$URL_INDEX . $i;?>"><?=$i+1;?></a><?php
					}
					?>
				</li>
				<?php
			}
			?>
			<li class="page-item <?php if($CURRENT_INDEX + 1 >= $INDEX_LIMIT || $INDEX_LIMIT <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$URL_INDEX . ($CURRENT_INDEX + 1);?>"><i class="fas fa-chevron-right"></i></a>
			</li>
			<li class="page-item <?php if($CURRENT_INDEX + 1 >= $INDEX_LIMIT){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$URL_INDEX . ($INDEX_LIMIT - 1);?>">Last</a>
			</li>
		  </ul>
		</nav>
		<?php

	}
	
	function print_code($string = "1 Banaan \n2 Banaan-en", $showlines = true){
		?><pre class="bg-dark bg-sharp-gradient-dark text-left"><?php
		$str = (is_file($string) ? file_get_contents($string) : $string);
		$txt_lines = explode("\n", $str);
		$cnt_lines = 0;
		foreach($txt_lines as $line){
			$cnt_lines++;
			$data_line = '' . $cnt_lines . '';
			if(strlen($data_line) <= 1){
				$data_line = '0' . $data_line;
			}
			$line = $this->QB->html_encode($line);
			?><span data-line-number="<?=$data_line;?>" class="line"><?=$line;?></span><br><?php
		}
		?></pre><?php
	}

}

?>
