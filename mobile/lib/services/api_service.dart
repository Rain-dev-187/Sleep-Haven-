import 'dart:convert';

import 'package:http/http.dart' as http;

import '../models/product.dart';

class ApiService {
  // Emulator Android: 10.0.2.2 = localhost laptop.
  // HP fisik: ganti dengan IP WiFi laptop, misal http://192.168.1.5:8000
  static const String baseUrl = 'http://10.0.2.2:8000';

  static Future<List<Product>> getProducts() async {
    final res = await http.get(Uri.parse('$baseUrl/api/v1/products'));
    if (res.statusCode == 200) {
      final List data = jsonDecode(res.body);
      return data.map((e) => Product.fromJson(e)).toList();
    }
    throw Exception('Gagal memuat produk (${res.statusCode})');
  }

  static Future<Map<String, dynamic>> createOrder(
      Map<String, dynamic> payload) async {
    final res = await http.post(
      Uri.parse('$baseUrl/api/v1/orders'),
      headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
      body: jsonEncode(payload),
    );
    if (res.statusCode == 201) {
      return jsonDecode(res.body);
    }
    final body = jsonDecode(res.body);
    throw Exception(body['message'] ?? 'Gagal membuat pesanan');
  }
}
