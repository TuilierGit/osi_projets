<?php
if (!defined('_ECRIRE_INC_VERSION')) return;



function balise_OSIP_ETAT_LIEN_PROJET($p) {
    return calculer_balise_dynamique($p, 'OSIP_ETAT_LIEN_PROJET', array('id_projet', 'id_auteur'));
}



function balise_OSIP_ETAT_LIEN_PROJET_stat($args, $context_compil) {
    // Séparer les arguments
    $id_projet = isset($args[0]) ? $args[0] : 0;
    $id_auteur = isset($args[1]) ? $args[1] : 0;
    return array($id_projet, $id_auteur);
}



function balise_OSIP_ETAT_LIEN_PROJET_dyn($id_projet, $id_auteur) {
    $etat = sql_getfetsel('etat', 'spip_auteur_projet', 'id_projet=' . intval($id_projet) . ' AND id_auteur=' . intval($id_auteur));
    return intval($etat);
}
?>
