<?php
/*echo $_POST['id'].'<br>';
echo $_POST['nom'].'<br>';
echo $_POST['type'].'<br>';
echo $_POST['prenom'].'<br>';
echo $_POST['pol'].'<br>';
echo $_POST['ad1'].'<br>';
echo $_POST['ad2'].'<br>';
echo $_POST['ville'].'<br>';
echo $_POST['pos'].'<br>';
echo $_POST['taille'].'<br>';
echo $_POST['email'].'<br>';
echo $_POST['visite'].'<br>';*/
if (isset($_POST['id']))
{
try
			{
    			/*$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');*/
				$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');
				$db->exec('SET NAMES utf8');
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{                                                             
										die('SERVEUR INDISPONIBLE'.$e->getMessage().'<BR>'.'MSG:'.$e->getcode().'<BR>');
			}
			try
			{
switch ($_POST['type']) {
case "M":
if ($_POST['sus'] == 0) 
{
$result6= $db->prepare('UPDATE membres SET NOM= :QN1,PRENOM= :QN2,POLITESSE= :QN3,ADRESSE1= :QN4,ADRESSE2= :QN5,CODE_POSTAL= :QN6,VILLE= :QN7, TAILLE= :QN8,EMAIL= :QN9, SUPPRESSION= :QN10  WHERE ID_MEMBRE = :QN20 ');
            $result6->execute(array(':QN1'=>$_POST['nom'],':QN2'=>$_POST['prenom'],':QN3'=>$_POST['pol'],':QN4'=>$_POST['ad1'],':QN5'=>$_POST['ad2'],':QN6'=>$_POST['pos'],':QN7'=>$_POST['ville'],':QN8'=>$_POST['taille'],':QN9'=>$_POST['email'],':QN10'=>$_POST['sus'],':QN20'=>intval($_POST['id']))); /* close cursor a faire */			
} else
{
$result6= $db->prepare('UPDATE membres SET NOM= :QN1,PRENOM= :QN2,POLITESSE= :QN3,ADRESSE1= :QN4,ADRESSE2= :QN5,CODE_POSTAL= :QN6,VILLE= :QN7, TAILLE= :QN8,EMAIL= :QN9, SUPPRESSION= :QN10, DATE_SUPPRESSION= NOW()  WHERE ID_MEMBRE = :QN20 ');
            $result6->execute(array(':QN1'=>$_POST['nom'],':QN2'=>$_POST['prenom'],':QN3'=>$_POST['pol'],':QN4'=>$_POST['ad1'],':QN5'=>$_POST['ad2'],':QN6'=>$_POST['pos'],':QN7'=>$_POST['ville'],':QN8'=>$_POST['taille'],':QN9'=>$_POST['email'],':QN10'=>$_POST['sus'],':QN20'=>intval($_POST['id']))); /* close cursor a faire */
}
$result6->closecursor();
break;
case "I":
if (isset($_POST['visite']))
{
$result6= $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_validation,date_creation) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9, NOW(),NOW())');
} else
{
$result6= $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_creation) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9,NOW()) ');
}
            $result6->execute(array(':QN1'=>$_POST['nom'], ':QN2'=>$_POST['prenom'],':QN3'=>$_POST['pol'],':QN4'=>$_POST['ad1'],':QN5'=>$_POST['ad2'],':QN6'=>$_POST['pos'],':QN7'=>$_POST['ville'],':QN8'=>$_POST['taille'],':QN9'=>$_POST['email']));
break;
case "P":
break;
default:
break;
} 
header('location: maj_membres.php');
			}
			catch(PDOException $e)
			{             
			echo ('<DIV><CENTER>ERREUR SQL: '.$e->getMessage().'<BR>MSG:'.$e->getcode())?>
			<BR><input type="button" value="Maj" class="bouton1" onclick="self.location.href='maj_membres.php'">
			</CENTER>
			</DIV>'
			<?php
			}			
}
?>