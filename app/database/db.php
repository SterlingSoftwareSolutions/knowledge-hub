<?php
session_start();
require('connect.php');

function dd($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}



function executeQuery($sql, $data)
{
        global $conn;
        $stmt= $conn->prepare($sql);
        
        $values = array_values($data); 
       
        $types = str_repeat('s', count($values)); 
       
        $stmt->bind_param($types, ...$values); 
       
        $stmt -> execute();
        return $stmt;
}


function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "Select * From $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        // //return records that match the conditions 
        // $sql = "SELECT * FROM $table WHERE username='Awa'AND admin=1";  

        $index = 0;        //             => 1   
        foreach ($conditions as $key => $value) {
            if ($index === 0) {
                $sql = $sql . " WHERE $key=?";    
            }  
            else {
                $sql = $sql . " AND $key=?";
            }
            $index++;
        }

        $stmt = executeQuery($sql, $conditions);  
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);  // getting results and returning
        return $records; 
    }
}   

function selectOne($table, $conditions)
{
    global $conn;
    $sql = "Select * From $table";


        $index = 0;        //             => 1   
        foreach ($conditions as $key => $value) {
            if ($index === 0) {
                $sql = $sql . " WHERE $key=?";    
            }  
            else {
                $sql = $sql . " AND $key=?";
            }
            $index++;
        }


    // $sql = "SELECT * FROM WHERE admin=0 AND username='Awa'"
 


        
        $sql = $sql . " LIMIT 1";
        $stmt = executeQuery($sql, $conditions);  
        $records = $stmt->get_result()->fetch_assoc();  // getting results and returning
        return $records; 
    }


    function create($table, $data)
    {
       
        global $conn;
        $sql = "INSERT INTO $table SET";
        $index=0;
        foreach ($data as $key => $value) {
            if ($index === 0) {
                $sql = $sql . " $key=?";
            } else {
                $sql = $sql . ", $key=?";
            }
            $index++;
        }
       
        $stmt = executeQuery($sql, $data);
        
        $id = $stmt->insert_id;
        
        return $id;
    }




function update ($table,$id,$data)

{
    global $conn;
    // $sql ="UPDATE  users SET username=?, admin=?, emaail=?, password=? WHERE id=?"
    $sql= "UPDATE $table SET ";
    // updating the table name and setting above column values

    $index = 0;         
    foreach ($data as $key => $value) {
        if ($index === 0) {
            $sql = $sql . "  $key=?";    
        }  
        else {
            $sql = $sql . ",  $key=?";
        }
        $index++;
    }  
    
$sql = $sql . " WHERE id=? ";   
$data['id'] =$id;
$stmt = executeQuery($sql, $data);  
return $stmt->affected_rows;

//the values which are going into queries is equal to  number of placeholders "?" 
//in this case there 5 data's and 5 query lines above


// $data =[

// ];
}






function delete ($table, $id )

{
    global $conn;
  $sql ="DELETE FROM $table WHERE id=?";
   
$stmt = executeQuery($sql,['id' => $id]);  
return $stmt->affected_rows;

}

function getPublishedPosts(){
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";
    $stmt = executeQuery($sql, ['published' =>1]);  
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);  // getting results and returning
    return $records; 
}
 

function getPostsByTopicId($topic_id){
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";
    $stmt = executeQuery($sql, ['published' =>1, 'topic_id' => $topic_id]);  
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);  // getting results and returning
    return $records; 
}

function SearchPosts($term){
    $match = '%' . $term . '%';
     global $conn;
    $sql = "SELECT 
    p.*, u.username
        FROM posts AS p 
        JOIN users AS u 
        ON p.user_id=u.id 
        WHERE p.published=?
        AND p.title LIKE ? OR p.body LIKE ? ";
        

    $stmt = executeQuery($sql, ['published' =>1, 'title' => $match, 'body' => $match]);  
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);  // getting results and returning
    return $records; 
}