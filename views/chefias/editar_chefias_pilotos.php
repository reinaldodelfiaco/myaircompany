<?php 
opanel('Editar');
    form_open('chefias/editar_chefias_pilotos?id=' .get('id'));
    
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
            form_text_input('Validade CMA:', 'cma_validade', 'required','','', data_br($chefias->cma_validade));
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('CANAC:', 'canac', 'required', '','', $chefias->canac);
        cdiv();
        col(6);           
            form_select2_data('ICAO:', 'icao', $icaoOpt, '','', $chefias->icao);            
        cdiv();
    cdiv();
    


    $td = [              
        ['nome' => 'SIM', 'value' => 'S'],
        ['nome' => 'NÃO', 'value' => 'N'],
    ];
    row();
        col(6);        
            form_select2_data('PLA:', 'pla', $td, $chefias->pla);          
        cdiv();
        col(6);        
            form_select2_data('PC:', 'pc', $td, $chefias->pc);          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('Mono:', 'mono', $td, $chefias->mono);          
        cdiv();
        col(6);        
            form_text_input('Validade Mono:', 'validade_mono','','','', data_br($chefias->validade_mono));          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('Multi:', 'multi', $td, $chefias->multi);          
        cdiv();
        col(6);        
            form_text_input('Validade Multi:', 'validade_multi','','','', data_br($chefias->validade_multi));          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('IFR:', 'ifr', $td, $chefias->ifr);          
        cdiv();
        col(6);        
            form_text_input('Validade IFR:', 'validade_ifr','','','', data_br($chefias->validade_ifr));          
        cdiv();
    cdiv();


    row();
        col(6);        
            form_select2_data('INVA:', 'inva', $td, $chefias->inva);          
        cdiv();
        col(6);        
            form_text_input('Validade INVA:', 'validade_inva','','','', data_br($chefias->validade_inva));          
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

    $('#cma_validade').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#validade_mono').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#validade_multi').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#validade_ifr').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#validade_inva').datepicker({
        autoclose: true,
        todayHighlight: true
    });
});



</script>