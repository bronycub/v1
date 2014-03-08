<?php
//Check that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 10 Mo
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if (($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") && 
	($_FILES["uploaded_file"]["size"] < 10000000)) {
    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/photos/'.$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
           //echo "It's done! The file has been saved as: ".$newname;
        } else {
           //echo "Erreur: A problem occurred during file upload!";
        }
      } else {
         //echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
      }
  } else {
     //echo "Error: Only .jpg images under 10 Mo are accepted for upload";
  }
} else {
 //echo "Error: No file uploaded";
}

if(isset($_POST['submit'])) {

	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	if(trim($_POST['prenom']) == '') {
		$hasError = true;
	} else {
		$prenom = trim($_POST['prenom']);
	}

	if(trim($_POST['pseudo']) == '') {
		$hasError = true;
	} else {
		$pseudo = trim($_POST['pseudo']);
	}

	if(trim($_POST['email']) == '') {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['phone']) == '') {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}

	if(trim($_POST['naissance']) == '') {
		$hasError = true;
	} else {
		$naissance = trim($_POST['naissance']);
	}

	if(trim($_POST['adresse']) == '') {
		$hasError = true;
	} else {
		$adresse = trim($_POST['adresse']);
	}

	if(trim($_POST['postal']) == '') {
		$hasError = true;
	} else {
		$postal = trim($_POST['postal']);
	}

	if(trim($_POST['ville']) == '') {
		$hasError = true;
	} else {
		$ville = trim($_POST['ville']);
	}

	if(trim($_POST['tags']) == '') {
		$hasError = true;
	} else {
		$tags = trim($_POST['tags']);
	}

	if(trim($_POST['bio']) == '') {
		$hasError = true;
	} else {
		$bio = trim($_POST['bio']);
	}

	if(trim($_POST['pony']) == '') {
		$hasError = true;
	} else {
		$pony = trim($_POST['pony']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'jakmaster.heuzef@gmail.com'; // Put your own email address here
		$body = "
		Photo : $filename \n\n
		Nom : $name $prenom ($pseudo) \n\n
		Email : $email \n\n
		Téléphone : $phone \n\n
		Date de naissance : $naissance \n\n
		Adresse : $adresse $postal $ville \n\n
		Tags : $tags \n\n
		Bio : $bio \n\n
		Pony : $pony \n\n
		";
		$headers = 'From: BronyCUB <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, "[BronyCUB] INSCRIPTION", $body, $headers);
		$emailSent = true;
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="cub, bronycub.org, heuzef, heuzé, florent, brony, bronie, bronies, pegasister, pegasisters, bordeaux, bordeau, bordo, bordau, bordaux, 33000, 33, gironde, cub, communaute, urbaine, collectif, france, aquitaine, gironde, sud-ouest, mlp, fim, my, little, pony, friendship, is, magic, fan, fans, french, vostfr, fr" />
	<meta name="description" content="BronyCUB" />
	<meta name="author" content="Heuzé Florent" />
	<title>BronyCUB</title>
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/zocial.css" />
	<link rel="shortcut icon" type="image/png" href="../logo/favicon_bronycub.png" />
	<script src="../bootstrap/js/jquery-2.0.3.min.js"></script> 
	<script src="../bootstrap/js/bootstrap.js "></script>
	<script>
	$(function (){
		$('a').tooltip();
	});
	$(function (){
		$("#pop").popover({placement:'bottom', trigger:'hover'});
	});
	</script>
	<link rel="stylesheet" type="text/css" href="./bootstrap-fileupload.css">
	<script type="text/javascript" src="./bootstrap-fileupload.js"></script>
</head>

<body>
	<div class="span4">
	<img src="join.png" width="560px"><br /><br />
		<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform" class="form-horizontal well" enctype="multipart/form-data">
		<?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert-error">S'il vous plaît, vérifier que tous les champs sont remplis avec des informations valides et réessayez.<br />
			  <?php echo $erreur; ?></p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert-success">
                <h3>Message bien reçu !</h3>
				<iframe width="220" height="150" src="//www.youtube.com/embed/0A89zUutc24?autoplay=1" frameborder="0" allowfullscreen></iframe>
              </div>
			  <br />
			  <br />
            <?php } ?>

			<div class="fileupload fileupload-new" data-provides="fileupload">
			  <span class="btn btn-file"><span class="fileupload-new">Votre photo au format <strong>JPG</strong></span><span class="fileupload-exists">Changer</span>
			  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" /><input name="uploaded_file" type="file" /></span>
			  <span class="fileupload-preview"></span>
			  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
			</div>
			<br />
            <div class="form-group">
              <input type="text" name="contactname" id="contactname" placeholder="Nom" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="prenom" id="prenom" placeholder="Pr&#233;nom" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="pseudo" id="pseudo" placeholder="Pseudonyme" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
			<div class="form-group">
              <input type="text" name="email" id="email" placeholder="Email" value="" class="form-control required email" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="phone" id="phone" placeholder="T&#233;l&#233;phone" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="naissance" id="naissance" placeholder="Date de naissance" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="adresse" id="adresse" placeholder="Adresse" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="ville" id="ville" placeholder="Ville" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="postal" id="postal" placeholder="Code postal" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
			<div class="form-group">
              <input type="text" name="tags" id="tags" placeholder="Tags (Ex : Passion, site internet, ...)" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br />
            <div class="form-group">
			  <textarea maxlength="500" rows="14" name="bio" id="bio" rows="6" class="form-control required" role="textbox" aria-required="true" placeholder="Ecrivez quelques lignes &#224; propos de vous (500 caract&#232;res max)"></textarea>
            </div>
			<br />
            <div class="form-group">
              <input type="text" name="pony" id="pony" placeholder="Pony pr&#233;f&#233;r&#233;" value="" class="form-control required" role="input" aria-required="true" />
            </div>
			<br /><br />
			<div class="actions">
              <input type="submit" value="Brohoof /)" name="submit" id="submitButton" class="btn btn-success btn-large" title="Envoyer le message" />
            </div>
		</form>
	</div>
</body>
</html>