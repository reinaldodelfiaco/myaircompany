<?php

function view($view, $data = null, $layout = null)
{
    if (!empty($data)) extract($data);
    if (empty($layout)) $layout = 'app';
    $_view = require_var($view, $data);
    include './views/' . $layout . '.php';
}

function to_json($base, $fields = [])
{
    $data = [];

    foreach ($base as $d) {
        foreach ($fields as $f) {
            #echo $d->$f;
        }
    }

    return '
    {
        "data": [
             "Garrett Winters",
              "Accountant",
              "Tokyo",
              "8422",
              "2011/07/25",
              "$170,750"
        ]
    }
  ';

}

function redirect($url)
{
    return header('Location: ' . BASE . $url);
}

function is_post()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return true;
    }

    return false;
}

function retorna_total($t)
{
    foreach($t as $vtp) {
        $total = $vtp->total;
    }

    return $total;
}

function copy_post()
{
    $array = [];
    foreach ($_POST as $key => $value) {
        
        if (!empty($value)) {
                
                if($key == 'data') 
                {   
                    $array[$key] = data_en($value);
                }

                if($key == 'preco') 
                {   
                    $array[$key] = moeda_dollar($value);
                }
            
                elseif($key == 'data_vencimento')
                {
                    $array[$key] = data_en($value);
                }

                elseif($key == 'data_ocorrencia')
                {
                    $array[$key] = data_en($value);
                }

                elseif($key == 'data_resposta')
                {
                    $array[$key] = data_en($value);
                }

                elseif($key == 'data_pagamento')
                    {
                        $array[$key] = data_en($value);
                }
    
                elseif($key == 'valor')
                {
                    $array[$key] = moeda_dollar($value);
                }

                elseif($key == 'valor_padrao')
                {
                    $array[$key] = moeda_dollar($value);
                }
                
                elseif($key == 'valor_pago')
                {
                    $array[$key] = moeda_dollar($value);
                }
    
                elseif($key == 'taxa')
                {
                    $array[$key] = moeda_dollar($value);
                }
                else {
    
                 $array[$key] = $value;

                }
        }

    }
    return $array;
}

function post($name)
{
    if (!empty($_POST[$name])) {
        return $_POST[$name];
    }

    return null;
}

function get($name)
{
    if (!empty($_GET[$name])) {
        return $_GET[$name];
    }

    return null;
}

function filename($name)
{
    if (!empty($_FILE[$name])) {
        return $_FILE[$name];
    }

    return null;
}

function session($name)
{
    if(!empty($_SESSION[$name])) {
        return $_SESSION[$name];
    }

    return false;
}

function session_set($name, $value)
{
    $_SESSION[$name] = $value;
}

function session_finish()
{
    session_destroy();
}

function flash($name, $message)
{
    $_SESSION['flash_' . $name] = $message;
}

function has_flash($name)
{
    if (!empty($_SESSION['flash_' . $name])) {
        return true;
    }

    return false;
}

function flash_message($name)
{
    echo $_SESSION['flash_' . $name];
    $_SESSION['flash_' . $name] = null;
}


function require_var($file, $data = null)
{
    ob_start();
    if (!empty($data)) extract($data);

    require('./views/' . $file . '.php');
    return ob_get_clean();
}


function envia_email($to, $subject, $body)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host       = "smtp.umbler.com";          // SMTP server
    $mail->SMTPAuth   = true;                     // enable SMTP authentication
    $mail->Port       = 587;                      // set the SMTP port for the GMAIL server
    $mail->SMTPDebug = 1;
    $mail->Username   = "info@myaircompany.com";            // SMTP account username
    $mail->Password   = "Dinheiro1!";        // SMTP account password
    #$mail->SMTPSecure = "tls";
    $mail->AddReplyTo('info@myaircompany.com', 'My Air Company');
    $mail->AddAddress($to);
    $mail->CharSet = 'UTF-8';
    $mail->SetFrom('info@myaircompany.com', 'My Air Company');
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    #$mail->AddAttachment('images/phpmailer.gif');      // attachment
    #$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
    $mail->Send();

}



// PAYPAL

function sendNvpRequest(array $requestNvp, $sandbox = false)
{
    //Endpoint da API
    $apiEndpoint  = 'https://api-3t.' . ($sandbox? 'sandbox.': null);
    $apiEndpoint .= 'paypal.com/nvp';
 
    //Executando a operação
    $curl = curl_init();
 
    curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestNvp));
 
    $response = urldecode(curl_exec($curl));
 
    curl_close($curl);
 
    //Tratando a resposta
    $responseNvp = array();
 
    if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
        foreach ($matches['name'] as $offset => $name) {
            $responseNvp[$name] = $matches['value'][$offset];
        }
    }
 
    //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
    //gravamos um log para depuração.
    if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success') {
        for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i) {
            $message = sprintf("PayPal NVP %s[%d]: %s\n",
                               $responseNvp['L_SEVERITYCODE' . $i],
                               $responseNvp['L_ERRORCODE' . $i],
                               $responseNvp['L_LONGMESSAGE' . $i]);
 
            error_log($message);
        }
    }
 
    return $responseNvp;
}
