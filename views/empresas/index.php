<?php
modal_link('+ Adicionar', 'add');
br();
ptable('Empresas');
datatable('empresas', ['Nome', 'Contato'], ['razao_social', 'contato'], $empresas, ['editar' => 'empresas/editar?id']);
cpanel();

omodal('Nova Empresa', 'add', 'modal-lg');
form_open('empresas/index');


row();
col(12);
form_text_input('Nome da empresa', 'nome', 'required');
cdiv();
cdiv();
row();
col(4);
form_text_input('Contato', 'contato', 'required');
cdiv();

col(4);
form_text_input('E-mail', 'email', 'required|email');
cdiv();

col(4);
form_text_input('Telefone', 'telefone', 'required');
cdiv();
cdiv();
row();
col(2);
form_text_input('CEP', 'cep', 'required');
cdiv();
col(2);
form_text_input('Estado', 'estado', 'required');
cdiv();
col(4);
form_text_input('Cidade', 'cidade', 'required');
cdiv();
col(4);
form_text_input('Bairro', 'bairro', 'required');
cdiv();
cdiv();
row();

col(6);
form_text_input('Endereço', 'endereco', 'required');
cdiv();
col(2);
form_text_input('Número', 'numero', 'required');
cdiv();
col(4);
form_text_input('Complemento', 'complemento', '');
cdiv();
cdiv();
row();
col(4);
form_text_input('Limite de espaço (MB)', 'limite_espaco', 'required');
cdiv();
col(4);
form_text_input('Limite de Usuários', 'limite_usuarios', 'required');
cdiv();
col(4);
$status = [['value' => 'ativa', 'nome' => 'Ativa'], ['value' => 'bloqueada', 'nome' => 'Bloqueada']];
form_select2_data('Status', 'status', $status, 'nome');
cdiv();
cdiv();

submit('Salvar', 'btn btn-success');
form_close();
cmodal();

?>

<script type="text/javascript">
    $(document).ready(function () {
	
	$('#cep').mask('00000-00');
	$('#cnpj').mask('00.000.000/0000-00');
 	

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {

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
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

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

