<?php 

    modal_link('+ Adicionar', 'add');
    br();

    row();
        col(6);
            ptable('Parâmetros');
                datatable('modelos_aeronaves', ['Sequência', 'X', 'Y', 'X2', 'Y2'], ['s', 'x', 'y', 'x2', 'y2'], $draw, [ 'deletar' => 'modelos_aeronaves/deletar_draw?id']);
                cpanel();
                
                omodal('Adicionar Parâmetros', 'add');
                form_open('modelos_aeronaves/draw?id=' .get('id'));
                    hidden('modelo', get('id'));
                    form_int_input('Sequência:', 's', 'required');
                    form_int_input('Eixo X:', 'x', 'required');
                    form_int_input('Eixo Y:', 'y', 'required');
                    form_int_input('Eixo X (2):', 'x2', 'required');
                    form_int_input('Eixo Y (2):', 'y2', 'required');
                    submit('Salvar', 'btn btn-success');
                form_close();
            cmodal();
        cdiv();
        col(6);
            opanel('Peso e Balanceamento');
                img_pub('draws/' . get('id') .'.jpg');
                
                $width=450;
                $height=500;
                
                $im = imagecreatetruecolor($width,$height);
                $gray = imagecolorallocate($im, 102, 102, 102);
                $white = imagecolorallocate($im, 255, 255, 255);
                $black = imagecolorallocate($im, 0, 0, 0);
                $blue   = imagecolorallocate($im, 0, 0, 255);
                $red    = imagecolorallocate($im, 255, 0, 0);
                $green  = imagecolorallocate($im, 0, 255, 0);
                

                //POINTS TO DRAW
                imagefill($im,0,0,$white);
                imageline($im,50,50,50,450, $black);
                imageline($im,50,450,450,450, $black);


                // Escreve eixo X
                imagestring($im, 10, 50, 460, 4500, $black);
                imagestring($im, 10, 100, 460, 5000, $black);
                imagestring($im, 10, 150, 460, 5500, $black);
                imagestring($im, 10, 200, 460, 6000, $black);
                imagestring($im, 10, 250, 460, 6500, $black);
                imagestring($im, 10, 300, 460, 7000, $black);
                imagestring($im, 10, 350, 460, 7500, $black);
                imagestring($im, 10, 400, 460, 8000, $black);


                //Escreve Eixo Y
                imagestring($im, 10, 10, 420, 1000, $black);
                imagestring($im, 10, 10, 370, 1500, $black);
                imagestring($im, 10, 10, 320, 2000, $black);
                imagestring($im, 10, 10, 270, 2500, $black);
                imagestring($im, 10, 10, 220, 3000, $black);
                imagestring($im, 10, 10, 170, 3500, $black);
                imagestring($im, 10, 10, 120, 4000, $black);
                imagestring($im, 10, 10, 70, 4500, $black);


                foreach($draw as $d) {
                    imageline($im,$d->x,$d->y,$d->x2,$d->y2, $black);
                }
                
            
                
                imagejpeg($im,"uploads/draws/" . get('id').".jpg",100);
                imagedestroy($im);

            cpanel();
        cdiv();
    cdiv();


   