# Frontend da Aplicação de Gestão de Produtos

Este é o projeto frontend da aplicação de gestão de produtos, desenvolvido com **Vue 3** e **Vuetify 3**. A interface foi construída visando simplicidade, responsividade e uma boa experiência do usuário.

## 🎯 Objetivo

Fornecer uma interface administrativa intuitiva para:
- Cadastrar novos produtos
- Editar produtos existentes
- Buscar produtos por nome e descricao
- Visualizar produtos em uma tabela responsiva
- Excluir produtos com confirmação visual amigável

## 🛠️ Tecnologias e Bibliotecas Utilizadas

- [Vue 3](https://vuejs.org/) - Framework principal
- [Vuetify 3](https://vuetifyjs.com/) - Biblioteca UI com Material Design
- [Vue Router](https://router.vuejs.org/) - Gerenciamento de rotas
- [Axios](https://axios-http.com/) - Requisições HTTP
- [Lodash (debounce)](https://lodash.com/docs/4.17.15#debounce) - Debounce para busca otimizada
- [Pinia](https://pinia.vuejs.org/) - Gerenciamento de estado (instalado, mas ainda não utilizado ativamente)

## 💡 Motivações

- Utilizar o Vuetify para acelerar o desenvolvimento da interface e garantir uma UI moderna e acessível.
- Tornar o código escalável e modular com `script setup` e componentes reutilizáveis.
- Preparar o projeto para possível uso de gerenciamento de estado global com **Pinia** (embora atualmente não esteja sendo utilizado).

## ▶️ Como executar

1. Instale as dependências:

```bash
npm install
```

2. Inicie o servidor de desenvolvimento:

```bash
npm run dev
```

3. Com o Docker configurado, basta executar `docker compose up -d` para iniciar o projeto.

4. Acesse no navegador:

```
http://localhost:5173
```

## 📌 Observações

- Este projeto está preparado para evoluir com uso de Pinia, caso o gerenciamento de estado global se torne necessário no futuro.
- As operações CRUD seguem o padrão de exibição de feedbacks com `v-snackbar` e confirmações com `v-dialog`.

## 👨‍💻 Autor

Desenvolvido por [Diogo Santos](https://github.com/DiogoMPSantos)