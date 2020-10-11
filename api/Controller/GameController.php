<?php
namespace Api\Controller;

use Api\TableGateways\GameGateway;

class GameController {

    private $db;
    private $requestMethod;
    private $gameId;

    private $gameGateway;

    public function __construct($db, $requestMethod, $gameId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->gameId = $gameId;

        $this->gameGateway = new GameGateway($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->gameId) {
                    $response = $this->getGame($this->gameId);
                } else {
                    $response = $this->getAllGames();
                };
                break;
            case 'POST':
                $response = $this->createGameFromRequest();
                break;
            case 'PUT':
                $response = $this->updateGameFromRequest($this->gameId);
                break;
            case 'DELETE':
                $response = $this->deleteGame($this->gameId);
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

    private function getAllGames()
    {
        $result = $this->gameGateway->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $to_response = array();
        $page_number = 1;
        foreach($result as $game){
            isset($to_response[$page_number]) ? null : $to_response[$page_number] = array();
            array_push($to_response[$page_number], $game);
            if(count($to_response[$page_number]) == 3)
                $page_number++;
        }

        $response['body'] = json_encode($to_response);
        return $response;
    }

    private function getGame($id)
    {
        $result = $this->gameGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createGameFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateGame($input)) {
            return $this->unprocessableEntityResponse();
        }
        $result = $this->gameGateway->insert($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = $result;
        return $response;
    }

    private function updateGameFromRequest($id)
    {
        $result = $this->gameGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateGame($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->gameGateway->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function deleteGame($id)
    {
        $result = $this->gameGateway->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->gameGateway->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function validateGame(array $input)
    {
        if (!isset($input['name']) && !isset($input['price'])) {
            return false;
        }

        return $input;
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