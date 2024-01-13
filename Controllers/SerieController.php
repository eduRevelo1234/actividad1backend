<?php
require_once(__DIR__ . '/../Config/App/Querys.php');
require_once('../../Models/Serie.php');
require_once(__DIR__ . '/../Config/App/InitConnectionDB.php');
function listSeries()
{
    try {
        $query = new Query();
        $seriesList = $query->selectRecords("SELECT * FROM series");
        $serieObjectArray = [];
        foreach ($seriesList as $item) {
            $serieObject = new Serie(
                $item['id'],
                $item['title'],
                $item['id_platform'],
                $item['id_director'],
                $item['premiere_year']
            );
            array_push($serieObjectArray, $serieObject);
        }
        return $serieObjectArray;
    } catch (Exception $e) {
        error_log("Error in listSeries function: " . $e->getMessage());
        return [];
    }
}

function insertSerie($title, $idDirector, $idPlatform, $premierYear)
{
    try {
        $message = "ok";
        $idPlatform = empty($idPlatform) ? null : strval($idPlatform);
        $idDirector = empty($idDirector) ? null : strval($idDirector);
        $premierYear = empty($premierYear) ? null : strval($premierYear);
        $message = validation($title, $idDirector, $idPlatform, $premierYear);
        if ($message == 'ok') {
            if (!existSerie($title)) {
                $mysqli = initConnectionDB();
                $stmt = $mysqli->prepare("INSERT INTO series (title, id_platform, id_director, premiere_year) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $title, $idPlatform, $idDirector, $premierYear);
                if ($stmt->execute()) {
                    $message = 'ok';
                }
                $mysqli->close();
            } else {
                $message = 'exist';
            }
        }
        return $message;
    } catch (Exception $e) {
        error_log("Error in insertSeries function: " . $e->getMessage());
        return false; // Devuelve un valor que indica que la inserción falló
    }
}

function editSerie($id, $title, $idDirector, $idPlatform, $premierYear)
{
    try {
        $message = "ok";
        $idPlatform = empty($idPlatform) ? null : strval($idPlatform);
        $idDirector = empty($idDirector) ? null : strval($idDirector);
        $premierYear = empty($premierYear) ? null : strval($premierYear);
        $message = validation($title, $idDirector, $idPlatform, $premierYear);
        if ($message == 'ok') {
            $mysqli = initConnectionDB();
            $stmt = $mysqli->prepare("UPDATE series SET title = ?, id_platform = ?, id_director = ?, premiere_year = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $idPlatform, $idDirector, $premierYear, $id);
            if ($stmt->execute()) {
                $message = 'okUpdate';
            }

            $mysqli->close();
        }
        return $message;
    } catch (Exception $e) {
        error_log("Error in editSerie function: " . $e->getMessage());
        return false; // Devuelve un valor que indica que la actualización falló
    }
}

function validation($title, $idDirector, $idPlatform, $premierYear)
{
    $message = "ok";
    //Title validation
    if (empty($title)) {
        $message = 'emptyerror';
    }
    //premierYear validation 
    if ($premierYear !== null && null !== $premierYear && !preg_match("/^\d{4}$/", $premierYear)) {
        $message = 'errorformat';
    }
    //idPlatform validation 
    if ($idPlatform !== null && null !== $idPlatform && !preg_match("/^\d+$/", $idPlatform)) {
        $message = 'errorformat';
    }
    //idDirector validation 
    if ($idDirector !== null && null !== $idDirector && !preg_match("/^\d+$/", $idDirector)) {
        $message = 'errorformat';
    }
    return $message;
}

//function to validate if serie exist
function existSerie($title)
{
    $mysqli = initConnectionDB();
    $numRows = 0;
    $stmt = $mysqli->prepare("SELECT 1 FROM series WHERE title = ?");
    $stmt->bind_param("s", $title);
    if ($stmt->execute()) {
        $stmt->store_result();
        $numRows = ($stmt->num_rows > 0);
    }
    $exist = $numRows >= 1 ? true : false;
    $stmt->close();
    $mysqli->close();
    return $exist;
}

//Function to return a serie with id
function findSerie($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("SELECT * FROM series WHERE id = ?");
        $stmt->bind_param("s", $id);
        $serie = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // Fetch the results as an associative array
            $serie = $result->fetch_assoc();
        }
        return $serie;
    } catch (Exception $e) {
        error_log("Error in listSeries function: " . $e->getMessage());
        return [];
    }
}

function deleteSerie($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("DELETE FROM series WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = 'okDelete';
        } else {
            $message = 'errorDelete';
        }
        $mysqli->close();
        return $message;
    } catch (Exception $e) {
        error_log("Error in deleteSerie function: " . $e->getMessage());
        return 'errorDelete';
    }
}
?>