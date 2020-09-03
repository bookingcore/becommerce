<?php
$app = new \Core\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
\Core\Foundation\Application::setAppInst($app);

return $app;
