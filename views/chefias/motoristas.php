<?php 
    modal_link('+ Adicionar', 'add');
    br();
    ptable('Chefias (Motoristas)');
    datatable('chefias', ['Nome', 'Telefone', 'Email', 'Status'], ['nome', 'telefone', 'email', 'status'], $chefias, ['editar' => 'chefias/editar_chefias_motoristas?id', 'deletar' => 'chefias/deletar_motoristas?id']);
    cpanel();
    
    omodal('Novo motorista', 'add', 'modal-lg');
    
    form_open('chefias/motoristas');
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
            form_text_input('CNH:', 'cnh', 'required');
        cdiv();
        col(6);
            form_text_input('Classe CNH:', 'classe_cnh', 'required');
        cdiv();
    cdiv();

    row();
        col(6);
            form_text_input('Validade CNH:', 'validade_cnh', 'required');
        cdiv();
        col(6);
            form_text_input('Empresa Terceira:', 'empresa_terceira', '');
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

    $('#validade_cnh').datepicker({
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