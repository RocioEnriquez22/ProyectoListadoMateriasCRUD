<?php require __DIR__ . "/../layouts/header.php"; ?>

<div class="div-editar-mat">
    <h2>Editar Materia id: <?= htmlspecialchars($materia['idMateria']) ?></h2>

    <form id="form-edicion" action="index.php?action=update" method="POST">
        <!-- Campo oculto para enviar el ID de la materia que se va a actualizar -->
        <input type="hidden" name="idMateria" value="<?= htmlspecialchars($materia['idMateria']) ?>">

        <div class="input-form">
            <label for="nombre" >Nombre de la Materia:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($materia['nombre']) ?>" required >
        </div>

        <div class="input-form">
            <label for="año" >Año:</label>
            <input type="number" id="año" name="año" value="<?= htmlspecialchars($materia['año']) ?>" required >
            <small id="error-año" style="display:none;"></small>
        </div>

        <div class="input-form">
            <label for="idEstado" >Estado:</label>
            <select id="idEstado" name="idEstado" required >
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

        <button type="submit" class="btn-modal">
            Guardar Cambios
        </button>
    </form>

    <br>
    <a href="index.php?action=index" >⬅️ Cancelar y volver al listado</a>
</div>


<script src="JS/materia-validacion.js"></script>
<?php require __DIR__ . "/../layouts/footer.php"; ?>