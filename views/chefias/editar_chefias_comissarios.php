<?php 
opanel('Editar');
    form_open('chefias/editar_chefias_comissarios?id=' .get('id'));
    
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
            form_select2_data('CMA:', 'cma', $cmaOpt, $chefias->cma);
        cdiv();
        col(6);         
            form_text_input('Validade CMA:', 'cma_validade', 'required', '','', data_br($chefias->cma_validade));
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('CANAC:', 'canac', 'required', '', '', $chefias->canac);
        cdiv();
        col(6);            
            form_select2_data('ICAO:', 'icao', $icaoOpt, $chefias->icao);            
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
    $('#cma_validade').datepicker({
        autoclose: true,
        todayHighlight: true
    });
});

</script>