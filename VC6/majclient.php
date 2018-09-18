<?php
try
			{
    			$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');
				/*$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');*/
				$db->exec('SET NAMES utf8');
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{                                                             
										die('SERVEUR INDISPONIBLE'.$e->getMessage().'<BR>'.'MSG:'.$e->getcode().'<BR>');
			}
			try
			{
			 $result= $db->prepare('SELECT * FROM client');
             $result->execute();
			 while ($data = $result->fetch())
			{
			$result2= $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7)');
			$result2->execute(array(':QN1'=>$data['NOM'],':QN2'=>$data['PRENOM'],':QN3'=>$data['POL'],':QN4'=>$data['AD1'],':QN5'=>$data['AD2'],':QN6'=>$data['CODPOS'],':QN7'=>$data['VILLE']));
			}
			} 
			catch(PDOException $e)
			{             
			echo ('<DIV><CENTER>ERREUR SQL: '.$e->getMessage().'<BR>MSG:'.$e->getcode());
			}			
?>