# Projecte de Laravel i Vue
### Edgar Nos i Pau Salamanca

## Requesitos Maquina Local
- Xampp (Apache i MySQL)
- Composser
- NodeJs

## Como Desplegar
### Clonar Repositorio 

```bash
git clone https://github.com/ZeldBerk/laravel_vue
```

### Instalar vía Composer

```bash
composer install
```

### Copiar el fichero .env.example  a .env edita las credenciales y la url


### Generar Application Key

```bash
php artisan key:generate
```

### Migrar base de datos

```bash
php artisan migrate
```

### Lanzar Seeders

```bash
php artisan db:seed
```

### Crear el stortage Link

```bash
php artisan storage:link
```

### Instalar las dependencias de Node

```bash
npm install

npm run dev
```
### Lanzar a producción

```bash
php artisan serve
```
