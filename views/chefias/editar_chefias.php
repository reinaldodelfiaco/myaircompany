<?php 
opanel('Editar');
    form_open('chefias/editar_chefias?id=' .get('id'));
    
row();
        col(12);            
            form_select2_data('Cargo:', 'cargo', $cargosSelect, $chefias->cargo);  
        cdiv();  
    cdiv();

    row();
        col(8);
            form_text_input('Nome:', 'nome', 'required',null,null,$chefias->nome);
        cdiv();
        col(4);
            form_text_input('Data Nascimento:', 'data_nascimento', '','','', data_br($chefias->data_nascimento));
        cdiv();
    cdiv();
    row();
        col(4);
            form_select2_data('Tipo Documento:', 'tipo_documento', $docTipo, $chefias->tipo_documento);
        cdiv();
        col(8);
            form_text_input('Número Documento:', 'numero_documento', '','','', $chefias->numero_documento);
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_text_input('Email:', 'email', 'required','','', $chefias->email);
        cdiv();
    cdiv();
   

    row();
        col(6);
            form_text_input('Salário:', 'salario', '', '','', $chefias->salario);
        cdiv();
        col(6);
            form_text_input('Telefone:', 'telefone', '','','', $chefias->telefone); 
        cdiv();
    cdiv();

    row();
        col(12);     
            form_text_input('Endereço:', 'endereco', '','','', $chefias->endereco);
        cdiv();
    cdiv();
    
    row();
        col(6);
            form_text_input('Bairro:', 'bairro', '', '','', $chefias->bairro);
        cdiv();
        col(6);
            form_text_input('Cidade:', 'cidade', '', '','', $chefias->cidade);
        cdiv();
    cdiv();
    
    
    row();
        col(6);
            form_text_input('Estado:', 'estado', '', '','', $chefias->estado);
        cdiv();
        col(6);
            form_text_input('País:', 'pais', '', '','', $chefias->pais);
        cdiv();
    cdiv();
    
    

submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();
?>
<script>
$(document).ready(function() {
    $('#data_nascimento').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    if($("#tipo_documento").val() == 'RG') {
        $("#numero_documento").mask('0000000000');
    }   
    if($("#tipo_documento").val() == 'CPF') {
        $("#numero_documento").mask('000.000.00-00');;
    }   

    $('#salario').mask('000.000.000.000.000,00', {
        reverse: true
    });

    $('#tipo_documento').change(function (e) { 
        if($(this).val() == 'RG') {
            $("#numero_documento").mask('0000000000');
        }
        if($(this).val() == 'CPF') {
            $("#numero_documento").mask('000.000.00-00');
        }
            
    });
});

</script>