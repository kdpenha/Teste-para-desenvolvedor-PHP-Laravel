<?php ob_start(); ?>
<h1 class="mb-4">Imóveis recomendados de acordo com seus interesses</h1>

<div class="d-flex gap-3">
    <a href="<?= route('/customer-interests/edit', ['id' => $_GET['interestId']]) ?>" class="btn btn-primary mb-3">Voltar para cliente</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Bairro</th>
            <th>Quartos</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($properties as $property): ?>
            <tr>
                <td><?= htmlspecialchars($property['id']) ?></td>
                <td><?= htmlspecialchars($property['name']) ?></td>
                <td><?= htmlspecialchars($property['property_type']) ?></td>
                <td><?= htmlspecialchars($property['neighborhood']) ?></td>
                <td><?= htmlspecialchars($property['number_of_rooms']) ?></td>
                <td>R$ <?= number_format($property['price'], 2, ',', '.') ?></td>
                <td>
                    <a href="<?= route('/properties/edit', ['id' => $property['id']]) ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="/properties/delete?id=<?= $property['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($properties)): ?>
    <div class="alert alert-info">Nenhum imóvel cadastrado.</div>
<?php endif; ?>
</div>

<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>