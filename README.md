# Cortes y sistemas LARAVEL

Ciertas secciones de cortes estan en este sistema, algunas estan en el viejo, coexisten hasta que todo el sistema este aca.

---


## Indice

1. [Deployment](#deployment)
2. [Update](#update)
3. [Comandos utiles](#usefull-commands)

---

<a name="deployment"></a>
### Deployment

1) Requerimientos 
    * Composer [Web oficial](https://getcomposer.org/download/)
    * Supervisor `# apt install supervisor`
    * Cron `# apt install cron crontab`

2) Instalar un stack LEMP y agregar un virtual host a la carpeta `public`, de acuerdo a este virtualhost de ejemplo:

    ```
    server {
        listen 80;
        server_name example.com;
        root /example.com/public;
    
        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-XSS-Protection "1; mode=block";
        add_header X-Content-Type-Options "nosniff";
    
        index index.html index.htm index.php;
    
        charset utf-8;
    
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
    
        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }
    
        error_page 404 /index.php;
    
        location ~ \.php$ {
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
            fastcgi_index index.php;
            include fastcgi_params;
        }
    
        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
    ```

3) Instalar dependencias
    ```bash
    $ composer install
    ```

4) Permisos

    ```bash
    # chgrp -R www-data storage bootstrap/cache
    # chmod -R 775 storage boostrap/cache
    ```

5) Configuracion
    * Copiar .env.example a .env y editar variables de entorno `$ cp .env.example .env`
    * Agregar la app_key `$ php artisan key:generate`
    * Ejecutar migraciones `$ php artisan migrate`
    * Cron del scheduler
        1) Agregar este cron para el usuario \*\*\*USUARIO DEL PROYECTO\*\*\*
            ```txt
            * * * * * cd /***RUTA AL PROYECTO*** && ***RUTA A PHP*** artisan schedule:run >> /dev/null 2>&1
            ```
    * Workers persistentes
        1) Crear los archivos de configuracion de supervisor
        
            `/etc/supervisor/conf.d/cys-laravel-worker.conf`
            ```txt
            [program:cys-laravel-worker]
            process_name=%(program_name)s_%(process_num)02d
            command=php /***RUTA AL PROYECTO***/artisan queue:work --queue=default
            autostart=true
            autorestart=true
            user=***USUARIO DEL PROYECTO***
            numprocs=1
            ```

           `/etc/supervisor/conf.d/cys-laravel-email-worker.conf` 
            ```txt
            [program:cys-laravel-email-worker]
            process_name=%(program_name)s_%(process_num)02d
            command=php /***RUTA AL PROYECTO***/artisan queue:work --queue=emails --tries=3 --delay=1800  
            autostart=true
            autorestart=true
            user=***USUARIO DEL PROYECTO***
            numprocs=1
            ``` 
        2) Reiniciar supervisor
            ```
            # supervisorctl reread
            # supervisorctl update
            # supervisorctl start cys-laravel-worker:*
            # supervisorctl start cys-laravel-email-worker:*
            ```
        
6) Voilá, el proyecto deberia estar funcionando. 
    
---
    
<a name="update"></a>
### Update
```bash
$ git pull
$ composer install
$ php artisan migrate
$ php artisan queue:restart
# supervisorctl restart cys-laravel-email-worker:*
# supervisorctl restart cys-laravel-worker:*
```

---

<a name="usefull-commands"></a>
### Comandos utiles

<a name="versions"></a>
### Versiones entorno
1) Requerimientos 
    * Sistemas Opencore -> intranet -> php 5.6
    * Gestion Laravel -> intranet2 -> php 7.3
    * node -v -> v15.14.0
