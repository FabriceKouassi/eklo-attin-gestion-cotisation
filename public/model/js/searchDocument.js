
document.getElementById('search').addEventListener('change', function() {
    var selectedValue = this.value;
    var route = this.dataset.route; // Récupérer l'URL à partir de l'attribut de données

    console.log(selectedValue)

    if (selectedValue) {

        const certificat_card_distant = document.getElementById('card_certificat_distant')

        localStorage.setItem('certificat_card_distant', certificat_card_distant)
        localStorage.setItem('certificat', selectedValue)
        let getLocalStorageValue = localStorage.getItem('certificat')

        if (selectedValue == 'certificat-distant-signe') {
            window.location.href = route + "?certificat=" + selectedValue + "&type-de-certificat=all" ;
            document.querySelector(".search_type_certificat").disabled = false;
            document.querySelector(".search_type_certificat_btn").disabled = false;
        }

        if (selectedValue !== 'certificat-distant-signe') {
            window.location.href = route + "?certificat=" + selectedValue;
        }

    } else {
        window.location.href = route + ""
    }
});

document.getElementById('search_type_certificat').addEventListener('change', function() {
    var selectedValue2 = this.value;
    var route = this.dataset.route; // Récupérer l'URL à partir de l'attribut de données

    console.log(selectedValue2)

    if (selectedValue2) {

        const certificat_normal = document.getElementById('card_certificat_normal')

        localStorage.setItem('certificat_normal', certificat_normal)
        localStorage.setItem('type-de-certificat', selectedValue2)
        let getLocalStorageValue = localStorage.getItem('type-de-certificat')

        if (selectedValue2 == 'certificat-distant-signe') {
            document.querySelector(".search_type_certificat").disabled = false;
            document.querySelector(".search_type_certificat_btn").disabled = false;
        }

        if (selectedValue2 !== 'certificat-distant-signe') {
            window.location.href = route + "?certificat=" + document.getElementById('search').value + "&type-de-certificat=" + selectedValue2;
        }

    } else {
        window.location.href = route + ""
    }
});
