<?php

require_once 'mysql.php';

$tabela_usuarios = "
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        data_alteracao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

$tabela_filmes = "
    CREATE TABLE IF NOT EXISTS filmes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL UNIQUE,
        ano INT NOT NULL,
        minutos INT NOT NULL,
        resumo TEXT NOT NULL,
        id_usuario INT,
        data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        data_alteracao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT USUARIOS_FILMES_FK FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
    );
";

$pdo->exec($tabela_usuarios);
$pdo->exec($tabela_filmes);

$statement = $pdo->query("SELECT login FROM usuarios WHERE login = 'admin';");

if ($statement->rowCount() === 0) {
    $senha_criptografada = password_hash('1234', PASSWORD_DEFAULT);

    $insert_usuario_admin = "
        INSERT INTO usuarios (login, senha)
        VALUES ('admin', '$senha_criptografada');
    ";

    $pdo->exec($insert_usuario_admin);
}

$statement = $pdo->query("SELECT titulo FROM filmes WHERE titulo = 'Teste';");

if ($statement->rowCount() === 0) {
    $insert_filme_teste = "
        INSERT INTO filmes (titulo, ano, minutos, resumo, id_usuario)
        VALUES ('Teste', 2024, 120, 'Resumo do filme de teste.', 1);
    ";

    $pdo->exec($insert_filme_teste);
}

echo "Script seed executado com sucesso!";

?>