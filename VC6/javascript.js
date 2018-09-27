var msg = '';
            function checkMail()
            {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(document.getElementById("email").value.toLowerCase());
            }
            function checkSms() {
                var re = /^0[6-7][0-9]{8}$/;
                return re.test(document.getElementById("sms").value);
            }
            function checkZipcode() {
                var re = /^[0-9]{5}$/;
                return re.test(document.getElementById("pos").value);
            }
            function checkAddress() {
                if ((document.getElementById("ad1").value.length > 1) && (document.getElementById("ville").value.length > 1) && checkZipcode())
                {
                    return true;
                } else {
                    return false;
                }
            }

            function verif_form()
            {
                msg = '';
                document.getElementById("nom").style.backgroundColor = "white";
                document.getElementById("prenom").style.backgroundColor = "white";
                document.getElementById("pos").style.backgroundColor = "white";
                document.getElementById("email").style.backgroundColor = "white";
                document.getElementById("sms").style.backgroundColor = "white";
                document.getElementById("ad1").style.backgroundColor = "white";
                document.getElementById("ville").style.backgroundColor = "white";

                if (document.getElementById("nom").value.trim().length < 1)
                {
                    document.getElementById("nom").style.backgroundColor = "orange";
                    document.getElementById("nom").focus();
                    msg += 'Le nom est obligatoire.<br>';
                }
                if (document.getElementById("prenom").value.trim().length < 1)
                {
                    document.getElementById("prenom").style.backgroundColor = "orange";
                    document.getElementById("prenom").focus();
                    msg += 'Le prénom est obligatoire.<br>';
                }
                if ((document.getElementById("sus")== null) || (!document.getElementById("sus").checked)){
                if (document.getElementById("ad1").value.length > 0
                        || document.getElementById("ad2").value.length > 0
                        || document.getElementById("pos").value.length > 0
                        || document.getElementById("ville").value.length > 0
                        || document.getElementById("pos").value.length > 0)
                {
                    if (!checkAddress()) {
                        document.getElementById("ad1").style.backgroundColor = "orange";
                        document.getElementById("ville").style.backgroundColor = "orange";
                        document.getElementById("pos").style.backgroundColor = "orange";
                        document.getElementById("ad1").focus();
                        msg += 'L\'adresse n\'est pas valide.<br>';
                    }
                }
                if ((document.getElementById("email").value.length > 0) && (!checkMail()))
                {
                    document.getElementById("email").style.backgroundColor = "orange";
                    document.getElementById("email").focus();
                    msg += 'L\'email n\'est pas valable.<br>';
                }
                if ((document.getElementById("sms").value.length > 0) && (!checkSms()))
                {
                    document.getElementById("sms").style.backgroundColor = "orange";
                    document.getElementById("sms").focus();
                    msg += 'Le numéro de téléphone est incorrect.<br>';
                }


                if (!checkMail() && !checkSms() && !checkAddress()) {

                    msg += 'Vous devez saisir soit un email, un numéro de portable ou une adresse complète.';
                }

                }
                if (msg == '') {
                    return true;
                } else
                {
                    console.log(message);
                    document.getElementById("message").innerHTML = msg;
                    return false;
                }

            }