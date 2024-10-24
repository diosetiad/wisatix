const bookingIdContainer = document.getElementById("booking-id-container");
const bookingId = document.getElementById("booking-id").innerText;
const flashMessage = document.getElementById("flash-message");

bookingIdContainer.addEventListener("click", () => {
    navigator.clipboard.writeText(bookingId);

    flashMessage.classList.remove("hidden");
    setTimeout(() => {
        flashMessage.classList.add("hidden");
    }, 1500);
});
