import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';

class LocationRepository {
  static Database? _db;

  static Future<Database> get database async {
    if (_db != null) return _db!;
    _db = await _initDb();
    return _db!;
  }

  static Future<Database> _initDb() async {
    final path = join(await getDatabasesPath(), 'location.db');
    return openDatabase(
      path,
      version: 1,
      onCreate: (db, version) async {
        await db.execute('''
          CREATE TABLE location (
            id INTEGER PRIMARY KEY,
            latitude REAL NOT NULL,
            longitude REAL NOT NULL
          )
        ''');
      },
    );
  }

  static Future<void> saveOrUpdate(double lat, double lon) async {
    final db = await database;
    final existing = await db.query('location', limit: 1);

    if (existing.isEmpty) {
      await db.insert('location', {'id': 1, 'latitude': lat, 'longitude': lon});
    } else {
      final saved = existing.first;
      final sameLat = (saved['latitude'] as double) == lat;
      final sameLon = (saved['longitude'] as double) == lon;

      if (!sameLat || !sameLon) {
        await db.update(
          'location',
          {'latitude': lat, 'longitude': lon},
          where: 'id = ?',
          whereArgs: [1],
        );
      }
    }
  }

  static Future<Map<String, double>?> getLast() async {
    final db = await database;
    final result = await db.query('location', limit: 1);
    if (result.isEmpty) return null;
    return {
      'latitude': result.first['latitude'] as double,
      'longitude': result.first['longitude'] as double,
    };
  }
}
