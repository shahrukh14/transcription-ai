<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function testApi(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer XJKO4KzqqyexdZ0bvXrlwc6fzu5fI5gE',
        ])->attach(
            'file', file_get_contents(public_path('test.mp3')), 'test.mp3'
        )->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
            'language' => 'english',
            'response_format' => 'verbose_json',
        ]);
        
        $data = $response->json();
        return $data;
    }
}
