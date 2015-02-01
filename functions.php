<?php
// Supprime la barre d’outils (code HTML généré par WordPress plus concis)
add_action('after_setup_theme', 'plus_admin_bar');
function plus_admin_bar () {
    show_admin_bar(false);
}

// définit que notre thème supporte (préfère) les balises html5
add_theme_support('html5');

/* Voir : http://codex.wordpress.org/add_theme_support
   Pour d’autres fonctionnalités optionnelles des thèmes */
// A ajouter en plus du 'supports' => array( ..,'thumbnail',..) pour pouvoir saisir l'image "à la une" dans l'interface d'un type personnalisé.
add_theme_support('post-thumbnails');
// notre thème permet à l’utilisateur de saisir des menus dans l’interface d’administration
add_theme_support('menus');

/*
 * Définit le nom des menus que l’utilisateur pourra ajouter
 */
register_nav_menus(array(
    // une ligne pour chaque menu : identifiant et nom affiché
    'principale' => 'Navigation principale',
));

/*
 * Ajoute les fichiers CSS, ils seront écrits par 'wp_head' juste avant la balise de fin de HEAD.
 */
add_action( 'wp_enqueue_scripts', 'ajout_scripts' );
function ajout_scripts() {
    /* répétez la ligne qui suit pour chaque fichier CSS en modifiant :
       'typo-couleur'           un identifiant (unique pour chaque style)
       '/css/typo-couleur.css'  le chemin relatif à la racine du thème
    */
    wp_enqueue_style( 'typo-couleur', get_stylesheet_directory_uri() . '/css/typo-couleur.css' );

    /* Pour le JavaScript : http://codex.wordpress.org/Function_Reference/wp_enqueue_script
       Il est possible de spécifier que ses scripts dépendent de jQuery,
       WordPress ajoutera automatiquement les dépendances.
    */
    wp_enqueue_script('perso', get_stylesheet_directory_uri() . '/js/perso.js', array('jquery'));
}

/*
 * Ajout type personnalisé
 */
add_action( 'init', 'ajout_post_types' );
function ajout_post_types() {
    // répétez pour chaque type : lui donner un nom ici 'projet'
    register_post_type( 'projet',
        // options, voir documentation
        array(
            // Le nom au pluriel
            'label' => 'Projets',
            // visible Eg. 'true'
            'public' => true,
            // Si l’on veut des pages listant ce type Eg. 'true'
            'has_archive' => true,
            // Les Champs de formulaire qui seront saisis et affichés. Eg. Titre et Contenu. 'thumbnail' pour une image à la une (voir add_theme_support('post-thumbnails');)
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            // Pour l’ajout de Champs personnalisé voir le plug-in Meta Box.
        )
    );
    // Mettre en commentaire la ligne qui suit après avoir testé le bon fonctionnement.
    flush_rewrite_rules( false );
}

/*
 * Ajout de taxonomie personnalisé
 */
add_action( 'init', 'ajout_taxonomy' );
function ajout_taxonomy() {
    // répétez pour chaque taxonomie : lui donner un nom ici 'competences'
    register_taxonomy('competences',
        // le type ou les types classés par cette taxonomie (séparé par des virgules)
        array('projet'),
        // options, voir documentation
        array(
            // Au minimum fixer son nom affiché ('label')
            'label' => __( 'Compétences' )
        )
    );
    // Mettre en commentaire la ligne qui suit après avoir testé le bon fonctionnement.
    flush_rewrite_rules( false );
}

/*
 * Ajout de champs personnalisés (avec le plug-in Meta Box à installer)
 * http://www.deluxeblogtips.com/meta-box/getting-started/
 * https://github.com/rilwis/meta-box/blob/master/demo/demo.php
 */
add_filter( 'rwmb_meta_boxes', 'ajout_meta_boxes' );
function ajout_meta_boxes( $meta_boxes )
{
    // Répetez pour chaque "boîte" (groupes de champs)
    $meta_boxes[] = array(
        // le titre de la boîte
        'title'    => 'URL Projet',
        // le type ou les types ou sera affiché cette "boîte" (séparé par des virgules)
        'pages'    => array( 'projet' ),
        // La liste des champs de formulaire affiché par la "boîte"
        'fields' => array(
            // Répeter pour chaque champ : ses options
            array(
                // Son nom affiché
                'name' => 'URL',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id'   => 'pp_url',
                // son type
                'type' => 'url',
            ),
            // Répeter pour chaque champ : ses options
            array(
                // Son nom affiché
                'name' => 'Image',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id'   => 'pp_images',
                // son type
                'type' => 'image',
            ),
        )
    );

    return $meta_boxes;
}

/*
 * Change les requêtes de WordPress
 * http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
*/
add_filter('pre_get_posts', 'modifie_requete_wp');
function modifie_requete_wp( $query ) {
    // Est appelé pour chaque page. Testez si c'est la requête que vous voulez changer.

    // Test si page d'accueil (front-page.php)
    if ( $query->is_home() ) {
        // Limite à un résultat
        $query->query_vars['posts_per_page'] = 1;
    }

}

/**
 * Definit une taille personalisé d'image
 * http://codex.wordpress.org/Function_Reference/add_image_size
 */
add_image_size( 'portrait', 60, 100, true );
add_image_size( 'paysage', 120, 50, false );