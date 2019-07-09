<?php
	br();
	opanel('Editar empresa: ' . $empresa->razao_social);
		form_open('empresas/informacoes', 'POST', true);
		?>
<ul id="myTab1" class="nav nav-tabs">
    <li class="active">
        <a href="#ig" id="iig" data-toggle="tab">Informaçõe Gerais</a>
    </li>

    <li class="">
        <a href="#if" id="iif" data-toggle="tab">Informações Fiscais</a>
    </li>
</ul>
<div id="myTab1Content" class="tab-content">

    <div class="tab-pane fade active in" id="ig">
        <?php

			row();
				col(4);
					form_file_input('Logotipo', 'logo');
				cdiv();
				col(4);
					form_file_input('Logotipo (Administrador)', 'admin_logo');
				cdiv();

				col(4);
					form_file_input('Favicon', 'favicon');
				cdiv();
			cdiv();
			row();
				col(12);
					form_text_input('Razão Social', 'razao_social', 'required','','', $empresa->razao_social);
				cdiv();
			cdiv();
			row();
				col(6);
					form_text_input('Nome Fantasia', 'nome_fantasia', 'required','','', $empresa->nome_fantasia);
				cdiv();
				col(6);
					form_text_input('CNPJ', 'cnpj', 'required','','', $empresa->cnpj);
				cdiv();
			cdiv();
			row();
				col(6);
					form_text_input('Inscrição Estadual', 'inscricao_estadual', '','','', $empresa->inscricao_estadual);
				cdiv();
				col(6);
					form_text_input('Inscrição Municipal', 'inscricao_municipal', '','','', $empresa->inscricao_municipal);
				cdiv();
			cdiv();
			row();
				col(4);
					form_text_input('Contato', 'contato', 'required','','',$empresa->contato);
				cdiv();

				col(4);
					form_text_input('E-mail', 'email', 'required|email','','',$empresa->email);
				cdiv();

				col(4);
					form_text_input('Telefone', 'telefone', 'required','','',$empresa->telefone);
				cdiv();
			cdiv();
			row();
				col(2);
					form_text_input('CEP', 'cep', 'required','','',$empresa->cep);
				cdiv();
				col(2);
					form_select2_ajax('crm/uf','Estado', 'estado');
				cdiv();
				col(4);
					form_select2_ajax('crm/municipios','Cidade', 'cidade');
				cdiv();
				col(4);
					form_text_input('Bairro', 'bairro', 'required','','',$empresa->bairro);
				cdiv();
			cdiv();
			row();
				col(6);
					form_text_input('Endereço', 'endereco', 'required','','',$empresa->endereco);
				cdiv();
				col(2);
					form_text_input('Número', 'numero', 'required','','',$empresa->numero);
				cdiv();
				col(4);
					form_text_input('Complemento', 'complemento', '','','',$empresa->complemento);
				cdiv();
			cdiv();

		?>

    </div>
    <div class="tab-pane fade active in" id="if">
	<?php
		row();
			col(6);
				form_text_input('Última nota fiscal emitida (Número)', 'ultima_numero_nfe_emitida', '','','', $empresa->ultima_numero_nfe_emitida);
			cdiv();
			col(6);
				form_text_input('Última nota consumidor emitida (Número)', 'ultima_numero_nfc_emitida', '','','', $empresa->ultima_numero_nfc_emitida);
			cdiv();
		cdiv();
		row();
			col(6);
				form_text_input('Série NFE', 'serie_nfe', '','','', $empresa->serie_nfe);
			cdiv();
			col(6);
				form_text_input('Série NFC', 'serie_nfc', '','','', $empresa->serie_nfc);
			cdiv();
		cdiv();
		row();
			col(6);
				form_text_input('Subsérie NFE', 'subserie_nfe', '','','', $empresa->subserie_nfe);
			cdiv();
			col(6);
				form_text_input('Subsérie NFC', 'subserie_nfe', '','','', $empresa->subserie_nfe);
			cdiv();
		cdiv();
		row();
			col(6);
				form_select2_ajax('empresas/select_cnae', 'CNAE', 'cnae');
			cdiv();
			col(6);
				$crt =  [
							['value' => 1, 'nome' => 'Simples Nacional'], 
							['value' => 2, 'nome' => 'Simples Nacional - Excesso de Sublimite da receita Bruta']
						];
				form_select2_data('CRT', 'crt', $crt, $empresa->crt);
			cdiv();
			
		cdiv();
		row();
			col(6);
				form_file_input('Upload Certificado Digital (A1)', 'certificado_digital');
			cdiv();
			col(6);
				form_password_input('Senha (Certificado Digital)', 'senha_certificado_digital', '','','', $empresa->senha_certificado_digital);
			cdiv();
			
		cdiv();

	?>
    </div>

</div>
<?php

			
			
			submit('ATUALIZAR', 'btn btn-success');
		form_close();

	cpanel();
				

?>

<script type="text/javascript">
$(document).ready(function() {
	$("#if").hide();
	$("#iif").click(function(){
		$("#if").show();
	});
	$("#iig").click(function(){
		$("#if").hide();
	});
	let m = '<?= $empresa->cidade ?>';
    let e = '<?= $empresa->estado ?>';
    let cnae = '<?= $empresa->cnae ?>';
    let codigo_cnae = '<?= $empresa->codigo_cnae ?>';
    let cnae_desc = '<?= $empresa->desc_cnae ?>';

	$("#cidade").append('<option value="'+ m +'" selected="selected">'+ m +'</option>');
    $("#estado").append('<option value="'+ e +'" selected="selected">'+ e +'</option>');
    $("#cnae").append('<option value="'+ cnae +'" selected="selected">'+ codigo_cnae +' - '+ cnae_desc +'</option>');


    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#bairro").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});
</script>