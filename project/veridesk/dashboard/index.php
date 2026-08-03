<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$totalVisitors = getTotalVisitors($conn);
$todayVisitors = getTodayVisitors($conn);
$monthVisitors = getMonthVisitors($conn);
$recentVisitors = getRecentVisitors($conn);
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Dashboard
        </h2>
        <span class="text-sm text-gray-500 mt-1 sm:mt-0">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-200 text-sm font-medium">Total Visitors</p>
                    <p class="text-4xl font-bold mt-1"><?php echo $totalVisitors; ?></p>
                </div>
                <svg class="w-12 h-12 text-indigo-300 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-200 text-sm font-medium">Today's Visitors</p>
                    <p class="text-4xl font-bold mt-1"><?php echo $todayVisitors; ?></p>
                </div>
                <svg class="w-12 h-12 text-emerald-300 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-200 text-sm font-medium">This Month</p>
                    <p class="text-4xl font-bold mt-1"><?php echo $monthVisitors; ?></p>
                </div>
                <svg class="w-12 h-12 text-amber-300 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Recent Visitors
            </h3>
        </div>
        <div class="p-6">
            <?php if (empty($recentVisitors)): ?>
                <p class="text-gray-400 text-center py-8">No visitors recorded yet.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 uppercase text-xs tracking-wider border-b">
                                <th class="pb-3 pr-4">Name</th>
                                <th class="pb-3 pr-4">Phone</th>
                                <th class="pb-3 pr-4">Person To Meet</th>
                                <th class="pb-3 pr-4">Department</th>
                                <th class="pb-3 pr-4">Date</th>
                                <th class="pb-3">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentVisitors as $v): ?>
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="py-3 pr-4 font-medium"><a href="<?php echo BASE_URL; ?>/visitors/details.php?id=<?php echo $v['id']; ?>" class="text-indigo-600 hover:text-indigo-800 hover:underline"><?php echo htmlspecialchars($v['name']); ?></a></td>
                                <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['phone']); ?></td>
                                <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['person_to_meet']); ?></td>
                                <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['department']); ?></td>
                                <td class="py-3 pr-4 text-gray-600"><?php echo htmlspecialchars($v['visit_date']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo htmlspecialchars($v['visit_time']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
