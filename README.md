# Template Wordpress

Um repositório com um template inicial para iniciar novos projetos em Wordpress.

## Plugins incluidos

* ACF Pro
* All In One WP Security
* Contact Form 7
* Recaptcha para Contact Form 7
* Flamingo
* Barra de aceitação de Cookies (GDPR Cookie Consent)
* Duplicate post
* Post Types Order e Taxonomy Terms Order
* Simple History
* WEBP Converter for Media
* WP Fastest Cache
* WP Mail SMTP

## Tecnologias do tema
* Sass
* Bootstrap
* jQuery
* Vue
* Laravel-Mix

## Instalação do template

1. Clone o template e remova a pasta .git

2. Inicialize o repositório do projeto

3. Crie o banco de dados para o projeto

4. Crie um vhost na sua máquina

5. Importe o dump inicial do template (`_dumps/inicial.sql`) para esse banco

6. Ajuste o `site_url` e a `home_url` na tabela `snts_options` inserindo a vhost criada

7. Configure o arquivo `/wp-config.php` usando o `/wp-config-sample.php` como base

8. Renomeie a pasta do tema para o nome do projeto

9. Acesse o painel admin com o user `su.wp` e a senha `554655`

10. Ative o tema, pois ele é desativado após renomear a pasta

11. Crie um novo usuário para o projeto, faça login nele e delete o `su.wp`

12. Salve os links permanentes

13. Configure as informações do site na aba Configurações

14. Execute `npm install` na pasta do tema

15. Configure o arquivo `webpack.mix.js` na pasta do tema inserindo o vhost no campo proxy do browserSync

16. Execute `npm run watch` na pasta do tema

## Publicação por tags

1. Verificar se todas as alterações já foram commitadas e enviadas para a master

2. Baixar todas as tags do repositório: `git fetch --tags`

3. Criar um branch com o nome da próxima versão (exemplo: `git checkout -b v0.0.1`)

4. Executar a build de produção na pasta do tema: `npm run prod`

5. Remover as linhas `/assets/css/*` e `/assets/js/*` do arquivo `.gitignore` na pasta do tema

 5.1. (`git status -u` exibe todos os arquivos não trackeados pelo git, aqui devem aparecer os arquivos css e js)

6. Adicionar e commitar os arquivos compilados neste branch `git add .` e `git commit -m "Add assets compilados"`

7. Criar a tag com o nome da versão `git tag -a v0.0.1 -m ""`

8. Fazer push da tag: `git push --tags`

9. `git checkout master` para sair desse branch criado, os arquivos css e js serão apagados e o gitignore voltará ao normal

10. O comando para apagar o branch é: `git branch -D v0.0.1`

## Atualizar o hmlproj ou produção para a tag mais nova

1. Conectar por ssh

2. Baixar todas as tags do repositório: `git fetch --tags`

3. Cuidar se não tem modificações nos arquivos trackeados (`git status -uno` exibe apenas os arquivos modificados, ignorando os não trackeados)

 3.1 Na fase de desenvolvimento não devem ter alterações, mas em produção é possível q algum plugin tenha sido atualizado.

4. Criar e entrar em um novo branch baseado na tag mais recente: `git checkout tags/v0.0.1 -b tags/v0.0.1`