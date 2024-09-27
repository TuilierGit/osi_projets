<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function action_exemple_roles_dist() {
    
    include_spip('base/abstract_sql');
    include_spip('action/tables/ajouter_dans_tables');


    // Formateur
    $id_role_formateur = sql_getfetsel('id_role', 'spip_osip_roles', "titre='" . _T('osi_projets:exemple_role_1') . "'");
    if(!$id_role_formateur){
        $titre = _T('osi_projets:exemple_role_1'); 
        $descriptif = _T('osi_projets:exemple_role_1_descriptif');
        $question = _T('osi_projets:exemple_role_1_question');
        ajouter_role($titre, $descriptif, $question);
    }

    // Sponsor
    $id_role_sponsor = sql_getfetsel('id_role', 'spip_osip_roles', "titre='" . _T('osi_projets:exemple_role_2') . "'");
    if(!$id_role_sponsor){
        $titre =  _T('osi_projets:exemple_role_2'); 
        $descriptif = _T('osi_projets:exemple_role_2_descriptif');
        $question = _T('osi_projets:exemple_role_2_descriptif');
        ajouter_role($titre, $descriptif, $question);
    }

    // Evaluateur par les pairs
    $id_role_evaluateur_pairs = sql_getfetsel('id_role', 'spip_osip_roles', "titre='" . _T('osi_projets:exemple_role_3') . "'");
    if(!$id_role_evaluateur_pairs){
        $titre =  _T('osi_projets:exemple_role_3'); 
        $descriptif = _T('osi_projets:exemple_role_3_descriptif');
        $question = "";
        ajouter_role($titre, $descriptif, $question);
    }

    // Evaluateur indépendant
    $id_role_evaluateur_independant = sql_getfetsel('id_role', 'spip_osip_roles', "titre='" . _T('osi_projets:exemple_role_4') . "'");
    if(!$id_role_evaluateur_independant){
        $titre =  _T('osi_projets:exemple_role_4'); 
        $descriptif = _T('osi_projets:exemple_role_3_descriptif');
        $question = "";
        ajouter_role($titre, $descriptif, $question);
    }

    // Redirection vers la page de configuration après l'exécution
    redirige_par_entete(generer_url_ecrire('configurer_osi_projets', 'onglet=personnalisation', true));
    exit;
}