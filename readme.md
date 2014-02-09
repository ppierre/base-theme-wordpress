# Exemple de code pour thème WordPress

## Les fichiers de base

[`style.css`](https://github.com/ppierre/base-theme-wordpress/blob/master/style.css#L2-5) : Donnez un nom à votre thème
[`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut, une place pour commencer.

### Les "include"

**Ne pas utiliser `include` de PHP. WordPress à des [fonctions spécialisées pour cela](http://codex.wordpress.org/Include_Tags)**

Regrouper le code commun à vos pages avec :
* [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L2) : sera inclus dans votre template par [`get_header()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L12-13)
* [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L1) : sera inclus dans votre template par [`get_footer()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L32-33)

Le code HTML généré est celui retourné par votre fichier de template qui lui même inclut d'autres fichiers. Il n'est donc pas étonnant de débuter une balise dans [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L3-4) est de la finir dans [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L18).

### Les fichiers CSS et JavaScript

Ne pas les placer dans vos templates. Laisser WordPress le faire pour vous.
* Déclarer vos fichiers CSS dans le fichier [`functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L26-42)
* WordPress les placera dans vos pages par le biais de [la fonction `wp_head()` placée à la fin de HEAD](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L7-10).
* Il existe la même [fonctionnalité pour JavaScript (*WP codex*)](http://codex.wordpress.org/Function_Reference/wp_enqueue_script). Avec une fonction [`wp_footer()`placée à la fin de BODY](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L13-15).

## Les Templates

Ce sont eux qui affichent le contenu par le biais de la ['boucle' WordPress](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L16-30).
* [`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut
* [`single.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single.php#L2-5) : Template pour afficher un seul Article (affichage complet).

`index.php` n'est pas l'endroit où vous devez placer en premier le code de vos pages. Préférez un template plus approprié :
* `archive.php` pour les listes d’Articles
* `home.php` ou `front-page.php` pour une page ou une liste suivant les réglages
*[http://codex.wordpress.org/Template_Hierarchy](http://codex.wordpress.org/Template_Hierarchy)*

## Les types personnalisés

WordPress possède deux types (Post et Page). Mais vous pouvez ajouter vos propres types de contenu :
* Le définir dans `functions.php`
* Faire un template `single-$nomDuType.php` qui l'affiche (Eg complètement)
* Faire un template `archive-$nomDuType.php` qui affiche la liste (Eg liens)

Quand vous faites un type personnalisé, vous devez réfléchir à :
* Son identifiant dans le code
* Le nom affiché à l'utilisateur
* Les fonctionnalités de WordPress qui vous sont utiles
*[http://codex.wordpress.org/Function_Reference/register_post_type](http://codex.wordpress.org/Function_Reference/register_post_type)*

Lire la documentation et penser à l'option `supports` qui sert à dire quelles fonctionnalités de WordPress sont utiles à votre nouveau contenu.

## Les taxonomies personnalisées

WordPress possède deux taxonomies (Tag et Category). Mais vous pouvez ajouter vos propres classements (taxonomies) :
* La définir dans `functions.php`
* Faire un template `taxonomy-$nomDeLaTaxonomie.php` qui l'affiche la liste des contenus correspondants
  * Mais aussi, faire un template `taxonomy-$nomDeLaTaxonomie-$etiquette.php` qui affiche la liste pour une certaine "étiquette".

Quand vous faites une taxonomie personnalisée, vous devez réfléchir à :
* Son identifiant dans le code
* Le nom affiché à l'utilisateur
* Quels contenus va-t-elle classer (un ou plusieurs) ?
*[http://codex.wordpress.org/Function_Reference/register_taxonomy](http://codex.wordpress.org/Function_Reference/register_taxonomy)*

Lire la documentation et penser à l'option `hierarchical` qui sert à dire si la nouvelle taxonomie doit se comporter comme des Tag ou comme une Category.

## Les champs de saisie personnalisés

Quand vous ajoutez un type de contenu personnalisé, WordPress vous laisse choisir les champs de formulaire standard présenté à l'éditeur du site (option `supports` de `register_post_type`).

Mais vous pouvez ajouter vos propres champs de formulaire.

Dans l'interface d'administration, demander l'installation du plug-in "Meta Box".

Avec, vous pourrez :
* Déclarer les champs de formulaire (dans `functions.php`)
* Afficher les valeurs saisies dans les templates.

### Déclarer les champs de formulaire

Les champs de formulaires ajoutés par "Meta Box" sont regroupés par Boîte.

Pour chaque Boîte vous devez penser :
* Le titre de la boîte
* Sur quels types de contenu elle sera affichée
* Sa liste de champs de formulaire et pour chaque champ :
  * Son nom affiché
  * Son identifiant (unique)
  * Son type
*[https://github.com/rilwis/meta-box/blob/master/demo/demo.php](https://github.com/rilwis/meta-box/blob/master/demo/demo.php)*

Lire la documentation et penser à regarder les options des différents types de champs.

### Afficher les valeurs personnalisées

Pour afficher dans le template les champs personnalisés :
* Récupérez les "custom_fields" : C'est un tableau associatif.
* Utilisez l'identifiant d'un champ personnalisé pour lire ses valeurs : C'est un tableau.
  * Si la valeur est unique, prendre l'indice `[0]`.

Ensuite, utiliser ce code à l'endroit où vous voulez afficher la valeur.

## Les menus

### Menu défini par l'éditeur du site

Ce sont les menus qui peuvent être personnalisés dans l'interface d'administration.
* Dire que votre thème supporte cette fonctionnalité.
* Définir pour chaque menu son identifiant et le nom affiché à l'utilisateur.
* Ajouter au template le code pour ajouter le menu correspondant à un identifiant.

### Menu intégré au template 

Si vous avez défini des taxonomies personnalisées, vous voulez sans doute permettre au visiteur du site d'utiliser ces "classements" pour naviguer sur le site.

Simplement, demandez à WordPress de faire un menu (liste) avec les termes de votre taxonomie.
