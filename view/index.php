<?php include('../connection/conn.php') ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>CRUD COM PHP</title>
</head>
<body>
    <?php
    
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo '<h1>Usuários</h1>';
            echo '<table>';
            echo '<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>';
            while($row = $result->fetch_object()){
                echo '<tr>';
                echo "<td>$row->id</td>";
                echo "<td>$row->nome</td>";
                echo "<td>$row->email</td>";
                echo "<td>$row->telefone</td>";
                echo "<td><span onclick='location.href=\"./create-edit-del.php?action=edit&id=$row->id\"'>✏️</span> <span onclick='location.href=\"./create-edit-del.php?action=delete&id=$row->id\"'>🗑️</span></td>";
                echo '</tr>';
            }
            echo '</table>';
        } else{
            echo '<h1>Não há usuários cadastrados no banco de dados</h1>';
        }
        echo '<button id="cad-btn" onclick="location.href=\'./create-edit-del.php?action=create\'">Cadastrar novo usuário</button>';

    ?>
</body>
</html>