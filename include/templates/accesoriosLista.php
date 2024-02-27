<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesorios</title>
    <style>
        .contenedor-card {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }

        .card {
            width: 300px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 20%;
            border-bottom: 1px solid #ccc;
        }

        .card-content {
            padding: 20px;
        }
      

        .card-content p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .btn-carrito {
            background-color:teal;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 14px;
            margin-top: 10px;
        }

        .btn-carrito:hover {
            background-color: #45a049;
        }
        .btn-detalles {
            background-color:black;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 14px;
            margin-top: 10px;
        }

        .btn-detalles:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="contenedor-card">
    <!-- Primer conjunto de 4 tarjetas -->
    <div>
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_pi/2022/06/17/1655443203d8a234ec8ff75a76e07c330f83c42ae2_thumbnail_900x.webp" alt="Accesorio 1">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 1</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del segundo accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_pi/2023/01/03/1672736089a15cadd2eed984adc50e5ca811b5f510_thumbnail_900x.webp" alt="Accesorio 2">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 2</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del tercer accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_pi/2022/06/21/1655783348d6e4d31a7cbbccd8c0891dc4746f03d1_thumbnail_900x.webp" alt="Accesorio 3">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 3</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del cuarto accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_spmp/2023/10/31/37/1698742264ea9977a0dc297b807b64ca7d332c9ec6_thumbnail_900x.webp" alt="Accesorio 4">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 4</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
    </div>
    <!-- Segundo conjunto de 4 tarjetas -->
    <div>
        <!-- Copia de la primera tarjeta con datos del quinto accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_spmp/2023/06/06/168602345466e9303f1588ed202b0b9ff4ea8e1bb7_thumbnail_900x.webp" alt="Accesorio 5">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 5</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del sexto accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_spmp/2023/07/07/1688719098d60caf8bfd1687f9ec29adafd145365d_thumbnail_900x.webp" alt="Accesorio 6">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 6</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del séptimo accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_spmp/2023/06/10/1686370038ca88867912a6a34f530703d86538ae3c_thumbnail_900x.webp" alt="Accesorio 7">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 7</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
        <!-- Copia de la primera tarjeta con datos del octavo accesorio -->
        <div class="card">
            <img src="https://img.ltwebstatic.com/images3_spmp/2023/06/19/1687159801bb1013537f154f252b7aa0d128080632_thumbnail_900x.webp" alt="Accesorio 8">
            <div class="card-content">
                <h2>Categoría: Accesorios</h2>
                <h3>Nombre: Collar Elegante 8</h3>
                <p>Precio: $29.99</p>
                <p>Color: Plateado</p>
                <button class="btn-carrito">Añadir al carrito</button>
                <a href="detallesAccesorio.php" class="btn-detalles">Detalles</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
