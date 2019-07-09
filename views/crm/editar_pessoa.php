<?php

opanel('Editar Pessoa Física', 'add', 'modal-lg');
form_open('crm/editar_pessoa?id=' . get('id'));
hidden('empresa', session('empresa'));
$status = [['value' => 'ativa', 'nome' => 'Ativa'], ['value' => 'bloqueada', 'nome' => 'Bloqueada']];
row();
col(8);
form_text_input('CPF', 'cpf', 'cpf','','',$fisica->cpf);
cdiv();
col(4);
form_select2_data('Status', 'status', $status, 'nome', $fisica->status);
cdiv();
cdiv();

row();
col(6);
form_text_input('Nome', 'nome', 'required','','',$fisica->nome);
cdiv();
col(6);
form_text_input('E-mail', 'email', '', '','',$fisica->email);
cdiv();
cdiv();

row();
col(6);
form_text_input('Telefone', 'telefone', '','', '',$fisica->telefone);
cdiv();
col(6);
$sexos = [['value' => 'masculino', 'nome' => 'Masculino'], ['value' => 'feminino', 'nome' => 'Feminino']];
form_select2_data('Sexo', 'sexo', $sexos, $fisica->sexo);
cdiv();
cdiv();

row();
col(2);
form_text_input('CEP', 'cep', '', '','',$fisica->cep);
cdiv();
col(2);
form_text_input('Estado', 'estado', '', '','',$fisica->estado);
cdiv();
col(4);
form_text_input('Cidade', 'cidade', '', '','',$fisica->cidade);
cdiv();
col(4);
form_text_input('Bairro', 'bairro', '', '','',$fisica->bairro);
cdiv();
cdiv();
row();

col(6);
form_text_input('Endereço', 'endereco', '', '','',$fisica->endereco);
cdiv();
col(2);
form_text_input('Número', 'numero', '', '','',$fisica->numero);
cdiv();
col(4);
form_text_input('Complemento', 'complemento', '', '','',$fisica->complemento);
cdiv();
cdiv();


submit('Salvar', 'btn btn-success');
form_close();

cmodal();
?>

<script>

    $(document).ready(function () {

        $('#cep').mask('00000-000');
        $('#cpf').mask('000.000.000-00');

        $("#nome").keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });

        $("#nome_fantasia").keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });

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
