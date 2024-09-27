<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

///////// Déclaration des balises 

include_spip('balises/OSIP_AUTEUR_DU_PROJET');

include_spip('balises/OSIP_DEBUG_NB_PROJETS');
include_spip('balises/OSIP_DEBUG_NB_RUBRIQUES');

include_spip('balises/OSIP_ETAT_LIEN_PROJET');


include_spip('balises/OSIP_LISTE_AUTEURS');
include_spip('balises/OSIP_LISTE_DEMANDES');
include_spip('balises/OSIP_LISTE_MEMBRES');
include_spip('balises/OSIP_LISTE_ADMINISTRATEURS');

include_spip('balises/OSIP_LISTE_PROJETS');
include_spip('balises/OSIP_LISTE_PROJETS_CONNEXION');

// include_spip('balises/OSIP_MOTS_VALEUR');
include_spip('balises/OSIP_MOTS');

include_spip('balises/OSIP_NB_PROJETS');
include_spip('balises/OSIP_NB_AUTEURS');
include_spip('balises/OSIP_NB_DEMANDES');
include_spip('balises/OSIP_NB_TOUS_LES_PROJETS');


// Balises dangereuses à ne pas mettre n'importe où 

// include_spip('balises/OSIP_TOUS_LES_AUTEURS');
// include_spip('balises/OSIP_TOUS_LES_DEMANDES');
include_spip('balises/OSIP_SOUS_PROJETS');
include_spip('balises/OSIP_TOUS_LES_PROJETS');



?>
