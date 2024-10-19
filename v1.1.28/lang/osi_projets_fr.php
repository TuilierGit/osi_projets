<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans https://git.spip.net/spip-contrib-extensions/pages.git
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'auteur' => 'Auteur',
	'aucun_projet' => 'Aucun projet',
	'aucun_sous_projet' => 'Aucun sous projet',
	'aucune_demande' => 'Aucune demande en cours',
	'aucun_role_disponible' => 'Aucun rôle disponible',
	'aucun_role_auteur' => 'Vous ne possédez aucun rôle.',
	'aucun_documents' => 'Aucun document disponible',
	'aucun_message' => 'Aucun message',
	'aucun_auteur' => 'Aucun auteur',
	'aucun_mot' => 'Aucun mot',
	'aucun_mot_projet' => 'Ce projet ne possède aucun mot clé',
	'ajouter_auteur_projet:libelle_bouton' => 'Ajouter au projet',
    'ajouter_auteur_projet:message_confirmation' => 'Êtes-vous sûr de vouloir vous ajouter à ce projet ?',
	'affichage_etat_-2' => 'Bannir',
    'affichage_etat_-1' => 'Exclure',
	'affichage_etat_0' => 'Exclure',
	'affichage_etat_1' => 'Rendre membre',
    'affichage_etat_2' => 'Rendre administrateur',
    'affichage_etat_3' => 'Rendre createur',
	'affichage_demande_1' => 'Accepter la demande',
	'affichage_demande_-1' => 'Refuser la demande',
	'associer_projet' => 'Associer à un projet',
	'auteur_banni' => 'Auteur banni',
	'auteur_non_connecte_message' => 'Il faut être connecté pour pouvoir voir et rejoindre le projet.',
	'ajouter_demande' => 'Ajouter cette demande',
	'ajouter_un_projet' => 'Ajouter un projet',
	'aller_gestion_mots_cles' => 'Aller à la page de gestion des mots-clés',

	// B
	'bouton_etat_valide' => 'Accepter la demande',
	'bouton_acteur_valide' => 'Passer acteur',
	'bouton_sponsor_valide' => 'Passer sponsor',
	'bouton_administrateur' => 'Rendre administrateur',
	'ban_message' => 'Vous avez été banni de ce projet. Vous ne pouvez plus faire de demande pour rejoindre celui-ci.',

	// C
	'creer_projet' => 'Créer un nouveau projet',
	'conditions_projet_erreur' => 'Il faut valider toutes les conditions pour rejoindre le projet',
	'choix_role_actif' => 'Rendre le rôle actif',
	'choix_role_inactif' => 'Rendre le rôle inactif',
	'conditions_valides' => 'Les conditions pour rejoindre le projet sont valides.',
	'choisir_valeur' => 'Choisissez une valeur :',
	'conditions_insuffisantes' => 'Conditions insuffisantes pour avoir le rôle :',
	'exemple_configuration' => "Utiliser la configuration d'exemple",
	'exemple_roles' => "Utiliser les rôles d'exemples",
	'creer_sous_projet' => "Créer un sous projet",
	
	// D
	'demande_en_cours' => 'La demande est en cours de vérification',
	'demande_refuse' => 'La demande a été refusé',
	'depublier_projet' => 'Dépublier le projet',
	'demander_role' => 'Demander le rôle',
	'date_creation'  => 'Date de création',
	'droits_insuffisants'  => "Vous n'avez pas des droits suffisant pour vous occuper de la gestion du projet",
	'description'  => 'Description :',
	'date'  => 'Date',
	'date_arrivee'  => "Date d'arrivée",
	'email'  => 'Email',

	// E
	'erreur_champ_projet_doublon' => 'Cet identifiant existe déjà',
	'erreur_champ_projet_format' => 'Charactères alphanumériques en minuscules ou "_" uniquement',
	'erreur_champ_projet_taille' => '255 charactères maximum',
	'erreur_droits_recompenses' => "Vous n'avez pas les droits pour donner les récompenses sur ce projet",
	'erreur_projet' => "Erreur: projet non trouvé ou accès non autorisé",

	'exemple_role_1' => "Formateur",
	'exemple_role_1_descriptif' => "Membre du personnel pour former les participants au projet.",
	'exemple_role_1_question' => "Veux-tu partager tes connaissances afin de former les différents membres du projet ?",
	'exemple_role_2' => "Sponsor",
	'exemple_role_2_descriptif' => "Personne qui finance un projet.",
	'exemple_role_2_question' => "Veux-tu financer ce projet ?",
	'exemple_role_3' => "Evaluateur par les pairs",
	'exemple_role_3_descriptif' => "Personne qui a la capacité d'évaluer le projet.",
	'exemple_role_4' => "Evaluateur indépendant",

	'exemple_titre_presentation' => "Présentation",
	'exemple_titre_roles' => "Mes rôles",
	'exemple_titre_membres' => "Membres",
	'exemple_titre_mots_cles' => "Mots clés",
	'exemple_titre_forum' => "Forum",
	'exemple_titre_gestion' => "Gestion",


	// F
	'forum_projet' => "Forum du projet",
	'forum_ajouter_sujet' => "Ajouter un sujet de discussion",
	'forum_voir_sujet' => "Voir le sujet",
	'forum_aucun_sujet' => "Aucun sujet de discussion",
	'forum_messages_du_sujet' => "messages sur ce sujet.",
	'forum_poster_message' => "Poster un message",
	'faire_choix' => "Faites votre choix",
	'faire_demande' => "Faire une demande",

	// G
	'gestion_titre_explication' => "Explication",
	'gestion_titre_demandes' => "Demandes",
	'gestion_titre_participants' => "Participants",
	'gestion_titre_description' => "Description",
	'gestion_titre_mots_cles' => "Mots clés",
	'gestion_documents' => "Gestion des documents",
	
	

	// I
	'id' => 'ID',
	'info_statut' => 'Ce projet est :',
	// 'info_etat'    => 'Etat :',
	'info_niveau_aucun'    => 'Sans état',
	'info_niveau_valide'   => 'Valide',
	'info_niveau_actif'   => 'Actif',
	'info_taille' => 'Ce projet est un :',
	'info_taille_petit'   => 'Petit projet',
	'info_taille_moyen'   => 'Projet moyen',
	'info_taille_grand'   => 'Grand projet',
	'id_projet_explication'   => 'Si id_projet > 0 alors la rubrique représente un projet.',
	'info_aucun_projet'   => "Il n'y a actuellement aucun projet.",
	'info_un_projet'   => "Il y a actuellement qu'un projet.",
	'info_actuellement'   => "Il y a actuellement",
	
	// M 
	'modification' => 'Modification',
	'modifier_projet' => 'Modifier le projet',
	'modifier_valeur' => 'Modifier la valeur',
	'modifier_role' => 'Modifier ce rôle',
	'mettre_la_valeur' => 'Mettre la valeur :',
	'message_quitter_projet' => "Êtes-vous sûr de vouloir quitter ce projet ? Cette action est irréversible.",
	'message_exemple_configuration' => "Êtes-vous sûr de vouloir utiliser la configuration d'exemple ? En utilisant la configuration d'exemple, vous perdrez toutes configurations en cours. Cette action est irréversible.",
	'message_exemple_roles' => "Cette action va créer les rôles d'exemples. Si pour un des exemples, un rôle avec le même nom existe déjà, alors il ne sera pas créé. Pour utiliser ensuite les rôles, il faut penser à les activer.",
	'message_suppression_projet' => "Êtes-vous sûr de vouloir supprimer ce projet ? Cette action est irréversible.",
	'message_suppression_role' => "Êtes-vous sûr de vouloir supprimer ce rôle ? Cette action est irréversible.",
	'message_echec_suppression_projet' => "Erreur lors de la suppression du projet.",
	'message_succes_suppression_projet' => "Projet supprimé avec succès.",
	'message_id_erreur_suppression_projet' => "ID de projet invalide.",
	'message_id_erreur_supprimer_auteur_projet' => "Erreur : Lien entre l'auteur et le projet non trouvé.",
	'message_etat_3_erreur_supprimer_auteur_projet' => "Erreur : Vous ne pouvez pas quitter le projet si vous êtes le créateur.",
	'message_succes_copie_mots_cles' => "Les mots-clés ont été copiés avec succès",
    'message_erreur_aucune_rubrique' => "Erreur : Aucune rubrique associée à ce projet",
    'message_aucun_mot_cle' => "Aucun mot-clé trouvé",
    'message_confirmation_copie_mots_cles' => "Êtes-vous sûr de vouloir copier les mots-clés ?",
    'message_synchroniser_mots' => "Voulez-vous synchroniser les mots-clés entre la rubrique et le projet ?",
	'message_succes_projet_associe' => "Un projet a bien été associé.",
    'message_erreur_projet_associe' => "Erreur lors de l'association d'un projet.",
	'message_succes_action' => "Action réussite.",
    'message_erreur_action' => "Erreur lors de l'action.",
	'message_succes_associer_mots' => "Récompenses données.",
    'message_page_forum' => "Message envoyé. Veuillez recharger la page.",
	'menu_gestion_explication' => "Ceci est le menu de gestion du projet. Ce menu permet de modifier le projet ainsi que tout ce qui est relié à celui ci. Ce menu n'est accessible que pour les administrateurs du projet.",
	


	// N
	'nombre_de_projets'  => '@nb@ projets',
	'nombre_auteurs' => "Nombre d'auteurs ",
	'nombre_participants' => "Nombre de participants",
	'nombre_demandes' => "Nombre de demandes ",
	'nom' => "Nom",
	'nom_etat_1' => 'Membre',
	'nom_etat_2' => 'Administrateur',
	'nom_etat_3' => 'Créateur',
	'nom_etat_role_0' => 'Inactif',
	'nom_etat_role_1' => 'Actif',
	'nom_rubrique_projet' => 'Identifiant rubrique',
	'debut_oui_nom' => 'Changer à ',
	'nom_non' => 'non',
	'nom_oui' => 'oui',
	'nom_erreur' => 'erreur',
	'nom_neutre' => 'Neutre',	
	'nom_cause' => 'Cause',	
	'nom_condition' => 'Condition',
	'nom_condition_inverse' => 'Condition inverse',
	'nom_recompense' => 'Recompense',		

	// P
    'projet' => 'Projet',
    'projets' => 'Projets',
	'publier_projet' => 'Publier le projet',
	'projet_un'  => '1 projet',
	'projet_plus'  => '@nb@ projets',
	'projet_edit_bouton_menu_rubrique'  => 'Modifier la rubrique',
	'projet_descriptif' => 'La description du projet :',
	'projet_texte'  => 'Le texte du projet :',
	'projet_creer'  => 'Créer ce projet',
	'projet_date_debut'  => 'La date du début du projet :',
	'projet_date_fin'  => 'La date de fin du projet :',

	// Q
	'question' => 'Question :',		
	'quitter_projet' => 'Quitter le projet',

	// L
	'liste_projets' => 'Liste des projets',
	'liste_participants' => 'Liste des participants',
	'liste_mes_demandes' => 'Liste de mes demandes',
	'liste_documents' => 'Liste des documents',

	// R
	'role' => 'Rôle',
	'roles' => 'Rôles',
	'rubrique' => 'Rubrique',
	'refus_besoin_droits_administrateurs' => 'Il faut au moins les droits administrateurs',
	'recursivite_projet' => 'Appliquer la récursivité sur tous les projets déjà existant.',
	'role_titre_debut' => 'Le titre du role :',
	'role_descriptif_debut' => 'La description du role :',
	'role_question_debut' => 'La question pour rejoidre le role :',
	'role_creer' => 'Créer ce rôle',
	'rejoindre_le_projet' => 'Rejoindre le projet',
	'retourner_a_la_page_projet' => 'Retourner à la page projet',


	// S
	'statut' => 'Statut :',
	'supprimer_projet' => 'Supprimer le projet',
	'supprimer_role' => 'Supprimer le rôle',
	'synchroniser_mots' => "Synchroniser les mots-clés",
	'synchroniser_mots_rubrique' => "Mots-clés de la rubrique",
	'synchroniser_mots_projet' => "Mots-clés du projet",
	'selectionner_auteur' => "Sélectionner l'auteur",


	// T
	'projet_titre' => 'Titre du projet',
	'titre_osi_projets' => 'OSI - Projets',
	'titre_osi_causes' => 'OSI - Causes',
	'titre_projets' => 'Projets',
	'titre_projet' => 'Projet',
	'titre_configuration_osi_projets' => 'OSI - Projets - configuration',
	'titre_tous_les_projets' => 'Tous les projets',
	'titre_tous_mes_projets' => 'Mes projets',
	'titre_infos_projets' => 'Table',
	'titre_toutes_les_demandes' => 'Toutes les demandes',
	'titre_une_rubrique' => 'Rubrique associée au projet',
	'titre_tous_les_auteurs' => 'Toutes les auteurs',
	'titre_etat' => 'Grade',
	'titre_projets_actifs' => 'Projets actifs',
	'titre_projets_inactifs' => 'Projets inactifs',
	'titre_rubriques_createur' => 'Mes projets en tant que créateur',
	'titre_rubriques_administrateur' => "Mes projets en tant qu'administrateur",
	'titre_rubriques_membre' => 'Mes projets en tant que membre',
	'titre_liste_mot_projet' => 'Gestion des mots clés',	
	'titre_liste_demande' => 'Gestion des demandes',
	'titre_liste_demande_rejoindre' => 'Liste des demandes pour rejoindre le projet',
	'titre_liste_demande_role' => 'Liste des demandes pour obtenir un role',
	'titre_tous_les_mots' => 'Tous les mots clés',
	'titre_numero_projet' => 'PROJET NUMÉRO :',
	'titre_edition_enfant' => 'Créer un sous projet',
	'titre_statut' => 'Statut :',
	'titre_niveau' => 'Niveau :',
	'titre_taille' => 'Taille :',
	'titre_sous_projets' => 'Liste des sous projets',
	'titre_associer_rubrique' => 'Projet associé à la rubrique :',
	'titre_gestion_membres' => "Gestion des membres du projet",
	'titre_recompenses' => 'Gestion des récompenses',
	'titre_donner_recompenses' => 'Donner les récompenses',
	'texte_ma_valeur' => "Valeur actuelle :",
	'texte_valeur_origine' => "Valeur d'origine :",
	'texte_nouvelle_valeur' => "Nouvelle valeur :",
	
	// U
	'unique_projet' => 'Un projet',	

	// V
	'validation' => 'Validation',	
	'valider_modifications' => 'Valider les modifications',	
	'voir_rubrique' => 'Accéder a la rubrique associé à ce projet',	
	'voir_projet' => 'Accéder au Projet associé à cette rubrique',
	'voir_membres' => 'Voir les membres',

		

);


?>
