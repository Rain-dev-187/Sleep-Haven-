class Product {
  final int id;
  final String name;
  final String slug;
  final String? description;
  final int price;
  final int stock;
  final String? imageUrl;
  final String? category;

  Product({
    required this.id,
    required this.name,
    required this.slug,
    this.description,
    required this.price,
    required this.stock,
    this.imageUrl,
    this.category,
  });

  factory Product.fromJson(Map<String, dynamic> json) => Product(
        id: json['id'],
        name: json['name'],
        slug: json['slug'],
        description: json['description'],
        price: (json['price'] as num).toInt(),
        stock: (json['stock'] as num).toInt(),
        imageUrl: json['image_url'],
        category: json['category'],
      );

  String get priceRp => 'Rp ${price.toString().replaceAllMapped(
        RegExp(r'(\d{1,3})(?=(\d{3})+(?!\d))'), (m) => '${m[1]}.')}';
}
