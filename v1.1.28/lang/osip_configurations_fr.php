<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans https://git.spip.net/spip-contrib-extensions/pages.git
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

    // A
    'ajouter_un_role' => 'Ajouter un rôle',

    // C
    'configuration' => 'Configuration',
    'configuration_description_droits_demandes' => "Il faut être au moins administrateur d'un projet pour accepter les demandes",
	'configuration_titre_synchronisation_mots' => "Synchronisation des mots clés avec les groupes de mots clés",
    'configuration_titre_types_de_mots' => "Définir les types pour les mots clés de projet",
    'configuration_description_synchronisation_mots' => "La synchronisation des mots clés entre rubrique et projet prennent en compte les restrictions des groupes de mots clés",
    'configuration_description_types_de_mots' => "Il est possible d'activer les types de mots-clés de projets, qui peuvent être des causes, des critères d'entrée ou des récompenses.",
	'configuration_titre_recursivite' => "Récursivité des projets",
	'configuration_description_recursivite' => "Cette option permet de mettre en relation les projets et les projets enfants. Attention, cela ne s'applique que sur les nouveaux projets.",
	'configuration_titre_webmaster_droits' => "Tous les droits pour les webmaster !!",
	'configuration_description_webmaster_droits' => "Permettre au webmaster d'outrepasser les droits réglés pour les projets",
	'configuration_titre_auteur_banni' => "Banni pour toujours",
    'configuration_description_auteur_banni' => "Ne plus voir les auteurs bannis dans la liste des auteurs que l'on peut ajouter à un projet",
	'configuration_titre_chemin_des_rubriques' => "Rubrique mère des projets :",
	'configuration_description_chemin_des_rubriques' => "Configurer le chemin utilisé pour la création des projets via le front.",
	'configuration_titre_desinstallation_rubriques' => "Désinstallation des rubriques",
	'configuration_description_desinstallation_rubriques' => "Désinstallation des rubriques associées à des projets lors de la suppression du plugin",
    'configuration_titre_creer_sous_projet_int' => "Créer des sous projet sur le front",
	'configuration_description_creer_sous_projet_int' => "Permettre aux administrateurs d'un projet de créer un sous projet via le front.",
    

    // D
    'description_choix_rubrique_projet' => "Vous pouvez modifier la rubrique associée au projet. Il n'est pas possible de choisir une rubrique qui possède déjà un projet.",

    // M
    'modifier_roles' => 'Modifier les rôles',

    // P 
    'projet_edit_titre_menu_personnalisation'  => 'Modifier la personnalisation du projet',
	'projet_edit_descriptif_menu_personnalisation'  => 'Vous pouvez ici modifier la présentation du projet (titre, description, ...).',
    'projet_edit_bouton_menu_personnalisation'  => 'Modifier la personnalisation',
    'projet_edit_descriptif_menu_personnalisation_projet'  => "Modifier le titre, la description et le texte du projet.",
    'projet_edit_titre_menu_rubrique'  => 'Modifier la rubrique associé à ce projet',
	'projet_edit_descriptif_menu_rubrique'  => "La rubrique associée au projet peut aussi servir de présentation du projet du coté front. Ainsi, en modifiant présentation de la rubrique associée, vous pouvez modifier une partie de la présentation du projet. C'est ce qui est par exemple utilisé pour dire qu'un projet n'est plus d'actualité.",
	'projet_edit_descriptif_menu_projet'  => 'Le projet possèdes certaines propriétés qui peuvent être modifiées dans ce menu.',
	'projet_edit_titre_menu_projet'  => 'Modifier les propriétés du projet',




    // R 
    'rubriques_selection' => 'Selectionner toutes les rubriques où il est possible de créer les projets depuis le front.',


    // T
    'titre_toutes_les_configurations' => 'Configuration du plugin "OSI Projets"',
    'titre_configuration_option' => 'Diverses options',
    'titre_configuration_personnalisation' => 'Gestion des rôles',
	'titre_configuration_notification' => 'Gestion des notifications',
	'titre_diverses_options' => 'Diverses options',
    'texte_configuration_verification_projets' => "Il faut valider un projet du coté back-office avant de le publier",
	'titre_installation_desinstallation' => 'Installation et Desinstallation',
	'titre_modification_projet' => "Modification du projet n°",


);


?>
