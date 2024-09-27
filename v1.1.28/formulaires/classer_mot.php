<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_classer_mot_charger_dist($id_mot, $id_objet, $nom_objet , $texte_bouton = null, $titre= "") {
    return array(
        'id_mot' => $id_mot,
        'id_objet' => $id_objet,
        'nom_objet' => $nom_objet,
        'texte_bouton' => $texte_bouton,
        'titre' => $titre

    );
}

function formulaires_classer_mot_verifier_dist($id_mot, $id_objet, $nom_objet , $texte_bouton = null, $titre= "") {
    $erreurs = array();
    return $erreurs;
}

function formulaires_classer_mot_traiter_dist($id_mot, $id_objet, $nom_objet ,  $texte_bouton = null, $titre= "") {   
    
    include_spip('base/abstract_sql'); // Inclusion de l'API SQL de SPIP

    $valeur = _request('valeur');


    // Mise à jour du mot-clé pour le projet
    $result = sql_updateq('spip_mots_liens', 
        array('lien_projet' => $valeur), 
        'id_mot=' . intval($id_mot) . ' AND id_objet=' . intval($id_objet) . " AND objet='" . $nom_objet ."'"
    );

    if ($result) {
        return array('message_ok' => 'Le champ a été changé avec succès.');
    } else {
        return array('message_erreur' => 'Erreur lors de la mise à jour.');
    }
}
?>
