<?php

namespace App\Services;

use App\Models\Dot;
use App\Models\Location;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class LocationsService
{
    public function store($data): ?Location
    {
        $file_path = "";
        try {
            DB::beginTransaction();
            $zip = new ZipArchive;
            $zip->open($data['file']);
            $map_json = json_decode($zip->getFromName('map.json'),true);
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
            $locationDB = Location::create($location);

            foreach ($map_json['dots'] as $dot){
                unset($dot['id'], $dot['photoUrls']);
                $dot['location_id'] = $locationDB->id;
                $dot['connected'] = json_encode($dot['connected']);
                Dot::create($dot);
            }
            DB::commit();
            return $locationDB;
        } catch (\Exception $exception) {
            if (!empty($file_path)){
                Storage::disk('public')->delete($file_path);
            }
            Db::rollBack();
            dd($exception);
        }
        return null;
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
