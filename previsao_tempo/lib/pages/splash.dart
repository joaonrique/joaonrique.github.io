import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:geolocator/geolocator.dart';
import 'package:previsao_tempo/pages/home.dart';
import 'package:previsao_tempo/repository/location_repository.dart';
import 'package:previsao_tempo/services/weather_service.dart';
import 'package:previsao_tempo/models/weather_model.dart';

class Splash extends StatefulWidget {
  const Splash({Key? key}) : super(key: key);

  @override
  _SplashState createState() => _SplashState();
}

class _SplashState extends State<Splash> {
  @override
  void initState() {
    super.initState();
    _init();
  }

  Future<void> _init() async {
    WeatherModel? weather;

    try {
      final position = await _getPermissionForLocation();
      final lat = position.latitude;
      final lon = position.longitude;

      debugPrint('Lat: $lat\nLon: $lon');

      await LocationRepository.saveOrUpdate(lat, lon);
      weather = await WeatherService.fetchByLocation(lat, lon);
    } catch (e) {
      debugPrint('Erro no Splash: $e');

      final last = await LocationRepository.getLast();
      if (last != null) {
        weather = await WeatherService.fetchByLocation(
          last['latitude']!,
          last['longitude']!,
        );
      }
    }

    if (mounted) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => Home(initialWeather: weather)),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: AnnotatedRegion<SystemUiOverlayStyle>(
        value: SystemUiOverlayStyle.dark,
        child: Container(
          color: Colors.white70,
          child: Center(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Image.asset('assets/images/meteorology.png', height: 75),
                const SizedBox(height: 24),
                const CircularProgressIndicator(),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Future<Position> _getPermissionForLocation() async {
    const msgErro = "Location permission are denied.";
    const msgFatalErro =
        "Location permissions are permanently denied, we cannot request permissions.";

    final isLocationEnable = await Geolocator.isLocationServiceEnabled();
    if (!isLocationEnable) return Future.error(msgErro);

    LocationPermission permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) {
        return Future.error(msgErro);
      }
    }

    if (permission == LocationPermission.deniedForever) {
      return Future.error(msgFatalErro);
    }

    return await Geolocator.getCurrentPosition();
  }
}
