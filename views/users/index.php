<?php require __DIR__ . "/../layouts/header.php"; ?>

<div style="max-width: 900px; margin: 20px auto; font-family: Arial, sans-serif;">
    <h2>Listado de Materias Registradas</h2>

    <!-- Botón visible solo para Administradores -->
    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
        <a href="index.php?action=create" style="display: inline-block; background: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; margin-bottom: 15px; font-weight: bold;">
            + Agregar Nueva Materia
        </a>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
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
                        <td><?= htmlspecialchars($m['idMateria']) ?></td>
                        <td><?= htmlspecialchars($m['nombre']) ?></td>
                        <td><?= htmlspecialchars($m['año']) ?></td>
                        <td><?= htmlspecialchars($m['estado_nombre']) ?></td>
                        
                        <!-- Columna de Acciones solo para Administradores -->
                        <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                            <td>
                                <a href="index.php?action=edit&id=<?= $m['idMateria'] ?>" style="color: #007bff; text-decoration: none; font-weight: bold; margin-right: 10px;">
                                    ✏️ Editar
                                </a>
                                <a href="index.php?action=delete&id=<?= $m['idMateria'] ?>" onclick="return confirm('¿Desea cambiar el estado de la materia a inactivo?');" style="color: #dc3545; text-decoration: none; font-weight: bold;">
                                    🗑️ Eliminar
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= ($_SESSION['usuario_rol'] === 'admin') ? '5' : '4' ?>" style="text-align: center;">No hay materias activas disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>