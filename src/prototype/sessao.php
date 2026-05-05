<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// DRY -> Dont repeat yourself = nÃO SE REPITA

// PENSAMENTO COMPUTACIONAL
// QUEBRAR PROBLEMAS MAIORES EM MENORES
// ABSTRACAO -> LOGIN CUIDA DO LOGIN. DELETAR CUIDA DO DELETAR. SE TRATA DA LOGICA.

?>