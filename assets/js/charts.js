/* Inicio Chart de Técnico 1 */
const getChartOptionsFirstTecn = () => {
    return {
        series: [101, 102, 103, 104, 105, 106],
        colors: ["#E5E7EB", "#FCD9BD", "#C3DDFD", "#bcf0da", "#fce96a", "#cddbfe"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Tickets asignados",
                            fontFamily: "Inter, sans-serif",
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value + " tickets"
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Sin iniciar", "Iniciando", "En proceso", "Hechos", "Programados", "Congelados"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " tickets"
            },
        },
    },
    xaxis: {
        labels: {
            formatter: function (value) {
                return value + " tickets"
            },
        },
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    }
}

if (document.getElementById("tecnico1-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tecnico1-chart"), getChartOptionsFirstTecn());
    chart.render()
}
/* Fin Chart de Técnico 1 */

/* Inicio Chart de Técnico 2 */
const getChartOptionsSecondTecn = () => {
    return {
        series: [101, 102, 103, 104, 105, 106],
        colors: ["#E5E7EB", "#FCD9BD", "#C3DDFD", "#bcf0da", "#fce96a", "#cddbfe"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Tickets asignados",
                            fontFamily: "Inter, sans-serif",
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value + " tickets"
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Sin iniciar", "Iniciando", "En proceso", "Hechos", "Programados", "Congelados"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " tickets"
            },
        },
    },
    xaxis: {
        labels: {
            formatter: function (value) {
                return value + " tickets"
            },
        },
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    }
}

if (document.getElementById("tecnico2-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tecnico2-chart"), getChartOptionsSecondTecn());
    chart.render()
}
/* Fin Chart de Técnico 2 */

/* Inicio Chart de Técnico 3 */
const getChartOptionsThirdTecn = () => {
    return {
        series: [101, 102, 103, 104, 105, 106],
        colors: ["#E5E7EB", "#FCD9BD", "#C3DDFD", "#bcf0da", "#fce96a", "#cddbfe"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Tickets asignados",
                            fontFamily: "Inter, sans-serif",
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value + " tickets"
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Sin iniciar", "Iniciando", "En proceso", "Hechos", "Programados", "Congelados"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " tickets"
            },
        },
    },
    xaxis: {
        labels: {
            formatter: function (value) {
                return value + " tickets"
            },
        },
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    }
}

if (document.getElementById("tecnico3-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tecnico3-chart"), getChartOptionsThirdTecn());
    chart.render()
}
/* Fin Chart de Técnico 3 */

/* Inicio Chart de Técnico 4 */
const getChartOptionsFourthTecn = () => {
    return {
        series: [101, 102, 103, 104, 105, 106],
        colors: ["#E5E7EB", "#FCD9BD", "#C3DDFD", "#bcf0da", "#fce96a", "#cddbfe"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Tickets asignados",
                            fontFamily: "Inter, sans-serif",
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value + " tickets"
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Sin iniciar", "Iniciando", "En proceso", "Hechos", "Programados", "Congelados"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + " tickets"
            },
        },
    },
    xaxis: {
        labels: {
            formatter: function (value) {
                return value + " tickets"
            },
        },
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    }
}

if (document.getElementById("tecnico4-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tecnico4-chart"), getChartOptionsFourthTecn());
    chart.render()
}
/* Fin Chart de Técnico 4 */

/* Inicio Chart de Tickets Generados */
const optionsTicketsGenerados = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        StrokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
    },
    series: [
        {
            name: "Tickets creados",
            data: [1000, 1000, 1000, 1000, 1000, 1000],
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: ["01 Lun", "02 Mar", "03 Mie", "04 Jue", "05 Vie", "06 Sab", "07 Dom"],
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
}

if (document.getElementById("tickets-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tickets-chart"), optionsTicketsGenerados);
    chart.render()
}
/* Fin Chart de Tickets Generados */

/* Inicio Chart de Tickets Eliminados */
const optionsTicketsEliminados = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        StrokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
    },
    series: [
        {
            name: "Tickets creados",
            data: [1000, 1000, 1000, 1000, 1000, 1000],
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: ["01 Lun", "02 Mar", "03 Mie", "04 Jue", "05 Vie", "06 Sab", "07 Dom"],
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
}

if (document.getElementById("tickets-eliminados-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(document.getElementById("tickets-eliminados-chart"), optionsTicketsEliminados);
    chart.render()
}
/* Fin Chart de Tickets Eliminados */