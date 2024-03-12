<?php 


$elSQL2 = "SELECT * FROM subcategoria";
$subCategorias = getArray($elSQL2);

?>

<div class="container mt-5">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary color-boton d-flex justify-content-between align-items-center mb-2" data-bs-toggle="collapse" data-bs-target="#demo">
                        <span>Busca por Categorías</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div id="demo" class="collapse">
                        <div class="row g-2">

                            <div class="col-md-4">
                                <div class="card">
                                    <?php foreach ($subCategorias as $subCategoria) :

                                    ?>
                                        <div class="card-body p-3">
                                            <a href="/resultado_busqueda_mujer.php?subcategoria_id=<?php echo $subCategoria['id_SubCategoria']; ?>" class="text-decoration-none text-dark">
                                                <p class="subCategoria-Menu mb-0"><?php echo $subCategoria['nombre'] ?></p>
                                            </a>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
                                
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</div>