<?php
$router->get('/', function() {
    (new HomeController)->index();
});