<?php
require_once(__DIR__ . '/../Config/App/Querys.php');
require_once('../../Models/Season.php');
require_once(__DIR__ . '/../Config/App/InitConnectionDB.php');

function listSeasons()
{
    try {
        $query = new Query();
        $seasonList = $query->selectRecords("SELECT * FROM seasons");
        $seasonObjectArray = [];
        foreach ($seasonList as $item) {
            $seasonObject = new Season(
                $item['id'],
                $item['number'],
                $item['id_serie']
            );
            array_push($seasonObjectArray, $seasonObject);
        }
        echo "<script>console.log('Season ID:', " . $seasonObject->getIdSerie() . ");</script>";
        return $seasonObjectArray;
    } catch (Exception $e) {
        error_log("Error in listSeasons function: " . $e->getMessage());
        return [];
    }
}

function insertSeason($number, $idSerie)
{
    try {
        $message = "ok";
        $number = empty($number) ? null : strval($number);
        $idSerie = empty($idSerie) ? null : strval($idSerie);
        $message = validationSeason($number, $idSerie);
        if ($message == 'ok') {
            if (!existSerie($number)) {
                $mysqli = initConnectionDB();
                $stmt = $mysqli->prepare("INSERT INTO series (number, id_serie) VALUES (?, ?)");
                $stmt->bind_param("ss", $number, $idSerie);
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
        return false;
    }
}

function editSeason($id, $number, $idSerie)
{
    try {
        $message = "ok";
        $number = empty($number) ? null : strval($number);
        $idSerie = empty($idSerie) ? null : strval($idSerie);
        $message = validationSeason($number, $idSerie);
        if ($message == 'ok') {
            $mysqli = initConnectionDB();
            $stmt = $mysqli->prepare("UPDATE seasons SET number = ?, id_serie = ? WHERE id = ?");
            $stmt->bind_param("sii", $number, $idSerie, $id);
            if ($stmt->execute()) {
                $message = 'okUpdate';
            }
            $mysqli->close();
        }
        return $message;
    } catch (Exception $e) {
        error_log("Error in editSeason function: " . $e->getMessage());
        return false;
    }
}

function validationSeason($number, $idserie)
{
    $message = "ok";
    //Title validation
    if (empty($number)) {
        $message = 'emptyerror';
    }
    //idPlatform validation 
    if ($number !== null && null !== $number && !preg_match("/^\d+$/", $number)) {
        $message = 'errorformat';
    }
    //idDirector validation 
    if ($idserie !== null && null !== $idserie && !preg_match("/^\d+$/", $idserie)) {
        $message = 'errorformat';
    }
    return $message;
}

//function to validate if serie exist
function isSeasonExisting($number, $id_serie)
{
    $mysqli = initConnectionDB();
    $numRows = 0;
    $stmt = $mysqli->prepare("SELECT 1 FROM seasons WHERE number = ? and id_serie = ?");
    $stmt->bind_param("ss", $number, $id_serie);
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
function findSeason($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("SELECT * FROM seasons WHERE id = ?");
        $stmt->bind_param("s", $id);
        $season = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // Fetch the results as an associative array
            $season = $result->fetch_assoc();
        }
        return $season;
    } catch (Exception $e) {
        error_log("Error in findSeason function: " . $e->getMessage());
        return [];
    }
}

function deleteSeason($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("DELETE FROM seasons WHERE id = ?");
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