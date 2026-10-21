FROM serversideup/php:8.4-fpm-nginx

# Opcache is off by default in the base image; files never change inside a built image.
ENV PHP_OPCACHE_ENABLE=1

# Replaces the image's default site (Laravel-style, webroot /var/www/html/public).
COPY --chown=www-data:www-data conf/nginx/nginx-site.conf /etc/nginx/site-opts.d/http.conf.template
COPY --chown=www-data:www-data . /var/www/html
