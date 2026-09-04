<?php require __DIR__ . "/../layouts/header.php"; ?>

<div>
    <h2>Administración de Usuarios</h2>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'self_role'): ?>
        <div class="error-msg">
            No puedes cambiar tu propio rol.
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
                            <form action="index.php?action=changeRole" method="POST" >
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <?php if($u['id']!==1):?>    
                                    <select name="rol" >
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
                                <?php endif; ?>
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