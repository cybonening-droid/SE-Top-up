const cards = document.querySelectorAll(".se-card-item");
const buttons = document.querySelectorAll(".se-filter-btn");
const pagination = document.querySelector(".se-pagination");

let currentCategory = "coupon";
let currentPage = 1;
const perPage = 8;

function getFiltered() {
  return Array.from(cards).filter(card =>
    card.dataset.category === currentCategory
  );
}

function showCards() {
  const filtered = getFiltered();

  cards.forEach(card => card.style.display = "none");

  const start = (currentPage - 1) * perPage;
  const end = start + perPage;

  filtered.slice(start, end).forEach(card => {
    card.style.display = "block";
  });
}

function createPagination() {
  const filtered = getFiltered();
  const totalPages = Math.ceil(filtered.length / perPage);

  pagination.innerHTML = "";

  // prev
  const prev = document.createElement("button");
  prev.innerHTML = "‹";
  prev.onclick = () => {
    if (currentPage > 1) {
      currentPage--;
      update();
    }
  };
  pagination.appendChild(prev);

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.innerText = i;

    if (i === currentPage) btn.classList.add("active");

    btn.onclick = () => {
      currentPage = i;
      update();
    };

    pagination.appendChild(btn);
  }

  // next
  const next = document.createElement("button");
  next.innerHTML = "›";
  next.onclick = () => {
    if (currentPage < totalPages) {
      currentPage++;
      update();
    }
  };
  pagination.appendChild(next);
}

function update() {
  showCards();
  createPagination();
}

buttons.forEach(btn => {
  btn.onclick = () => {
    buttons.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    currentCategory = btn.dataset.category;
    currentPage = 1;

    update();
  };
});

update();