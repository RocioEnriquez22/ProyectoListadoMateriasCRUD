<?php require __DIR__ . "/../layouts/header.php"; ?>

<div class="div-listaMaterias">
    <h2 class="lista">Listado de Materias</h2>

    <table class="tabla-materias table table-ligth table-striped" >
        <thead>
            <tr>
                <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                    <th>ID</th>
                <?php endif; ?>
                <th>Nombre</th>
                <th>Año</th>
                <th>Estado</th>
                <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($materias)): ?>
                <?php foreach ($materias as $m): ?>
                    <tr>
                        <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                            <td><?= htmlspecialchars($m['idMateria']) ?></td>
                        <?php endif; ?>
                        
                        <td><?= htmlspecialchars($m['nombre']) ?></td>
                        <td><?= htmlspecialchars($m['año']) ?></td>
                        <td><?= htmlspecialchars($m['estado_nombre']) ?></td>
                        
                        <!-- Columna de Acciones solo para Administradores -->
                        <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                            <td>
                                <a href="index.php?action=edit&id=<?= $m['idMateria'] ?>" class="btn-accion btn-editar">
                                    ✏️ Editar
                                </a>
                                <a href="index.php?action=delete&id=<?= $m['idMateria'] ?>" class="btn-accion btn-eliminar" onclick="return confirm('¿Desea realmente eliminar esta materia?');">
                                    🗑️ Eliminar 
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= ($_SESSION['usuario_rol'] === 'admin') ? '5' : '4' ?>" style="text-align: center;">No se han agregado materias aun.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- Botón visible solo para Administradores -->
    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
        <a href="index.php?action=create" class="btn-agregar-materia btn-modal" >
            + Agregar Nueva Materia
        </a>
    <?php endif; ?>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>