<?php
	function accordionCCP($id_pce, $date_debut_periode, $date_fin_periode, $qualite_releve_debut, $statut_releve_debut, $valeur_index_brut_debut, $horodate_Index_brut_debut, $valeur_index_converti_debut, $horodate_Index_converti_debut, $date_releve_fin, $libelle_raison_releve_fin, $qualite_releve_fin, $statut_releve_fin, $valeur_index_brut_fin, $horodate_Index_brut_fin, $valeur_index_converti_fin, $horodate_Index_converti_fin, $date_debut_consommation, $date_fin_consommation, $volume_brut, $coeff_pta, $valeur_pcs, $coeff_conversion, $volume_converti, $energie, $type_qualif_conso, $statut_conso, $journee_gaziere_consommation, $date_debut_bordereau, $date_fin_bordereau, $nb_jour_gazier_bordereau, $statut_restitution){
		$htmlCCP = "";

		// DÉBUT de la div dédiée à l'id_pce et la période
		$htmlCCP .= "<div class=\"boxresult\">";

		// ID PCE & Période
		$htmlCCP .= "<p>ID PCE : " . $id_pce . "</p>";
		$htmlCCP .= "<p>Date Début Période : " . $date_debut_periode . "</p>";
		$htmlCCP .= "<p>Date Fin Période : " . $date_fin_periode . "</p>";

		// FIN de la div dédiée à l'id_pce et à la période
		$htmlCCP .= "</div>";

		// DÉBUT de la div
		$htmlCCP .= "<div class=\"boxresult\">";

		// Relevé Début
		$htmlCCP .= "<p>Qualité Relevé Début : " . $qualite_releve_debut . "</p>";
		$htmlCCP .= "<p>Statut Relevé Début : " . $statut_releve_debut . "</p>";
		$htmlCCP .= "<p>Valeur index Brut Début : " . $valeur_index_brut_debut . "</p>";
		$htmlCCP .= "<p>Horodate index Brut Début : " . $horodate_Index_brut_debut . "</p>";
		if (isset($valeur_index_converti_debut)) {
			$htmlCCP .= "<p>Valeur Index Converti Début : " . $valeur_index_converti_debut . "</p>";
		}
		if (isset($horodate_Index_converti_debut)) {
			$htmlCCP .= "<p>Horodate Index Converti Début : " . $horodate_Index_converti_debut . "</p>";
		}

		// Relevé Fin
		$htmlCCP .= "<p>Date Relevé Fin : " . $date_releve_fin . "</p>";
		$htmlCCP .= "<p>Raison Relevé Fin : " . $libelle_raison_releve_fin . "</p>";
		$htmlCCP .= "<p>Qualité Relevé Fin : " . $qualite_releve_fin . "</p>";
		$htmlCCP .= "<p>Statut Relevé Fin : " . $statut_releve_fin . "</p>";
		$htmlCCP .= "<p>Valeur Index Brut Fin : " . $valeur_index_brut_fin . "</p>";
		$htmlCCP .= "<p>Horodate Index Brut Fin : " . $horodate_Index_brut_fin . "</p>";
		if (isset($valeur_index_converti_fin)) {
			$htmlCCP .= "<p>Valeur Index Converti Fin : " . $valeur_index_converti_fin . "</p>";
		}
		if (isset($horodate_Index_converti_fin)) {
			$htmlCCP .= "<p>Horodate Index Converti Fin : " . $horodate_Index_converti_fin . "</p>";
		}

		// Consommation
		$htmlCCP .= "<p>Date Début Consommation : " . $date_debut_consommation . "</p>";
		$htmlCCP .= "<p>Date Fin Consommation : " . $date_fin_consommation . "</p>";
		$htmlCCP .= "<p>Volume Brut Consommation : " . $volume_brut . "</p>";
		if (isset($coeff_pta)) {
			$htmlCCP .= "<p>Coefficient PTA Consommation : " . $coeff_pta . "</p>";
		}
		if (isset($coeff_pta)) {
			$htmlCCP .= "<p>Valeur PCS Consommation : " . $valeur_pcs . "</p>";
		}
		$htmlCCP .= "<p>Coefficient Converti Consommation : " . $coeff_conversion . "</p>";
		$htmlCCP .= "<p>Volume Converti Consommation : " . $volume_converti . "</p>";
		$htmlCCP .= "<p>Energie Consommation : " . $energie . "</p>";
		$htmlCCP .= "<p>Type Qualification Consommation : " . $type_qualif_conso . "</p>";
		if (isset($statut_conso)) {
			$htmlCCP .= "<p>Statut Consommation : " . $statut_conso . "</p>";
		}
		if (isset($journee_gaziere_consommation)) {
			$htmlCCP .= "<p>Journée Gazière Consommation : " . $journee_gaziere_consommation . "</p>";
		}

		// Bordereau Publication.
		if (isset($date_debut_bordereau)) {
			$htmlCCP .= "<p>Date Début Bordereau : " . $date_debut_bordereau . "</p>";
		}
		if (isset($date_fin_bordereau)) {
			$htmlCCP .= "<p>Date Fin Bordereau : " . $date_fin_bordereau . "</p>";
		}
		if (isset($nb_jour_gazier_bordereau)) {
			$htmlCCP .= "<p>Nombre Jour Gazier Bordereau : " . $nb_jour_gazier_bordereau . "</p>";
		}

		// Statut Restitution
		if (isset($statut_restitution)) {
			$htmlCCP .= "<p>Statut Restitution : " . $statut_restitution . "</p>";
		}

		// FIN de la div
		$htmlCCP .= "</div>";
		return $htmlCCP;
	}

	function prettifyCCP($jarOutputCCP){
		$htmlFinalCCP = "";
		$tailleReponse = count($jarOutputCCP) - 1;
		for ($i=0; $i < $tailleReponse; $i++) {
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCCP[$i]))))['resultat'];

			// ID PCE et Période
			$id_pce = ((array) $jsonOutput['pce'])['id_pce'];
			$date_debut_periode = ((array) $jsonOutput['periode'])['date_debut'];
			$date_fin_periode = ((array) $jsonOutput['periode'])['date_fin'];

			// Releve_debut DÉBUT
			$qualite_releve_debut = ((array) $jsonOutput['releve_debut'])['qualite_releve'];
			$statut_releve_debut = ((array) $jsonOutput['releve_debut'])['statut_releve'];
			$valeur_index_brut_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_brut_debut'])['valeur_index'];
			$horodate_Index_brut_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_brut_debut'])['horodate_Index'];
			$valeur_index_converti_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_converti_debut'])['valeur_index'];
			$horodate_Index_converti_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_converti_debut'])['horodate_Index'];
			// Releve_debut TERMINÉ

			// Releve_fin DÉBUT
			$date_releve_fin = ((array) $jsonOutput['releve_fin'])['date_releve'];
			$libelle_raison_releve_fin = ((array) $jsonOutput['releve_fin'])['libelle_raison_releve'];
			$qualite_releve_fin = ((array) $jsonOutput['releve_fin'])['qualite_releve'];
			$statut_releve_fin = ((array) $jsonOutput['releve_fin'])['statut_releve'];
			$valeur_index_brut_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_brut_fin'])['valeur_index'];
			$horodate_Index_brut_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_brut_fin'])['horodate_Index'];
			$valeur_index_converti_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_converti_fin'])['valeur_index'];
			$horodate_Index_converti_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_converti_fin'])['horodate_Index'];
			// Releve_fin TERMINÉ

			// Consommations DÉBUT
			$date_debut_consommation = ((array) $jsonOutput['consommation'])['date_debut_consommation'];
			$date_fin_consommation =  ((array) $jsonOutput['consommation'])['date_fin_consommation'];
			$volume_brut  = ((array) $jsonOutput['consommation'])['volume_brut'];
			$coeff_pta = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['coeff_pta'];
			$valeur_pcs = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['valeur_pcs'];
			$coeff_conversion = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['coeff_conversion'];
			$volume_converti = ((array) $jsonOutput['consommation'])['volume_converti'];
			$energie = ((array) $jsonOutput['consommation'])['energie'];
			$type_qualif_conso = ((array) $jsonOutput['consommation'])['type_qualif_conso'];
			$statut_conso = ((array) $jsonOutput['consommation'])['statut_conso'];
			$journee_gaziere_consommation = ((array) $jsonOutput['consommation'])['journee_gaziere'];
			// Consommations TERMINÉ

			// Bordereau_publication DÉBUT
			$date_debut_bordereau = ((array) $jsonOutput['bordereau_publication'])['date_debut_bordereau'];
			$date_fin_bordereau = ((array) $jsonOutput['bordereau_publication'])['date_fin_bordereau'];
			$nb_jour_gazier_bordereau = ((array) $jsonOutput['bordereau_publication'])['nb_jour_gazier'];
			// Bordereau_publication TERMINÉ

			// Statut_restitution DÉBUT
			$statut_restitution = $jsonOutput['statut_restitution'];
			// Statut_restitution TERMINÉ
			

			$htmlFinalCCP .= accordionCCP($id_pce, $date_debut_periode, $date_fin_periode, $qualite_releve_debut, $statut_releve_debut, $valeur_index_brut_debut, $horodate_Index_brut_debut, $valeur_index_converti_debut, $horodate_Index_converti_debut, $date_releve_fin, $libelle_raison_releve_fin, $qualite_releve_fin, $statut_releve_fin, $valeur_index_brut_fin, $horodate_Index_brut_fin, $valeur_index_converti_fin, $horodate_Index_converti_fin, $date_debut_consommation, $date_fin_consommation, $volume_brut, $coeff_pta, $valeur_pcs, $coeff_conversion, $volume_converti, $energie, $type_qualif_conso, $statut_conso, $journee_gaziere_consommation, $date_debut_bordereau, $date_fin_bordereau, $nb_jour_gazier_bordereau, $statut_restitution);
		}
		return $htmlFinalCCP;
	}
?>