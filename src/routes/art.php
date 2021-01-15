<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Get Art
 */
// create GET HTTP request
$app->get('/api/art', function( Request $request, Response $response){
     $sql = "SELECT * FROM ART";
 
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
      // query
      $stmt = $db->query( $sql );
      $arts = $stmt->fetchAll( PDO::FETCH_OBJ );
      $db = null; // clear db object
  
      // print out the result as json format
      echo json_encode( $arts );    
        
    } catch( PDOException $e ) {
      // show error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
});

/**
 * Add new Art data
 */
// create POST HTTP request
$app->post('/api/art/add', function( Request $request, Response $response){

    // get the parameter from the form submit
    $title = $request->getParsedBody('title');
    $date = $request->getParsedBody('date');
    $technique = $request->getParsedBody('technique');
    $url = $request->getParsedBody('url');
    
    $sql = "INSERT INTO ART (TITLE, DATE, TECHNIQUE, URL) 
            VALUES(:title,:date,:technique,:url)";
            echo "hello";
  
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
     
      $stmt = $db->prepare( $sql );
  
      // bind each paramenter

      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':technique', $technique);
      $stmt->bindParam(':url', $url);
  
      // execute sql
      $stmt->execute();
      
      // return the message as json format
      echo '{"notice" : {"msg" : "New Art Added."}';
  
    } catch( PDOException $e ) {
  
      // return error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
});

/**
 * Update a Single Art data
 */
// create PUT HTTP request
$app->put('/api/art/update/{id}', function( Request $request, Response $response){
    // get attribute from URL
    $id = $request->getAttribute('id');
    
    // get the parameter from the form submit
    $title = $request->getParsedBody('title');
    $date = $request->getParsedBody('date');
    $technique = $request->getParsedBody('technique');
    $url = $request->getParsedBody('url');
    
    $sql = "UPDATE ART SET 
            title = :title,
            date = :date,
            technique = :technique,
            url = :url
            WHERE id = $id";
  
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  

      $stmt = $db->prepare( $sql );
  
      // bind each paramenter

      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':technique', $technique);
      $stmt->bindParam(':url', $url);
  
      // execute sql
      $stmt->execute();
      
      // return the message as json format
      echo '{"notice" : {"msg" : "New Art Updated."}';
  
    } catch( PDOException $e ) {
  
      // return error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
});

/**
 * Delete a Single Art data
 */
// create DELETE HTTP request
$app->delete('/api/art/delete/{id}', function( Request $request, Response $response){
    // get attribute from URL
    $id = $request->getAttribute('id');   
  
    $sql = "DELETE FROM ART WHERE id = $id";
  
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
      $stmt = $db->prepare($sql);  
  
      // execute sql
      $stmt->execute();
      $db = null;
      
      // return the message as json format
      echo '{"notice" : {"msg" : "New Art Deleted."}';
  
    } catch( PDOException $e ) {
  
      // return error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
  
});