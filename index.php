<?php
  ini_set('display_errors','on');
  error_reporting(E_ALL);




/*SANITIZE */
$options = array(
  'prenom' 	=> FILTER_SANITIZE_STRING,
  'nom' 	=> FILTER_SANITIZE_STRING,
  'email' 		=> FILTER_VALIDATE_EMAIL,
  'pays' 		=> FILTER_SANITIZE_STRING,
  'sujet' 		=> FILTER_SANITIZE_STRING,
  'message' 		=> FILTER_SANITIZE_STRING,
  'genre' 		=> FILTER_SANITIZE_STRING);
$result = filter_input_array(INPUT_POST, $options);




/* variables & erreurs de saisies */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  $prenomErr = $nomErr = $sexeErr =  $emailErr = $messageErr = "";
  $prenom = $nom = $sexe = $email = $pays = $sujet = $message = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["prenom"])) {
    $prenomErr = "* Champ prenom requis";
  } else {
    $prenom = test_input($_POST["prenom"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$prenom)) {
  $prenomErr = "*Caractères invalides";
    }
  }

  if (empty($_POST["nom"])) {
    $nomErr = "* Champ nom requis";
  } else {
    $nom = test_input($_POST["nom"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {
  $nomErr = "*Caractères invalides";
    }
  }

  if (empty($_POST["sexe"])) {
    $sexeErr = "* Champ genre requis";
  } else {
    $sexe = test_input($_POST["sexe"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "* Champ email requis";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "*E-mail invalide";
    }
  }

  if (empty($_POST["pays"])) {
    $pays = "* Champ pays requis";
  } else {
    $pays = test_input($_POST["pays"]);
  }

  if (empty($_POST["sujet"])) {
    $sujet = "* Champ sujet requis";
  } else {
    $sujet = test_input($_POST["sujet"]);
  }

  if (empty($_POST["message"])) {
    $messageErr = "* Champ message requis";
  } else {
    $message = test_input($_POST["message"]);
  }
}



  /*Envoi du mail */

  if (isset($_POST['submit'])) {

  if (isset($_POST["nom"])) {$nom = $_POST["nom"];}
  if (isset($_POST["prenom"])) {$prenom = $_POST["prenom"];}
  if (isset($_POST["email"])) {$email = $_POST["email"];}
  if (isset($_POST["pays"])) {$pays = $_POST["pays"];}
  if (isset($_POST["sujet"])) {$sujet = $_POST["sujet"];}
  if (isset($_POST["message"])) {$message = $_POST["message"];}
  if (isset($_POST["sexe"])) {$sexe = $_POST["sexe"];}

  $to = "dacruzmsebastien@gmail.com";
  $subject = $_POST['sujet'];
  $message = "Nom: ".$_POST['nom']."\r\n";
  $message .= "Prénom: ".$_POST['prenom']."\r\n";
  $message .= "Pays: ".$_POST['pays']."\r\n";
  $message .= 'E-mail: '.$_POST['email']."\r\n";
  $message .= "Sexe: ".$_POST['sexe']."\r\n";
  $message .= "Message: \r\n\r\n\r\n\r\n" .$_POST['message']."\r\n\r\n--\r\n\r\n";
  $headers = 'From: client@example.com' . "\r\n" .
  'Reply-To: client@example.com' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $message, $headers);
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Contact</title>
</head>
<body>
<header>
<h1>Formulaire de contact</h1>
<h6>Les champs obligatoires sont suivis d'un <strong><abbr title="obligatoire">*</abbr></strong>.</h6>
</header>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <section>
    <fieldset>
    <p class="photo"><img src="hackers-poulette-logo.png" alt="logo hackers poulette" height="300"></p>
    <p><strong>Prénom</strong> <abbr title="obligatoire">*</abbr></strong></p>
    <input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom']; }?>">
    <span class="error"> <?php echo $prenomErr;?></span>

    <p> <strong>Nom</strong> <abbr title="obligatoire">*</abbr></strong></p>
    <input type="text" name="nom" value="<?php if(isset($_POST['nom'])){echo $_POST['nom']; }?>">
    <span class="error"> <?php echo $nomErr;?></span>


    <p><strong>E-mail</strong><abbr title="obligatoire">*</abbr></strong></p>
    <input type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
    <span class="error"><?php echo $emailErr;?></span>

    <p><strong>Pays</strong><abbr title="obligatoire">*</abbr></strong></p>
    <select name="pays">
      <option value="">Sélectionnez un pays</option>
      <option value="Belgique">Belgique </option>
      <option value="Afghanistan">Afghanistan </option>
      <option value="Afrique_Centrale">Afrique_Centrale </option>
      <option value="Afrique_du_sud">Afrique_du_Sud </option>
      <option value="Albanie">Albanie </option>
      <option value="Algerie">Algerie </option>
      <option value="Allemagne">Allemagne </option>
      <option value="Andorre">Andorre </option>
      <option value="Angola">Angola </option>
      <option value="Anguilla">Anguilla </option>
      <option value="Arabie_Saoudite">Arabie_Saoudite </option>
      <option value="Argentine">Argentine </option>
      <option value="Armenie">Armenie </option>
      <option value="Australie">Australie </option>
      <option value="Autriche">Autriche </option>
      <option value="Azerbaidjan">Azerbaidjan </option>
      <option value="Bahamas">Bahamas </option>
      <option value="Bangladesh">Bangladesh </option>
      <option value="Barbade">Barbade </option>
      <option value="Bahrein">Bahrein </option>
      <option value="Belize">Belize </option>
      <option value="Benin">Benin </option>
      <option value="Bermudes">Bermudes </option>
      <option value="Bielorussie">Bielorussie </option>
      <option value="Bolivie">Bolivie </option>
      <option value="Botswana">Botswana </option>
      <option value="Bhoutan">Bhoutan </option>
      <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
      <option value="Bresil">Bresil </option>
      <option value="Brunei">Brunei </option>
      <option value="Bulgarie">Bulgarie </option>
      <option value="Burkina_Faso">Burkina_Faso </option>
      <option value="Burundi">Burundi </option>
      <option value="Caiman">Caiman </option>
      <option value="Cambodge">Cambodge </option>
      <option value="Cameroun">Cameroun </option>
      <option value="Canada">Canada </option>
      <option value="Canaries">Canaries </option>
      <option value="Cap_vert">Cap_Vert </option>
      <option value="Chili">Chili </option>
      <option value="Chine">Chine </option>
      <option value="Chypre">Chypre </option>
      <option value="Colombie">Colombie </option>
      <option value="Comores">Colombie </option>
      <option value="Congo">Congo </option>
      <option value="Congo_democratique">Congo_democratique </option>
      <option value="Cook">Cook </option>
      <option value="Coree_du_Nord">Coree_du_Nord </option>
      <option value="Coree_du_Sud">Coree_du_Sud </option>
      <option value="Costa_Rica">Costa_Rica </option>
      <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
      <option value="Croatie">Croatie </option>
      <option value="Cuba">Cuba </option>
      <option value="Danemark">Danemark </option>
      <option value="Djibouti">Djibouti </option>
      <option value="Dominique">Dominique </option>
      <option value="Egypte">Egypte </option>
      <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
      <option value="Equateur">Equateur </option>
      <option value="Erythree">Erythree </option>
      <option value="Espagne">Espagne </option>
      <option value="Estonie">Estonie </option>
      <option value="Etats_Unis">Etats_Unis </option>
      <option value="Ethiopie">Ethiopie </option>
      <option value="Falkland">Falkland </option>
      <option value="Feroe">Feroe </option>
      <option value="Fidji">Fidji </option>
      <option value="Finlande">Finlande </option>
      <option value="France">France </option>
      <option value="Gabon">Gabon </option>
      <option value="Gambie">Gambie </option>
      <option value="Georgie">Georgie </option>
      <option value="Ghana">Ghana </option>
      <option value="Gibraltar">Gibraltar </option>
      <option value="Grece">Grece </option>
      <option value="Grenade">Grenade </option>
      <option value="Groenland">Groenland </option>
      <option value="Guadeloupe">Guadeloupe </option>
      <option value="Guam">Guam </option>
      <option value="Guatemala">Guatemala</option>
      <option value="Guernesey">Guernesey </option>
      <option value="Guinee">Guinee </option>
      <option value="Guinee_Bissau">Guinee_Bissau </option>
      <option value="Guinee equatoriale">Guinee_Equatoriale </option>
      <option value="Guyana">Guyana </option>
      <option value="Guyane_Francaise ">Guyane_Francaise </option>
      <option value="Haiti">Haiti </option>
      <option value="Hawaii">Hawaii </option>
      <option value="Honduras">Honduras </option>
      <option value="Hong_Kong">Hong_Kong </option>
      <option value="Hongrie">Hongrie </option>
      <option value="Inde">Inde </option>
      <option value="Indonesie">Indonesie </option>
      <option value="Iran">Iran </option>
      <option value="Iraq">Iraq </option>
      <option value="Irlande">Irlande </option>
      <option value="Islande">Islande </option>
      <option value="Israel">Israel </option>
      <option value="Italie">italie </option>
      <option value="Jamaique">Jamaique </option>
      <option value="Jan Mayen">Jan Mayen </option>
      <option value="Japon">Japon </option>
      <option value="Jersey">Jersey </option>
      <option value="Jordanie">Jordanie </option>
      <option value="Kazakhstan">Kazakhstan </option>
      <option value="Kenya">Kenya </option>
      <option value="Kirghizstan">Kirghizistan </option>
      <option value="Kiribati">Kiribati </option>
      <option value="Koweit">Koweit </option>
      <option value="Laos">Laos </option>
      <option value="Lesotho">Lesotho </option>
      <option value="Lettonie">Lettonie </option>
      <option value="Liban">Liban </option>
      <option value="Liberia">Liberia </option>
      <option value="Liechtenstein">Liechtenstein </option>
      <option value="Lituanie">Lituanie </option>
      <option value="Luxembourg">Luxembourg </option>
      <option value="Lybie">Lybie </option>
      <option value="Macao">Macao </option>
      <option value="Macedoine">Macedoine </option>
      <option value="Madagascar">Madagascar </option>
      <option value="Madère">Madère </option>
      <option value="Malaisie">Malaisie </option>
      <option value="Malawi">Malawi </option>
      <option value="Maldives">Maldives </option>
      <option value="Mali">Mali </option>
      <option value="Malte">Malte </option>
      <option value="Man">Man </option>
      <option value="Mariannes du Nord">Mariannes du Nord </option>
      <option value="Maroc">Maroc </option>
      <option value="Marshall">Marshall </option>
      <option value="Martinique">Martinique </option>
      <option value="Maurice">Maurice </option>
      <option value="Mauritanie">Mauritanie </option>
      <option value="Mayotte">Mayotte </option>
      <option value="Mexique">Mexique </option>
      <option value="Micronesie">Micronesie </option>
      <option value="Midway">Midway </option>
      <option value="Moldavie">Moldavie </option>
      <option value="Monaco">Monaco </option>
      <option value="Mongolie">Mongolie </option>
      <option value="Montserrat">Montserrat </option>
      <option value="Mozambique">Mozambique </option>
      <option value="Namibie">Namibie </option>
      <option value="Nauru">Nauru </option>
      <option value="Nepal">Nepal </option>
      <option value="Nicaragua">Nicaragua </option>
      <option value="Niger">Niger </option>
      <option value="Nigeria">Nigeria </option>
      <option value="Niue">Niue </option>
      <option value="Norfolk">Norfolk </option>
      <option value="Norvege">Norvege </option>
      <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
      <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>
      <option value="Oman">Oman </option>
      <option value="Ouganda">Ouganda </option>
      <option value="Ouzbekistan">Ouzbekistan </option>
      <option value="Pakistan">Pakistan </option>
      <option value="Palau">Palau </option>
      <option value="Palestine">Palestine </option>
      <option value="Panama">Panama </option>
      <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
      <option value="Paraguay">Paraguay </option>
      <option value="Pays_Bas">Pays_Bas </option>
      <option value="Perou">Perou </option>
      <option value="Philippines">Philippines </option>
      <option value="Pologne">Pologne </option>
      <option value="Polynesie">Polynesie </option>
      <option value="Porto_Rico">Porto_Rico </option>
      <option value="Portugal">Portugal </option>
      <option value="Qatar">Qatar </option>
      <option value="Republique_Dominicaine">Republique_Dominicaine </option>
      <option value="Republique_Tcheque">Republique_Tcheque </option>
      <option value="Reunion">Reunion </option>
      <option value="Roumanie">Roumanie </option>
      <option value="Royaume_Uni">Royaume_Uni </option>
      <option value="Russie">Russie </option>
      <option value="Rwanda">Rwanda </option>
      <option value="Sahara Occidental">Sahara Occidental </option>
      <option value="Sainte_Lucie">Sainte_Lucie </option>
      <option value="Saint_Marin">Saint_Marin </option>
      <option value="Salomon">Salomon </option>
      <option value="Salvador">Salvador </option>
      <option value="Samoa_Occidentales">Samoa_Occidentales</option>
      <option value="Samoa_Americaine">Samoa_Americaine </option>
      <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
      <option value="Senegal">Senegal </option>
      <option value="Seychelles">Seychelles </option>
      <option value="Sierra Leone">Sierra Leone </option>
      <option value="Singapour">Singapour </option>
      <option value="Slovaquie">Slovaquie </option>
      <option value="Slovenie">Slovenie</option>
      <option value="Somalie">Somalie </option>
      <option value="Soudan">Soudan </option>
      <option value="Sri_Lanka">Sri_Lanka </option>
      <option value="Suede">Suede </option>
      <option value="Suisse">Suisse </option>
      <option value="Surinam">Surinam </option>
      <option value="Swaziland">Swaziland </option>
      <option value="Syrie">Syrie </option>
      <option value="Tadjikistan">Tadjikistan </option>
      <option value="Taiwan">Taiwan </option>
      <option value="Tonga">Tonga </option>
      <option value="Tanzanie">Tanzanie </option>
      <option value="Tchad">Tchad </option>
      <option value="Thailande">Thailande </option>
      <option value="Tibet">Tibet </option>
      <option value="Timor_Oriental">Timor_Oriental </option>
      <option value="Togo">Togo </option>
      <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
      <option value="Tristan da cunha">Tristan de cuncha </option>
      <option value="Tunisie">Tunisie </option>
      <option value="Turkmenistan">Turmenistan </option>
      <option value="Turquie">Turquie </option>
      <option value="Ukraine">Ukraine </option>
      <option value="Uruguay">Uruguay </option>
      <option value="Vanuatu">Vanuatu </option>
      <option value="Vatican">Vatican </option>
      <option value="Venezuela">Venezuela </option>
      <option value="Vierges_Americaines">Vierges_Americaines </option>
      <option value="Vierges_Britanniques">Vierges_Britanniques </option>
      <option value="Vietnam">Vietnam </option>
      <option value="Wake">Wake </option>
      <option value="Wallis et Futuma">Wallis et Futuma </option>
      <option value="Yemen">Yemen </option>
      <option value="Yougoslavie">Yougoslavie </option>
      <option value="Zambie">Zambie </option>
      <option value="Zimbabwe">Zimbabwe </option>
    </select>

    <p><strong>Choisissez une assistance</strong> </p>
    <select name="sujet">
      <option value="0">Clientèle</option>
      <option value="1">Technique</option>
      <option value="2">Autre</option>
    </select>

    <p><strong>Entrez votre message</strong>  <abbr title="obligatoire">*</abbr></strong></p>
    <textarea rows="10" cols="70" name="message"  placeholder="Ecrire votre message ici...">
      <?php if(isset($_POST['message'])){echo htmlentities ($_POST['message']); }?>
    </textarea>
    <span class="error"><?php echo $messageErr; ?></span>

    <p><strong>Genre</strong>  <abbr title="obligatoire">*</abbr></strong></p>
    <input type="radio" value="homme" name="sexe"/>
    Homme
    <input type="radio" value="femme" name="sexe" />
    Femme
    <span class="error"> <?php echo $sexeErr;?></span>

    <label class="hide">Laissez le champ vide</label>
    <input class="hide" type="text" name="phoneNumber6tY4bPYk" autocomplete="off" />
    <br><br>
    <input type="submit" name="submit" value="Envoyer" />

  </fieldset>
</section>





</form>
</body>
</html>
