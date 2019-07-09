# Pendências

>>Cadastro de voos
>>Plano de voo
>>Lançamentos de vendas voo
>>Opção para imprimir em pdf o relprev e a rire 
>>Quando o relprev for preenchido, então enviar para o e-mail do Gestor de Operações e Gerente de SGSO. Somente um desses dois é que poderá responder a quem preencheu o relprev. Após preenchido o relprev não pode ser editado, então colocar aviso. Dar a opção para esses gestores enviarem sobre à resposta ao relprev para todos os funcionários. 
>>Melhorar a opção de filtro do Contato de Emergência e dar a opção de impressão

# Observação
 - Para executar o projeto sem a necessidade de instalar o XAMPP/WAMP/LAMP pode-se usar o servidor embutido do PHP
 - Utilizar o comando php -S localhost:80
 - Deve ser alterado o arquivo config.php. Alterar as variáveis para: define('BASE', 'http://localhost/') e define('HTDOCS', '')

# Configurando o cacert.pem
- Existe uma configuração necessária para o CURL conseguir acessar as APIs via HTTPS.
- Deve ser configurado o arquivo cacert.pem. Copiar o arquivo cacert.pem para a pasta de instalação do PHP.
- Depois habilitar o OPENSSL no arquivo php.ini - extension=openssl (de acordo com o sistema operacional)
- Configurar o caminho do certificado, também no arquivo php.ini - curl.cainfo=<caminho no filesystem para o arquivo cacert.pem>

