# PDF4Teachers-Website - [https://pdf4teachers.org](https://pdf4teachers.org)

Site internet de l'application [PDF4Teachers](https://github.com/ClementGre/PDF4Teachers)

Ce site présente les fonctionnalités principales de PDF4Teachers et propose de télécharger l'application depuis les CDN de GitHub. Il contient aussi une page À Propos qui détail un peut plus les donctionnalités et qui donne des informations complémentaires sur le projet.

# Les Dépendances

Le site a été développé sous php 7.4.
- [Bootstrap](https://getbootstrap.com/) CSS & JS utilisés pour l'initialisation css et pour les boutons de téléchargements.
- [JQuery](https://jquery.com/) pour faire de nombreuses manipulations JS dont du Ajax.
- [Google Font](https://fonts.google.com/) pour les polices : Lato et Varela Round.
- [Font Awesome](https://fontawesome.com/icons?d=gallery) pour certains icônes du footer par exemple.

# L'organisation du code

Chaque page est contenue dans un dossier qui porte son nom sauf la page principale, qui se situe à la racine. Cela permet uniquement d'avoir un affichage plus propre dans les navigateurs. *Il est aussi possible d'utiliser des options pour cacher les extensions des fichiers sous apache2*.

Les images sont enregistrés dans ``/data/img/``.

Chaque page demande le fichier ``/php/translator.php`` qui va charger les traductions enregistrées dans ``<nom de la page ou rien>/translations/``. Le langage choisit est définis dans les cookies en JS. Si aucun langage n'est choisit, ``translator.php`` utilisera le langage du navigateur. Les fichiers php apellent la fonction ``t()`` avec une clé du format ``message.welcome``.
Les fichiers de traductions sont rédigés au format ``properties`` donc du format ``message.welcome=Bienvenue sur ce site web !``. Vous pouvez contribuer aux traductions en ajoutant des fichiers de traduction vous même. Pour que le langage soit visible, il faut ajouter une image dans ``/data/img/languages/`` et il faut ajouter le langage dans la liste des langages disponibles, dans ``/php/translator.php`` ligne 22.

Le Header et le Footer sont dans des fichiers séparés et ont un fichier css séparés. Ils sont incluts en PHP dans chacunes des pages. De même pour le bouton de téléchargement et pour le bouton de changement de langage.

Le nom de la dernière version du logiciel est déterminé avec une requête Ajax à GitHub en JavaScript. Cette dernière version est sauvegardé dans un cookie qui a une durée de vie de 10 minutes. Les liens de téléchargements sont inscrits en php et ``/js/main.js`` s'occupe d'éditer les liens pour qu'ils pointent vers la bonne version (en fonction de la version récupéré dans les cookies ou avec une requête GitHub).
C'est à peu près le même fonctionnement pour la page ``/Download/`` : la liste des versions disponibles est récupérée sur GitHub et est enregistrée dans les cookies, elle a une durée de vie d'une journée (la liste est actualisé si la dernière version disponible n'est pas présente dans celle ci). Lors de l'ouverture de l'onglet d'une version, ``main.js`` fait une requête à l'API de GitHub et récupère les informations de la version. Il génère lui même le code html et l'ajoute au bon endroit dans la page.