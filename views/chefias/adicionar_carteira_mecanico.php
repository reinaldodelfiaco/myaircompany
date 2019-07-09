<?php 
opanel('Adicionar habilitação');
form_open('chefias/adicionar_carteira_mecanico?id=' .get('id'));

hidden('id_mecanico',get('id'));
hidden('logged_user',session('id'));

row();
    col(9);        
        form_text_input_disabled('Mecânico', 'nome', $mecanico->nome);
    cdiv(); 
cdiv();

row();
    col(5);        
        form_select2_data('Carteira mecânico:', 'tipo', $tipos);          
    cdiv();  
    col(4);        
        form_text_input('Validade', 'validade_tipo');  
    cdiv();
    col(3);        
        button('btAdd','+ Adicionar','btn btn-success btn-block',26);
    cdiv();
cdiv();  

$carteiras = [];
ptable('Carteiras adicionadas');
datatable('carteiras', ['Carteira mecânico', 'Validade', 'Ativo'], ['nome', 'validade_tipo', 'ativo'], $habilitacoes, ['deletar' => 'chefias/deletar_habilitacao?mecanico=' . get('id') . '&id']);
cpanel();
?>
<script>
    $(document).ready(function() {
        $('#validade_tipo').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });

    $("#btAdd").click(function() {
            var carteira = $('#tipo').val();
            var validade = $('#validade_tipo').val();
            var idMecanico = $('#id_mecanico').val();
            var loggedUser = $('#logged_user').val();
            var descricao = $( "#tipo option:selected" ).text();
            descricao = descricao.substr(descricao.indexOf('-')+1, descricao.length);

            $('#tipo').val('');
            $('#validade_tipo').val('');
            
            $.post("/chefias/adicionar_carteira_mecanico",
                {
                    tipo: carteira,
                    validade_tipo: validade,
                    id_mecanico : idMecanico,
                },
                function(data, status){
                    var reg = JSON.parse(data);
                    var link = '<a style="text-decoration: none; margin-right: 2px;" href="<?= BASE ?>chefias/deletar_habilitacao?id=' + reg.id + '&mecanico=' + idMecanico + '" title="Excluir"><i class="fa fa-trash fa-lg"></i> </a>';
                    var t = $('#carteiras').DataTable();
                    t.row.add([descricao,validade,"<span class='label label-success'> SIM </span>",link]).draw( false );
                }
            ); 
           
            
    });
</script>