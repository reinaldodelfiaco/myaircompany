<?php
div('account-wrapper');
div('account-body');
br();
render_logo();
p('Informe uma nova senha para acessar sua conta.');

div('xs-10');

form_open('usuarios/resetar?token=' . get('token'));
if(has_flash('error')) { ?>
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Ops!</strong> <?= flash_message('error') ?>
    </div>
<?php }
if(has_flash('success')) { ?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Show!</strong> <?= flash_message('success') ?>
    </div>
<?php }

hidden('token' ,get('token'));
form_text_input('Nova senha', 'senha', 'required');

div('pull-right');
cdiv();

br();
submit('ENVIAR', 'btn btn-primary btn-block btn-lg');

form_close();
cdiv();
cdiv();
div('account-footer');
$link = a('Recuperar senha!', 'usuarios/recuperar', 'btn');
#p($link);
cdiv();
cdiv();
