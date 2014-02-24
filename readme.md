# Exemple de code pour thème WordPress

## Les fichiers de base

[`style.css`](https://github.com/ppierre/base-theme-wordpress/blob/master/style.css#L2-5) : Donnez un nom à votre thème
[`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut, une place pour commencer.

### Les "include"

**Ne pas utiliser `include` de PHP. WordPress à des [fonctions spécialisées pour cela](http://codex.wordpress.org/Include_Tags)**

Regrouper le code commun à vos pages avec :
* [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L2) : sera inclus dans votre template par [`get_header()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L12-13)
* [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L1) : sera inclus dans votre template par [`get_footer()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L32-33)

Le code HTML généré est celui retourné par votre fichier de template qui lui même inclut d'autres fichiers. Il n'est donc pas étonnant de débuter une balise dans [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L3-4) est de la finir dans [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L22).

### Les fichiers CSS et JavaScript

Ne pas les placer dans vos templates. Laisser WordPress le faire pour vous.
* Déclarer vos fichiers CSS dans le fichier [`functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L31-35)
  * WordPress les placera dans vos pages par le biais de [la fonction `wp_head()` placée à la fin de HEAD](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L7-10).
* Il existe la même [fonctionnalité pour JavaScript (*WP codex*)](http://codex.wordpress.org/Function_Reference/wp_enqueue_script).
  * [Simplement lui indiqué le chemin comme pour les feuilles de style](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L37-41), bonus vous pouvez dire que votre script à besoin de jQuery : WordPress le chargera pour vous.
  * On peut optimiser le chargement des scripts en les plaçant à la fin de BODY ([wp_footer()](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L17-19)) ou en les chargeant de façon asynchrone.

Rq : La fonction utilisée pour le lien du fichier CSS : [`get_stylesheet_directory_uri`](http://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri), peut être utile pour intégrer des liens vers des éléments statiques dans vos templates. Mais je vous décourage de faire cela. Mettez les en place par les CSS, il suffit alors de faire un lien relatif depuis le code du fichier CSS.

## Les Templates

Ce sont eux qui affichent le contenu par le biais de la ['boucle' WordPress](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L16-30).
* [`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2-9) : Template par défaut
* [`single.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single.php#L2-5) : Template pour afficher un seul Article (affichage complet).

`index.php` n'est pas l'endroit où vous devez placer en premier le code de vos pages. Préférez un template plus approprié :
* `archive.php` pour les listes d’Articles
* `home.php` ou [`front-page.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L2) pour une page ou une liste suivant les réglages
*[http://codex.wordpress.org/Template_Hierarchy](http://codex.wordpress.org/Template_Hierarchy)*

## Les types personnalisés

WordPress possède deux types (Post et Page). Mais vous pouvez ajouter vos propres types de contenu :
* [Le définir dans `functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L44-66)
* Faire un template [`single-$nomDuType.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L2-3) qui l'affiche (Eg complètement)
* Faire un template [`archive-$nomDuType.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/archive-projet.php#L2-3) qui affiche la liste (Eg liens)

Quand vous faites un type personnalisé, vous devez réfléchir à :
* [Son identifiant dans le code](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L49-50)
* [Le nom affiché à l'utilisateur](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L53-54)
* [Les fonctionnalités de WordPress qui vous sont utiles](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L59-61)
*[http://codex.wordpress.org/Function_Reference/register_post_type](http://codex.wordpress.org/Function_Reference/register_post_type)*

Lire la documentation et penser à l'option `supports` qui sert à dire quelles fonctionnalités de WordPress sont utiles à votre nouveau contenu.

## Les taxonomies personnalisées

WordPress possède deux taxonomies (Tag et Category). Mais vous pouvez ajouter vos propres classements (taxonomies) :
* [La définir dans `functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L68-85)
* Faire un template [`taxonomy-$nomDeLaTaxonomie.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/taxonomy-competences.php#L2-4) qui l'affiche la liste des contenus correspondants
  * Mais aussi, on peut faire un template [`taxonomy-$nomDeLaTaxonomie-$etiquette.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/taxonomy-competences-CSS.php#L2-5) qui affiche la liste pour une certaine "étiquette".

Quand vous faites une taxonomie personnalisée, vous devez réfléchir à :
* [Son identifiant dans le code](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L73-74)
* [Le nom affiché à l'utilisateur](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L79-80)
* [Quels contenus va-t-elle classer (un ou plusieurs) ?](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L75-76)
*[http://codex.wordpress.org/Function_Reference/register_taxonomy](http://codex.wordpress.org/Function_Reference/register_taxonomy)*

Lire la documentation et penser à l'option `hierarchical` qui sert à dire si la nouvelle taxonomie doit se comporter comme des Tag ou comme une Category.

## Les champs de saisie personnalisés

Quand vous ajoutez un type de contenu personnalisé, WordPress vous laisse choisir les champs de formulaire standard présenté à l'éditeur du site (option `supports` de `register_post_type`).

Mais vous pouvez ajouter vos propres champs de formulaire.

Dans l'interface d'administration, demander l'installation du plug-in "Meta Box".

Avec, vous pourrez :
* [Déclarer les champs de formulaire (dans `functions.php`).](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L87-116)
* [Afficher les valeurs saisies dans les templates.](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L15-40)

### Déclarer les champs de formulaire

Les champs de formulaires ajoutés par "Meta Box" sont [regroupés par Boîte](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L95-113).

Pour chaque Boîte vous devez penser :
* [Le titre de la boîte](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L97-98)
* [Sur quels types de contenu elle sera affichée](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L99-100)
* Sa [liste de champs de formulaire](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L102-112) et pour [chaque champ](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L103-111) :
  * [Son nom affiché](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L105-106)
  * [Son identifiant (unique)](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L107-108)
  * [Son type](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L109-110)

*[https://github.com/rilwis/meta-box/blob/master/demo/demo.php](https://github.com/rilwis/meta-box/blob/master/demo/demo.php)*

Lire la documentation et penser à regarder les options des différents types de champs.

### Afficher les valeurs personnalisées

Pour afficher dans le template les champs personnalisés :
* [Récupérez les "custom_fields"](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L15-16) : [C'est un tableau associatif](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L20-21).
* [Utilisez l'identifiant d'un champ personnalisé](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L28-29) pour lire ses valeurs : C'est un tableau.
  * Si la valeur est unique, [prendre l'indice `[0]`](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L34-36).

Ensuite, utiliser ce code [à l'endroit où vous voulez afficher la valeur](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L39-40).

Rq. les `print_r` sont juste pour les explications. [Ne pas les inclure dans vos pages !](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L18-38)

#### Fonctions de "meta box" pour lire les valeurs personnalisées

[`rwmb_meta`](http://www.deluxeblogtips.com/meta-box/helper-function-to-get-meta-value/) est une fonction fournie par "meta box" pour [afficher plus simplement les valeurs](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L42-46) :
* Si c'est une valeur unique:
  * Elle retourne simplement cette valeur
* Si c'est un type complexe (l'indiquer en argument à l'appel)
  * Elle retourne un tableau avec des clefs pour les valeurs
* Si vous avez utilisé la propriété `'clone' => true`
  * Elle retourne un tableau, __vous devez obligatoirement passer par elle dans ce cas__.

## Les menus

### Menu défini par l'éditeur du site

Ce sont les menus qui peuvent être personnalisés dans l'interface d'administration.
* [Dire que votre thème supporte cette fonctionnalité.](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L15-16)
* [Définir pour chaque menu son identifiant et le nom affiché à l'utilisateur.](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L22-23)
* [Ajouter au template le code pour ajouter le menu correspondant à un identifiant.](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L19-24)

### Menu intégré au template 

#### Généré par WordPress

Si vous avez défini des taxonomies personnalisées, vous voulez sans doute permettre au visiteur du site d'utiliser ces "classements" pour naviguer sur le site.

Simplement, [demandez à WordPress de faire un menu (liste)](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L5-8) avec les termes de votre taxonomie.

#### Par le code

Il existe des fonctions donnant l'URL :
* [Lien vers la liste des éléments pour un terme d'une taxonomie](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L9-10)
* [Lien vers l'archive d'un type personnalisé](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L11-12)

#### Par une seconde "boucle"

Si vous voulez afficher deux contenus sans rapport sur la même page, vous devez [faire une seconde boucle](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L23-42) :
* [La classe WP_Query retourne un objet qui pilote cette boucle.](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L26-27)
* [La boucle se fait comme d'habitude, simplement en utilisant l'objet.](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L28-30)

[*Lire la documentation de WP_Query !*](http://codex.wordpress.org/Class_Reference/WP_Query#Parameters) Pour connaître ses paramètres.

## Modifier la requête de WordPress

Vous ne devez pas utiliser WP_Query pour changer le contenu affiché par défaut (sauf pour les pages statiques). Il faut modifier la requête faite par WordPress.

Vous devez :
* [Mettre en place un filtre pour changer la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L118-124)
* [Déterminer si c'est la page dont vous voulez modifier la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L126-127)
* [Modifier les paramètres de la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L128-129)

## Liste triée par taxonomie

Quand l'on utilise une taxonomie, il existe une page pour chaque terme (`/competences/HTML`, `/competences/CSS`...).

Si vous voulez faire une page qui liste tous les contenus triés suivant les termes de la taxonomie :
* Dans l'interface d'administration, faire une page statique du même nom que la taxonomie (elle sera affichée à l’URL `/competences`)
* Placer [un code affichera vos contenus triés](https://github.com/ppierre/base-theme-wordpress/blob/master/page-competences.php#L18-61), dans le template spécifique à la page ([`page-competences.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/page-competences.php#L2-3))
  * Rq: le code fourni fait plusieurs requêtes, ce qui n'est pas une bonne pratique. Mais bon... c'est pour rester simple.
