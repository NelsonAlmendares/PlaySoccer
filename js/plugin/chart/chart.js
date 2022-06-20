import { dataMain } from "./config.js";
import { dataLines } from "./config.js";
import { dataDoughnut  } from "./config.js";
import { dataBar } from "./config.js";
import { dataBarStacked } from "./config.js";

const ctx = document.getElementById("main").getContext("2d");
const myChart = new Chart(ctx, {
  type: "line",
  data: dataMain,
  options: {
    scales: {
      x: {
        min: "2021-11-07 00:00:00",
      },
    },
  },
});

const ctxSales = document.getElementById("sales").getContext("2d");
const myChartSales = new Chart(ctxSales, {
  type: "bar",
  data: dataBar,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

//Configuracion para chart de Linea
const ctxCanchas = document.getElementById("canchas").getContext("2d");
const myChartCanchas = new Chart(ctxCanchas, {
  type: "line",
  data: dataLines,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

//Configuracion para un chart de porcentaje
const ctxEquipo = document.getElementById("equipo").getContext("2d");
const myChartEquipo = new Chart(ctxEquipo, {
  type: "doughnut",
  data: dataDoughnut,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const ctxBalones= document.getElementById("balones").getContext("2d");
const myChartBalones = new Chart(ctxBalones, {
  type: "line",
  data: dataBarStacked,
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: "Min and Max Settings",
      },
    },
    scales: {
      y: {
        min: 10,
        max: 50,
      },
    },
  },
});