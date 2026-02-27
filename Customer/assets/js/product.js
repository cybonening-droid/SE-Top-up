const payments = document.querySelectorAll(".se-payment-card");
const packages = document.querySelectorAll(".se-package-card");

const productPriceEl = document.getElementById("productPrice");
const totalPriceEl   = document.getElementById("totalPrice");
const continueBtn    = document.getElementById("continueBtn");

let selectedPrice = 0;
let selectedPayment = null;
let discount = 0;

// ===== FORMAT MONEY =====
function formatMoney(num){
  return num.toLocaleString("th-TH");
}

// ===== UPDATE TOTAL =====
function updateTotal(){
  const total = selectedPrice - discount;

  if(productPriceEl) productPriceEl.innerText = formatMoney(selectedPrice);
  if(totalPriceEl) totalPriceEl.innerText = formatMoney(total);

  // enable ปุ่มเมื่อครบ
  if(selectedPrice > 0 && selectedPayment){
    continueBtn?.removeAttribute("disabled");
  }else{
    continueBtn?.setAttribute("disabled",true);
  }
}

// ===== PAYMENT =====
payments.forEach(card=>{
  card.addEventListener("click",()=>{
    payments.forEach(c=>c.classList.remove("active"));
    card.classList.add("active");

    selectedPayment = card.dataset.payment;
    updateTotal();
  });
});

// ===== PACKAGE =====
packages.forEach(card=>{
  card.addEventListener("click",()=>{
    packages.forEach(c=>c.classList.remove("active"));
    card.classList.add("active");

    selectedPrice = parseInt(card.dataset.price);
    updateTotal();
  });
});

// ===== DISCOUNT (ถ้ามีช่องกรอก) =====
const discountInput = document.getElementById("discountInput");
const applyBtn = document.getElementById("applyDiscount");

applyBtn?.addEventListener("click",()=>{
  const value = discountInput.value.trim();

  if(value === "SE2026"){
    discount = 20; // ลด 20 บาท
  }else{
    discount = 0;
  }

  updateTotal();
});