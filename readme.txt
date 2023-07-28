Downloading and Setting Up a Laravel Project from GitHub
=======================================================

This guide will walk you through the steps to download, set up, and run a Laravel project from GitHub. Ensure you have the necessary prerequisites installed, including Composer and a web server (e.g., Apache or Nginx) with PHP.

Step 1: Clone the Repository
---------------------------
1. Open a terminal or command prompt on your local machine.
2. Navigate to the directory where you want to store the Laravel project.
3. Run the following command to clone the GitHub repository:

====> git clone <https://github.com/Aynaabaji/mediusware_assesment.git>


Step 2: Install Dependencies
----------------------------
1. Change into the project directory:
2. Run the following command to install project dependencies using Composer:


===>composer install







Step 3: Configure Environment Variables
---------------------------------------
1. Rename the `.env.example` file to `.env`.
2. Open the `.env` file and set the necessary environment variables, such as the database connection details and application key.

Step 4: Generate an Application Key
-----------------------------------
1. Run the following command to generate a unique application key:

===>php artisan key:generate


Step 5: Set Up the Database
---------------------------
1. Create a new database for the project on your MySQL or PostgreSQL server.
2. Open the `.env` file and set the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables to match your database configuration.
    if you are running the project on the local host, then no need of DB_USERNAME and DB_PASSWORD.the DB_USERNAME will remain 'root' and the "DB_PASSWORD" will be blank.

Step 6: Run Migrations and Seeders (Optional)
---------------------------------------------
1. If the project contains database migrations and seeders, you can run them to set up the database with sample data:

===> php artisan migrate
===> npm install



Step 7: Start the Development Server
------------------------------------
1. Run the following command to start the Laravel development server:

===> php artisan optimize
===> php artisan serve


The server will be available at `http://localhost:8000` by default.

Step 8: Access the Application
------------------------------
1. Open your web browser and navigate to `http://localhost:8000` (or the URL of the development server if you specified a different port).

Congratulations! You have successfully downloaded, set up, and run the Laravel project from GitHub. Enjoy exploring and developing with your new Laravel application!

Please Note:
- If you are running on the local machine, then you must install the XAMPP first.
- Make sure to install all the necessary PHP extensions and dependencies required by your Laravel project.
- The steps provided assume a development environment; for production deployment, additional configurations and security measures may be required.
- Ensure to keep your `.env` file secure and not expose sensitive information when deploying to a live server.
- For more details and in-depth documentation, refer to the official Laravel documentation: https://laravel.com/docs





********************** if you face problems running the project *********************

i have also added a .zip file in the project folder. just extract it and first make a database in your phpmyadmin. then set that name in .env file in "DB_DATABASE" field. then run these commands.

===> php artisan migrate
===>php artisan optimize
===>php artisan serve

