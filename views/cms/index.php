<div class="masthead">
	<div id="masthead-carousel" class="carousel slide carousel-fade masthead-carousel">
		<div class="carousel-inner">
			<div class="item active" style="background-color: #1c4080; height: 100%">
				<br class="xs-30 sm-60">
				<div class="container">
					<div class="row">
						<div class="col-md-6 masthead-text animated fadeInDownBig">
							<br class="xs-30 sm-60">
							<h1 class="masthead-title">DESENVOLVIMENTO DE SISTEMAS.</h1>
							<p>Desenvolvemos sistemas que vão muito além de suas necessidades. Em cada sistema pensamos em como podemos melhorar seus processos, seja nas funcionalidades ou na disponibilidade, sem esquecer dos requisitos básicos.</p>
							<br>
							<div class="masthead-actions">
								<a href="#" class="btn btn-transparent btn-jumbo">
									SAIBA MAIS
								</a>
							</div> 
						</div> 
						<div class="col-md-6 masthead-img animated fadeInUpBig">
							<img src="<?= PUBLIC_URL ?>imagens/contabil.png" alt="slide2" class="img-responsive" />     
						</div> 
					</div>
				</div> 
			</div>
			<div class="item" style="background-color: #00904d;  height: 100%">
				<br class="xs-30 sm-60">
				<div class="container">
					<div class="row">
						<div class="col-md-6 masthead-text animated fadeInDownBig">
							<br class="xs-30 sm-60">
							<h1 class="masthead-title">CERTIFICAÇÃO DIGITAL.</h1>
							<p>Certificado digital é um arquivo eletrônico que serve como identidade virtual para uma pessoa física ou jurídica, e por ele pode se fazer transações online com garantia de autenticidade e com toda proteção das informações trocadas. Compre e emita seu certificado conosco. </p>
							<br>
							<div class="masthead-actions">
								<a href="#" class="btn btn-transparent btn-jumbo">
									COMPRAR
								</a>
								<br><br>
							</div> 
						</div> 
						<div class="col-md-6 masthead-img animated fadeInUpBig">
							<img src="<?= PUBLIC_URL ?>imagens/cartao.png" alt="slide2" class="img-responsive" />           
						</div> 
					</div>
				</div> 
			</div>
			<div class="item  " style="background-color: #1c4080;  height: 100%">
				<br class="xs-30 sm-60">
				<div class="container">
					<div class="row">
						<div class="col-md-6 masthead-text animated fadeInLeftBig">
							<h4 class="masthead-title">DÊ UMA CHANCE PARA SEU SONHO.</h4>
							<p>
								Entre em contato conosco e dê o primeiro passo para alavancar seu negócio, responderemos mais rápido do que você pensa, nossa equipe é mesmo rápida e experiente.
							</p>
							<br>
							<div class="masthead-actions">
								<a href="#" class="btn btn-transparent btn-jumbo">
									CONTATO
								</a>
							</div>
						</div> 
						<br class="xs-30 md-0">
						<div class="col-md-6 masthead-img animated fadeInRightBig">
							<?php  div('masthead-form well'); ?>

							<h3 class="text-center">Entre em contato!</h3>
							<?php
							form_open('/');
							form_text_input('Seu nome:', 'nome', 'required');
							form_text_input('Seu e-mail:', 'email', 'required|email');
							form_textarea('Mensagem', 'mensagem', 'required');
							submit('ENVIAR', 'btn btn-success btn-block');
							form_close();
							cdiv();
							?>

							<br class="xs-80">
						</div>
					</div> 
				</div> 
			</div> 
		</div>  
		<div class="container">
			<div class="carousel-controls">
				<a class="carousel-control left" href="#masthead-carousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#masthead-carousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
	</div> 
</div> 
<div class="content">
	<section id="section-features" class="home-section">
		<br class="sm-30">
		<div class="container">
			<div class="heading-block heading-minimal heading-center">
				<h2>
					O que nos torna diferentes?
				</h2>
			</div>  
			<div class="feature-lg">
				<div class="row">
					<div class="col-sm-6">
						<figure class="feature-figure"><img src="<?= PUBLIC_URL ?>imagens/pqnos.png" class="img-responsive" ></figure>
					</div>
					<div class="col-sm-6">
						<br class="xs-30 sm-0">
						<div class="feature-content">
							<h3>Você domina sua gestão com poucos cliques.</h3>
							<p class="lead">Somos uma empresa que além de entender de tecnologia de desenvolvimento, somos extremamente experientes em assuntos do nosso mercado.</p>     
							<ul class="icons-list">
								<li><i class="icon-li fa fa-check text-primary"></i>Contabilidade</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Financeiro</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Projetos</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Atendimento</li>
								<li><i class="icon-li fa fa-check text-primary"></i>CRM</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Cobrança</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Nota Fiscal Eletrônica</li>
							</ul>
							<a href="#" class="btn btn-default">SAIBA MAIS</a>
						</div> 
					</div>
				</div> 
			</div> 
			<br class="xs-50 sm-100">
			<div class="feature-lg figure-right">
				<div class="row">
					<div class="col-sm-6 col-sm-push-6">
						<figure class="feature-figure"><img src="<?= PUBLIC_URL ?>imagens/tec.png" class="img-responsive"></figure>
					</div>
					<div class="col-sm-6 col-sm-pull-6">
						<br class="xs-30 sm-0">
						<div class="feature-content">
							<h3>Trabalhamos com as melhores tecnologias.</h3>
							<p class="lead">Profissionais capacitados e curiosos fazem parte do nosso dia dia, sempre buscando o aperfeiçoamento e atualizações.</p>
							<ul class="icons-list">
								<li><i class="icon-li fa fa-check text-primary"></i>Google Apps for Work</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Google Cloud, Amazon WS e Digital Ocean</li>
								<li><i class="icon-li fa fa-check text-primary"></i>PHP, Javascript, React e React Native</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Mysql e MongoDB</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Bootstrap, Jquery e CSS</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Search Engine Optimization</li>
							</ul>
							<a href="#" class="btn btn-default">SAIBA MAIS</a>
						</div>
					</div>
				</div> 
			</div> 
			<br class="xs-50 sm-100">
			<div class="feature-lg">
				<div class="row">
					<div class="col-md-6">	
						<figure class="feature-figure"><img src="<?= PUBLIC_URL ?>imagens/consultoria.png" class="img-responsive"></figure>
					</div>
					<div class="col-md-6">
						<br class="xs-30 sm-0">
						<div class="feature-content">
							<h3>O necessário para sermos perfeito.</h3>
							<p class="lead">Você sabe qual a melhor tecnologia para utilizar em seu trabalho? Sabe se ela está superdimensionada ou não?.</p>
							<ul class="icons-list">
								<li><i class="icon-li fa fa-check text-primary"></i>Consultoria Técnica</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Levantamento de Informações</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Gestão de TI</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Desenvolvimento de Estratégias</li>
								<li><i class="icon-li fa fa-check text-primary"></i>Segurança da Informação</li>
								<li><i class="icon-li fa fa-check text-primary"></i><strong>GESTÃO DE PROJETOS</strong></li>
							</ul>
							<a href="#" class="btn btn-default">SAIBA MAIS</a>
						</div>
					</div>
				</div> 
			</div> 
		</div>
	</section>
	<section id="section-benefits" class="home-section" style="background-color: #f3f3f3;">
		<div class="container">
			<div class="heading-block heading-minimal heading-center">
				<h2>Nosso diferencial</h2>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-anchor feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Processos</h3>
						<p class="feature-sm-content">
							Reuniões para definições de objetivos e organização de processos, às vezes a mudança é mais simples do que parece.
						</p>
					</div> 
				</div> 
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-ils feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Transparência</h3>
						<p class="feature-sm-content">
							Nossa sinceridade às vezes ultrapassa dos limites, vamos sempre falar a verdade, mesmo que não precisem dos serviços.
						</p>
					</div> 
				</div> 
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-gift feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Confiança</h3>
						<p class="feature-sm-content">
							É como se fossemos parte de sua empresa, seremos extremamente responsáveis com seus serviços e prazos.
						</p>
					</div> 
				</div>
			</div> 
			<div class="row">
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-code feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Prazos</h3>
						<p class="feature-sm-content">
							Dizer que vamos <strong>sempre</strong> entregar no prazo é mentira, mas vamos nos esforçar ao máximo, ou vamos negociar.
						</p>
					</div> 
				</div> 
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-comments-o feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Comunicação</h3>
						<p class="feature-sm-content">
							Vamos fugir de tudo o que for chato, você decide, pode ser almoço, café, reuniões rápidas ou conferência.
						</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-cloud-download feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Financeiro</h3>
						<p class="feature-sm-content">
							Facilidades na hora de efetuar pagamento garante maior aproveitamento da receita, para ambos os lados.
						</p>
					</div> 
				</div>
			</div> 
			<div class="row">
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-crosshairs feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Segurança</h3>
						<p class="feature-sm-content">
							Sabemos o quanto sua informação é importante, vamos mantê-la segura. A ética sempre em primeiro lugar.
						</p>
					</div> 
				</div> 
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-rocket feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Consultoria</h3>
						<p class="feature-sm-content">
							Vamos lá, amamos conversar sobre tecnologia e no quanto ela pode nos ajudar, ou nos prejudicar.
						</p>
					</div> 
				</div> 
				<div class="col-sm-4">
					<div class="feature-sm">
						<i class="fa fa-star feature-sm-icon text-secondary"></i>
						<h3 class="feature-sm-label">Equipe</h3>
						<p class="feature-sm-content">
							Nossa equipe é show, somos dinâmicos, comunicativos e vamos nos esforçar para lhe entregar o melhor resultado.
						</p>
					</div> 
				</div>
			</div>
		</div> 
	</section>
	<section id="section-testimonials" class="home-section">
		<div class="container">
			<div class="heading-block heading-minimal heading-center">
				<h2>
					Veja quem confia na gente:
				</h2>
			</div> 
			<!-- <ul class="clients-list">
				<li><img src="<?= PUBLIC_URL ?>imagens/empresas/klaston.png" class="img-responsive" alt="Klaston" width="200"></li>
				<li><img src="<?= PUBLIC_URL ?>imagens/empresas/premium_leiloes.png" class="img-responsive" alt="Premium Leilões"  width="200"></li>
				<li><img src="<?= PUBLIC_URL ?>imagens/empresas/procont.png" class="img-responsive" alt="PROCONT RS"  width="200"></li>
				<li><img src="<?= PUBLIC_URL ?>imagens/empresas/sesconrs.png" class="img-responsive" alt="SESCONRS"  width="200"></li>
				<li><img src="<?= PUBLIC_URL ?>imagens/empresas/soluevo.png" class="img-responsive" alt="SOLUEVO"  width="200"></li> -->
			</ul>
			<br class="xs-60">
			<div class="row">
				<div class="col-sm-4">
					<div class="testimonial">
						<div class="testimonial-icon bg-secondary">
							<i class="fa fa-quote-left"></i>
						</div> 
						<div class="testimonial-content">
							"Excelente experiência, muito atencioso, qualidade perfeita."
						</div> 
						<div class="testimonial-author">
							<div class="testimonial-image"><img alt="" src="<?= PUBLIC_URL ?>imagens/depoimentos/diego.png"></div>
							<div class="testimonial-author-info">
								<h5><a href="#">Diego Bassani</a></h5> SOLUEVO
							</div>
						</div> 
					</div> 
					<br class="xs-30">
				</div>
				<div class="col-sm-4">
					<div class="testimonial">
						<div class="testimonial-icon bg-secondary">
							<i class="fa fa-quote-left"></i>
						</div> 
						<div class="testimonial-content">
							"a Cont4 foi bem atenciosa e rápida, tanto na execução quanto nos acertos que foram necessários"
						</div>
						<div class="testimonial-author">
							<div class="testimonial-image"><img alt="" src="<?= PUBLIC_URL ?>imagens/depoimentos/ng.png"></div>

							<div class="testimonial-author-info">
								<h5><a href="#">Nelson Gouveia</a></h5> NGEA
							</div>
						</div> 
					</div>
					<br class="xs-30">
				</div>
				<div class="col-sm-4">
					<div class="testimonial">
						<div class="testimonial-icon bg-secondary">
							<i class="fa fa-quote-left"></i>
						</div> 
						<div class="testimonial-content">
							"Execelente empresa, superou as expectativas. Atendeu todas a minha necessidades dentro do prazo combinado,  tirou todas as dúvidas durante e após a finalização  do projeto."
						</div>
						<div class="testimonial-author">
							<div class="testimonial-image"><img alt="" src="<?= PUBLIC_URL ?>imagens/depoimentos/douglas.jpg"></div>
							<div class="testimonial-author-info">
								<h5><a href="#">Douglas</a></h5>PREMIUM LEILÕES
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div> 
	</section>
	<section id="section-contact" class="home-section" style="background-color: #f3f3f3; padding-top: 35px; padding-bottom: 35px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h2>CERTIFICAÇÃO DIGITAL</h2>
					<p class="lead">Somos parceiros da FENACON-CD para emissão de Certificados Digitais, e possuímos mais de 10 anos de experiência na área. </p>
				</div>
				<div class="col-sm-4 text-center">
					<br class="xs-30">

					<br class="xs-20">

					<a target="_blank" href="http://www.fenaconcd.com.br/fenaconcd/" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;COMPRAR CERTIFICADO&nbsp;&nbsp;&nbsp;&nbsp;</a>
				</div>
			</div>
		</div>
	</section>
</div>
</div>
