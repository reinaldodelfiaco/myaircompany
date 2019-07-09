<?php
echo 'Starting generator' . PHP_EOL;

$class = $argv[1];
$fields = $argv[2];
$fields = str_replace('"', '', $fields);
$array_fields = explode(',', $fields);
$dtable_f = '';
$dtable_v = '';

//CREATE SQL
$sql = 'CREATE TABLE IF NOT EXISTS ' . $class . ' (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ';

$val = '';
$forms = '';
$forms_update = '';
foreach ($array_fields as $af) {
    $commands = explode(":", $af);
    $name = $commands[0];
    if ($commands[1] == 'string') {
        $type = ' VARCHAR(255),';
    }
    if ($commands[1] == 'integer') {
        $type = ' INT,';
    }
    if ($commands[1] == 'date') {
        $type = ' DATE,';
    }
    if ($commands[1] == 'datetime') {
        $type = ' DATETIME,';
    }
    if ($commands[1] == 'timestamp') {
        $type = ' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,';
    }
    if ($commands[1] == 'text') {
        $type = ' TEXT,';
    }
    $sql .= $name . $type . PHP_EOL;
    $forms .= "form_text_input('" . ucfirst($name) . ":', '" . $name . "', '');" . PHP_EOL;
    $forms_update .= "form_text_input('" . ucfirst($name) . ":', '" . $name . "', '','','', $" . $class . "->" . $name . ");" . PHP_EOL;
    //GERA VALIDAÇÃO
    if (isset($commands['2'])) {
        $val .= "\$this->val->name('" . $name . "')->value(post('" . $name . "'))->required();" . PHP_EOL;
    }

    //DATATABLE NAMES
    $dtable_f .= "'" . ucfirst($name) . "', ";
    //DATATABLE VALUES
    $dtable_v .= "'" . $name . "', ";
}

$sql .= ');';
echo $sql;


//GERAR CLASS
$code = "<?php ";
$code .= "class " . $class . " { ";

// GERA CONSTRUTOR
$code .= '
    
    public $val;
    public $db; 

    public function __construct() 
    { 
        $this->val = new validator();
        $this->db = new db();
    }';

//GERA DELETE
$code .= '
    public function deletar_' . $class . '() 
    {' . PHP_EOL . ' 
    
        $this->db->delete("' . $class . '", [id=> get(\'id\')]);
        flash("success", "' . $class . ' removido com sucesso.");
        return redirect("' . $argv[3] . '/' . $class . '"); 
    }
';

//GERA UPDATE
$code .= '
    public function editar_' . $class . '() 
    {
        if(is_post()) 
        {
            ' . $val . ' 
            if($this->val->isSuccess())
            {
                $this->db->update("' . $class . '",copy_post(), [\'id\'=> get(\'id\')]);
                flash("success", "' . $class . ' atualizado com sucesso.");
                return redirect("' . $argv[3] . '/' . $class . '"); 
            }
        }

        $' . $class . ' = $this->db->row("SELECT * FROM ' . $class . ' WHERE id = " . get(\'id\')); 

        return view("' . $argv[3] . '/editar_' . $class . '", [
            \'' . $class . '\' => $' . $class . ',
        ]);
    }
    ';
//GERA INSERT

//GERA INDEX
$code .= '
    public function ' . $class . '()
    {
        if(is_post()) 
        {
            ' . $val . ' 
            if($this->val->isSuccess())
            {
                $this->db->insert("' . $class . '",copy_post());
                flash("success", "' . $class . ' adicionado com sucesso.");
                return redirect("' . $argv[3] . '/' . $class . '"); 
            }
        }

        $' . $class . ' = $this->db->table("SELECT * FROM ' . $class . '");

        return view("' . $argv[3] . '/' . $class . '", [
            \'' . $class . '\' => $' . $class . ',
        ]);
    }
    ';


$code .= PHP_EOL . "}";


$class_file = fopen("class/" . $class . ".php", "w") or die("Unable to open file!");
fwrite($class_file, $code);


// GERAR VIEWS

//INDEX
$code_index = "<?php " . PHP_EOL . "
    modal_link('+ Adicionar', 'add');
    br();
    ptable('" . ucfirst($class) . "');
    datatable('" . $class . "', [" . $dtable_f . "], [" . $dtable_v . "], $" . $class . ", ['editar' => '" .  $argv[3] . "/editar_" .  $class . "?id', 'deletar' => '" .  $argv[3] . "/deletar_" . $class . "?id']);
    cpanel();
    
    omodal('Adicionar " . $class . "', 'add');
    form_open('" . $argv[3] . "/" . $class . "');";

$code_index .= $forms;
$code_index .= "submit('Salvar', 'btn btn-success');
    form_close();
    cmodal();";


mkdir("views/" .  $argv[3], 0700);
$class_file = fopen("views/" . $argv[3] . "/" . $class . ".php", "w") or die("Unable to open file!");
fwrite($class_file, $code_index);

//UPDATE

$code_update = "<?php " . PHP_EOL;
$code_update .= "opanel('Editar');
    form_open('" .  $argv[3] . "/editar_" . $class . "?id=' .get('id'));";
$code_update .= $forms_update;
$code_update .= "submit('Salvar', 'btn btn-success'); 
    form_close();
    cpanel();";

$class_file = fopen("views/" . $argv[3] . "/editar_" . $class . ".php", "w") or die("Unable to open file!");
fwrite($class_file, $code_update);


