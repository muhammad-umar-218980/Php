<nav class="bg-gray-900 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="<?php echo BASE_URL; ?>/dashboard/index.php" class="flex items-center gap-2 text-xl font-bold">
                <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <?php echo APP_NAME; ?>
            </a>
            <button id="menu-toggle" class="md:hidden p-2 rounded hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div id="nav-links" class="hidden md:flex items-center gap-1">
                <a href="<?php echo BASE_URL; ?>/dashboard/index.php" class="px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Dashboard</a>
                <a href="<?php echo BASE_URL; ?>/visitors/add.php" class="px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Add Visitor</a>
                <a href="<?php echo BASE_URL; ?>/visitors/view.php" class="px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">View Visitors</a>
                <a href="<?php echo BASE_URL; ?>/visitors/search.php" class="px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Search</a>
                <a href="<?php echo BASE_URL; ?>/authentication/logout.php" class="px-3 py-2 rounded text-sm font-medium text-red-400 hover:bg-red-700 hover:text-white transition ml-2">Logout</a>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden pb-3 space-y-1">
            <a href="<?php echo BASE_URL; ?>/dashboard/index.php" class="block px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Dashboard</a>
            <a href="<?php echo BASE_URL; ?>/visitors/add.php" class="block px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Add Visitor</a>
            <a href="<?php echo BASE_URL; ?>/visitors/view.php" class="block px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">View Visitors</a>
            <a href="<?php echo BASE_URL; ?>/visitors/search.php" class="block px-3 py-2 rounded text-sm font-medium hover:bg-gray-700 transition">Search</a>
            <a href="<?php echo BASE_URL; ?>/authentication/logout.php" class="block px-3 py-2 rounded text-sm font-medium text-red-400 hover:bg-red-700 hover:text-white transition">Logout</a>
        </div>
    </div>
</nav>
<script>
document.getElementById('menu-toggle')?.addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    const links = document.getElementById('nav-links');
    menu.classList.toggle('hidden');
    links?.classList.toggle('hidden');
});
</script>
