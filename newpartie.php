<?php
session_start();
session_destroy();

header('Location: ./index.php?etat=jouer');
?>
© 2022 GitHub.