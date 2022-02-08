<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <main>
    
        <form method="post">
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg" id="Ajoutmot" type="text" placeholder="mot à ajouter" >Mot à ajouter</span>
            <input type="text" name="mot" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>   
        </form>
        <div class="mots">
        <ul class="list-group">
            <?php
            $lines = file("mots.txt");
            foreach($lines as $word){
                echo "<a href='admin.php?suppr=".$word."' class='list-group-item list-group-item-action list-group-item-dark'>".$word."</a></br>";
            }
            if(isset($_POST['mot'])){
                if(ctype_alpha($_POST['mot'])){
                    $txt = $_POST['mot'];
                    $myfile = file_put_contents('mots.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
                    header("location:admin.php");
                }
                else{
                    echo "le mot ne contient que des lettres (A-Z)";
                }
            }

            if(isset($_GET['suppr'])){
                $chercher = $_GET['suppr'];
                foreach($lines as $word){
                    if(strstr($word,$chercher)){
                        $a = 'mots.txt';
                        $replacement = '';

                        file_put_contents($a, str_replace($word, $replacement, file_get_contents($a)));
                        header("location:admin.php");
                    }
                    else{echo 'LE MOT EXISTE PAS'.'</br>';}
                }
            }
            ?>
        </ul>
        </div>
    </main>
</body>
</html>