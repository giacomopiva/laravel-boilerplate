@servers(['localhost' => '127.0.0.1'])

@task('rebuild', ['on' => ['localhost']])
    php artisan migrate:fresh 
    php artisan db:seed
@endtask

@task('clean', ['on' => ['localhost']])
    sudo php artisan optimize:clear
@endtask

@task('pint', ['on' => ['localhost']])
./vendor/bin/pint
@endtask

@task('test', ['on' => ['localhost']])
php artisan test
@endtask
