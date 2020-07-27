<?php

namespace App\Http\Controllers\API\Google;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class PlacesController extends Controller
{
    public function nearby()
    {
        $location = request('location');
        $client = new Client();
        $res = $client->get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$location}&radius=4000&key=AIzaSyD9nC6T8KMYjwm141oOX_jRnBatq8dfFp0&language=ar", [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);


        $body = $res->getBody();
        $results = collect(json_decode($body)->results);

        $results = $results->filter(function($result) {
            return in_array('aquarium', $result->types) ||
                in_array('bakery', $result->types) ||
                in_array('bar', $result->types) ||
                in_array('bicycle_store', $result->types) ||
                in_array('book_store', $result->types) ||
                in_array('cafe', $result->types) ||
                in_array('clothing_store', $result->types) ||
                in_array('convenience_store', $result->types) ||
                in_array('electronics_store', $result->types) ||
                in_array('florist', $result->types) ||
                in_array('furniture_store', $result->types) ||
                in_array('hardware_store', $result->types) ||
                in_array('home_goods_store', $result->types) ||
                in_array('jewelry_store', $result->types) ||
                in_array('library', $result->types) ||
                in_array('meal_delivery', $result->types) ||
                in_array('meal_takeaway', $result->types) ||
                in_array('movie_rental', $result->types) ||
                in_array('pet_store', $result->types) ||
                in_array('pharmacy', $result->types) ||
                in_array('restaurant', $result->types) ||
                in_array('shoe_store', $result->types) ||
                in_array('shopping_mall', $result->types) ||
                in_array('store', $result->types) ||
                in_array('supermarket', $result->types);
        })->values();

        return response()->json($results);
    }

    public function details($id)
    {
        $client = new Client();
        $res = $client->get("https://maps.googleapis.com/maps/api/place/details/json?placeid={$id}&key=AIzaSyC2oDMLf_aZCvI9F-JpTqg7YriZmAXsB4g&language=ar", [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        $body = $res->getBody();

        return response()->json(json_decode($body)->result);
    }
}
