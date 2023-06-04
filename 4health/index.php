<?php
require_once 'init.php';
$PDO = db_connect();

session_start();
if((!isset($_SESSION['email']) == true ) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['name']))) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['name']);
    header('Location: entrada.php');
}
$logado = $_SESSION['name'];

$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
$data = date('Y-m-d');
$dia = date('d-m');
$diasemana_numero = date('w', strtotime($data));


//cpf paciente
$nome = $_SESSION['name'];
$email = $_SESSION['email'];

$sql_paciente = "SELECT * from paciente where nome= :nome and email= :email";
$stmt_paciente = $PDO->prepare($sql_paciente);
$stmt_paciente->bindParam(':nome', $nome);
$stmt_paciente->bindParam(':email', $email);
$stmt_paciente->execute();
$paciente = $stmt_paciente->fetch(PDO::FETCH_ASSOC);
$cpf = $paciente['cpf'];

//agendamento
$sql_consulta_count = "SELECT COUNT(*) AS total from consulta where cpf_paciente = :cpf";
$stmt_consulta_count = $PDO->prepare($sql_consulta_count);
$stmt_consulta_count->bindParam(':cpf', $cpf);
$stmt_consulta_count->execute();
$total_consulta = $stmt_consulta_count->fetchColumn();

$sql_consulta = "SELECT data, hora from consulta where cpf_paciente = :cpf";
$stmt_consulta = $PDO->prepare($sql_consulta);
$stmt_consulta->bindParam(':cpf', $cpf);
$stmt_consulta->execute();
$consulta = $stmt_consulta->fetchColumn();

//faq
$sql_faq_count = "SELECT COUNT(*) AS total FROM faq ORDER BY nome ASC";
$sql_faq = "SELECT nome, ct FROM faq ORDER BY nome ASC";

$stmt_faq_count = $PDO->prepare($sql_faq_count);
$stmt_faq_count->execute();
$total_faq = $stmt_faq_count->fetchColumn();

$stmt_faq = $PDO->prepare($sql_faq);
$stmt_faq->execute();

//medico manhã
$sql_medico_manha_count = "SELECT COUNT(*) AS total FROM medico where horario = '9:00:00'";
$sql_medico_manha = "SELECT crm, nome, especialidade FROM medico where horario = '9:00:00'";

$stmt_medico_manha_count = $PDO->prepare($sql_medico_manha_count);
$stmt_medico_manha_count->execute();
$total_medico_manha = $stmt_medico_manha_count->fetchColumn();

$stmt_medico_manha = $PDO->prepare($sql_medico_manha);
$stmt_medico_manha->execute();
 
//medico tarde
$sql_medico_tarde_count = "SELECT COUNT(*) AS total FROM medico where horario = '13:00:00'";
$sql_medico_tarde = "SELECT crm, nome, especialidade FROM medico where horario = '13:00:00'";

$stmt_medico_tarde_count = $PDO->prepare($sql_medico_tarde_count);
$stmt_medico_tarde_count->execute();
$total_medico_tarde = $stmt_medico_tarde_count->fetchColumn();

$stmt_medico_tarde = $PDO->prepare($sql_medico_tarde);
$stmt_medico_tarde->execute();

//remedio
$sql_remedio_count = "SELECT COUNT(*) AS total FROM medicamentos ORDER BY nome ASC";
$sql_remedio = "SELECT nome,tipo,dosagem,aplicacao,finalidade, quantidade FROM medicamentos";

$stmt_remedio_count = $PDO->prepare($sql_remedio_count);
$stmt_remedio_count->execute();
$total_remedio = $stmt_remedio_count->fetchColumn();

$stmt_remedio = $PDO->prepare($sql_remedio);
$stmt_remedio->execute();

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4Health</title>
    <!--LINKS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="image/icone.PNG">

</head>

<body>
    <header class="header">
        <!--NAVBAR PARA LOCALIZAÇÃO-->
        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> 4Health </a>
        <nav class="navbar">
            <!--SERVIÇOS-->
            <a href="#home">início</a>
            <a href="#services">Serviços</a>
            <a href="#about">Agendamentos</a>
            <a href="#drugs">Medicamentos</a>
            <a href="#review">review</a>
            <!--CONTA DO USUARIO-->
            <div class="dropdown dropstart"  style="margin-left: 10px">
                <button type="button" class="m-0 btn" data-bs-toggle="dropdown"><h1>perfil</h1></button>
                <ul class="dropdown-menu m-5" style="margin: 10px">
                    <div class="card" style="width:400px; font-size: 20px;">
                        <div style="border: 1px solid black;">
                            <img class="card-img-top" src="image/perfil.PNG" alt="Card image" style="width:30%">
                            <?php
                                echo "<h1> Bem vindo <u>$logado</u></h1>";
                            ?>
                        </div>
                        <div class="card-body">
                            <h2 class="card-text">Você está logado</h2> 
                            <div>
                                <?php if($total_consulta > 0): ?>
                                    <table class="table table-hover">
                                        <h3>CONSULTAS MARCADAS</h3>
                                        <thead>
                                            <th>DATA</th>
                                            <th>HORA</th>
                                        </thead>
                                        <tbody>
                                            <?php while ($consulta = $stmt_consulta->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <td><?=$consulta['data']; ?></td>
                                                <td><?=$consulta['hora']; ?></td>
                                            </tr>
                                            <?php endwhile; ?> 
                                        </tbody>  
                                    </table>
                                <?php endif; ?>
                            </div>
                            <a href="sair.php" class="btn m-3">Sair</a>
                            <a href="excluir.php" class="btn m-3" onclick="return confirm('Tem certeza de que deseja Excluir a cua conta?');">Excluir</a>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </header>

    <!--PRIMEIRA IMPRESSÃO-->
    <section class="home" id="home">
        <div class="image">
            <img src="image/home-img.svg" alt="">
        </div>
        <div class="content">
            <?php
                echo "<h3>4health, Bem vindo(a) $logado</h3>"
            ?>
            <p>Um site destinado ao facil acesso publico de auxilio medico. </p>
            <a href="#services" class="btn"> Contate-Nos <span class="fas fa-chevron-right"></span> </a>
        </div>
    </section>

    <section class="icons-container"></section>

    <!--TODAS AS SESSÕES-->
    <section class="services" id="services">
        <h1 class="heading"> Nossos <span>Serviços</span> </h1>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-notes-medical"></i>
                <h3>Agendamentos <br> de Consultas</h3>
                <p>aqui você pode agendar consultas medicas de forma simples, fácil e pratica.</p>
                <a href="#about" class="buttonvermais"> Ler mais <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-ambulance"></i>
                <h3>Assistência <br>Médica<br></h3>
                <p>Aqui você pode entrará em contato com nossa equipe desuporte, poderá pedir por ajuda,tirar um duvida.</p>
                <a href="#book" class="buttonvermais"> Ler mais <span class="fas fa-chevron-right"></span> </a>
            </div>
            <!--div class="box">
                <i class="fas fa-user-md"></i>
                <h3>Doutores <br> disponiveis </h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
                <a href="#" class="buttonvermais"> Ler mais <span class="fas fa-chevron-right"></span> </a>
            </div-->
            <div class="box">
                <i class="fas fa-pills"></i>
                <h3>Medicamentos <br> disponiveis</h3>
                <p>Aqui você verá todos os medicamentos dipoiveis e sua quantidade, além de entender como ele funciona.</p>
                <a href="#drugs" class="buttonvermais"> Ler mais <span class="fas fa-chevron-right"></span> </a>
            </div>
        </div>
    </section>

    <!--AGENDAMENTO-->
    <section class="about" id="about">
        <h1 class="heading"> <span>Consultas</span> </h1>
        <div class="row">
            <div class="image">
                <img src="image/about-img.svg" alt="">
            </div>
            <div class="content">
                <h3>Agendamentos</h3>
                <?php
                    echo "<h2>Hoje: $dia  <u>$diasemana[$diasemana_numero]-feira</u></h2>";
                ?>
                <?php if ($total_medico_manha > 0 || $total_medico_tarde > 0): ?>
                    <h2>Manhã:</h2>
                    <form action="consulta.php" method="POST">
                        <?php while ($medico_manha = $stmt_medico_manha->fetch(PDO::FETCH_ASSOC)): ?>
                            <input type="radio" id="medico1" name="medico1" value="<?=$medico_manha['crm']?>" checked>
                            <label for="medico1"><h4><?=$medico_manha['nome']?>, <?=$medico_manha['especialidade']?></h4></label><br>
                        <?php endwhile; ?>
                    <h2>tarde:</h2>
                    <form action="consulta.php" method="POST">
                        <?php while ($medico_tarde = $stmt_medico_tarde->fetch(PDO::FETCH_ASSOC)): ?>
                            <input type="radio" id="medico1" name="medico1" value="<?=$medico_tarde['crm']?>">
                            <label for="medico1"><h4><?=$medico_tarde['nome']?>, <?=$medico_tarde['especialidade']?></h4></label><br>
                        <?php endwhile; ?>
                        <input type="submit" value="enviar" class="btn">
                    </form>
                <?php else: ?>
                <p>Nenhum medico registrado</p>
                <?php endif; ?>
            </div>
        </div>
    </section> 

    <!--REMEDIOS-->
    <section class="drugs" id="drugs">
        <br><br>
        <h1 class="heading"> <span>Medicamentos</span> </h1>
        <div class="tabela-preco">
            <div class="card-preco">
                <h3 class="card-preco-header">Dipirona sódica</h3>
                <div class="imagemed">
                    <img src=image/dipirona.png alt="Dipirona Sódica">
                </div>
                <button class="btn">Disponível</button>
            </div>
            <div class="card-preco">
                <h3 class="card-preco-header">Cloridrato de Fluoxetina</h3>
                <div class="imagemed">
                    <img src=image/cloridrato_fluoxetina.png alt="Cloridato de Fluoxetina">
                </div>
                <button class="btn">Disponível</button>
            </div>
            <div class="card-preco">
                <h3 class="card-preco-header">Codeina</h3>
                <div class="imagemed">
                    <img src=image/codein.png alt="Codeina">
                </div>
                <button class="btn_soldOff">Indisponível</button>
            </div>
            <div class="Ver-mais">
            </div>
        </div>

        <!--VER TODOS OS MEDICAMENTOS DISPONIVEIS-->
        <div class="card border-light ms-3 me-3">
            <div class="row">
                <div class="col-5">&nbsp;</div>
                    <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"
                        data-bs-whatever="Consultório">Ver mais</button>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <h2 class="heading"><span>Medicamentos</span> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></h2>
                                    <?php if ($total_remedio > 0): ?>
                                        <div>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><h2>NOME</h2></th>
                                                        <th><h2>TIPO</h2></th>
                                                        <th><h2>DOSAGEM</h2></th>
                                                        <th><h2>APLICAÇÃO</h2></th>
                                                        <th><h2>FINALIDADE</h2></th>
                                                        <th><h2>QUANTIDADE</h2></th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($medicamento = $stmt_remedio->fetch(PDO::FETCH_ASSOC)):?>
                                                        <tr>
                                                            <td><h3><?=$medicamento['nome'];?></h3></td>
                                                            <td><h3><?=$medicamento['tipo'];?></h3></td>
                                                            <td><h3><?=$medicamento['dosagem'];?></h3></td>
                                                            <td><h3><?=$medicamento['aplicacao'];?></h3></td>
                                                            <td><h3><?=$medicamento['finalidade'];?></h3></td>
                                                            <td><h3><?=$medicamento['quantidade'];?></h3></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                    <p>Nenhum medicamento encontrado</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
                <h3 style="text-align:center" class="m-5 fas fa-map-marker-alt"> medicamentos disponiveis no pronto de socorro Av. Angelo Zanco, Estiva Gerbi - SP</h3>
            </div>
            <div class="col-5">&nbsp;</div>
        </div>
    </session>
        <span>
            <!--EXPERIENCIA DO USUARIO-->
            <section class="book" id="book">
                <br><br>
                <h1 class="heading"> <span>peça ajuda Ou conte sua experiencia</span></h1>
                <div class="row">
                    <div style="width:47%">
                        <img src="image/book-img.svg" alt="">
                    </div>
                    <form action="faq.php" method="POST">
                        <h3>faça uma reclamação ou sugestão</h3>
                        <textarea name="faq" id="faq" rows="10" class="box" placeholder="Digite aqui!"></textarea>
                        <input type="submit" value="Enviar" class="btn m-1">
                    </form>
                </div>
            </section>

            <!--REVIEW-->
            <section class="review" id="review">
                <br><br>
                <h1 class="heading"> clientes <span>review</span> </h1>
                <div class="box-container">
                    <div class="box">
                        <img src="image/pic-1.jpg" alt="">
                        <h3>Marcos Roberto</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text">falta referencia! cade a fonte? terminaram a parte 4? </p>
                    </div>
                    <div class="box">
                        <img src="image/pic-2.jpg" alt="">
                        <h3>Leandro Luiz</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text">merecem um mb parabens!</p>
                    </div>
                    <div class="box">
                        <img src="image/pic-3 (2).jpg" alt="">
                        <h3>Sinzomar Melo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text">Agora to casado! fui fazer filho semana passada</p>
                    </div>
                    <?php if($total_faq > 0): ?>
                        <?php while ($faq = $stmt_faq->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="box">
                                <img src="image/perfil.PNG">
                                <h3><?=$faq['nome'] ?></h3>
                                <p class="text"><?=$faq['ct'] ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>

            <section class="footer">
                <br><br> <!--MAIS SOBRE-->
                <div class="box-container">
                    <div class="box">
                        <h3>Busca</h3>
                        <a href="#home"> <i class="fas fa-chevron-right"></i> Inicio </a>
                        <a href="#services"> <i class="fas fa-chevron-right"></i> Serviços </a>
                        <a href="#about"> <i class="fas fa-chevron-right"></i> Agendamentos </a>
                        <a href="#drugs"> <i class="fas fa-chevron-right"></i> Medicamentos </a>
                        <a href="#review"> <i class="fas fa-chevron-right"></i> Review </a>
                    </div> 
                    <div class="box">
                        <h3>Outros serviços</h3>
                        <a href="#review"> <i class="fas fa-chevron-right"></i> Vacinação </a>
                        <a href="#review"> <i class="fas fa-chevron-right"></i> Ambulância </a>
                        <a href="#review"> <i class="fas fa-chevron-right"></i> ficha medica </a>
                        <a href="#review"> <i class="fas fa-chevron-right"></i> farmacias proximas </a>

                    </div>
                    <div class="box">
                        <h3>contate-nos</h3>
                        <a href="#review"> <i class="fas fa-phone"></i> +19 98113-1751 </a>
                        <a href="#review"> <i class="fas fa-phone"></i> +19 98608-5124 </a>
                        <a href="#review"> <i class="fas fa-envelope"></i> 4Hcontato@gmail.com </a>
                        <a href="#review"> <i class="fas fa-map-marker-alt"></i> Estiva Gerbi - 13857-000 </a>
                    </div>
                </div>
                <div class="credit"> Criado por <span>4Health</span> | Etec Pedro Fereira Alves | 2022</div>
            </section>

            <script src="js/script.js"></script>

            
            <script>
                const exampleModal = document.getElementById('exampleModal')
                exampleModal.addEventListener('show.bs.modal', event => {

                    const button = event.relatedTarget

                    const recipient = button.getAttribute('data-bs-whatever')

                    const modalTitle = exampleModal.querySelector('.modal-title')
                    const modalBodyInput = exampleModal.querySelector('.modal-body input')

                    modalTitle.textContent = `Agendamentos`
                    modalBodyInput.value = `Seu nome aqui`
                })
            </script>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
                integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
                integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
                crossorigin="anonymous"></script>

</body>
</html>
