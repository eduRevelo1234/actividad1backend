<?php
    require_once('../../Models/DetailCaptionSerie.php');

   //funcion para listar todos los registros 
   function listCaptionSeries()
   {
       $model = new DetailCaptionSerie(null, null, null);
       $serieList = $model->getCaptionSeries();
       return $serieList;
   }

   //funcion para leer los registros que tenga la pelicula y el idioma
   function listCaptionSerie($captionserieIdserie,$captionserieIdlanguage)
   {
        $model = new DetailCaptionSerie(null, $captionserieIdserie, $captionserieIdlanguage);
        $serieObject = $model->getCaptionSerie();
        return $serieObject;
   }

   //funcion para guardar el registro
   function burnCaptionSerie($captionserieIdserie, $captionserieIdlanguage)
   {
       $model = new DetailCaptionSerie(null,$captionserieIdserie, $captionserieIdlanguage);        
       $result = $model->saveCaptionSerie(); 
       if ($result > 0) {
           $message = 'ok';
       } else {
           $message = 'error';
       }   
       return $message;
   }

   //funcion para borrar el estado del registro
   function eraseCaptionSerie($captionserieIdserie)
   {
       $model = new DetailCaptionSerie(null, $captionserieIdserie, null);
       $result = $model->eliminateCaptionSerie();
       if ($result == 1) {
           $message = 'erased';
       } else {
           $message = 'errorrerased';
       }           
       return $message;
   }

   //funcion para leer registros q tenga un lenguaje y cualquier serie 
   function listLanguageCaptionSerie($audiofilmIdlanguage)
   {
       $model = new DetailCaptionSerie(null,null, $audiofilmIdlanguage);  
       $personObject = $model->getSerieLanguajeCaption();
       return $personObject;
   }

?>