document.addEventListener("DOMContentLoaded", function () {
    console.log("Aplikasi Sajadah Waktu berhasil dimuat.");

    // Menandai kartu sholat saat diklik
    const cards = document.querySelectorAll(".card");
    
    cards.forEach(card => {
        card.addEventListener("click", function () {
            cards.forEach(c => c.style.borderColor = "#e9ecef");
            this.style.borderColor = "#16a085";
        });
    });
});