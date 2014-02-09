<!-- Code HTML qui est commun a la fin de toutes les pages -->
<aside>
    <h3>Liste de la taxonomie personnalisée "Compétences"</h3>
    <!-- Il est possible de construire des navigations en listant des taxonomies -->
    <?php wp_list_categories( array(
        "taxonomy" => "competences",
        "title_li" => ""
    )); ?>
</aside>

<footer>Le "footer" du site</footer>

<!-- Juste avant la balise de fermeture de BODY : 'wp_footer();'
     Ici, WordPress ajoutera les codes JavaScript en bas de page -->
<?php wp_footer(); ?>

</body><!-- Balise BODY qui a ete ouverte dans header.php et fermee ici dans footer.php -->
</html><!-- Balise HTML qui a ete ouverte dans header.php et fermee ici dans footer.php -->