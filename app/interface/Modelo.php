<?php

namespace App\interface;

interface Modelo
{

    public function all();
    public function insert();
    public function edit();
    public function delete();
    public function search();
    public function searchById();
}
