<?php 
opanel('Editar');
    form_open('bases_operacionais/editar_bases_operacionais?id=' .get('id'));
        row();
            col(6);
                form_text_input('Nome:', 'nome', 'required','','',$bases_operacionais->nome);
            cdiv();
            col(6);
                form_text_input('Responsável:', 'contato', '','','',$bases_operacionais->contato);
            cdiv();
        cdiv();
        row();
            col(4);
                form_text_input('Pais:', 'pais', '','','',$bases_operacionais->pais);
            cdiv();
            col(4);
                form_text_input('E-mail:', 'email', 'email','','',$bases_operacionais->email);
            cdiv();
            col(4);
                form_text_input('Telefone:', 'telefone', '','','',$bases_operacionais->telefone);
            cdiv();
        cdiv();
        row();
            col(4);
                form_text_input('Telefone (Responsável):', 'telefone_responsavel', '','','',$bases_operacionais->telefone_responsavel);
            cdiv();
            col(4);
                form_text_input('Email (Responsável):', 'email_responsavel', 'email','','',$bases_operacionais->email_responsavel);
            cdiv();
            col(4);
                form_text_input('Cep:', 'cep', '','','',$bases_operacionais->cep);
            cdiv();
        cdiv();
        row();
            col(6);
                form_text_input('Estado:', 'estado', '','','',$bases_operacionais->estado);
            cdiv();
            col(6);
                form_text_input('Cidade:', 'cidade', '','','',$bases_operacionais->cidade);
            cdiv();
        
        cdiv();
        row();
            col(6);
                form_text_input('Endereço:', 'endereco', '','','',$bases_operacionais->endereco);
            cdiv();
            col(2);
                form_int_input('Número:', 'numero', '','','',$bases_operacionais->numero);
            cdiv();
            col(4);
                form_text_input('Complemento:', 'complemento', '','','',$bases_operacionais->complemento);
            cdiv();
        cdiv();
        submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();


    
    ?>

<script type="text/javascript">
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