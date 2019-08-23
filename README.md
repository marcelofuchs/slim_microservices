# Slim Microservices

Api voltada a uma estrutura de microservices. 

Cada aplicação deve ser totalmente independente, ao subir uma aplicação de Books(exemplo), a aplicacao de autenticação nao deve ser afetada.

## Instalação

É possivel executar comandos comuns através do script 'micro.sh'. O script vai acessar o bash de um determinado docker, evitando instalação de PHP/Banco de dados/Composer no sistema hospedeiro.

- Preparar Dockers.

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

## Executar comandos.
### Gerador de CRUD
EM BREVE

### Composer

```
# ./micro.sh composer --help
```

### Doctrine

```
# ./micro.sh doctrine --help
```
#### Gerar arquivo YAML a partir do banco de dados
* Use `--filter=Book --force` caso queira apenas uma tabela.

```
# ./micro.sh doctrine orm:convert-mapping --from-database yaml ./Infrastructure/Persistence/Doctrine/Mappings --namespace=Domain\\\\Entities\\\\
```

#### Gerar Entidade a partir do arquivo Yaml
* Use `--filter=Book` caso queira apenas uma entidade.

```
# ./micro.sh doctrine orm:generate-entities .
```

#### Gerar script de atualização do banco de dados
Gera um script sql para atualização de banco de dados a partir das alterações feitas no arquivo YAML.

```
# ./micro.sh doctrine orm:schema-tool:update --dump-sql
```

#### Atualiza banco de dados
Este comando deve ser utilizado com cuidado pois atualiza diretamente o banco de dados de acordo com alterações no arquivo YAML.

```
# ./micro.sh doctrine orm:schema-tool:update --force
```

### Docker

```
# ./micro.sh
```
 
