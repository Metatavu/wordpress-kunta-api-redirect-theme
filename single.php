<?php
/**
 * Catch all template for redirecting user from undefined post type to root path
 * in the actual web page
 * 
 * @package kunta-api-redirect-theme
 * @since 1.0
 * @version 1.0
 */

global $kuntaApiRedirectSettings;
wp_redirect($kuntaApiRedirectSettings->getRootPath());
exit;

?>