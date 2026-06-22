import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:previsao_tempo/models/city_model.dart';

class CityService {
  static Future<List<CityModel>> fetchCityByState(String uf) async {
    final url = Uri.parse(
      'https://servicodados.ibge.gov.br/api/v1/localidades/estados/$uf/municipios',
    );

    final response = await http.get(url);

    if (response.statusCode != 200) {
      throw Exception('Erro ao buscar cidades: ${response.statusCode}');
    }

    final List<dynamic> json = jsonDecode(response.body);
    debugPrint('Cidades encontradas: ${json.length}');
    return json.map((item) => CityModel.fromJson(item)).toList();
  }
}
