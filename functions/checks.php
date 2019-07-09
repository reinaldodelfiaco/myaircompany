<?php

function limite_usuarios($id)
{
	$database = new db();
	$empresa = $database->row('SELECT * FROM empresas WHERE id=' . $id);
	return $empresa->limite_usuarios;
}

function total_usuarios($id)
{
	$database = new db();
	$count = $database->table('SELECT count(id) FROM usuarios WHERE empresa=' . $id);
	return $count;
}

function tamanho_usado($id)
{
	$database = new db();
	$count = $database->table('SELECT sum(size) as total FROM uploads WHERE empresa=' . $id);

	foreach ($count as $v) {
		 return  $v->total / 1000;
	}
}

function tamanho_geral($id)
{
	$database = new db();
	$count = $database->row('SELECT * FROM empresas WHERE id=' . $id);
	return $count->limite_espaco;
}

function pode_aprovar($id, $usuario)
{
	$database = new db();
	$count = $database->table('SELECT * FROM documentos_aprovacoes WHERE documento = ' . $id .' AND revisado = 0');
	if(!empty($count)) {
		return false;
	}

	return true;
}

function pode_revisar($id, $usuario)
{
	$database = new db();
	$count = $database->table('SELECT * FROM documentos_aprovacoes WHERE documento = ' . $id .' AND usuario = ' . $usuario . ' AND revisado = 1');
	if(!empty($count)) {
		return false;
	}
	return true;
}


function responsavel($task, $usuario)
{
	$database = new db();
	$count = $database->table('SELECT * FROM tasks_analizadas WHERE task = ' . $task .' AND usuario = ' . $usuario);
	if(!empty($count)) {
		return true;
	}
	return false;
}



function euro()
{	
	$database = new db();

	$ultima_insercao =  $database->row("SELECT * FROM cotacao WHERE id = 2");
	$dt = $ultima_insercao->data . date('H:i', strtotime($ultima_insercao->hora . '+1 hour'));

	if($dt < date("Y-m-d H:i")) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://economia.awesomeapi.com.br/all/EUR-BRL",
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		));

		$response = curl_exec($curl);
		$result = json_decode($response);
		$database->update("cotacao", ['data' => date("Y-m-d"), 'hora' => date("H:i"), 'valor' => moeda_dollar($result->EUR->bid)], ['id' => 2]);
		$euro =  $database->row("SELECT * FROM cotacao WHERE id = 2");
		echo moeda_real($euro->valor);
	} else {
		$euro =  $database->row("SELECT * FROM cotacao WHERE id = 2");
		echo moeda_real($euro->valor);
	}
}

function dollar()
{	
	$database = new db();

	$ultima_insercao =  $database->row("SELECT * FROM cotacao WHERE id = 1");
	$dt = $ultima_insercao->data . date('H:i', strtotime($ultima_insercao->hora . '+1 hour'));

	if($dt < date("Y-m-d H:i:s")) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://economia.awesomeapi.com.br/all/USD-BRL",
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		));

		$response = curl_exec($curl);
		$result = json_decode($response);
		$database->update("cotacao", ['data' => date("Y-m-d"), 'hora' => date("H:i"), 'valor' => moeda_dollar($result->USD->bid)], ['id' => 1]);
		$euro =  $database->row("SELECT * FROM cotacao WHERE id = 1");
		echo moeda_real($euro->valor);
	} else {
		$euro =  $database->row("SELECT * FROM cotacao WHERE id = 1");
		echo moeda_real($euro->valor);
	}
}
