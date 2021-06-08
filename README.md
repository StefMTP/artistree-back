You will need PHP and composer to serve this application. 

The composer dependencies can be installed by running 'composer update' (if you have composer
in a global directory, otherwise follow the instructions found on the site https://getcomposer.org/doc/00-intro.md)

The Laravel application can be served with the command 'php artisan serve'.

You can check all the routes with the command 'php artisan route:list'.

We were working with a local database, so you will need to set up the mysql properties in the .env file according to your local machine's requirements. You can run all the migrations required to build the database with the command 'php artisan migrate'.

Laravel provides an MVC architecture to our website's backend.
The most important app files are:
- routes/api.php, which lists all the API routes we have
- Http/Controllers/... the directory in which all the Controllers are located. These files serve the purpose of application logic, providing CRUD operations on the app data. 
- database/migrations/... the directory in which all database migrations are located. In these files, the tables of the database can be built and altered accordingly.
- Models/... Models can be used to display the relationships between entities in our app, what data is fillable in the database tables, what should be hidden etc.

What we didn't manage to complete:
- Policies/Guards/Middlewares were not completed, these were the types of files that would help restrict our application based on the user roles, authentication status and user friendship status.
- Social Interactions were not completed, we had initialized a manual way to do it, but it proved lacking. We later found a library called laravel-acquaintances, which introduces friend requests, friend groups, friendships and other social interaction, around the pre-existing User model of Laravel. We had already began creating the tables (the creation logic is found in migrations), but did not manage to figure it out for our application logic in time.
- We also wanted to implement more logic on the Controllers, in order to provide utilities for smarter filtering and grouping based on keywords and tags such as post topics/statuses etc.
- The front end of our application, which is located in the artistree-front repository is built as a read-only version of the data stored in the database.