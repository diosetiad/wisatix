const plus = document.getElementById("plus");
const minus = document.getElementById("minus");
const text = document.getElementById("count-text");
const people = document.getElementById("people");
const totalPriceElement = document.getElementById("total-price");
const ticketPrice = document.getElementById("ticket-price");
const subTotal = document.getElementById("sub-total");
const inputTotalVAT = document.getElementById("total-vat");
const totalAmount = document.getElementById("total-amount");

const pricePerItem = ticketPrice.value;

function formatRupiah(number) {
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateTotalPrice() {
    let currentValue = parseInt(people.value);
    let totalPrice = currentValue * pricePerItem;
    const vat = 0.11;
    const totalVAT = totalPrice * vat;
    const grandTotalPrice = totalPrice + totalVAT;
    totalPriceElement.textContent = formatRupiah(grandTotalPrice);

    subTotal.value = totalPrice;
    inputTotalVAT.value = totalVAT;
    totalAmount.value = grandTotalPrice;
}

let currentValue = parseInt(people.value);
text.textContent = currentValue;

plus.addEventListener("click", () => {
    currentValue++;
    people.value = currentValue;
    text.textContent = currentValue;
    updateTotalPrice();
});

minus.addEventListener("click", () => {
    if (currentValue > 1) {
        currentValue--;
        people.value = currentValue;
        text.textContent = currentValue;
        updateTotalPrice();
    }
});

updateTotalPrice();
