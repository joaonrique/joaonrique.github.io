import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';
import '../models/task.dart';

class DBProvider {
  static Database? _database;
  static final DBProvider db = DBProvider._();
  DBProvider._();

  Future<Database> get database async {
    if (_database != null) return _database!;
    _database = await initDB();
    return _database!;
  }

  Future<Database> initDB() async {
    String path = join(await getDatabasesPath(), 'tasks.db');
    return await openDatabase(path, version: 1, onCreate: (db, version) async {
      await db.execute(
          'CREATE TABLE Task (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT)');
    });
  }

  Future<int> insertTask(Task task) async {
    final db = await database;
    return await db.insert('Task', task.toMap());
  }

  Future<List<Task>> getAllTasks() async {
    final db = await database;
    var res = await db.query('Task');
    return res.map((c) => Task.fromMap(c)).toList();
  }

  Future<Task?> getTaskById(int id) async {
    final db = await database;
    var res = await db.query('Task', where: 'id = ?', whereArgs: [id]);
    return res.isNotEmpty ? Task.fromMap(res.first) : null;
  }

  Future<int> updateTask(Task task) async {
    final db = await database;
    return await db.update('Task', task.toMap(), where: 'id = ?', whereArgs: [task.id]);
  }

  Future<int> deleteTask(int id) async {
    final db = await database;
    return await db.delete('Task', where: 'id = ?', whereArgs: [id]);
  }
}
