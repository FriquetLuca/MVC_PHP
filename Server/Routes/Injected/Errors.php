<?php
// Error handling 404
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    (new ErrorController)->index(404);
});