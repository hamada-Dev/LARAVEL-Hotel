<p align="center"><a href="https://github.com/hamada-Dev/LARAVEL-Hotel/" target="_blank"><img src="https://github.com/hamada-Dev/LARAVEL-Hotel/blob/master/1.PNG" width="100%"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Project

it is required to make a 3-Tier Booking System for a Hotel that has several branches. 
The application should be composed of the following components.

1. Booking Database (SQL Server)
2. Web service (API) to have all the logic of the system, e.g. find availability for the 
selected time, book, cancel, update the DB with the booked or cancelled room(s). 
(.Net/ C#)
3. Application interface Back-end (ASP.Net MVC/C#), this should NOT have any logic 
and should only communicate with the Web service (API).
4. Application interface Front-end (HTML, CSS, Bootstrap, JavaScript, jQuery)
5. A report-like page to display all the rooms in the hotel and their status, e.g., booked, 
available. This page should authenticate the user before displaying the report.


## install 
- **Install Xampp to you pc and run it**
- **open partion C:\xampp\htdocs\**
- **open cmd**
```
git clone https://github.com/hamada-Dev/LARAVEL-Hotel.git
```
- **then run**
```
composer update
```
- **then run**
```
cp .env.example .env
```
- **open phpMyAdmin and create Database**
- **add username and password in .env file**
```
DB_DATABASE=hotel
DB_USERNAME=root
DB_PASSWORD=
```
- **run this commend to create DB**
```
php artisan migrate:fresh --seed
```
```
php artisan serve
```
- **open browser**
- ``http://127.0.0.1:8000/``
- **login to admin with**
```
username : super@eg.com
password : 12345
```

## the stages

- **understand business requirements**
- **Define a proper ER Model**
- **Database Design**
- **Application Model**
- **Application Controller**
- **Application View**
- **Application interface Front-end 
(HTML, CSS, Bootstrap, JavaScript, 
jQuery)**

- **Application Api**


## Application Api
- **login**
```
http://127.0.0.1:8000/api/auth/login
-### Request
        username : super@eg.com
        password : 12345
 - ##Response
 {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYzNTQ3NzkzNiwiZXhwIjoxNjM1NDgxNTM2LCJuYmYiOjE2MzU0Nzc5MzYsImp0aSI6InJpVGhQNWdpR1dkV0tWWDAiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.XMVtzYMerQhreGKRyA1PYIwJdAz31xa4qZOCt4bcNGM",
    "token_type": "bearer",
    "expires_in": 3600
}
```
```
http://127.0.0.1:8000/api/auth/me
{
    "id": 1,
    "name": "Super",
    "email": "super@eg.com",
    "phone": null,
    "email_verified_at": null,
    "image": null,
    "status": 0,
    "created_at": "2021-10-28T13:48:13.000000Z",
    "updated_at": "2021-10-28T13:48:13.000000Z",
    "image_path": "http://127.0.0.1:8000/uploads/user_images/default.png"
}
```

```
http://127.0.0.1:8000/api/branch
{
    "success": true,
    "data": [
        {
            "id": 1,
            "updated_at": "8 hours ago",
            "translate": [
                {
                    "locale": "ar",
                    "name": "فرع مدينه نصر ",
                    "description": "الفرع الاول من الفندق 5 نجوم"
                },
                {
                    "locale": "en",
                    "name": "Nasr City Branch",
                    "description": "The first branch of the hotel is 5 stars"
                }
            ]
        },
        {
            "id": 2,
            "updated_at": "8 hours ago",
            "translate": [
                {
                    "locale": "ar",
                    "name": " فرع مدينه العاشر ",
                    "description": "الفرع الثاني من الفندق 5 نجوم"
                },
                {
                    "locale": "en",
                    "name": "10th City Branch",
                    "description": "The second branch of the hotel is 5 stars"
                }
            ]
        }
    ],
    "message": "success"
}
```
```
http://127.0.0.1:8000/api/reservation
- **Request**
   {
    "reservationData" : [
                {
                    "room_id"       : 1,
                    "person_number" : 2,
                    "start_at"      : "2021-11-15",
                    "end_at"        : "2021-12-5"
                }, 
                   {
                    "room_id"       : 2,
                    "person_number" : 1,
                    "start_at"      : "2021-11-1",
                    "end_at"        : "2021-11-10"
                }
            ],
        "userData" :
                {
                    "user_id"  : 2,
                    "paid"     : 1700
                }
}
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
