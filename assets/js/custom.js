// This is a placeholder for any specific JavaScript you want to implement
// For example, to handle pagination dynamically (without page reload)
document.querySelectorAll(".page-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    // Use Fetch API to get the data and update the table dynamically
    const page = this.getAttribute("href").split("page=")[1];
    fetchItems(page); // Implement fetchItems to update the table based on the selected page
  });
});

// Check if the alert message exists
if (document.getElementById("alert-message")) {
  // Wait for 2 seconds (2000 milliseconds), then fade out the alert
  setTimeout(function () {
    var alertMessage = document.getElementById("alert-message");
    alertMessage.style.opacity = "0"; // Start the fade out
    // After the fade, set display to 'none' to remove it from the flow
    setTimeout(function () {
      alertMessage.style.display = "none";
    }, 600); // This delay should match your fade duration in CSS
  }, 2000);
}

function populateEditModal(itemId) {
  fetch("get_item.php?item_id=" + itemId)
    .then((response) => response.json())
    .then((item) => {
      document.querySelector('#editItemForm [name="item_id"]').value =
        item.ItemID;
      document.querySelector('#editItemForm [name="category_id"]').value =
        item.CategoryID;
      document.querySelector('#editItemForm [name="code"]').value = item.Code;
      document.querySelector('#editItemForm [name="name"]').value = item.Name;
      document.querySelector('#editItemForm [name="description"]').value =
        item.Description;
      document.querySelector('#editItemForm [name="unit_of_measure"]').value =
        item.UnitOfMeasure;
      document.querySelector('#editItemForm [name="quantity"]').value =
        item.Quantity;
      document.querySelector('#editItemForm [name="estimated_budget"]').value =
        item.EstimatedBudget;
      document.querySelector(
        '#editItemForm [name="mode_of_procurement"]'
      ).value = item.ModeOfProcurement;

      $("#editItemModal").modal("show");
    })
    .catch((error) => {
      console.error("Error fetching item data:", error);
    });
}
