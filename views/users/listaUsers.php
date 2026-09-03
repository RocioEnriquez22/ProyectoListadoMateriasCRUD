<?php require __DIR__ . "/../layouts/header.php"; ?>

<div>
    <h2>Administración de Usuarios</h2>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'self_role'): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            ⚠️ No puedes cambiar tu propio rol mientras tienes la sesión activa.
        </div>
    <?php endif; ?>

    <table class="tabla-users table table-ligth table-striped" >
        <thead>
            <tr >
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Rol Actual</th>
                <th>Cambiar Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['firstname'] . ' ' . $u['lastname']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td>
                            <strong style="color: <?= ($u['rol'] === 'admin') ? '#28a745' : '#007bff' ?>;">
                                <?= htmlspecialchars(strtoupper($u['rol'])) ?>
                            </strong>
                        </td>
                        <td>
                            <form action="index.php?action=changeRole" method="POST" style="display: flex; gap: 8px; align-items: center; margin: 0;">
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <select name="rol" style="padding: 4px 8px; border-radius: 4px; border: 1px solid #ccc;">
                                    <option value="usuario" <?= ($u['rol'] === 'usuario') ? 'selected' : '' ?>>Usuario Común</option>
                                    <option value="admin" <?= ($u['rol'] === 'admin') ? 'selected' : '' ?>>Administrador</option>
                                </select>
                                <button type="submit" class="btn-accion btn-editar" style="border:none">
                                    Guardar
                                </button>
                                <a href="index.php?action=deleteUser&id=<?= $u['id'] ?>" 
                               onclick="return confirm('¿Seguro que deseas eliminar a este usuario definitivamente?');" 
                               class="btn-accion btn-eliminar">Eliminar
                            </a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php?action=index" class="btn-accion btn-editar" style="padding:0.8rem;margin-left:1.5rem;">⬅️ Volver al listado de materias</a>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>