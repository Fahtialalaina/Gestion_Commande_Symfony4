# Gestion_Commande_Symfony4
Projet ENI L3 2019

Pour lancer ce projet:
1) Cloner le projet
  $git clone https://github.com/Fahtialalaina/Gestion_Commande_Symfony4.git
  $cd Gestion_Commande_Symfony4
2) Installer les dépendances:
  $composer install
3) Creer la base de données et faire la migration:
  $php bin/console doctrine:database:create
  $php bin/console make:migration
  $php bin/console doctrine:migrations:migrate
