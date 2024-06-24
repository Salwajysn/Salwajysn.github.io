
<?php
session_start(); // Start PHP session

// Include database connection file
include 'db_connect.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
} else {
  // Redirect to login page if not logged in
  header("Location: login.php");
  exit;
}

// Query to fetch user's name based on ID
$query = "SELECT `Nama_User` FROM `user` WHERE `Id_User`='$userId'";
$result = $conn->query($query);

// Variable to store user's name
$namaUser = '';

if ($result->num_rows > 0) {
  // Fetch user's name
  while ($row = $result->fetch_assoc()) {
    $namaUser = $row['Nama_User'];
  }
} else {
  echo "Data user tidak ditemukan."; // Display message if user data is not found
}
?>

<!-- HTML part of the page: TECHTREE WEB PAGE - QUIZ -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"> <!-- Character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design viewport -->
  <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
  <link rel="stylesheet" href="quiz.css"> <!-- Link to quiz stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Include FontAwesome from CDN -->
  <title>Quiz Materi</title> <!-- Title of the webpage -->
  <script src="kelasBootcamp.js" defer></script> <!-- Include JavaScript file for Bootcamp class with defer attribute -->
</head>

<body>
  <header>
    <!-- LOGO -->
    <a id="logo_link" href="dashboard.php">
      <img src="Logo.png" id="logo" alt="Logo"> <!-- Image logo with link to dashboard.php -->
    </a>
    <!-- MATERI YANG SEDANG DIPELAJARI -->
    <h3>Desain UI/UX - Tools</h3>
    <div class="progresWrap">
      <div class="progress-container">
        <div class="progress-bar" style="width: 100%;"></div> <!-- Progress bar indicating completion -->
      </div>
      <p class="progress-score">100%</p>
      <p class="materiSelesai">Materi sudah diselesaikan</p> <!-- Message indicating completion of material -->
    </div>
    <!-- Show User Name -->
    <section class="profileAdjust">
      <img src="user.png" alt="User Icon">
      <p><?php echo $namaUser; ?></p> <!-- Display user's name -->
    </section>
  </header>

<!-- Main section of the page -->
<main>
  <h1 class="titleH1">Quiz</h1>
  <h2 class="titleH2">Quiz Kelas UI/UX</h2>
  <!-- Button to return to material -->
  <section class="kembaliKeMateri">
    <a href="ui5.php">
      <button>
        <i class="fa-solid fa-chevron-left"></i>
        <span>Kembali ke Materi</span>
      </button>
    </a>
  </section>

  <div class="class-form-wrap">
    <form class="class-form" id="quizForm" method="post" action="submit_quiz.php"> <!-- Form to submit quiz answers -->
      <?php
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Query to fetch questions from class Kls01
      $sql = "SELECT * FROM `quiz_questions` WHERE `Id_Kelas` = 'Kls01' AND `Id_Quiz` LIKE 'UQ%'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Loop through each row to display questions and answer options
        while ($row = $result->fetch_assoc()) {
          echo '<h3>' . $row['question_text'] . '</h3>';
          echo '<div class="quizAnswers">';
          echo '<label>';
          echo '<input type="radio" name="answer_' . $row['Id_Quiz'] . '" value="A">';
          echo '<span>A</span>' . $row['option_a'];
          echo '</label>';
          echo '<label>';
          echo '<input type="radio" name="answer_' . $row['Id_Quiz'] . '" value="B">';
          echo '<span>B</span>' . $row['option_b'];
          echo '</label>';
          echo '<label>';
          echo '<input type="radio" name="answer_' . $row['Id_Quiz'] . '" value="C">';
          echo '<span>C</span>' . $row['option_c'];
          echo '</label>';
          echo '<label>';
          echo '<input type="radio" name="answer_' . $row['Id_Quiz'] . '" value="D">';
          echo '<span>D</span>' . $row['option_d'];
          echo '</label>';
          echo '</div>';
        }
      } else {
        echo "0 results"; // Display message if no quiz questions found
      }

      // Close connection
      $conn->close();
      ?>
    </form>
    <!-- Submit button outside the form -->
    <button type="button" onclick="submitQuiz()">Submit Jawaban</button>
  </div>

  <!-- Quiz Score Section -->
  <div id="hasilQuiz_KKM" style="display: none;">
    <h2>Skor Quiz</h2>
    <h1 id="KKM">0%</h1>
    <p>Yey! Anda memenuhi skor minimum yang perlu diraih!</p> <!-- Message indicating minimum score achieved -->
  </div>
</main>

<!-- JavaScript to evaluate and calculate score -->
<script>
  // Function to submit quiz
  function submitQuiz() {
    // Get all answers from the form
    var answers = <?php
      // Create new connection to fetch correct answers
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Query to fetch correct answers from database
      $sql_key = "SELECT `Id_Quiz`, `correct_answer` FROM `quiz_questions` WHERE `Id_Kelas` = 'Kls01' AND `Id_Quiz` LIKE 'UQ%'";
      $result_key = $conn->query($sql_key);

      $answers = array();
      if ($result_key->num_rows > 0) {
        while ($row_key = $result_key->fetch_assoc()) {
          $answers[$row_key['Id_Quiz']] = $row_key['correct_answer'];
        }
      }

      // Output answers as JSON format
      echo json_encode($answers);

      // Close database connection
      $conn->close();
    ?>;

    // Variable to count correct answers
    var totalBenar = 0;

    // Calculate number of correct answers
    for (var id in answers) {
      if (answers.hasOwnProperty(id)) {
        var radio = document.querySelector('input[name="answer_' + id + '"]:checked');
        if (radio && radio.value === answers[id]) {
          totalBenar++;
        }
      }
    }

    // Calculate score based on correct answers
    var totalQuestions = Object.keys(answers).length;
    var skor = (totalBenar / totalQuestions) * 100; // Total number of questions = 5

    // Display score result
    var skorElem = document.getElementById('KKM');
    skorElem.textContent = skor.toFixed(0) + '%';

    // Display message based on score
    var hasilQuiz_KKM = document.getElementById('hasilQuiz_KKM');
    var message = '';
    if (skor >= 80) {
      message = 'Yey! Anda memenuhi skor minimum yang perlu diraih!';
    } else {
      message = 'Skor Anda belum mencukupi untuk lolos.';
    }
    hasilQuiz_KKM.getElementsByTagName('p')[0].textContent = message;

    // Display button to work on Final Project
    var buttonProyekAkhir = document.createElement('button');
    buttonProyekAkhir.textContent = 'Kerjakan Proyek Akhir';
    buttonProyekAkhir.onclick = function () {
      window.location.href = 'detail_dan_submit_proyekAkhir.php';
    };
    hasilQuiz_KKM.appendChild(buttonProyekAkhir);

    // Change score display
    hasilQuiz_KKM.style.display = 'block';
  }
</script>
