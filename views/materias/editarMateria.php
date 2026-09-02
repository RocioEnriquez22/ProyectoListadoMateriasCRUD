<?php require __DIR__ . "/../layouts/header.php"; ?>

<div style="max-width: 500px; margin: 30px auto; font-family: Arial, sans-serif; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2>Editar Materia #<?= htmlspecialchars($materia['idMateria']) ?></h2>

    <form action="index.php?action=update" method="POST">
        <!-- Campo oculto para enviar el ID de la materia que se va a actualizar -->
        <input type="hidden" name="idMateria" value="<?= htmlspecialchars($materia['idMateria']) ?>">

        <div style="margin-bottom: 15px;">
            <label for="nombre" style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre de la Materia:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($materia['nombre']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="año" style="display: block; font-weight: bold; margin-bottom: 5px;">Año:</label>
            <input type="number" id="año" name="año" value="<?= htmlspecialchars($materia['año']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="idEstado" style="display: block; font-weight: bold; margin-bottom: 5px;">Estado:</label>
            <select id="idEstado" name="idEstado" required style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                <?php if (!empty($estados)): ?>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= $estado['idEstado'] ?>" <?= ($estado['idEstado'] == $materia['idEstado']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($estado['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1" <?= ($materia['idEstado'] == 1) ? 'selected' : '' ?>>Cursando</option>
                    <option value="2" <?= ($materia['idEstado'] == 2) ? 'selected' : '' ?>>Aprobada</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">
            Guardar Cambios
        </button>
    </form>

    <br>
    <a href="index.php?action=index" style="display: block; text-align: center; color: #6c757d; text-decoration: none;">⬅️ Cancelar y volver al listado</a>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>