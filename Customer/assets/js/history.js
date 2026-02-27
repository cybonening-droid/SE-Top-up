/* =========================
   MOCK DATA
========================= */
const data = [
  {
    date: "19/09/2025 07:27:40",
    order: "#1234",
    uid: "PunnInwZa#007",
    orderType: "เติมเกม",
    category: "valorant",
    product: "Valorant",
    detail: "2050 VP",
    price: 489.28,
    status: "success"
  },
  {
    date: "01/09/2025 12:06:02",
    order: "#1235",
    uid: "PunnInwZa#007",
    orderType: "เติมเกม",
    category: "valorant",
    product: "Valorant",
    detail: "2050 VP",
    price: 489.28,
    status: "cancel"
  },
  {
    date: "17/08/2025 10:41:33",
    order: "#1236",
    uid: "User#009",
    orderType: "เติมเกม",
    category: "rov",
    product: "ROV",
    detail: "450 Diamonds",
    price: 299.00,
    status: "success"
  }
];


/* =========================
   CONFIG
========================= */
let currentPage = 1;
const perPage = 5;


/* =========================
   RENDER TABLE
========================= */
function renderTable(list) {
  const table = document.getElementById("historyTable");
  table.innerHTML = "";

  const start = (currentPage - 1) * perPage;
  const end = start + perPage;
  const pageData = list.slice(start, end);

  pageData.forEach(d => {
    const tr = document.createElement("tr");

    tr.innerHTML = `
      <td>${d.date}</td>
      <td>${d.order}</td>
      <td>${d.uid}</td>
      <td>${d.orderType}</td>
      <td>${d.product}</td>
      <td>${d.detail}</td>
      <td>฿${d.price.toFixed(2)}</td>
      <td>
        <span class="${d.status === "success" ? "se-status-success" : "se-status-cancel"}">
          ${d.status === "success" ? "สำเร็จ" : "ยกเลิก"}
        </span>
      </td>
    `;

    table.appendChild(tr);
  });

  renderPagination(list.length);
}


/* =========================
   PAGINATION
========================= */
function renderPagination(total) {
  const pageCount = Math.ceil(total / perPage);
  const pag = document.querySelector(".se-pagination");
  pag.innerHTML = "";

  if (pageCount <= 1) return;

  for (let i = 1; i <= pageCount; i++) {
    const btn = document.createElement("button");
    btn.innerText = i;

    if (i === currentPage) {
      btn.classList.add("active");
    }

    btn.onclick = () => {
      currentPage = i;
      applyFilters();
    };

    pag.appendChild(btn);
  }
}


/* =========================
   FILTER + SORT
========================= */
function applyFilters() {
  let filtered = [...data];

  const search = document.getElementById("searchInput").value.toLowerCase();
  const cat = document.getElementById("categoryFilter").value;
  const sort = document.getElementById("sortBy").value;

  // search
  if (search) {
    filtered = filtered.filter(d =>
      d.order.toLowerCase().includes(search) ||
      d.uid.toLowerCase().includes(search)
    );
  }

  // category
  if (cat !== "all") {
    filtered = filtered.filter(d => d.category === cat);
  }

  // sort
  if (sort === "date_desc")
    filtered.sort((a, b) => new Date(b.date) - new Date(a.date));

  if (sort === "date_asc")
    filtered.sort((a, b) => new Date(a.date) - new Date(b.date));

  if (sort === "price_desc")
    filtered.sort((a, b) => b.price - a.price);

  if (sort === "price_asc")
    filtered.sort((a, b) => a.price - b.price);

  renderTable(filtered);
}


/* =========================
   EVENTS
========================= */
document.getElementById("searchInput").addEventListener("input", () => {
  currentPage = 1;
  applyFilters();
});

document.getElementById("categoryFilter").addEventListener("change", () => {
  currentPage = 1;
  applyFilters();
});

document.getElementById("sortBy").addEventListener("change", () => {
  currentPage = 1;
  applyFilters();
});


/* =========================
   INIT
========================= */
applyFilters();