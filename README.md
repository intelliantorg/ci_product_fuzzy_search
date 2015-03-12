# CodeIgniter Product Fuzzy Search

Requires CodeIgniter 2.2.0 (has not been tested on other versions)

### Usage Instructions

For a quick trial follow these steps:

1. Execute product.sql on the CI connected database to create the Product table

2. Load some sample product data in the table

3. Place the files from the repository in the respective paths of your CI setup

4. Include the following lines 
```$route['search/searchbar']='search/searchbar'; $route['search']='search/index';``` in your routes.php file below the default_controller route

5. Access the search feature at \<site_base_url\>/search
