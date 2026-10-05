import 'package:flutter/foundation.dart';

import '../models/product.dart';

class CartItem {
  final Product product;
  int qty;
  CartItem(this.product, this.qty);
}

class CartProvider extends ChangeNotifier {
  final Map<int, CartItem> _items = {};

  List<CartItem> get items => _items.values.toList();

  int get count => _items.values.fold(0, (s, i) => s + i.qty);

  int get total =>
      _items.values.fold(0, (s, i) => s + i.product.price * i.qty);

  void add(Product product) {
    final existing = _items[product.id];
    final currentQty = existing?.qty ?? 0;
    if (currentQty < product.stock) {
      _items[product.id] = CartItem(product, currentQty + 1);
      notifyListeners();
    }
  }

  void remove(int productId) {
    _items.remove(productId);
    notifyListeners();
  }

  void clear() {
    _items.clear();
    notifyListeners();
  }
}
