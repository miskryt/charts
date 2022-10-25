# Mixed project Charts
> Works using composer

1. ```cd wp-content/themes/YOURTHEME```
2. ```migrate database.migrate.sql```
3. ```clone this repo here```
4. ```move page-charts.php to the theme root```
5. ```composer install```
6. ```open charts/views/includes/head.blade.php and fix styles and js urls according to you theme```
7. ```navigate to https://localhost/charts```

https://localhost/charts - will open the archive page with the only list of uploaded files.

Click any file.
https://localhost/charts?file_id=111 will be opened. Page contains navigation bar at top with the list of
sheets the file includes. At the same time first sheet is loaded automatically on page.

Click any sheet url in the navbar, the page with content will open.

https://localhost/charts?upload=file - separate page just to upload files.

