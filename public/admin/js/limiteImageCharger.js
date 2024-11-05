
document.getElementById('multiImages').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const files = event.target.files;
    const preview = document.getElementsByClassName('preview-img');

    // Réinitialiser la zone de prévisualisation
    preview.innerHTML = '';

    // Vérifier si le nombre de fichiers est supérieur à 5
    if (files.length > 10) {
        alert("Vous ne pouvez selectionner au plus 10 images. \n Merci de réessayer svp !");
        event.target.value = '';
        return;
    }

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            const image = document.createElement('img');
            image.src = e.target.result;
            image.style.maxWidth = '200px';
            image.style.maxHeight = '200px';
            preview.appendChild(image);
        };

        reader.readAsDataURL(file);
    }
}
