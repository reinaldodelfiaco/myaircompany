<?php 
    modal_link('+ Adicionar', 'add');
    br();
    ptable('Chefias (Mecânicos)');
    datatable('chefias', ['Nome', 'Telefone', 'Email', 'Status'], ['nome', 'telefone', 'email', 'status'], $chefias, ['carteira' => 'chefias/adicionar_carteira_mecanico?id','editar' => 'chefias/editar_chefias_mecanicos?id', 'deletar' => 'chefias/deletar_mecanicos?id']);
    cpanel();
    
    omodal('Novo mecânico', 'add', 'modal-lg');
    
    form_open('chefias/mecanicos');
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
        col(4);
            form_select2_data('CMA:', 'cma', $cmaOpt);            
        cdiv();
        col(4);
            form_text_input('Validade CMA:', 'cma_validade', 'required');
        cdiv();    
        col(4);
            form_text_input('CANAC:', 'canac', 'required');
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
});


$( "form" ).submit(function() {
  if ($('#senha').val() !==  $('#senha_confirma').val()) {
    event.preventDefault();
    alert("Houve um erro na validação da senha. A senha não confere.");
  }
  return;
});

</script>