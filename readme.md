
# LaraForm

This is a [Laravel](www.larevel.com) application that is a "clone" of [Google Form](https://www.google.com/forms/about/). It includes most of the Google Form features such as creating forms, form sharing, adding collaborators, viewing analyses of form responses by users and so on. It also has the feature where the creator of a form can choose to set the form open or close to users' responses. 

### Built With
 - [Laravel 5.7](https://laravel.com/docs/5.7)
 - [Bootstrap 3](https://getbootstrap.com/docs/3.3/) 
 - [MySQL](https://github.com/mysql) Database
 - [Google Chart](https://developers.google.com/chart/)

### Installation Instructions
 1. Run `https://github.com/kennedy-osaze/laraform.git` to clone the repository
 2. Run  `composer update`  from the projects root folder
 3. From the projects root run  `cp .env.example .env`
 4. Run `php artisan key:generate`
 5. Configure `.env` file as well as the files in the config folder to suite your needs
 6. Run `php artisan migrate` to set up MySQL database tables after the database has been created for the application and configured in the `.env` file.
 7. Configure supervisor using Laravel instructions (https://laravel.com/docs/5.6/queues#supervisor-configuration)
 8. Add `worker.log` to `/storage/logs` folder
 9. Add the following cron entry to your server: `* * * * * php /path-to-your-laraform-app/artisan schedule:run >> /dev/null 2>&1`
