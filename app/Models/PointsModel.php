<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointsModel extends Model
{
    protected $table = 'points';

    protected $guarded = ['id'];

    protected $fillable = [
        'geom',
        'name',
        'description',
        'image',
        'created_at',
        'updated_at',
    ];

    public function gejson_points()
    {
        $points = $this
            ->select(DB::raw('id,
        st_asgeojson(geom) AS geom,
        name,
        description,
        image,
        created_at,
        updated_at'))
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $point) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($point->geom),
                'properties' => [
                    'id' => $point->id,
                    'name' => $point->name,
                    'description' => $point->description,
                    'created_at' => $point->created_at,
                    'updated_at' => $point->updated_at,
                    'image' => $point->image,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
