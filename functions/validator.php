<?php

/**
 * Validation
 *
 * Semplice classe PHP per la validazione.
 *
 * @author Davide Cesarano <davide.cesarano@unipegaso.it>
 * @copyright (c) 2016, Davide Cesarano
 * @license https://github.com/davidecesarano/Validation/blob/master/LICENSE MIT License
 * @link https://github.com/davidecesarano/Validation
 */

class validator {

    /**
     * @var array $patterns
     */
    public $patterns = array(
        'uri'           => '[A-Za-z0-9-\/_?&=]+',
        'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha'         => '[\p{L}]+',
        'words'         => '[\p{L}\s]+',
        'alphanum'      => '[\p{L}0-9]+',
        'int'           => '[0-9]+',
        'float'         => '[0-9\.,]+',
        'tel'           => '[0-9+\s()-]+',
        'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address'       => '[\p{L}0-9\s.,()°-]+',
        'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+'
    );

    /**
     * @var array $errors
     */
    public $errors = array();

    /**
     * Nome del campo
     *
     * @param string $name
     * @return this
     */
    public function name($name){

        $this->name = $name;
        return $this;

    }

    /**
     * Valor del campo
     *
     * @param mixed $value
     * @return this
     */
    public function value($value){

        $this->value = $value;
        return $this;

    }

    /**
     * File
     *
     * @param mixed $value
     * @return this
     */
    public function file($value){

        $this->file = $value;
        return $this;

    }

    /**
     * Pattern da applicare al riconoscimento
     * dell'espressione regolare
     *
     * @param string $name nome del pattern
     * @return this
     */
    public function pattern($name){

        if($name == 'array'){

            if(!is_array($this->value)){
                $this->errors[] = 'Formato do campo '.$this->name.' inválido.';
            }

        }else{

            $regex = '/^('.$this->patterns[$name].')$/u';
            if($this->value != '' && !preg_match($regex, $this->value)){
                $this->errors[] = 'Formato do campo '.$this->name.' inválido.';
            }

        }
        return $this;

    }

    /**
     * Pattern personalizzata
     *
     * @param string $pattern
     * @return this
     */
    public function customPattern($pattern){

        $regex = '/^('.$pattern.')$/u';
        if($this->value != '' && !preg_match($regex, $this->value)){
            $this->errors[] = 'Formato do campo '.$this->name.' inválido.';
        }
        return $this;

    }

    /**
     * Campo obbligatorio
     *
     * @return this
     */
    public function required(){

        if((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)){
            $this->errors[] = 'Campo '.$this->name.' é obrigatório.';
        }
        return $this;

    }

    public function unique($table, $field){
        
        $db = new db();
        $check = $db->row('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = "'.$this->value.'"');
        if((isset($check))){
            $this->errors[] = 'Campo '.$this->name.' já está cadastrado em nosso sistema.';
        }
        return $this;

    }

    /**
     * Lunghezza minima
     * del Valor del campo
     *
     * @param int $min
     * @return this
     */
    public function min($length){

        if(is_string($this->value)){

            if(strlen($this->value) < $length){
                $this->errors[] = 'Valor do campo '.$this->name.' abaixo do mínimo';
            }

        }else{

            if($this->value < $length){
                $this->errors[] = 'Valor do campo '.$this->name.' abaixo do mínimo';
            }

        }
        return $this;

    }

    /**
     * Lunghezza massima
     * del Valor del campo
     *
     * @param int $max
     * @return this
     */
    public function max($length){

        if(is_string($this->value)){

            if(strlen($this->value) > $length){
                $this->errors[] = 'Valor do campo '.$this->name.' superiore al Valor massimo';
            }

        }else{

            if($this->value > $length){
                $this->errors[] = 'Valor do campo '.$this->name.' superiore al Valor massimo';
            }

        }
        return $this;

    }

    /**
     * Confronta con il Valor di
     * un altro campo
     *
     * @param mixed $value
     * @return this
     */
    public function equal($value){

        if($this->value != $value){
            $this->errors[] = 'Valor do campo '.$this->name.'não corresponde.';
        }
        return $this;

    }

    /**
     * Dimensione massima del file
     *
     * @param int $size
     * @return this
     */
    public function maxSize($size){

        if($this->file['error'] != 4 && $this->file['size'] > $size){
            $this->errors[] = 'O arquivo '.$this->name.' excede o tamanho máximo de  '.number_format($size / 1048576, 2).' MB.';
        }
        return $this;

    }

    /**
     * Estensione (formato) del file
     *
     * @param string $extension
     * @return this
     */
    public function ext($extension){

        if($this->file['error'] != 4 && pathinfo($this->file['name'], PATHINFO_EXTENSION) != $extension && strtoupper(pathinfo($this->file['name'], PATHINFO_EXTENSION)) != $extension){
            $this->errors[] = 'O arquivo '.$this->name.' não é '.$extension.'.';
        }
        return $this;

    }

    /**
     * Purifica per prevenire attacchi XSS
     *
     * @param string $string
     * @return $string
     */
    public function purify($string){
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Campi validati
     *
     * @return boolean
     */
    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    /**
     * Errori della validazione
     *
     * @return array $this->errors
     */
    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }

    /**
     * Visualizza errori in formato Html
     *
     * @return string $html
     */
    public function displayErrors(){

        $html = '<ul>';
        foreach($this->getErrors() as $error){
            $html .= '<li>'.$error.'</li>';
        }
        $html .= '</ul>';

        return $html;

    }

    /**
     * Visualizza risultato della validazione
     *
     * @return booelan|string
     */
    public function result(){

        if(!$this->isSuccess()){

            foreach($this->getErrors() as $error){
                echo "$error\n";
            }
            exit;

        }else{
            return true;
        }

    }

    /**
     * Verifica se il Valor è
     * un numero intero
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_int($value){
        if(filter_var($value, FILTER_VALIDATE_INT)) return true;
    }

    /**
     * Verifica se il Valor è
     * un numero float
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_float($value){
        if(filter_var($value, FILTER_VALIDATE_FLOAT)) return true;
    }

    /**
     * Verifica se il Valor è
     * una lettera dell'alfabeto
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_alpha($value){
        if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z]+$/")))) return true;
    }

    /**
     * Verifica se il Valor è
     * una lettera o un numero
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_alphanum($value){
        if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z0-9]+$/")))) return true;
    }

    /**
     * Verifica se il Valor è
     * un url
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_url($value){
        if(filter_var($value, FILTER_VALIDATE_URL)) return true;
    }

    /**
     * Verifica se il Valor è
     * un uri
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_uri($value){
        if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[A-Za-z0-9-\/_]+$/")))) return true;
    }

    /**
     * Verifica se il Valor è
     * true o false
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_bool($value){
        if(filter_var($value, FILTER_VALIDATE_BOOLEAN)) return true;
    }

    /**
     * Verifica se il Valor è
     * un'e-mail
     *
     * @param mixed $value
     * @return boolean
     */
    public static function is_email($value){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
    }

}