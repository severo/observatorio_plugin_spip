<?php
/**
 * Plugin observatorio
 * © 2014 severo (severo@rednegra.net)
 * Licencia LPG Bolivia (http://www.softwarelibre.gob.bo/licencia.php)
 *
 * Crédito: kent1 (http://zone.spip.org/trac/spip-zone/browser/_squelettes_/mediaspip/mediaspip_init/)
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/config');

/**
 * Configurar la identidad del sitio - ecrire/?exec=configurer_identite
 */
function configurar_identidad(){
	ecrire_meta('slogan_site', _T('observatorio:identidad_titulo_sitio'));
	ecrire_meta('nom_site', _T('observatorio:identidad_eslogan_sitio'));
	ecrire_meta('descriptif_site', _T('observatorio:identidad_descripcion_sitio'));
}

/**
 * Configurar el idioma del sitio - ecrire/?exec=configurer_langue
 */
function configurar_idioma(){
	ecrire_meta('langue_site', 'es');
	ecrire_meta('charset', 'utf-8');
}

/**
 * Configurar el multilinguismo del sitio - ecrire/?exec=configurer_multilinguisme
 */
function configurar_multilinguismo(){
	ecrire_meta('langues_multilingue', '');
	ecrire_meta('langues_utilisees', 'es');
}

/**
 * Configurar el contenido del sitio - ecrire/?exec=configurer_contenu
 */
function configurar_contenido(){
	/* articulos */
	ecrire_meta("articles_surtitre", "oui");
	ecrire_meta("articles_soustitre", "oui");
	ecrire_meta("articles_descriptif", "oui");
	ecrire_meta("articles_chapeau", "oui");
	ecrire_meta("articles_ps", "non");
	ecrire_meta("articles_urlref", "oui");
	ecrire_meta("articles_redac", "oui");
	ecrire_meta("post_dates", "non");
	ecrire_meta("articles_redirection", "oui");
	/* rubriques */
	ecrire_meta("rubriques_descriptif", "oui");
	ecrire_meta("rubriques_texte", "oui");
	/* logos */
	ecrire_meta("activer_logos", "oui");
	ecrire_meta("activer_logos_survol", "non");
	/* rss */
	ecrire_meta("syndication_integrale", "oui");
	/* palabras clave */
	ecrire_meta("articles_mots", "oui");
	ecrire_meta("config_precise_groupes", "oui");
	ecrire_meta("mots_cles_forums", "non");
	/* sitios sindicados */
	ecrire_meta("activer_sites", "non");
	/* breves */
	ecrire_meta("activer_breves", "non");
	/* documentos */
	ecrire_meta("documents_objets", "spip_articles,spip_rubriques");
	ecrire_meta("documents_date", "oui");
}

/**
 * Configurar la interactividad del sitio - ecrire/?exec=configurer_interactions
 */
function configurar_interactividad(){
	ecrire_meta('accepter_inscriptions', 'non');
	ecrire_meta('accepter_visiteurs', 'non');
	ecrire_meta('messagerie_agenda', 'non');
	ecrire_meta('suivi_edito', 'non');
	ecrire_meta('quoi_de_neuf', 'non');
	ecrire_meta('email_envoi', '');
}

/**
 * Configurar las funciones avanzadas - ecrire/?exec=configurer_avancees
 */
function configurar_funciones_avanzadas(){
	/* Configurar el uso de GD2 */
	$image_process_install = charger_fonction('image_process_install','inc');
	$image_process_install();
	ecrire_meta('articles_modif', 'oui');
	ecrire_meta('preview', '0minirezo,1comite');
	ecrire_meta('version_html_max', 'html5');
	ecrire_meta('iecompat', 'IE8squish');
	ecrire_meta('barre_outils_public', 'oui');
	ecrire_meta('activer_statistiques', 'oui');
	ecrire_meta('activer_captures_referers', 'oui');
	ecrire_meta('auto_compress_http', 'oui');
	ecrire_meta('auto_compress_js', 'oui');
	ecrire_meta('auto_compress_css', 'oui');
}

/**
 * Configurar los foros del sitio - ecrire/?exec=configurer_forum
 */
function configurar_foros(){
	ecrire_meta('forums_publics', 'non');
	ecrire_meta('forums_titre', 'oui');
	ecrire_meta('forums_texte', 'oui');
	ecrire_meta('forums_afficher_barre', 'oui');
	ecrire_meta('forums_urlref', 'oui');
	ecrire_meta('formats_documents_forum', '');
	ecrire_meta('forum_prive_objets', 'oui');
	ecrire_meta('forum_prive', 'non');
	ecrire_meta('forum_prive_admin', 'non');
	ecrire_meta('prevenir_auteurs', ',pos,');
}

/**
 * Configurar las revisiones de objetos - ecrire/?exec=configurer_revisions
 */
function configurar_revisiones(){
	$objetos = array();
	$objetos[] = 'spip_articles';
	$objetos[] = 'spip_auteurs';
	$objetos[] = 'spip_rubriques';
	$objetos[] = 'spip_mots';
	$objetos[] = 'spip_groupes_mots';
	$objetos[] = 'spip_syndic';
	$objetos[] = 'spip_breves';
	$objetos[] = 'spip_documents';
	$objetos[] = 'spip_evenements';
	ecrire_meta('objets_versions',serialize($objetos));
}

/**
 * Configurar las URLs del sitio - ecrire/?exec=configurer_urls
 */
function configurar_urls(){
	ecrire_meta('type_urls','propres');
	ecrire_meta('urls_activer_controle','oui');
}

/**
 * Configurar los lapices
 */
function configurar_lapices(){
	$config_crayons = array();
	$config_crayons['barretypo'] = 'on';
	$config_crayons['filet'] = 'on';
	$config_crayons['yellow_fade'] = 'on';
	$config_crayons['clickhide'] = 'on';
	$config_crayons['reduire_logo'] = '0';
	$config_crayons['exec_autorise'] = '';
	ecrire_meta('crayons',serialize($config_crayons));
}

/**
 * Configurar el plugin social tags
 */
function configurar_socialtags(){
	$tags = array();
	$tags[] = 'facebook';
	$tags[] = 'twitter';
	$config = array();
	$config['tags'] = $tags;
	$config['jsselector'] = '#content';
	$config['wopen'] = 'non';
	$config['badge'] = '';
	$config['badgejs'] = '';
	ecrire_meta('socialtags',serialize($config));
}

/**
 * Configurar el plugin agenda
 */
function configurar_agenda(){
	$config = array();
	$config['titre'] = 'En la agenda';
	$config['descriptif'] = '';
	$config['url_evenement'] = 'evenement';
	$config['insert_head_css'] = '1';
	$config['affichage_debut'] = 'date_jour';
	$config['affichage_duree'] = '1';
	ecrire_meta('agenda',serialize($config));
}

/**
 * Configurar el plugin minicalendario
 */
function configurar_minicalendario(){

	$config = array();
	$config['format_jour'] = 'initiale';
	$config['affichage_hors_mois'] = '1';
	$config['changement_rapide'] = '1';
	$config['jour1'] = '1';
	ecrire_meta('calendriermini',serialize($config));
}
?>
