<?php
// # use Namespaces for HTTP request
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// # include the Slim framework
require '../vendor/autoload.php';

// # include DB connection file
require '../src/config/db.php';

// # create new Slim instance
$app = new \Slim\App;

function getData ($countsql, $datasql, $page, $limit, $input){
    try{
        $offset = ($page-1) * $limit; //calculate what data you want

        $db = new db();
        $db = $db->connect();
        $countQuery = $db->prepare( $countsql );
        $dataQuery = $db->prepare( $datasql );
        $dataQuery->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $dataQuery->bindParam(':offset', $offset, \PDO::PARAM_INT);

        while(sizeof($input)){
            $curr = array_pop($input);
            $dataQuery->bindParam($curr["key"], $curr["keyvalue"]);
            $countQuery->bindParam($curr["key"], $curr["keyvalue"]);
        }

        $dataQuery->execute();
        $countQuery->execute();
        $db = null; // clear db object
        $count = $countQuery->fetch(PDO::FETCH_ASSOC); 
        $num = $count['COUNT'];
        if($num>0){
            $data_arr=array();
            $data_arr["records"]=array();
            $data_arr["pagination"]=array();

            $countData=array(
                "count" => $num,
                "page" => $page,
                "limit" => $limit,
                "totalpages" => ceil($num/$limit)
            );

            $data_arr["records"] = $dataQuery->fetchAll(PDO::FETCH_ASSOC);
            $data_arr["pagination"] = $countData;
            http_response_code(200);
            return json_encode($data_arr);
        }
        else{
            http_response_code(404);
            return json_encode(
                array("message" => "Nothing found.")
            );
        }
    }catch( PDOException $e ) {
        return '{"error": {"msg": ' . $e->getMessage() . '}';
    } 
}

// # include Arts route
require '../src/routes/art.php';


$app->run();