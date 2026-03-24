import 'package:flutter/material.dart';

void main(){
  runApp(
    MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          backgroundColor: const Color.fromARGB(255, 8, 11, 180),
        title: Center(
          child: Text("nome do App")
         )
        ),
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text("Olá, Mundo!"),
            Text("23/06/26")
          ]
        ),
      ))
    )
  );
}
