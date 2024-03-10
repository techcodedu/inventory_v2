document.addEventListener("DOMContentLoaded", function () {
  var ctxItems = document.getElementById("itemsChart").getContext("2d");
  var categoryNames = itemStockByCategoryData.map(function (item) {
    return item.CategoryName;
  });
  var stockLevels = itemStockByCategoryData.map(function (item) {
    return item.TotalQuantity;
  });
  var stockOuts = itemStockByCategoryData.map(function (item) {
    return item.StockOut;
  });

  var itemsChart = new Chart(ctxItems, {
    type: "bar",
    data: {
      labels: categoryNames,
      datasets: [
        {
          label: "Stock Level",
          data: stockLevels,
          backgroundColor: "rgba(54, 162, 235, 0.5)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 1,
        },
        {
          label: "Stock Out",
          data: stockOuts,
          backgroundColor: "rgba(255, 99, 132, 0.5)",
          borderColor: "rgba(255, 99, 132, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true,
          beginAtZero: true,
        },
      },
      plugins: {
        legend: {
          display: true,
        },
        title: {
          display: true,
          text: "Stock Levels by Category",
        },
      },
    },
  });
});

var ctxCategories = document.getElementById("categoriesChart").getContext("2d");
var categoriesChart = new Chart(ctxCategories, {
  type: "doughnut",
  data: {
    labels: [
      "LABORATORY SUPPLIES",
      "MEDICAL SUPPLIES",
      "DENTAL CLINIC" /* more category names */,
    ],
    datasets: [
      {
        label: "Number of Items by Category",
        data: [
          150, 120,
          80 /* more data representing the number of items in each category */,
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.5)",
          "rgba(54, 162, 235, 0.5)",
          "rgba(255, 206, 86, 0.5)",
          // ... more colors for each category
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          // ... more border colors for each category
        ],
        borderWidth: 1,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: "top",
      },
      title: {
        display: true,
        text: "Inventory Distribution by Category",
      },
    },
  },
});

var ctxTransactions = document
  .getElementById("transactionsChart")
  .getContext("2d");
var transactionsChart = new Chart(ctxTransactions, {
  type: "line", // Line chart for transactions over time
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"], // Example labels (months)
    datasets: [
      {
        label: "Transactions",
        data: [12, 19, 3, 5, 2, 3], // Example data
        backgroundColor: "rgba(153, 102, 255, 0.2)",
        borderColor: "rgba(153, 102, 255, 1)",
        borderWidth: 2,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: "bottom",
      },
      title: {
        display: true,
        text: "Monthly Transactions",
      },
    },
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
