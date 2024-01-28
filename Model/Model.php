<?php

class Model
{
	private static $serveur="mysql:host=localhost";
	private static $bdd="dbname=daw";
	private static $user="root";
	private static $mdp="";
	private static $pdo;
	private static $PDOBD=null;

	private function __construct()
	{
		Model::$pdo = new PDO(Model::$serveur.';'.Model::$bdd.';charset=utf8', Model::$user, Model::$mdp);
		Model::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	public function _destruct()
	{
		Model::$pdo = null;
	}

	public  static function getBDD()
	{
		if(Model::$PDOBD==null)	{Model::$PDOBD= new Model();}
		return Model::$PDOBD;
	}

	protected function getAll($table, $obj)
    {
        $var =[];
        $req = $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY id_cours');
        $req -> execute();
        while($data = $req-> fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
		$req->closeCursor();
        return $var;
    }

	function ajoutCours($groupe,$nom_cours,$dificulte,$contenu)
	{
		$querystring = "INSERT INTO t_cours (groupe,nom_cours,difficulte,contenu_cours) VALUES (:groupe,:nomc,:dif,:contenu);";
		$query = Model::$pdo->prepare( $querystring );
		$query->bindParam(':groupe',$groupe);
		$query->bindParam(':nomc',$nom_cours);
		$query->bindParam(':dif',$dificulte);
		$query->bindParam(':contenu',$contenu);
		$query->execute();
	
		return $query->fetchAll();
	}

	function getCoursBDD($nom_cours){	
		$cours = Model::$pdo->prepare("SELECT id FROM cours WHERE nom_cours=:nomc;");
		$cours->bindValue(":nomc", $nom_cours);
		$cours->execute();
	
		return $cours->fetchAll();
	}

	function getCours(){
		$cours = Model::$pdo->prepare("SELECT nom_cours, difficulte, contenu_cours, id_cours FROM t_cours");
		$cours->execute();
		return $cours->fetchAll();
	}

	function getCour($id){
		$cours = Model::$pdo->prepare("SELECT nom_cours, difficulte, contenu_cours FROM t_cours WHERE id_cours = $id");
		$cours->execute();
		return $cours->fetchAll()[0];
	}

	function modifierCours($id, $titre, $diff, $contenu)
	{
		$stmt = Model::$pdo->prepare("UPDATE t_cours SET nom_cours = :nom, difficulte = :diff, contenu_cours = :cont WHERE id_cours = :id_cours");
		$stmt->bindParam(':nom', $titre);
		$stmt->bindParam(':diff', $diff);
		$stmt->bindParam(':cont', $contenu);
		$stmt->bindParam(':id_cours', $id);
		$stmt->execute();

		
		$stmt = Model::$pdo->prepare("UPDATE t_qcm SET diffi = :diff WHERE cours = :id_cours");
		$stmt->bindParam(':diff', $diff);
		$stmt->bindParam(':id_cours', $id);
  		return $stmt->execute();
	}

	function supprimeCours($id)
	{
		$stmt = Model::$pdo->prepare('DELETE FROM t_cours WHERE id_cours = :id_cours');
		$stmt->bindParam(':id_cours', $id);
		return $stmt->execute();
	}

	function supprimeQCM($id)
	{
		$stmt = Model::$pdo->prepare('DELETE FROM t_qcm WHERE cours = :id_cours');
		$stmt->bindParam(':id_cours', $id);
		return $stmt->execute();
	}

	function getTopic($mot_cle = null)
	{
		if(empty($mot_cle)){
			$sql = "SELECT id_topic, titre_topic, etat, date_derniere_maj, date_creation FROM t_topic ORDER BY date_creation DESC";
			$stmt = Model::$pdo->prepare($sql);
			$stmt->execute();
	    	return $stmt->fetchAll();
		}
		else{
			// Échapper les caractères spéciaux pour éviter les attaques par injection SQL
			$mot_cle = htmlspecialchars($mot_cle, ENT_QUOTES);

			// Exécuter la requête SQL
			$stmt = Model::$pdo->prepare('SELECT id_topic, titre_topic, etat, date_derniere_maj, date_creation FROM t_topic WHERE titre_topic LIKE \'%'. $mot_cle . '%\' ORDER BY date_creation DESC ' );
			$stmt->execute();
			return $stmt->fetchAll();

		}
		
	}


	function getSujetTopic($id)
	{
		$sql = " SELECT titre_topic FROM t_topic WHERE id_topic = $id";
		$stmt = Model::$pdo->prepare($sql);
		$stmt->execute();
		$titre = $stmt->fetchAll();
		return $titre[0];
	}

	function getMessagesTopic($id)
	{
		$sql = " SELECT m.id_message, u1.pseudo AS auteur, u2.pseudo AS destinataire, m.topic, m.contenu_mess, m.date_poste, m2.contenu_mess AS message_source
            FROM t_message AS m 
            INNER JOIN t_user AS u1 ON m.user_source = u1.id_user
            LEFT JOIN t_user AS u2 ON m.user_target = u2.id_user
            LEFT JOIN t_message AS m2 ON m.citation = m2.id_message
            WHERE m.topic = $id 
            ORDER BY m.date_poste ASC";
		$stmt = Model::$pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function ajoutMessageTopic($id, $message)
	{
		$sql = "INSERT INTO t_message (user_source, topic, contenu_mess, date_poste) VALUES (:id_user, :id_sujet, :message, NOW())";
		$stmt = Model::$pdo->prepare($sql);
		$stmt->bindParam(':id_user', $_SESSION["user_id"]);
		$stmt->bindParam(':id_sujet', $id);
		$stmt->bindParam(':message', $message);
		return $stmt->execute();
	}

	function ajoutTopic($titre, $message)
	{
		$sql_topic = "INSERT INTO t_topic (titre_topic, etat, date_derniere_maj, date_creation)
                    VALUES ('$titre', 'ouvert', NOW(), NOW())";
		$stmt_topic = Model::$pdo->prepare($sql_topic);
		$stmt_topic->execute();
		if($stmt_topic){
			$id_sujet = Model::$pdo->lastInsertId();
			$sql = "INSERT INTO t_message (topic, user_source, contenu_mess, date_poste)
            VALUES (:id_sujet, :id_user, :message, NOW())";
			$stmt = Model::$pdo->prepare($sql);
			if($stmt->execute([':id_sujet' => $id_sujet,':id_user' => $_SESSION["user_id"], ':message' => $message]))
				return $id_sujet;
			else
				$stmt;
			
		} else
			return $stmt_topic;
	}

	function getUtilisateur($mail, $mdp)
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_user WHERE mail = '$mail' AND mdp = '$mdp'");
		$stmt->execute();
		return $stmt->fetchAll()[0];
	}

	function getUtilisateurInfo($id)
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_user WHERE id_user = $id");
		$stmt->execute();
		return $stmt->fetchAll()[0];
	}

	function setParamUtilisateur($id, $pseudo,$anniv, $age, $bio)
	{
		$sql = "UPDATE t_user SET pseudo = :pseudo, bio = :bio, age = :age, anniv = :anniv WHERE id_user = :id_user";		
		$stmt = Model::$pdo->prepare($sql);
		$stmt->bindParam(':pseudo', $pseudo);
		$stmt->bindParam(':bio', $bio);
		$stmt->bindParam(':age', $age);
		$stmt->bindParam(':anniv', $anniv);
		$stmt->bindParam(':id_user', $id);
		return $stmt->execute();
	}

	function getUtilisateurs()
	{
		$cours = Model::$pdo->prepare("SELECT * FROM t_user");
		$cours->execute();
		return $cours->fetchAll();
	}
	
	function ajoutUtilisateur($pseudo, $mail, $mdp)
	{
		$sql = "INSERT INTO t_user (pseudo, mail, mdp, id_role) VALUES ('$pseudo', '$mail', '$mdp', 3)";
		$stmt = Model::$pdo->prepare($sql);
		return $stmt->execute();
	}

	function supprimeUtilisateur($id)
	{
		$stmt = Model::$pdo->prepare('DELETE FROM t_user WHERE id_user = :id_user');
		$stmt->bindParam(':id_user', $id);
		return $stmt->execute();
	}

	function changeRoleUtilisateur($id, $role)
	{
		$stmt = Model::$pdo->prepare('UPDATE t_user SET id_role = :id_role WHERE id_user = :id_user');
		$stmt->bindParam(':id_role', $role);
		$stmt->bindParam(':id_user', $id);
	    return $stmt->execute();
	}


	function ajoutMessageCiteTopic($id, $message, $auteur_cite, $cite)
    {
        $sql = "INSERT INTO t_message (user_source, user_target, citation, topic, contenu_mess, date_poste) VALUES (1, :auteur_cite, :cite, :id_sujet, :message, NOW())";
        $stmt = Model::$pdo->prepare($sql);
        $stmt->bindParam(':id_sujet', $id);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':cite', $cite);
        $stmt->bindParam(':auteur_cite', $auteur_cite);
        return $stmt->execute();
    }


    function supprMessage($idMess){
        $sql = "DELETE t1, t2
                FROM t_message t1
                LEFT JOIN t_message t2 ON (t1.id_message = t2.citation)
                WHERE t1.id_message = $idMess;";

        $stmt = Model::$pdo->prepare($sql);
        return $stmt->execute();
    }


    function supprTopic($idtopic){
        $sql = "DELETE
                FROM t_topic
                WHERE id_topic = $idtopic;";

        $stmt = Model::$pdo->prepare($sql);
        return $stmt->execute();
    }

    function ChangeEtatTopic($idtopic, $etatTopic){
        $sql = "UPDATE t_topic SET etat = '$etatTopic' WHERE id_topic = $idtopic";
        $stmt = Model::$pdo->prepare($sql);
        return $stmt->execute();
	}

	function getQCMs()
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_qcm");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getQCMCours($id)
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_qcm WHERE cours = :id_cours");
		$stmt->bindParam(':id_cours', $id);
		$stmt->execute();
		return $stmt->fetchAll()[0];
	}

	function getQCM($id)
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_qcm WHERE id_qcm = :id_qcm");
		$stmt->bindParam(':id_qcm', $id);
		$stmt->execute();
		return $stmt->fetchAll()[0];
	}

	function ajoutQCM($id,$diff)
	{
		$querystring = "INSERT INTO t_qcm (cours,diffi, nom_fichier) VALUES (:id,:diff,:fich);";
		$query = Model::$pdo->prepare( $querystring );
		$query->bindParam(':id',$id);
		$query->bindParam(':diff',$diff);
		$query->bindParam(':fich',"qcm".$id.".xml");
		$query->execute();
	
		return $query->fetchAll();
	}

	function getGroupes()
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_groupe_cours");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getGroupe($id)
	{
		$stmt = Model::$pdo->prepare("SELECT * FROM t_groupe_cours WHERE id_groupe = $id");
		$stmt->execute();
		return $stmt->fetchAll()[0];
	}


	function getGroupeCours($id){
		$cours = Model::$pdo->prepare("SELECT * FROM t_cours WHERE groupe = $id");
		$cours->execute();
		return $cours->fetchAll();
	}

	function ajoutGroupe($nom)
	{
		$querystring = "INSERT INTO t_groupe_cours (nom_groupe) VALUES (:nomg);";
		$query = Model::$pdo->prepare( $querystring );
		$query->bindParam(':nomg',$nom);
		$query->execute();
	
		return $query->fetchAll();
	}

	function supprimeGroupe($id)
	{
		$stmt = Model::$pdo->prepare('DELETE FROM t_groupe_cours WHERE id_groupe = :id_groupe');
		$stmt->bindParam(':id_groupe', $id);
		return $stmt->execute();
	}

	//Fonction pour ajouter les cours et QCM en même temps pour pouvoir avoir accès à l'id du cours ajouté
	function ajoutCoursQCM($groupe,$nom_cours,$dificulte,$contenu)
	{
		$querystring = "INSERT INTO t_cours (groupe,nom_cours,difficulte,contenu_cours) VALUES (:groupe,:nomc,:dif,:contenu);";
		$query = Model::$pdo->prepare( $querystring );
		$query->bindParam(':groupe',$groupe);
		$query->bindParam(':nomc',$nom_cours);
		$query->bindParam(':dif',$dificulte);
		$query->bindParam(':contenu',$contenu);
		$query->execute();

		$query->fetchAll();

		$id_cours = Model::$pdo->lastInsertId();
        $querystring = "INSERT INTO t_qcm (cours,diffi, nom_fichier) VALUES (:id,:diff,:fich);";
		$query = Model::$pdo->prepare( $querystring );
		$query->bindParam(':id',$id_cours);
		$query->bindParam(':diff',$dificulte);
		$nomFich = "qcm$id_cours.xml";
		$query->bindParam(':fich',$nomFich);
		$query->execute();
		
		return $query->fetchAll();
	}

	function getNiveauUserCours($id_user, $id_cours)
	{
		$cours = Model::$pdo->prepare("SELECT * FROM t_niveau WHERE user = $id_user AND cours = $id_cours");
		$cours->execute();
		return $cours->fetchAll();
	}

	function getNiveauUser($id_user)
	{
		$cours = Model::$pdo->prepare("SELECT * FROM t_niveau WHERE user = $id_user");
		$cours->execute();
		return $cours->fetchAll();
	}


	function passeNiveau($id_user, $id_cours, $diff)
	{
		switch($diff)
		{
			case "facile" : $niv = 1;break;
			case "intermédiaire" : $niv=2;break;
			case "avancé" : $niv=3;break;
		}

		$niveau = $this->getNiveauUserCours($id_user,$id_cours);
		if($niveau){
			switch($niveau[0]['niveau'])
			{
				case "facile" : $niv2 = 1;break;
				case "intermédiaire" : $niv2=2;break;
				case "avancé" : $niv2=3;break;
				default : $niv2=0;
			}
		} else {
			$niv2=0;
		}

		if(!$niveau) {
			if($niv > $niv2){
				$sql = "INSERT INTO t_niveau (user, cours, niveau) VALUES (:id_user, :id_cours, :diff)";			$stmt = Model::$pdo->prepare($sql);
				$stmt->bindParam(':id_user', $id_user);
				$stmt->bindParam(':id_cours', $id_cours);
				$stmt->bindParam(':diff', $diff);
				$stmt->execute();
			}
		} else {
			$sql = "UPDATE t_niveau SET niveau = :diff WHERE user = :id_user AND cours = :id_cours";
			$stmt = Model::$pdo->prepare($sql);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->bindParam(':id_cours', $id_cours);
			$stmt->bindParam(':diff', $diff);
			$stmt->execute();
		}
	}


}

?>
