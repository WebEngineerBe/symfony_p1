# symfony_p1
Test &amp; création d'un projet Symfony


//////////////////// Bug rencontrés pour cette version ///////////////////////////////
Symfony 4 : 
-----------
An error occurred while loading the web debug toolbar
https://stackoverflow.com/questions/50059794/symfony-4-an-error-occurred-while-loading-the-web-debug-toolbar

Solution : 
----------
composer require symfony/apache-pack

Do you want to execute this recipe?
    [y] Yes
    [n] No
    [a] Yes for all packages, only for the current installation session
    [p] Yes permanently, never ask again for this project
    (defaults to n): y
Host File:

127.0.0.1 symfony01.com
127.0.0.1 www.symfony01.com
httpd-vhosts.conf :

<VirtualHost *:80>
    ServerName symfony01.com
    ServerAlias www.symfony01.com   
    DocumentRoot "c:/wamp64/www/symfony01/public"
    <Directory  "c:/wamp64/www/symfony01/public/">
        Options +Indexes +Includes +FollowSymLinks +MultiViews
        AllowOverride All
        Require local
    </Directory>
</VirtualHost>
///////////////////////////////////////////////////

composer require symfony/thanks
composer require sensio/generator-bundle

https://stackoverflow.com/questions/50059794/symfony-4-an-error-occurred-while-loading-the-web-debug-toolbar

http://steevan-barboyon.blogspot.com/
http://www.phpbenchmarks.com/fr/
http://flux.neolao.com/page/30
https://symfony.com/roadmap/3.3
https://symfony.com/roadmap
https://github.com/symfony/symfony/issues/23630
https://symfony.com/doc/current/setup/web_server_configuration.html
https://packagist.org/