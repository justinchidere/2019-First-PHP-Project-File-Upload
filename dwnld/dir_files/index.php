<?php

session_start();

if(isset($_SESSION['title'])) {
    session_unset();
    session_destroy();
}

include('tmp.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../cloud_icon.png">
    <title>just4uploads</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  </head>
  <body style="background-color: grey;">
  <section class="section">
      
    <div class="container">
        
        <div class="hero is-dark">
                
                <div class="hero-head">
                    
                </div>
                
                
                <div class="hero-body has-text-centered">
                
                    <img src="../../cloud_logo.png" height="128px" width="128px" class="is-horizontal-centered">
                        
                    <h1 class="title">just4uploads</h1>
                    <p class="subtitle">Private File Sharing System</p>
            
                </div>
                
            
        </div>
        
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="column">
        <div class="column">
        
            <div class="box is-one-quarter has-text-centered">
                
                <h2 class="title has-text-centered">Herunterladen</h2><br/>
                
                <p class="subtitle has-text-grey"><?php echo $_SESSION['file']; ?> (Größe: <?php echo filesize($_SESSION['file']) . " Byte"; ?>)</p>
                <i class="fas fa-file-download fa-10x is-horizontal-center"></i>
                
                <br/><br/>
                
                <a href="<?php echo $_SESSION['file'] ?>" download><button class="button is-primary">Download</button></a>
            
            </div>
            
        </div>
            
        </div>
        
    </div>
      
  </section>
      
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
              <br/>
        <br/>
        <br/>
        <br/>
              <br/>
        <br/>
        <br/>
        <br/>
        <br/>
      <footer>
      
          <nav>
          
              <ul style="float: right;">
              
                  <a href="../../impressum.html"><li>Impressum</li></a>
                  <a href="../../datenschutz.html"><li>Datenschutz</li></a>
                  
              </ul>
              
          </nav>
          
      </footer>
  </body>
</html>