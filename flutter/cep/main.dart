import 'package::flutter/material.dart';
import 'package:previsao_tempo/pages/spash.dart';

void main(){
  runApp( const MyApp);
}

class MyApp extends StatalessWidget {
  const MyApp ({super.key});

  @override
  widget build(BuildContext context){
    return MatertialApp(
      title: "Previsão do tempo",
      initialRoute: "/splash",
      routes
    )
  }
}
