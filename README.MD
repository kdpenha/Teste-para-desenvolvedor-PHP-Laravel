# Teste PHP Puro - CRM de Imóveis

## Como rodar o projeto localmente

1. Clone o repositório:
    ```
   git clone https://github.com/kdpenha/Teste-para-desenvolvedor-PHP-Laravel.git
2. Inicie o servidor embutido do PHP:
    ```bash
    php -S localhost:8080
3. Acesse no navegador:
    ```bash
    http://localhost:8080
4. Importe o banco:
    - Rode o arquivo migrations/create_tables.sql no seu MySQL ou MariaDB.

5. Configure o acesso ao banco:
    - Edite o arquivo config/database.php com suas credenciais de conexão (host, dbname, usuário, senha).

## O que eu melhoraria se tivesse mais tempo
- Criar um Router de verdade para melhorar as rotas dinâmicas.

- Implementar CSRF nos formulários para aumentar a segurança.

- Usar validações mais robustas com classes de Validator separadas.

- Melhorar a arquitetura do MVC (separar Controllers, Services, Models de forma mais limpa).

- Deixar o layout responsivo e mais bonito.

- Implementar paginação e filtros nas listagens.

- Criar Seeders para popular o banco com dados fakes de teste.

- Criar mais tabelas para organizar relacionamentos

- Planejar um Design mais intuitivo ao usuário.

- Testes unitários para garantir estabilidade.