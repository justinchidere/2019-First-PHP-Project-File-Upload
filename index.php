<?php

session_start();
//deactivate warnings 
error_reporting(0);

if($_SESSION['logged'] != true) {
    readfile("loginForm.html");
    //echo("<div style='padding-top:10%' class='columns is-centered'><h3 style='color:white;'>Passwort: </h3><form id='form' method='post' action='index.php'><input type='password' name='pw'><input type='submit' class='button is-warning' name='submitl'></form></div>");
    
}

date_default_timezone_set('Europe/Berlin');
$date = date('d/M/y h:i');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$_SESSION['title_value'] = "Upload";

//Fix: Make dwnld folder inaccessible
chmod("dwnld", 0701);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="cloud_icon.png">
    <title>just4uploads</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-color: grey;">
  <section class="section" id="sect" style="visibility: hidden;">
      
    <div class="container">
        
        <div class="hero is-dark">
                
                <div class="hero-head">
                    
                </div>
                
                
                <div class="hero-body has-text-centered">
                
                    <img src="cloud_logo.png" height="128px" width="128px" class="is-horizontal-centered">
                        
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
        
            <div class="box is-one-quarter">
                
                <h2 class="title has-text-centered">Hochladen</h2>
                
                <form class="has-text-centered" id="upload_form" method="post" action="index.php" enctype="multipart/form-data">
        
                    <input type="file" name="uploadFile" value="Auswählen" required>
                    <input type="text" name="title" placeholder="Notiz (optional)" class="has-text-centered"><br/><br/>
                    <input type="submit" name="submit" class="button is-primary">
                    
                    
                    <?php

                    if(isset($_POST['submit'])) {
                         if($_SESSION['logged'] == true) {
                        $target_dir = "dwnld/" . generateRandomString() . "/";
                        $target_file = $target_dir . basename($_FILES['uploadFile']['tmp_name']);
                        
                        // Get File Extention
                        $path = $_FILES['uploadFile']['name'];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        //Security Fix: rename uploaded php scripts to .dphp
                        if($ext == "php") {
                            $ext = "dphp";
                        }

                        $name = pathinfo($path, PATHINFO_FILENAME);
                        
                        
                        // Create Target Directory
                        mkdir($target_dir);
                        
                            //Move Data to Target Directory
                            if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_dir . $name . "." .$ext)) {
                                //Security Fix: Make file inaccessible
                                chmod($target_dir . $name . "." .$ext, 0604);
                                
                                echo("\n<p style='color:green'>Die Datei wurde erfolgreich hochgeladen: </p><a href='" . $target_dir . "'>[Klicke hier]</a>");
                                copy('dwnld/dir_files/index.php', $target_dir . 'index.php');
                                
                                $write_to = fopen($target_dir . "tmp.php", "a");
                                fwrite($write_to, "<?php \$_SESSION['file'] = '" . $name . "." . $ext . "'; ?>");
                                fclose($write_to);
                                
                                $protocol = fopen("logdata.php", "a");
                                fwrite($protocol, '<p>[' .$date. '] ' .$_POST['title']. ' (Größe: ' .filesize($target_dir. $name . '.' . $ext).  ' Bytes) <a href="' .$target_dir . $name . '.' . $ext. '">Link</a></p>' .$_POST['msg']. '<br/>');
                                fclose($protocol);
                                //Security Fix: Make file inaccessible
                                chmod('logdata.php', 0000);
                                
                            } else {
                                
                                echo "\n<p style='color:red'>Während des Uploads sind Fehler aufgetreten.</p>";
                                
                            }
                    } else {
                             echo "Nicht eingeloggt.";
                         }
                    }
                        
                    
                    ?>
                </form>
            
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
          
              <ul class="has-text-centered" style="margin-left: 43.5%;">
                  
                  <a href="index.php"><li style="float: left; margin-right:20px;">Startseite</li></a>
                  <a href="impressum.html"><li style="float: left; margin-right:20px;">Impressum</li></a>
                  <a href="datenschutz.html"><li style="float: left; margin-right:20px;">Datenschutz</li></a>
                  
              </ul>
              
          </nav>
          
      </footer>
  </body>
</html>

<?php

if($_SESSION['logged'] == true) {
     echo("<script>document.getElementById('form').style.visibility = 'hidden';</script>");
     echo("<script>document.getElementById('sect').style.visibility = 'visible';</script>");
}

if(isset($_POST['submitl'])) {
    if(trim($_POST['pw']) == '325GDRD&3SSSG') {

        echo("<script>document.getElementById('form').style.visibility = 'hidden';</script>");
        echo("<script>document.getElementById('sect').style.visibility = 'visible';</script>");
        //echo("<h3 style='color:white;padding-top:10%;'>Passwort: </h3><form id='form' method='post' action='index.php'><input type='password' name='pw'><input type='submit' class='button is-warning' name='submitl'></form>");
        echo("<script>document.getElementsByTagName('div)[0].innerHTML = ''</script>");
        $_SESSION['logged'] = true;
        
    } else {
        die();
    }
    
}
?>