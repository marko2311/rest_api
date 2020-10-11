<?php


namespace Api\Controller;

use Api\TableGateways\CartGateway;
use Api\Controller\GameController;

class CartController
{
    private $requestMethod;
    private $gameId;
    private $db;

    private $cartGateway;

    public function __construct($db, $requestMethod, $gameId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->gameId = $gameId;

        $this->cartGateway = new CartGateway($db);
        if (!session_id()) {
            session_start();
        }
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getItemsOfCart();
                break;
            case 'POST':
                $response = $this->createCart();
                break;
            case 'PUT':
                $response = $this->addItemToCart($this->gameId);
                break;
            case 'DELETE':
                $response = $this->removeItemFromCart($this->gameId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }


    private function createCart(){
        $result = $this->cartGateway->createCart();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
//        echo(json_encode($result['body']));
        return $response;
    }

    private function addItemToCart($id)
    {
        $gameController = new \Api\Controller\GameController($this->db, 'GET', $id);
        if($item = $gameController->processRequest(true)){
            $result = $this->cartGateway->addItemToCart($item);
        }
        else {
            exit("Cannot find a product to add");
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getItemsOfCart(){
        $result = $this->cartGateway->getItemsOfCart();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function removeItemFromCart($id){
        $result = $this->cartGateway->removeItemFromCart($id);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }


    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}