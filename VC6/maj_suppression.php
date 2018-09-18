<?php
			try
			{
    			$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');
				/*$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');*/
				$db->exec('SET NAMES utf8');
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(Exception $e)
			{
										echo "Erreur de connexion au serveur.<BR>";
										echo "Site indisponible.<BR>";
            die('Erreur : '.$e->getMessage());
			}               
									               $result= $db->prepare('SELECT * FROM membres WHERE SUPPRESSION <> 0');
												   $result2= $db->prepare('INSERT INTO membressuppr (id_membre, nom, prenom, politesse, adresse1, adresse2,code_postal,ville,taille,email,time_creation,date_creation,date_validation,validation,date_suppression,suppression) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9,:QN10,:QN11,:QN12,:QN13,:QN14,:QN15,:QN16)');
                                                   $result->execute();
											while ($data = $result->fetch())
		{
        $result2->execute(array(':QN1'=>$data['id_membre'], ':QN2'=>$data['nom'],':QN3'=>$data['prenom'],':QN4'=>$data['politesse'],':QN5'=>$data['adresse1'],':QN6'=>$data['adresse2'],':QN7'=>$data['code_postal'],':QN8'=>$data['ville'],':QN9'=>$data['taille'],':QN10'=>$data['email'],':QN11'=>$data['time_creation'],':QN12'=>$data['date_creation'],':QN13'=>$data['date_validation'],':QN14'=>$data['validation'],':QN15'=>$data['date_suppression'],':QN16'=>$data['suppression']));
				
		}
		$result->closecursor();
		$result2->closecursor();
		           $result3= $db->prepare('SELECT * FROM membressuppr WHERE SUPPRESSION <> 9');
				   $result4= $db->prepare('DELETE FROM membres WHERE id_membre= :RN1 AND NOM= :RN2 AND suppression= :RN3');
				   $result5= $db->prepare('UPDATE membressuppr SET suppression=9 WHERE id_membre= :SN1 AND NOM= :SN2 AND suppression= :SN3');
                   $result3->execute();
											while ($data2 = $result3->fetch())
											{
					try
					{
				  $result4->execute(array(':RN1'=>$data2['id_membre'],':RN2'=>$data2['nom'],':RN3'=>$data2['suppression'])) ;
				     }
					 catch(Exception $e)
					{
										echo "Erreur de delete.<BR>";
									die('Erreur : '.$e->getMessage());
					}
					try
					{
				  $result5->execute(array(':SN1'=>$data2['id_membre'],':SN2'=>$data2['nom'],':SN3'=>$data2['suppression']));
				  }
				   catch(Exception $e)
					{
										echo "Erreur de update.<BR>";
									die('Erreur : '.$e->getMessage());
					}
				   }
 		?>
