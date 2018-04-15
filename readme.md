# My Gym online

## Summary
1. [General dsescription](#generalDescription)
2. [Installation](#installation)
3. [Web interface](#webInterface)
   - [Users](#webInterfaceUsers)
   - [Topics](#webInterfaceTopics)
   - [Posts](#webInterfacePosts)
   - [Search engine](#webInterfaceSearchEngine)
   - [Online demo](#webInterfaceOnlineDemo)

<a name="generalDescription"></a>
## 1. General description
This online gym planner was developed using PHP7, Laravel 5.5, Bootstrap 4 and jQuery 3.3

It can create new users and plans, and assign plans to the users. Each plan can have many days, and each day many exercises.

<a name="installation"></a>
## 2. Installation
1. Clone the repository (https://github.com/AngelGris/mygymonline)
2. Create an empty database for this project in your database engine.
3. Configure the database connection in config/database.php file.
4. Copy or rename .env.example file to .env and change the database connection configuration there too. Optionally, the application name can be set in the .env file too. (If the application name has more than one word it’s required to enclose them in quotes, i.e. APP_NAME=“My App”)
5. In a command line window go to the Laravel project folder and update dependencies running `composer update`.
6. Still in Laravel’s project folder run `php artisan migrate` to create the tables in the database.
7. Now run `php artisan key:generate` to generate a unique encryption key for this Laravel instance.
8. Change permissions in storage folder to allow Laravel log everything: `sudo chmod -R 777 storage`.
9. Run `php artisan serve` in the command line to start Laravel server. Now you can enter your web browser and go to `http://localhost:8000` to see it working.

<a name="webInterface"></a>
## 3. Web interface
The dashboard shows some basic stats on the site (number of users, number of plans, etc).

In the header navigation bar you can browse to `Plans` and `Users` pages.

<a name="webInterfacePlans"></a>
### Plans
In the **Plans** page you can create new plans, add days to them and select the exercises for each day.

<a name="webInterfaceUsers"></a>
### Users
Users can be created in the **Users** page and assign plans to them.

<a name="webInterfaceOnlineDemo"></a>
### Online demo
An online demo can be found at http://35.163.165.1:5000/