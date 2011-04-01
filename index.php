<?php
require_once('Router.class.php');

// demo callback with parameters
function hello_world(){
  // get parameters
  $params = func_get_args();

  echo "hello world!<br>";
  foreach ($params as $value) {
    echo "Parameter: " . $value . ", ";
  }
}

// demo callback, final match
function index() {
  echo "index called";
}

// error page
function error404() {
  echo "Error 404 page not found";
}

$router = new Router();
// define routes here, uses PCRE regex syntax
// no delimiters or start/end markers needed, first match is called.
// DO NOT use a trailing slash!
$router->routes(array(
		      '/routing/ulm/(\d+)' => 'hello_world',
		      '/routing/ulm' => 'hello_world',
		      '/routing' => 'index'
		      ));
?>
