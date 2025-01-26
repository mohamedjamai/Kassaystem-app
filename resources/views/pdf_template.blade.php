<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderData['products'] as $product)
                <tr>
                    <td>{{ $product['ProductNaam'] }}</td>
                    <td>{{ $product['Prijs'] }}</td>
                    <td>{{ $product['Aantal'] }}</td>
                    <td>{{ $product['Subtotaal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ $total }}</h3>
</body>
</html>
