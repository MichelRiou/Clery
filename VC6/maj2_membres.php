<?php
include("../connect.inc.php");
if (isset($_GET['id']) and isset($_GET['type'])) {
    try {
        $result5 = $db->prepare('SELECT * FROM membres WHERE ID_MEMBRE = :QN1 ');
        $result5->execute(array(':QN1' => intval($_GET['id']))); /* close cursor a faire */
        $data5 = $result5->fetch();
    } catch (PDOException $e) {
        die('ERREUR SQL: ' . $e->getMessage() . '<BR>' . 'MSG:' . $e->getcode()) . '<BR>';
    }
}
?>
<!<DOCTYPE html>
    <html lang="fr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

            <link rel="stylesheet" type="text/css" href="../style.css" />
            <title>MISE A JOUR FICHIER MAILING</title>
            <script type="text/javascript" language="javascript" src="../javascript.js"></script>
        </head>
        <body>
            <form name="form4" action="maj3_membres.php" autocomplete="off" method="post" onSubmit="return verif_form()">
                <center>
                    <table class="listing" style="width:50%">
                        <caption style="background-color:#FFFFAA">MISE A JOUR</caption>
                        <tr><th class="TD0"><input type="hidden" name="type" value="<?php echo($_GET['type']) ?>"></th><th class="TD0"><input type="hidden" name="id" value="<?php echo($data5['id_membre']) ?>"></th></tr>   
                        <tr class="TD0"><td class="TD0">ID</td><td class="TD0"><?php echo ($data5['id_membre']) ?></td></tr>
                        <tr class="TD0"><td class="TD0">POLITESSE</td><td class="TD0"><span><input type="radio" name="pol" value="Mme" <?php
                                    if (($data5['politesse'] <> "Mlle") or ( $data5['politesse'] <> "Mr")) {
                                        echo ('checked="checked"');
                                    }
                                    ?> >Mme</span>
                                <span><input type="radio" name="pol" value="Mle" <?php
                                    if ($data5['politesse'] == "Mle") {
                                        echo ('checked="checked"');
                                    }
                                    ?>>Mle</span>
                                <span><input type="radio" name="pol" value="Mr" <?php
                                    if ($data5['politesse'] == "Mr") {
                                        echo ('checked="checked"');
                                    }
                                    ?>>Mr</span>

                            </td></tr>
                        <tr class="TD0"><td class="TD0">NOM</td><td class="TD0" ><input class="text" type="text" size="50" maxlength="50" id="nom" name="nom" value="<?php echo ($data5['nom']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">PRENOM</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="prenom" name="prenom" value="<?php echo ($data5['prenom']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">ADRESSE</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="ad1" name="ad1" value="<?php echo ($data5['adresse1']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="ad2" name="ad2" value="<?php echo ($data5['adresse2']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">CODE POSTAL</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" id="pos" name="pos" value="<?php echo ($data5['code_postal']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">VILLE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" id="ville" name="ville" value="<?php echo ($data5['ville']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">TAILLE</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" id="taille" name="taille" value="<?php echo ($data5['taille']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">E-MAIL</td><td class="TD0"><input class="text" type="text" id="email" name="email" value="<?php echo ($data5['email']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">SMS</td><td class="TD0"><input class="text" type="text" id="sms" maxlength="10" name="sms" value="<?php echo ($data5['sms']) ?>"></td></tr>

                        <tr class="TD0"><td class="TD0">SUSPENSION</td><td class="TD0"><span><input type="radio" name="sus" value=1 id="sus"<?php
                                    if ($data5['suppression'] <> 0) {
                                        echo ('checked="checked"');
                                    }
                                    ?> >OUI</span>
                                <span><input type="radio" name="sus" value=0 <?php
                                    if ($data5['suppression'] == 0) {
                                        echo ('checked="checked"');
                                    }
                                    ?>>NON</span>
                            </td></tr>
                        <tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="bouton1" type="submit" value="VALIDER"></td></tr>
                        <tr><td colspan="2"><div id='message' ></div></td></tr>
                    </table>
                </center>
            </form>

        </body>
    </html>