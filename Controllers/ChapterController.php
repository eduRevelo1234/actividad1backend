<?php
require_once(__DIR__ . '/../Config/App/Querys.php');
require_once('../../Models/Chapter.php');
require_once(__DIR__ . '/../Config/App/InitConnectionDB.php');

function listChapters()
{
    try {
        $query = new Query();
        $chapterList = $query->selectRecords("SELECT * FROM chapters");
        $chapterObjectArray = [];
        foreach ($chapterList as $item) {
            $chapterObject = new Chapter(
                $item['id'],
                $item['number'],
                $item['title'],
                $item['duration'],
                $item['id_season']
            );
            array_push($chapterObjectArray, $chapterObject);
        }
        return $chapterObjectArray;
    } catch (Exception $e) {
        error_log("Error in listChapters function: " . $e->getMessage());
        return [];
    }
}

function insertChapter($number, $title, $duration, $idSeason)
{
    try {
        $message = "ok";
        $number = empty($number) ? null : strval($number);
        $title = empty($title) ? null : strval($title);
        $duration = empty($duration) ? null : strval($duration);
        $idSeason = empty($idSeason) ? null : strval($idSeason);
        $message = validationChapter($number, $title, $duration, $idSeason);
        if ($message == 'ok') {
            if (!isChapterExisting($number, $idSeason)) {
                $mysqli = initConnectionDB();

                $stmt = $mysqli->prepare("INSERT INTO chapters (number, title, duration, id_season) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $number, $title, $duration, $idSeason);
                if ($stmt->execute()) {
                    $message = 'ok';
                } else {
                    error_log("Error executing statement: " . $stmt->error);
                }
                $mysqli->close();
            } else {
                $message = 'exist';
            }
        }
        return $message;
    } catch (Exception $e) {
        error_log("Error in insertChapter function: " . $e->getMessage());
        return false;
    }
}

function editChapter($id, $number, $title, $duration, $idSeason)
{
    try {
        $message = "ok";
        $number = empty($number) ? null : strval($number);
        $title = empty($title) ? null : strval($title);
        $duration = empty($duration) ? null : strval($duration);
        $idSeason = empty($idSeason) ? null : strval($idSeason);
        $message = validationChapter($number, $title, $duration, $idSeason);
        if ($message == 'ok') {
            $mysqli = initConnectionDB();
            $stmt = $mysqli->prepare("UPDATE chapters SET number = ?, title = ?, duration = ?, id_Season = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $number, $title, $duration, $idSeason, $id);
            if ($stmt->execute()) {
                $message = 'okUpdate';
            }
            $mysqli->close();
        }
        return $message;
    } catch (Exception $e) {
        error_log("Error in editChapter function: " . $e->getMessage());
        return false;
    }
}

function validationChapter($number, $title, $duration, $idSeason)
{
    $message = "ok";
    //Empty validation
    if (empty($number) || empty($idSeason)) {
        $message = 'emptyerror';
    }
    //idPlatform validation 
    if ($number !== null && null !== $number && !preg_match("/^\d+$/", $number)) {
        $message = 'errorformat';
    }
    //duration validation 
    if ($duration !== null && null !== $duration && !preg_match("/^\d+$/", $duration)) {
        $message = 'errorformat';
    }
    //idDirector validation 
    if ($idSeason !== null && null !== $idSeason && !preg_match("/^\d+$/", $idSeason)) {
        $message = 'errorformat';
    }
    return $message;
}

//function to validate if serie exist
function isChapterExisting($number, $idSeason)
{
    $mysqli = initConnectionDB();
    $numRows = 0;
    $stmt = $mysqli->prepare("SELECT 1 FROM chapters WHERE number = ? and id_Season = ?");
    $stmt->bind_param("ss", $number, $idSeason);
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
function findChapter($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("SELECT * FROM chapters WHERE id = ?");
        $stmt->bind_param("s", $id);
        $chapter = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            // Fetch the results as an associative array
            $chapter = $result->fetch_assoc();
        }
        return $chapter;
    } catch (Exception $e) {
        error_log("Error in findChapter function: " . $e->getMessage());
        return [];
    }
}

function deleteChapter($id)
{
    try {
        $mysqli = initConnectionDB();
        $stmt = $mysqli->prepare("DELETE FROM chapters WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = 'okDelete';
        } else {
            $message = 'errorDelete';
        }
        $mysqli->close();
        return $message;
    } catch (Exception $e) {
        error_log("Error in deleteChapter function: " . $e->getMessage());
        return 'errorDelete';
    }
}
?>