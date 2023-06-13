<?php

namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = 'sesionesServicios';
    protected static $columnasDB = ['id', 'sesionId', 'servicioId'];

    public $id;
    public $sesionId;
    public $servicioId;

    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->sesionId = $args['sesionId'] ?? '';
       $this->servicioId = $args['servicioId'] ?? ''; 
    }
}