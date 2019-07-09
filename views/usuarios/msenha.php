<?php

	opanel('Alterar senha do usuário');
		form_open('usuarios/msenha');
		row();
			col(6);
				form_text_input('Nova senha:', 'senha', 'required');
			cdiv();
		cdiv();
		submit('ALTERAR SENHA', 'btn btn-primary');
		form_close();
	cpanel();
