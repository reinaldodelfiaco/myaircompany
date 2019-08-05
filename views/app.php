<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <title><?= (!empty($title)) ? $title : 'VOEAVA - Sistema de Gestão' ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/select2.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/datepicker3.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/mvpready-admin.css">


    <!-- Favicon -->
    <?= render_favicon() ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?= PUBLIC_URL ?>js/jquery.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jClocksGMT.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.rotate.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.slimscroll.min.js"></script>


    <script src="<?= PUBLIC_URL ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/dataTables.bootstrap.js"></script>
    <script src="<?= PUBLIC_URL ?>js/select2.min.js"></script>

    <script src="<?= PUBLIC_URL ?>js/mvpready-core.js"></script>
    <script src="<?= PUBLIC_URL ?>js/mvpready-helpers.js"></script>
    <script src="<?= PUBLIC_URL ?>js/mvpready-admin.js"></script>


    <script src="<?= PUBLIC_URL ?>js/mvpready-account.js"></script>
    <script src="<?= PUBLIC_URL ?>js/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap-datepicker.js"></script>
    <script src="<?= PUBLIC_URL ?>js/textboxio/textboxio.js"></script>
    <script src="<?= PUBLIC_URL ?>js/jquery.mask.js"></script>
    <script src="<?= PUBLIC_URL ?>js/datepicker.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


</head>

<body class="account-bg">
    <header class="navbar" role="banner">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-cog"></i>
                </button>
                <a href="<?= BASE ?>usuarios/dashboard" class="navbar-brand navbar-brand-img">
                    <?= render_admin_logo() ?>
                </a>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <!--<li class="dropdown navbar-notification">
                  <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell navbar-notification-icon"></i>
                    <span class="visible-xs-inline">&nbsp;Notoficações</span>
                    <b class="badge badge-primary">3</b>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-header">&nbsp;Notificações</div>
                    <div class="notification-list">
                      <a href="./page-notifications.html" class="notification">
                    <span class="notification-icon"><i class="fa fa-cloud-upload text-primary"></i></span>
                    <span class="notification-title">Notification Title</span>
                    <span class="notification-description">Praesent dictum nisl non est sagittis luctus.</span>
                    <span class="notification-time">20 minutes ago</span>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <span class="notification-icon"><i class="fa fa-ban text-secondary"></i></span>
                    <span class="notification-title">Notification Title</span>
                    <span class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                    <span class="notification-time">20 minutes ago</span>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <span class="notification-icon"><i class="fa fa-warning text-tertiary"></i></span>
                    <span class="notification-title">Storage Space Almost Full!</span>
                    <span class="notification-description">Praesent dictum nisl non est sagittis luctus.</span>
                    <span class="notification-time">20 minutes ago</span>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <span class="notification-icon"><i class="fa fa-ban text-danger"></i></span>
                    <span class="notification-title">Sync Error</span>
                    <span class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                    <span class="notification-time">20 minutes ago</span>
                      </a>
                    </div>
                    <a href="#" class="notification-link">Todas as notificações</a>
                  </div>
                </li>-->
                    <!--<li class="dropdown navbar-notification">
                  <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope navbar-notification-icon"></i>
                    <span class="visible-xs-inline">&nbsp;Mensagens</span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-header">Messages</div>
                    <div class="notification-list">
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-3-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Praesent dictum nisl non est sagittis luctus.</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-3-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-4-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-5-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                    </div>
                    <a href="./page-notifications.html" class="notification-link">View All Messages</a>
                  </div>
                </li>
                <li class="dropdown navbar-notification empty">
                  <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-warning navbar-notification-icon"></i>
                    <span class="visible-xs-inline">&nbsp;&nbsp;Alertas</span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-header">Alertas</div>
                    <div class="notification-list">
                      <h4 class="notification-empty-title">No alerts here.</h4>
                      <p class="notification-empty-text">Check out what other makers are doing on Explore!</p>
                    </div>
                    <a href="#" class="notification-link">Listar alertas</a>
                  </div>
                </li>
                <div class="dropdown-menu">
                    <div class="dropdown-header">&nbsp;Notificações</div>

                    <div class="notification-list">

                        <a href="./page-notifications.html" class="notification">
                            <span class="notification-icon"><i class="fa fa-cloud-upload text-primary"></i></span>
                            <span class="notification-title">Notification Title</span>
                            <span class="notification-description">Praesent dictum nisl non est sagittis luctus.</span>
                            <span class="notification-time">20 minutes ago</span>
                        </a>

                        <a href="./page-notifications.html" class="notification">
                            <span class="notification-icon"><i class="fa fa-ban text-secondary"></i></span>
                            <span class="notification-title">Notification Title</span>
                            <span class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                            <span class="notification-time">20 minutes ago</span>
                        </a>

                        <a href="./page-notifications.html" class="notification">
                            <span class="notification-icon"><i class="fa fa-warning text-tertiary"></i></span>
                            <span class="notification-title">Storage Space Almost Full!</span>
                            <span class="notification-description">Praesent dictum nisl non est sagittis luctus.</span>
                            <span class="notification-time">20 minutes ago</span>
                        </a>

                        <a href="./page-notifications.html" class="notification">
                            <span class="notification-icon"><i class="fa fa-ban text-danger"></i></span>
                            <span class="notification-title">Sync Error</span>
                            <span class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                            <span class="notification-time">20 minutes ago</span>
                        </a>

                    </div>

                    <a href="#" class="notification-link">Todas as notificações</a>

                </div>

                </li>
                <li class="dropdown navbar-notification">
                  <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope navbar-notification-icon"></i>
                    <span class="visible-xs-inline">&nbsp;Mensagens</span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-header">Messages</div>
                    <div class="notification-list">
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-3-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Praesent dictum nisl non est sagittis luctus.</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-3-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-4-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                      <a href="./page-notifications.html" class="notification">
                    <div class="notification-icon"><img src="../../global/img/avatars/avatar-5-md.jpg" alt=""></div>
                    <div class="notification-title">New Message</div>
                    <div class="notification-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</div>
                    <div class="notification-time">20 minutes ago</div>
                      </a>
                    </div>
                    <a href="./page-notifications.html" class="notification-link">View All Messages</a>
                  </div>
                </li>
                <li class="dropdown navbar-notification empty">
                  <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-warning navbar-notification-icon"></i>
                    <span class="visible-xs-inline">&nbsp;&nbsp;Alertas</span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-header">Alertas</div>
                    <div class="notification-list">
                      <h4 class="notification-empty-title">No alerts here.</h4>
                      <p class="notification-empty-text">Check out what other makers are doing on Explore!</p>
                    </div>
                    <a href="#" class="notification-link">Listar alertas</a>
                  </div>
                </li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="<?= BASE ?>chefias/dashboard"> Dashboard </a></li>
                    <li class=""><a href="<?= BASE ?>pdv"> Vendas </a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Comercial
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">VENDAS</li>
                            <li><a href="<?= BASE ?>ordens/vendas">Vendas</a></li>
                            <li><a href="<?= BASE ?>estoque/mensagens">Mensagens</a></li>
                            <li><a href="<?= BASE ?>estoque/servicos">Serviços</a></li>
                            <li><a href="<?= BASE ?>estoque/produtos_categorias">Produtos (Categorias)</a></li>
                            <li><a href="<?= BASE ?>estoque/resumido">Estoque</a></li>
                            <li><a href="<?= BASE ?>estoque/armazens">Armazens</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">PRECIFICAÇÃO</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>estoque/produtos  "> Produtos / Serviços
                                </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>precificacao/precificacao_voos_regulares">
                                    Precificação Voos Regulares </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>precificacao/preficiacao_voos_sob_demanda">
                                    Precificação Voos sob Demanda </a> </li>
                            <li class="divider"></li>
                            <li class="title-menu">ANALYTICS</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>analytics/analytics"> Painel Analytics </a>
                            </li>
                            <li class="divider"></li>
                            <li class="title-menu">RELATÓRIOS</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>voos/relatorio"> Relatorio </a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Operações
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">VOOS</li>
                            <li><a href="<?= BASE ?>voos/voos">Voos</a></li>
                            <li><a href="<?= BASE ?>voos/flight_schedule">Flight Schedule</a></li>
                            <li><a href="<?= BASE ?>voos/plano_de_voo">Check-in</a></li>
                            <li><a href="<?= BASE ?>voos/escala_tripulacao">Escala de Tripulantes</a></li>
                            <li><a href="<?= BASE ?>voos/flight_log">Flight Log</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">SEGURANÇA DE VOO</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>relprev/relprev"> RELPREV </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>sgso/auditoria"> Auditoria </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>sgso/ESO"> ESO </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>sgso/comunicacoes"> Comunicações </a> </li>
                            <li class="divider"></li>
                            <li class="title-menu">EMERGÊNCIA</li>
                            <li><a href="<?= BASE ?>contatos_emergencias/contatos_emergencias">Contatos de
                                    Emergência</a></li>
                            <li><a href="<?= BASE ?>contato_midia/contato_midia">Contato com a Mídia</a></li>
                            <li><a href="<?= BASE ?>contato_familia/contato_familia">Contato com a Família</a></li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>rire/rire"> RIRE </a> </li>
                            <li class="divider"></li>
                            <li class="title-menu">RELATÓRIO</li>
                            <li><a href="<?= BASE ?>voos/relatorio">Relatório Operacional</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Manutenção
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">MANUTENÇÃO</li>
                            <li><a href="<?= BASE ?>ordens/compras">Compras</a></li>
                            <li><a href="<?= BASE ?>manutencao/mapa">Mapa de Componentes</a></li>
                            <li><a href="<?= BASE ?>manutencao/componentes">Controle de Componentes</a></li>
                            <li><a href="<?= BASE ?>manutencao/solicitar_manutencao">Solicitação de Manutenção</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">FERRAMENTAS</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>estoque/ferramentas"> Ferramentas </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>estoque/resumido_ferramentas"> Controle de
                                    Ferramentas </a> </li>
                            <li class="divider"></li>
                            <li class="title-menu">ESTOQUE</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>"> Estoque de Peças e Insumos </a> </li>
                            <li class="divider"></li>
                            <li class="title-menu">RELATÓRIO</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>manutencao/relatorio"> Relatório de
                                    Manutenções </a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Treinamentos
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">TREINAMENTO</li>
                            <li><a href="<?= BASE ?>treinamentos/treinamento">Treinamentos</a></li>
                            <li><a href="<?= BASE ?>treinamentos/biblioteca">Biblioteca</a></li>
                            <li><a href="<?= BASE ?>treinamentos/controle_biblioteca">Controle de Biblioteca</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">RELATÓRIO</li>
                            <li><a href="<?= BASE ?>treinamentos/relatorio">Relatório de Treinamentos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Financeiro
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">MOVIMENTOS</li>
                            <li><a href="<?= BASE ?>financeiro/despesas">Despesas</a></li>
                            <li><a href="<?= BASE ?>financeiro/receitas">Receitas</a></li>
                            <li><a href="<?= BASE ?>financeiro/movimentos">Geral</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">CADASTROS</li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>financeiro/contas_bancarias"> Caixas e
                                    Contas </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>financeiro/categorias_financeiras">
                                    Categorias de Despesas e Receitas </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>financeiro/contas_contabeis"> Contas
                                    Contábeis </a> </li>
                            <li> <a class="dropdown-item " href="<?= BASE ?>financeiro/formas_pagamento"> Espécies </a>
                            </li>
                            <li class="divider"></li>
                            <li class="title-menu">RELATÓRIO</li>
                            <li><a href="<?= BASE ?>financeiro/caixas">Extrato</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Cadastros
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">ADMINISTRATIVO</li>
                            <li><a href="<?= BASE ?>ordens/compras">Compras</a></li>
                            <li><a href="<?= BASE ?>chefias/funcionarios">Funcionários</a></li>
                            <li><a href="<?= BASE ?>tasks">Ocorrências</a></li>
                            <li><a href="<?= BASE ?>#">Escalas</a></li>
                            <li><a href="<?= BASE ?>bases_operacionais/bases_operacionais">Bases Operacionais</a></li>
                            <div class="divider"></div>
                            <li class="title-menu">OPERAÇÕES</li>
                            <li><a href="<?= BASE ?>modelos_aeronaves/modelos_aeronaves">Modelos (Aeronaves)</a></li>
                            <li><a href="<?= BASE ?>aeronaves/aeronaves">Aeronaves</a></li>
                            <li><a href="<?= BASE ?>chefias/comissarios">Comissários</a></li>
                            <li><a href="<?= BASE ?>chefias/pilotos">Pilotos</a></li>
                            <li><a href="<?= BASE ?>chefias/motoristas">Motoristas</a></li>
                            <li><a href="<?= BASE ?>chefias/mecanicos">Mecânicos</a></li>
                            <div class="divider"></div>
                            <li class="title-menu">RELACIONAMENTOS</li>
                            <li><a href="<?= BASE ?>crm/empresas">Clientes</a></li>
                            <li><a href="<?= BASE ?>crm/fornecedores">Fornecedores</a></li>
                            <li><a href="<?= BASE ?>crm/agencias">Agências</a></li>
                            <div class="divider"></div>
                            <li class="title-menu">CONFIGURAÇÕES</li>
                            <li><a href="<?= BASE ?>unidades/unidades">Unidades</a></li>
                            <li><a href="<?= BASE ?>usuarios/index">Usuários</a></li>
                            <li><a href="<?= BASE ?>cargos/cargos">Cargos</a></li>
                            <div class="divider"></div>
                            <li class="title-menu">Ocorrências</li>
                            <li><a href="<?= BASE ?>tasks/classificacoes">Classificacoes</a></li>
                            <li><a href="<?= BASE ?>tasks/origens">Origens</a></li>
                            <li><a href="<?= BASE ?>tasks/tipos">Tipos</a></li>
                            <li><a href="<?= BASE ?>empresas/departamentos">Departamentos</a></li>
                        </ul>
                    </li>
                    <!--<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            CRM
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">COMPRAS</li>
                            <li><a href="<?= BASE ?>ordens/compras">Compras</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">VENDAS</li>
                            <li><a href="<?= BASE ?>ordens/vendas">Extrato</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            Cadastros
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="title-menu">CRM</li>
                            <li><a href="<?= BASE ?>crm/empresas">Clientes</a></li>
                            <li><a href="<?= BASE ?>crm/fornecedores">Fornecedores</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">FINANCEIRO</li>
                            <li><a href="<?= BASE ?>financeiro/contas_bancarias">Contas</a></li>
                            <li><a href="<?= BASE ?>financeiro/contas_contabeis">Contas Contábeis</a></li>
                            <li><a href="<?= BASE ?>financeiro/categorias_financeiras">Categorias</a></li>
                            <li><a href="<?= BASE ?>financeiro/formas_pagamentos">Pagamentos</a></li>
                            <li class="divider"></li>
                            <li class="title-menu">ESTOQUE</li>
                            <li><a href="<?= BASE ?>estoque/produtos">Produtos</a></li>
                            <li><a href="<?= BASE ?>estoque/armazens">Armazens</a></li>
                            <li><a href="<?= BASE ?>estoque/produtos_categorias">Categorias</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown navbar-profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            <img src="<?= render_profile() ?>" class="navbar-profile-avatar" alt=""
                                onerror="this.onerror=null;this.src='<?= PUBLIC_URL ?>imagens/usuarios/1.png';">
                            <span class="visible-xs-inline"><?= session('nome') ?></span>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?= BASE ?>usuarios/profile">
                                    <i class="fa fa-user"></i>
                                    &nbsp;&nbsp;Meu Perfil
                                </a>
                            </li>
                            <li><a href="<?= BASE ?>usuarios"><i class="fa fa-users"></i> Usuários</a></li>
                            <li><a href="<?= BASE ?>empresas/informacoes"><i class="fa fa-file-o"></i> Informações</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= BASE ?>usuarios/logout ">
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp;&nbsp;Sair
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container-fluid container-clock">
        <div class="row">
            <div class="col-md-2">
                <div id="brasil"></div>
            </div>
            <div class="col-md-2">
                <div id="zulu"></div>
            </div>
            <div class="col-md-2">
                <div id="miami"></div>
            </div>
            <div class="col-md-2">
                <div id="tokyo"></div>
            </div>
            <div class="col-md-2">
              Dolar: <br> R$ 
              <?php
                dollar();
              ?>
            </div>
            <div class="col-md-2">
              Euro: <br>R$ 
              <?php
                euro();
              ?>
            </div>

        </div>
    </div>
    <div class="container-fluid">
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
    <div class="text-center">Voeava © <?= date("Y") ?> Direitos Reservados </div>
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
            title: 'Zulu',
            digital: true,     
            timeformat: 'HH:mm:ss',         
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