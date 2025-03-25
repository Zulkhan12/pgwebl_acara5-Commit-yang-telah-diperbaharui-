<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['id'];

    public function gejson_polylines()
    {
        $polylines = $this->select(DB::raw("
            id,
            ST_AsGeoJSON(geom) AS geom,
            name,
            description,
            ST_Length(geom, TRUE) AS length_m,
            ST_Length(geom, TRUE) / 1000 AS length_km,
            created_at,
            updated_at
        "))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $p) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km' => $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ],
            ];
        }

        return $geojson;
    }
}
