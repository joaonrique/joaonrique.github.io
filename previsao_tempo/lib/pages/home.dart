import 'package:flutter/material.dart';
import 'package:previsao_tempo/models/city_model.dart';
import 'package:previsao_tempo/models/weather_model.dart';
import 'package:previsao_tempo/services/city_service.dart';
import 'package:previsao_tempo/services/weather_service.dart';

class Home extends StatefulWidget {
  final WeatherModel? initialWeather;

  const Home({super.key, this.initialWeather});

  @override
  State<Home> createState() => _HomeState();
}

class _HomeState extends State<Home> {
  final _formKey = GlobalKey<FormState>();
  List<CityModel> _cities = [];
  CityModel? _selectedCity;
  String _uf = "";
  bool _isLoading = false;
  WeatherModel? _weather;

  @override
  void initState() {
    super.initState();
    _weather = widget.initialWeather;
  }

  Future<void> _fetchCities(String uf) async {
    setState(() {
      _isLoading = true;
      _cities = [];
      _selectedCity = null;
    });
    try {
      final cities = await CityService.fetchCityByState(uf);
      setState(() => _cities = cities);
    } catch (e) {
      debugPrint('Erro ao buscar cidades: $e');
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erro ao buscar cidades. Tente novamente.')),
      );
    } finally {
      setState(() => _isLoading = false);
    }
  }

  Future<void> _buscar() async {
    if (!_formKey.currentState!.validate()) return;
    setState(() => _isLoading = true);
    try {
      final weather = await WeatherService.fetchByCity(
        _selectedCity!.nome!,
        _uf,
      );
      setState(() => _weather = weather);
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erro ao buscar clima da cidade.')),
      );
    } finally {
      setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Previsão do Tempo'),
        backgroundColor: Colors.deepPurple,
        foregroundColor: Colors.white,
      ),
      body: Form(
        key: _formKey,
        child: Padding(
          padding: const EdgeInsets.all(12),
          child: ListView(
            children: [
              if (_weather != null) _weatherCard(_weather!),
              const SizedBox(height: 16),
              DropdownButtonFormField<String>(
                decoration: const InputDecoration(
                  labelText: "UF",
                  border: OutlineInputBorder(),
                ),
                items: estados
                    .map((uf) => DropdownMenuItem(value: uf, child: Text(uf)))
                    .toList(),
                onChanged: (uf) {
                  if (uf == null) return;
                  setState(() => _uf = uf);
                  _fetchCities(uf);
                },
              ),
              const SizedBox(height: 12),
              Autocomplete<CityModel>(
                displayStringForOption: (city) => city.nome ?? '',
                optionsBuilder: (TextEditingValue textEditingValue) {
                  if (textEditingValue.text.isEmpty) return _cities;
                  return _cities.where(
                    (city) => (city.nome ?? '').toLowerCase().contains(
                      textEditingValue.text.toLowerCase(),
                    ),
                  );
                },
                onSelected: (city) => setState(() => _selectedCity = city),
                fieldViewBuilder: (context, controller, focusNode, onSubmitted) {
                  return TextFormField(
                    controller: controller,
                    focusNode: focusNode,
                    decoration: InputDecoration(
                      labelText: "Cidade",
                      border: const OutlineInputBorder(),
                      hintText: _uf.isEmpty
                          ? "Selecione um estado primeiro"
                          : "Selecione uma cidade",
                    ),
                    enabled: _cities.isNotEmpty,
                    validator: (_) {
                      if (_selectedCity == null) return "Selecione uma cidade";
                      return null;
                    },
                  );
                },
                optionsViewBuilder: (context, onSelected, options) {
                  return Align(
                    alignment: Alignment.topLeft,
                    child: Material(
                      elevation: 4,
                      child: ConstrainedBox(
                        constraints: const BoxConstraints(maxHeight: 200),
                        child: ListView.builder(
                          shrinkWrap: true,
                          itemCount: options.length,
                          itemBuilder: (context, index) {
                            final city = options.elementAt(index);
                            return ListTile(
                              title: Text(city.nome ?? ''),
                              onTap: () => onSelected(city),
                            );
                          },
                        ),
                      ),
                    ),
                  );
                },
              ),
              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: _isLoading ? null : _buscar,
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.deepPurple,
                  foregroundColor: Colors.white,
                ),
                child: _isLoading
                    ? const CircularProgressIndicator(color: Colors.white)
                    : const Text("Buscar"),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _weatherCard(WeatherModel w) {
    return Card(
      color: Colors.deepPurple.shade50,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Condições atuais',
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: Colors.deepPurple,
              ),
            ),
            const Divider(),
            _infoRow(Icons.thermostat, 'Temperatura', '${w.temperature}°C'),
            _infoRow(Icons.air, 'Vento', '${w.windSpeed} km/h'),
            _infoRow(Icons.arrow_downward, 'Mínima', '${w.tempMin}°C'),
            _infoRow(Icons.arrow_upward, 'Máxima', '${w.tempMax}°C'),
            _infoRow(Icons.water_drop, 'Humidade', '${w.humidity}%'),
          ],
        ),
      ),
    );
  }

  Widget _infoRow(IconData icon, String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 4),
      child: Row(
        children: [
          Icon(icon, color: Colors.deepPurple, size: 20),
          const SizedBox(width: 8),
          SizedBox(
            width: 100,
            child: Text('$label:', style: const TextStyle(fontWeight: FontWeight.w600)),
          ),
          Text(value),
        ],
      ),
    );
  }

  final List<String> estados = [
    'AC','AL','AP','AM','BA','CE','DF','ES','GO',
    'MA','MT','MS','MG','PA','PB','PR','PE','PI',
    'RJ','RN','RS','RO','RR','SC','SP','SE','TO',
  ];
}
