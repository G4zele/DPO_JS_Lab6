<?php
function getResumes($db)
{
    $query = $db->prepare("SELECT *, extract(year from age(birthday)) as age FROM candidate");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Candidate');
    $query->execute();
    $data = $query->fetchAll();

    if (count($data) > 0) 
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(404);

        $res=[
            "status" => false,
            "message" => "Резюме не найдены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function getCandidateById($db, $id)
{
    $query = $db->prepare("SELECT * FROM candidate WHERE id_candidate = :id");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Candidate');
    $query->execute([':id' => $id]);
    $data = $query->fetchAll();

    if (count($data) > 0) 
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(404);

        $res=[
            "status" => false,
            "message" => "Резюме не найдено"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function deleteEducationById($db, $id)
{
    $query = $db->prepare("DELETE FROM education WHERE id_educ = :id");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Education');
    $result = $query->execute([':id' => $id]);
    if ($result) 
    {
        http_response_code(200);
        $res=[
            "status" => true,
            "message" => "Образование удалено"
        ];

        echo json_encode($res);
    }
    else 
    {
        http_response_code(400);

        $res=[
            "status" => false,
            "message" => "Образование не удалось удалить"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function getEducationByIdCandidate($db, $id)
{
    $query = $db->prepare("SELECT * FROM education WHERE id_candidate = :id ORDER BY id_educ DESC");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Education');
    $query->execute([':id' => $id]);
    $data = $query->fetchAll();

    if (count($data) > 0) 
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(406);

        $res=[
            "status" => false,
            "message" => "Образования не найдены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
// добавить резюме
function addResume($db)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("INSERT INTO candidate (profession, city, photo, tel,
                            full_name, email, birthday, wage, skills, about, status)
                            VALUES (:profession,:city, :photo, :tel, :full_name, :email, :birthday, :wage,
                            :skills, :about, :status) RETURNING id_candidate");
    $params = [
        ':profession' =>  $data->candidate->profession->values,
        ':city' => $data->candidate->city->values,
        ':photo' => $data->candidate->photo->values,
        ':tel' => $data->candidate->tel->values,
        ':full_name' => $data->candidate->full_name->values,
        ':email' => $data->candidate->email->values,
        ':birthday' => $data->candidate->birthday->values,
        ':wage' => (float)$data->candidate->wage->values,
        ':skills' => $data->candidate->skills->values,
        ':about' => $data->candidate->about->values,
        ':status' => $data->candidate->status->values
    ];
    $query->execute($params);
    $id = $query->fetchAll(PDO::FETCH_COLUMN);
    $id_candidate = $id[0];

    if (isset($id_candidate)) 
    {
        foreach( $data->candidate->education as $education ) 
        {
            addEducation($db, $id_candidate, $education);
        }

        $res=[
            "status" => true,
            "id" => $id_candidate,
            "message" => "Резюме добавлено"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Резюме не добавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function addEducation($db, $id_candidate, $data)
{
    if ($data->degree->values !== "") 
    {
        $query = $db->prepare("INSERT INTO education (id_candidate, degree, education_university,
                            faculty, specialization, year_end)
                            VALUES (:id_candidate, :degree, :education_university, :faculty, :specialization, :year_end) 
                            RETURNING id_educ");
        if($data->year_end->values === '' || !isset($data->year_end->values))
            $data->year_end->values = null;
        if($data->education_university->values === '' || !isset($data->education_university->values))
            $data->education_university->values = null;
        if($data->faculty->values === '' || !isset($data->faculty->values))
            $data->faculty->values = null;
        if($data->specialization->values === '' || !isset($data->specialization->values))
            $data->specialization->values = null;
        $params = [
            ':id_candidate' => $id_candidate,
            ':degree' => $data->degree->values,
            ':education_university' => $data->education_university->values,
            ':faculty' => $data->faculty->values,
            ':specialization' => $data->specialization->values,
            ':year_end' => $data->year_end->values
            ];
        $result = $query->execute($params);
        $id = $query->fetchAll(PDO::FETCH_COLUMN);
        $id_educ = $id[0];

        if ($result) 
        {
            http_response_code(201);
            $res=[
                "status" => true,
                "message" => "Образование добавлено",
                "id_educ" => $id_educ
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else 
        {
            http_response_code(503);

            $res=[
                "status" => false,
                "message" => "Образование не добавлено",
                "data" => $data
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}
function editResume($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("UPDATE candidate SET profession = :profession, 
                            city = :city, photo = :photo, tel = :tel,
                            full_name = :full_name, email = :email, birthday = :birthday,
                             wage = :wage, skills = :skills, about = :about, status = :status
                            WHERE id_candidate = :id_candidate");
    $params = [
        ':profession' =>  $data->candidate->profession->values,
        ':city' => $data->candidate->city->values,
        ':photo' => $data->candidate->photo->values,
        ':tel' => $data->candidate->tel->values,
        ':full_name' => $data->candidate->full_name->values,
        ':email' => $data->candidate->email->values,
        ':birthday' => $data->candidate->birthday->values,
        ':wage' => (float)$data->candidate->wage->values,
        ':skills' => $data->candidate->skills->values,
        ':about' => $data->candidate->about->values,
        ':status' => $data->candidate->status->values,
        ':id_candidate' => $id
    ];
    $result = $query->execute($params);

    if ($result) 
    {
        foreach( $data->candidate->education as $education ) {
            editEducation($db, $education);
        }

        $res=[
            "status" => true,
            "id" => $id,
            "message" => "Данные по резюме обновлены"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(506);

        $res=[
            "status" => false,
            "message" => "Данные по резюме не обновлены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function editEducation($db, $data)
{
    $query = $db->prepare("UPDATE education SET degree = :degree, education_university = :education_university,
                            faculty = :faculty, specialization = :specialization, year_end = :year_end
                            WHERE id_educ = :id_educ");
    if($data->year_end->values === '' || !isset($data->year_end->values))
        $data->year_end->values = null;
    if($data->education_university->values === '' || !isset($data->education_university->values))
        $data->education_university->values = null;
    if($data->faculty->values === '' || !isset($data->faculty->values))
        $data->faculty->values = null;
    if($data->specialization->values === '' || !isset($data->specialization->values))
        $data->specialization->values = null;
    $params = [
        ':degree' =>  $data->degree->values,
        ':education_university' => $data->education_university->values,
        ':faculty' => $data->faculty->values,
        ':specialization' => $data->specialization->values,
        ':year_end' => $data->year_end->values,
        ':id_educ' => $data->id->values
    ];
    $result = $query->execute($params);

    if ($result) 
    {
        http_response_code(201);
        $res=[
            "status" => true,
            "message" => "Образование обнавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Образование не обнавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function updateStatus($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("UPDATE candidate SET status = :status
                            WHERE id_candidate = :id_candidate");
    $params = [
        ':status' => $data->status,
        ':id_candidate' => $id
    ];
    $result = $query->execute($params);

    if ($result) 
    {

        $res=[
            "status" => true,
            "message" => "Данные по резюме обновлены"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else 
    {
        http_response_code(506);

        $res=[
            "status" => false,
            "message" => "Данные по резюме не обновлены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
