<?php

class Pendu{

    public $played;

    public function retirerAccents($mot)
	{
			$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
			$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

			$newmot = str_replace($search, $replace, $mot);
			return strtoupper($newmot); 
	}

    public function partiePerdue($mot)
    {
        echo "<div class='msg'> Perdu ... Le mot était <br><span class='mot'> $mot </span> </div><a class='recommencer' href='./rejouer.php'>Rejouer</a>";
        echo "<img src='./img/Pendu8.JPG'>";
        exit();
    }

    public function partieGagner($mot)
    {
        echo "<div class='msg'> Gagné ... le mot était bien <br> $mot </div><a class='rejouer' href='./rejouer.php'>Nouveau Mot</a>";
        $_SESSION['victoire']++;
        echo "$_SESSION[victoire]";
        exit();
    }

    public function choisirMot($fichier)
    {
        if(!isset($_SESSION['mot'])){
            $_SESSION['mot'] = rtrim($fichier[array_rand($fichier)]);
        }
    }

    public function stockageLettres()
    {
        $pletter = $_POST["lettre"];
        $_SESSION['played'][]=$pletter;
    }

    public function mauvaisesLettres($mot)
    {
        $played = $_SESSION['played'];
        $this->played = $played;
                
            for($k=0; isset($played[$k]); $k++){
                if(!in_array($played[$k], str_split($mot))){
                    $_SESSION['false']++;
                }
            }
    }

    public function affichageInput($alphabet)
    {
        for($i=0; isset($alphabet[$i]); $i++ )
            {

                if(!empty($this->played) && in_array($alphabet[$i], $this->played ))
                {
                    echo "";
                }
                else
                {
                    echo '<input type="submit" name="'."lettre".'" value="'.$alphabet[$i].'">';
                }
            }
    }

    public function affichageLettres($mot)
    {
        for ($j=0; isset($mot[$j]); $j++) {
            if(!empty($this->played) && in_array($mot[$j], $this->played)){
                $_SESSION['true']++;
                echo "$mot[$j]";
            }
            else{
                echo "<span class='tiret'>_ </span>";
            }      
        }
    }

    public function Accueil(){
        if(!empty($_SESSION['victoire'])){
            echo "<p class='bienvenue'> Bienvenue sur le jeu du Pendu Faites une partie :</p>";

            echo "<img src='./img/fond.jpg'>";
            echo "<a class='continuer' href='./index.php?etat=jouer'>Continuer</a>";  
            echo "<a class='nouvelleP' href='./newpartie.php'>Nouvelle partie</a>";  
        }
        else{
            echo "<p class='bienvenue'> Bienvenue! Faites une partie :</p>";
            echo "<img class='fond' src='./img/fond.jpg'>";
            echo "<a class='nouvelleP' href='./newpartie.php'>Nouvelle partie</a>";  
        }
    }


}