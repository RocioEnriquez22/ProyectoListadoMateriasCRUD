<?php require __DIR__ . "/../layouts/header.php"; ?>

<div class="div-crear-mat">
    <h2>Agregar Nueva Materia</h2>

    <form action="index.php?action=store" method="POST">
        <div class=input-form>
            <label for="nombre">Nombre de la Materia:</label>
            <input type="text" id="nombre" name="nombre" required >
        </div>

        <div class=input-form>
            <label for="año">Año:</label>
            <input type="number" id="año" name="año" required placeholder="Ej: 2026">
            <small id="error-año" style="display:none;"></small>
        </div>

        <div class=input-form>
            <label for="idEstado" >Estado:</label>
            <select id="idEstado" name="idEstado" required>
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

        <button type="submit" class="btn-modal">
            Guardar Materia
        </button>
    </form>

    <br>
    <a href="index.php?action=index" >⬅️ Volver al listado</a>
</div>

<script src="JS/materia-validacion.js"></script>
<?php require __DIR__ . "/../layouts/footer.php"; ?>