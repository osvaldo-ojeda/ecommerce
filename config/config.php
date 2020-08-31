<?php
    
     session_start();
    function autoCarga($nClase){
        require_once 'class/'.$nClase.'.php';
    }
    spl_autoload_register('autoCarga');
    
    
    
    
      

