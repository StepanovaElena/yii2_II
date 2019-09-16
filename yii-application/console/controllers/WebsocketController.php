<?php


namespace console\controllers;


use backend\components\chat\ChatWedSocket;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

class WebsocketController extends Controller
{
    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatWedSocket()
                )
            ),
            8123
        );
        echo 'Websocket server is started!' . PHP_EOL;
        $server->run();
    }
}