<?php
	br();
	opanel('Editar empresa: ' . $empresa->razao_social);
		form_open('empresas/editar?id=' . get('id'));

			$status = [['value' => 'ativa', 'nome' => 'Ativa'], ['value' => 'bloqueada', 'nome' => 'Bloqueada']];

			row();
				col(12);
					form_text_input('Nome da empresa', 'nome', 'required','','', $empresa->razao_social);
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
					form_text_input('Estado', 'estado', 'required','','',$empresa->estado);
				cdiv();
				col(4);
					form_text_input('Cidade', 'cidade', 'required','','',$empresa->cidade);
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
			row();
				col(4);
					form_select2_data('Status', 'status', $status, $empresa->status);
				cdiv();
			cdiv();

			submit('Salvar', 'btn btn-success');
		form_close();

	cpanel();
				

?>

<script type="text/javascript" >
    $(document).ready(function() {

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
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
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

