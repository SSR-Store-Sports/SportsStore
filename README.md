
# Tema: Loja de Roupa Virtual (Esportista)

## Descrição: loja online de roupas esportistas.

# Entidades (tabelas):
- Usuários: lista de usuários;
- Perfils: cliente, funcionário, administrador;
- Produtos: lista de itens;
- Vendas: usuário e produto;

## RFs (requisitos funcionais):
Funcionalidade que o usuário interage de alguma forma.

- [ ] O usuário deve poder se cadastrar;
- [ ] O usuário deve poder se autenticar;
- [ ] O usuário deve poder alterar sua senha;
- [ ] O administrador deve poder cadastrar um usuário como funcionário/administrador;
- [ ] O usuáro deve poder visualizar todos os produtos;
- [ ] O usuário deve poder buscar por produto(s);

## RNFs (requisitos não-funcionais):
Não funcionalidades, mas tratativas.

- [ ] A senha do usuário deve estar criptografada;
- [ ] Deve ser possível diferenciar usuários por cargos;
- [ ] O usuário cadastrado como funcionário/administrador terá que usar o
authenticator (aplicativo de validação);
- [ ] O usuário só pode alterar três vezes no mês sua senha;
- [ ] O usuário recebe uma senha temporária no endereço de email para renovação

## RNs (Regras de negócios):
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
  Obs.: o usuário deve aceitar os termos para se cadastrar.
- [ ] Todos os usuários cadastrados recebem por padrão o cargo de cliente
- [ ] O usuário deve ter mais quem um método de autenticação
