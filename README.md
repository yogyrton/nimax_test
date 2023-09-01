# Реализация RESTful api

## Порядок работы

- создать и добавить БД в .env и установить с ней соединение
- composer install
- npm install
- php artisan key:generate
- php artisan migrate --seed
- установить заголовок Accept - application/json
- указать перечисленные параметры в теле запроса

## КАТЕГОРИИ

index ---- api/categories
---

- `GET`

store ---- api/categories
---
POST

- `name`

destroy ---- api/categories/id
---
DELETE

- `id`

## ПРОДУКТЫ

index ---- api/products
---
GET

show ---- api/products/3
---
GET

- `id`

store ---- api/products
---
POST

- `name`
- `price`
- `categories[]`

update ---- api/products/3
---
POST

- `_method = PUT`
- `name`
- `price`
- `categories[]`

destroy ---- api/products/3
---
DELETE

- `id`

## Получение списка товаров

index ---- api/products
---

- Имя / по совпадению с именем `api/products?name=Test`
- id категории `api/products?category_id=3`
- Название категории / по совпадению с категорией `api/products?category_name=Test`
- Цена от `api/products?min_price=1000` – до `api/products?max_price=3000`       
- Опубликованные – да / нет  `api/products?is_published=1`  
- Не удаленные
