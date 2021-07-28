<?php
	function accordionCCI($id_pce, $date_debut_periode, $date_fin_periode, $date_releve_debut, $valeur_index_brut_debut, $horodate_Index_brut_debut, $valeur_index_converti_debut, $horodate_Index_converti_debut, $date_releve_fin, $valeur_index_brut_fin, $horodate_Index_brut_fin, $valeur_index_converti_fin, $horodate_Index_converti_fin, $date_debut_consommation, $date_fin_consommation, $volume_brut, $coeff_pta, $valeur_pcs, $coeff_conversion, $volume_converti, $energie, $type_qualif_conso, $statut_conso, $journee_gaziere, $statut_restitution){
		$htmlCCI = "";

		// DÉBUT de la div dédiée à l'id_pce et la période
		$htmlCCI .= "<div class=\"boxresult\">";

		// ID PCE & Période
		$htmlCCI .= "<p>ID PCE : " . $id_pce . "</p>";
		$htmlCCI .= "<p>Date Début Période : " . $date_debut_periode . "</p>";
		$htmlCCI .= "<p>Date Fin Période : " . $date_fin_periode . "</p>";

		// FIN de la div dédiée à l'id_pce et à la période
		$htmlCCI .= "</div>";

		// DÉBUT de la div
		$htmlCCI .= "<div class=\"boxresult\">";

		// Relevé Début
		$htmlCCI .= "<p>Date Relevé Début : " . $date_releve_debut . "</p>";
		$htmlCCI .= "<p>Valeur Index Début : " . $valeur_index_brut_debut . "</p>";
		if ($horodate_Index_brut_debut != $date_releve_debut){
			$htmlCCI .= "<p>Horodate Index Début : " . $horodate_Index_brut_debut . "</p>";
		}
		if (isset($valeur_index_converti_debut)) {
			$htmlCCI .= "<p>Valeur Index Converti Début : " . $valeur_index_converti_debut . "</p>";
		}
		if (isset($horodate_Index_converti_debut)) {
			$htmlCCI .= "<p>Horodate Index Converti Début : " . $horodate_Index_converti_debut . "</p>";
		}

		// Releve Fin
		$htmlCCI .= "<p>Date Relevé Fin : " . $date_releve_fin . "</p>";
		$htmlCCI .= "<p>Valeur Index Fin : " . $valeur_index_brut_fin . "</p>";
		if ($horodate_Index_brut_fin != $date_releve_fin){
			$htmlCCI .= "<p>Horodate Index Début : " . $horodate_Index_brut_fin . "</p>";
		}
		if (isset($valeur_index_converti_fin)){
			$htmlCCI .= "<p>Valeur Index Converti Fin : " . $valeur_index_converti_fin . "</p>";
		}
		if (isset($horodate_Index_converti_fin)){
			$htmlCCI .= "<p>Horodate Index Converti Fin : " . $horodate_Index_converti_fin . "</p>";
		}

		// Consommation
		$htmlCCI .= "<p>Date Début Consommation : " . $date_debut_consommation . "</p>";
		$htmlCCI .= "<p>Date Fin Consommation : " . $date_fin_consommation . "</p>";
		$htmlCCI .= "<p>Volume Brut Consommation : " . $volume_brut . "</p>";
		if (isset($coeff_pta)){
			$htmlCCI .= "<p>Coefficient PTA Consommation : " . $coeff_pta . "</p>";
		}
		if (isset($valeur_pcs)){
			$htmlCCI .= "<p>Valeur PCS Consommation : " . $valeur_pcs . "</p>";
		}
		$htmlCCI .= "<p>Coefficient Conversion Consommation : " . $coeff_conversion . "</p>";
		if (isset($volume_converti)) {
			$htmlCCI .= "<p>Volume Converti Consommation : " . $volume_converti . "</p>";
		}
		$htmlCCI .= "<p>Energie Consommation : " . $energie . "</p>";
		$htmlCCI .= "<p>Type Qualification Consommation : " . $type_qualif_conso . "</p>";
		$htmlCCI .= "<p>Statut Consommation : " . $statut_conso . "</p>";
		$htmlCCI .= "<p>Journée Gazière Consommation : " . $journee_gaziere . "</p>";

		// Statut Restitution
		if (isset($statut_restitution)){
			$htmlCCI .= "<p>Journée Gazière Consommation : " . $statut_restitution . "</p>";
		}

		// FIN de la div
		$htmlCCI .= "</div>";
		return $htmlCCI;

	}

	function prettifyCCI($jarOutputCCI){
		$htmlFinalCCI = "";
		$tailleReponse = count($jarOutputCCI) - 1;
		for ($i=0; $i < $tailleReponse; $i++) {
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCCI[$i]))))['resultat'];

			// ID PCE et Période
			$id_pce = ((array) $jsonOutput['pce'])['id_pce'];
			$date_debut_periode = ((array) $jsonOutput['periode'])['date_debut'];
			$date_fin_periode = ((array) $jsonOutput['periode'])['date_fin'];

			// Releve_debut DÉBUT
			$date_releve_debut = ((array) $jsonOutput['releve_debut'])['date_releve'];
			$valeur_index_brut_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_brut_debut'])['valeur_index'];
			$horodate_Index_brut_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_brut_debut'])['horodate_Index'];
			$valeur_index_converti_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_converti_debut'])['valeur_index'];
			$horodate_Index_converti_debut = ((array) ((array) $jsonOutput['releve_debut'])['index_converti_debut'])['horodate_Index'];
			// Releve_debut TERMINÉ

			// Releve_fin DÉBUT
			$date_releve_fin = ((array) $jsonOutput['releve_fin'])['date_releve'];
			$valeur_index_brut_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_brut_fin'])['valeur_index'];
			$horodate_Index_brut_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_brut_fin'])['horodate_Index'];
			$valeur_index_converti_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_converti_fin'])['valeur_index'];
			$horodate_Index_converti_fin = ((array) ((array) $jsonOutput['releve_fin'])['index_converti_fin'])['horodate_Index'];
			// Releve_fin TERMINÉ

			// Consomation DÉBUT
			$date_debut_consommation = ((array) $jsonOutput['consommation'])['date_debut_consommation'];
			$date_fin_consommation = ((array) $jsonOutput['consommation'])['date_fin_consommation'];
			$volume_brut = ((array) $jsonOutput['consommation'])['volume_brut'];
			$coeff_pta = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['coeff_pta'];
			$valeur_pcs = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['valeur_pcs'];
			$coeff_conversion = ((array) ((array) $jsonOutput['consommation'])['coeff_calcul'])['coeff_conversion'];
			$volume_converti = ((array) $jsonOutput['consommation'])['volume_converti'];
			$energie = ((array) $jsonOutput['consommation'])['energie'];
			$type_qualif_conso = ((array) $jsonOutput['consommation'])['type_qualif_conso'];
			$statut_conso = ((array) $jsonOutput['consommation'])['statut_conso'];
			$journee_gaziere = ((array) $jsonOutput['consommation'])['journee_gaziere'];
			// Consommation TERMINÉ

			// Statut_restitution DÉBUT
			$statut_restitution = $jsonOutput['statut_restitution'];
			// Statut_restitution TERMINÉ


			$htmlFinalCCI .= accordionCCI($id_pce, $date_debut_periode, $date_fin_periode, $date_releve_debut, $valeur_index_brut_debut, $horodate_Index_brut_debut, $valeur_index_converti_debut, $horodate_Index_converti_debut, $date_releve_fin, $valeur_index_brut_fin, $horodate_Index_brut_fin, $valeur_index_converti_fin, $horodate_Index_converti_fin, $date_debut_consommation, $date_fin_consommation, $volume_brut, $coeff_pta, $valeur_pcs, $coeff_conversion, $volume_converti, $energie, $type_qualif_conso, $statut_conso, $journee_gaziere, $statut_restitution);
		}
		return $htmlFinalCCI;
	}
?>