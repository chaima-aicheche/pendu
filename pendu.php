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
        echo "<div class='msg' style='color:blue'> Perdu ... Le mot était <br><span class='mot'> $mot </span> </div><div class='d-grid gap-2 col-6 mx-auto'>
        <a href='./rejouer.php'> <button class='btn btn-dark' type='button'>Rejouer</button></a>
        </div>";
        echo "<img src='./img/Pendu8.JPG'>";
        exit();
    }

    public function partieGagner($mot)
    {
        echo "<div class='msg' style='color:blue'> Gagné ... le mot était bien <br> $mot </div><div class='d-grid gap-2 col-6 mx-auto'>
        <a href='./rejouer.php'> <button class='btn btn-dark' type='button'>Nouveau mot</button></a>
        </div>";
        echo "<img src='./img/GG.JPG' style='width:70%'>";
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
                echo "<span class='tiret' style='color:blue'>".$mot[$j]."</span>";
            }
            else{
                echo "<span class='tiret' style='color:blue'>_ </span>";
            }      
        }
    }

    public function Accueil(){
        if(!empty($_SESSION['victoire'])){;  
            echo "<div class='d-grid gap-2 col-6 mx-auto'style='z-index:99;'>
                    <a href='./index.php?etat=jouer'><button class='btn btn-primary' type='button'>Continuez</button></a>
                  </div>";
        }
        else{
            echo "<div class='d-grid gap-2 col-6 mx-auto' style='z-index:99;'>
                    <a href='./newpartie.php'> <button class='btn btn-primary' type='button'>Lancer une partie</button></a>
                 </div>";
        }
    }


}