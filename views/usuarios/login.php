<?php
    div('account-wrapper');
        div('account-body');
            br();
            render_logo();
            div('xs-5');
                form_open('usuarios/login');
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

                    form_text_input('E-mail', 'email', 'required|email');

                    form_password_input('Senha', 'senha','required');

                    div('pull-right');
                    cdiv();

                    submit('ACESSAR', 'btn btn-primary btn-block btn-lg');

                form_close();
            cdiv();
        cdiv();
        div('account-footer');
            $link = a('Esqueci minha senha!', 'usuarios/recuperar', 'btn');
            #p($link);
        cdiv();
    cdiv();