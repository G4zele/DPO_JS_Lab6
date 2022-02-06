<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// Class connect to BD
require 'lib/connect.php';
// Mains classes
require 'lib/objects/Candidate.php';
require 'lib/objects/Education.php';
// Methods
require 'lib/resume/resume.php';

$database = new Connect();
$db = $database->Connection();

$method = $_SERVER['REQUEST_METHOD'];

$request = $_GET['request'];
$params = explode('/', $request);

if ($params[0] === 'add')
    $action = $params[0];
else if (
    $params[1] === 'edit' ||
    $params[1] === 'get-candidate' ||
    $params[1] === 'get-education' ||
    $params[1] === 'delete-education' ||
    $params[1] === 'add-education'||
    $params[1] === 'update-status')
    $id = $params[0];

if($method === 'GET') 
{
    if (!isset($id)) 
    {
        getResumes($db);
    } 
    else if ($params[1] === 'get-candidate') 
    {
        getCandidateById($db, $id);
    }
    else if($params[1] === 'get-education') 
    {
        getEducationByIdCandidate($db, $id);
    } 
    else if($params[1] === 'delete-education') 
    {
        deleteEducationById($db, $id);
    }
} 
else if ($method === 'POST') 
{
    if (!isset($action))
        $action = $params[1];

    if ($action === 'add') 
    {
        addResume($db);
    } else if ($action === 'edit') 
    {
        editResume($db, $id);
    } 
    else if ($action === 'add-education') 
    {
        $data = json_decode(file_get_contents("php://input"));
        addEducation($db, $id, $data->education);
    } 
    else if ($action === 'update-status') 
    {
        updateStatus($db, $id);
    }
}
