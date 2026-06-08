import 'package:flutter/material.dart';
import 'screens/task_list_screen.dart';

void main() => runApp(const TodoApp());

class TodoApp extends StatelessWidget {
  const TodoApp({super.key});
  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      home: TaskListScreen(),
    );
  }
}
