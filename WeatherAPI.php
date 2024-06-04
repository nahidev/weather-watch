<?php
class WeatherAPI {
    const API_KEY = '79b93cc4e8b99878c153a44f0cd86eef';
    const OPENWEATHER_URL = 'http://api.openweathermap.org/data/2.5/';

    public function getWeatherData($location) {
        $apiUrl = self::OPENWEATHER_URL . "/weather?q=" . urlencode($location) . "&lang=es&units=metric&appid=" . self::API_KEY;
        $response = @file_get_contents($apiUrl);

        if ($response === false) {
            throw new Exception('Error al obtener los datos meteorológicos');
        }

        $weatherData = json_decode($response, true);

        if ($weatherData === null || !isset($weatherData['main']['temp']) || !isset($weatherData['weather'][0]['description']) || !isset($weatherData['main']['humidity']) || !isset($weatherData['wind']['speed'])) {
            throw new Exception('Datos meteorológicos incompletos o inválidos');
        }

        return $weatherData;
    }

    public function getAirPollutionData($latitude, $longitude) {
        $airPollutionApiUrl = self::OPENWEATHER_URL . "/air_pollution?lat=" . $latitude . "&lon=" . $longitude . "&appid=" . self::API_KEY;
        $response = @file_get_contents($airPollutionApiUrl);

        if ($response === false) {
            throw new Exception('Error al obtener los datos de contaminación del aire');
        }

        $airPollutionData = json_decode($response, true);

        if ($airPollutionData === null || !isset($airPollutionData['list'][0]['main']['aqi'])) {
            throw new Exception('Datos de contaminación del aire incompletos o inválidos');
        }

        return $airPollutionData;
    }

    /* 
        Aquí uso operadores ternarios. Es como un if, pero en 1 sola línea. 
        Se usan así:
            <condicion> ? <valor para true> : <valor para false>
    */
    public function getLatitude($weatherData) {
        return isset($weatherData['coord']['lat']) ? $weatherData['coord']['lat'] : null;
    }

    public function getLongitude($weatherData) {
        return isset($weatherData['coord']['lon']) ? $weatherData['coord']['lon'] : null;
    }

    public function getTemperature($weatherData) {
        return isset($weatherData['main']['temp']) ? $weatherData['main']['temp'] : null;
    }

    public function getWeatherDescription($weatherData) {
        return isset($weatherData['weather'][0]['description']) ? $weatherData['weather'][0]['description'] : null;
    }

    public function getHumidity($weatherData) {
        return isset($weatherData['main']['humidity']) ? $weatherData['main']['humidity'] : null;
    }

    public function getWindSpeed($weatherData) {
        return isset($weatherData['wind']['speed']) ? $weatherData['wind']['speed'] : null;
    }

    public function getAirPollution($airPollutionData) {
        return isset($airPollutionData['list'][0]['main']['aqi']) ? $airPollutionData['list'][0]['main']['aqi'] : null;
    }

}
?>
