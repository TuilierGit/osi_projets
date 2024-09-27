<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('balises/_balises');
include_spip('boutons/_boutons');
include_spip('filtres/_filtres');
include_spip('filtres/verification_aux');



//////////////////////////
//                      //
//    Fonctions GET     //
//                      //
//////////////////////////



/////// Ce sont des getters exclusivement pour le back-end, pour le front end voir dans filtres.

/**
 * Renvoie le chemin configuré pour la création de projet (renvoie id_parent)
 *
 * @return array
 */

 function get_project_path($id_rubrique = "-1") {
    if ($id_rubrique == "-1"){
        return lire_config('osi_projets/id_chemin_rubrique', '0');
    } else{
        $chemin = sql_getfetsel('id_parent', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));
        return $chemin;
    }
    
}


/**
 * Renvoie l'id_secteur du chemin configuré pour la création de projet
 *
 * @return array
 */

 function get_id_secteur($id_rubrique = "-1") {
    if ($id_rubrique == "-1"){
        return get_project_path();
    } else{
        $secteur = sql_getfetsel('id_secteur', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));
        return $secteur;
    }
}



/**
 * Récupère la profondeur d'une rubrique à partir de son identifiant.
 *
 * @param int $id_rubrique
 *     L'identifiant de la rubrique.
 * @return int
 *     La profondeur de la rubrique.
 **/
function get_profondeur_rubrique($id_rubrique = "-1") {
    include_spip('base/abstract_sql');

    if ($id_rubrique == "-1"){
        $id_chemin_rubrique = lire_config('osi_projets/id_chemin_rubrique', '0');
        $result = sql_getfetsel('profondeur', 'spip_rubriques', 'id_rubrique = ' . intval($id_chemin_rubrique));
    } else{
        $result = sql_getfetsel('profondeur', 'spip_rubriques', 'id_rubrique = ' . intval($id_rubrique));
    }

    if ($result) {
        return $result;
    } else {
        return 0; // Retourne 0 si la rubrique n'est pas trouvée
    }
}


/**
 * Renvoie la profondeur du chemin configuré pour la création de projet
 *
 * @return array
 */

 function get_profondeur() {
    return get_profondeur_rubrique(get_project_path());
}



// permet de récéperer l'id_projet
function recuperer_id_projet($id_rubrique) {
    return sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));
  }
  
  
// permet de récéperer l'id_projet
function recuperer_id_projet_via_projet($id_rubrique) {
    return sql_getfetsel('id_projet', 'spip_projets', 'id_rubrique=' . intval($id_rubrique));
}



/**
 * Permet de vérifier l'activation de la vérification du projet côté front ou pas.
 *
 * @return bool
 */
function activation_de_la_verification() {
    return verifier_configuration_valeur('osi_projets/','verification_projets', 1 );;
}





//////////////////////////
//                      //
//      Affichages      //
//                      //
//////////////////////////


/**
 * Fonction d'affichage de l'état d'un auteur qui appartient à un projet.
 * 
 * 
 * @param int $etat
 * @return string
**/
function filtre_affichage_etat_auteur($etat) {

    switch ($etat){
        case 1:
            return _T('osi_projets:nom_etat_1');
        case 2:
            return _T('osi_projets:nom_etat_2');
        case 3:
            return _T('osi_projets:nom_etat_3');
    }
    return _T('osi_projets:nom_erreur');
}



/**
 * Fonction d'affichage de l'état d'un auteur qui appartient à un projet.
 * 
 * 
 * @param int $etat
 * @return string
**/
function filtre_affichage_etat_role($etat) {

    switch ($etat){
        case 0:
            return _T('osi_projets:nom_etat_role_0');
        case 1:
            return _T('osi_projets:nom_etat_role_1');
    }
    return _T('osi_projets:nom_erreur');
}



/**
 * Fonction d'affichage d'une valeur binaire 0 ou 1.
 * 
 * 
 * @param int $valeur
 * @return string
**/
function filtre_affichage_oui_non($valeur) {

    switch ($valeur){
        case -1:
            return _T('osi_projets:demande_en_cours');
        case 0:
            return _T('osi_projets:nom_non');
        case 1:
            return _T('osi_projets:nom_oui');
    }
    return _T('osi_projets:nom_erreur');
}





/**
 * Fonction d'affichage du bouton changer_champ.
 * 
 * 
 * @param int $valeur
 * @return string
**/
function filtre_affichage_bouton_changer_champ($nom_affichage, $valeur) {


    if ($nom_affichage == 'oui_non'){
        return _T('osi_projets:debut_oui_nom') . filtre_affichage_oui_non($valeur);
    }

    if ($nom_affichage == 'oui_non_simple'){
        return filtre_affichage_oui_non($valeur);
    }


    if ($nom_affichage == 'affichage_etat'){
        switch ($valeur){
            case -2:
                return _T('osi_projets:affichage_etat_-2');
            case -1:
                return _T('osi_projets:affichage_etat_-1');
            case 0:
                return _T('osi_projets:affichage_etat_0');
            case 1:
                return _T('osi_projets:affichage_etat_1');
            case 2:
                return _T('osi_projets:affichage_etat_2');
            case 3:
                return _T('osi_projets:affichage_etat_3');
        }
    }


    if ($nom_affichage == 'affichage_demande'){
        switch ($valeur){
            case -2:
                return _T('osi_projets:affichage_etat_-2');
            case -1:
                return _T('osi_projets:affichage_demande_-1');
            case 1:
                return _T('osi_projets:affichage_demande_1');
        }
    }


    if ($nom_affichage == 'mot_projet'){
        switch ($valeur){
            case 0:
                return _T('osi_projets:nom_neutre');
            case 1:
                return _T('osi_projets:nom_cause');
            case 2:
                return _T('osi_projets:nom_condition');
            case 3:
                return _T('osi_projets:nom_recompense');
            case 4:
                return _T('osi_projets:nom_condition_inverse');
        }
    }   

    return $valeur;
}
  
  



/**
 * Fonction d'affichage qui affiche le nom d'un auteur en fonction de son identifiant.
 * 
 * 
 * @param int $identifiant
 * @return string
**/
function filtre_affichage_nom_auteur($id_auteur) {
    $nom_auteur = sql_getfetsel('nom', 'spip_auteurs', 'id_auteur=' . $id_auteur);
    return $nom_auteur ? $nom_auteur : '';
}
  
  

//////////////////////////
//                      //
//       Actions        //
//                      //
//////////////////////////




/**
 * Permet d'appliquer la récursivité à tous les projets déjà existant. 
 *
 * @param int $sens 
 * @return bool
 */

 function recursivite_projet($sens){
    
    if (lire_config('osi_projets/recursivite') == '1'){

        if ($sens == 1){
            //supprimer tous les mots clés relative à la récursivité 
            
        } else {
            // Récupérer tous les projets avec leur id_rubrique associé
            $projets = sql_allfetsel('id_projet, id_rubrique', 'spip_projets');

            foreach ($projets as $projet) {
                $id_projet = $projet['id_projet'];
                $id_rubrique = $projet['id_rubrique'];

                // Récupérer l'id_parent de la rubrique actuelle
                $id_rubrique_parent = sql_getfetsel('id_parent', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));

                // Récupérer id_projet de la rubrique parente
                $id_projet_rubrique_parent = sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique_parent));

                // Si la rubrique parente est associée à un projet
                if ($id_projet_rubrique_parent > 0) {

                    // Récupérer l'id_mot correspondant au projet parent
                    $id_mot_parent = sql_getfetsel('id_mot', 'spip_mots', 'titre="projet_' . intval($id_projet_rubrique_parent) . '"');

                    // Insérer l'association du mot-clé avec le projet actuel
                    sql_insertq('spip_mots_liens', array(
                        'id_mot' => intval($id_mot_parent),
                        'id_objet' => intval($id_projet),
                        'objet' => 'projet',
                        'lien_projet' => '2',
                        'niveau_projet' => '0',
                    ));
                }
            }
        }

        
    } else {
        return false;
    }

    return true;
 }


/**
 * Fonction pour parcourir les éléments de spip_projets et mettre à jour les rubriques.
 * 
 * 
 * @return void
**/
function parcourir_rubriques_et_mettre_a_jour() {
    spip_log("Début de la fonction parcourir_rubriques_et_mettre_a_jour", 'osi_projets');
    
    $projets = sql_allfetsel('id_projet, id_rubrique', 'spip_projets');

    foreach ($projets as $projet) {
        spip_log("Traitement du projet ID: " . $projet['id_projet'] . " avec rubrique ID: " . $projet['id_rubrique'], 'osi_projets');

        $result = sql_updateq(
            'spip_rubriques',
            array('id_projet' => $projet['id_projet']),
            'id_rubrique=' . intval($projet['id_rubrique'])
        );

        if ($result) {
            spip_log("Mise à jour réussie pour la rubrique ID: " . $projet['id_rubrique'] . " avec projet ID: " . $projet['id_projet'], 'osi_projets');
        } else {
            spip_log("Échec de la mise à jour pour la rubrique ID: " . $projet['id_rubrique'], 'osi_projets');
        }
    }

    spip_log("Fin de la fonction parcourir_rubriques_et_mettre_a_jour", 'osi_projets');
}



/**
 * Filtrer les mots-clés par table liée.
 *
 * @param array $mots
 * @param string $table_liee
 * @return array
 */
function filtrer_mots_par_table_liee($mots, $table_liee) {
    $id_mots = array_column($mots, 'id_mot');
    $id_mots_str = implode(',', array_map('intval', $id_mots));

    $groupes = sql_allfetsel(
        'spip_mots.id_mot',
        'spip_mots LEFT JOIN spip_groupes_mots ON spip_mots.id_groupe = spip_groupes_mots.id_groupe',
        'spip_mots.id_mot IN (' . $id_mots_str . ') AND FIND_IN_SET(' . sql_quote($table_liee) . ', spip_groupes_mots.tables_liees)'
    );

    $mots_filtres = array();
    foreach ($mots as $mot) {
        foreach ($groupes as $groupe) {
            if ($mot['id_mot'] == $groupe['id_mot']) {
                $mots_filtres[] = $mot;
                break;
            }
        }
    }

    return $mots_filtres;
}



/**
 * Copier les mots-clés de la rubrique vers le projet.
 *
 * @param int $id_projet
 * @return string
 */
function copier_mots_cle_rubrique_vers_projet($id_projet) {
    include_spip('inc/config');
    $synchronisation_active = lire_config('osi_projets/synchronisation_mots');

    // Récupérer l'ID de la rubrique associée au projet
    $id_rubrique = sql_getfetsel('id_rubrique', 'spip_projets', 'id_projet=' . intval($id_projet));

    if (!$id_rubrique) {
        return _T('osi_projets:message_erreur_aucune_rubrique');
    }

    // Récupérer les mots-clés de la rubrique
    $mots = sql_allfetsel('id_mot', 'spip_mots_liens', 'id_objet=' . intval($id_rubrique) . ' AND objet="rubrique"');

    if (empty($mots)) {
        return _T('osi_projets:message_aucun_mot_cle');
    }

    // Filtrer les mots-clés si la synchronisation est active
    if ($synchronisation_active == 1) {
        $mots = filtrer_mots_par_table_liee($mots, 'projet');
    }

    if (empty($mots)) {
        return _T('osi_projets:message_aucun_mot_cle');
    }

    // Ajouter les mots-clés au projet
    foreach ($mots as $mot) {
        sql_insertq('spip_mots_liens', array(
            'id_mot' => $mot['id_mot'],
            'id_objet' => intval($id_projet),
            'objet' => 'projet'
        ));
    }

    return _T('osi_projets:message_succes_copie_mots_cles');
}


/**
 * Copier les mots-clés du projet vers la rubrique.
 *
 * @param int $id_projet
 * @return string
 */
function copier_mots_cle_projet_vers_rubrique($id_projet) {
    include_spip('inc/config');
    $synchronisation_active = lire_config('osi_projets/synchronisation_mots');

    // Récupérer l'ID de la rubrique associée au projet
    $id_rubrique = sql_getfetsel('id_rubrique', 'spip_projets', 'id_projet=' . intval($id_projet));

    if (!$id_rubrique) {
        return _T('osi_projets:message_erreur_aucune_rubrique');
    }

    // Récupérer les mots-clés du projet
    $mots = sql_allfetsel('id_mot', 'spip_mots_liens', 'id_objet=' . intval($id_projet) . ' AND objet="projet"');

    if (empty($mots)) {
        return _T('osi_projets:message_aucun_mot_cle');
    }

    // Filtrer les mots-clés si la synchronisation est active
    if ($synchronisation_active == 1) {
        $mots = filtrer_mots_par_table_liee($mots, 'rubrique');
    }

    if (empty($mots)) {
        return _T('osi_projets:message_aucun_mot_cle');
    }

    // Ajouter les mots-clés à la rubrique
    foreach ($mots as $mot) {
        sql_insertq('spip_mots_liens', array(
            'id_mot' => $mot['id_mot'],
            'id_objet' => intval($id_rubrique),
            'objet' => 'rubrique'
        ));
    }

    return _T('osi_projets:message_succes_copie_mots_cles');
}




?>