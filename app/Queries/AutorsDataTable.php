<?php

namespace App\Queries;
use App\Models\Autor;

class AutorsDatatable{

    public function get($identifier){
        $autors = Autor::where('temporal_identifier', $identifier);

        foreach ($autors as $key => $autor){
            $autor[$key] = $autor->ApiObj();
        }
        return $autors;
    }
}