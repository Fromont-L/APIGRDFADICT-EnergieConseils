<?php
	function accordionCDT($id_pce, $numero_rue, $nom_rue, $complement_adresse, $code_postal, $commune, $frequence, $client_sensible_mig, $identifiant_pitd, $libelle_pitd, $statut_restitution){
		$htmlCDT = "";

		// DÉBUT de la div
		$htmlCDT .= "<div class=\"boxresult\">";

		// ID PCE
		$htmlCDT .= "<p>ID PCE : " . $id_pce . "</p>";

		// Numéro_rue
		$htmlCDT .= "<p>Numéro Rue : " . $numero_rue . "</p>";

		// Nom_rue
		$htmlCDT .= "<p>Nom Rue : " . $nom_rue . "</p>";

		// Complement_adresse
		$htmlCDT .= "<p> Complément d'Adresse : " . $complement_adresse . "</p>";

		// Code_postal
		$htmlCDT .= "<p> Code Postal : " . $code_postal . "</p>";

		// Commune
		$htmlCDT .= "<p> Commune : " . $commune . "</p>";

		// Frequence
		$htmlCDT .= "<p> Fréquence : " . $frequence . "</p>";

		// Client_sensible_mig
		$htmlCDT .= "<p> Client Sensible MIG : " . $client_sensible_mig . "</p>";

		// Identifiant_pitd
		$htmlCDT .= "<p> Identifiant PITD : " . $identifiant_pitd . "</p>";

		// Libelle_pitd
		$htmlCDT .= "<p> Libellé PITD : " . $libelle_pitd . "</p>";

		// Statut Restitution
		if (isset($statut_restitution)){
			$htmlCDT .= "<p>Journée Gazière Consommation : " . $statut_restitution . "</p>";
		}

		// FIN de la div
		$htmlCDT .= "</div>";
		return $htmlCDT;

	}

	function prettifyCDT($jarOutputCDT){
		$htmlFinalCDT = "";
		$tailleReponse = count($jarOutputCDT) - 1;
		for ($i=0; $i < $tailleReponse; $i++) {
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCDT[$i]))))['resultat'];

			// ID PCE
			$id_pce = ((array) $jsonOutput['pce'])['id_pce'];

			// Numero_rue
			$numero_rue = ((array) ((array) $jsonOutput['donnees_techniques'])['situation_compteur'])['numero_rue'];

			// Nom_rue
			$nom_rue = ((array) ((array) $jsonOutput['donnees_techniques'])['situation_compteur'])['nom_rue'];

			// Complement_adresse
			$complement_adresse = ((array) ((array) $jsonOutput['donnees_techniques'])['situation_compteur'])['complement_adresse'];

			// Code_postal
			$code_postal = ((array) ((array) $jsonOutput['donnees_techniques'])['situation_compteur'])['code_postal'];

			// Commune
			$commune = ((array) ((array) $jsonOutput['donnees_techniques'])['situation_compteur'])['commune'];

			// Fréquence
			$frequence = ((array) ((array) $jsonOutput['donnees_techniques'])['caracteristiques_compteur'])['frequence'];

			// Client_sensible_mig
			$client_sensible_mig = ((array) ((array) $jsonOutput['donnees_techniques'])['caracteristiques_compteur'])['client_sensible_mig'];

			// Identifiant_pitd
			$identifiant_pitd = ((array) ((array) $jsonOutput['donnees_techniques'])['pitd'])['identifiant_pitd'];

			// Libelle_pitd
			$libelle_pitd = ((array) ((array) $jsonOutput['donnees_techniques'])['pitd'])['libelle_pitd'];

			// Statut_restitution
			$statut_restitution = $jsonOutput['statut_restitution'];

			$htmlFinalCDT .= accordionCDT($id_pce, $numero_rue, $nom_rue, $complement_adresse, $code_postal, $commune, $frequence, $client_sensible_mig, $identifiant_pitd, $libelle_pitd, $statut_restitution);
		}
		return $htmlFinalCDT;
	}
?>