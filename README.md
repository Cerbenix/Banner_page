# Banner Page
![image](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
![image](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![image](https://img.shields.io/badge/Material%20UI-007FFF?style=for-the-badge&logo=mui&logoColor=white)
![image](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white)
![image](https://img.shields.io/badge/Laravel-FF2D20.svg?style=for-the-badge&logo=Laravel&logoColor=white)


Banner managment and display project.

## Take a look

Banner page - https://banner-page.000webhostapp.com/

Banner managment page - https://banner-page.000webhostapp.com/admin/banners

### Banner managment page
![fe13227094bc841aac137a65d7f6c320](https://github.com/Cerbenix/Banner_page/assets/124684938/49e3581e-0d2e-4af5-a4ff-701214740be7)

### Banner Page
![f991a87a54b6cbeb7c2a3c16cc75af07](https://github.com/Cerbenix/Banner_page/assets/124684938/8a9d11f5-c686-4197-8653-5f15f52fa458)

## Description

Laravel 8 backend api

React frontend with TailwindCSS, Typescript, Materil-UI 

Features included:

1. Banners can be added to differant positions and with differant target types - new window, same window
2. Each banners url can be set
3. Each view of a banner is recorded in the backend
4. Each click on a banner is recorded once per page reload
5. All slider banners are shown in a carousel
6. Sidebar and footer banners are loaded randomly if more than has been set for that position

## Project Setup

#### Install
```
composer install
```

```
cd .\banner_frontend\
```

```
npm install
```

#### Setup .env file

```
cp .env.example .env
```

You will need to setup the database connection.

```
php artisan key:generate
```

#### Create database

```
php artisan migrate
```

#### Run project locally

Run backend

```
php artisan serv
```

```
http://127.0.0.1:8000/admin/banners
```

Run frontend

```
cd .\banner_frontend\
```

```
npm run dev
```

```
http://localhost:5173/
```
