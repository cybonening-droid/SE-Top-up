const cards = document.querySelectorAll(".se-card-item");
const buttons = document.querySelectorAll(".se-filter-btn");
const pagination = document.querySelector(".se-pagination");

let currentCategory = "game";
let currentPage = 1;
const perPage = 8;

function getFiltered() {
  if(currentCategory === "game") return Array.from(cards);

  return Array.from(cards).filter(card =>
    card.dataset.category.includes(currentCategory)
  );
}

function showCards() {
  const filtered = getFiltered();
  cards.forEach(card => card.style.display = "none");

  const start = (currentPage - 1) * perPage;
  const end = start + perPage;

  filtered.slice(start,end).forEach(card=>{
    card.style.display = "block";
  });
}

function createPagination() {
  const filtered = getFiltered();
  const totalPages = Math.ceil(filtered.length / perPage);

  pagination.innerHTML = "";

  for(let i=1;i<=totalPages;i++){
    const btn = document.createElement("button");
    btn.innerText = i;
    if(i===currentPage) btn.classList.add("active");

    btn.onclick = ()=>{
      currentPage = i;
      update();
    };

    pagination.appendChild(btn);
  }
}

function update(){
  showCards();
  createPagination();
}

buttons.forEach(btn=>{
  btn.onclick = ()=>{
    buttons.forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");

    currentCategory = btn.dataset.category;
    currentPage = 1;

    update();
  }
});

update();