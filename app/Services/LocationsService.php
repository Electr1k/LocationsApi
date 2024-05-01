<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class LocationsService
{
    public function store($data): Location
    {
        $zip = new ZipArchive;
        $zip->open($data['file']);
        $map_json  = json_decode($zip->getFromName('map.json'));
        $zip->close();
        $file_path = Storage::disk('public')->put('/zip', $data['file']);
        $location = [];
        $location["title"] = $data['title'];
        $location["address"] = $data['address'];
        $location["description"] = $data['description'];

        $absolute_file_path = Storage::disk('public')->path($file_path);
        $location["hashSum"] = hash_file("sha256", $absolute_file_path);
        $location["path"] = $file_path;
        $location["dataUrl"] = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove', $location['title']);
        return Location::create($location);
    }

    public function index()
    {
        return Location::orderBy('id', 'ASC')->get();
    }

    public function trashed()
    {
        return Location::onlyTrashed()->orderBy('id', 'ASC')->get();
    }

    public function destroy(Location $location): bool|JsonResponse
    {
        if ($location){
            $location->delete();
            Storage::disk('public')->delete($location->path);
        }
        else return response()->json(['message' => 'Flower not found'])->setStatusCode(404);
        return true;
    }
}
