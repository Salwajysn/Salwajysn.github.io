<?php
// Include file koneksi database
include 'koneksi.php';

// Check if action parameter is set
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Handle different actions
    switch ($action) {
        case 'edit':
            editQuestion();
            break;
        // Add other cases for 'add' and 'delete' if needed
        // case 'add':
        //     addQuestion();
        //     break;
        // case 'delete':
        //     deleteQuestion();
        //     break;
        default:
            echo "Invalid action.";
    }
}

function editQuestion() {
    global $conn;

    // Get data from POST request
    $questionNumber = $_POST['questionNumber'];
    $newQuestion = $_POST['newQuestion'];
    $opsiA = $_POST['opsiA'];
    $opsiB = $_POST['opsiB'];
    $opsiC = $_POST['opsiC'];
    $opsiD = $_POST['opsiD'];

    // Update the question in database (example code)
    // You need to adjust this part according to your database structure
    $sql = "UPDATE quiz_questions SET question = ?, opsiA = ?, opsiB = ?, opsiC = ?, opsiD = ? WHERE questionNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $newQuestion, $opsiA, $opsiB, $opsiC, $opsiD, $questionNumber);
    
    if ($stmt->execute()) {
        echo "Pertanyaan berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui pertanyaan: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
