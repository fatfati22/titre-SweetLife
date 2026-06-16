<!-- 
 -->

<form class="modal-carte" id="modal-carte" action="index.php?route=note" method="POST">
    <div class="emotion" id="modal-emoji">😊</div>

    <h1 class="titre">Comment tu te sens ?</h1>

    <p class="texte-info">
        Ajoute une note sur ce qui se passe (10 caractères minimum)
    </p>

    <textarea
        name="description"
        class="zone-message"
        id="modal-textarea"
        placeholder="Que se passe-t-il en ce moment ?"
        maxlength="300"></textarea>

    <div class="compteur" id="modal-compteur">0/300</div>

    <div class="zone-boutons">
        <button
            type="button"
            class="bouton-annuler"
            onclick=" annulerNote()">
            Annuler
        </button>

        <button
            method="POST"
            name="ajouter"
            type="submit"
            class="bouton-enregistrer"
            id="btn-enregistrer">
            Enregistrer 🔃
        </button>
    </div>
</form>