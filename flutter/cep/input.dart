import 'package:flutter/material.dart';

class InputComponet extends StatelesWidget{
  final String label;
  final String hint;
  final IconData icon;
  final Textinputtype keyboard;
  final int maxRows;
  final String? Function(String?) validator;
  final void function(String) onChanged;

  const InputComponet:({
    super.key,
    required this.label,
    required this.hint,
    required this.icon,
    required this.validor,
    required this.onChanged,
    this.keyboard = Textinputtype.text,
    this.maxRows = 1,
  });

  @override
  widget build(BuildContext context){
    return TextFormField(
      keyboardType: keyboard,
      maxLines: maxRows,
      onChanged: onChanged,
      decoration: InputDecoration(
        labelText: label,
        hintText: hint,
        alignLabelWithHint: true,
        prefixicon: Icon(icon),
        border: const OutlineInputBorder()
      ),
      validor:
    )
  }
} 
