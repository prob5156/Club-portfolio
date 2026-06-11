<?php
// member/includes/footer.php
?>
        </main>
        
        <div class="modal-overlay" id="adminModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Modal Title</h3>
                    <button class="modal-close" id="modalCloseBtn">&times;</button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer" id="modalFooter"></div>
            </div>
        </div>

        <footer class="admin-footer">
            &copy; <?= date('Y') ?> Dhrupodi Members Area. All rights reserved.
        </footer>
    </div>
    <script src="/Dhrupodi/admin/assets/js/admin.js"></script>
    <?php if(isset($_SESSION['toast'])): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if(window.Toast) {
            window.Toast.show("<?= addslashes($_SESSION['toast']['message']) ?>", "<?= addslashes($_SESSION['toast']['type']) ?>");
        }
    });
    </script>
    <?php unset($_SESSION['toast']); endif; ?>
</body>
</html>
