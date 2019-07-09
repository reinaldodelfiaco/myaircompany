<?php

function form_open($action, $method = null, $enctype = null, $class = null, $id = null)
{
    if (!$method) $method = 'POST';
    if (!$class) $class = 'form account-form';
    if ($enctype) $enctype = 'enctype="multipart/form-data"';

    echo '<form class="' . $class . '" method="' . $method . '" id="' . $id . '" action="' . BASE . $action . '" ' . $enctype . '>';

}

function form_close()
{

    echo '</form>';
}

function form_checkbox_sup($label, $name, $value, $checked = "")
{
    echo '<div class="form-group">
              <label class="text-semibold">' . $label . '</label>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="' . $name . '" value="' . $value . '" ' . $checked . '>
                </label>
              </div>
        </div>';
}

function form_checkbox($label, $name, $value, $data = null)
{
    if($value == $data) {
        $checked = 'checked';
    } else {
        $checked = '';
    }


    echo '<label>
                <input type="checkbox" name="' . $name . '" id="' . $name . '" value="' . $value . '" '.$checked.'>
                    ' . $label . '
          </label>';

}

function form_text_input($label, $name, $data_validator = null, $server = null, $class = null, $value = null)
{

    if (isset($_POST[$name])) {
        $value = $_POST[$name];
    } elseif (!empty($value)) {
        $value = $value;
    } else {
        $value = '';
    }

    if (isset($data_validator)) {
        $rules = 'data-validation="' . $data_validator . '" ';

        if (isset($server)) {
            $rules .= 'data-validation-url="' . BASE . $server . '" ';
        }
    } else {
        $rules = '';
    }

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <input type="text" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" ' . $rules . ' autocomplete="off">
          </div>';
}

function form_text_input_disabled($label, $name, $value = null)
{   

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <input type="text" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" autocomplete="off" readonly>
          </div>';
}


function form_int_input($label, $name, $data_validator = null, $server = null, $class = null, $value = null)
{

    if (isset($_POST[$name])) {
        $value = $_POST[$name];
    } elseif (!empty($value)) {
        $value = $value;
    } else {
        $value = '';
    }

    if (isset($data_validator)) {
        $rules = 'data-validation="' . $data_validator . '" ';

        if (isset($server)) {
            $rules .= 'data-validation-url="' . BASE . $server . '" ';
        }
    } else {
        $rules = '';
    }

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <input type="number" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" ' . $rules . ' autocomplete="off">
          </div>';
}

function form_file_input($label, $name, $data_validator = null, $server = null, $class = null, $value = null)
{

    if (isset($_POST[$name])) {
        $value = $_POST[$name];
    } elseif (!empty($value)) {
        $value = $value;
    } else {
        $value = '';
    }

    if (isset($data_validator)) {
        $rules = 'data-validation="' . $data_validator . '" ';

        if (isset($server)) {
            $rules .= 'data-validation-url="' . BASE . $server . '" ';
        }
    } else {
        $rules = '';
    }

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <input type="file" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" ' . $rules . '>
          </div>';
}

function form_password_input($label, $name, $data_validator = null, $server = null, $class = null, $value = null)
{

    if (isset($_POST[$name])) {
        $value = $_POST[$name];
    } elseif (!empty($value)) {
        $value = $value;
    } else {
        $value = '';
    }

    if (isset($data_validator)) {
        $rules = 'data-validation="' . $data_validator . '" ';

        if (isset($server)) {
            $rules .= 'data-validation-url="' . BASE . $server . '" ';
        }
    } else {
        $rules = '';
    }

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <input type="password" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" ' . $rules . ' autocomplete="off">
          </div>';
}



function submit($name, $class = null, $mt = null)
{
    $style = '';
    if ($mt > 0) {
        $style = 'style="margin-top: ' . $mt . 'px;"';
    }
    echo '<div class="form-group">
        <input type="submit" class="' . $class . '" value="' . $name . '" ' . $style . '>
    </div>';
}

function button($id = '' , $name, $class = null, $mt = null)
{
    $style = '';
    if ($mt > 0) {
        $style = 'style="margin-top: ' . $mt . 'px;"';
    }

    $tagId = '';
    if ($id != '') {
        $tagId = 'id="' . $id . '"';
    }
    
    echo '<div class="form-group">
        <input type="button" ' . $tagId . ' class="' . $class . '" value="' . $name . '" ' . $style . '>
    </div>';
}

function dropdown($options) {

    if ($options && array_key_exists('drop_id', $options) && array_key_exists('menu_itens', $options) ) {

        $mt = array_key_exists('mt', $options) ? $options['mt'] : "28";
        if ($mt > 0) {
            $style = 'style="margin-top: ' . $mt . 'px;"';
        }

        $menu_itens = "";
        foreach ($options['menu_itens'] as $item) {
            $menu_itens = $menu_itens . '<li><a href="#" id="' . $item['id'] . '" >' . $item['text'] . '</a></li>';
        }
                
        echo '<div class="dropdown">
                <button ' . $style  . ' class="btn btn-secondary dropdown-toggle" type="button" id="dropdown_' . $options['drop_id'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    ' . $options['drop_text'] . '
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdown_' . $options['drop_id'] . '">
                        ' . $menu_itens . '               
                </ul>
            </div>';

    } else {
        echo '<span class="text-danger"> Erro: Não foi possível gerar o componente.</span>';
    }
}

function hidden($name, $value)
{
    echo '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '">';
}

/**
 * Datalist com informacoes uteis
 *
 * @param Options   $options  Parametros de configuração do datalist, seguem o seguinte padrão
 *                            options = { id : <id do datalist>,                                        
 *                                        link_api : <url da api de consulta>,    
 *                                        search_field : <parametro de consulta a ser enviado para a api>,
 *                                        method : "GET | POST",
 *                                        campoNome : <nome do objeto de retorno da consulta a URL da API>,
 *                                        campoId :  <id do objeto de retorno da consulta a URL da API>,
 *                                        data_type : "XML | JSON"
 *                             }
 *  
 * @return datalist
 */ 
function datalist($options) {

    if ($options && array_key_exists('id', $options)) {       


        $param = "";
        if($options['method'] === "GET") {

            if (array_key_exists('search_field', $options)) {
                $param = 'url: "' . $options['link_api'] . '?' . $options['search_field'] . '=" + $("#' . $options['id'] . '").val(),' ;
            } else {
                $param = 'url: "' . $options['link_api'] . '"';  
            }
        
        } else if($options['method'] === "POST") {
            $param = 'url: "' . $options['link_api'] . '",                        
                    data: {
                        ' . $options['search_field'] . ': $("#' . $options['id'] . '").val()
                    },';

        } else {
            echo '<span class="text-danger"> Erro: Método de consulta não encontrado.</span>';
            return;
        }
        
        echo '            
            <datalist id="'. $options['id'] . '"></datalist>
                                       
            <script type="text/javascript" >
                $( function() {

                    $.ajax({
                        type: "' . $options['method'] .  '",
                        dataType: "' . $options['data_type'] .  '",'
                        
                        . $param .

                        ',success: function(data) {


                            
                            var dataList = document.getElementById("'. $options['id'] . '"); 
                            if ("' . $options['data_type'] . '" === "XML") {   
                                $(data).find("item").each(function(){
                                    var id = $(this).find("'. $options['campoId'] . '").text();
                                    var nome = $(this).find("' . $options['campoNome']  . '").text();                            
                                    var option = document.createElement("option"); 

                                    if (id != "") {
                                        option.value = $.trim(id + " - " + nome);
                                    } else {
                                        option.value = $.trim(nome);
                                    }
                                    dataList.append(option);
                                });

                            } else {
                            
                                data.map(object => {
                                    var option = document.createElement("option"); 

                                    if (object["'. $options['campoId'] . '"] != "") {
                                        option.value = $.trim(object["' . $options['campoNome']  . '"] + " - " + object["'. $options['campoId'] . '"]);
                                    } else {
                                        option.value = $.trim(object["' . $options['campoNome']  . '"]);
                                    }
                                    dataList.append(option);
                                    return;
                                }); 
                                
                            }                     
                        }
                    });
                                    
                });
            </script>';

    } else {
        echo '<span class="text-danger"> Erro: Id não definido.</span>';
    }
}

/**
 * Form Input que utiliza um datalist para realizar a função autocomplete
 *
 * @param Options   $options  Parametros de configuração do Input, seguem o seguinte padrão
 *                            options = { id : <id do input>,
 *                                        name (opcional) : <name do input>,
 *                                        label : <texto do label>,
 *                                        placeholder : <texto do placeholder>,
 *                                        disabled (opcional) : "disabled | none",
 *                                        datalist : <id do datalist>,
 *                                        value : <valor inicial do input>
 *                             }
 *  
 * @return input
 */ 
function form_input_autocomplete($options) {
    
    if ($options && array_key_exists('id', $options) && array_key_exists('datalist', $options)) { 

        $nomeComponente = array_key_exists('name', $options) ? $options['name'] : $options['id'];
        $valorComponente = array_key_exists('value', $options) ? $options['value'] : "";
        $placeholderComponente = array_key_exists('placeholder' , $options) ? $options['placeholder'] : "Insira um valor";
        $isDisabled = $options['disabled'] === "disabled" ? $options['disabled'] : "";
      
        echo '            
            <div class="form-group">
                <label for="' . $nomeComponente . '">' . $options['label'] . '</label>

                <input type="text" name="' . $nomeComponente . '" class="form-control" id="' . $options['id'] . 
                '" value="' . $valorComponente . '" autocomplete="off" ' . $isDisabled . 
                ' placeholder="' . $placeholderComponente  . '" list="' . $options['datalist'] . '">      
                               
            </div>';            

    } else {
        echo '<span class="text-danger"> Erro: Não foi possível criar o Input Autocomplete. Campo e/ou Id e/ou Datalist não definido.</span> <br/>';
    }
}


function form_select2($label, $name, $data, $fielddata, $value = null)
{
    $options = '';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d->id == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->$fielddata . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_select2_ajax_value($link, $label, $name, $value = null, $table = null, $field = null)
{
    if(isset($table)) {
        $db = new db();
        $d = $db->row("SELECT * FROM " . $table. " WHERE id = " . $value);
    }

    if($d) {
        $option = "<option value='".$value."'>".$d->$field."</option>";
    }
    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
            '.$option.'
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2({
              ajax: { 
               url: "'.BASE.$link.'",
               type: "post",
               dataType: \'json\',
               delay: 250,
               data: function (params) {
                return {
                  searchTerm: params.term 
                };
               },
               processResults: function (response) {
                 return {
                    results: response
                 };
               },
               cache: true
              }
             });
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_select2_ajax($link, $label, $name, $method='POST')
{

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2({
              ajax: { 
               url: "'.BASE.$link.'",
               type: "'. $method . '",
               dataType: \'json\',
               delay: 250,
               data: function (params) {
                return {
                  searchTerm: params.term 
                };
               },
               processResults: function (response) {
                 return {
                    results: response
                 };
               },
               cache: true
              }
             });
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_select2_ajaxs($link, $label, $name, $value, $table, $field, $n)
{   
    $db = new Db();

    $c = $db->row("SELECT * FROM " . $table ." WHERE ". $field . " = '".$value."'");

    if($c) {
        $nome = $c->$n;
    } else {
        $nome = 'N/A';
    }


    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>
          <select id="' . $name . '" name="' . $name . '" class="form-control">
            <option value="'.$value.'">'.$nome.'</option>
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2({
              ajax: { 
               url: "'.BASE.$link.'",
               type: "post",
               dataType: \'json\',
               delay: 250,
               data: function (params) {
                return {
                  searchTerm: params.term 
                };
               },
               processResults: function (response) {
                 return {
                    results: response
                 };
               },
               cache: true
              }
             });
              $(".select2").removeAttr("style");
            })
        </script>';
}




function form_select2_blank($label, $name, $data, $fielddata, $value = null)
{
    $options = '<option value="" > - </option>';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d->id == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->$fielddata . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}


function form_select2_multiple($label, $name, $data, $fielddata, $value = [])
{
    $options = '';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            foreach ($value as $v) {
                if ($d->id == $v->categoria) {
                    $selected = 'selected';
                }
            }
        }

        $options .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->$fielddata . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select multiple="" id="' . $name . '" name="' . $name . '[]" class="form-control">
              ' . $options . '
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_select($label, $name, $data, $fielddata, $value = null)
{
    $options = '';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d->id == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->$fielddata . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
          </select>
        </div>';
}

function form_select_blank($label, $name, $data, $fielddata, $value = null)
{
    $options = '<option value=""> - </option>';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d->id == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d->id . '" ' . $selected . '>' . $d->$fielddata . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
          </select>
        </div>';
}

function form_select2_data($label, $name, $data, $value = null)
{

    $options = '';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d['value'] == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d['value'] . '" ' . $selected . '>' . $d['nome'] . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
            </optgroup>
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_select2_data_multiple($label, $name, $data, $value = null)
{

    $options = '';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d['value'] == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d['value'] . '" ' . $selected . '>' . $d['nome'] . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control" multiple>
              ' . $options . '
            </optgroup>
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}


function form_select2_data_blank($label, $name, $data, $value = null)
{

    $options = '<option value=""> - </option>';
    foreach ($data as $d) {
        $selected = '';
        if (!empty($value)) {
            if ($d['value'] == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
        }

        $options .= '<option value="' . $d['value'] . '" ' . $selected . '>' . $d['nome'] . '</option>';
    }

    echo '<div class="form-group">
        <label for="' . $name . '">' . $label . '</label>

          <select id="' . $name . '" name="' . $name . '" class="form-control">
              ' . $options . '
            </optgroup>
          </select>
        </div>

        <script type="text/javascript">
            $(function () {
              $("#' . $name . '").select2();
              $(".select2").removeAttr("style");
            })
        </script>';
}

function form_textarea($label, $name, $data_validator = null, $server = null, $class = null, $value = null)
{

    if (isset($_POST[$name])) {
        $value = $_POST[$name];
    } elseif (!empty($value)) {
        $value = $value;
    } else {
        $value = '';
    }

    if (isset($data_validator)) {
        $rules = 'data-validation="' . $data_validator . '" ';

        if (isset($server)) {
            $rules .= 'data-validation-url="' . BASE . $server . '" ';
        }
    } else {
        $rules = '';
    }

    echo '<div class="form-group">
            <label for="' . $name . '">' . $label . '</label>
            <textarea style="height:125px" name="' . $name . '" class="form-control"  id="' . $name . '"' . $rules . '>' . $value . '</textarea>
          </div>';
}
