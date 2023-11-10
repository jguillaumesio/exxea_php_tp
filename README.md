# MVC PHP

## Requirements
- PHP >= 8.1 (optional)
- MySQL (optional)
- Docker (optional)

## Installation

### Standard Installation (require PHP and MySQL)

If you prefer to install the project directly on your desktop, follow these steps:

1. Install MySQL on your host system if not already installed.

2. Create a MySQL user with the username "exxea" and password "password" and grant it all privileges on a database named "book."

3. Run the SQL script located at `db/init.sql` within the "book" database to initialize the necessary database schema.

4. [Clone this repository](https://github.com/jguillaumesio/exxea_php_tp.git).

5. Now from '/php/app' run ```php -S 127.0.0.1:8000```

### Docker installation
```
git clone https://github.com/jguillaumesio/exxea_php_tp.git
```
```
cd exxea_php_tp
```
```
docker compose up
```
Now just go to http://127.0.0.1:8000