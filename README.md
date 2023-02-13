## CRUD API

<br>
The following provides a way to install the requirements for the application. 
<br> 

### Install 
---------------------------------------------------
##### 1. Clone Repository
```
git clone https://github.com/Marvelch/antikode.git
cd antikode
composer install
cp .env.example .env
```
##### 2. Open `.env` then change the following lines according to your database you want to use
```
DB_PORT=3306
DB_DATABASE=antikode
DB_USERNAME=root
DB_PASSWORD=
```
#### 3. Website installation
```
php artisan key:generate
```
#### 4. Run the application
```
php artisan serve
````
-------------------------------------------
#### Endpoint Access :

> Products
<ul>
    <li>/api/products</li>
    <li>/api/products/{id}/update</li>
    <li>/api/products/store</li>
    <li>/api/products/{id}/destroy</li>
</ul>

> Brands
<ul>
    <li>/api/brands/show</li>
    <li>/api/brands/{id}/update</li>
    <li>/api/brands/store</li>
    <li>/api/brands/{id}/destroy</li>
</ul>

> Outlets
<ul>
    <li>/api/outlets</li>
    <li>/api/outlets/{id}/update</li>
    <li>/api/outlets/store</li>
    <li>/api/outlets/{id}/destroy</li>
</ul>

> Sort By Distance
<ul>
    <li>/api/sort-by-distance</li>
</ul>
<br>

<img src="https://raw.githubusercontent.com/Marvelch/antikode/master/public/local/UpdateResult.jpg" width="600" height="400" />

<br>
<br>

> **Note**
> For sql queries already exist in the SQL folder :smile:

> **Warning**
> Must fill in the Brand table before filling in the Product and Outlet tables
