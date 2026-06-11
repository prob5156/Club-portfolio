<?php
// admin/includes/footer.php
?>
        </main>

        <!-- Reusable Modal Foundation -->
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
            &copy; <?= date('Y') ?> Dhrupodi. All rights reserved.
        </footer>
    </div> <!-- end main-wrapper -->
    <script src="/Dhrupodi/admin/assets/js/admin.js"></script>
</body>
</html>
