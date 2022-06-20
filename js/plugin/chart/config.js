//Confifuracion para las grafiacas de Lineas
const days =[
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sábado",
    "Domingo",
];
const Months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio"
];
const basicColors = [
  "rgba(250, 250, 85, 0.8)",
  "rgba(178, 246, 116, 0.8)",
  "rgba(110, 237, 150, 0.8)",
  "rgba(39, 223, 176, 0.8)",
  "rgba(0, 206, 192, 0.8)",
  "rgba(51, 187, 196, 0.8)",
  "rgba(34, 124, 130, 0.8)",
];
const borderColors = [
  "rgba(250, 250, 85, 0.8)",
  "rgba(178, 246, 116, 0.8)",
  "rgba(110, 237, 150, 0.8)",
  "rgba(39, 223, 176, 0.8)",
  "rgba(0, 206, 192, 0.8)",
  "rgba(51, 187, 196, 0.8)",
  "rgba(34, 124, 130, 0.8)",
];
const ranges = [12, 9, 6, 21, 5, 13];

/* CONFIGURACION DEL CHART PRINCIPAL */
const dataMain = {
  datasets: [
    {
      data: [
        {
          x: "2021-11-06 23:39:30",
          y: 50,
        },
        {
          x: "2021-11-07 01:00:28",
          y: 60,
        },
        {
          x: "2021-11-07 09:00:28",
          y: 20,
        },
      ],
    },
  ],
};
export {dataMain};

/* CONFIGURACION PARA EL GRÁFICO DE LINEAS */
const dataLines = {
  labels: Months,
  datasets: [
    {
      label: "Ventas Mensuales",
      data: ranges,
      borderColor: "rgba(16, 120, 138, 0.8)",
      fill: false,
    },
  ],
};
export {dataLines};

/* CONFIGURACION DEL GRÁFICO DE DONA */
const dataDoughnut = {
    labels: Months,
    datasets: [
      {
        data: ranges,
        backgroundColor: basicColors,
        borderColor: borderColors,
        borderWidth: 1,
      },
    ]
}
export {dataDoughnut};

/* CONFIGURACION PARA EL GRÁFICO DE BARRAS */
const dataBar = {
  labels: Months,
  datasets: [
    {
      label: "Ventas Semanales",
      data: ranges,
      backgroundColor: basicColors,
      borderColor: borderColors,
      borderWidth: 1,
    },
  ],
};
export {dataBar};

/* CONFIGURACION DE GRÁFICO DE BARRAS STACKED */
const DATA_COUNT = 7;
const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };

const dataBarStacked = {
  labels: Months,
  datasets: [
    {
      label: "Dataset 1",
      data: [10, 30, 50, 20, 25, 44, -10],
      borderColor: borderColors,
      backgroundColor: basicColors,
    },
    {
      label: "Dataset 2",
      data: [100, 33, 22, 19, 11, 49, 30],
      borderColor: borderColors,
      backgroundColor: basicColors,
    },
  ],
};
export {dataBarStacked};
