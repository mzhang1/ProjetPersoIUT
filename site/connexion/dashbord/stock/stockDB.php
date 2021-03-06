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

        public function addFile($newFileName,$user_id){
            $req = "INSERT INTO fiche
                SET nom = :nom, user_id = :user_id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":nom" => $newFileName,":user_id" => $user_id));

            return array("requete" => "OK");
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
                        $record['produits'] = $produits;

                        /* Récupération des informations des entrées */
                        $entrees = $this->getFileEntries($record['id']);
                        $record['entrees'] = $entrees;

                        /* Récupération des informations des sorties */
                        $sorties = $this->getFileOutputs($record['id']);
                        $record['sorties'] = $sorties;
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
            $req = "SELECT produit.id as productId,produit.nom as nomProduit,produit.pu as pu, produit.stkDispo as qte,
                    (produit.stkDispo * produit.pu) as pt, typeProduit.*, fournisseur.*
                    FROM produit, typeProduit, fournisseur
                    WHERE produit.type_produit_id = typeProduit.id
                    AND produit.fournisseur_id = fournisseur.id
                    AND produit.fiche_id = :id";
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

            if(empty($lastUsedFileId)){
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

        public function addFileProduct($record_id){
            $req = "INSERT INTO produit
                SET pu = 0,stkDispo = 0,fiche_id = :id,type_produit_id = 1, fournisseur_id = 1";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":id" => $record_id));

            $produits = $this->getProductList($record_id);
            return array("fileId" => $record_id,"produits" => $produits);
        }

        public function updateFileProduct($record_id,$product_id,$product_name,$product_category,
            $product_price,$product_supplier){
            $req = "UPDATE produit
                SET nom = :name,pu = :price
                WHERE id = :id";

            $stmt = $this->prepare($req);
            $stmt->execute(array(":name" => $product_name,":price" => $product_price, ":id" => $product_id));

            //Insertion du type
            $req = "INSERT INTO typeProduit
                SET libelle_type = :type";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":type" => $product_category));

            $req = "SELECT id FROM typeProduit
                WHERE libelle_type = :type LIMIT 1";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":type" => $product_category));
            $id = $stmt->fetchColumn(0);

            $req = "UPDATE produit
                SET type_produit_id = :type_id WHERE id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":type_id" => $id, ":id" => $product_id));

            //Insertion du fournisseur
            $req = "INSERT INTO fournisseur
                SET libelle_fournisseur = :libelle";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":libelle" => $product_supplier));

            $req = "SELECT id FROM fournisseur
                WHERE libelle_fournisseur = :libelle LIMIT 1";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":libelle" => $product_supplier));
            $supplier_id = $stmt->fetchColumn(0);

            $req = "UPDATE produit
                SET fournisseur_id = :fournisseur_id WHERE id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":fournisseur_id" => $supplier_id, ":id" => $product_id));

            $produits = $this->getProductList($record_id);
            return array("updatedProductId" => $product_id,"produits" => $produits);
        }

        public function deleteFileProduct($product_id,$record_id){
            $req = "DELETE FROM produit WHERE id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":id" => $product_id));

            $produits = $this->getProductList($record_id);
            return array("deletedProductId" => $product_id,"produits" => $produits);
        }

        public function addNewEntry($product_id,$record_id,$qty){
            $req = "INSERT INTO entrees
                SET qteEntree = :qty, dateEntree = CURDATE(), id_fiche = :record_id, id_produit = :product_id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":qty" => $qty,":record_id" => $record_id,":product_id" => $product_id));

            $req = "UPDATE produit
                SET stkDispo = stkDispo + :ajout
                WHERE id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":ajout" => $qty,":id" => $product_id));

            $entries = $this->getFileEntries($record_id);
            $products = $this->getProductList($record_id);
            return array("fileId" => $record_id, "entrees" => $entries, "products" => $products);
        }

        public function getFileEntries($file_id){
            $req = "SELECT * FROM entrees
                INNER JOIN produit ON entrees.id_produit = produit.id
                WHERE id_fiche = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":id" => $file_id));
            $entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $entrees;
        }

        public function addNewOutput($product_id,$record_id,$qty){
            $req = "INSERT INTO sorties
                SET qteSortie = :qty, dateSortie = CURDATE(), id_fiche = :record_id, id_produit = :product_id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":qty" => $qty,":record_id" => $record_id,":product_id" => $product_id));

            $req = "UPDATE produit
                SET stkDispo = stkDispo - :sorties
                WHERE id = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":sorties" => $qty,":id" => $product_id));

            $outputs = $this->getFileOutputs($record_id);
            $products = $this->getProductList($record_id);
            return array("fileId" => $record_id, "sorties" => $outputs, "products" => $products);
        }

        public function getFileOutputs($record_id){
            $req = "SELECT * FROM sorties
                INNER JOIN produit ON sorties.id_produit = produit.id
                WHERE id_fiche = :id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":id" => $record_id));
            $sorties = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $sorties;
        }

        public function updateLastUsedFile($user_id,$lastUsedFileId){
            $req = "UPDATE user
                SET lastSelectedFile = :file_id WHERE user_id = :user_id";
            $stmt = $this->prepare($req);
            $stmt->execute(array(":file_id" => $lastUsedFileId, ":user_id" => $user_id));

            return array("requete" => "OK","selected" => $lastUsedFileId);
        }
	}
?>
