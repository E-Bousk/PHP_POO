<h1>Liste des annonces</h1>

<?php foreach($annonces as $annonce): ?>
    <article>
        <!-- pour utiliser les tableaux associatifs (ex: $annonce['titre']), 
        on indique « PDO::FETCH_ASSOC » comme valeur dans le ficher 'Core\Db.php'
        Pour utiliser des objets (ex: $annonce->titre), on y indique « PDO::FETCH_OBJ » -->
        <h2><a href="/annonces/lire/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
        <div><?= $annonce->description ?></div>
    </article>
<?php endforeach ?>


