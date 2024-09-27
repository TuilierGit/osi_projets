<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
} 


// Fonction pour calculer le nombre de rubriques associés à des projets visibles sur le front
function calculer_nb_pr_rubriques_publiques($id_rubrique) {
    include_spip('base/abstract_sql');
    $nb_projets = 0;
    if ($id_rubrique > 0){
        $nb_projets = sql_countsel('spip_rubriques', 'id_projet > 0 AND statut="publie" AND id_parent=' . sql_quote($id_rubrique));
    } else {
        $nb_projets = sql_countsel('spip_rubriques', 'id_projet > 0 AND statut="publie"');
    }
    return  $nb_projets;
}


function balise_OSIP_NB_PROJETS($p) {
    return calculer_balise_dynamique($p, 'OSIP_NB_PROJETS', array('id_rubrique'));
}

function balise_OSIP_NB_PROJETS_stat($args, $context_compil) {
    $id_rubrique = isset($args[0]) ? $args[0] : 0;
    return array($id_rubrique);
}


function balise_OSIP_NB_PROJETS_dyn($id_rubrique) {
    return calculer_nb_pr_rubriques_publiques($id_rubrique);
}


?>