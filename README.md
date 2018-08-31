# Slim Microservices

Api voltada a uma estrutura de microservices. 

Cada aplicação deve ser totalmente independente, ao subir uma aplicação de Books(exemplo), a aplicacao de autenticação nao deve ser afetada.



## Dicas
 
- Gerar arquivo Yaml a partir do banco de dados
'''
./micro.sh doctrine orm:convert-mapping --from-database yaml ./Infrastructure/Persistence/Doctrine/Mappings --namespace=Domain\\\\Entities\\\\
'''