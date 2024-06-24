// REDIRECTING
function redirectToPage(targetedPage) {
  window.location.href = targetedPage;
  window.scroll(0, 0);
}

/*
// Kembali ke Materi Button
function redirectToPage2() {
  window.location.href = 'materi.php';
  window.scroll(0, 0);
}
*/

// Melihat Hasil Skor
function seeScore(targetedID, attributeName, attributeValue) {
  // Get the target element
  const targetElement = document.querySelector(targetedID);

  // Check if the target element exists
  if (targetElement) {
      // Set the specified attribute and value
      targetElement.setAttribute(attributeName, attributeValue);

      // Scroll to the target element
      targetElement.scrollIntoView({ behavior: 'smooth' });
  }
}

// UPDATE TOPIK MATERI
function editMateriJudul(idMateri) {
  var newJudul = prompt("Masukkan judul baru:");
  if (newJudul != null) {
      // Send data to update_materi.php using Ajax
      $.ajax({
          type: 'POST',
          url: 'update_materi.php',
          data: { idMateri: idMateri, newJudul: newJudul },
          success: function(response) {
              alert(response); // Show success or error message
              if (response.includes("berhasil")) {
                  // Update the judul on the page
                  document.getElementById("judul-" + idMateri).innerText = newJudul;
              }
          },
          error: function(xhr, status, error) {
              alert("Gagal memperbarui judul materi.");
          }
      });
  }
}

// UPDATE YOUTUBE LINK
function editVideoLink(idMateri) {
  var newLink = prompt("Masukkan link video baru:");
  if (newLink != null) {
      // Send data to update_materi.php using Ajax
      $.ajax({
          type: 'POST',
          url: 'update_materi.php',
          data: { idMateri: idMateri, newLink: newLink },
          success: function(response) {
              alert(response); // Show success or error message
              if (response.includes("berhasil")) {
                  // Update the video link on the page
                  document.getElementById("video-" + idMateri).src = newLink;
              }
          },
          error: function(xhr, status, error) {
              alert("Gagal memperbarui link video.");
          }
      });
  }
}

  
  function extractVideoId(url) {
    // Pola URL untuk https://youtu.be/VIDEO_ID
    var shortMatch = url.match(/youtu\.be\/([^&?/]+)/);
    if (shortMatch) {
      return shortMatch[1];
    }
  
    // Pola URL untuk https://www.youtube.com/watch?v=VIDEO_ID
    var longMatch = url.match(/[?&]v=([^&]+)/);
    if (longMatch) {
      return longMatch[1];
    }
  
    // Jika tautan tidak cocok dengan pola yang diberikan
    return null;
  }
  
  // HALAMAN QUIZ ADMIN EDIT
  document.addEventListener('DOMContentLoaded', () => {
    let questionCount = document.querySelectorAll('.editable_soal_quiz').length;

  // Tambahkan event listener untuk mengarahkan ke halaman quizFotografi.php (default untuk admin)
  document.getElementById('mulaiQuizButtonAdmin').addEventListener('click', () => {
      redirectToPage('quizUI.php');
  });

  // Fungsi untuk mengarahkan ke halaman yang ditentukan
  function redirectToPage(targetedPage) {
      window.location.href = targetedPage;
  }

    // Function to enter edit mode for a question
    window.editQuestion = (icon) => {
      const questionDiv = icon.closest('.editable_soal_quiz');
      const questionText = questionDiv.querySelector('h3');
      const questionTextarea = document.createElement('textarea');
      questionTextarea.className = 'questionTextarea';
      questionTextarea.value = questionText.textContent.slice(questionText.textContent.indexOf('.') + 2);
      questionText.replaceWith(questionTextarea);
  
      const allInputs = questionDiv.querySelectorAll('.kalimatJawaban');
      allInputs.forEach((input) => {
        const answerTextarea = document.createElement('textarea');
        answerTextarea.className = 'answerTextarea';
        answerTextarea.value = input.textContent;
        input.replaceWith(answerTextarea);
      });
  
      // Change edit icon to save icon
      icon.classList.remove('fa-pen-to-square');
      icon.classList.add('fa-save');
      icon.setAttribute('onclick', 'saveQuestion(this)');
  
      // Make the text area width 100%
      questionTextarea.style.width = '100%';
    };
  
    // Function to save the edited question
window.saveQuestion = (icon) => {
  const questionDiv = icon.closest('.editable_soal_quiz');
  const questionTextarea = questionDiv.querySelector('.questionTextarea');
  const newQuestion = questionTextarea.value;
  const questionNumber = Array.from(document.querySelectorAll('.editable_soal_quiz')).indexOf(questionDiv) + 1;

  // Collect answers (options)
  const allTextareas = questionDiv.querySelectorAll('.answerTextarea');
  const opsiA = allTextareas[0].value;
  const opsiB = allTextareas[1].value;
  const opsiC = allTextareas[2].value;
  const opsiD = allTextareas[3].value;

  // Send data to update_quiz.php using Ajax
  $.ajax({
      type: 'POST',
      url: 'update_quiz.php',
      data: {
          action: 'edit', // Action to edit question
          questionNumber: questionNumber,
          newQuestion: newQuestion,
          opsiA: opsiA,
          opsiB: opsiB,
          opsiC: opsiC,
          opsiD: opsiD
      },
      success: function(response) {
          alert(response); // Show success or error message
          if (response.includes("berhasil")) {
              // Update the question on the page
              questionTextarea.outerHTML = `<h3>${questionNumber}. ${newQuestion}</h3>`;

              // Update answer options
              const allSpans = questionDiv.querySelectorAll('.kalimatJawaban');
              allSpans[0].textContent = opsiA;
              allSpans[1].textContent = opsiB;
              allSpans[2].textContent = opsiC;
              allSpans[3].textContent = opsiD;
          }
      },
      error: function(xhr, status, error) {
          alert("Gagal memperbarui pertanyaan.");
      }
  });

  // Change save icon back to edit icon
  icon.classList.remove('fa-save');
  icon.classList.add('fa-pen-to-square');
  icon.setAttribute('onclick', 'editQuestion(this)');

  alert('Quiz sudah diperbarui.');
};
  
    // Function to delete a question
    window.deleteQuestion = (icon) => {
      const questionDiv = icon.closest('.editable_soal_quiz');
      questionDiv.remove();
      updateQuestionNumbers();
    };
  
    // Function to add a new question
    window.addQuestion = () => {
      questionCount++;
      const quizContainer = document.getElementById('quizContainer');
      const newQuestionHTML = `
        <div class="editable_soal_quiz">
          <form class="class-form" action="GET">
            <h3>${questionCount}. Pertanyaan Baru</h3>
            <div class="quizAnswers">
              <label>
                <input type="radio" name="answer${questionCount}" value="A" class="opsi">
                <span class="opsi">A</span><span class="kalimatJawaban">Opsi A</span>
              </label>
              <label>
                <input type="radio" name="answer${questionCount}" value="B" class="opsi">
                <span class="opsi">B</span><span class="kalimatJawaban">Opsi B</span>
              </label>
              <label>
                <input type="radio" name="answer${questionCount}" value="C" class="opsi">
                <span class="opsi">C</span><span class="kalimatJawaban">Opsi C</span>
              </label>
              <label>
                <input type="radio" name="answer${questionCount}" value="D" class="opsi">
                <span class="opsi">D</span><span class="kalimatJawaban">Opsi D</span>
              </label>
            </div>
          </form>
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>`;
      quizContainer.insertAdjacentHTML('beforeend', newQuestionHTML);
      updateQuestionNumbers(); // Update question numbers to reflect the new total
    };
  
    // Function to delete all questions
    window.deleteAllQuestions = () => {
      const quizContainer = document.getElementById('quizContainer');
      quizContainer.innerHTML = '';
      questionCount = 0; // Reset the question count
    };
  
    // Function to update question numbers
    const updateQuestionNumbers = () => {
      const questions = document.querySelectorAll('.editable_soal_quiz h3');
      questions.forEach((question, index) => {
        question.textContent = `${index + 1}. ${question.textContent.slice(question.textContent.indexOf('.') + 2)}`;
      });
    };
  });