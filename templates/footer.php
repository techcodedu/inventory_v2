<!-- Footer -->
<footer class="main-footer">
    <strong>&copy; 2024 <a href="#">Inventory System</a>.</strong>
    All rights reserved.
</footer>
<!-- ./Footer -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js" integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AdminLTE App -->
<script src="/inventory_v2/assets/js/adminlte.min.js"></script>
<!-- chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var itemsData = <?php echo json_encode($numberOfItems); ?>;
    var categoriesData = <?php echo json_encode($numberOfCategories); ?>;
</script>
<script src="/inventory_v2/assets/js/stats.js"></script>
<script src="/inventory_v2/assets/js/custom.js"></script>

</div>
<!-- ./wrapper -->
</body>
</html>
