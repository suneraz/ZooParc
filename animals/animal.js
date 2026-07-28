document.addEventListener("DOMContentLoaded", function() {
    const viewMoreButtons = document.querySelectorAll('.view-more');

    viewMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const animalCard = this.closest('.animal-card');
            
            // Close all other cards
            document.querySelectorAll('.animal-card').forEach(card => {
                if (card !== animalCard) {
                    card.classList.remove('show-details');
                }
            });

            // Toggle the clicked card
            animalCard.classList.toggle('show-details');
        });
    });
});
