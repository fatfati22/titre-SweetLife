<!-- 
 -->

<form class="modal-carte" id="modal-carte" action="index.php?route=note" method="POST">
    <div class="emotion" id="modal-emoji">😊</div>
    <input type="hidden" name="id_humeur" id="modal-id-humeur" value="">

    <h1 class="note-title">Comment tu te sens ?</h1>

    <p class="note-info-text">
        Ajoute une note sur ce qui se passe (10 caractères minimum)
    </p>

    <textarea
        name="description"
        class="note-message-zone"
        id="modal-textarea"
        placeholder="Que se passe-t-il en ce moment ?"
        maxlength="300"></textarea>

    <div class="note-counter" id="modal-compteur">0/300</div>

    <div class="note-buttons-zone">
        <button
            type="button"
            class="note-button bouton-annuler"
            onclick=" annulerNote()">
            Annuler
        </button>

        <button
            method="POST"
            name="ajouter"
            value="1"
            type="submit"
            class="note-button bouton-enregistrer"
            id="btn-enregistrer">
            Enregistrer 🔃
        </button>
    </div>
</form>
