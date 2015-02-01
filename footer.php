<!-- Code HTML qui est commun a la fin de toutes les pages -->
<aside>
    <h3>Liste de la taxonomie personnalisée "Compétences"</h3>
    <!-- Il est possible de construire des navigations en listant des taxonomies -->
    <?php wp_list_categories( array(
        "taxonomy" => "competences",
        "title_li" => ""
    )); ?>
    <h3>Lien vers la liste des éléments classée par le terme "CSS" dans la taxonomie "competences"</h3>
    <a href="<?php echo get_term_link("CSS","competences") ?>">liste compétences CSS</a>
    <h3>Lien vers la liste des Projets (custom post type)</h3>
    <a href="<?php echo get_post_type_archive_link("projet") ?>">liste projets</a>
    <h3>Lien vers un page statique avec un template comportant une requête personnalisée : les contenus classés par termes</h3>
    <?php echo get_permalink(get_page_by_title('competences')); ?>
</aside>

<footer>Le "footer" du site</footer>

<!-- Juste avant la balise de fermeture de BODY : 'wp_footer();'
     Ici, WordPress ajoutera les codes JavaScript en bas de page -->
<?php wp_footer(); ?>

</body><!-- Balise BODY qui a ete ouverte dans header.php et fermee ici dans footer.php -->
</html><!-- Balise HTML qui a ete ouverte dans header.php et fermee ici dans footer.php -->