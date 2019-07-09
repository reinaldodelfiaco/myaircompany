<?php
	opanel('Perfil');
		form_open('usuarios/profile','POST', true);
			form_file_input('Alterar Foto', 'foto');
			form_text_input('Nome', 'nome', 'required','','', $usuario->nome);
			form_text_input('Telefone', 'telefone','','','', $usuario->telefone);
			submit('Salvar', 'btn btn-primary');
		form_close();
	cpanel();

?>
