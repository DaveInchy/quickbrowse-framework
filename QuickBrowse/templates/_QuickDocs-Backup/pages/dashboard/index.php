<section id="dashboard" class="bg-gradient-purple">
<div class="container text-center">
	<div class="col-lg-8 mx-auto">
		<h2 class="text-light">Dashboard</h2>
		<p class="lead">A little bit of information.</p>
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-12">
				<a href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/users/">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold"><?=$users_count;?></h3>
					<p class="lead py-0 px-0 my-0">Users</p>
				</div>
				</a>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-12">
				<a href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/blog/">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold"><?=$posts_count;?></h3>
					<p class="lead py-0 px-0 my-0">Posts</p>
				</div>
				</a>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold">21</h3>
					<p class="lead py-0 px-0 my-0">Tasks</p>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold text-truncate"><?=$view_count;?></h3>
					<p class="lead py-0 px-0 my-0">Views</p>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold text-truncate"><?=$subscriber_count;?></h3>
					<p class="lead py-0 px-0 my-0">Subscribers</p>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="jumbotron bg-light text-center">
					<h3 class="py-0 px-0 my-0 font-weight-bold text-truncate"><?=$video_count;?></h3>
					<p class="lead py-0 px-0 my-0">Videos</p>
				</div>
			</div>
		</div>
		
	</div>
</div>
</section>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>