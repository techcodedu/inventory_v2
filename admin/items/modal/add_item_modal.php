 
<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="itemCategory">Category</label>
                        <select class="form-control" id="itemCategory" name="category_id" required>
                            <option value="">Select a Category</option>
                            <?php
                            $categories = getCategories($link);
                            foreach ($categories as $category) {
                                echo '<option value="' . htmlspecialchars($category['CategoryID']) . '">' . htmlspecialchars($category['CategoryName']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itemCode">Code</label>
                        <input type="text" class="form-control" id="itemCode" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="itemName">Name</label>
                        <input type="text" class="form-control" id="itemName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Description</label>
                        <textarea class="form-control" id="itemDescription" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemUnitOfMeasure">Unit of Measure</label>
                        <input type="text" class="form-control" id="itemUnitOfMeasure" name="unit_of_measure" required>
                    </div>
                    <div class="form-group">
                        <label for="itemQuantity">Quantity</label>
                        <input type="number" class="form-control" id="itemQuantity" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="itemEstimatedBudget">Estimated Budget</label>
                        <input type="text" class="form-control" id="itemEstimatedBudget" name="estimated_budget" required>
                    </div>
                    <div class="form-group">
                        <label for="itemModeOfProcurement">Mode of Procurement</label>
                        <input type="text" class="form-control" id="itemModeOfProcurement" name="mode_of_procurement" required>
                    </div>
                    <!-- Add any additional input fields as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

