# 🏠 **Artklim** #

***

Este é um projeto da empresa Codix Produtora Digital, exclusivamente para esta empresa. O tema traz um layout intuitivo, com responsividade e com suporte para a maioria dos dispositivos da atualidade.

## 📚 Itens encontrados no repositório ##

* [Server em Produção](https://artklim.com.br)
* [Dados de acesso ao FTP](#markdown-header-dados-de-acesso-ao-ftp)
* [Configurações de integração com FTP](#markdown-header-configuracoes-de-integracao-com-ftp)
* [Banco de dados](#markdown-header-banco-de-dados)
* [Acesso ao Wordpress](#markdown-header-acesso-ao-wordpress)

***

## 🔌 Dados de acesso ao FTP ##

**Server**: `189.113.174.36`

**User**: `artklimcom`

**Pass**: `@pedro2010+`

**remotePath**: `/home/artklimcom/wp-content/themes/codix/`

**Hospedagem**: `http://189.113.174.36:2222`

**User**: `artklimcom`

**Pass**: `@pedro2010+`

### 🛠️ Configurações de integração com FTP ###

As configurações abaixo devem ser usadas na extensão `SFTP` para VSCODE, ou seja, antes de iniciar as configurações abaixo, instale a extensão SFTP no seu editor de código.

Segue abaixo passo a passo de como iniciar a **integração com FTP de Homologação**:

1. Execute o VSCODE normalmente
2. Utilize o atalho `F1` no teclado 
3. Selecione a opção `SFTP: Config`
4. Substia as informações do arquivo por estas:

```json
{
    "name": "Artklim",
    "host": "189.113.174.36",
    "protocol": "ftp",
    "port": 21,
    "username": "artklimcom",
    "password": "@pedro2010+",
    "remotePath": "/home/artklimcom/wp-content/themes/codix/",
    "uploadOnSave": true,
    "context": "./",
    "watcher": {
        "files": "**/*",
        "autoUpload": true,
        "autoDelete": false
    },
    "ignore": [
        ".vscode",
        ".git",
        ".gitignore",
        ".DS_Store",
        "README.md",
        "access.md",
        "/wp-content/themes/codix/webpack.mix.js",
        "/wp-content/themes/codix/package.json",
        "/wp-content/themes/codix/node_modules",
        "/wp-content/themes/codix/resources",
        "/wp-content/themes/codix/*.json",
        "/wp-content/themes/codix/*.rar",
        "/wp-content/themes/codix/*.html",
        "/wp-content/themes/codix/*.zip"
    ]
}
```

***

## 🛢️ Banco de dados ##

Para acessar e conectar o banco de dados do wordpress utilize os dados abaixo:

**Server**: `localhost`

**User**: `cyberads_artklim`

**Senha**: `pQ0izqjQBMds`

**DB**: `cyberads_artklim`

**Prefixo**: `snts_`

### ⚙️ Configuração para o banco de dados ###

```sql
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'cyberads_artklim' );


/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'cyberads_artklim' );


/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'pQ0izqjQBMds' );


/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );


$table_prefix = 'snts_';
```

***

## 📝 Acesso ao Wordpress ##

Para acessar o wordpress utilize os dados abaixo:

**URL**: `https://artklim.com.br/admin/`

**User**: `su.wp`

**Senha**: `554655`

***