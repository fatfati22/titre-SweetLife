function ouvrirModal() {
  document.getElementById('modal-note')?.classList.add('actif');
}

function fermerModal(event) {
  const modal = document.getElementById('modal-note');

  if (event && event.target !== modal) {
    return;
  }

  modal?.classList.remove('actif');

  if (typeof restaurerThemePrecedent === 'function') {
    restaurerThemePrecedent();
  }
}

function annulerNote() {
  document.getElementById('modal-note')?.classList.remove('actif');

  if (typeof restaurerThemePrecedent === 'function') {
    restaurerThemePrecedent();
  }

  const textarea = document.getElementById('modal-textarea');
  const compteur = document.getElementById('modal-compteur');

  if (textarea) textarea.value = '';
  if (compteur) compteur.textContent = '0/300';
}

function enregistrerNote() {
  const textarea = document.getElementById('modal-textarea');

  if (!textarea) return;

  const texte = textarea.value.trim();

  if (texte.length < 3) {
    textarea.classList.add('erreur');

    setTimeout(() => {
      textarea.classList.remove('erreur');
    }, 500);

    return;
  }

  const formData = new FormData();

  formData.append('ajouter', '1');
  formData.append('description', texte);

  const inputHumeur = document.getElementById('modal-id-humeur');
  if (inputHumeur?.value) {
    formData.append('id_humeur', inputHumeur.value);
  }

  fetch('index.php?route=note', {
    method: 'POST',
    body: formData,
  })
    .then((response) => {
      if (response.ok) {
        if (typeof validerThemeSelectionne === 'function') {
          validerThemeSelectionne();
        }

        document.getElementById('modal-note')?.classList.remove('actif');
        location.reload();
      } else {
        alert('Erreur lors de l’enregistrement');
      }
    })
    .catch(() => {
      alert('Erreur réseau');
    });
}

document.addEventListener('input', function (e) {
  if (e.target.id === 'modal-textarea') {
    const compteur = document.getElementById('modal-compteur');

    if (compteur) {
      compteur.textContent = e.target.value.length + '/300';
    }
  }
});

document.addEventListener('submit', function (e) {
  if (e.target.id === 'modal-carte') {
    const textarea = document.getElementById('modal-textarea');
    const texte = textarea?.value.trim() || '';

    if (texte.length < 3) {
      e.preventDefault();
      textarea?.classList.add('erreur');

      setTimeout(() => {
        textarea?.classList.remove('erreur');
      }, 500);

      return;
    }

    if (typeof validerThemeSelectionne === 'function') {
      validerThemeSelectionne();
    }
  }
});

document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    document.getElementById('modal-note')?.classList.remove('actif');

    if (typeof restaurerThemePrecedent === 'function') {
      restaurerThemePrecedent();
    }
  }
});
