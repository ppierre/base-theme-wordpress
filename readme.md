# Exemple de code pour theme WordPress

  * [Les fichiers de base](#les-fichiers-de-base)
    * [Les "include"](#les-include)
    * [Les fichiers CSS et JavaScript](#les-fichiers-css-et-javascript)
  * [Les Templates](#les-templates)
    * [Trouver les fichiers de template a utiliser](#trouver-les-fichiers-de-template-a-utiliser)
  * [Les types personnalises](#les-types-personnalises)
  * [Les taxonomies personnalisees](#les-taxonomies-personnalisees)
  * [Les champs de saisie personnalises](#les-champs-de-saisie-personnalises)
    * [Declarer les champs de formulaire](#declarer-les-champs-de-formulaire)
    * [Afficher les valeurs personnalisees](#afficher-les-valeurs-personnalisees)
    * [Fonctions de "meta box" pour lire les valeurs personnalisees](#fonctions-de-meta-box-pour-lire-les-valeurs-personnalisees)
  * [Les menus](#les-menus)
    * [Menu defini par l'editeur du site](#menu-defini-par-lediteur-du-site)
    * [Menu integre au template](#menu-integre-au-template)
      * [Genere par wordpress](#genere-par-wordpress)
      * [Par le code](#par-le-code)
      * [Liens propres a un "post"](#liens-propres-a-un-post)
      * [Par une seconde "boucle"](#par-une-seconde-boucle)
  * [Modifier la requete de WordPress](#modifier-la-requete-de-wordpress)
  * [Page listant une taxonomie](#page-listant-une-taxonomie)
  * [Liste de contenus (liens) triee par taxonomie](#liste-de-contenus-liens-triee-par-taxonomie)
  * [Les images](#les-images)
    * [L'image a la une (vignette/thumbnail)](#limage-a-la-une-vignettethumbnail)
    * [Les tailles d'images](#les-tailles-dimages)
    * [Les images des champs personnalises](#les-images-des-champs-personnalises)

## Les fichiers de base

[`style.css`](https://github.com/ppierre/base-theme-wordpress/blob/master/style.css#L2L5) : Donnez un nom à votre thème
[`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2L9) : Template par défaut, une place pour commencer.

### Les "include"

**Ne pas utiliser `include` de PHP. WordPress à des [fonctions spécialisées pour cela](http://codex.wordpress.org/Include_Tags)**

Regrouper le code commun à vos pages avec :
* [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L2) : sera inclus dans votre template par [`get_header()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L12L13)
* [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L1) : sera inclus dans votre template par [`get_footer()`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L32L33)

Le code HTML généré est celui retourné par votre fichier de template qui lui même inclut d'autres fichiers. Il n'est donc pas étonnant de débuter une balise dans [`header.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L3L4) est de la finir dans [`footer.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L24).

### Les fichiers CSS et JavaScript

Ne pas les placer dans vos templates. Laisser WordPress le faire pour vous.
* Déclarer vos fichiers CSS dans le fichier [`functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L31L35)
  * WordPress les placera dans vos pages par le biais de [la fonction `wp_head()` placée à la fin de HEAD](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L7L10).
* Il existe la même [fonctionnalité pour JavaScript (*WP codex*)](http://codex.wordpress.org/Function_Reference/wp_enqueue_script).
  * [Simplement lui indiqué le chemin comme pour les feuilles de style](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L37L41), bonus vous pouvez dire que votre script à besoin de jQuery : WordPress le chargera pour vous.
  * On peut optimiser le chargement des scripts en les plaçant à la fin de BODY ([wp_footer()](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L19L21)) ou en les chargeant de façon asynchrone.

Rq : La fonction utilisée pour le lien du fichier CSS : [`get_stylesheet_directory_uri`](http://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri), peut être utile pour intégrer des liens vers des éléments statiques dans vos templates. Mais je vous décourage de faire cela. Mettez les en place par les CSS, il suffit alors de faire un lien relatif depuis le code du fichier CSS.

## Les Templates

Ce sont eux qui affichent le contenu par le biais de la ['boucle' WordPress](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L16L30).
* [`index.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/index.php#L2L9) : Template par défaut
* [`single.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single.php#L2L5) : Template pour afficher un seul Article (affichage complet).

`index.php` n'est pas l'endroit où vous devez placer en premier le code de vos pages. Préférez un template plus approprié :
* `archive.php` pour les listes d’Articles
* `home.php` ou [`front-page.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L2) pour une page ou une liste suivant les réglages
*[http://codex.wordpress.org/Template_Hierarchy](http://codex.wordpress.org/Template_Hierarchy)*

### Trouver les fichiers de template a utiliser

* La variable globale `$template` contient le template actuellement utilisé.
* La fonction [`body_class`](http://codex.wordpress.org/Function_Reference/body_class) que l'on utilise dans la balise `BODY`, donne de bonnes indications sur le nom de template que l'on pourrait utiliser.

**[Ajoutez le code suivant à `functions.php` pour afficher ces informations de template](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L150L172)**

## Les types personnalises

WordPress possède deux types (Post et Page). Mais vous pouvez ajouter vos propres types de contenu :
* [Le définir dans `functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L44L66)
* Faire un template [`single-$nomDuType.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L2L3) qui l'affiche (Eg complètement)
* Faire un template [`archive-$nomDuType.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/archive-projet.php#L2L3) qui affiche la liste (Eg liens)

Quand vous faites un type personnalisé, vous devez réfléchir à :
* [Son identifiant dans le code](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L49L50)
* [Le nom affiché à l'utilisateur](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L53L54)
* [Les fonctionnalités de WordPress qui vous sont utiles](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L59L61)
*[http://codex.wordpress.org/Function_Reference/register_post_type](http://codex.wordpress.org/Function_Reference/register_post_type)*

Lire la documentation et penser à l'option `supports` qui sert à dire quelles fonctionnalités de WordPress sont utiles à votre nouveau contenu.

## Les taxonomies personnalisees

WordPress possède deux taxonomies (Tag et Category). Mais vous pouvez ajouter vos propres classements (taxonomies) :
* [La définir dans `functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L68L85)
* Faire un template [`taxonomy-$nomDeLaTaxonomie.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/taxonomy-competences.php#L2L4) qui l'affiche la liste des contenus correspondants
  * Mais aussi, on peut faire un template [`taxonomy-$nomDeLaTaxonomie-$etiquette.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/taxonomy-competences-CSS.php#L2L5) qui affiche la liste pour une certaine "étiquette".

Quand vous faites une taxonomie personnalisée, vous devez réfléchir à :
* [Son identifiant dans le code](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L73L74)
* [Le nom affiché à l'utilisateur](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L79)
* [Quels contenus va-t-elle classer (un ou plusieurs) ?](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L75L76)
*[http://codex.wordpress.org/Function_Reference/register_taxonomy](http://codex.wordpress.org/Function_Reference/register_taxonomy)*

Lire la documentation et penser à l'option [`hierarchical` qui sert à dire si la nouvelle taxonomie doit se comporter comme des Tag ou comme une Category](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L80).

Vous pouvez associer une description à chaque terme (sur la page d'administration de la taxonomie). [Utiliser la fonction `term_description` pour l'afficher.](https://github.com/ppierre/base-theme-wordpress/blob/master/taxonomy-competences.php#L8) 

## Les champs de saisie personnalises

Quand vous ajoutez un type de contenu personnalisé, WordPress vous laisse choisir les champs de formulaire standard présenté à l'éditeur du site (option `supports` de `register_post_type`).

Mais vous pouvez ajouter vos propres champs de formulaire.

Dans l'interface d'administration, demander l'installation du plug-in "Meta Box".

Avec, vous pourrez :
* [Déclarer les champs de formulaire (dans `functions.php`).](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L87L125)
* [Afficher les valeurs saisies dans les templates.](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L15L40)

### Declarer les champs de formulaire

Les champs de formulaires ajoutés par "Meta Box" sont [regroupés par Boîte](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L95L122).

Pour chaque Boîte vous devez penser :
* [Le titre de la boîte](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L97L98)
* [Sur quels types de contenu elle sera affichée](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L99L100)
* Sa [liste de champs de formulaire](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L102L121) et pour [chaque champ](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L103L111) :
  * [Son nom affiché](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L105L106)
  * [Son identifiant (unique)](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L107L108)
  * [Son type](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L109L110)

*[https://github.com/rilwis/meta-box/blob/master/demo/demo.php](https://github.com/rilwis/meta-box/blob/master/demo/demo.php)*

Lire la documentation et penser à regarder les options des [différents types de champs](http://metabox.io/docs/define-fields/#section-list-of-supported-field-type).

<sub>autocomplete button checkbox checkbox_list color date datetime divider file file_advanced
     file_input heading hidden image image_advanced image_select map number oembed password plupload_image
     post radio range select select_advanced slider taxonomy taxonomy_advanced text textarea
     thickbox_image time url user wysiwyg</sub>

### Afficher les valeurs personnalisees

(version longue indépendante du plugin, lire titre suivant pour version courte).

Pour afficher dans le template les champs personnalisés :
* [Récupérez les "custom_fields"](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L15L16) : [C'est un tableau associatif](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L20L21).
* [Utilisez l'identifiant d'un champ personnalisé](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L28L29) pour lire ses valeurs : C'est un tableau.
  * Si la valeur est unique, [prendre l'indice `[0]`](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L34L36).

Ensuite, utiliser ce code [à l'endroit où vous voulez afficher la valeur](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L39L40).

Rq. les `print_r` sont juste pour les explications. [Ne pas les inclure dans vos pages !](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L18L38)

### Fonctions de "meta box" pour lire les valeurs personnalisees

Utilise un "helper" fourni par le plug-in. Mais comprenez que les métadonnées sont gérées par WordPress, tout plug-in ne fait qu'ajouter des facilités de saisie. Rien d'autre.

[`rwmb_meta`](http://metabox.io/docs/get-meta-value/) est une fonction fournie par "meta box" pour [afficher plus simplement les valeurs](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L42L46) :
* Si c'est une valeur unique:
  * Elle retourne simplement cette valeur
* Si c'est un type complexe (l'indiquer en argument à l'appel)
  * Elle retourne un tableau avec des clefs pour les valeurs
* Si vous avez utilisé la propriété `'clone' => true`
  * Elle retourne un tableau, __vous devez obligatoirement passer par elle dans ce cas__.

## Les menus

### Menu defini par l'editeur du site

Ce sont les menus qui peuvent être personnalisés dans l'interface d'administration.
* [Dire que votre thème supporte cette fonctionnalité.](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L15L16)
* [Définir pour chaque menu son identifiant et le nom affiché à l'utilisateur.](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L22L23)
* [Ajouter au template le code pour ajouter le menu correspondant à un identifiant.](https://github.com/ppierre/base-theme-wordpress/blob/master/header.php#L19L24)

### Menu integre au template 

#### Genere par WordPress

Si vous avez défini des taxonomies personnalisées, vous voulez sans doute permettre au visiteur du site d'utiliser ces "classements" pour naviguer sur le site.

Simplement, [demandez à WordPress de faire un menu (liste)](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L5L8) avec les termes de votre taxonomie.

#### Par le code

Il existe des fonctions donnant l'URL :
* [Lien vers la liste des éléments pour un terme d'une taxonomie](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L9L10) [`get_term_link`](http://codex.wordpress.org/Function_Reference/)
* [Lien vers l'archive d'un type personnalisé](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L11L12) [`get_post_type_archive_link`](http://codex.wordpress.org/Function_Reference/)
* [Lien vers une page statique](https://github.com/ppierre/base-theme-wordpress/blob/master/footer.php#L14) [`get_permalink`](http://codex.wordpress.org/Function_Reference/get_permalink) et [`get_page_by_title`](http://codex.wordpress.org/Function_Reference/get_page_by_title)

#### Liens propres a un "post"

[`the_permalink`](http://codex.wordpress.org/Function_Reference/the_permalink) donne le lien vers la page d'un "post" (ou contenu personnalisé). Mais vous pouvez aussi :
* Afficher les "tags" : [`the_tags`](http://codex.wordpress.org/Function_Reference/the_tags)
* Afficher la ou les "category" : [`the_category`](http://codex.wordpress.org/Function_Reference/the_category)
* Mais aussi les taxonomies personnalisées : [`the_terms`](http://codex.wordpress.org/Function_Reference/the_terms)
  * Rq: contrairement aux autres elle demande l'ID du "post" en paramètre (`$post->ID`).

Pour chaque il existe des variantes suivant que vous vouliez gérez vous même l'affichage (boucle en PHP) ou laisser WordPress le faire pour vous.

#### Par une seconde "boucle"

Si vous voulez afficher deux contenus sans rapport sur la même page, vous devez [faire une seconde boucle](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L23L42) :
* [La classe WP_Query retourne un objet qui pilote cette boucle.](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L26L27)
* [La boucle se fait comme d'habitude, simplement en utilisant l'objet.](https://github.com/ppierre/base-theme-wordpress/blob/master/front-page.php#L28L30)

[*Lire la documentation de WP_Query !*](http://codex.wordpress.org/Class_Reference/WP_Query#Parameters) Pour connaître ses paramètres.

## Modifier la requete de WordPress

Vous ne devez pas utiliser WP_Query pour changer le contenu affiché par défaut (sauf pour les pages statiques). Il faut modifier la requête faite par WordPress.

Vous devez :
* [Mettre en place un filtre pour changer la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L127L133)
* [Déterminer si c'est la page dont vous voulez modifier la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L135L136)
* [Modifier les paramètres de la requête](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L137L138)

## Page listant une taxonomie

Si vous voulez faire une page qui liste tous les termes de la taxonomie :
* Dans l'interface d'administration, faire une page statique `"Liste Taxonomie"` (elle sera affichée à l’URL `/liste-taxonomie`)
* Placer [un code affichera votre taxonomie](https://github.com/ppierre/base-theme-wordpress/blob/master/page-liste-taxonomie.php#L22L45), dans le template spécifique à la page ([`page-liste-taxonomie.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/page-competences.php#L2L4))

## Liste de contenus (liens) triee par taxonomie

Quand l'on utilise une taxonomie, il existe une page pour chaque terme (`/competences/HTML`, `/competences/CSS`...).

Si vous voulez faire une page qui liste tous les contenus triés suivant les termes de la taxonomie :
* Dans l'interface d'administration, faire une page statique du même nom que la taxonomie (elle sera affichée à l’URL `/competences`)
* Placer [un code affichera vos contenus triés](https://github.com/ppierre/base-theme-wordpress/blob/master/page-competences.php#L18L61), dans le template spécifique à la page ([`page-competences.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/page-competences.php#L2L3))
  * Rq: le code fourni fait plusieurs requêtes, ce qui n'est pas une bonne pratique. Mais bon... c'est pour rester simple.

## Les images

### L'image a la une (vignette/thumbnail)

Si vous n'avez qu'une image ou qu'une de vos images "symbolise" le contenu : [utilisez cette fonction](http://codex.wordpress.org/Post_Thumbnails).
  * Ajoutez la fonction [`add_theme_support('post-thumbnails');`](http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails) à votre [`functions.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L13L14)
  * Et dans le [paramètre `'support'` de la déclaration de votre type personnalisé](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L60), ajouter `'thumbnail'`.
    * Dans l'interface d'administration, vous devez pouvoir ajouter une "image à la une"
  * Pour l'affichage, simplement utiliser le "tag" : [`the_post_thumbnail('portrait');`](http://codex.wordpress.org/Function_Reference/the_post_thumbnail) dans votre tamplate : [`single-projet.php`](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L14)
    * Le paramètre (facultatif) sert à indiquer la taille de l'image.
    
### Les tailles d'images

Les utilisateurs de votre site n'auront qu'à télécharger les images associées au contenu. WordPress prend en charge leurs redimensionnements.

 * Simplement, indiquez dans le [`functions.php` les tailles utilisées dans votre graphisme](https://github.com/ppierre/base-theme-wordpress/blob/master/functions.php#L143L148) avec la fonction [`add_image_size`](http://codex.wordpress.org/Function_Reference/add_image_size) qui associe des dimensions à un "identifiant".
   * Les fonctions destinées à une balise image (ou l'URL), toutes prennent en paramètre un "identifiant" pour indiquer la taille.
   
### Les images des champs personnalises.

WordPress stocke simplement un identifiant pour les images (attachement) que vous avez associé à votre poste.

  * Simplement, [récupérez la ou les valeurs (tableau) d'ID](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L57L61).
    * On peut aussi [récupérer des renseignements plus complets (en spécifiant le type)](http://metabox.io/docs/get-meta-value/#section-returned-value). Mais ce n'est pas utile sauf si l'on désire renseigner soit même tous les paramètres des balises IMG.
  * Avec la valeur de l'ID,  utilisez une [fonction qui retourne une balise IMG](https://github.com/ppierre/base-theme-wordpress/blob/master/single-projet.php#L63L65) avec une certaine taille : [`wp_get_attachment_image`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image).
    * Voir aussi :
       * [`wp_get_attachment_image_src`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src)
       * [`get_image_tag`](http://codex.wordpress.org/Function_Reference/get_image_tag)
       * [`wp_get_attachment_metadata`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_metadata)
