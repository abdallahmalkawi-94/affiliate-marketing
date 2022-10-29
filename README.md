<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

This project is contain only api to register user and login, and should be call it from SPA Framework Like React, Vue ...etc.

## Register API

- SPA Framework should be have a page to register user and the information should be like this:
    * name
    * email (unique and vaild)
    * phone (unique)
    * birthdate (optional)
    * user image (size 5MB)
    * password
- The request pass through validation middleware and this middleware using to check the data is valid regard the role defined
    $roles = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'birthdate' => 'nullable|date',
            'user_image' => 'required|image|size:5120',
            'password' => ['required', 'confirmed' , Password::min(8)->letters()->numbers()]
        ];

- In the controller we should check if the register url has ref code and we will using to a code to get referral user id.

- return json response contain 
    * status (true/false)
    * message 

## Login API

- The request should be has email and password
- The request pass through two middleware for validation and authentication to check the email and password. 
- return json response contain 
    * status (true/false)
    * message 

## Category API

- The user can be add own category or using predefined category
- In category should be flag to know the category is Income Or Expenses

## Transaction API

- The user can add his transaction (income or expenses)
- The wallet balance should be increase or decrease depands on transaction
- If the transaction amount expenses more than waleet balance the user can't add transaction