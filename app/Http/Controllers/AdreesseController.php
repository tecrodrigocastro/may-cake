<?php

namespace App\Http\Controllers;

use App\Models\Adreesse;
use Illuminate\Http\Request;

class AdreesseController extends Controller
{
    public function getAdreesseById(Request $request)
    {
        $adreesses =  Adreesse::where('user_id', $request->id)->get();

        if (!$adreesses) {
            return $this->error('Adreesse not found', 404);
        }

        return $this->success($adreesses);
    }
}
