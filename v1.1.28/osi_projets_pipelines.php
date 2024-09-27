<?php
/**
 * Déclaration des pipelines utilisés par le plugin
 *
 * @plugin     osi_projets
 * @copyright  2024
 * @author     Tuilier Thomas
 * @licence    GNU/GPL
 * @package    SPIP\osi_projets\Pipelines
 */

if (!defined("_ECRIRE_INC_VERSION")) {
	return;
}


//////////////////////////
//                      //
//       Actions        //
//                      //
//////////////////////////


/**
 * Pipeline qui s'occupe de réaliser différentes actions quand nouvelle rubrique avec le modele "projet" est créé
 * 
 *
 * @param array $flux
 * 		Le contexte du pipeline
 * @return array $flux
 * 		Le contexte du pipeline modifié
 */
function osi_projets_insertion_rubrique($flux) {
  // On vérifie que l'objet inséré est une rubrique
  if ($flux['args']['table'] == 'spip_rubriques') {
      $id_rubrique = $flux['args']['id_objet'];
      // On vérifie que le paramètre du modele est bien "projet"
      if (_request('modele') == 'projet') {

        include_spip('action/tables/ajouter_dans_tables');

        include_spip('inc/session');
        $id_auteur = session_get('id_auteur');


        // On met à jour la rubrique pour mettre sont état à publique dans le cas où l'option est activé
        $verification_active = lire_config('osi_projets/verification_projets');
        if ($verification_active == 0) {
          sql_updateq('spip_rubriques', ['statut' => 'publie' ], 'id_rubrique=' . intval($id_rubrique));
          $id_projet = ajouter_projet($id_rubrique,$id_auteur , 'publie');
        } else {
          $id_projet = ajouter_projet($id_rubrique,$id_auteur);
        }

        // Pour mettre la personnalisation sur le projet et non sur la rubrique
        spip_log("ID Projet après insertion : $id_projet", 'osi_projets');
        if ($id_projet) {
          $descriptif = sql_getfetsel('descriptif', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));
          $texte = sql_getfetsel('texte', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));

          spip_log("Descriptif récupéré : $descriptif", 'osi_projets');
          spip_log("Texte récupéré : $texte", 'osi_projets');

          if ($descriptif) {
              sql_updateq('spip_rubriques', ['descriptif' => ''], 'id_rubrique=' . intval($id_rubrique));
              sql_updateq('spip_projets', ['descriptif' => $descriptif], 'id_projet=' . intval($id_projet));
          }

          if ($texte) {
              sql_updateq('spip_rubriques', ['texte' => ''], 'id_rubrique=' . intval($id_rubrique));
              sql_updateq('spip_projets', ['texte' => $texte], 'id_projet=' . intval($id_projet));
          }
        }

        if ($id_projet) {
            spip_log("Rubrique mise à jour avec ID Projet : $id_projet", 'osi_projets');
        } else {
            spip_log("Erreur lors de l'insertion du projet pour la rubrique : $id_rubrique", 'osi_projets');
        }

      }
  }





  if ($flux['args']['table'] == 'spip_mots_liens' && $flux['args']['type'] == 'rubrique') {
      $id_rubrique = $flux['args']['id_objet'];
      $id_mot = $flux['args']['id_mot'];

      // Récupère le projet associé à la rubrique
      $id_projet = sql_getfetsel('id_projet', 'spip_rubriques', 'id_rubrique=' . intval($id_rubrique));

      if ($id_projet > 0) {
          // Vérifie si le mot clé est déjà associé au projet
          $deja_lie = sql_getfetsel('id_mot', 'spip_mots_liens', array(
              'id_mot' => intval($id_mot),
              'objet' => 'projet',
              'id_objet' => intval($id_projet)
          ));

          if (!$deja_lie) {
              // Associe le mot clé au projet
              sql_insertq('spip_mots_liens', array(
                  'id_mot' => intval($id_mot),
                  'objet' => 'projet',
                  'id_objet' => intval($id_projet)
              ));
          }
      }
  }




  
  return $flux;
}




/**
 * Pipeline qui s'occupe de rediriger correctement après le post d'un formulaire.
 * 
 *
 * @param array $flux
 * 		Le contexte du pipeline
 * @return array $flux
 * 		Le contexte du pipeline modifié
 */

 function osi_projets_formulaire_traiter($flux) {
  
  if ($flux['args']['form'] === 'forum') {

    echo '<pre>';
    echo '<div style="padding:14px;background:darkgray;border:solid 1px black;border-radius:10px;color: white;display: flex;justify-content: center;position: relative;top: 30vw;width: 400px;margin: auto;">' . _T('osi_projets:message_page_forum') . '</div>';
    // print_r($flux);
    echo '
    <script>
      const urlWithoutParams = window.location.origin + window.location.pathname;
      const queryParams = window.location.search;
      window.location.href = urlWithoutParams + queryParams;
    </script>
    ';

    // window.location.reload(true);


    echo '</pre>';

    $id_forum = $flux['args']['id_forum'];
    $objet = $flux['args']['args'][0];
    $id_objet = $flux['args']['args'][1];


    if ($objet ='rubrique'){
      $test_projet = sql_getfetsel("id_projet","spip_rubriques", "id_rubrique=$id_objet");
      if (intval($test_projet) > 0 ){
        $res = formulaires_forum_traiter($id_forum);
        if ($res['message_ok']) {
            $flux['data'] .= "<p class='success'>{$res['message_ok']}</p>";
        } elseif ($res['message_erreur']) {
            $flux['data'] .= "<p class='error'>{$res['message_erreur']}</p>";
        }
        $url_nouvelle = url_absolue(self());
        $url_nouvelle = str_replace('#formulaire_forum', '', $url_nouvelle);
        $flux['data']['redirect'] = $url_nouvelle;
      }
    }
  }
  return $flux;
}


//////////////////////////
//                      //
//      Affichages      //
//                      //
//////////////////////////


// Export de la config
function osi_projets_ieconfig_metas($table) {
	$table['projets']['titre'] = _T('osi_projets:titre_projets');
	$table['projets']['icone'] = 'prive/themes/spip/images/osi_projets_16.png';
	return $table;
}


// Fonction pour ajouter la boîte d'information

function osi_projets_boite_infos($flux) {
  $texte = "";

  if ($flux['args']['type'] == 'rubrique') {

    $id_rubrique = $flux['args']['id'];
    $id_projet = recuperer_id_projet($id_rubrique);

    if ($id_projet > 0) {
      $texte .= "<p>Cette rubrique est associée à un projet</p>";

    } else {
      $chemin_image = find_in_path('prive/themes/spip/images/osi_projets_30.png');
      $id_auteur = session_get('id_auteur');
      $url_associer = generer_action_auteur('associer_projet', $id_rubrique . ':' . $id_auteur);
       $texte .='
       <span class="icone s24 horizontale  associer-projet">
        <a class="mediabox cboxElement hasbox" href="'. $url_associer . '" title="' . _T('osi_projets:associer_projet') . '">
          <img src="'. $chemin_image .'" alt="' ._T('osi_projets:associer_projet') . '" width="24" height="24">
          <b>' . _T('osi_projets:associer_projet') . '</b>
        </a>
       </span>
       ';
    }
  }


  if ($flux['args']['type'] == 'projet') {

    $id_projet = $flux['args']['id'];

    if ($id_projet > 0) {
      $texte .= recuperer_fond('prive/objets/infos/projet', array(
            'id_projet' => $id_projet,
            'env' => $flux['args']['env'],
            'ajax' => true
      ));    

      $chemin_image = find_in_path('prive/themes/spip/images/osi_projets_30.png');
      $id_rubrique = sql_getfetsel("id_rubrique", "spip_rubriques", "id_projet=" . intval($id_projet));
      $test = sql_getfetsel("statut", "spip_rubriques", "id_projet=" . intval($id_projet));

      if ($test != 'publie'){
        $option = 'publie';
        $cas = _T('osi_projets:publier_projet');

        $url_associer = generer_action_auteur('publier_projet', $id_rubrique . ':' . $option);
        $texte .='
        <span class="icone s24 horizontale  publier-projet">
          <a class="mediabox cboxElement hasbox" href="'. $url_associer . '" title="' . $cas . '">
            <img src="'. $chemin_image .'" alt="' .$cas . '" width="24" height="24">
            <b>' . $cas . '</b>
          </a>
        </span>
        ';

      } 
      
    }
  }

  $flux['data'] .= $texte;
  return $flux;
}






function osi_projets_affiche_milieu($flux) {

  // Pour la page projet
  if ($flux['args']['exec'] == 'projet') {
    $texte = "";
    $id_rubrique = $flux['args']['id_rubrique'];
    $id_projet = $flux['args']['id_projet'];

    if (isset($id_projet)) {
      if ($id_projet > 0) {
        
        $texte .= "<div class='presentation-info-projet-container'>";
        $texte .= "<h3>" . _T('osi_projets:titre_gestion_membres') . "</h3>";
        $texte .= recuperer_fond('prive/objets/liste/pr_auteurs', array(
          'statut' => $flux['args']['statut'],
          'id_projet'=> $id_projet,
          'nb' => 30,
          'titre' => _T('osi_projets:titre_toutes_les_auteurs'),
          'sinon' => _T('osi_projets:aucun_auteur'),
          'env' => $flux['args']['env'],
          'ajax' => true
        ));
        $texte .= "</div>";
      } 

    } 
    $flux['data'] .= $texte;
  }

  // Pour la page rubrique
  if (isset($flux['args']['id_rubrique'])){ 
    $id_rubrique = $flux['args']['id_rubrique'];
      if ($e = trouver_objet_exec($flux['args']['exec']) AND $e['edition'] == false){
          

      $id_projet = sql_getfetsel('id_projet', 'spip_rubriques','id_rubrique='. $id_rubrique .' AND id_projet>0');
      if ($id_projet > 0){
        // TODO: affichage d'un lien vers le projet associé ?
      }
        
      // Affichage de a liste des sous projet
      $flux['data'] .= recuperer_fond('prive/objets/liste/pr_rubriques', array(
        'nb' => 30,
        'id_parent' => $id_rubrique,
        'titre' => _T('osi_projets:titre_sous_projets'),
        'sinon' => _T('osi_projets:aucun_sous_projet'),
        'env' => $flux['args']['env'],
        'ajax' => true
      ));

      // Bouton de création d'un sous projet
      $flux['data'] .= icone_verticale(
        _T('osi_projets:titre_edition_enfant'),
        parametre_url(
          parametre_url(
            parametre_url(
              parametre_url(
                generer_url_ecrire('rubrique_edit'),
              'id_parent', $id_rubrique),
            'modele', 'projet'),
          'new', 'oui'), 
        'statut_tmp', 'prepa'),
        find_in_path('prive/themes/spip/images/osi_projets_30.png'),
        'new',
        'right'
      ) . "<br class='nettoyeur' />";
    }
  }
  return $flux;
}  


?>
