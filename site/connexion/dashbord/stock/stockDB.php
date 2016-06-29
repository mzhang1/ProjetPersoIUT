<?php
    /**
     * Classe d'interaction avec la base (pour les stocks)
     */
	class stockDB extends PDO{
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

        public function checkUserCredentials($user_id){
            $stmt = $this->prepare("SELECT user_prenom,user_nom FROM user WHERE user_id=:id");
            return $stmt->execute(array(":id" => $user_id));
        }

        public function getUserStockFiles($user_id){
            $req = "SELECT * FROM fiche WHERE user_id = :id";
            $stmt = $this->prepare($req);
            if(!$stmt->execute(array(":id" => $user_id))){
                return "Aucune fiche disponible";
            }
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($files)>0){
                $i = 0;
                $records = array();
                foreach($files as $file){
                    $record = array();
                    $record['id'] = $file['id'];
                    $record['nom'] = $file['nom'];

                    $produits = $this->getProductList($record['id']);
                    if(is_array($produits)){
                        /* Récupération des informations des entrées */
                        $req = "SELECT * FROM entrees
                            JOIN produit ON entrees.id_produit = produit.id
                            WHERE id_fiche = :id";
                        $stmt = $this->prepare($req);
                        $stmt->execute(array(":id" => $record['id']));
                        $entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $record['entrees'] = $entrees;

                        /* Récupération des informations des sorties */
                        $req = "SELECT * FROM sorties
                            JOIN produit ON sorties.id_produit = produit.id
                            WHERE id_fiche = :id";
                        $stmt = $this->prepare($req);
                        $stmt->execute(array(":id" => $record['id']));
                        $sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $record['entrees'] = $sorties;
                    }

                    array_push($records,$record);
                    $i++;
                }
            }

            $selectedIndex = $this->getLastSelectedFile($user_id);

            if($records){
                return array("selectedIndex" => $selectedIndex,"records" => $records);
            }
            else{
                return "Aucune fiche disponible";
            }
        }

        private function getProductList($record_id){
            $req = "SELECT * FROM produit
                JOIN typeProduit ON produit.type_produit_id = typeProduit.id
                JOIN fournisseur ON produit.fournisseur_id = fournisseur.id; 
                WHERE produit.fiche_id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":id" => $record_id));
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $produits;
        }

        private function getLastSelectedFile($user_id){
            $req = "SELECT lastSelectedFile FROM user WHERE user_id = :id";
            $stmt = $this->prepare($req);
            if($stmt->execute(array(':id' => $user_id))===false){
                return -1;
            }
            else{
                $lastUsedFileId = $stmt->fetchColumn(0);
            }

            if(!$lastUsedFileId){
                //Récupération de la première fiche
                $req = "SELECT id FROM fiche WHERE user_id = :id LIMIT 1";
                $stmt = $this->prepare($req);
                $stmt->execute(array(":id" => $user_id));
                $firstFileId = $stmt->fetchColumn(0);

                //Mise à jour de la dernière fiche utilisée
                $req = "UPDATE user SET lastSelectedFile = :lastSelectedFile WHERE user_id = :user_id";
                $stmt = $this->prepare($req);
                if($stmt->execute(array(":lastSelectedFile" => $firstFileId, ":user_id" => $user_id))){
                    $lastUsedFileId = $firstFileId;
                }
            }
            return $lastUsedFileId;
        }
	}
?>
