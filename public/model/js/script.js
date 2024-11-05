document.addEventListener('DOMContentLoaded', () => {
    const scrollUpButton = document.querySelector('.scroll-up');
    const scrollDownButton = document.querySelector('.scroll-down');
    const eventsList = document.querySelector('.events-list');

    scrollUpButton.addEventListener('click', () => {
      eventsList.scrollBy({ top: -100, behavior: 'smooth' }); // La valeur peut être ajustée
    });

    scrollDownButton.addEventListener('click', () => {
      eventsList.scrollBy({ top: 100, behavior: 'smooth' }); // La valeur peut être ajustée
    });
  });


// Accordion

document.addEventListener("DOMContentLoaded", function() {
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach(item => {
        const header = item.querySelector(".accordion-header");
        const content = item.querySelector(".accordion-content");
        const icon = item.querySelector(".accordion-icon");

        header.addEventListener("click", function() {
            accordionItems.forEach(item => {
                if (item !== this.parentNode) {
                    item.querySelector(".accordion-content").style.display = "none";
                    item.querySelector(".accordion-icon").innerText = "+";
                }
            });

            if (content.style.display === "block") {
                content.style.display = "none";
                content.style.transition = "0.5s fade-out";
                icon.innerText = "+";
            } else {
                content.style.display = "block";
                icon.innerText = "-";
            }

            if (content.style.display === "block") {
                header.style.color = 'blue';
            }else
            {
                header.style.color = 'black';
            }
            
        });
    });
});
