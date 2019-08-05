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
    <title><?= (!empty($title)) ? $title : 'Voeava - Sistema de Gestão' ?></title>

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


    <!-- App CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/mvpready-admin.css">

    <!-- Favicon -->
    <?= render_favicon() ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="account-bg">
<br class="xs-80">

<?= $_view ?>

<div class="text-center">Voeava © <?= date("Y") ?> Direitos Reservados </div>
<script src="<?= PUBLIC_URL ?>js/jquery.js"></script>
<script src="<?= PUBLIC_URL ?>js/bootstrap.min.js"></script>
<script src="<?= PUBLIC_URL ?>js/jquery.slimscroll.min.js"></script>


<script src="<?= PUBLIC_URL ?>js/mvpready-core.js"></script>
<script src="<?= PUBLIC_URL ?>js/mvpready-helpers.js"></script>
<script src="<?= PUBLIC_URL ?>js/mvpready-admin.js"></script>


<script src="<?= PUBLIC_URL ?>js/mvpready-account.js"></script>
<script src="<?= PUBLIC_URL ?>js/form-validator/jquery.form-validator.min.js"></script>

<script>
    $.validate({
        lang: 'pt'
    });
</script>

</body>
</html>