// Line Chart
var ctx = document.getElementById("earningChart").getContext("2d");

new Chart(ctx, {
  type: "line",
  data: {
    labels: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
    datasets: [{
      label: "Earning",
      data: [200,400,300,500,700,600,800],
      borderColor: "#0171F9",
      borderWidth: 3,
      fill: false
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});

// Pie Chart
var pieCtx = document.getElementById("gamePieChart").getContext("2d");

new Chart(pieCtx, {
  type: "pie",
  data: {
    labels: ["Valorant","Free Fire","RoV","Genshin"],
    datasets: [{
      data: [40,25,20,15],
      backgroundColor: ["#0171F9","#0171F9","#0171F9","#0171F9"]
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});
