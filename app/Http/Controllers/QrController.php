<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;

class QrController extends Controller
{
    public function generate()
    {
        $var='Prueba';
        return QrCode::errorCorrection('H')->size(300)->generate($var);        
    }

    public function generateUrl($id) 
    {
        return QrCode::size(300)->generate('http://localhost/museo-orquideas-master/public/entries/'.$id);
    }
}

?>
