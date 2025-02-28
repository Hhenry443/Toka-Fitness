<?php if (!empty($_SESSION['error'])): ?>
<div id="errorPopup" class="fixed top-0 left-0 w-full bg-DarkRed text-white text-center py-4 z-50">
    <p><?php echo htmlspecialchars($_SESSION['error']); ?></p>
    <button onclick="document.getElementById('errorPopup').style.display='none'" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-xl font-bold">&times;</button>
</div>
<?php unset($_SESSION['error']); // Clear the error after displaying it ?>
<?php endif; ?>