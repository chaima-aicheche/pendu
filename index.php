<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    include('header.php');
    ?>
    <main>  
        <div class="global">

            <?php 
            session_start();
            $fichier = file("mots.txt");
            $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            require('Pendu.php');
            $pendu = new Pendu;
            $pendu->choixMot($fichier);
            $prevmot = strtoupper($_SESSION['mot']);
            $mot = $pendu->retirerAccents($prevmot);
            
            $_SESSION['false'] = 0; 
            $_SESSION['true'] = 0;

            if(!isset($_SESSION['victoires'])){
                $_SESSION['victoires'] = 0;
            }

            if(!empty($_GET) && $_GET['etat']=='jouer')
            {    
                if (isset($_POST["lettre"])) {
                $pendu->stockagedesLettres();
                }
                
                if(!empty($_SESSION['played'])){
                    $pendu->mauvaisesLettres($mot);
                }
                echo "<div class='glob'>";
                    echo '<form class="form" method="post">';
                        $pendu->affichageInput($alphabet);
                    echo '</form>';
                    echo "<div class='droite'>";
                        echo "<div class='tirets'>";
                            $pendu->affichageLettres($mot);
                        echo "</div>";
                        echo "<div class='dessin'>";
                            $false = $_SESSION['false']; 
                            if($false !=0){
                                echo "<img src='./assets/Le-Pendu ($false).png'>";
                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                if($_SESSION['true']== strlen($mot)){
                    header("location:./index.php?etat=gagne");
                }
                if($_SESSION['false'] >= 8 ){
                    header("location:./index.php?etat=perdu");
                }
                
                echo "<p class='victoires'> nombre de victoires : $_SESSION[victoires]</p>";
                echo "<a class='recommencer' href='./Recommencer.php'>Nouveau Mot</a>";
            }
            elseif(!empty($_GET) && $_GET['etat']=='perdu'){
                $pendu->partiePerdue($mot);
            }

            elseif(!empty($_GET) && $_GET['etat']=='gagne'){
                $pendu->partieGagne($mot);
            }

            else{
                $pendu->Accueil();
            }
            ?>
        </div>
    </main>
</body>
</html>