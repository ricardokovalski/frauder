
## Instalação

### Para primeira instalação local
```
make first-install
```

---

## Makefile
Makefile é um arquivo para automatizar e executar comandos.
Podendo executar shell scripts é amplamente utilizado para automatizar montagens de ambientes e deploys.

**Referências**
- [Introdução ao Makefile](https://www.embarcados.com.br/introducao-ao-makefile/)
- [Como Funciona o Makefile](https://blog.pantuza.com/tutoriais/como-funciona-o-makefile)

**Instalação Linux**
```
sudo apt-get install make
```

## Comandos

### Para realizar build dos container
```
make build
```
### Para subir todos os containers
```
make up
```
### Para baixar todos os containers
```
make down
```
### Para baixar, buildar e subir todos os containers
```
make refresh
```
### Para acessar um container como Root
```
make in-root
```
### Para visualizar logs de todos os containers
```
make logs
```
### Para instalar as dependências do projeto
```
make composer-install
```
### Para rodar o composer dump no container php
```
make composer-dump
```
### Rodar migrations no container php
```
make migrate
```
### Rodar seeders no container php
```
make seed
```
### Reseta e recria o banco no container php
```
make refresh-db
```
### Rodar suites de teste
```
make tests
```
### Gerar Relatórios de testes
```
make tests-resports
```
### Para listar todos os comandos make disponíveis
```
make help
```

