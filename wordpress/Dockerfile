FROM wordpress

COPY wp-content/plugins/ /var/www/html/wp-content/plugins/
COPY wp-content/themes/ /var/www/html/wp-content/themes/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 8080
