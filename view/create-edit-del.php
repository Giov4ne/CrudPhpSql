<?php include('../connection/conn.php') ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/script.js" defer></script>
    <title>CRUD COM PHP</title>
</head>
<body>
    <div id="center-form">
        <?php
        
            switch($_REQUEST['action']){
                case 'create':
        ?>

        <form method="post">
            <h2 id="form-title">Novo usuário</h2>
            <label>Nome</label>
            <input class="inputs" type="text" name="nome" required>
            <label>Email</label>
            <input class="inputs" type="email" name="email" required>
            <label>Telefone</label>
            <input class="inputs" type="text" name="telefone" minlength="14" maxlength="15" required>
            <input id="submit-btn" type="submit" value="Cadastrar">
        </form>

        <?php
                    if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])){
                        $sql = "INSERT INTO user(nome, email, telefone) values('$_POST[nome]', '$_POST[email]', '$_POST[telefone]')";
                        $result = $conn->query($sql);
                        if($result){
                            echo '<script>
                                        alert("Usuário cadastrado com sucesso!");
                                        location.href="./index.php";
                                  </script>';
                        } else{
                            echo '<script>alert("Falha ao criar usuário")</script>';
                        }
                    }
                    break;
                case 'edit':
                    $sql = "SELECT * FROM user WHERE id = '$_GET[id]'";
                    $result = $conn->query($sql);
                    $user = $result->fetch_object();
        ?>

        <form method="post">
            <h2 id="form-title">Editar usuário</h2>
            <label>ID</label>
            <input class="inputs" type="number" value="<?=$user->id?>" disabled>
            <label>Nome</label>
            <input class="inputs" type="text" name="nome" value="<?=$user->nome?>" required>
            <label>Email</label>
            <input class="inputs" type="email" name="email" value="<?=$user->email?>" required>
            <label>Telefone</label>
            <input class="inputs" type="text" name="telefone" value="<?=$user->telefone?>" minlength="14" maxlength="15" required>
            <input id="submit-btn" type="submit" value="Editar">
        </form>           

        <?php
                    if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])){
                        $sql = "UPDATE user SET nome = '$_POST[nome]', email = '$_POST[email]', telefone = '$_POST[telefone]' WHERE id = '$user->id'";
                        $result = $conn->query($sql);
                        if($result){
                            echo "<script>
                                        alert('Usuário $user->id editado com sucesso!');
                                        location.href='./index.php';
                                  </script>";
                        } else{
                            echo '<script>alert("Falha ao editar usuário")</script>';
                        }
                    }
                    break;
                case 'delete':
                    $sql = "SELECT * FROM user WHERE id = '$_GET[id]'";
                    $result = $conn->query($sql);
                    $user = $result->fetch_object();
                    echo "<div id='confirm-box'>
                            <h2>Tem certeza que deseja excluir " . strtok($user->nome, ' ') . "?</h2>
                            <button id='yes-btn' onclick='location.href=\"./create-edit-del.php?confirm=yes&id=$user->id\"'>Sim</button>
                            <button id='no-btn' onclick='location.href=\"./index.php\"'>Cancelar</button>
                          </div>";
                    break;
            }

            if(!empty($_GET['confirm'])){
                if($_GET['confirm'] === 'yes'){
                    $sql = "DELETE FROM user WHERE id = '$_GET[id]'";
                    if($conn->query($sql)){
                        echo '<script>
                                alert("Usuário deletado com sucesso!");
                                location.href="./index.php";
                              </script>';
                    } else{
                        echo '<script>
                                alert("Falha ao deletar usuário");
                                location.href="./index.php";
                              </script>';
                    }
                }
            }

        ?>
    </div>
</body>
</html>