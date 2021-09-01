# Dog Stroll

_Le site Dog Stroll est en cours de développement._

L'objectif est de permettre aux personnes ayant des chiens d'organiser et de participer à des ballades en compagnie de leurs animaux.
Les utilisateurs proposeront des évènements qui seront consultables après validation par l'administrateur depuis le tableau de bord.

## Prérequis et installation du projet

**Prérequis :**
* PHP 8
* Symfony 5.3
* MySQL
* Composer
* Mailtrap

**Installation :**

* Installer les dépendances
``$ composer install``
* Créer un compte mailtrap et modifier le fichier ``.env`` dans le répertoire du projet pour définir la valeur MAILER_DSN
* Lancer le serveur
``$ symfony server:start``

## API

Afin d'afficher la carte du point de départ de la ballade sur la page évènement :
* [Biblitohèque JavaScript Leaflet](https://leafletjs.com/)
* [API Static Tiles de Mapbox](https://docs.mapbox.com/api/maps/static-tiles/)
* [API Nominatim d'OpenStreetMap](https://nominatim.org/release-docs/develop/api/Search/)
