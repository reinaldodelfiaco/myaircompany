<?php 
opanel('Adicionar habilitação');
form_open('chefias/adicionar_carteira_piloto?id=' .get('id'));

hidden('id_piloto',get('id'));
hidden('logged_user',session('id'));

row();
    col(9);        
        form_text_input_disabled('Piloto', 'nome', $piloto->nome);
    cdiv(); 
cdiv();

row();
    col(5);        
        form_text_input('Carteira aeronave (Tipo ICAO):', 'tipo_icao');  
    cdiv();  
    col(4);        
        form_text_input('Validade', 'data_validade');  
    cdiv();
    col(3);        
        button('btAdd','+ Adicionar','btn btn-success btn-block',26);
    cdiv();
cdiv();  

$carteiras = [];
ptable('Carteiras adicionadas');
datatable('carteiras', ['Carteira aeronave (Tipo ICAO)', 'Validade', 'Ativo'], ['tipo_icao', 'data_validade', 'ativo'], $habilitacoes, ['deletar' => 'chefias/deletar_habilitacao?piloto=' . get('id') . '&id']);
cpanel();
?>
<script>
    $(document).ready(function() {
        $('#data_validade').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });

    $("#btAdd").click(function() {
            var carteira = $('#tipo_icao').val();
            var validade = $('#data_validade').val();
            var idPiloto = $('#id_piloto').val();
            var loggedUser = $('#logged_user').val();
            
            $('#tipo_icao').val('');
            $('#data_validade').val('');

            if(carteira.length > 9) {
                alert('O campo Carteira Aeronave, pode ter no máximo 9 caracteres.');
                return;
            }

            $.post("<?= BASE ?>chefias/adicionar_carteira_piloto",
                {
                    tipo_icao: carteira,
                    data_validade: validade,
                    id_user_update : loggedUser,
                    id_chefias : idPiloto,
                },
                function(data, status){
                    var reg = JSON.parse(data);
                    var link = '<a style="text-decoration: none; margin-right: 2px;" href="/chefias/deletar_habilitacao?id=' + reg.id + '&piloto=' + idPiloto + '" title="Excluir"><i class="fa fa-trash fa-lg"></i> </a>';
                    var t = $('#carteiras').DataTable();
                    t.row.add([carteira,validade,"<span class='label label-success'> SIM </span>",link]).draw( false );
                }
            ); 
           
            
    });
</script>