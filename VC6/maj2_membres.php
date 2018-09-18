<?php
	if (isset($_GET['id']) and  isset($_GET['type'])) {
			/*echo ($_GET['id']);*/
			/*echo ($_GET['type']);*/
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
			$result5= $db->prepare('SELECT * FROM membres WHERE ID_MEMBRE = :QN1 ');
            $result5->execute(array(':QN1'=>intval($_GET['id']))); /* close cursor a faire */
			$data5 = $result5->fetch();
			}
			catch(PDOException $e)
			{             
			die ('ERREUR SQL: '.$e->getMessage().'<BR>'.'MSG:'.$e->getcode()).'<BR>';
			}			
}
			
		?>
	<!<DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>MISE A JOUR FICHIER MAILING</title>
	
	<script type="text/javascript">
function verif_mail()
    {
	if (!(document.forms["form4"].nomail.checked))
	{
    var c=document.forms["form4"].email.value;
    var x=c.indexOf("@",1);
	
    /*var y=c.indexOf(".",x+1);*/
    if (x == -1) 
    {
    alert("Votre E-mail ne semble pas valide !!");
    document.forms["form4"].email.focus();
    return false;
    }
    return true;
    }
	else {
	return true;
	}
	}
    function verif() 
    {
    if (document.forms["form4"].nom.value.length < 1) 
    {
    alert("Veuillez ajouter votre nom, Merci.");
    document.forms["form4"].nom.focus();
    return false;
    }
    if (document.forms["form4"].prenom.value.length < 1) 
    {
    alert("Veuillez ajouter votre prénom, Merci.");
    document.forms["form4"].prenom.focus();
    return false;
    }
	if ((document.forms["form4"].email.value.length < 6) && !(document.forms["form4"].nomail.checked))
    {
    alert("Veuillez ajouter un E-mail valide, Merci.");
    document.forms["form4"].email.focus();
    return false;
	}
	
	if (document.forms["form4"].pos.value.length < 1) 
    {
    alert("Veuillez ajouter votre code postal, Merci.");
    document.forms["form4"].pos.focus();
    return false;
    }
	if (document.forms["form4"].nomail.checked)
	{
    if (document.forms["form4"].ad1.value.length < 1) 
    {
    alert("Veuillez ajouter votre adresse, Merci.");
    document.forms["form4"].ad1.focus();
    return false;
    }
    if (document.forms["form4"].ville.value.length < 1) 
    {
    alert("Veuillez ajouter votre ville, Merci.");
    document.forms["form4"].ville.focus();
    return false;
    }
	}
    return true;
    } 
    function verif_form()
    {
    if (verif()==true && verif_mail() ==true)
    {
    return true;
    }
    return false;
    }
    </script>
	 </head>
	 <body>
		<form name="form4" action="maj3_membres.php" autocomplete="off" method="post" onSubmit="return verif_form()">
		  <center>
				<table class="listing" style="width:50%">
				<caption style="background-color:#FFFFAA">MISE A JOUR</caption>
		<tr><th class="TD0"><input type="hidden" name="type" value="<?php echo($_GET['type']) ?>"></th><th class="TD0"><input type="hidden" name="id" value="<?php echo($data5['id_membre']) ?>"></th></tr>   
		<tr class="TD0"><td class="TD0">ID</td><td class="TD0"><?php echo ($data5['id_membre']) ?></td></tr>
		<tr class="TD0"><td class="TD0">POLITESSE</td><td class="TD0"><span><input type="radio" name="pol" value="Mme" <?php if (($data5['politesse']<>"Mlle") or ($data5['politesse']<>"Mr")) {echo ('checked="checked"'); }?> >Mme</span>
		<span><input type="radio" name="pol" value="Mle" <?php if ($data5['politesse']=="Mle") {echo ('checked="checked"') ;}?>>Mle</span>
		<span><input type="radio" name="pol" value="Mr" <?php if ($data5['politesse']=="Mr") {echo ('checked="checked"'); }?>>Mr</span>

		</td></tr>
        <tr class="TD0"><td class="TD0">NOM</td><td class="TD0"><input class="text" type="text" size="25" maxlength="25" name="nom" value="<?php echo ($data5['nom']) ?>"></td></tr>
        <tr class="TD0"><td class="TD0">PRENOM</td><td class="TD0"><input class="text" type="text" size="25" maxlength="25" name="prenom" value="<?php echo ($data5['prenom']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0">ADRESSE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="50" name="ad1" value="<?php echo ($data5['adresse1']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="text" type="text" size="30" maxlength="50" name="ad2" value="<?php echo ($data5['adresse2']) ?>"></td></tr>
        <tr class="TD0"><td class="TD0">CODE POSTAL</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" name="pos" value="<?php echo ($data5['code_postal']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0">VILLE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" name="ville" value="<?php echo ($data5['ville']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0">TAILLE</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" name="taille" value="<?php echo ($data5['taille']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0">E-MAIL</td><td class="TD0"><input class="text" type="text" name="email" value="<?php echo ($data5['email']) ?>"></td></tr>
		<tr class="TD0"><td class="TD0">Pas d'Email</td><td class="TD0"><input type="checkbox" name="nomail" value="No"></td></tr>
		<tr class="TD0"><td class="TD0">SUSPENSION</td><td class="TD0"><span><input type="radio" name="sus" value=1 <?php if ($data5['suppression']<>0) {echo ('checked="checked"'); }?> >OUI</span>
		<span><input type="radio" name="sus" value=0 <?php if ($data5['suppression']==0) {echo ('checked="checked"') ;}?>>NON</span>
		</td></tr>
		<tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="bouton1" type="submit" value="VALIDER"></td></tr>
        </table>
		</center>
        </form>
	</body>
	</html>