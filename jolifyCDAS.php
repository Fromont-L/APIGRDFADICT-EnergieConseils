<?php

	function accordionCDAS($id_droit_acces, $id_pce, $role_tiers, $raison_sociale_du_tiers, $nom_titulaire, $raison_sociale_du_titulaire, $courriel_titulaire, $code_postal, $perim_donnees_techniques_et_contractuelles, $perim_historique_de_donnees, $perim_flux_de_donnees, $perim_donnees_informatives, $perim_donnees_publiees, $date_creation, $etat_droit_acces, $date_revocation, $source_revocation, $date_passage_a_obsolete, $source_passage_a_obsolete, $date_fin_autorisation, $date_passage_a_refuse, $source_passage_a_refuse, $parcours, $statut_controle_preuve, $date_limite_transmission_preuve){
		$htmlCDAS = "";

		// DÉBUT de la div boxresult
		$htmlCDAS .= "<div class=\"boxresult\">";

		$htmlCDAS .= "<p>ID Droit d'Accès : " . $id_droit_acces . "</p>";
		$htmlCDAS .= "<p>ID PCE : " . $id_pce . "</p>";
		$htmlCDAS .= "<p>Rôle Tiers : " . $role_tiers . "</p>";
		$htmlCDAS .= "<p>Raison Sociale du Tiers : " . $raison_sociale_du_tiers . "</p>";
		$htmlCDAS .= "<p>Nom Titulaire : " . $nom_titulaire . "</p>";
		$htmlCDAS .= "<p>Raison Sociale : " . $raison_sociale_du_titulaire . "</p>";
		$htmlCDAS .= "<p>Courriel Titulaire : " . $courriel_titulaire . "</p>";
		$htmlCDAS .= "<p>Code Postal : " . $code_postal . "</p>";
		$htmlCDAS .= "<p>Périmètre Données Techniques/Contractuelles : " . $perim_donnees_techniques_et_contractuelles . "</p>";
		$htmlCDAS .= "<p>Périmètre Historique de Données : " . $perim_historique_de_donnees . "</p>";
		$htmlCDAS .= "<p>Périmètre Flux de Données : " . $perim_flux_de_donnees . "</p>";
		$htmlCDAS .= "<p>Périmètre Données Informatives : " . $perim_donnees_informatives . "</p>";
		$htmlCDAS .= "<p>Périmètre Données Publiées : " . $perim_donnees_publiees . "</p>";
		$htmlCDAS .= "<p>Date Création : " . $date_creation . "</p>";
		$htmlCDAS .= "<p>État Droit d'Accès : " . $etat_droit_acces . "</p>";
		$htmlCDAS .= "<p>Date Révocation : " . $date_revocation . "</p>";
		$htmlCDAS .= "<p>Source Révocation : " . $source_revocation . "</p>";
		$htmlCDAS .= "<p>Date d'Accès Obsolète : " . $date_passage_a_obsolete . "</p>";
		$htmlCDAS .= "<p>Source d'Accès Obsolète : " . $source_passage_a_obsolete . "</p>";
		$htmlCDAS .= "<p>Date de Fin d'Autorisation : " . $date_fin_autorisation . "</p>";
		$htmlCDAS .= "<p>Date du Passage Refusé : " . $date_passage_a_refuse . "</p>";
		$htmlCDAS .= "<p>Source du Passage Refusé : " . $source_passage_a_refuse . "</p>";
		$htmlCDAS .= "<p>Parcours : " . $parcours . "</p>";
		$htmlCDAS .= "<p>Statut Controle Preuve : " . $statut_controle_preuve . "</p>";
		$htmlCDAS .= "<p>Date Limite de Transmission Preuve : " . $date_limite_transmission_preuve . "</p>";

		// FIN de la div boxresult
		$htmlCDAS .= "</div>";
		return $htmlCDAS;
	}

	function prettifyCDAS($jarOutputCDAS){
		$htmlFinalCDAS = "";
		// Mettre un -2 à la place du -1 pour que la fonction ne plante/déconne pas
		$tailleReponse = count($jarOutputCDAS) -2;
		for ($i=0; $i < $tailleReponse ; $i++) { 
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCDAS[$i]))))['resultat'];

			// Résultats
			$id_droit_acces = $jsonOutput['id_droit_acces'];
			$id_pce = $jsonOutput['id_pce'];
			$role_tiers = $jsonOutput['role_tiers'];
			$raison_sociale_du_tiers = $jsonOutput['raison_sociale_du_tiers'];
			$nom_titulaire = $jsonOutput['nom_titulaire'];
			$raison_sociale_du_titulaire = $jsonOutput['raison_sociale_du_titulaire'];
			$courriel_titulaire = $jsonOutput['courriel_titulaire'];
			$code_postal = $jsonOutput['code_postal'];
			$perim_donnees_techniques_et_contractuelles = $jsonOutput['perim_donnees_techniques_et_contractuelles'];
			$perim_historique_de_donnees = $jsonOutput['perim_historique_de_donnees'];
			$perim_flux_de_donnees = $jsonOutput['perim_flux_de_donnees'];
			$perim_donnees_informatives = $jsonOutput['perim_donnees_informatives'];
			$perim_donnees_publiees = $jsonOutput['perim_donnees_publiees'];
			$date_creation = $jsonOutput['date_creation'];
			$etat_droit_acces = $jsonOutput['etat_droit_acces'];
			$date_revocation = $jsonOutput['date_revocation'];
			$source_revocation = $jsonOutput['source_revocation'];
			$date_passage_a_obsolete = $jsonOutput['date_passage_a_obsolete'];
			$source_passage_a_obsolete = $jsonOutput['source_passage_a_obsolete'];
			$date_fin_autorisation = $jsonOutput['date_fin_autorisation'];
			$date_passage_a_refuse = $jsonOutput['date_passage_a_refuse'];
			$source_passage_a_refuse = $jsonOutput['source_passage_a_refuse'];
			$parcours = $jsonOutput['parcours'];
			$statut_controle_preuve = $jsonOutput['statut_controle_preuve'];
			$date_limite_transmission_preuve = $jsonOutput['date_limite_transmission_preuve'];

			$htmlFinalCDAS .= accordionCDAS($id_droit_acces, $id_pce, $role_tiers, $raison_sociale_du_tiers, $nom_titulaire, $raison_sociale_du_titulaire, $courriel_titulaire, $code_postal, $perim_donnees_techniques_et_contractuelles, $perim_historique_de_donnees, $perim_flux_de_donnees, $perim_donnees_informatives, $perim_donnees_publiees, $date_creation, $etat_droit_acces, $date_revocation, $source_revocation, $date_passage_a_obsolete, $source_passage_a_obsolete, $date_fin_autorisation, $date_passage_a_refuse, $source_passage_a_refuse, $parcours, $statut_controle_preuve, $date_limite_transmission_preuve);

		}
		return $htmlFinalCDAS;
	}
?>