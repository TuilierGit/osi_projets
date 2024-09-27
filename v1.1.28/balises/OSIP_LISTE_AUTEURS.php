<?php
if (!defined('_ECRIRE_INC_VERSION')) return;



function balise_OSIP_LISTE_AUTEURS($p) {
    return calculer_balise_dynamique($p, 'OSIP_LISTE_AUTEURS', array('id_projet'));
}



function balise_OSIP_LISTE_AUTEURS_stat($args, $context_compil) {
    return $args;
}



function balise_OSIP_LISTE_AUTEURS_dyn($id_projet) {

    $contexte = array(
        'id_projet' => $id_projet,
        'nb' => 30,
        'titre' => _T('osi_projets:titre_tous_les_auteurs'),
        'sinon' => _T('osi_projets:aucun_auteur'),
    );

    return recuperer_fond('prive/objets/liste/pr_auteurs', $contexte);
}
?>