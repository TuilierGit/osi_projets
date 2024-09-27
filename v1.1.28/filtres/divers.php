<?php

if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

// function selecteur_rubrique_spip($id_rubrique = 0, $type = 'rubrique', $restreint = false, $idem = 0) {
//     include_spip('ecrire/inc/chercher_rubrique');
//     return selecteur_rubrique_html($id_rubrique, $type, $restreint, $idem);
// }



function selecteur_rubrique_spip($id_rubrique = 0, $type = 'rubrique', $restreint = false, $idem = 0) {
    include_spip('ecrire/inc/chercher_rubrique');
    $selecteur = selecteur_rubrique_html($id_rubrique, $type, $restreint, $idem);
    $selecteur = str_replace("name='id_parent'", "name='id_rubrique'", $selecteur);
    return $selecteur;
}



/**
 * Filtre pour acceder à la page d'un projet
 *
 * @param int $id_projet
 * @return string
 */
function filtre_voir_le_projet($id_projet){
    $url_projet = generer_url_entite($id_projet, 'projet');
    return "<a href='$url_projet' class='btn btn-primary'>" . _T('osi_projets:voir_projet') . "</a>";
}



/**
 * Filtre pour acceder à la page rubrique d'un projet
 *
 * @param int $id_projet
 * @return string
 */
function filtre_voir_la_rubrique($id_projet){
    $id_rubrique = sql_getfetsel('id_rubrique', 'spip_projets', 'id_projet=' . $id_projet);
    $url_rubrique = generer_url_entite($id_rubrique, 'rubrique');
    return "<a href='$url_rubrique' class='btn btn-primary'>" . _T('osi_projets:voir_rubrique') . "</a>";;
}




// Divers

function filtre_nom_auteur($id_auteur) {
    $nom = sql_getfetsel('nom', 'spip_auteurs', 'id_auteur='.intval($id_auteur));
    return $nom;
}

