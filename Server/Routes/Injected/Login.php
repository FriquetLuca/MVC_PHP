<?php
$router->get('/login', function() {
    (new LoginController)->index();
});