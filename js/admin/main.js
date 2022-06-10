/* globals Chart:false, feather:false */

(function () {
  "use strict";

  feather.replace({ "aria-hidden": "true" });

  // Graphs
  var ctx = document.getElementById("ganancias-anual");

  var myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciemmbre",
      ],
      datasets: [
        {
          data: [
              3036, 
              3085, 
              3557, 
              3041, 
              3639, 
              3140, 
              3481,
              3096,
              2885,
              3624,
              3658,
              2925
            ],
          lineTension: 0,
          backgroundColor: "transparent",
          borderColor: "#90AADC",
          borderWidth: 4,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: false,
            },
          },
        ],
      },
      legend: {
        display: false,
      },
    },
  });

  var data = {
    labels: ["Diurno", "Nocturno"],
    datasets: [
      {
        data: [7, 21],
        backgroundColor: ["#007EB0", "#00293A", "#009AD6"],
      },
    ],
  };
  var promisedDeliveryChart = new Chart(document.getElementById("reservaciones-horario"), {
    type: "doughnut",
    data: data,
    options: {
      responsive: true,
      legend: {
        display: false,
      },
    },
  });
  
  var ctx = document.getElementById("ganancias-semana");

  var myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado",
        "Domingo"
      ],
      datasets: [
        {
          data: [
              75.00, 
              120.00, 
              140.00, 
              120.00,
              120.00,
              90.00
            ],
          lineTension: 0,
          backgroundColor: "transparent",
          borderColor: "#90AADC",
          borderWidth: 4,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: false,
            },
          },
        ],
      },
      legend: {
        display: false,
      },
    },
  });

  
const $grafico = document.querySelector("#reservas-semanal");

const etiqueta = ["Lunes", "Martes", "Miércoles", "Jueves","Viernes","Sábado","Domingo"]

const datosVenta2022 = {
    data: [3, 5, 6, 5, 5, 4], 
    backgroundColor: 'rgba(54, 162, 235, 0.2)', 
    borderColor: 'rgba(54, 162, 235, 1)', 
    borderWidth: 1,
    label: "Cantidad de reservas por día",
};
new Chart($grafico, {
    type: 'radar',
    data: {
        labels: etiqueta,
        datasets: [
            datosVenta2022,
            
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
        },
    }
});




const $grafica = document.querySelector("#balones-alquilados");

const etiquetas = ["Semana 1", "Semana 2", "Semana 3", "Semana 4"]

const datosVentas2020 = {
    data: [5, 6, 2, 0], 
    backgroundColor: 'rgba(54, 162, 235, 0.2)', 
    borderColor: 'rgba(54, 162, 235, 1)', 
    borderWidth: 1,
    label: "Cantidad de reservas",
};
new Chart($grafica, {
    type: 'bar',
    data: {
        labels: etiquetas,
        datasets: [
            datosVentas2020,
            
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
        },
    }
});
})();
