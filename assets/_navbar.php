<nav class="navbar navbar-default">
	<div class="container-fluid">
	
		<div class="col-lg-8 col-lg-offset-2 nav-wrap" style="padding:0px;">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header" style="padding:0px">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<?php echo makeMenuOptsHTML($menuItems); ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</div><!-- /.container-fluid -->
	
</nav>
