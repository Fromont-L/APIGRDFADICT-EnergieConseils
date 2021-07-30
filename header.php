<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-header">
	<a class="navbar-brand" href="index.php">
	<img src="assets/image/tricatel_logo.jpg" width="48" height="48" class="d-inline-block align-center" alt="" loading="lazy">
	API GRDF
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav1"aria-controls="navbarNav1" aria-expended="false">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav1">
		<ul class="navbar-nav mr-auto">
		</ul>
		<ul class="navbar-nav mx-3">
			<li class="nav-item mx-3">
				<a class="nav-link btn btn-info" href="https://www.gazelectricitemoinschers.fr" target="_blank">Visiter le site d'Energie-Conseils</a>
			</li>
			<?php if($login) { ?>
				<li class="nav-item mx-3">
					<?php if($admin) { ?>
					<a class="nav-link btn btn-success" href="tabs.php">Au boulot !</a>
					<?php } ?>
				</li>
			<?php } ?>
			<?php if($login) { ?>
				<li class="nav-item mx-3">
				<?php if($admin) { ?>
				<a class="nav-link btn btn-secondary" href="admin.php">Admin</a>
				<?php } ?>
			</li>
			<li class="nav-item mx-3">
				<a class="nav-link btn btn-danger" href="deconnexion.php">Déconnexion</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>