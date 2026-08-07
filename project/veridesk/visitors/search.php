<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$results = [];
$searchTerm = '';

if (isset($_GET['search'])) {
    $searchTerm = sanitize($_GET['search']);
    $searchParam = "%$searchTerm%";

    $stmt = mysqli_prepare($conn, "SELECT * FROM visitors WHERE name LIKE ? OR cnic LIKE ? OR phone LIKE ? ORDER BY created_at DESC");
    mysqli_stmt_bind_param($stmt, 'sss', $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Search Visitors
        </h2>
        <a href="<?php echo BASE_URL; ?>/visitors/view.php" class="mt-2 sm:mt-0 inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
            View All Visitors
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form method="GET" action="">
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" required value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search by Name, CNIC, or Phone Number..." class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg transition inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Search
                </button>
            </div>
        </form>
    </div>

    <?php if (isset($_GET['search'])): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Search Results (<span class="text-indigo-600"><?php echo count($results); ?></span> found)</h3>
            </div>
            <div class="p-6">
                <?php if (empty($results)): ?>
                    <p class="text-gray-400 text-center py-8">No visitors match your search for "<strong class="text-gray-600"><?php echo htmlspecialchars($searchTerm); ?></strong>".</p>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 uppercase text-xs tracking-wider border-b">
                                    <th class="pb-3 pr-4">Name</th>
                                    <th class="pb-3 pr-4">CNIC</th>
                                    <th class="pb-3 pr-4">Phone</th>
                                    <th class="pb-3 pr-4">Company</th>
                                    <th class="pb-3 pr-4">Person To Meet</th>
                                    <th class="pb-3 pr-4">Date</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $v): ?>
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                    <td class="py-3 pr-4 font-medium"><a href="<?php echo BASE_URL; ?>/visitors/details.php?id=<?php echo $v['id']; ?>" class="text-indigo-600 hover:text-indigo-800 hover:underline"><?php echo htmlspecialchars($v['name']); ?></a></td>
                                    <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['cnic']); ?></td>
                                    <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['phone']); ?></td>
                                    <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['company']); ?></td>
                                    <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['person_to_meet']); ?></td>
                                    <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['visit_date']); ?></td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-1">
                                            <a href="<?php echo BASE_URL; ?>/visitors/details.php?id=<?php echo $v['id']; ?>" class="p-1.5 rounded bg-cyan-100 text-cyan-700 hover:bg-cyan-200 transition" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/visitors/edit.php?id=<?php echo $v['id']; ?>" class="p-1.5 rounded bg-amber-100 text-amber-700 hover:bg-amber-200 transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/visitors/delete.php?id=<?php echo $v['id']; ?>" onclick="return confirm('Are you sure?');" class="p-1.5 rounded bg-red-100 text-red-700 hover:bg-red-200 transition" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
