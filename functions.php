<?php
  
  namespace KuntaAPI\RedirectTheme;
  
  if (!class_exists( 'KuntaAPI\RedirectTheme\Settings' ) ) {
    
    class Settings {
      
      private $settings;
      
      public function __construct() {
        $this->settings = [
          'kunta_api_redirect_page_path' => [
            'section'  => 'kunta_api_redirect_paths',
            'label' => __('Page path', 'kunta_api_redirect'),
            'default' => 'https://example.com/contents/%s'
          ],
          'kunta_api_redirect_root_path' => [
            'section'  => 'kunta_api_redirect_paths',
            'label' => __('Root path', 'kunta_api_redirect'),
            'default' => 'https://example.com/'
          ],
          'kunta_api_redirect_post_path' => [
            'section'  => 'kunta_api_redirect_paths',
            'label' => __('Post path', 'kunta_api_redirect'),
            'default' => 'https://example.com/news/%s'
          ],
          'kunta_api_redirect_announcement_path' => [
            'section'  => 'kunta_api_redirect_paths',
            'label' => __('Announcement path', 'kunta_api_redirect'),
            'default' => 'https://example.com/announcements/%s'
          ]
        ];
      }
      
      public function registerCustomSettings($wp_customize) {        
        foreach ($this->settings as $setting => $config) {
          $this->registerSetting($wp_customize, $config['section'], $setting, $config['label'], $config['default']);
        }
      }
      
      public function getRootPath() {
        return $this->getSettingValue('kunta_api_redirect_root_path');
      }
      
      public function getPathPath($requestPath) {
        return sprintf($this->getSettingValue('kunta_api_redirect_page_path'), $requestPath);
      }
      
      public function getPostPath($requestPath) {
        return sprintf($this->getSettingValue('kunta_api_redirect_post_path'), $requestPath);
      }
      
      public function getAnnouncementPath($requestPath) {
        return sprintf($this->getSettingValue('kunta_api_redirect_announcement_path'), $this->stripStart($requestPath, "announcement/"));
      }
      
      private function stripStart($string, $prefix) {
        $prefixLength = strlen($prefix);
        
        if (substr($string, 0,  $prefixLength) == $prefix) {
          return substr($string, $prefixLength);
        } 
        
        return $string;
      }
      
      private function getSettingValue($name) {
        $path = get_theme_mod($name);
        if (!empty($path)) {
          return $path;
        }
        
        return $this->settings[$name]['default'];
      }
      
      private function registerSetting($wp_customize, $section, $setting, $label, $default) {
        $wp_customize->add_setting($setting, array(
          'default'   => $default,
          'transport' => 'refresh',
        ));

        $wp_customize->add_control( new \WP_Customize_Control( $wp_customize, $setting, array(
          'label'    => $label,
          'section'  => $section,
          'settings' => $setting
        ))); 
      }
      
    }
  
    global $kuntaApiRedirectSettings;
    $kuntaApiRedirectSettings = new Settings();
    
  }

  add_action('customize_register', function ($wp_customize){
    global $kuntaApiRedirectSettings;
    
    $wp_customize->add_section( 'kunta_api_redirect_paths' , array(
      'title'    => __( 'Paths', 'kunta_api_redirect' ),
      'priority' => 999
    )); 
    
    $kuntaApiRedirectSettings->registerCustomSettings($wp_customize);
    
  });
  
  add_action('after_setup_theme', function () {
	add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
  });
  
?>
