<?php

use Slim\Http\Request;
use Slim\Http\Response;
/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/

// Routes
use \Firebase\JWT\JWT;

$app->get('/api/test', function() {
    $jsonDummy = json_encode($this->get('settings')['json_dummy']);
    header('Content-Type: application/json; charset=utf-8');
    echo $this->get('settings')['json_dummy'];
});

$app->post('/login', function(Request $request, Response $response, array $args) {
    $username = isset($request->getParsedBody()['username']) ? ($request->getParsedBody()['username']) : '';
    $password = isset($request->getParsedBody()['password']) ? ($request->getParsedBody()['password']) : '';
    $secret = $this->get('settings')['secret'];

    // Check credentials, if all OK, JWT will by created
    if($username=='oscar'){
        $expiredTime = 6000;
        $time = round(microtime(true)) + $expiredTime;
        $token = array(
            "username" => $username,
            "exp" => $time
        );

        $jwt = JWT::encode($token, $secret);
        
        print json_encode(array(
            'msg' => 'Login correcto',
            'token' => $jwt
        ));
    } else {
        print json_encode(array(
            'msg' => 'Credenciales incorrectas',
            'token' => ''
        ));
    }

});

function cUrlGetData($url, $post_fields = null, $headers = null) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post_fields && !empty($post_fields)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
    if ($headers && !empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $data;
}