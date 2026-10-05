import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'providers/cart_provider.dart';
import 'screens/product_list_screen.dart';

void main() {
  runApp(const SleepHavenApp());
}

class SleepHavenApp extends StatelessWidget {
  const SleepHavenApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => CartProvider(),
      child: MaterialApp(
        title: 'Sleep Haven',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: const Color(0xFF1C2B4A)),
          useMaterial3: true,
        ),
        home: const ProductListScreen(),
      ),
    );
  }
}
