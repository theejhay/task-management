## About this project
This is a Basic Task Management Web Application built using Laravel 8.0. It has the following functionality:

The Following CRUD Features have been implemented:

- Users can create and add a new Task
- Users can View all Tasks 
- Users can update a Task by editing and making changes
- Users can delete a Task

**Authentication:**
- Users can Register and Login, as well as reset their password.
- To access any part of the system users must first login or register. The app also uses laravels security features to enforce this and make sure restricted webpages cannot be accessed by unauthorised users.
- Users can also view their profile by going to the My Account page.

**Search:**
- Users can search tasks by entering whole or part of the task name into the search box.

**Re-Ordering**
- Users can re-order task directly from the task page.

## How to Install
Clone the repository

Go to the folder where cloned using `cd` command on your cmd or terminal

Run `composer install` on your cmd or terminal

Copy `.env.example` file to `.env` on the root folder of the project.

Open the `.env` file and change the database name `(DB_DATABASE)`. 
The `DB_USERNAME` and `DB_PASSWORD` should be set to your configuration.
If you would like to allow users to reset their password then you must also specify the mail server details in the `.env` file.

In terminal, from the root folder of the project run the following:

`php artisan key:generate`

`php artisan migrate`

`php artisan db:seed`

`npm install`

`npm run dev`

`php artisan serve`

You should then get a link to where the project is running. It is usually `localhost:8000`. 
You can go to this link in your browser. 

## Author
 Taiwo Ogunyemi

