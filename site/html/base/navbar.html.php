<nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color: #444;">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand page-scroll" href="#page-top">Nom entreprise</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">

				<?php
					if($action == "Accueil") {
						ECHO'
							<li ><a class="page-scroll" href = "#about" > Qui sommes-nous ?</a ></li >
							<li ><a class="page-scroll" href = "#services" > Nos services </a ></li >
						';
					}
					else{
						ECHO'
							<li><a class="page-scroll" href="index.php">Accueil</a></li>
						';	
					}
				?>
				<li><a class="page-scroll" href="index.php?uc=main&action=Inscription">S'inscrire</a></li>
				<li><a class="page-scroll" href="index.php?uc=connexion&action=demandeConnexion">Connexion</a></li>
					<!-- 
					<li><a class="page-scroll" href="#contact">Contact</a></li>
					-->
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
<!-- Début contenu -->
<body id="page-top">