<?php 
opanel('Editar');
    form_open('chefias/editar_chefias_motoristas?id=' .get('id'));
    
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

    row();
        col(6);
            form_text_input('CNH:', 'cnh', 'required', '','', $chefias->cnh);
        cdiv();
        col(6);
            form_text_input('Classe CNH:', 'classe_cnh', 'required', '','', $chefias->classe_cnh);
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Validade CNH:', 'validade_cnh', 'required', '','', data_br($chefias->validade_cnh));
        cdiv();
        col(6);
            form_text_input('Empresa Terceira:', 'empresa_terceira', '', '','', $chefias->empresa_terceira);
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
});

$(document).ready(function() {
    $('#validade_cnh').datepicker({
        autoclose: true,
        todayHighlight: true
    });
});

</script>