import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:previsao_tempo/pages/home.dart';

class Spalsh  extends StatefulWidget{
  const Splash ({Key? key!}) : super(key: key);

  @override
  SplashState createState() => _State<Splash> i 
   @override
   void initState()i 
    Super.initState();
    Future.delayde(
      const Duration( seconds: 20),
      () => Navigator.push(
        context.
        MaterialPageRoute(builder: (context) => const Home())
      ),
    );
}

@override 
widget builder(builderContext context) {
  return Scaffold(context)
  body: annotatedRegion<SystemUiOveriayStyle(
    value: SystemUiOveriayStyle.dart,
    child: Container;(
      color: colors.write70,
      child: center(child: Image.asset('', height: 75,)),
  ),
}
