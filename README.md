# Mira-house

### Mise en Place du VirtualHost

Le site fonctionne à l'aide d'un Virtualhost, vous devez donc le créer sur votre machine.

Guide pour Ubuntu:
1) Rendez-vous dans /etc/apache2/sites-available
2) Créez un répertoire mira-front.monposte.conf
3) Ouvrez un éditeur de texte et copiez les différentes commandes permettant la mise en place de votre Virtualhost:
```bash
	$> sudo nano mira-front.monposte.conf
```
ensuite: 
```
	<VirtualHost *:80>
		ServerName mira-front.monposte       
		DocumentRoot "/var/www/mira-house/front"       
		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined
	</VirtualHost>
```
4) Puis il faut rajouter les hosts. Pour cela ouvrez le fichier /etc/hosts à l'aide d'un éditeur de texte.

On rajoute cette ligne en dessous du localhost:	

```
	  127.0.0.1		mira-front.monposte
```

Si tout est bon, si vous faites un ping de votre url, vous devriez avoir une réponse du localhost. C'est signe que cela fonctionne

5) Enfin on retourne dans /etc/apache2/sites-available 

Dans votre terminal, entrez les deux commandes suivantes:
 ```bash
	$> sudo a2ensite mira-front.monposte.conf
```
6) Pour finir on restart le serveur à l'aide de la commande suivante:

(Toujours dans votre terminal)
```bash
	$> sudo service apache2 restart
```
Il pourra être intéréssant de faire la commande suivante necéssaire au bon fonctionnement du VirtualHost:

```bash
	$> sudo a2enmod headers 
```
Le VirtualHost est mis en place.

RAPPEL: Pensez à vérifier le status du serveur afin de voir si tout fonctionne correctement !! ( commande : sudo service apache2 status)

## Site pour increase en css

[CSS - Index](https://css-tricks.com/almanac/)
[CSS - Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)
[CSS - Animation](https://css-tricks.com/almanac/properties/a/animation/)
[CSS - Z-index](https://css-tricks.com/almanac/properties/z/z-index/)
[CSS - text-shadow](https://css-tricks.com/almanac/properties/t/text-shadow/)