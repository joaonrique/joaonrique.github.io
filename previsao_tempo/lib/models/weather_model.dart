class WeatherModel {
  final double temperature;
  final double windSpeed;
  final double tempMin;
  final double tempMax;
  final double humidity;

  const WeatherModel({
    required this.temperature,
    required this.windSpeed,
    required this.tempMin,
    required this.tempMax,
    required this.humidity,
  });

  factory WeatherModel.fromJson(Map<String, dynamic> json) {
    final current = json['current'] as Map<String, dynamic>;
    final daily = json['daily'] as Map<String, dynamic>;

    return WeatherModel(
      temperature: (current['temperature_2m'] as num).toDouble(),
      windSpeed: (current['wind_speed_10m'] as num).toDouble(),
      humidity: (current['relative_humidity_2m'] as num).toDouble(),
      tempMin: (daily['temperature_2m_min'][0] as num).toDouble(),
      tempMax: (daily['temperature_2m_max'][0] as num).toDouble(),
    );
  }
}
