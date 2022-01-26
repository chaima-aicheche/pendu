<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">l
</head>
<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <main>
        <form method="post">
            <input name="mot" id="Ajoutmot" type="text" placeholder="mot à ajouter" />
        </form>
        <div class="mots">
            <?php
            $lines = file("mots.txt");
            foreach($lines as $word){
                echo $word ."<br>";
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
            ?>
        </div>
    </main>
</body>
</html>