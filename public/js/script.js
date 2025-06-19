/**
 * Fonction de recherche en temps réel
 */
let lastSearchValue = ""; // Dernière valeur de recherche
let activeRequestId = 0; // Identifiant pour les requêtes actives

async function searchBar() {
    const searchBar = document.querySelector("#search");
    const popup = document.querySelector("#popup"); // Conteneur des résultats

    // Si la recherche est vide, cacher la pop-up et sortir
    if (searchBar.value.trim() === "") {
        popup.style.display = "none";
        popup.innerHTML = ""; // Nettoyer les résultats pour éviter une pop-up vide persistante
        lastSearchValue = ""; // Réinitialiser la dernière valeur pour éviter les blocages
        return;
    }

    // Mettre à jour l'identifiant de requête active
    const currentRequestId = ++activeRequestId;

    // Afficher un message de chargement
    popup.style.display = "block";
    popup.innerHTML = "<p>Chargement...</p>"; // Indication visuelle

    // Faire une requête de recherche
    try {
        const response = await fetch('?action=search&search=' + encodeURI(searchBar.value));
        const data = await response.json();

        // Ignorer cette requête si elle n'est plus active
        if (currentRequestId !== activeRequestId) {
            return;
        }

        // Nettoyer le contenu précédent
        popup.innerHTML = "";

        // Si aucune donnée trouvée, cacher les résultats
        if (!data || data.length === 0) {
            popup.style.display = "none";
            return;
        }

        // Créer une structure pour chaque résultat
        data.forEach((element) => {
            const unitContainer = document.createElement("div");
            unitContainer.setAttribute("class", "unit-container");

            const img = document.createElement("img");
            img.setAttribute("src", '/TPweb/TFT/2024-2025-R3-01-B1-CHARLET/public/img/characters/' + element.url_img);
            img.setAttribute("alt", element.name);
            img.setAttribute("class", "unit-image");

            const details = document.createElement("div");
            details.setAttribute("class", "unit-details");
            details.innerHTML = `
                <p><strong>Nom :</strong> ${element.name}</p>
                <p><strong>Origine :</strong> ${element.origin}</p>
                <p><strong>Coût :</strong> ${element.cost}</p>
            `;

            unitContainer.appendChild(img);
            unitContainer.appendChild(details);
            popup.appendChild(unitContainer);
        });
    } catch (error) {
        console.error("Erreur lors de la recherche :", error);

        // Cacher la pop-up en cas d'erreur
        popup.style.display = "none";
    }
}

// Masquer les résultats lorsqu'on clique en dehors de la div
document.addEventListener("click", function (event) {
    const popup = document.querySelector("#popup");
    const searchBar = document.querySelector("#search");

    // Si le clic est en dehors de la barre de recherche et des résultats
    if (!popup.contains(event.target) && event.target !== searchBar) {
        popup.style.display = "none"; // Masquer les résultats
    }
});

// Ajouter l'événement 'input' au champ de recherche
document.querySelector("#search").addEventListener("input", searchBar);


// Ouvrir la pop-up
function openPopup() {
    const popup = document.querySelector('.popup-container');
    popup.style.display = 'block'; // Affiche la pop-up

    // Optionnel : Ajout d'une animation fluide pour l'ouverture
    popup.style.opacity += 0;
    popup.style.transition = 'opacity 0.5s'; // Transition fluide
    setTimeout(() => {
        popup.style.opacity = 1; // Rendre la pop-up complètement visible après 0.5s
    }, 10);
}


// Fermer la pop-up
function closePopup() {
    const popup = document.querySelector('.popup-container');

    // Optionnel : Ajout d'une animation fluide pour la fermeture
    popup.style.opacity = 0;
    popup.style.transition = 'opacity 0.5s'; // Transition fluide
    setTimeout(() => {
        popup.style.display = 'none'; // Cache la pop-up après la transition
    }, 500); // Délai de 0.5s pour attendre que la transition se termine
}

function initFormValidation() {
    const form = document.querySelector('form');
    const name = document.getElementById('name');
    const cost = document.getElementById('cost');
    const origin = document.getElementById('origin');
    const fileInput = document.getElementById('url_img');
    const submitButton = form.querySelector('button[type="submit"]');

    // Fonction pour activer ou désactiver le bouton de soumission
    function validateForm() {
        const isFormValid = name.value.trim() !== '' && cost.value.trim() !== '' && origin.value.trim() !== '' && fileInput.files.length > 0;
        submitButton.disabled = !isFormValid;
    }

    // Écoute des événements sur les champs de texte et fichier
    name.addEventListener('input', validateForm);
    cost.addEventListener('input', validateForm);
    origin.addEventListener('input', validateForm);
    fileInput.addEventListener('change', validateForm);

    // Effet de survol sur le champ de fichier
    fileInput.addEventListener('mouseover', () => {
        fileInput.style.boxShadow = '0 0 10px greenyellow, 0 0 20px purple';
    });
    fileInput.addEventListener('mouseout', () => {
        fileInput.style.boxShadow = 'none';
    });

    // Initial validation pour désactiver le bouton au début si nécessaire
    validateForm();
}

// Appeler la fonction une fois que la page est prête
document.addEventListener('DOMContentLoaded', initFormValidation);