<h1>Mes Notes</h1>

<form method="POST">
    <textarea name="description" required placeholder="Écrire une note"></textarea>
    <br><br>
    <button type="submit" name="ajouter">Enregistrer</button>
</form>

<hr>

<?php if (!empty($notes)): ?>
    <?php foreach ($notes as $note): ?>
        <div>
            <p><?= htmlspecialchars($note['description']) ?></p>
            <small><?= $note['date'] ?></small>

            <form method="POST">
                <input type="hidden" name="id_note" value="<?= $note['id'] ?>">
                <button type="submit" name="supprimer">Supprimer</button>
            </form>
            <hr>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune note enregistrée.</p>
<?php endif; ?>
