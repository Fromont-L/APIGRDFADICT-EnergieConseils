<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-header bar12">
	<a class="navbar-brand" href="index.php">
	
	
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav1"aria-controls="navbarNav1" aria-expended="false">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse fixed-top navbar-collapse" id="navbarNav1">
		<ul class="navbar-nav mr-auto">
		</ul>
		<ul class="navbar-nav mx-3">
			<li class="nav-item mx-2 b1">
				<a class="nav-link btn btn" href="https://www.gazelectricitemoinschers.fr" target="_blank">Le site d'Energie-Conseils</a>
			</li>
			<?php if($login) { ?>
				<?php if($admin && !isset($pageTabsAffichee)) { ?>
				<li class="nav-item mx-2 b2">
					<a class="nav-link btn" href="tabs.php">Au boulot !</a>
				</li>
				<?php } ?>
			<?php } ?>
			<?php if($login) { ?>
				<?php if($admin && !isset($pageAdminAffichee)) { ?>
				<li class="nav-item mx-2 b3">
					<a class="nav-link btn" href="admin.php">Admin</a>	
				</li>
				<?php } ?>
			<li class="nav-item mx-2 b4">
				<a class="nav-link btn" href="deconnexion.php">Déconnexion</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>