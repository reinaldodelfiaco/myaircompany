<?php 
    modal_link('+ Adicionar', 'add');
    br();
    ptable('Chefias (Pilotos)');
    datatable('chefias', ['Nome', 'Telefone', 'Email', 'Status'], ['nome', 'telefone', 'email', 'status'], $chefias, ['carteira' => 'chefias/adicionar_carteira_piloto?id', 'editar' => 'chefias/editar_chefias_pilotos?id', 'deletar' => 'chefias/deletar_pilotos?id']);
    cpanel();
    
    omodal('Novo piloto', 'add', 'modal-lg');
    
    form_open('chefias/pilotos');
    hidden('empresa', session('empresa'));

    row();
        col(12);           
            form_select2_data('Cargo:', 'cargo', $cargosSelect);  
        cdiv();  
    cdiv();

    row();
        col(8);
            form_text_input('Nome:', 'nome', 'required');
        cdiv();
        col(4);
            form_text_input('Data Nascimento:', 'data_nascimento', '');
        cdiv();
    cdiv();
    row();
        col(4);            
            form_select2_data('Tipo Documento:', 'tipo_documento', $docTipo);
        cdiv();
        col(8);
            form_text_input('Número Documento:', 'numero_documento', '');
        cdiv();
    cdiv();
    
    row();
        col(12);
            form_text_input('Email:', 'email', 'required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_password_input('Senha:', 'senha', 'required');
        cdiv();
        col(6);
            form_password_input('Confirme a Senha:', 'senha_confirma', 'required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Salário:', 'salario', '');
        cdiv();
        col(6);
            form_text_input('Telefone:', 'telefone', '');
        cdiv();
    cdiv();

    row();
        col(12);        
            form_text_input('Endereço:', 'endereco', '');
        cdiv();
    cdiv();
    
    row();
        col(6);
            form_text_input('Bairro:', 'bairro', '');
        cdiv();
        col(6);
            form_text_input('Cidade:', 'cidade', '');
        cdiv();
    cdiv();
    
    
    row();
        col(6);
            form_text_input('Estado:', 'estado', '');
        cdiv();
        col(6);
            form_text_input('País:', 'pais', '');
        cdiv();
    cdiv();
    

    row();
        col(6);            
            form_select2_data('CMA:', 'cma', $cmaOpt);
        cdiv();
        col(6);         
            form_text_input('Validade CMA:', 'cma_validade', 'required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('CANAC:', 'canac', 'required');
        cdiv();
        col(6);            
            form_select2_data('ICAO:', 'icao', $icaoOpt);            
        cdiv();
    cdiv();
    


    $td = [              
        ['nome' => 'SIM', 'value' => 'S'],
        ['nome' => 'NÃO', 'value' => 'N'],
    ];
    row();
        col(6);        
            form_select2_data('PLA:', 'pla', $td);          
        cdiv();
        col(6);        
            form_select2_data('PC:', 'pc', $td);          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('Mono:', 'mono', $td);          
        cdiv();
        col(6);        
            form_text_input('Validade Mono:', 'validade_mono');          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('Multi:', 'multi', $td);          
        cdiv();
        col(6);        
            form_text_input('Validade Multi:', 'validade_multi');          
        cdiv();
    cdiv();

    row();
        col(6);        
            form_select2_data('IFR:', 'ifr', $td);          
        cdiv();
        col(6);        
            form_text_input('Validade IFR:', 'validade_ifr');          
        cdiv();
    cdiv();


    row();
        col(6);        
            form_select2_data('INVA:', 'inva', $td);          
        cdiv();
        col(6);        
            form_text_input('Validade INVA:', 'validade_inva');          
        cdiv();
    cdiv();
    
   
    
    submit('Salvar', 'btn btn-success');

    form_close();
    cmodal();

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


$( "form" ).submit(function() {
  if ($('#senha').val() !==  $('#senha_confirma').val()) {
    event.preventDefault();
    alert("Houve um erro na validação da senha. A senha não confere.");
  }
  return;
});

</script>