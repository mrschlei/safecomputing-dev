#!/bin/sh

# for use with drupal:8.4.2 image

# Redirect logs to stdout and stderr for docker reasons.
ln -sf /dev/stdout /var/log/apache2/access_log
ln -sf /dev/stderr /var/log/apache2/error_log

# Apache config files if /etc/apache2 is ServerRoot
ln -sf /secrets/apache2/apache2.conf /etc/apache2/apache2.conf
ln -sf /secrets/apache2/ports.conf /etc/apache2/ports.conf

if [ -f /secrets/app/local.start.sh ]
then
  /bin/sh /secrets/app/local.start.sh
fi

## SSL and Cosign
ln -sf /secrets/apache2/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
ln -sf /secrets/apache2/cosign.conf /etc/apache2/mods-available/cosign.conf
ln -sf /secrets/ssl/USERTrustRSACertificationAuthority.pem /etc/ssl/certs/USERTrustRSACertificationAuthority.pem
ln -sf /secrets/ssl/AddTrustExternalCARoot.pem /etc/ssl/certs/AddTrustExternalCARoot.pem
ln -sf /secrets/ssl/sha384-Intermediate-cert.pem /etc/ssl/certs/sha384-Intermediate-cert.pem

# Rehash command needs to be run before starting apache.
c_rehash /etc/ssl/certs

a2enmod ssl
a2enmod include
a2ensite default-ssl 

# set SGID for www-data 
chown -R www-data.www-data /var/www/html /var/cosign
chmod -R 2775 /var/www/html /var/cosign

/usr/local/bin/apache2-foreground
