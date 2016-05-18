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

        public function verifIdentifiants($email,$mdp){
            if(empty($email)||empty($mdp)){
                return array("error" => 0);
            }

            $mdp = sha1($mdp);

            $stmt = $this->prepare("SELECT * FROM user WHERE user_email = :email AND user_mdp = :mdp");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":mdp", $mdp);
            if($stmt->execute()==false){
                return array("error" => 1);
            }

            $result = $stmt->fetch();
            $this->sauveIP($result['user_id']);

            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['user_nom'] = $result['user_nom'];
            $_SESSION['user_prenom'] = $result['user_prenom'];
            $_SESSION['user_email'] = $result['user_email'];
            $_SESSION['forme_juridique'] = $result['forme_juridique'];
            $_SESSION['siret'] = $result['siret'];
            $_SESSION['secteur_act'] = $result['secteur_act'];
            $_SESSION['user_tel'] = $result['user_tel'];
            $_SESSION['user_rue'] = $result['user_rue'];
            $_SESSION['user_cp'] = $result['user_cp'];
            $_SESSION['user_ville'] = $result['user_ville'];
            $_SESSION['user_mdp'] = $result['user_mdp'];
            $_SESSION['user_admin'] = $result['user_admin'];
            
            return array("success" => true,"userData" => $result);
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