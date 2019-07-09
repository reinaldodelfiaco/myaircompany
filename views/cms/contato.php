<div class="masthead">
	<div class="container">
		<h1 class="masthead-subtitle"> CONTATO </h1>
	</div> 
</div>
<div class="iframe-maps">
	<iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAXyp22ByrhSH5DDimEFSvvu6gL73Wn2KU
			&q=Av.+Assis+Brasil,+6186+-+707+-+Sarandi,+Porto+Alegre+-+RS,+91110-110" >
	</iframe>
</div>
<div class="content">
	<div class="container">
		<div class="layout layout-stack-sm layout-main-left">
			<div class="col-sm-8 layout-main">
				<div class="heading-block">
					<H4> Entre em contato: </H4>
				</div>
					<p>Entre em contato conosco, nossa equipe ficará feliz em atendê-los.</p>
					<br>
					<br>
					<div class="heading-block">
						<H4>Envie-nos um e-mail.</H4>
					</div>
<?php
	form_open('cms/contato');
		form_text_input('Nome', 'nome', 'required');
		form_text_input('E-mail', 'email', 'required');
		form_text_input('Telefone', 'telefone', 'required');
		form_textarea('Mensagem', 'mensagem', 'required');
		submit('Enviar', 'btn btn-primary btn-block btn-lg');
	form_close();

?>
			</div>
			<div class="col-sm-4 layout-sidebar">
				<div class="heading-block">
					<H4>Localização da empresa</H4>
				</div>            
				<ul class="icons-list">
					<li>
						<i class="icon-li fa fa-map-marker"></i>
						<?= $empresa->endereco ?>, <?= $empresa->numero ?> - <?= $empresa->complemento ?> <br>
						<?= $empresa->cidade?>, <?= $empresa->estado ?> - <?= $empresa->cep ?>
					</li>
					<li>
						<i class="icon-li fa fa-phone"></i>
						<?= $empresa->telefone ?>
					</li>
						<li>
						<i class="icon-li fa fa-envelope"></i>
						<a href="<?= $empresa->email?>"><?= $empresa->email ?></a>
					</li>
				</ul>
					<br><br>
					<div class="heading-block">
					<H4>Horário de atendimento</H4>
				</div>
					<ul class="icons-list">
					<li>
						<i class="icon-li fa fa-clock-o"></i>
						De Segunda à Sexta: 9:00 às 18:00
					</li>
			</div>
		</div>
	</div>    	
</div> 



