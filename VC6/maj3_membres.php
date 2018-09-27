<?php
include("connect.inc.php");
if (isset($_POST['id'])) {
  
    try {
        switch ($_POST['type']) {
            case "M":
                if ($_POST['sus'] == 0) {
                    $result6 = $db->prepare('UPDATE membres SET NOM= :QN1,PRENOM= :QN2,POLITESSE= :QN3,ADRESSE1= :QN4,ADRESSE2= :QN5,CODE_POSTAL= :QN6,VILLE= :QN7, TAILLE= :QN8,EMAIL= :QN9, SUPPRESSION= :QN10, SMS= :QN11  WHERE ID_MEMBRE = :QN20 ');
                  //  $result6->execute(array(':QN1' => $_POST['nom'], ':QN2' => $_POST['prenom'], ':QN3' => $_POST['pol'], ':QN4' => $_POST['ad1'], ':QN5' => $_POST['ad2'], ':QN6' => $_POST['pos'], ':QN7' => $_POST['ville'], ':QN8' => $_POST['taille'], ':QN9' => $_POST['email'], ':QN10' => $_POST['sus'], ':QN20' => intval($_POST['id']), ':QN11' => $_POST['sms'])); /* close cursor a faire */
                } else {
                    $result6 = $db->prepare('UPDATE membres SET NOM= :QN1,PRENOM= :QN2,POLITESSE= :QN3,ADRESSE1= :QN4,ADRESSE2= :QN5,CODE_POSTAL= :QN6,VILLE= :QN7, TAILLE= :QN8,EMAIL= :QN9, SUPPRESSION= :QN10, DATE_SUPPRESSION= NOW(), SMS= :QN11  WHERE ID_MEMBRE = :QN20 ');
                  //  $result6->execute(array(':QN1' => $_POST['nom'], ':QN2' => $_POST['prenom'], ':QN3' => $_POST['pol'], ':QN4' => $_POST['ad1'], ':QN5' => $_POST['ad2'], ':QN6' => $_POST['pos'], ':QN7' => $_POST['ville'], ':QN8' => $_POST['taille'], ':QN9' => $_POST['email'], ':QN10' => $_POST['sus'], ':QN20' => intval($_POST['id']), ':QN11' => $_POST['sms'])); /* close cursor a faire */
                }
                $result6->execute(array(':QN1' => trim($_POST['nom']), ':QN2' => trim($_POST['prenom']), ':QN3' => trim($_POST['pol']), ':QN4' => trim($_POST['ad1']), ':QN5' => trim($_POST['ad2']), ':QN6' => trim($_POST['pos']), ':QN7' => trim($_POST['ville']), ':QN8' => trim($_POST['taille']), ':QN9' => trim($_POST['email']), ':QN10' => $_POST['sus'], ':QN20' => intval($_POST['id']), ':QN11' => trim($_POST['sms']))); /* close cursor a faire */
                $result6->closecursor();
                break;
            case "I":
                if (isset($_POST['visite'])) {
                    $result6 = $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_validation,date_creation,sms) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9, NOW(),NOW(),:QN10)');
                } else {
                    $result6 = $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_creation,sms) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9,NOW(),:QN10)');
                }
                $result6->execute(array(':QN1' => trim($_POST['nom']), ':QN2' => trim($_POST['prenom']), ':QN3' => $_POST['pol'], ':QN4' => $_POST['ad1'], ':QN5' => trim($_POST['ad2']), ':QN6' => trim($_POST['pos']), ':QN7' => trim($_POST['ville']), ':QN8' => trim($_POST['taille']), ':QN9' => trim($_POST['email']), ':QN10' => trim($_POST['sms'])));
                $result6->closecursor();
                break;
            case "P":
                break;
            default:
                break;
        }
        header('location: maj_membres.php');
    } catch (PDOException $e) {
        echo ('<DIV><CENTER>ERREUR SQL: ' . $e->getMessage() . '<BR>MSG:' . $e->getcode())
        ?>
        <BR><input type="button" value="Maj" class="bouton1" onclick="self.location.href = 'maj_membres.php'">
        </CENTER>
        </DIV>'
        <?php
    }
}
?>