# Dockerfile para PHP 7 com Composer 1.10 e Zend Framework 2

# Use uma imagem oficial com PHP 7.4 e Apache
FROM php:7.4-apache

# Instale dependências e extensões PHP necessárias
RUN apt-get update && \
    apt-get install -y git unzip && \
    docker-php-ext-install pdo pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Instale o Composer 1.10 para compatibilidade com Zend Framework 2
#RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.26 --install-dir=/usr/local/bin --filename=composer

# Instale o Composer 2 (a versão mais recente)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \

# Habilite o mod_rewrite do Apache para Zend Framework
RUN a2enmod rewrite

# Configuração de permissões para o diretório /var/www/html
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Adicione uma configuração personalizada para o diretório raiz
RUN echo "<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/sites-available/000-default.conf

RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Copie o package.json e package-lock.json para o container
COPY package.json package-lock.json /var/www/html/

# Instale as dependências do Node.js (node_modules)
RUN npm install --prefix /var/www/html

# Defina as permissões para o diretório
RUN chown -R www-data:www-data /var/www/html && chmod -R 777 /var/www/html

# Defina o diretório de trabalho como a pasta "public" (onde o index.php está)
WORKDIR /var/www/html/public

# Exponha a porta 80 do Apache
EXPOSE 80

# Comando para iniciar o Apache quando o container for iniciado
CMD ["apache2-foreground"]

##########################################
#Executar o  docker-compose up
#########################################
#Se precisar
#docker-compose run --rm composer install

##composer require doctrine/orm:^2.6 doctrine/doctrine-module:^1.1 doctrine/doctrine-orm-module:^1.1 --with-all-dependencies