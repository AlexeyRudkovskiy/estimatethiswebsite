<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpaController extends Controller
{

    public function index()
    {
        $publicFiles = File::files(public_path());
        $assetsMapping = [];
        $filenames = [
            'runtime', 'polyfills', 'main', 'styles', 'vendor'
        ];

        foreach ($publicFiles as $file) {
            $filename = $file->getFilename();

            if (Str::endsWith($filename, '.map')) {
                continue ;
            }

            $firstPartDash = substr($filename, 0, strpos($filename, '-'));
            $firstPartDot = substr($filename, 0, strpos($filename, '.'));

            if (in_array($firstPartDash, $filenames)) {
                $assetsMapping[$firstPartDash] = $filename;
            } else if (in_array($firstPartDot, $filenames)) {
                $assetsMapping[$firstPartDot] = $filename;
            }
        }

        return view('layouts.entry', compact('assetsMapping'));
    }

}
