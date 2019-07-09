<?php

modal_link('NOVA AGÊNCIA', 'add');
br();
ptable('Agências');

datatable('empresas', ['Código', 'Nome', 'Tipo', 'CNPJ / CPF'], ['id','nome_fantasia', 'tipop', 'cnpj_cpf'], $empresas, [
    'editar' => 'crm/editar_empresa?id',
    'inativar' => 'crm/inativar_empresa?id'
]);

cpanel();

omodal('Adicionar Agência', 'add', 'modal-lg');


form_open('crm/agencias');
hidden('empresa', session('empresa'));

$status = [['value' => 'ativa', 'nome' => 'Ativa'], ['value' => 'bloqueada', 'nome' => 'Bloqueada']];
$tipo = [['value' => 'Jurídica', 'nome' => 'Jurídica'], ['value' => 'Física', 'nome' => 'Física']];

row();
col(3);
form_checkbox('Fornecedor?', 'fornecedor', 1);
cdiv();
col(3);
form_checkbox('Agência?', 'agencia', 1, 1);
cdiv();
col(3);
form_checkbox('Cliente?', 'cliente', 1);
cdiv();
col(3);
form_checkbox('Transportadora?', 'transportadora', 1);
cdiv();
cdiv();
hr();


row();
col(2);
form_select2_data('Status', 'status', $status, 'nome');
cdiv();
col(2);
form_select2_data('Tipo', 'tipop', $tipo, 'nome');
cdiv();
col(8);
form_text_input('CNPJ / CPF', 'cnpj_cpf', '');
cdiv();
cdiv();

row();
col(12);
form_text_input('Nome', 'nome_fantasia', '');
cdiv();
cdiv();

div('', 'pjd');
row();
col(6);
form_text_input('Razão Social', 'razao_social','');
cdiv();
col(3);
form_text_input('Inscrição Munucipal', 'inscricao_municipal');
cdiv();
col(3);
form_text_input('Inscrição Estadual', 'inscricao_estadual');
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
form_text_input('Telefone', 'telefone', '');
cdiv();
cdiv();

row();
col(2);
form_text_input('CEP', 'cep', '');
cdiv();
col(2);
form_select2_ajax('crm/uf','Estado', 'estado');
cdiv();
col(4);
form_select2_ajax('crm/municipios','Cidade', 'cidade');
cdiv();
col(4);
form_text_input('Bairro', 'bairro', '');
cdiv();
cdiv();

row();
col(6);
form_text_input('Endereço', 'endereco', '');
cdiv();
col(2);
form_text_input('Número', 'numero', '');
cdiv();
col(4);
form_text_input('Complemento', 'complemento', '');
cdiv();
cdiv();

row();
col(3);
form_text_input('Agência Bancária', 'banco', '');
cdiv();
col(3);
form_select2_ajax('Conta','conta', '');
cdiv();
col(3);
form_select2_ajax('Agência','n_agencia', '');
cdiv();
cdiv();


submit('Salvar', 'btn btn-success');
form_close();

cmodal();
?>

<script>
$(document).ready(function() {
    $('#cep').mask('00000-000');
    $('#cnpj_cpf').mask('00.000.000/0000-00');
    $('#pfd').hide();
    $("#tipop").change(function(){
            let status = $(this).val();
            if(status == 'Jurídica') {
                $('#cnpj_cpf').mask('00.000.000/0000-00');
                $('#BUSCAR').show();
                $('#pjd').show();
                $('#pfd').hide();
            } else {
                $('#cnpj_cpf').mask('000.000.000-00');
                $('#BUSCAR').hide();
                $('#pjd').hide();
                $('#pfd').show();
            }
    });

    $("#razao_social").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $("#nome_fantasia").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });



    $("#cnpj_cpf").click(function() {
        var cnpj = $("#cnpj_cpf").val().replace(/\D/g, '');
        if (cnpj != "") {
            var url = "<?= BASE ?>crm/busca_empresa?cnpj=http://receitaws.com.br/v1/cnpj/" + cnpj;
            $.ajax({
                url: url,
                crossDomain: true,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $("#razao_social").val(data.nome);
                    $("#nome_fantasia").val(data.fantasia);
                    $("#cep").val(data.cep);
                    $("#endereco").val(data.logradouro);
                    $("#numero").val(data.numero);
                    $("#bairro").val(data.bairro);
                     //$("#cidade").val([data.municipio]);
                     $("#cidade").append('<option value="'+ data.municipio +'" selected="selected">'+ data.municipio +'</option>');
                    $("#estado").append('<option value="'+ data.uf +'" selected="selected">'+ data.uf +'</option>');
                    //$("#estado").val(data.uf);
                    $("#complemento").val(data.complemento);
                    $("#email").val(data.email);
                    $("#capital_social").val(data.capital_social);
                    $("#telefone").val(data.telefone);
                },
                type: 'GET'
            });

        }
    });


});
</script>