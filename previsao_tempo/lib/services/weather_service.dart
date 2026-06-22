import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:previsao_tempo/models/weather_model.dart';

class WeatherService {
  static Future<WeatherModel> fetchByLocation(double lat, double lon) async {
    return _fetch(lat, lon);
  }

  static Future<WeatherModel> fetchByCity(String city, String uf) async {
    final geoUrl = Uri.parse(
      'https://geocoding-api.open-meteo.com/v1/search'
      '?name=${Uri.encodeComponent(city)}'
      '&count=10&language=pt&format=json',
    );

    final geoRes = await http.get(geoUrl);
    if (geoRes.statusCode != 200) throw Exception('Erro no geocoding');

    final geoJson = jsonDecode(geoRes.body);
    final results = geoJson['results'] as List<dynamic>?;
    if (results == null || results.isEmpty) {
      throw Exception('Cidade não encontrada');
    }

    final match = results.firstWhere(
      (r) => (r['country_code'] == 'BR'),
      orElse: () => results.first,
    );

    final lat = (match['latitude'] as num).toDouble();
    final lon = (match['longitude'] as num).toDouble();

    return _fetch(lat, lon);
  }

  static Future<WeatherModel> _fetch(double lat, double lon) async {
    final url = Uri.parse(
      'https://api.open-meteo.com/v1/forecast'
      '?latitude=$lat&longitude=$lon'
      '&current=temperature_2m,relative_humidity_2m,wind_speed_10m'
      '&daily=temperature_2m_max,temperature_2m_min'
      '&timezone=America%2FSao_Paulo'
      '&forecast_days=1',
    );

    final response = await http.get(url);
    if (response.statusCode != 200) {
      throw Exception('Erro ao buscar clima: ${response.statusCode}');
    }

    return WeatherModel.fromJson(jsonDecode(response.body));
  }
}
