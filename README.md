# Desafio PHP - Desenvolvedor(a) Back-end

> Para o desafio deve ser utilizado PHP 7.4 ou superior

> Para banco de dados, deve ser utilizado MySQL 8.*

> O código deve ser disponibilizado em um repositório público no GitHub, e enviado o link do repositório para desafio@ipag.com.br

> O desafio deve ser entregue até o dia 30/07/2023

## Exercício 1: Autenticação de Usuário

Desenvolva um sistema de autenticação de usuário em PHP utilizando os conceitos de criptografia de senha. Crie um formulário de login que valide as credenciais do usuário em um banco de dados e, se as credenciais forem válidas, redirecione o usuário para uma página de boas-vindas. Implemente também o registro de novos usuários, com a devida criptografia de senha.

## Exercício 2: Manipulação de API

Utilizando a API REST do GitHub, desenvolva um script em PHP que faça uma requisição para obter os repositórios de um usuário e exiba as informações dos repositórios, como nome, descrição, número de estrelas, etc.

## Exercício 3: Manipulação de Dados

Dado um conjunto de dados [organizations-100000.csv](https://github.com/datablist/sample-csv-files/raw/main/files/organizations/organizations-100000.zip) contendo informações de organizações, desenvolva um script em PHP que leia o arquivo, faça a devida validação dos dados e insira-os em um banco de dados MySql. Crie três funções que retornem as seguintes informações:

1. Organizações com mais de 5000 funcionários ordenadas por nome.
2. Organizações fundadas antes dos anos 2000 com menos de 1000 funcionários ordenadas por data de fundação.
3. Quantidade organizações e funcionários, agrupados por insdustria e pais, e ordenadas por industria.

## Exercício 4: Implementação de Design Patterns

Dados os Design Patterns: Factory, Observer e Strategy. Implemente-os em um projeto PHP de sua escolha. Justifique a escolha do projeto e dos Design Patterns utilizados.