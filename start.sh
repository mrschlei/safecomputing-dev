#!/bin/sh

# for use with drupal:8.4.2 image

# Redirect logs to stdout and stderr for docker reasons.
ln -sf /dev/stdout /var/log/apache2/access_log
ln -sf /dev/stderr /var/log/apache2/error_log

# Apache config files if /etc/apache2 is ServerRoot
ln -sf /scd-secret/apache2.conf /etc/apache2/apache2.conf
ln -sf /scd-secret/ports.conf /etc/apache2/ports.conf
ln -sf /scd-secret/settings.php /var/www/html/sites/default/settings.php
ln -s /var/www/html/ /var/www/html/dataguide
mkdir /var/www/html/sites/safecomputing-dev.openshift.dsc.umich.edu.dataguide
ln -s /scd-secret/dataguide-settings.php \
	/var/www/html/sites/safecomputing-dev.openshift.dsc.umich.edu.dataguide/settings.php

## SSL and Cosign
ln -sf /scd-secret/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
ln -sf /scd-secret/cosign.conf /etc/apache2/mods-available/cosign.conf
ln -sf /scd-secret/USERTrustRSACertificationAuthority.pem /etc/ssl/certs/USERTrustRSACertificationAuthority.pem
ln -sf /scd-secret/AddTrustExternalCARoot.pem /etc/ssl/certs/AddTrustExternalCARoot.pem
ln -sf /scd-secret/sha384-Intermediate-cert.pem /etc/ssl/certs/sha384-Intermediate-cert.pem
ln -sf /scd-secret/safecomputing-dev.openshift.dsc.umich.edu.cert /etc/ssl/certs/safecomputing-dev.openshift.dsc.umich.edu.cert
ln -sf /scd-secret/safecomputing-dev.openshift.dsc.umich.edu.key /etc/ssl/private/safecomputing-dev.openshift.dsc.umich.edu.key
# Rehash command needs to be run before starting apache.
c_rehash /etc/ssl/certs

a2enmod ssl
a2enmod include
a2ensite default-ssl 

# set SGID for www-data 
chown -R www-data.www-data /var/www/html /var/cosign
chmod -R 2775 /var/www/html /var/cosign

/usr/local/bin/apache2-foreground
