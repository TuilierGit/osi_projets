<?php

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Permet de créer un projet.
 *
 * @param int $id_rubrique
 * @param int $id_auteur
 * @param string $statut
 * @return int
 */
function ajouter_projet($id_rubrique, $id_auteur , $statut = "prepa") {
    
    // Ajout du projet

    $id_projet = sql_insertq('spip_projets', array(
        'id_rubrique' => $id_rubrique,
        'statut' => $statut, 
        'niveau' => '0', 
        'taille' => '0', 
        'date' => date('Y-m-d H:i:s'),
        'maj' => date('Y-m-d H:i:s')
    ));

    sql_updateq('spip_projets', ['titre' => _T('osi_projets:titre_projet') .' '. $id_projet], 'id_projet=' . intval($id_projet));


    // Mettre à jour la rubrique avec le nouvel id_projet

    sql_updateq('spip_rubriques', array('id_projet' => $id_projet), 'id_rubrique=' . $id_rubrique);

    // Ajout du mot associé au projet

    $id_groupe = sql_getfetsel('id_groupe', 'spip_groupes_mots', 'titre="osi_projets"');


    if ($id_groupe == 0){ // Cas seulement la première fois
        $id_groupe = sql_insertq('spip_groupes_mots', array(
            'titre' => 'osi_projets',
            'descriptif' => 'Groupe ajouté par le plugin osi_projets représentant la validation des projets. Attention, ne pas modifier manuellement !!',
            'unseul' => 'non',
            'obligatoire' => 'non',
            'tables_liees' => 'auteurs,projets',
            'minirezo' => 'oui',
            'comite' => 'non'
        ));
        if ($id_groupe == 0){ 
            return 0;
        }
    }


    $id_mot = sql_insertq('spip_mots', array(
        'titre' => "projet_" . $id_projet,
        'descriptif' => "Mot associé au projet d'identifiant " . $id_projet, 
        'id_groupe' => $id_groupe, 
        'type' => 'osi_projets', 
        'maj' => date('Y-m-d H:i:s')
    ));


    sql_insertq('spip_mots_liens', array(
        'id_mot' => $id_mot,
        'id_objet' => $id_projet,
        'objet' => 'projet', 
        'lien_projet' => '3', 
        'niveau_projet' => '0', 
    ));


    // Ajout du créateur du projet

    $id_createur = sql_insertq('spip_auteur_projet', array(
        'id_auteur' => $id_auteur,
        'id_projet' => $id_projet,
        'etat' => '3',
        'date' => 'NOW()',
        'maj' => 'NOW()'
    ));



    // On ajoute la condition d'entrée si on a la récursivité des projets activés 

	if (lire_config('osi_projets/recursivite') == '1'){
        $id_rubrique_parent = sql_getfetsel('id_parent', 'spip_rubriques', 'id_rubrique=' . $id_rubrique);
        $id_projet_rubrique_parent = sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . $id_rubrique_parent);
        if ($id_projet_rubrique_parent > 0){ // Cas ou la rubrique parente est un projet
            
            $id_mot_parent = sql_getfetsel('id_mot', 'spip_mots', 'titre="projet_' . $id_projet_rubrique_parent .'"');
            
            sql_insertq('spip_mots_liens', array(
                'id_mot' => $id_mot_parent,
                'id_objet' => $id_projet,
                'objet' => 'projet', 
                'lien_projet' => '2', 
                'niveau_projet' => '0', 
            ));
        }
    }
    

    return $id_projet;
}




/**
 * Permet de créer une rubrique (utilisé principalement pour créer une rubrique dans le cas de l'association avec un projet).
 *
 * @param string $titre
 * @param string $texte
 * @param string $statut
 * @param int $arg_id_rubrique
 * @return int
 */
function ajouter_rubrique($titre, $texte , $statut = "prepa", $arg_id_rubrique = "-1") {
    
    if ($arg_id_rubrique = "-1"){
        $id_parent = get_project_path();
        $id_secteur = get_id_secteur();
        $id_profondeur = get_profondeur();
    } else {
        $id_parent = get_project_path($arg_id_rubrique);
        $id_secteur = get_id_secteur($arg_id_rubrique);
        $id_profondeur = get_profondeur($arg_id_rubrique);
    } 
    

    // Création de la rubrique
    $id_rubrique = sql_insertq('spip_rubriques', array(
        'id_parent' => $id_parent,
        'titre' => $titre,
        'texte' => $texte,
        'id_secteur' => $id_secteur,
        'maj' => 'NOW()',
        'statut' => $statut,
        'date' => 'NOW()',
        'lang' => 'fr',
        'langue_choisie' => 'non',
        'statut_tmp' => $statut,
        'date_tmp' => 'NOW()',
        'profondeur' => $id_profondeur,
        'id_projet' => '0'
    ));
    
    return $id_rubrique;
}




/**
 * Permet de créer un rôle.
 *
 * @param string $titre
 * @param string $descriptif
 * @param string $question
 * @return int
 */
function ajouter_role($titre, $descriptif , $question) {
    
    $id_role = sql_insertq('spip_osip_roles', array(
        'etat' => '0',
        'titre' => $titre,
        'descriptif' => $descriptif,
        'question' => $question
    ));

    return $id_role;
}




/**
 * Permet d'ajouter une demande pour rejoindre un projet
 *
 * @param int $id_auteur
 * @param int $id_projet
 * @return int
 */
function ajouter_demande_auteur_projet($id_auteur,$id_projet ){
    $existant = sql_getfetsel('id_auteur_projet', 'spip_auteur_projet', 'id_auteur=' . intval($id_auteur) . ' AND id_projet=' . intval($id_projet));

    if (!$existant) {
        // On ajoute la demande de l'auteur
        $id_auteur_projet = sql_insertq('spip_auteur_projet', array(
            'id_auteur' => $id_auteur,
            'id_projet' => $id_projet,
            'etat' => '0',
            'date' => 'NOW()',
            'maj' => 'NOW()'
        ));
    }else{
        $id_auteur_projet = $existant;
        sql_updateq('spip_auteur_projet', array('etat' => '0'), 'id_auteur_projet=' . $id_auteur_projet);
    }


    // Appel de la notification pour informer l'auteur
    if (test_plugin_actif('notifavancees')) {
        $notifications = charger_fonction('notifications', 'inc/');
        $config_demande_projet = lire_config('osi_projets/notification/demande_projet');
        if ($config_demande_projet == 1){
            $notifications('inscription_dans_projet', $id_auteur_projet, array('id_projet' => $id_projet, 'id_auteur' => $id_auteur));
        }
    }

    return $id_auteur_projet;
}




/**
 * Permet d'ajouter une demande pour rejoindre un projet
 *
 * @param int $id_role
 * @param string $valeur
 * @param int $id_auteur_projet
 * @return int
 */
function ajouter_demande_role($id_role,$valeur,$id_auteur_projet ){

    $demande = '1';

    if ($valeur == '' || $valeur === null) {
        $demande = '0';
    }

    // $data_roles = array(
    //     'id_role' => $id_role,
    //     'id_auteur_projet' => $id_auteur_projet,
    //     'valeur' => $valeur,
    //     'demande' => '1'
    // );

    $data_roles = array(
        'id_role' => $id_role,
        'id_auteur_projet' => $id_auteur_projet,
        'valeur' => '0',
        'demande' => $demande
    );


    if($demande != '0'){
        $res_role = sql_insertq('spip_osip_roles_liens', $data_roles);
    }else {
        $res_role = 'Pas de demande pour ce rôle';
    }

    return $res_role;

}



