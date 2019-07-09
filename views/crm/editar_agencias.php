<?php

opanel('Editar informações da agência:');
form_open('crm/editar_empresa?id=' . get('id'));


$status = [['value' => 'ativa', 'nome' => 'Ativa'], ['value' => 'bloqueada', 'nome' => 'Bloqueada']];
$tipo = [['value' => 'Jurídica', 'nome' => 'Jurídica'], ['value' => 'Física', 'nome' => 'Física']];


row();
col(2);
form_select2_data('Tipo', 'tipop', $tipo, $empresa->tipop);
cdiv();
col(2);
form_select2_data('Status', 'status', $status, $empresa->status);
cdiv();
col(8);
form_text_input('CNPJ / CPF', 'cnpj_cpf', '', '', '', $empresa->cnpj_cpf);
cdiv();
cdiv();


div('', 'pessoa');
row();
col(12);
form_text_input('Nome', 'nome_fantasia', 'required', '', '', $empresa->nome_fantasia);
cdiv();
cdiv();
cdiv();

div('', 'emp');
row();
col(6);
form_text_input('Razao Social', 'razao_social', 'required', '', '', $empresa->razao_social);
cdiv();
col(6);
form_text_input('Nome Fantasia', 'nome_fantasia', '', '', '', $empresa->nome_fantasia);
cdiv();
cdiv();

row();
col(6);
form_text_input('Inscrição Munucipal', 'inscricao_municipal','','', '',$empresa->inscricao_estadual);
cdiv();
col(6);
form_text_input('Inscrição Estadual', 'inscricao_estadual','','', '',$empresa->inscricao_estadual);
cdiv();
cdiv();


row();
col(4);
form_text_input('Contato', 'contato', 'required', '', '', $empresa->contato);
cdiv();

col(4);
form_text_input('E-mail', 'email', 'required|email', '', '', $empresa->email);
cdiv();

col(4);
form_text_input('Telefone', 'telefone', '', '', '', $empresa->telefone);
cdiv();
cdiv();
row();
col(2);
form_text_input('CEP', 'cep', '', '', '', $empresa->cep);
cdiv();
col(2);
form_select2_ajax('crm/uf','Estado', 'estado');
cdiv();
col(4);
form_select2_ajax('crm/municipios','Cidade', 'cidade');
cdiv();
col(4);
form_text_input('Bairro', 'bairro', '', '', '', $empresa->bairro);
cdiv();
cdiv();
row();

col(6);
form_text_input('Endereço', 'endereco', '', '', '', $empresa->endereco);
cdiv();
col(2);
form_text_input('Número', 'numero', '', '', '', $empresa->numero);
cdiv();
col(4);
form_text_input('Complemento', 'complemento', '', '', '', $empresa->complemento);
cdiv();
cdiv();
submit('Salvar', 'btn btn-success');
form_close();
cpanel();

?>

<script>
$(document).ready(function() {

    let m = '<?= $empresa->cidade ?>';
    let e = '<?= $empresa->estado ?>';

    //$("#cidade").val([data.municipio]);
    $("#cidade").append('<option value="'+ m +'" selected="selected">'+ m +'</option>');
    $("#estado").append('<option value="'+ e +'" selected="selected">'+ e +'</option>');
    //$("#estado").val(data.uf);


    $('#cep').mask('00000-000');
    let v = $("#tipop").val();
    if(v == 'Física') {
        $('#emp').hide();
        $('#BUSCAR').hide();
        $('#cnpj_cpf').mask('000.000.000-00');
    } else {
        $('#pessoa').hide();
        $('#cnpj_cpf').mask('00.000.000/0000-00');
    }
    $("#tipop").change(function() {
        let status = $(this).val();
        if (status == 'Jurídica') {
            $('#cnpj_cpf').mask('00.000.000/0000-00');
            $('#BUSCAR').show();
            $('#pessoa').hide();
            $('#emp').show();
          
        } else {
            $('#cnpj_cpf').mask('000.000.000-00');
            $('#BUSCAR').hide();
            $('#pessoa').show();
            $('#emp').hide();
        }
    });

    $("#razao_social").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $("#nome_fantasia").keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

    
    $("#cnpj_cpf").change(function() {
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
                    $("#cidade").val(data.municipio);
                    $("#estado").val(data.uf);
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