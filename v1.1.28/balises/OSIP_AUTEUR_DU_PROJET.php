<?php
if (!defined('_ECRIRE_INC_VERSION')) return;



function balise_OSIP_AUTEUR_DU_PROJET($p) {
    return calculer_balise_dynamique($p, 'OSIP_AUTEUR_DU_PROJET', array('id_projet'));
}



function balise_OSIP_AUTEUR_DU_PROJET_stat($args, $context_compil) {
    // $id_projet = isset($args[0]) ? $args[0] : 0;
    // return $id_projet;
    // Séparer les arguments
    $id_projet = isset($args[0]) ? $args[0] : 0;
    $nom = isset($args[1]) ? $args[1] : 0;
    return array($id_projet, $nom);
}



function balise_OSIP_AUTEUR_DU_PROJET_dyn($id_projet, $nom) {

    $id_auteur = sql_getfetsel(
        'id_auteur', 
        'spip_auteur_projet', 
        'id_projet=' . $id_projet .' AND etat=3'
    );

    if ($nom != null){
        return sql_getfetsel(
            'nom', 
            'spip_auteurs', 
            'id_auteur=' . $id_auteur
        );
    } 
    

    // if (verifier_existe_auteur_projet($id_auteur, $id_projet,'3') == false){
    //     return 0;
    // }

    // return $id_auteur ? $id_auteur : 0;
    return $id_auteur;
}
?>
