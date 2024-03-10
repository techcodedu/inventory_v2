<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editItemForm" action="edit_item.php" method="post">
                <div class="modal-body">
                    <!-- Assuming the function getItem($link, $itemId) is defined in utilities.php to fetch item details by ID -->
                    <?php
                    if (isset($_GET['edit_id'])) {
                        $item = getItem($link, $_GET['edit_id']);
                    }
                    ?>
                    <input type="hidden" name="item_id" value="<?= isset($item['ItemID']) ? $item['ItemID'] : ''; ?>">
                    <div class="form-group">
                        <label for="editItemCategory">Category</label>
                        <select class="form-control" id="editItemCategory" name="category_id" required>
                            <option value="">Select a Category</option>
                            <?php
                            $categories = getCategories($link);
                            foreach ($categories as $category) {
                                $selected = (isset($item['CategoryID']) && $item['CategoryID'] == $category['CategoryID']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($category['CategoryID']) . '"' . $selected . '>' . htmlspecialchars($category['CategoryName']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editItemCode">Code</label>
                        <input type="text" class="form-control" id="editItemCode" name="code" required value="<?= isset($item['Code']) ? htmlspecialchars($item['Code']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editItemName">Name</label>
                        <input type="text" class="form-control" id="editItemName" name="name" required value="<?= isset($item['Name']) ? htmlspecialchars($item['Name']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editItemDescription">Description</label>
                        <textarea class="form-control" id="editItemDescription" name="description"><?= isset($item['Description']) ? htmlspecialchars($item['Description']) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editItemUnitOfMeasure">Unit of Measure</label>
                        <input type="text" class="form-control" id="editItemUnitOfMeasure" name="unit_of_measure" required value="<?= isset($item['UnitOfMeasure']) ? htmlspecialchars($item['UnitOfMeasure']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editItemQuantity">Quantity</label>
                        <input type="number" class="form-control" id="editItemQuantity" name="quantity" required value="<?= isset($item['Quantity']) ? htmlspecialchars($item['Quantity']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editItemEstimatedBudget">Estimated Budget</label>
                        <input type="text" class="form-control" id="editItemEstimatedBudget" name="estimated_budget" required value="<?= isset($item['EstimatedBudget']) ? htmlspecialchars($item['EstimatedBudget']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editItemModeOfProcurement">Mode of Procurement</label>
                        <input type="text" class="form-control" id="editItemModeOfProcurement" name="mode_of_procurement" required value="<?= isset($item['ModeOfProcurement']) ? htmlspecialchars($item['ModeOfProcurement']) : ''; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit_item">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
