<?php
	function accordionCDC($id_pce, $car, $cja, $profil_type_actuel, $tarif_acheminement, $date_mes, $statut_restitution){
		$htmlCDC = "";

		// DÉBUT de la div
		$htmlCDC .= "<div class=\"boxresult\">";

		// ID PCE
		$htmlCDC .= "<p>ID PCE : " . $id_pce . "</p>";

		// CAR
		$htmlCDC .= "<p>CAR : " . $car . "</p>";

		// CJA
		$htmlCDC .= "<p>CJA : " . $cja . "</p>";

		// Profil_type_actuel
		$htmlCDC .= "<p> Profil Type Actuel : " . $profil_type_actuel . "</p>";

		// Tarif_acheminement
		$htmlCDC .= "<p> Tarif Acheminement : " . $tarif_acheminement . "</p>";

		// Date_mes
		$htmlCDC .= "<p> Date MES : " . $date_mes . "</p>";

		// Statut Restitution
		if (isset($statut_restitution)){
			$htmlCDC .= "<p>Journée Gazière Consommation : " . $statut_restitution . "</p>";
		}

		// FIN de la div
		$htmlCDC .= "</div>";
		return $htmlCDC;

	}

	function prettifyCDC($jarOutputCDC){
		$htmlFinalCDC = "";
		$tailleReponse = count($jarOutputCDC);
		for ($i=0; $i < $tailleReponse; $i++) {
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCDC[$i]))))['resultat'];

			// ID PCE
			$id_pce = ((array) $jsonOutput['pce'])['id_pce'];

			// CAR
			$car = ((array) $jsonOutput['donnees_contractuelles'])['car'];

			// CJA
			$cja = ((array) $jsonOutput['donnees_contractuelles'])['cja'];

			// Profil_type_actuel
			$profil_type_actuel = ((array) ((array) $jsonOutput['donnees_contractuelles'])['profil'])['profil_type_actuel'];

			// Tarif_acheminement
			$tarif_acheminement = ((array) $jsonOutput['donnees_contractuelles'])['tarif_acheminement'];

			// Date_mes
			$date_mes = ((array) $jsonOutput['donnees_contractuelles'])['date_mes'];

			// Statut_restitution
			$statut_restitution = $jsonOutput['statut_restitution'];

			$htmlFinalCDC .= accordionCDC($id_pce, $car, $cja, $profil_type_actuel, $tarif_acheminement, $date_mes, $statut_restitution);
		}
		return $htmlFinalCDC;
	}
?>