Plugins :
- nwidart/laravel-modules https://nwidart.com/laravel-modules/v6/installation-and-setup
- yajra/laravel-datatables-oracle 
- yajra/laravel-datatables -> allinone https://yajrabox.com/docs/laravel-datatables/master/installation
- spatie/laravel-permission
- barryvdh/laravel-debugbar
- tymon/jwt-auth https://jwt-auth.readthedocs.io/en/develop/laravel-installation/
- laravel/sanctum
- lavary/laravel-menu https://github.com/lavary/laravel-menu 
- laravel-vuexy themes
  ``` 
	Plugin for using menu in front user. not an administator side
	use this plugin as the profile information
	and for management using Vuexy Laravel Menus
  ```

Installation :
  * composer install
  * php artisan key:generate
  * npm  install && npm run dev
  * php artisan db:seed --class=PermissionTableSeeder
  * php artisan db:seed --class=CreateAdminUserSeeder