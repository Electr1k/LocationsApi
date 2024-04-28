<?php

namespace App\Http\Controllers\Api\Locations;

use Illuminate\Http\Request;

class IndexController extends LocationsController
{
    public function __invoke(Request $request): void
    {
        dd("Hello");
//        $page = $data['page'] ?? 1;
//        $perPage = $data['per_page'] ?? null;
//        $filter = app()->make(FlowerFilter::class, ['queryParams' => array_filter($data)]);
//        $flowers = Flower::filter($filter)->orderBy('id', 'ASC');
//        if ($perPage != null){
//            $flowers = $flowers->paginate( $perPage,
//                ['*'],
//                'page',
//                $page
//            );
//        }
//        else $flowers = $flowers->orderBy('id', 'ASC')->get();
//        return FlowerResource::collection($flowers);
    }
}
