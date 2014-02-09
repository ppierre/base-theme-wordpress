# Exemple de code pour thème WordPress

## Les fichiers de base

[`style.css`](https://github.com/ppierre/base-theme-wordpress/blob/master/style.css#L2-5) : Donnez un nom à votre thème
[`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut, une place pour commencer.

### Les "include"

**Ne pas utiliser `include` de PHP. WordPress à des [fonctions spécialisées pour cela](http://codex.wordpress.org/Include_Tags)**

Regrouper le code commun à vos pages avec :
* [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L2) : sera inclus dans votre template par [`get_header()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L12-13)
* [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L1) : sera inclus dans votre template par [`get_footer()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L12-13)

Le code HTML généré est celui retourné par votre fichier de template qui lui même inclut d'autres fichiers. Il n'est donc pas étonnant de débuter une balise dans [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L3-4)) est de la finir dans [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L18).

### Les fichiers CSS et JavaScript

Ne pas les placer dans vos templates. Laisser WordPress le faire pour vous.
* Déclarer vos fichiers CSS dans le fichier [`functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L26-42)
* WordPress les placera dans vos pages par le biais de [la fonction `wp_head()` placée à la fin de HEAD](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L7-10).
* Il existe la même [fonctionnalité pour JavaScript (*WP codex*)](http://codex.wordpress.org/Function_Reference/wp_enqueue_script). Avec une fonction [`wp_footer()`placée à la fin de BODY](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L13-15).

## Les Templates

Ce sont eux qui affichent le contenu par le biais de la ['boucle' WordPress](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L16-30).
* [`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut
* [`single.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single.php#L2-5) : Template pour afficher un seul Article.

`index.php` n'est pas l'endroit où vous devez placer en premier le code de vos pages. Préférez un template plus approprié :
* `archive.php` pour les listes d’Articles
* `home.php` ou `front-page.php` pour une page ou une liste suivant les réglages
*[http://codex.wordpress.org/Template_Hierarchy](http://codex.wordpress.org/Template_Hierarchy)*