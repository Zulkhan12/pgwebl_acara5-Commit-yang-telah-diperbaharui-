<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    protected $fillable = [
        'geom',
        'name',
        'description',
    ];

    public function gejson_polygons()
    {
        $polygons = $this->select(DB::raw("
        id,
        ST_AsGeoJSON(geom) AS geom,
        ST_Area(geom, TRUE) AS luas_m2,
        ST_Area(geom, TRUE) / 1000000 AS luas_km2,
        ST_Area(geom, TRUE) / 10000 AS luas_hektar,
        name,
        description,
        created_at,
        updated_at
    "))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->luas_m2,
                    'area_km2' => $p->luas_km2,
                    'area_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                ],
            ];
        }

        return $geojson;
    }
}
