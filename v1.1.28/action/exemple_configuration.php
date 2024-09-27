<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function action_exemple_configuration_dist() {
    
    /////////// Liste des configurations ///////////
    
    //// 0 = non   /   1 = oui    

    include_spip('inc/config');

    /////////// Diverses options

    // Il faut être au moins administrateur d'un projet pour accepter les demandes
    ecrire_config('osip_config_demandes', 1);

    // Synchronisation des mots clés avec les groupes de mots clés
    ecrire_config('osi_projets/synchronisation_mots', 1);

    // Définir les types pour les mots clés de projet
    ecrire_config('osi_projets/types_de_mots/cause', 0);
    ecrire_config('osi_projets/types_de_mots/condition', 1);
    ecrire_config('osi_projets/types_de_mots/condition_inverse', 1);
    ecrire_config('osi_projets/types_de_mots/recompense', 1);

    // Il faut valider un projet du coté back-office avant de le publier
    ecrire_config('osi_projets/verification_projets', 0);

    // Récursivité des projets
    ecrire_config('osi_projets/recursivite', 0);

    // Tous les droits pour les webmaster !!
    ecrire_config('osi_projets/webmaster_droits', 1);

    // Banni pour toujours
    ecrire_config('osi_projets/auteur_banni', 0);

    // Pouvoir créer un sous projet depuis le front
    ecrire_config('osi_projets/creer_sous_projet_int', 1);

    /////////// Installation et Desinstallation

    // Désinstallation des rubriques
    ecrire_config('osi_projets/desinstallation_rubriques', 0);


    /////////////////////////////////////////////

    // Redirection vers la page de configuration après l'exécution
    redirige_par_entete(generer_url_ecrire('configurer_osi_projets', 'onglet=option', true));
    exit;
}