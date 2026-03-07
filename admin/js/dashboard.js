console.log("Revenue Data:", revenueData);
console.log("Game Revenue:", gameRevenue);

/* ===== Revenue Chart ===== */

var ctx = document.getElementById("earningChart");

if(ctx && revenueData.length){

const revenueLabels = revenueData.map(r =>
 new Date(r.day).toLocaleDateString("en-US",{weekday:"short"})
);

const revenueValues = revenueData.map(r => r.revenue);

window.revenueChart = new Chart(ctx,{

type:"line",

data:{
labels:revenueLabels,
datasets:[{
label:"Revenue",
data:revenueValues,
borderColor:"#0171F9",
backgroundColor:"rgba(1,113,249,0.1)",
borderWidth:3,
tension:0.3,
fill:true,
pointRadius:4
}]
},

options:{
responsive:true,
maintainAspectRatio:false
}

});

}

/* ===== Pie Chart ===== */

var pieCtx = document.getElementById("gamePieChart");

if(pieCtx && gameRevenue.length){

const gameLabels = gameRevenue.map(g => g.name);
const gameValues = gameRevenue.map(g => g.revenue);

window.gameChart = new Chart(pieCtx,{

type:"pie",

data:{
labels:gameLabels,
datasets:[{
data:gameValues,
backgroundColor:[
"#0171F9",
"#1cc88a",
"#36b9cc",
"#f6c23e",
"#e74a3b"
]
}]
},

options:{
responsive:true,
maintainAspectRatio:false
}

});

}