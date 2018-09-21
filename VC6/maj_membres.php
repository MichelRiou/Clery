<?php
include("connect.inc.php");
$choix = 0;
/* if (isset($_POST['nom']) or  isset($_POST['email'])) {
  $savnom=$_POST['nom'];
  $savmail=$_POST['email']; */
/* 	try
  {
  //$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');

  //$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');
  //$db->exec('SET NAMES utf8');
  }
  catch(Exception $e)
  {

  echo "Erreur de connexion au serveur.<BR>";
  echo "Site indisponible.<BR>";

  mail("michel.riou@gerard-pasquier.fr","Erreur de connexion","Erreur de connexion à la BD \n".$_POST['email']."\n"
  .$_POST['nom']."\n".$_POST['prenom']."\n".$_POST['adresse1']."\n".$_POST['adresse2']
  ."\n".$_POST['code_postal']."\n".$_POST['ville'],"From: admin@ventesclery.fr");
  die('Erreur : '.$e->getMessage());
  } */
if (isset($_POST['nom']) and ( $_POST['nom'] <> '')) {

    $savnom = $_POST['nom'];
    $savmail = '';
    $result = $db->prepare('SELECT * FROM membres WHERE NOM like :QN1 ORDER BY NOM');
    $result->execute(array(':QN1' => $_POST['nom'] . '%'));
    $result2 = $db->prepare('SELECT * FROM membres WHERE NOM = :QN1 ORDER BY NOM');
    $result2->execute(array(':QN1' => $_POST['nom']));


    $choix = 1;
} else {
    if (isset($_POST['email']) and $_POST['email'] <> '') {


        $savmail = $_POST['email'];
        $savnom = '';
        $result = $db->prepare('SELECT * FROM membres WHERE EMAIL like :QM1 ');
        $result->execute(array(':QM1' => '%' . $_POST['email'] . '%'));
        $result2 = $db->prepare('SELECT * FROM membres WHERE EMAIL = :QM1 ');
        $result2->execute(array(':QM1' => $_POST['email']));


        $choix = 2;
    }
}
$result3 = $db->prepare('SELECT * FROM membres ORDER BY TIME_CREATION DESC LIMIT 3');
$result3->execute();
/* 		} */
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>MISE A JOUR FICHIER MAILING</title>
        <script type="text/javascript">
            function verif_mail()
            {
                if (!(document.forms["form2"].nomail.checked))
                {
                    var c = document.forms["form2"].email.value;
                    var x = c.indexOf("@", 1);

                    /*var y=c.indexOf(".",x+1);*/
                    if (x == -1)
                    {
                        alert("Votre E-mail ne semble pas valide !!");
                        document.forms["form2"].email.focus();
                        return false;
                    }
                    return true;
                } else {
                    return true;
                }
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
                    alert("Veuillez ajouter votre prénom, Merci.");
                    document.forms["form2"].prenom.focus();
                    return false;
                }
                if ((document.forms["form2"].email.value.length < 6) && !(document.forms["form2"].nomail.checked))
                {
                    alert("Veuillez ajouter un E-mail valide, Merci.");
                    document.forms["form2"].email.focus();
                    return false;
                }

                if (document.forms["form2"].pos.value.length < 1)
                {
                    alert("Veuillez ajouter votre code postal, Merci.");
                    document.forms["form2"].pos.focus();
                    return false;
                }
                if (document.forms["form2"].nomail.checked)
                {
                    if (document.forms["form2"].ad1.value.length < 1)
                    {
                        alert("Veuillez ajouter votre adresse, Merci.");
                        document.forms["form2"].ad1.focus();
                        return false;
                    }
                    if (document.forms["form2"].ville.value.length < 1)
                    {
                        alert("Veuillez ajouter votre ville, Merci.");
                        document.forms["form2"].ville.focus();
                        return false;
                    }
                }
                return true;
            }
            function verif_form()
            {
                if (verif() == true && verif_mail() == true)
                {
                    return true;
                }
                return false;
            }
        </script>
    </head>
    <body bgcolor="#FFFFFF" text=black onload="document.getElementById('RI').focus()">
        <div align="center" style="background-color:#FFFFFF">
            <form name="formulaire" action="maj_membres.php" autocomplete="off" method="post">
                <table class="listing">
                    <caption style="background-color:#FFFFAA">MISE A JOUR FICHIER MAILING</caption>
                    <tr><th class="TD0">PAR NOM</th><th class="TD0">PAR MAIL</th></th><th class="TD0"><input type="hidden" name="flag" value="ok"></th></tr>
                    <tr><td class="TD0"><input class="text" id="RI" type="text" name="nom"></td><td class="TD0"><input class="text" type="text" name="email"></td><td class="TD0"><input class="bouton1" type="submit" value="Rechercher"></td></tr>
                  <!--  <tr><td></td><td><input type="submit" value="Rechercher"></td></tr>
                        <tr><td></td><td><input type="hidden" name="flag" value="ok"></td></tr> -->
                </table>
            </form>
        </div>
<?php
if ($choix <> 0) {
    ?>

            <?php
            $nb = $result2->Rowcount(); /* Rowcount A VOIR */
            $nb3 = $result3->Rowcount(); /* Rowcount A VOIR */

            if ($nb == 0) {
                ?>
                <div style="background-color:#C3C3C3">
                    <form name="form2" action="maj3_membres.php" autocomplete="off" method="post" onSubmit="return verif_form()">
                        <table class="listing">
                            <caption style="background-color:#FFFFAA">CREATION</caption>
                            <tr>
                                <th class="TD0"><span><input type="radio" name="pol" value="Mme" checked="checked">Mme</span>
                                    <span><input type="radio" name="pol" value="Mle">Mlle</span>
                                    <span><input type="radio" name="pol" value="Mr">Mr</span></th>
                                <th class="TD0"></th>
                                <th class="TD0"></th>
                                <th class="TD1"></th>
                                <th class="TD2"></th>
                                <th class="TD2"></th>
                            </tr>
                            <tr>
                                <th class="TD0">Nom</th>
                                <th class="TD0">Prénom</th>
                                <th class="TD0">E-mail</th>
                                <th class="TD1">SMS</th>
                                <th class="TD2">Code postal</th>
                                <th class="TD2">Taille</th>
                            </tr>
                            <tr>
                                <td class="TD0"><input class="text" type="text" id="TI" required size="25" maxlength="25"name="nom" value="<?php echo htmlspecialchars($savnom) ?>"></td>
                                <td class="TD0"><input class="text" type="text" size="25" required maxlength="25" name="prenom"></td>
                                <td class="TD0"><input class="text" type="text" name="email" value="<?php echo htmlspecialchars($savmail) ?>"><span><input type="checkbox" name="nomail" value="No">No</span></td>
                                <td class="TD1"><input class="text" pattern="0[6-7][0-9]{8}" placeholder="ex: 0612345678" type="text" size="10" maxlength="10"name="sms"></td>
                                <td class="TD2"><input class="text" pattern="[0-9]{5}" placeholder="ex: 03120" type="text" size="5" maxlength="5"name="pos"></td>
                                <td class="TD2"><input class="text" type="text" size="5" maxlength="5" name="taille"></td>
                            </tr>
                            <tr>
                                <th class="TD0">Adresse</th>
                                <th class="TD0">Suite adresse</th>
                                <th class="TD0">Ville</th>
                                <th class="TD1">Visite</th>
                                <th colspan=2 class="TD1"></th>
                            </tr>
                            <tr><td class="TD0"><input class="text" type="text" size="30" maxlength="50" name="ad1"></td>
                                <td class="TD0"><input class="text" type="text" size="30" maxlength="50" name="ad2"></td>
                                <td class="TD0"><input class="text" type="text" size="30" maxlength="30" name="ville"></td>
                                <td class="TD1">Aujourd'hui<input type="checkbox" name="visite" value="checked"></td>
                                <td colspan=2 class="TD1"><input class="bouton1" type="submit" value="Créer"><input type="hidden" name="type" value="I"><input type="hidden" name="id" value="0"></td>
                            </tr>


                            <!--
                    <table cellspacing="2" cellpadding="2" border="0" >
                            <tr><td>NOM</td><td>PRENOM</td><td>E-MAIL</td><td><input type="hidden" name="flag2" value="INS"></td><td></td></tr>
                            <tr><td></td><td></td><td></td><td><input type="hidden" name="flag2" value="INS"></td><td></td></tr>
                            <tr><td>CODEPOSTAL</td><td>VILLE</td><td>ADRESSE</td><td></td><td></td></tr>
                            <tr><td><input class="text" type="text" name="Ccodpos"></td><td><input class="text" type="text" name="Cville"></td><td><input class="text" type="text" name="Cadresse1"></td><td><input class="text" type="text" name="Cadresse2"></td><td><input type="submit" value="Créer"></td></tr>
                            -->
                        </table>
                    </form>
                </div>
        <?php
    } else {
        ?>
                <table class="listing">
                    <caption style="background-color:#FFFFAA">Recherche par Nom</caption>
                    <tr><th class="TD0">Nom</th><th class="TD0">Prénom</th><th class="TD0">E-mail</th><th class="TD1">Visite</th><th class="TD1"></tr>
                <?php
                while ($data = $result2->fetch()) {
                    ?>
                        <tr><td class="TD0" <?php if ($data['suppression'] <> 0) echo ('style="color:red"') ?>><?php echo nl2br(htmlspecialchars(strtoupper($data['nom']))) ?><div class="bulle"><?php echo nl2br(htmlspecialchars(strtoupper($data['adresse1']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['code_postal']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['ville']))) ?></div></td>
                            <td class="TD0"><?php echo nl2br(htmlspecialchars(strtoupper($data['prenom']))) ?></td>
                            <td class="TD0"><?php echo nl2br(htmlspecialchars($data['email'])) ?></td>
                            <td class="TD1"><?php echo $data['date_validation'] ?></td>
                            <td class="TD1"><input type="button" value="Maj" class="bouton1" onclick="self.location.href = 'maj2_membres.php?id=<?php echo($data['id_membre']) ?>&type=M'"><input type="button" value="Visite" class="bouton1" onclick="self.location.href = 'maj4_membres.php?id=<?php echo($data['id_membre']) ?>&type=P'"></td></tr>
                        <?php
                    }
                    ?>
                </table>
        <?php
    }
}
?>
        <table class="listing">
            <caption style="background-color:#FFFFAA">Dernière mise à jour</caption>
            <tr><th class="TD0">Nom</th><th class="TD0">Prénom</th><th class="TD0">E-mail</th><th class="TD1">Maj</th><th class="TD1"></tr>
        <?php
        while ($data = $result3->fetch()) {
            ?>

                <tr><td class="TD0" <?php if ($data['suppression'] <> 0) echo ('style="color:red"') ?>><?php echo nl2br(htmlspecialchars(strtoupper($data['nom']))) ?><div class="bulle"><?php echo nl2br(htmlspecialchars(strtoupper($data['adresse1']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['code_postal']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['ville']))) ?></div></td>
                    <td class="TD0"><?php echo nl2br(htmlspecialchars(strtoupper($data['prenom']))) ?></td>
                    <td class="TD0"><?php echo nl2br(htmlspecialchars($data['email'])) ?></td>
                    <td class="TD1"><?php echo $data['time_creation'] ?></td>
                    <td class="TD1"><input type="button" value="Maj" class="bouton1" onclick="self.location.href = 'maj2_membres.php?id=<?php echo($data['id_membre']) ?>&type=M'"><input type="button" value="Visite" class="bouton1" onclick="self.location.href = 'maj4_membres.php?id=<?php echo($data['id_membre']) ?>&type=P'"></td></tr>
                <?php
            }
            ?>
<?php
if ($choix <> 0) {
    ?>
            </table>
            <!--<form name="form3" action="maj2_membres.php" method="post" > -->
            <table class="listing">
                <caption style="background-color:#FFFFAA">Recherche étendue</caption>
                <tr><th class="TD0">Nom</th><th class="TD0">Prénom</th><th class="TD0">E-mail</th><th class="TD1">Visite</th><th class="TD1"></tr>
                <?php
                while ($data = $result->fetch()) {
                    ?>

                    <tr><td class="TD0" <?php if ($data['suppression'] <> 0) echo ('style="color:red"') ?>><?php echo nl2br(htmlspecialchars(strtoupper($data['nom']))) ?><div class="bulle"><?php echo nl2br(htmlspecialchars(strtoupper($data['adresse1']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['code_postal']))); ?> &nbsp <?php echo nl2br(htmlspecialchars(strtoupper($data['ville']))) ?></div></td>
                        <td class="TD0"><?php echo nl2br(htmlspecialchars(strtoupper($data['prenom']))) ?></td>
                        <td class="TD0"><?php echo nl2br(htmlspecialchars($data['email'])) ?></td>
                        <td class="TD1"><?php echo $data['date_validation'] ?></td>
                        <td class="TD1"><input type="button" value="Maj" class="bouton1" onclick="self.location.href = 'maj2_membres.php?id=<?php echo($data['id_membre']) ?>&type=M'"><input type="button" value="Visite" class="bouton1" onclick="self.location.href = 'maj4_membres.php?id=<?php echo($data['id_membre']) ?>&type=P'"></td></tr>
                    <?php
                }
                ?>
            </table>
            <!--</form> -->
    <?php
}
?>
    </body>
</html>