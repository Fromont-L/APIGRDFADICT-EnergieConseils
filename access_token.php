<?php

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['token_button']))
    {
        // Si le bouton est activé, stocke l'access_token
        $appeltoken = get_token();
    } else {
      // Sinon retourne "rien"
      $appeltoken = "";
    }

    function get_token()
  {
    // Exécute le code java accesstoken.jar
    exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar accesstoken.jar 2>&1", $output);
    // Retourne la valeur de access_token
    return ((array)json_decode(utf8_encode($output[0])))['access_token'];
    // Retourne la liste de l'appel
    // return var_dump($output[0]);
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="API GRDF"/>
  <meta name="author" content="Lucas Fromont, Aymeric Herchuelz"/>
  <link rel="icon" type="image/png" href="assets/image/API_GRDF_logo.jpg"/>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <title>API GRDF - Access Token</title>

</head>

<body>
    <form action="access_token.php" method="post">
      <!--Le name="token_button" est utilisé dans le if du début de ce code-->
      <input type="submit" id="envoyer" name="token_button" value="Go Token GOOOOO !!!">
    </form>
    <p>
      <?php
      // Affiche le token lors du clic sur le bouton
        print_r($appeltoken);

      ?>
    </p>

    <script src="assets/javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</body>

</html>