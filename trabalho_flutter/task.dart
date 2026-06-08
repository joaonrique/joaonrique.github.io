
class Task {
  int? id;
  String title;

  Task({this.id, required this.title});

  Map<String, dynamic> toMap() => {'id': id, 'title': title};

  factory Task.fromMap(Map<String, dynamic> map) => 
      Task(id: map['id'], title: map['title']);
}
