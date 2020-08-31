<?php

    class Conexion
    {
        private function __construct()
        {} 

        static function conectar()
        {
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8');

            $link = new PDO(
                'mysql:host=localhost;dbname=deBuenaMadera',
                'root',
                'root',
                $opciones
            );
            
            return $link;
        }
    }