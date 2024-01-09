<?php
    require_once('../../Models/DetailCaptionFilm.php');
   //funcion para listar todos los registros 
   function listCaptionFilms()
   {
       $model = new DetailCaptionFilm(null, null, null);
       $filmList = $model->getCaptionFilms();
       return $filmList;
   }

   //funcion para leer un registro que tenga una pelicula determinada
   function listCaptionFilm($captionfilmIdfilm)
   {
       $model = new DetailCaptionFilm(null, $captionfilmIdfilm, null);
       $filmObject = $model->getCaptionFilm();
       return $filmObject;
   }

   //funcion para guardar el registro
   function burnCaptionFilm($captionfilmIdfilm, $captionfilmIdlanguage)
   {
       $model = new DetailCaptionFilm(null,$captionfilmIdfilm, $captionfilmIdlanguage);        
       $result = $model->saveCaptionFilm(); 
       if ($result > 0) {
           $message = 'ok';
       } else {
           $message = 'error';
       }   
       return $message;
   }

   //funcion para borrar el estado del registro
   function eraseCaptionFilm($captionfilmIdfilm)
   {
       $model = new DetailCaptionFilm(null, $captionfilmIdfilm, null);
       $result = $model->eliminateCaptionFilm();
       if ($result == 1) {
           $message = 'erased';
       } else {
           $message = 'errorrerased';
       }           
       return $message;
   }

?>