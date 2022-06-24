# Pros-Consulte #

Test technique de Pros-Consulte.

## Installation ##

git clone https://github.com/pros-consulte/test-technique.git

composer install

yarn install

symfony console doctrine:database:create

symfony console doctrine:migration:migrate

symfony console doctrine:fixtures:load

symfony serve

## Test technique ##

Ce projet liste une série de psychologues sur la page d'accueil.

Travail demandé :

- [ ] Afficher la liste des psychologues en mettant les psychologues "En ligne" en premier.

- [ ] Créer une page "Détail" pour afficher les informations complètes du psychologue

- [ ] Créer le système d'authentification (avec formulaire)

- [ ] Créer une interface d'administration, accessible par le role ROLE_ADMIN.

- [ ] Dans l'espace admin, afficher la liste des psychologues et créer un formulaire pour ajouter un psychologue

- [ ] Créer une entité Appel: date (datetime), specialist (ManyToOne)

- [ ] Sur la page d'accueil, au clique sur Appeler, créer une nouvelle ligne d'Appel en base de données

- [ ] Afficher la liste des appels (date, psycholgue) dans l'admin
