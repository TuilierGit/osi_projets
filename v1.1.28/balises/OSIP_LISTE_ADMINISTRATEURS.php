<?php
if (!defined('_ECRIRE_INC_VERSION')) return;



function balise_OSIP_LISTE_ADMINISTRATEURS($p) {
    return calculer_balise_dynamique($p, 'OSIP_LISTE_ADMINISTRATEURS', array('id_projet', 'valeur'));
}



function balise_OSIP_LISTE_ADMINISTRATEURS_stat($args, $context_compil) {
    $id_projet = isset($args[0]) ? $args[0] : 0;
    return $id_projet;
}



function balise_OSIP_LISTE_ADMINISTRATEURS_dyn($id_projet) {

    $contexte = array(
        'id_projet' => $id_projet,
        'etat' => 2,
        'nb' => 30,
        'titre' => _T('osi_projets:titre_tous_les_auteurs'),
        'sinon' => _T('osi_projets:aucun_auteur'),
    );

    return recuperer_fond('prive/objets/liste/pr_auteurs', $contexte);
}
?>
