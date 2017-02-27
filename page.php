<?php
/**
 * The template for redirecting user to a corresponding page in the actual web page
 * 
 * @package kunta-api-redirect-theme
 * @since 1.0
 * @version 1.0
 */

global $kuntaApiRedirectSettings;
wp_redirect($kuntaApiRedirectSettings->getPathPath($wp->request));

?>