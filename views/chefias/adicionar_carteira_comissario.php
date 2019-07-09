<?php 
opanel('Adicionar habilitação');
form_open('chefias/adicionar_carteira_comissario?id=' .get('id'));

hidden('id_comissario',get('id'));
hidden('logged_user',session('id'));

row();
    col(9);        
        form_text_input_disabled('Comissário', 'nome', $comissario->nome);
    cdiv(); 
cdiv();

row();
    col(5);        
        form_text_input('Carteira comissário:', 'tipo');          
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
datatable('carteiras', ['Carteira comissário', 'Validade', 'Ativo'], ['tipo_carteira', 'validade_tipo', 'ativo'], $habilitacoes, ['deletar' => 'chefias/deletar_habilitacao?comissario=' . get('id') . '&id']);
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
            var idComissario = $('#id_comissario').val();
            var loggedUser = $('#logged_user').val();
                        
            $('#tipo').val('');
            $('#validade_tipo').val('');
            
            $.post("/chefias/adicionar_carteira_comissario",
                {
                    tipo: carteira,
                    validade_tipo: validade,
                    id_comissario : idComissario,
                },
                function(data, status){
                    var reg = JSON.parse(data);
                    var link = '<a style="text-decoration: none; margin-right: 2px;" href="/chefias/deletar_habilitacao?id=' + reg.id + '&comissario=' + idComissario + '" title="Excluir"><i class="fa fa-trash fa-lg"></i> </a>';
                    var t = $('#carteiras').DataTable();
                    t.row.add([carteira,validade,"<span class='label label-success'> SIM </span>",link]).draw( false );    }
            ); 
           
            
    });
</script>