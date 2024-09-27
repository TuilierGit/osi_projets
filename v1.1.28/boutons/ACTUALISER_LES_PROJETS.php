<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



// Fonction pour générer le bouton d'action
function calculer_bouton_parcourir_projets() {
    include_spip('inc/filtres');
    
    $label = 'Actualiser les projets';
    $url_action = generer_action_auteur('parcourir_rubriques_et_mettre_a_jour', '', self());
    $class = 'bouton_class';
    $confirm = "Confirmer l'actualisation";
    $title = 'Parcourir et mettre à jour';
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}





// Déclaration de la balise
function balise_ACTUALISER_LES_PROJETS($p) {
    $p->code = "calculer_bouton_parcourir_projets()";
    $p->interdire_scripts = false;
    return $p;
}

?>