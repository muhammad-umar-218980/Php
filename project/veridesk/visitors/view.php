<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$result = mysqli_query($conn, "SELECT * FROM visitors ORDER BY created_at DESC");
$visitors = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            All Visitors
        </h2>
        <a href="<?php echo BASE_URL; ?>/visitors/add.php" class="mt-2 sm:mt-0 inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Visitor
        </a>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4">Visitor deleted successfully.</div>
    <?php endif; ?>
    <?php if (isset($_GET['updated'])): ?>
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4">Visitor updated successfully.</div>
    <?php endif; ?>

    <?php if (empty($visitors)): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-gray-400 mb-4">No visitors found. Add your first visitor!</p>
            <a href="<?php echo BASE_URL; ?>/visitors/add.php" class="inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Add Visitor</a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-gray-500 uppercase text-xs tracking-wider">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">CNIC</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Company</th>
                            <th class="px-4 py-3">Person To Meet</th>
                            <th class="px-4 py-3">Department</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($visitors as $v): ?>
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-gray-500"><?php echo $i++; ?></td>
                            <td class="px-4 py-3 font-medium"><a href="<?php echo BASE_URL; ?>/visitors/details.php?id=<?php echo $v['id']; ?>" class="text-indigo-600 hover:text-indigo-800 hover:underline"><?php echo htmlspecialchars($v['name']); ?></a></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['cnic']); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['phone']); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['company']); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['person_to_meet']); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['department']); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($v['visit_date']); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <a href="<?php echo BASE_URL; ?>/visitors/details.php?id=<?php echo $v['id']; ?>" class="p-1.5 rounded bg-cyan-100 text-cyan-700 hover:bg-cyan-200 transition" title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/visitors/edit.php?id=<?php echo $v['id']; ?>" class="p-1.5 rounded bg-amber-100 text-amber-700 hover:bg-amber-200 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/visitors/delete.php?id=<?php echo $v['id']; ?>" onclick="return confirm('Are you sure you want to delete this visitor?');" class="p-1.5 rounded bg-red-100 text-red-700 hover:bg-red-200 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
