<div class="signpanel-wrapper">
      <div class="signbox">
        <div class="signbox-header">
          <h4>My Air Company</h4>
          <p class="mg-b-0">Sistema de gestão para empresas aéreas.</p>
        </div><!-- signbox-header -->
        <div class="signbox-body">
            <?php 
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
                form_open('usuarios/login');
                form_text_input('E-mail', 'email', 'required|email');
                form_password_input('Senha', 'senha','required');
                submit('ACESSAR', 'btn btn-dark btn-block');
                form_close();
            ?>
          <div class="form-group">
                <?= a('Esqueci minha senha!', 'usuarios/recuperar', ''); ?>
          </div><!-- form-group -->
          <div class="tx-center bd pd-10 mg-t-40">Não possui conta? <a href="#">Cadastre-se agora.</a></div>
        </div><!-- signbox-body -->
      </div><!-- signbox -->
    </div>

