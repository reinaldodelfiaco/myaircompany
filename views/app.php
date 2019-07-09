<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="My Air Company.">


    <title><?= (!empty($title)) ? $title : 'My Air Company' ?></title>

    <!-- vendor css -->
    <link href="<?= PUBLIC_URL ?>css/font-awesome.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/ionicons.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/rickshaw.min.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/select2.min.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/datepicker3.css" rel="stylesheet">

    <!-- Katniss CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/katniss.css">

    <script src="<?= PUBLIC_URL ?>js/jquery.js"></script>
    <script src="<?= PUBLIC_URL ?>js/popper.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap.js"></script>
    <script src="<?= PUBLIC_URL ?>js/perfect-scrollbar.jquery.js"></script>
    <script src="<?= PUBLIC_URL ?>js/moment.js"></script>
    <script src="<?= PUBLIC_URL ?>js/d3.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAEt_DBLTknLexNbTVwbXyq2HSf2UbRBU8"></script>
    <script src="<?= PUBLIC_URL ?>js/gmaps.js"></script>
    <script src="<?= PUBLIC_URL ?>js/Chart.js"></script>
    <script src="<?= PUBLIC_URL ?>js/katniss.js"></script>
    <script src="<?= PUBLIC_URL ?>js/ResizeSensor.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.mask.js"></script>
    <script src="<?= PUBLIC_URL ?>js/datepicker.js"></script>
    <script src="<?= PUBLIC_URL ?>js/textboxio/textboxio.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.rotate.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jClocksGMT.js"></script>
    <script src="<?= PUBLIC_URL ?>js/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/rickshaw.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/select2.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.dataTables.min.js"></script>

    <?php render_favicon() ?>

</head>

<body>
    <div class="kt-sideleft-header">
        <div class="kt-logo"><a href="<?= BASE ?>chefias/dashboard">My Air Company</a></div>
        <div id="zulu" class="kt-date-today"></div>
        <div class="input-group kt-input-search">
            <input type="text" class="form-control" placeholder="Buscar ...">
            <span class="input-group-btn mg-0">
                <button class="btn"><i class="fa fa-search"></i></button>
            </span>
        </div><!-- input-group -->
    </div>
    <div class="kt-sideleft">
        <ul class="nav kt-sideleft-menu">
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    Informações
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="#">
                            <div id="brasil"></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <div id="zulu"></div>
                        </a> </li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <div id="miami"></div>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <div id="tokyo"></div>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> Dolar <br> <?php  dollar(); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">EUEuro <br> <?php  euro(); ?></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?= BASE ?>chefias/dashboard" class="nav-link">
                <i class="icon ion-easel"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="<?= BASE ?>pdv" class="nav-link">
                <i class="icon ion-Briefcase"></i>
                    <span>Vendas</span>
                </a>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    Comercial
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="<?= BASE ?>ordens/vendas" class="nav-link">Vendas</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/mensagens" class="nav-link">Mensagens</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/servicos" class="nav-link">Serviços</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/produtos_categorias" class="nav-link">Produtos
                            (Categorias)</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/resumido" class="nav-link">Estoque</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/armazens" class="nav-link">Armazens</a></li>
                    <li class="nav-item"><a href="<?= BASE ?>estoque/produtos" class="nav-link"> Produtos / Serviços</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>precificacao/precificacao_voos_regulares">
                            Precificação Voos Regulares </a> </li>
                    <li class="nav-item"><a class="nav-link"
                            href="<?= BASE ?>precificacao/preficiacao_voos_sob_demanda"> Precificação Voos sob Demanda
                        </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>analytics/analytics"> Painel Analytics
                        </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/relatorio"> Relatório </a> </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    Operações
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/voos">Voos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/flight_schedule">Flight Schedule</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos_passageiros/check_in">Check-in</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/escala_tripulacao">Escala de
                            Tripulantes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/flight_log">Flight Log</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos_passageiros/lista_passageiros">Lista
                            de Passageiros</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>relprev/relprev"> RELPREV </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>sgso/auditoria"> Auditoria </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>sgso/ESO"> ESO </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>sgso/comunicacoes"> Comunicações </a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="<?= BASE ?>contatos_emergencias/contatos_emergencias">Contatos de Emergência</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>contato_midia/contato_midia">Contato com a
                            Mídia</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos_passageiros/contato_familia">Contato
                            com a Família</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>rire/rire"> RIRE </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>voos/relatorio">Relatório Operacional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                <i class="icon ion-settings"></i>
                    Manutenção
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>ordens/compras">Compras</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>manutencao/mapa">Mapa de Componentes</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>manutencao/componentes">Controle de
                            Componentes</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="<?= BASE ?>manutencao/solicitar_manutencao">Solicitação de Manutenção</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>estoque/ferramentas"> Ferramentas </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>estoque/resumido_ferramentas"> Controle de
                            Ferramentas </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>"> Estoque de Peças e Insumos </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>manutencao/relatorio"> Relatório de
                            Manutenções </a> </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                <i class="icon ion-filling"></i>
                    Treinamentos
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>treinamentos/treinamento">Treinamentos</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>treinamentos/biblioteca">Biblioteca</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>treinamentos/controle_biblioteca">Controle
                            de Biblioteca</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>treinamentos/relatorio">Relatório de
                            Treinamentos</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                <i class="icon ion-settings"></i>
                    Financeiro
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>financeiro/despesas">Despesas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>financeiro/receitas">Receitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>financeiro/movimentos">Geral</a></li>
                    <li class="nav-item"><a class="nav-link" class="nav-link"
                            href="<?= BASE ?>financeiro/contas_bancarias">Caixas e Contas </a> </li>
                    <li class="nav-item"><a class="nav-link" class="nav-link"
                            href="<?= BASE ?>financeiro/categorias_financeiras">Categorias de Despesas e Receitas </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" class="nav-link"
                            href="<?= BASE ?>financeiro/contas_contabeis"> Contas Contábeis </a> </li>
                    <li class="nav-item"><a class="nav-link" class="nav-link"
                            href="<?= BASE ?>financeiro/formas_pagamento"> Espécies </a> </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>financeiro/caixas">Extrato</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    Cadastros
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>ordens/compras">Compras</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>chefias/funcionarios">Funcionários</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>tasks">Ocorrências</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>#">Escalas</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="<?= BASE ?>bases_operacionais/bases_operacionais">Bases Operacionais</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="<?= BASE ?>modelos_aeronaves/modelos_aeronaves">Modelos
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>aeronaves/aeronaves">Aeronaves</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>chefias/comissarios">Comissários</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>chefias/pilotos">Pilotos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>chefias/motoristas">Motoristas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>chefias/mecanicos">Mecânicos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>crm/empresas">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>crm/fornecedores">Fornecedores</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>crm/agencias">Agências</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>unidades/unidades">Unidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>usuarios/index">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>cargos/cargos">Cargos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>tasks/classificacoes">Classificacoes</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>tasks/origens">Origens</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>tasks/tipos">Tipos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE ?>empresas/departamentos">Departamentos</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="kt-headpanel">
        <div class="kt-headpanel-left">
            <a id="naviconMenu" href="" class="kt-navicon d-none d-lg-flex"><i class="icon ion-navicon-round"></i></a>
            <a id="naviconMenuMobile" href="" class="kt-navicon d-lg-none"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="kt-headpanel-right">
            <div class="dropdown dropdown-profile">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <img src="<?= render_profile() ?>" class="wd-32 rounded-circle" alt=""
                        onerror="this.onerror=null;this.src='<?= PUBLIC_URL ?>imagens/usuarios/default.png';"
                        height="35" width="40">
                    <span class="logged-name"><span class="hidden-xs-down">Jane Doe</span> <i
                            class="fa fa-angle-down mg-l-3"></i></span>
                </a>
                <div class="dropdown-menu wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li>
                            <a href="<?= BASE ?>usuarios/profile">
                                <i class="fa fa-user"></i>
                                &nbsp;&nbsp;Meu Perfil
                            </a>
                        </li>
                        <li class="nav-item"><a href="<?= BASE ?>usuarios"><i class="fa fa-users"></i>&nbsp;&nbsp;
                                Usuários</a>
                        </li>
                        <li class="nav-item"><a href="<?= BASE ?>empresas/informacoes"><i class="fa fa-file-o"></i>
                                &nbsp;&nbsp;Informações</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= BASE ?>usuarios/logout ">
                                <i class="fa fa-sign-out"></i>
                                &nbsp;&nbsp;Sair
                            </a>
                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </div><!-- kt-headpanel-right -->
    </div><!-- kt-headpanel -->
    <div class="kt-breadcrumb">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="<?= BASE ?>chefias/dashboard">Início</a>
            <!--<span class="breadcrumb-item active">Dashboard</span> -->
        </nav>
    </div>
    <div class="kt-mainpanel">
        <div class="kt-pagebody">
        <?php if (has_flash('error')) { ?>
        <div id="alertMessage" class="alert alert-danger">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
            <strong>Ops!</strong> <?= flash_message('error') ?>
        </div>
        <?php } ?>

        <?php if (has_flash('success')) { ?>
        <div id="alertMessage" class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
            <strong>Show!</strong> <?= flash_message('success') ?>
        </div>
        <?php } ?>
        <?= $_view ?>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $.validate({
            modules: 'security, brazil',
            lang: 'pt'
        });
        $('#brasil').jClocksGMT({
            title: 'Brasil',
            digital: true,
            timeformat: 'HH:mm:ss',
            offset: '-3',
            dateformat: 'DD/MM/YYYY',
            analog: false,
        });
        $('#zulu').jClocksGMT({
            title: 'GMT | ',
            digital: true,
            timeformat: '  HH:mm:ss',
            offset: '0',
            dateformat: 'DD/MM/YYYY',
            analog: false,
        });
        $('#miami').jClocksGMT({
            title: 'Miami',
            digital: true,
            timeformat: 'HH:mm:ss',
            offset: '-4',
            dateformat: 'DD/MM/YYYY',
            analog: false,
        });
        $('#tokyo').jClocksGMT({
            title: 'Tokyo',
            digital: true,
            timeformat: 'HH:mm:ss',
            offset: '+9',
            dateformat: 'DD/MM/YYYY',
            analog: false,
        });
    });
    </script>


    <!--<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/56b4e4224003e62e1739f2a2/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
})();
</script>-->
    <!--End of Tawk.to Script-->

</body>

</html>