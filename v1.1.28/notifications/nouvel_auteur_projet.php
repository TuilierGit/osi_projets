<?php

 if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



function notifications_nouvel_auteur_projet_destinataires_dist($id_auteur_projet, $options) {
    // Récupérer l'id_projet depuis les options
    $id_projet = $options['id_projet'];

    // Rechercher tous les auteurs (id_auteur) associés à ce projet dans spip_auteur_projet
    $auteurs_projet = sql_allfetsel('id_auteur', 'spip_auteur_projet', 'id_projet='.intval($id_projet));

    // Créer un tableau contenant les ID des auteurs pour la notification
    $destinataires = array();
    
    // Ajouter chaque id_auteur à la liste des destinataires
    foreach ($auteurs_projet as $auteur) {
        $destinataires[] = $auteur['id_auteur'];
    }

    // Retourner la liste des destinataires
    return $destinataires;
}

?>