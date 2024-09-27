<?php
if (!defined("_ECRIRE_INC_VERSION")) {
    return;
}

function balise_OSIP_NB_DEMANDES($p) {
    return calculer_balise_dynamique($p, 'OSIP_NB_DEMANDES', array('id_projet'));
}

function balise_OSIP_NB_DEMANDES_stat($args, $context_compil) {
    return $args;
}

// Fonction pour calculer le nombre d'auteurs qui appartiennent à un projet
function calculer_nb_demandes($id_projet) {
    include_spip('base/abstract_sql');
    $id_projet = intval($id_projet); 
    $nb_projets = sql_countsel('spip_auteur_projet', 'id_projet=' . $id_projet . ' AND etat=0');
    return $nb_projets;
}

function balise_OSIP_NB_DEMANDES_dyn($id_projet) {
    return calculer_nb_demandes($id_projet);
}
?>
