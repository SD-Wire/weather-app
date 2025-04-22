<?php

namespace App\Http\Controllers;

// Import necessary classes
use Illuminate\Support\Facades\Log; // For logging error messages
use GuzzleHttp\Client; // Guzzle HTTP client for making API requests
use Illuminate\Http\Request; // Request class to handle incoming requests
use GuzzleHttp\Exception\RequestException; // Exception class for handling request errors

class WeatherController extends Controller
{
    // Method to fetch weather data based on the city provided in the request
    public function getWeather(Request $request)
    {
        // Create a new instance of the Guzzle HTTP client
        $client = new Client();

        // Retrieve the OpenWeatherMap API key from the environment variables
        $apiKey = env('OPENWEATHERMAP_API_KEY');

        // Get the city name from the request input
        $city = $request->input('city');

        try {
            // Geocoding API to get coordinates
            $geoResponse = $client->get("http://api.openweathermap.org/geo/1.0/direct?q={$city}&limit=1&appid={$apiKey}");
            $geoData = json_decode($geoResponse->getBody(), true);

            if (empty($geoData)) {
                return response()->json(['error' => 'City not found'], 404);
            }

            $lat = $geoData[0]['lat'];
            $lon = $geoData[0]['lon'];

            // Current weather data
            $response = $client->get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric");
            $currentWeather = json_decode($response->getBody(), true);

            // 3-day forecast
            $forecastResponse = $client->get("https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric");
            $forecastData = json_decode($forecastResponse->getBody(), true);

            return response()->json([
                'current' => $currentWeather,
                'forecast' => $forecastData
            ], 200);
        } catch (RequestException $e) {
            // Log the error message if the API request fails
            Log::error('Weather API request failed: ' . $e->getMessage());

            // Return a JSON response with an error message and a 500 Internal Server Error status
            return response()->json(['error' => 'Unable to fetch weather data'], 500);
        }
    }
}