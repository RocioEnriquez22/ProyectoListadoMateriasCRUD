<?php require __DIR__ . "/../layouts/header.php"; ?>

<div style="max-width: 500px; margin: 30px auto; font-family: Arial, sans-serif; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2>Agregar Nueva Materia</h2>

    <form action="index.php?action=store" method="POST">
        <div style="margin-bottom: 15px;">
            <label for="nombre" style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre de la Materia:</label>
            <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="año" style="display: block; font-weight: bold; margin-bottom: 5px;">Año:</label>
            <input type="number" id="año" name="año" required placeholder="Ej: 2026" style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="idEstado" style="display: block; font-weight: bold; margin-bottom: 5px;">Estado:</label>
            <select id="idEstado" name="idEstado" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Seleccionar Estado --</option>
                <?php if (!empty($estados)): ?>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= $estado['idEstado'] ?>">
                            <?= htmlspecialchars($estado['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1">Cursando</option>
                    <option value="2">Aprobada</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">
            Guardar Materia
        </button>
    </form>

    <br>
    <a href="index.php?action=index" style="display: block; text-align: center; color: #007bff; text-decoration: none;">⬅️ Volver al listado</a>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>