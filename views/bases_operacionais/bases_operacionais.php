<?php 

    modal_link('+ Adicionar', 'add');
    br();
    ptable('Bases Operacionais');
    datatable('bases_operacionais', ['Nome', 'Estado', 'Cidade', 'Contato', 'Email', 'Telefone', ], ['nome', 'estado', 'cidade', 'contato', 'email', 'telefone', ], $bases_operacionais, ['editar' => 'bases_operacionais/editar_bases_operacionais?id', 'deletar' => 'bases_operacionais/deletar_bases_operacionais?id']);
    cpanel();
    
    omodal('Adicionar Bases Operacionais', 'add', 'modal-lg');
    form_open('bases_operacionais/bases_operacionais');

    row();
        col(6);
            form_text_input('Nome:', 'nome', 'required');
        cdiv();
        col(6);
            form_text_input('Responsável:', 'contato', '');
        cdiv();
    cdiv();
    row();
        col(4);
            form_text_input('Pais:', 'pais', '');
        cdiv();
        col(4);
            form_text_input('E-mail:', 'email', 'email');
        cdiv();
        col(4);
            form_text_input('Telefone:', 'telefone', '');
        cdiv();
    cdiv();
    row();
        col(4);
            form_text_input('Telefone (Responsável):', 'telefone_responsavel', '');
        cdiv();
        col(4);
            form_text_input('Email (Responsável):', 'email_responsavel', 'email');
        cdiv();
        col(4);
            form_text_input('Cep:', 'cep', '');
        cdiv();
    cdiv();
    row();
        col(6);
            form_text_input('Estado:', 'estado', '');
        cdiv();
        col(6);
            form_text_input('Cidade:', 'cidade', '');
        cdiv();
       
    cdiv();
    row();
        col(6);
            form_text_input('Endereço:', 'endereco', '');
        cdiv();
        col(2);
            form_int_input('Número:', 'numero', '');
        cdiv();
        col(4);
            form_text_input('Complemento:', 'complemento', '');
        cdiv();
    cdiv();
    submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();

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