<?php
// a simple request router
class Router {  
  var $uri;
  var $uri_parsed;
  var $script_name;

  function Router() {
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->uri_parsed =  array_slice(explode('/', $_SERVER['REQUEST_URI']), 1, -1);
    $script = explode('/',$_SERVER['SCRIPT_NAME']);
    $this->script_name = $script[sizeof($script)-1];
  }

  function routes($routes) {
    // check if request URI is found in routes    
    foreach ($routes as $route => $callback) {
      // add regex delimiter ({} because not valid in urls)
      $route = '{^'.$route.'\/?$}i';
      $matched = preg_match($route, $this->uri, $matches);
      if ($matched) {	
	$params = array_slice($matches, 1);
	// call callback with parameter unrolled
	call_user_func_array($callback, $params);
	break;
      } 
    }
    if (!$matched) {
      // setup proper response error code
      header("HTTP/1.1 404 Not Found");
      error404();
    }
  }
}
?>