<?php
require_once 'init.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>4Health</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="image/icone.PNG">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem vindo!</h2>
                <p class="description description-primary">Para se manter conectado conosco</p>
                <p class="description description-primary">Faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">login</button>
            </div>    
            <div class="second-column">
                <h2 class="title title-second">Crie sua conta</h2>
                <p class="description description-second">Preencha os dados para completar o registro:</p>
                <form class="form" action="cadastro.php" method="POST">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="number" placeholder="CPF" name="cpf" id="cpf">
                    </label>
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input placeholder="nome" type="text" name="name" id="name">
                    </label>
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email" name="email" id="email">
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha" id="senha">
                    </label> 
                    <input type="submit" value="Cadastrar" class="btn btn-outline-success" style="background: #16a085;">      
                </form>
            </div><!-- second column -->
        </div><!-- first content -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá!</h2>
                <p class="description description-primary">Coloque suas informações pessoais</p>
                <p class="description description-primary">para realizar seu cadastro</p>
                <button id="signup" class="btn btn-primary">Cadastro</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Faça seu login</h2>
                <p class="description description-second">use sua conta do email ou seu nome:</p>
                <form class="form" method="post" action="login.php">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input placeholder="nome" type="text" name="name2" id="name2">
                    </label>
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email" name="email2" id="email2">
                    </label>
                
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha2" id="senha2">
                    </label>
                
                    <!--a class="password" href="#">Esqueceu sua senha?</a-->
                    <input type="submit" value="Login" class="btn btn-outline-success" style="background: #16a085;">  
                </form>
            </div><!-- second column -->
        </div><!-- second-content -->
    </div>
    <script src="https://unpkg.com/blip-chat-widget" type="text/javascript">
    <script src="https://unpkg.com/blip-chat-widget" type="text/javascript">
    </script>
    <script>
        (function () {
            window.onload = function () {
                new BlipChat()
                .withAppKey('Y2hhdGJvdDRoZWFsdGg6YjQzZWRjNGUtNDJjZi00MTA2LTg5YmUtZWU4MTUyOTkzMTRj')
                .withButton({"color":"#16a085","icon":""})
                .withCustomCommonUrl('https://murilo-ramalho-7ginm.chat.blip.ai/')
                .build();
            }
        })();
    </script>
                                
                                
    <script src="js/login.js"></script>
</body>
</html>