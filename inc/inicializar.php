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
?>
