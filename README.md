# TestWP - Plugin de gestion d'événements

## Description
Plugin WordPress permettant de gérer des événements avec Custom Post Type, taxonomies, champs personnalisés et chargement dynamique AJAX.

## Fonctionnalités
- Custom Post Type "event"
- Taxonomies "genre" et "type"
- Champs personnalisés "lieu" et "tarif"
- Shortcode [events] avec filtre par genre
- Design responsive
- Chargement dynamique "Voir plus" (AJAX) - 8 événements par lot

## Installation

### Méthode 1 : Téléversement du ZIP
1. Téléchargez le fichier `testwp.zip`
2. Allez dans **Extensions → Ajouter** sur WordPress
3. Cliquez sur **Téléverser une extension**
4. Sélectionnez le fichier ZIP et cliquez sur **Installer maintenant**
5. Cliquez sur **Activer l'extension**

### Méthode 2 : Installation manuelle
1. Décompressez le fichier ZIP
2. Déposez le dossier `testwp` dans `/wp-content/plugins/`
3. Activez le plugin dans le menu **Extensions** de WordPress

## Utilisation

### Créer un événement
- Allez dans **Événements → Ajouter**
- Remplissez le titre
- Ajoutez lieu et tarif dans la metabox
- Assignez un genre et un type

### Shortcode

Afficher tous les événements :
[events]

Filtrer par genre :
[events genre="formation"]

### Comportement du chargement
- Les 8 premiers événements s'affichent au chargement de la page
- Cliquez sur le bouton **"Voir plus"** pour charger 8 événements supplémentaires
- Le bouton disparaît automatiquement quand tous les événements sont affichés
- Le filtre par genre est conservé pendant le chargement

## Structure du plugin
```
testwp/
├── testwp.php                    # Fichier principal
├── README.md                     # Documentation
├── index.php                     # Sécurité
├── assets/
│   ├── css/
│   │   ├── index.php
│   │   └── events.css            # Styles des événements
│   └── js/
│       ├── index.php
│       └── events.js             # Script AJAX pour "Voir plus"
└── includes/
    ├── index.php
    ├── post-type.php             # Déclaration du CPT event
    ├── taxonomies.php            # Déclaration des taxonomies
    ├── meta-box.php              # Gestion des champs lieu et tarif
    └── shortcode-events.php      # Shortcode et logique AJAX
```

## Fichiers JavaScript et AJAX

Le plugin utilise AJAX pour le chargement dynamique :
- **Action WordPress** : `testwp_loadmore`
- **Nonce de sécurité** : `wp_create_nonce('testwp_loadmore')`
- **Sécurisation** : Vérification `check_ajax_referer` côté serveur

## Prérequis
- WordPress 6.0 ou supérieur
- PHP 7.4 ou supérieur
- JavaScript activé (nécessaire pour le bouton "Voir plus")

## Version
1.0.0

## Licence
GPL v2 ou ultérieure