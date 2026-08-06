<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$id = $_GET['id'] ?? 0;
$errors = [];
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $cnic = sanitize($_POST['cnic']);
    $phone = sanitize($_POST['phone']);
    $company = sanitize($_POST['company']);
    $person_to_meet = sanitize($_POST['person_to_meet']);
    $department = sanitize($_POST['department']);
    $purpose = sanitize($_POST['purpose']);
    $visit_date = $_POST['visit_date'];
    $visit_time = $_POST['visit_time'];

    if ($name === '') $errors[] = 'Name is required.';
    if ($cnic === '') $errors[] = 'CNIC is required.';
    if ($phone === '') $errors[] = 'Phone number is required.';
    if ($company === '') $errors[] = 'Company is required.';
    if ($person_to_meet === '') $errors[] = 'Person to meet is required.';
    if ($department === '') $errors[] = 'Department is required.';
    if ($purpose === '') $errors[] = 'Purpose is required.';
    if ($visit_date === '') $errors[] = 'Visit date is required.';
    if ($visit_time === '') $errors[] = 'Visit time is required.';

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "UPDATE visitors SET name=?, cnic=?, phone=?, company=?, person_to_meet=?, department=?, purpose=?, visit_date=?, visit_time=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $name, $cnic, $phone, $company, $person_to_meet, $department, $purpose, $visit_date, $visit_time, $id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ' . BASE_URL . '/visitors/view.php?updated=1');
            exit;
        } else {
            $errors[] = 'Failed to update visitor.';
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Visitor
        </h2>
        <a href="<?php echo BASE_URL; ?>/visitors/view.php" class="mt-2 sm:mt-0 inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Visitors
        </a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm mb-4">
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $e): ?>
                    <li><?php echo $e; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form method="POST" action="" data-validate>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Visitor Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($visitor['name']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CNIC <span class="text-red-500">*</span></label>
                    <input type="text" name="cnic" required value="<?php echo htmlspecialchars($visitor['cnic']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" required value="<?php echo htmlspecialchars($visitor['phone']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company <span class="text-red-500">*</span></label>
                    <input type="text" name="company" required value="<?php echo htmlspecialchars($visitor['company']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Person To Meet <span class="text-red-500">*</span></label>
                    <input type="text" name="person_to_meet" required value="<?php echo htmlspecialchars($visitor['person_to_meet']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department <span class="text-red-500">*</span></label>
                    <input type="text" name="department" required value="<?php echo htmlspecialchars($visitor['department']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Visit <span class="text-red-500">*</span></label>
                <textarea name="purpose" rows="3" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"><?php echo htmlspecialchars($visitor['purpose']); ?></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Visit Date <span class="text-red-500">*</span></label>
                    <input type="date" name="visit_date" required value="<?php echo htmlspecialchars($visitor['visit_date']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Visit Time <span class="text-red-500">*</span></label>
                    <input type="time" name="visit_time" required value="<?php echo htmlspecialchars($visitor['visit_time']); ?>" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                </div>
            </div>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2.5 px-6 rounded-lg transition duration-200">Update Visitor</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
