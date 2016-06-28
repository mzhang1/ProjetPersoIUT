<?php
	class admin extends PDO{
		
		public function __construct(){

			$this->sgbd = 'mysql';
			$this->hote = 'localhost';
			$this->bd = 'profil';
			$this->user = 'root';
			$this->pass = '';
			$dns = $this->sgbd.':dbname='.$this->bd.";host=".$this->hote;

			//Appel du constructeur parent
			parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'));
		}
		
		public function getUserInfos(){
			$sql = "select * from user where user_admin <> 1";
			$stmt = $this->prepare($sql);
			if($stmt->execute()==false){
				return array("error" => "fetch user infos failed");
			}
			$userInfos = $stmt->fetchAll();
			return $userInfos;
		}
		
		public function addUser($userInfo){
			$sql = "insert into user (user_email,user_nom,user_prenom,user_mdp,user_tel,user_ville)
				VALUES(:user_email,:user_nom,:user_prenom,:user_mdp,:user_tel,:user_ville);";
			$stmt = $this->prepare($sql);
			$stmt->bindParam(":user_email", $userInfo['email']);
			$stmt->bindParam(":user_nom", $userInfo['nom']);
			$stmt->bindParam(":user_prenom", $userInfo['prenom']);
			$stmt->bindParam(":user_mdp", $userInfo['mdp']);
			$stmt->bindParam(":user_tel", $userInfo['tel']);
			$stmt->bindParam(":user_ville", $userInfo['ville']);
			if($stmt->execute()==false){
				return "Error : add new user failed";
			}
			return "Succès !";
		}
		
		public function deleteUser($user_id){
			$sql = "delete from user where user_id = :user_id";
			$stmt = $this->prepare($sql);
			$stmt->bindParam(":user_id", $user_id);
			if($stmt->execute()==false){
				return "Error : delete operation failed(user id : ".$user_id.")";
			}
			return "Delete success !";
		}
		
		public function changeSuspendUserStatus($user_id){
			$sql = "select suspended from user where user_id = :user_id";
			$stmt = $this->prepare($sql);
			if($stmt->execute(array("user_id" => $user_id))==false){
				return "Error : unknown status(user id : ".$user_id.")";
			}
			$suspend = $stmt->fetchColumn(0);
			$newSuspendStatus = ($suspend == 1) ? 0 : 1;
			
			$sql2 = "update user set suspended = :suspend where user_id = :user_id";
			$stmt = $this->prepare($sql2);
			$stmt->bindParam(":suspend", $newSuspendStatus);
			$stmt->bindParam(":user_id", $user_id);
			if($stmt->execute()==false){
				return "Error : delete operation failed(user id : ".$user_id.", suspend Status : ".$newSuspendStatus.")";
			}
			return "Update success ! (new status : ".$newSuspendStatus.")";
		}
	}
?>