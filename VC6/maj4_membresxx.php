<?php
/*echo $_GET['id'];*/
/*echo $_GET['type'];*/
if (isset($_GET['id']))
{
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
switch ($_GET['type']) {
case "P":
$result6= $db->prepare('UPDATE membres SET DATE_VALIDATION= NOW() WHERE ID_MEMBRE = :QN1 ');
            $result6->execute(array(':QN1'=>intval($_GET['id'])));
			$result7= $db->prepare('INSERT INTO visite (id_visite,date_visite) VALUES(:QN1, NOW()) ');
            $result7->execute(array(':QN1'=>intval($_GET['id'])));
break;
default:
break;
}
$result6->closecursor();
header('location:maj_membres.php');
			}
			catch(PDOException $e)
			{             
			die ('ERREUR SQL: '.$e->getMessage().'<BR>'.'MSG:'.$e->getcode()).'<BR>';
			}			
}
?>