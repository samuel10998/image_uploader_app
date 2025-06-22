# Používa základný obraz PHP verzie 8.2 s webovým serverom Apache.
# Tento obraz obsahuje predinštalované PHP 8.2 a Apache server, ktoré sú pripravené na spúšťanie PHP aplikácií.
FROM php:8.2-apache

# Kopíruje súbor `index.php` z lokálneho priečinka (kde sa nachádza Dockerfile)
# do priečinka `/var/www/html/` v kontajneri, ktorý je štandardným priečinkom
# pre webové súbory v Apache serveri. Tento súbor bude slúžiť ako vstupný bod
# pre webovú aplikáciu.
COPY index.php /var/www/html/