<?php
	require_once("pdo/adminProfil.php");

	$admin = new admin();
	
	if(isset($_POST['email'])){
		$addUserInfos = array();
		$addUserInfos["email"] = $_POST['email'];
		$addUserInfos['nom'] = $_POST['nom'];
		$addUserInfos['prenom'] = $_POST['prenom'];
		$addUserInfos['mdp'] = sha1($_POST['mdp']);
		$addUserInfos['tel'] = $_POST['tel'];
		$addUserInfos['ville'] = $_POST['ville'];
		$msg = $admin->addUser($addUserInfos);
	}
	
	if(isset($_REQUEST['deleteId'])){
		$id = $_REQUEST['deleteId'];
		$msg = $admin->deleteUser($id);
	}
	
	if(isset($_REQUEST['suspendId'])){
		$id = $_REQUEST['suspendId'];
		$msg = $admin->changeSuspendUserStatus($id);
	}
	$userInfos = $admin->getUserInfos();
?>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Panneau d'administration</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
	    <a class="navbar-brand" href="../dashbord/accueil.php">Panneau d'administration</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>-->
	   <!--<li><a href="#">Aide</a></li>-->
	   <li><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
          
        </div>
    </div>
</nav>

<?php
	if(isset($msg)){
		echo"
			<div class='alert alert-info requestMessage'>
				".$msg."
			</div>
		";
	}
?>
		
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-sm-12 col-md-12 adminPanel">
			<table class="table table-striped">
				<tr>
					<th>ID</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>E-Mail</th>
					<th>Téléphone</th>
					<th>Ville</th>
					<th>Opérations</th>
				</tr>
				<?php
					foreach($userInfos as $user){
						echo 
						"
							<tr class = '".$user["user_id"]."'>
								<td>".$user["user_id"]."</td>
								<td>".$user["user_nom"]."</td>
								<td>".$user["user_prenom"]."</td>
								<td>".$user["user_email"]."</td>
								<td>".$user["user_tel"]."</td>
								<td>".$user["user_ville"]."</td>
								<td>
									<button class='btn btn-primary btn-xs suspendUser'>Suspendre</button>
									<button class='btn btn-danger btn-xs deleteUser'>Supprimer</button>
								</td>
							</tr>
						";
					}
					
		
				?>
			</table>
			<button class='btn btn-sm btn-primary addUserButton'>Ajouter un utilisateur</button>
		</div>
	</div><!--/.container-->
</div>

<footer>
  <p class="pull-right">Copyright ©2016 SimplyETL, Inc.</p>
</footer>
        
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
