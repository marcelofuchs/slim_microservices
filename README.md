# Slim Microservices

Api voltada a uma estrutura de microservices. 

Cada aplicação deve ser totalmente independente, ao subir uma aplicação de Books(exemplo), a aplicacao de autenticação nao deve ser afetada.



## Dicas

É possivel executar comandos comuns através do script 'micro.sh'. O script vai acessar o bash de um determinado docker, evitando instalalção de PHP/Banco de dados/Composer localmente.

- Iniciar e preparar Dockers.

```
# ./micro.sh build

```

- Instalar todas as dependencias.

```
# ./micro.sh install

```
- Iniciar sistema.

```
# ./micro.sh up

```

- Para executar o comando composer.

```
# ./micro.sh composer --help

```

- Para executar comandos do doctrine.

```
# ./micro.sh doctrine --help

```

- Para executar voltados ao docker.

```
# ./micro.sh

```
 
- Gerar arquivo Yaml a partir do banco de dados. use * --filter=book --force * caso queira apenas uma tabela.

```
# ./micro.sh doctrine orm:convert-mapping --from-database yaml ./Infrastructure/Persistence/Doctrine/Mappings --namespace=Domain\\\\Entities\\\\

```