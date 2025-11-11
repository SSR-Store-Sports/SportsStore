
# Tema: Loja de Roupa Virtual (Esportista)

## Descrição: loja online de roupas esportistas.

# Entidades (tabelas):
- Usuários: lista de usuários;
- Perfils: cliente, funcionário, administrador;
- Fornecedores: lista de fornecedores;
- Produtos: lista de itens;
- Categorias: lista de itens, ex.: camisetas, tênis;
- Vendas: lista de itens vendidos;
- Carrinho: lista de itens que serão comprados.

## RFs (requisitos funcionais):
Funcionalidade que o usuário interage de alguma forma.

- [ ] O usuário deve poder se cadastrar;
- [ ] O usuário deve poder se autenticar;
- [ ] O usuário deve poder alterar sua senha;
- [ ] O usuário deve poder obter o seu perfil de um usuário logado;
- [x] O usuário deve poder visualizar todos os produtos;
- [x] O usuário deve poder buscar por produto(s);
- [ ] O usuário deve poder selecionar um produto gerando o carrinho de compras;
- [ ] O usuário deve poder finalizar a compra (gerar venda);
- [ ] x - O usuário deve ter uma lista de items favoritos;
- [ ] O usuário deve poder visualizar o histórico de compras;
- [ ] O funcionário/administrador deve poder cadastrar um fornecedor;
- [ ] O funcionário/administrador deve poder cadastrar um produto;
- [ ] O funcionário/administrador deve poder gerenciar o estoque de produtos (atualizar stock).
- [ ] O administrador pode desativar um usuário;
- [ ] O administrador deve poder cadastrar um usuário como funcionário/administrador;
- [ ] O administrador deve poder alterar a senha de um usuário;

## RNFs (requisitos não-funcionais):
Não funcionalidades, mais tratativas.

- [ ] A senha do usuário deve estar criptografada;
- [ ] O usuário deve ser identificado por um JWT (JSON Web Token);
- [ ] Deve ser possível diferenciar usuários por cargos;
- [ ] O usuário não autenticado deve ter um id associado para utilizar o carrinho de compras;
- [ ] O usuário cadastrado como funcionário/administrador terá que usar o
authenticator (aplicativo de validação - opcional);
- [ ] O estoque deve ser atualizado ao finalizar a compra;
- [ ] O usuário só pode alterar três vezes no mês sua senha (opcional);
- [ ] O usuário recebe uma senha temporária no endereço de email para renovação;
- [ ] Todas as datas devem estar convertidas conforme locale configurado (ex: DD/MM/YYYY)
- [ ] O usuário não deve poder usar o sistema se estiver desativado;
- [ ] Todas as funcionalidades devem retornar status HTTP apropriado (200, 201, 400, etc);

## RNs (Regras de negócios):
A instituição decide, o proprietário do software dita.

- [ ] O usuário deve se cadastrar utilizando:
  - nome
  - sobrenome
  - email;
  - senha; 
  - CPF;
  - CEP; 
  - complemento;
  - telefone;
  - data de nascimento.
- [ ] O usuário deve aceitar os termos para se cadastrar;
- [ ] O usuário não deve poder se cadastrar com um usuário duplicado;
- [ ] Todos os usuários cadastrados recebem por padrão o cargo de cliente;
- [ ] O usuário deve ter mais quem um método de autenticação;
- [ ] O limite de itens no carrinho é 20 por usuário;
- [ ] Um produto pode estar atrelado a um fornecedor;
- [ ] O preço do produto deve incluir impostos (ex.: ICMS);
- [ ] Todas as consultas devem ter paginação: 10 itens p/página;
- [ ] Todos os filtros são opcionais;
- [ ] Usuários que não estão logados, devem conseguir adquirir produtos para ficar no carrinho (direcionar p/ login);
- [ ] O usuário que quer algo específico, poderá acessar o canal alternativo (WhatsApp);

# TASKS ARQUITETURAIS

## 🔴 CRÍTICO - Segurança (Prioridade 1)
- [ ] Implementar Sistema de Autenticação JWT
- [ ] Corrigir Vulnerabilidades XSS
- [ ] Implementar Proteção CSRF
- [ ] Criptografia de Senhas

## 🟡 ALTO - Estrutura e Padrões (Prioridade 2)
- [ ] Implementar Padrão MVC Completo
- [ ] Sistema de Tratamento de Erros
- [ ] Validação de Dados

## 🟢 MÉDIO - Funcionalidades Core (Prioridade 3)
- [ ] Sistema de Usuários Completo
- [ ] Carrinho de Compras
- [ ] Sistema de Vendas

## 🔵 BAIXO - Melhorias (Prioridade 4)
- [ ] Paginação e Performance
- [ ] Interface e UX

# GUIDE PHP COMMANDS

- Creating Server Embuting PHP
  - php -S localhost:8888 -d auto_prepend_file=server.php
  - A flag -S é usada para iniciar o servidor embutido do PHP.
  - `-d`: Permite alterar configurações do php.ini diretamente na linha de comando.
  - auto_prepend_file=server.php:
    - Esta diretiva indica que o arquivo server.php será automaticamente incluído 
    antes de qualquer outro script.

https://www.php.net/manual/pt_BR/features.commandline.php
https://www.php.net/manual/pt_BR/features.commandline.webserver.php
https://en.wikipedia.org/wiki/Port_(computer_networking)
https://www.php.net/manual/pt_BR/ini.core.php#ini.auto-prepend-file
