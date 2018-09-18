<?php
if (isset($_POST['flag']) and ($_POST['flag']=="ok")) 	{
							try
							{
							/*$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');*/
							$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');
							$db->exec('SET NAMES utf8');
							}
							catch(Exception $e)
							{
                          /* $host = 'mysql5-22.90';
                           $user = 'studiogpvc1';
                           $passwd = 'FpgTxyF8xY';
                           $name = 'studiogpvc1';
                           $link=@mysql_connect($host,$user,$passwd);
                           if (!$link)  {*/
											  echo "<p>";
                                              echo "Erreur de connexion !!!";
                                              echo "</BR>";
                                              mail("michel.riou@gerard-pasquier.fr","Erreur de connexion","Erreur de connexion � la BD \n".$_POST['email']."\n"
                                              .$_POST['nom']."\n".$_POST['prenom']."\n".$_POST['adresse1']."\n".$_POST['adresse2']
                                              ."\n".$_POST['code_postal']."\n".$_POST['ville'],"From: admin@ventesclery.fr");
                                              exit;
                                              }
                                              $result= $db->prepare('SELECT * FROM membres WHERE EMAIL = :QN1');
                                              $result->execute(array(':QN1'=>$_POST['email']));
                                              $nb=$result->Rowcount(); /* Rowcount A VOIR*/
                                                   if ($nb==0){
													$result6= $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_creation) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9,NOW()) ');
													$result6->execute(array(':QN1'=>$_POST['nom'], ':QN2'=>$_POST['prenom'],':QN3'=>$_POST['pol'],':QN4'=>$_POST['ad1'],':QN5'=>$_POST['ad2'],':QN6'=>$_POST['pos'],':QN7'=>$_POST['ville'],':QN8'=>$_POST['taille'],':QN9'=>$_POST['email']));
                                                   echo '<body bgcolor="#800080" text=black><br><br><div  style="width:70%; margin-left: auto; margin-right: auto;text-align: center ; font-size: 2em; font-family: calibri,Verdana, sans-serif; background-color :#E3E3E3">';
                                                   echo "<br><br><br>MERCI DE VOTRE VISITE<BR>UN E-MAIL DE CONFIRMATION<BR>VA VOUS ETRE ENVOYE.";
                                                   echo "<br><br><br><br></div><div align=\"center\"><br><font color=\"#C0C0C0\"><font size=\"4\"><b>VENTESCLERY.FR - Batiment STOCKVET Zone artisanale All�e de la marchanderie<br>45370 Cl�ry saint-andr� Tel:02.38.45.79.15</b></font></font></div></body>";
                                                   $contenu="Votre inscription a �t� valid�e. Nous esp�rons vous voir lors de notre prochaine vente � Cl�ry Saint-Andr�.\n\nCordialement.";
		                                           $contenu=nl2br($contenu);
		                                           $message="<HTML>\n";
		                                           $message.="<HEAD>\n";
		                                           $message.="<META NAME\"GENERATOR\" Content=\"Microsoft DHTML Editing Control\">\n";
		                                           $message.="<TITLE></TITLE>\n";
		                                           $message.="</HEAD>\n";
		                                           $message.="<BODY><FONT face=Arial><FONT color=blue>";
		                                           $message.="<P><div align=\"center\"><STRONG><FONT size=5>Bonjour,</FONT></STRONG></div></P><div align=\"center\"><FONT color=blue><FONT face=\"Arial, Helvetica\" size\"2\">\n";
		                                           $message.=$contenu;
		                                           $message.="</div></FONT></P>\n";
		                                           $message.="</BODY>\n";
		                                           $message.="</HTML>\n";
		                                           $entetes="From: \"ventesclery.fr\" <newsletter@gerard-pasquier.fr>\n";
		                                           $entetes.="X-Sender: <newsletter@gerard-pasquier.fr>\n";
		                                           $entetes.="X-Mailer: PHP\n";
		                                           $entetes.="X-Priority: 1\n";
		                                           $entetes.="Return-path: <newsletter@gerard-pasquier.fr>\n";
		                                           $entetes.="Content-Type: text/html; charset=iso-8859-1\n";
		                                           mail($_POST['email'],"INSCRIPTION A VENTESCLERY.FR",$message,$entetes);
		                                           
                                                   exit;         
                                                   } else{
                                                   echo "<BR><BR><BR><div align=\"center\" style=\" background-color:#FFFFFF\"><font face=\"Times New Roman\" size=\"4\"><b>";
                                                   echo "CET EMAIL EST DEJA PRESENT !!<BR>";
                                                   echo "<BR>Email   :".$_POST['email']."<br><br>VEUILLEZ VERIFIER VOS COORDONNEES.<br> MERCI.";
                                                   echo "</b></font></div>";    
                                                   mail("michel.riou@gerard-pasquier.fr","DOUBLON","email =".$_POST['email']."nom =".$_POST['nom']."prenom =".$_POST['prenom'],"From: michel@studio-gp.fr");            
		                                           exit;
                                                   }
 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="Generator" content="FreshHTML v1.00" />
        <meta name="description" content="Site de ventes priv�es pr�t � porter f�minin � CLERY SAINT-ANDRE 45370, pr�s d'ORLEANS">
        <meta name="keywords" content="braderie, v�tements discount, clery saint-andr�, gerard pasquier , soldes, magasins d'usine, vente priv�e, ventesclery" />
        <meta name="robots" content="index, follow, all" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>ventesclery-Vente priv�e � CLERY SAINT-ANDRE</title>
    <script type="text/javascript">
 function verif_mail()
    {
    var mail=document.forms["form2"].email.value;
    /*var x=c.indexOf("@",1);*/
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    /*var y=c.indexOf(".",x+1);*/
    if (! reg.test(mail) )
    {
    alert("Votre E-mail ne semble pas valide !!");
    document.forms["form2"].email.focus();
    return false;
    }
    return true;
    }
    function verif() 
    {
    if (document.forms["form2"].nom.value.length < 1) 
    {
    alert("Veuillez ajouter votre nom, Merci.");
    document.forms["form2"].nom.focus();
    return false;
    }
    if (document.forms["form2"].prenom.value.length < 1) 
    {
    alert("Veuillez ajouter votre pr�nom, Merci.");
    document.forms["form2"].prenom.focus();
    return false;
    }
	
    if (document.forms["form2"].ad1.value.length < 1) 
    {
    alert("Veuillez ajouter votre adresse, Merci.");
    document.forms["form2"].ad1.focus();
    return false;
    }
	if (document.forms["form2"].pos.value.length < 1) 
    {
    alert("Veuillez ajouter votre code postal, Merci.");
    document.forms["form2"].pos.focus();
    return false;
    }
    if (document.forms["form2"].ville.value.length < 1) 
    {
    alert("Veuillez ajouter votre ville, Merci.");
    document.forms["form2"].ville.focus();
    return false;
    }
	if (document.forms["form2"].email.value.length < 6) 
    {
    alert("Veuillez ajouter un E-mail valide, Merci.");
    document.forms["form2"].email.focus();
    return false;
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
    <body bgcolor="#800080">
        <div align="center" style="background-color:#800080;font-family: calibri, 'Arial Black',  Verdana, sans-serif ">
             <div style="color:#C0C0C0">  <br>Attention, toutes les zones sont obligatoires.<br>Sauf votre taille, �videmment...
             
             <br><br></div>
             
             
            <form name="form2" action="inscription.php" method="post" autocomplete="off" onSubmit="return verif_form()">
             		<table class="listing" style="width:70%">
				<caption style="background-color:#809FAA">CREATION</caption>
		<tr><th class="TD0"></th><th class="TD0"><input type="hidden" name="flag" value="ok"></th></tr>   
		<tr class="TD0"><td class="TD0">ID</td><td class="TD0">NOUVEAU</td></tr>
		<tr class="TD0"><td class="TD0">POLITESSE</td><td class="TD0"><span><input type="radio" name="pol" value="Mme" checked="checked">Mme</span>
		<span><input type="radio" name="pol" value="Mle" >Mle</span>
		<span><input type="radio" name="pol" value="Mr" >Mr</span>
		</td></tr>
        <tr class="TD0"><td class="TD0">NOM</td><td class="TD0"><input class="text" type="text" size="25" maxlength="25" name="nom" ></td></tr>
        <tr class="TD0"><td class="TD0">PRENOM</td><td class="TD0"><input class="text" type="text" size="25" maxlength="25" name="prenom" ></td></tr>
		<tr class="TD0"><td class="TD0">ADRESSE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" name="ad1" ></td></tr>
		<tr class="TD0"><td class="TD0">ADRESSE - SUITE -</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" name="ad2" ></td></tr>
        <tr class="TD0"><td class="TD0">CODE POSTAL</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" name="pos" ></td></tr>
		<tr class="TD0"><td class="TD0">VILLE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" name="ville" ></td></tr>
		<tr class="TD0"><td class="TD0">TAILLE</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" name="taille" ></td></tr>
		<tr class="TD0"><td class="TD0">E-MAIL</td><td class="TD0"><input class="text" type="text" name="email" ></td></tr>
		
		<tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="bouton1" type="submit" value="VALIDER"></td></tr>
        </table> 
            </form>
			<br><br>
            <div align="center" style="background-color:#800080; font-family: calibri, 'Arial Black',  Verdana, sans-serif; color:#C0C0C0;font-size:4"><br>VENTESCLERY.FR - Batiment STOCKVET - Zone artisanale - All�e de la marchanderie<br>45370 Cl�ry saint-andr� Tel:02.38.45.79.15</div>
        </div>
		<div><A HREF="/VC5/maj_membres.php" target=_blank>.</A></div> 
    </body>
</html>