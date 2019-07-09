<?php if (has_flash('error')) { ?>
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Ops!</strong> <?= flash_message('error') ?>
    </div>
<?php } ?>

<?php if (has_flash('success')) { ?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Show!</strong> <?= flash_message('success') ?>
    </div>
<?php } ?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <title><?= (!empty($title)) ? $title : 'CONT4 - Desenvolvimento de Sistemas e Certificação Digital.' ?></title>
    <?php if (!empty($tags)) { ?>
        <meta name="keywords" content="<?= $tags ?>">
    <?php } else { ?>
        <meta name="keywords"
              content="cont4, desenvolvimento de sistemas, certificacao digital, certificados digitais, certificacao, sistemas, tecnologia da informação, fenaconcd, contabilidade, contador">
    <?php } ?>
    <?php if (!empty($meta)) { ?>
        <meta name="Description" content="<?= $meta ?>">
    <?php } else { ?>
        <meta name="Description"
              content="CONT4 - Desenvolvimento de Sistemas Web e Aplicativos, Venda e emissão de Certificados Digitais para se identificar e autenticar em sites e sistemas eletrônicos.">
    <?php } ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jonas Reichel">

    <!-- Google Font: Open Sans -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
    <link rel="canonical" href="http://cont4.me">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/toastr.css">

    <meta name="google-site-verification" content="MhY7ffZJsjqpt7NI_XfcDHxpJEQPgx5EGWcp_0n9tCc"/>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@jonasreichel">
    <meta name="twitter:title" content="CONT4 - Desenvolvimento de Sistemas e Certificação Digital">
    <meta name="twitter:description" content="CONT4 - Desenvolvimento de Sistemas Web e Aplicativos, Venda e emissão de Certificados Digitais para se identificar e autenticar em sites e sistemas eletrônicos.">
    <meta name="twitter:image" content="http://cont4.me/uploads/450aae8a72a1995ae3db074632330e5081ef936d-conta.png">
    <meta name="twitter:image:alt" content="http://cont4.me/uploads/450aae8a72a1995ae3db074632330e5081ef936d-conta.png">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133566705-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-133566705-1');
    </script>


    <!-- App CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/mvpready-landing.css">
    <link href="<?= PUBLIC_URL ?>css/animate.min.css" rel="stylesheet">

    <script src="<?= PUBLIC_URL ?>js/jquery.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/mvpready-core.js"></script>
    <script src="<?= PUBLIC_URL ?>js/mvpready-helpers.js"></script>
    <script src="<?= PUBLIC_URL ?>js/mvpready-landing.js"></script>
    <script src="<?= PUBLIC_URL ?>js/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap-datepicker.js"></script>
    <script src="<?= PUBLIC_URL ?>js/toastr.min.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php render_favicon() ?>
</head>
<body class="">
<div id="wrapper">
    <header class="navbar" role="banner">
        <div class="container">
            <div class="navbar-header">
                <a href="<?= BASE ?>" class="navbar-brand navbar-brand-img">
                    <?php render_logo(); ?>
                </a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-right mainnav-menu">
                    <li><a href="<?= BASE ?>">Início</a></li>
                    <li><a href="<?= BASE ?>cms/contato">Contato</a></li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                            Institucional
                            <i class="fa fa-caret-down navbar-caret"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= BASE ?>sobre-a-cont4	"><i
                                            class="fa fa-angle-double-right dropdown-icon"></i>Sobre nós</a></li>
                            <li><a href="<?= BASE ?>nossa-equipe"><i class="fa fa-angle-double-right dropdown-icon"></i>Equipe</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                            Serviços
                            <i class="fa fa-caret-down navbar-caret"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= BASE ?>desenvolvimento-de-sistemas"><i
                                            class="fa fa-angle-double-right dropdown-icon"></i>Desenvolvimento</a></li>
                            <li><a href="<?= BASE ?>cloud-services"><i
                                            class="fa fa-angle-double-right dropdown-icon"></i>Cloud</a></li>
                            <li><a href="<?= BASE ?>consultoria-de-ti"><i
                                            class="fa fa-angle-double-right dropdown-icon"></i>Consultoria</a></li>
                            <li><a href="<?= BASE ?>certificacao-digital"><i
                                            class="fa fa-angle-double-right dropdown-icon"></i>Certificação Digital</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?= BASE ?>certificacao-digital">CERTIFICAÇÃO DIGITAL</a></li>
                    <li><a href="<?= BASE ?>usuarios/login">ACESSAR</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?= $_view ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="heading-block">
                        <h4>CONT4</h4>
                    </div>
                    <p>Desenvolvemos soluções para você e sua empresa.</p>
                </div>
                <div class="col-sm-3">
                    <div class="heading-block">
                        <h4>Contato:</h4>
                    </div>
                    <ul class="icons-list">
                        <li>
                            <i class="icon-li fa fa-home"></i>
                            Assis Brasil, 6186 - Sala 707 <br>
                            Porto Alegre, RS - Brasil
                        </li>
                        <li>
                            <i class="icon-li fa fa-phone"></i>
                            +55 51 991575864
                        </li>
                        <li>
                            <i class="icon-li fa fa-envelope"></i>
                            <a href="contato@cont4.me">contato@cont4.me</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="heading-block">
                        <h4>Social</h4>
                    </div>
                    <ul class="icons-list">
                        <li>
                            <i class="icon-li fa fa-facebook"></i>
                            <a target="_blank" href="https://www.facebook.com/cont4.me/">Facebook</a>
                        </li>
                        <li>
                            <i class="icon-li fa fa-twitter"></i>
                            <a target="_blank" href="https://twitter.com/jonasreichel">Twitter</a>
                        </li>
                        <li>
                            <i class="icon-li fa fa-linkedin"></i>
                            <a target="_blank" href="https://www.linkedin.com/company/cont4/">Linkedin</a>
                        </li>
                        <li>
                            <i class="icon-li fa fa-instagram"></i>
                            <a target="_blank" href="https://www.instagram.com/cont4.me/">Instagram</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="heading-block">
                        <h4>Fique Atualizado</h4>
                    </div>
                    <p>Receba e-mails contendo novidades.</p>

                    <?php
                    form_open('/');
                    form_text_input('E-mail', 'mail', 'server', 'cms/valida_email');
                    submit('Subscribe', 'btn btn-transparent');
                    form_close();
                    ?>
                </div>
            </div>
        </div>
    </footer>
    <footer class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>Copyright &copy; <?= date("Y") ?> <a href="#">Cont4</a>.</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
        $.validate({
            modules: 'security',
            lang: 'pt'
        });
    </script>
</body>
</html>

