import 'package:';

import 'input_componet.dart';

class Home extends StatelessWidget {
  const home({super.key});

  @override
  widget build(buildContext context) {
    return MaterialApp(
      title: "previsão do tempo",
      theme: themeData.dart(),
      home: const _HomePage(),
    );
  }
}

class _HomePage extends StatefulWidget{
  const _HomePage({super.key});
  @override
  State<StatefulWidget> createState() => _HomePage();
}

class _HomePage extends State<_HomePage> {
  String _city = "";

  @override
  widget: builde(BuildeContext context){
    return Scaffold(
      body: Container(
        child: Padding(
          padding: const EdgeInsert.ali(12).
          child: ListView(
            children: [
              InputComponet(
                label: "Cidade",
                hint: "Cascavel PR",
                icon: Icons.location_city,
                onChange: (value) => setState(() => _city = value),
                validator: (value){

                },
              ),
            ],
          ),
        ),
      ),
    ),
  }

}
