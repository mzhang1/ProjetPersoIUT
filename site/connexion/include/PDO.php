<?php
class Connexion extends PDO
{

    /**
     *  Constructeur qui hérite du constructeur de la classe PDO
     */
    public function __construct()
    {
        
        $this->sgbd = 'mysql';
        $this->hote = 'localhost';
        $this->bd = 'profil';
        $this->user = 'root';
        $this->pass = '';
        $dns = $this->sgbd.':dbname='.$this->bd.";host=".$this->hote;
        
        //Appel du constructeur parent
        parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'));
    }
    
	// Inscription d'un nouvel utilisateur dans la base de données
    public function ajouter_user($user_mdp, $user_prenom, $user_nom, $user_email, $forme_juridique, $siret, $secteur_act, $user_tel, $user_rue, $user_cp, $user_ville)
    {
		$this->query('INSERT INTO user VALUES ("","'.$user_mdp.'","'.$user_prenom.'","'.$user_nom.'","'.$user_email.'","'.$forme_juridique.'","'.$siret.'","'.$secteur_act.'","'.$user_tel.'","'.$user_rue.'","'.$user_cp.'","'.$user_ville.'","ip","0")') or die("erreur de requête !");
    }
    
	// Modification du mot de passe d'un utilisateur dans la base de données
    public function modifierMDP($user_id, $user_mdp)
    {
		$this->query('UPDATE user SET user_mdp = "'.$user_mdp.'" WHERE user_id = "'.$user_id.'"') or die("erreur de requête !");
    }
    public function sauveIP($user_id){
   	 $ip = $_SERVER["REMOTE_ADDR"];
   	 $stmt = $this->prepare("UPDATE user SET user_ip = :ip WHERE user_id = :user_id");
   	 $stmt->bindParam(":ip",$ip);
   	 $stmt->bindParam(":user_id",$user_id);
   	 if($stmt->execute()===FALSE){
   		 return false;
   	 }
}

	// Vérification de l'existance dans la base de données de l'utilisateur qui essaye de se connecter
    public function verif_user($user_email, $user_mdp)
    {
	$req1 = $this->query('SELECT * FROM user WHERE user_email = "'.$user_email.'" AND user_mdp = "'.$user_mdp.'"') or die("erreur de requête !");
        $nb = $req1->rowCount();
        
        if($nb == 1)
        {
            $result = $req1->fetch();
	    $this->sauveIP($result['user_id']);
            return $result;
        }
        else
        {
            return NULL;
        }
    }
	
	// Vérification de l'existance dans la base de données de l'email
    public function verif_email($user_email)
    {
	$req1 = $this->query('SELECT * FROM user WHERE user_email = "'.$user_email.'"') or die("erreur de requête !");
        $nb = $req1->rowCount();
        
        if($nb == 1)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	
    
    public function modifierUser($user_nom, $user_prenom, $user_email, $forme_juridique, $siret, $secteur_act, $user_tel, $user_rue, $user_cp, $user_ville, $user_admin, $id){
        $this->query("UPDATE user set user_nom='".$user_nom."', user_prenom='".$user_prenom."', user_email='".$user_email."', forme_juridique='".$forme_juridique."', siret='".$siret."', secteur_act='".$secteur_act."', user_tel='".$user_tel."', user_rue='".$user_rue."', user_cp='".$user_cp."', user_ville='".$user_ville."', user_admin='".$user_admin."' where user_id='".$id."'; " ) or die("erreur de requête !");
        }
    
    public function afficherUser($id){
        
       $req1= $this->query("SELECT * FROM user WHERE user_id = '".$id."'")or die("erreur de requête !");
        $nb = $req1->rowCount();
        
        if($nb == 1)
            {
            return $result = $req1->fetch();
            }
        else 
            {
            return null;
            }  
    }
    
}


?>
