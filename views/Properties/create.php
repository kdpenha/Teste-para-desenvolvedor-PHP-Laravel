<?php ob_start(); ?>

<a href="<?= route('/properties') ?>" class="btn btn-primary mb-3">Voltar</a>

<h1 class="mb-4">Cadastrar Imóvel</h1>

<!-- Exibindo erros -->
<?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); // Limpa os erros após exibição ?>
<?php endif; ?>

<?php 
    if (isset($id) && !empty($id)) {
        $action = route('properties/update');
    } else {
        $action = route('properties/save');
    }
?>

<form action="<?= $action ?>" method="POST" class="card p-4 shadow-sm">
    <?php 
        if (isset($id) && !empty($id)) {
            echo '<input type="hidden" name="id" value="' . $id . '">';
        }
    ?>
    <div class="mb-3">
        <label for="name" class="form-label">Nome do Imóvel</label>
        <input type="text" class="form-control" id="name" name="name" required value="<?= !empty($id) ? $property['name'] : '' ?>">
    </div>

    <div class="mb-3">
        <label for="property_type" class="form-label">Tipo de Imóvel</label>
        <select class="form-select" id="property_type" name="property_type" required>
            <option value="">Selecione</option>
            <?php foreach ($propertyTypes as $propertyType): ?>
                <option value="<?= $propertyType ?>" <?php if (!empty($id) && $propertyType == $property['property_type']) echo 'selected'; ?>><?= $propertyType ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="neighborhood" class="form-label">Bairro</label>
        <select class="form-select" id="neighborhood" name="neighborhood" required>
            <option value="">Selecione</option>
            <?php foreach ($neighborhoods as $neighborhood): ?>
                <option value="<?= $neighborhood ?>" <?php if (!empty($id) && $neighborhood == $property['neighborhood']) echo 'selected'; ?>><?= $neighborhood ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="number_of_rooms" class="form-label">Número de Quartos</label>
        <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms" min="0" required value="<?= !empty($id) ? $property['number_of_rooms'] : '' ?>">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required value="<?= !empty($id) ? $property['price'] : '' ?>">
    </div>

    <button type="submit" class="btn btn-success">Salvar Imóvel</button>
</form>
<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>