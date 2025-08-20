
# Tema: Loja de Roupa Virtual (Esportista)

## Descrição: loja online de roupas esportistas.

# Entidades (tabelas):
- Usuários: lista de usuários;
- Perfils: cliente, funcionário, administrador;
- Fornecedores: lista de fornecedores;
- Produtos: lista de itens;
- Vendas: lista de itens vendidos;

## RFs (requisitos funcionais):
Funcionalidade que o usuário interage de alguma forma.

- [ ] O usuário deve poder se cadastrar;
- [ ] O usuário deve poder se autenticar;
- [ ] O usuário deve poder alterar sua senha;
- [ ] O usuário deve poder obter o seu perfil de um usuário logado;
- [ ] O usuário deve ter um carrinho de compras;
- [ ] O usuário 
- [ ] O funcionário/administrador deve poder cadastrar um fornecedor; 
- [ ] O administrador pode desativar um usuário;
- [ ] O administrador deve poder cadastrar um usuário como funcionário/administrador;
- [ ] O usuáro deve poder visualizar todos os produtos;
- [ ] O usuário deve poder buscar por produto(s);

## RNFs (requisitos não-funcionais):
Não funcionalidades, mais tratativas.

- [ ] A senha do usuário deve estar criptografada;
- [ ] O usuário deve ser identificado por um JWT (JSON Web Token)
- [ ] Deve ser possível diferenciar usuários por cargos;
- [ ] O usuário não autenticado deve ter um id associado para utilizar o carrinho de compras;
- [ ] O usuário cadastrado como funcionário/administrador terá que usar o
authenticator (aplicativo de validação - opcional);
- [ ] O usuário só pode alterar três vezes no mês sua senha (opcional);
- [ ] O usuário recebe uma senha temporária no endereço de email para renovação;
- [ ] Todas as datas devem estar convertidas conforme locale configurado (ex: DD/MM/YYYY)
- [ ] O usuário não deve poder usar o sistema se estiver desativado;
- [ ] Todas as funcionalidades devem retornar status HTTP apropriado (200, 201, 400, etc)

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
- [ ] Um produto pode estar atrelado a um fornecedor;
- [ ] Todas as consultas devem ter paginação: 10 itens p/página
- [ ] Todos os filtros são opcionais
- [ ] Usuários que não estão logados, devem conseguir adquirir produtos para ficar no carrinho (direcionar p/ login)
- [ ] O usuário que quer algo específico, poderá acessar o canal alternativo (WhatsApp)
