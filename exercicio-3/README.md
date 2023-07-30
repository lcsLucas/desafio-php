## Exercício 3: Manipulação de Dados

> Dado um conjunto de dados [organizations-100000.csv](https://github.com/datablist/sample-csv-files/raw/main/files/organizations/organizations-100000.zip) contendo informações de organizações, desenvolva um script em PHP que leia o arquivo, faça a devida validação dos dados e insira-os em um banco de dados MySql. Crie três funções que retornem as seguintes informações:

1. Organizações com mais de 5000 funcionários ordenadas por nome.
2. Organizações fundadas antes dos anos 2000 com menos de 1000 funcionários ordenadas por data de fundação.
3. Quantidade organizações e funcionários, agrupados por insdustria e pais, e ordenadas por industria.

Exemplo:

```
Index: 1,
Organization Id: 8cC6B5992C0309c
Name: Acevedo LLC
Website: https://www.donovan.com/
Country: Holy See (Vatican City State)
Description: Multi-channeled bottom-line core
Founded: 2019
Industry: Graphic Design / Web Design
Number of employees: 7070
```