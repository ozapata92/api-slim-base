<?php
// Application middleware

use \Firebase\JWT\JWT;

$mw = function ($request, $response, $next) {
    $secret = $this->get('settings')['secret'];
    $authHeader = $request->getHeader('Authorization');
    $reqPath = $request->getUri()->getPath();

    if($reqPath == '/login'){
        $response = $next($request, $response);
        return $response;
    } else {
        // validar jwt
        if(isset($authHeader) && sizeof($authHeader)==1){
            try {
                $authHeaderDecoded = JWT::decode($authHeader[0], $secret,array('HS256'));
                $response = $next($request, $response);
            }  catch(Firebase\JWT\SignatureInvalidException $e){
                // Suplantacion
                $response->getBody()->write('Intento de suplantación detectado. Su IP ha sido guardada.');
            } catch(UnexpectedValueException $e){
                // 401 Unauthorized - Expired
                $response->getBody()->write('401 Unauthorized - Token expirado' . $authHeader[0]);
            } catch (Exception $e){
                // 401 Unauthorized
                $response->getBody()->write('401 Unauthorized ' . $authHeader[0]);
            }
        } else {
            $response->getBody()->write('Token not found');
            $this->logger->info("Access without Token -> " . var_dump($authHeader));
        }
        return $response;
    }

};