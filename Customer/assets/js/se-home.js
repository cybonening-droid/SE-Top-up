document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("seSearchBtn");
  const input = document.getElementById("seSearchInput");
  if (!btn) return;

  btn.addEventListener("click", () => {
    const q = input ? input.value.trim() : "";
    alert(`Search now (placeholder): ${q || "(empty)"}`);
  });
});
