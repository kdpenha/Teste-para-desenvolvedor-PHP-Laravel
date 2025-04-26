<?php ob_start(); ?>

<a href="<?= route('/customer-interests') ?>" class="btn btn-primary mb-3">Voltar</a>

<h1 class="mb-4">Cadastrar Interesse de Cliente</h1>

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
        $action = route('customer-interests/update');
    } else {
        $action = route('customer-interests/save');
    }
?>

<form action="<?= $action ?>" method="POST" class="card p-4 shadow-sm">
    <?php 
        if (isset($id) && !empty($id)) {
            echo '<input type="hidden" name="id" value="' . $id . '">';
        }
    ?>
    <div class="mb-3">
        <label for="name" class="form-label">Nome do cliente</label>
        <input type="text" class="form-control" id="name" name="name" required value="<?= !empty($id) ? $customerInterest['name'] : '' ?>">
    </div>
    
    <div class="mb-3">
        <label for="phone" class="form-label">Número de Celular</label>
        <input type="text" max-length="15" placeholder="(00) 00000-0000" class="form-control" id="phone" name="phone" required value="<?= !empty($id) ? $customerInterest['phone'] : '' ?>" oninput="formatarCelular(this)">
    </div>

    <div class="mb-3">
        <label for="desired_property_type" class="form-label">Tipo de Imóvel Desejado</label>
        <select class="form-select" id="desired_property_type" name="desired_property_type" required>
            <option value="">Selecione</option>
            <?php foreach ($propertyTypes as $propertyType): ?>
                <option value="<?= $propertyType ?>" <?php if (!empty($id) && $propertyType == $customerInterest['desired_property_type']) echo 'selected'; ?>><?= $propertyType ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="property_price_min" class="form-label">Preço Mínimo de Imóvel</label>
        <input type="number" step="0.01" class="form-control" id="property_price_min" name="property_price_min" value="<?= !empty($id) ? $customerInterest['property_price_min'] : '' ?>">
    </div>

    <div class="mb-3">
        <label for="property_price_max" class="form-label">Preço Máximo de Imóvel</label>
        <input type="number" step="0.01" class="form-control" id="property_price_max" name="property_price_max" value="<?= !empty($id) ? $customerInterest['property_price_max'] : '' ?>">
    </div>

    <div class="mb-3">
        <label for="number_min_of_rooms" class="form-label">Número Mínimo de Quartos</label>
        <input type="number" class="form-control" id="number_min_of_rooms" name="number_min_of_rooms" min="0" value="<?= !empty($id) ? $customerInterest['number_min_of_rooms'] : '' ?>">
    </div>

    <div class="mb-3">
    <label for="neighborhoods">Selecione os bairros:</label>
        <?php foreach ($neighborhoods as $neighborhood): 
            $checked = (isset($customerInterest['desired_neighborhoods']) && in_array($neighborhood, json_decode($customerInterest['desired_neighborhoods']))) ? 'checked' : '';    
        ?>
        <div class="form-check">
            <input <?= $checked ?> class="form-check-input" type="checkbox" name="desired_neighborhoods[]" value="<?= $neighborhood ?>" id="<?= str_replace(' ', '', $neighborhood) ?>">
            <label class="form-check-label" for="<?= str_replace(' ', '', $neighborhood) ?>"><?= $neighborhood ?></label>
        </div>
    <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-success">Salvar Interesse de Cliente</button>
</form>
<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>