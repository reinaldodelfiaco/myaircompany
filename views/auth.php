<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="MY AIR COMPANY.">
    <meta name="author" content="ThemePixels">


    <title><?= (!empty($title)) ? $title : 'MY AIR COMPANY' ?></title>

    <!-- vendor css -->
    <link href="<?= PUBLIC_URL ?>css/font-awesome.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/ionicons.css" rel="stylesheet">
    <link href="<?= PUBLIC_URL ?>css/perfect-scrollbar.css" rel="stylesheet">

    <!-- Katniss CSS -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/katniss.css">
    <?php render_favicon() ?>

    <script src="<?= PUBLIC_URL ?>js/jquery.js"></script>
    <script src="<?= PUBLIC_URL ?>js/popper.js"></script>
    <script src="<?= PUBLIC_URL ?>js/bootstrap.js"></script>
    <script src="<?= PUBLIC_URL ?>js/form-validator/jquery.form-validator.min.js"></script>


  </head>
  <body>
    <?= $_view ?>
<script>
    $.validate({
        lang: 'pt'
    });
</script>

</body>
</html>
