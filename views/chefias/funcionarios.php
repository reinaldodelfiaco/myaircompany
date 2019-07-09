<?php 
    modal_link('+ Adicionar', 'add');
    br();
    ptable('Chefias (Funcionários)');
    datatable('chefias', ['Nome', 'Telefone', 'Email', 'Status'], ['nome', 'telefone', 'email', 'status'], $chefias, ['editar' => 'chefias/editar_chefias?id', 'deletar' => 'chefias/deletar_funcionarios?id']);
    cpanel();
    
    omodal('Novo funcionário', 'add', 'modal-lg');
    
    form_open('chefias/funcionarios');
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

    $('#salario').mask('000.000.000.000.000,00', {
        reverse: true
    });


    $("#numero_documento").mask('0000000000000');
    $('#tipo_documento').change(function (e) { 
        if($(this).val() == 'RG') {
            $("#numero_documento").mask('0000000000000');
        }
        if($(this).val() == 'CPF') {
            $("#numero_documento").mask('000.000.000-00');
        }
     
        
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