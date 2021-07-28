<?php

	function accordionCDA($id_droit_acces, $id_pce, $role_tiers, $raison_sociale_du_tiers, $nom_titulaire, $raison_sociale_du_titulaire, $courriel_titulaire, $code_postal, $perim_donnees_techniques_et_contractuelles, $perim_historique_de_donnees, $perim_flux_de_donnees, $perim_donnees_informatives, $perim_donnees_publiees, $date_creation, $etat_droit_acces, $date_revocation, $source_revocation, $date_passage_a_obsolete, $source_passage_a_obsolete, $date_fin_autorisation, $date_passage_a_refuse, $source_passage_a_refuse, $parcours, $statut_controle_preuve, $date_limite_transmission_preuve){
		$htmlCDA = "";

		// DÉBUT de la div boxresult
		$htmlCDA .= "<div class=\"boxresult\">";

		$htmlCDA .= "<p>ID Droit d'Accès : " . $id_droit_acces . "</p>";
		$htmlCDA .= "<p>ID PCE : " . $id_pce . "</p>";
		$htmlCDA .= "<p>Rôle Tiers : " . $role_tiers . "</p>";
		$htmlCDA .= "<p>Raison Sociale du Tiers : " . $raison_sociale_du_tiers . "</p>";
		$htmlCDA .= "<p>Nom Titulaire : " . $nom_titulaire . "</p>";
		$htmlCDA .= "<p>Raison Sociale : " . $raison_sociale_du_titulaire . "</p>";
		$htmlCDA .= "<p>Courriel Titulaire : " . $courriel_titulaire . "</p>";
		$htmlCDA .= "<p>Code Postal : " . $code_postal . "</p>";
		$htmlCDA .= "<p>Périmètre Données Techniques/Contractuelles : " . $perim_donnees_techniques_et_contractuelles . "</p>";
		$htmlCDA .= "<p>Périmètre Historique de Données : " . $perim_historique_de_donnees . "</p>";
		$htmlCDA .= "<p>Périmètre Flux de Données : " . $perim_flux_de_donnees . "</p>";
		$htmlCDA .= "<p>Périmètre Données Informatives : " . $perim_donnees_informatives . "</p>";
		$htmlCDA .= "<p>Périmètre Données Publiées : " . $perim_donnees_publiees . "</p>";
		$htmlCDA .= "<p>Date Création : " . $date_creation . "</p>";
		$htmlCDA .= "<p>État Droit d'Accès : " . $etat_droit_acces . "</p>";
		$htmlCDA .= "<p>Date Révocation : " . $date_revocation . "</p>";
		$htmlCDA .= "<p>Source Révocation : " . $source_revocation . "</p>";
		$htmlCDA .= "<p>Date d'Accès Obsolète : " . $date_passage_a_obsolete . "</p>";
		$htmlCDA .= "<p>Source d'Accès Obsolète : " . $source_passage_a_obsolete . "</p>";
		$htmlCDA .= "<p>Date de Fin d'Autorisation : " . $date_fin_autorisation . "</p>";
		$htmlCDA .= "<p>Date du Passage Refusé : " . $date_passage_a_refuse . "</p>";
		$htmlCDA .= "<p>Source du Passage Refusé : " . $source_passage_a_refuse . "</p>";
		$htmlCDA .= "<p>Parcours : " . $parcours . "</p>";
		$htmlCDA .= "<p>Statut Controle Preuve : " . $statut_controle_preuve . "</p>";
		$htmlCDA .= "<p>Date Limite de Transmission Preuve : " . $date_limite_transmission_preuve . "</p>";

		// FIN de la div boxresult
		$htmlCDA .= "</div>";
		return $htmlCDA;
	}

	function prettifyCDA($jarOutputCDA){
		$htmlFinalCDA = "";
		// Mettre un -2 à la place du -1 pour que la fonction ne plante/déconne pas
		$tailleReponse = count($jarOutputCDA) -2;
		for ($i=0; $i < $tailleReponse ; $i++) { 
			$jsonOutput = (array) ((array)json_decode(json_fix(utf8_encode($jarOutputCDA[$i]))))['resultat'];

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

			$htmlFinalCDA .= accordionCDA($id_droit_acces, $id_pce, $role_tiers, $raison_sociale_du_tiers, $nom_titulaire, $raison_sociale_du_titulaire, $courriel_titulaire, $code_postal, $perim_donnees_techniques_et_contractuelles, $perim_historique_de_donnees, $perim_flux_de_donnees, $perim_donnees_informatives, $perim_donnees_publiees, $date_creation, $etat_droit_acces, $date_revocation, $source_revocation, $date_passage_a_obsolete, $source_passage_a_obsolete, $date_fin_autorisation, $date_passage_a_refuse, $source_passage_a_refuse, $parcours, $statut_controle_preuve, $date_limite_transmission_preuve);

		}
		return $htmlFinalCDA;
	}
?>