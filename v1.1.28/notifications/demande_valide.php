<?php

 if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



function notifications_demande_valide_destinataires_dist($id_auteur_projet, $options) {
    // Récupérer l'auteur qui a fait la demande
    $id_auteur = $options['id_auteur'];

    // Retourner l'id_auteur pour l'envoyer par email
    return array($id_auteur);
}

?>