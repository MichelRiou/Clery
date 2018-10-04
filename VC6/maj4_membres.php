<?php

include("../connect.inc.php");
if (isset($_GET['id'])) {

    try {
        switch ($_GET['type']) {
            case "P":
                $result6 = $db->prepare('UPDATE membres SET DATE_VALIDATION= NOW() WHERE ID_MEMBRE = :QN1 ');
                $result6->execute(array(':QN1' => intval($_GET['id'])));
                $result7 = $db->prepare('INSERT INTO visite (id_visite,date_visite) VALUES(:QN1, NOW()) ');
                $result7->execute(array(':QN1' => intval($_GET['id'])));
                break;
            default:
                break;
        }
        $result6->closecursor();
        header('location:maj_membres.php');
    } catch (PDOException $e) {
        die('ERREUR SQL: ' . $e->getMessage() . '<BR>' . 'MSG:' . $e->getcode()) . '<BR>';
    }
}
?>