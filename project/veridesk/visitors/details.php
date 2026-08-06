<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$id = $_GET['id'] ?? 0;
$visitor = null;

$stmt = mysqli_prepare($conn, "SELECT * FROM visitors WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$visitor = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$visitor) {
    header('Location: ' . BASE_URL . '/visitors/view.php');
    exit;
}

$initials = '';
$nameParts = explode(' ', $visitor['name']);
if (count($nameParts) >= 2) {
    $initials = strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1));
} else {
    $initials = strtoupper(substr($visitor['name'], 0, 2));
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-10 text-white text-center">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full mb-4 border-4 border-white/30">
                <span class="text-3xl font-bold"><?php echo $initials; ?></span>
            </div>
            <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($visitor['name']); ?></h2>
            <p class="text-indigo-200 text-lg"><?php echo htmlspecialchars($visitor['company']); ?></p>
            <div class="mt-3 inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <?php echo htmlspecialchars($visitor['visit_date']); ?>
                <span class="w-1 h-1 bg-white/40 rounded-full"></span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo htmlspecialchars($visitor['visit_time']); ?>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">CNIC</p>
                        <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($visitor['cnic']); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Phone</p>
                        <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($visitor['phone']); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Person To Meet</p>
                        <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($visitor['person_to_meet']); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Department</p>
                        <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($visitor['department']); ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Purpose of Visit</p>
                        <p class="text-gray-800 leading-relaxed"><?php echo nl2br(htmlspecialchars($visitor['purpose'])); ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                <a href="<?php echo BASE_URL; ?>/visitors/edit.php?id=<?php echo $visitor['id']; ?>" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2.5 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Visitor
                </a>
                <a href="<?php echo BASE_URL; ?>/visitors/view.php" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to List
                </a>
                <a href="<?php echo BASE_URL; ?>/visitors/delete.php?id=<?php echo $visitor['id']; ?>" onclick="return confirm('Are you sure you want to delete this visitor?');" class="inline-flex items-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 font-semibold px-5 py-2.5 rounded-lg transition ml-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Delete
                </a>
            </div>
        </div>
    </div>

    <p class="text-center text-xs text-gray-400 mt-4">
        Record ID: #<?php echo $visitor['id']; ?> &middot; Created: <?php echo htmlspecialchars($visitor['created_at']); ?>
    </p>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
