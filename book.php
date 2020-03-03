<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include bookProc.php file
include __DIR__ . '/../Controllers/bookProc.php';

//read table book
$app->get('/book', function (Request $request, Response $response, array $arg){
  return $this->response->withJson(array('data' => 'success'), 200);
});

//request table book by condition
$app->get('/book/[{genre}]', function ($request, $response, $args){
    
    $bookGenre = $args['genre'];
  $data = getBook($this->db, $bookGenre);

  if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 404);
 }
   return $this->response->withJson(array('data' => $data), 200);
});

$app->post('/book/add', function ($request, $response, $args) {
  $form_data = $request->getParsedBody();
  $data = createBook($this->db, $form_data);
  if ($data <= 0) {
    return $this->response->withJson(array('error' => 'Add data fail'), 500);
  }
  return $this->response->withJson(array('add data' => 'Success'), 201);
  }
);

//delete row
$app->delete('/book/del/[{genre}]', function ($request, $response, $args){
    
  $bookGenre = $args['genre'];
$data = deleteBook($this->db, $bookGenre);

if (empty($data)) {
 return $this->response->withJson(array($bookGenre=> 'Deleted !'), 202);};
});

//put table book
$app->put('/book/update/[{genre}]', function ($request,  $response,  $args){
  $bookGenre = $args['genre'];
  $date = date("Y-m-j h:i:s");
  
  $form_data=$request->getParsedBody();
  
$data=updateBook($this->db, $form_data, $bookGenre, $date);

return $this->response->withJson(array($bookGenre =>$data ), 200);
});
