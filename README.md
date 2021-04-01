
## Starting an MVC application

1. First, download the repo.
1. Run **composer update** to install the twig for View.
1. Configure your web server to have the **public** folder as the web root.
1. import **bootz.sql** file from root folder to your database.
1. Open (App/Config.php) and enter your database configuration data.



I use dependency Injection and repository pattern in this project .

take a look to DB design in **DBDesign.png** at root.

for FE, I used a bootstrap template.

can see any error log in app\logs folder.

## Important files

* Entities
    * `App\Models\*`
 * Routes
    * `public\index.php`
 * Controllers
    * `App\Controllers\*`
 * Repositories
    * `App\Repositories\*`   (All Interface In here)
 * Views
    * `App\Views\*` 
