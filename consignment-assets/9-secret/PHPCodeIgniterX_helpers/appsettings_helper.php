<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function clear_cache__config(){
  $ci =& get_instance();

  $db_config = $ci->load->database('daemon__config', TRUE);
  $db_config->cache_delete_all();
}

function clear_cache__language(){
  $ci =& get_instance();

  $db_language = $ci->load->database('daemon__language', TRUE);
  $db_language->cache_delete_all();
}

function clear_cache__routes(){
  $ci =& get_instance();

  //ROUTES
  $ci_api_routes[] = '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');'; //API - LOCAL
  $ci_user_routes[] = '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');'; //INTERFACE - LOCAL
  $ci_admin_routes[] = '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');'; //INTERFACE - LOCAL
  $js_user_routes[] = ''; //API - PUBLIC && INTERFACE - PUBLIC
  $js_admin_routes[] = ''; //API - PUBLIC && INTERFACE - PUBLIC

  //ROUTES USER
  $routes = $ci->ConfigModel->getAllRoutes('all');
  $data = array();
  if(!empty($routes)){
      foreach($routes as $route){
          if($route->type=='api' && $route->expose_local==1){
            $ci_api_routes[] = '$route[\'' . $route->endpoint . '\'] = \'' . $route->ci_path . '/' . $route->ci_path_function . '\';';
          }else if($route->visibility=='user' && $route->type=='interface' && $route->expose_local==1){
            $ci_user_routes[] = '$route[\'' . $route->endpoint . '\'] = \'' . $route->ci_path . '/' . $route->ci_path_function . '\';';
          }else if($route->visibility=='admin' && $route->type=='interface' && $route->expose_local==1){
            $ci_admin_routes[] = '$route[\'' . $route->endpoint . '\'] = \'' . $route->ci_path . '/' . $route->ci_path_function . '\';';
          }

          if($route->visibility=='all' && $route->expose_public==1){
            $ci_api_routes[] = '$route[\'' . $route->endpoint . '\'] = \'' . $route->ci_path . '/' . $route->ci_path_function . '\';';
            $js_admin_routes[] = 'const '.$route->key_base.'___'.str_replace('/','__',$route->key_endpoint).'= {endpoint:\''.$route->link_public.'/'.$route->endpoint. '\',method:\''.$route->allowed_method. '\'};';
            $js_user_routes[] = 'const '.$route->key_base.'___'.str_replace('/','__',$route->key_endpoint).'= {endpoint:\''.$route->link_public.'/'.$route->endpoint. '\',method:\''.$route->allowed_method. '\'};';
          }

          if($route->visibility=='user' && $route->expose_public==1){
            $js_user_routes[] = 'const '.$route->key_base.'___'.str_replace('/','__',$route->key_endpoint).'= {endpoint:\''.$route->link_public.'/'.$route->endpoint. '\',method:\''.$route->allowed_method. '\'};';
          }

          if($route->visibility=='admin' && $route->expose_public==1){
            $js_admin_routes[] = 'const '.$route->key_base.'___'.str_replace('/','__',$route->key_endpoint).'= {endpoint:\''.$route->link_public.'/'.$route->endpoint. '\',method:\''.$route->allowed_method. '\'};';
          }

      }

  }

  write_file('/var/www/html/consignment-api/application/cache/routes.php', implode("\n", $ci_api_routes));
  write_file('/var/www/html/consignment-monolith/application/cache/routes.php', implode("\n", $ci_user_routes));
  write_file('/var/www/html/consignment-admin/application/cache/routes.php', implode("\n", $ci_admin_routes));
  write_file('/var/www/html/consignment-assets/0-public/javascript/_inner/_mandatory/endpoint.js', implode("\n", $js_user_routes));
  write_file('/var/www/html/consignment-assets/0-public/javascript/_inner/_mandatory/endpoint_admin.js', implode("\n", $js_admin_routes));
}

?>
