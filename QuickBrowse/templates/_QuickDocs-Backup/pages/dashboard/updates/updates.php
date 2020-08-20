<section id="updates" class="bg-gradient-purple">
<div class="container">
	<div class="col-md-7 mx-auto">
	  <h2 class="text-light">Latest Updates</h2>
	  <p class="lead text-light">Most recent updates that've been uploaded to the blog.</p>
	  <?php
		//Display limited blog posts tagged with 'update'.
		$DISPLAY->blog_posts($POSTS, $USERS, 'update', 3, true, false);
	  ?>
	</div>
</div>
</section>