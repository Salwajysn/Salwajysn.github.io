// REDIRECTING
function redirectToPage(targetedPage) {
  window.location.href = targetedPage;
  window.scroll(0, 0);
}

function showInput(button) {
  var parentDiv = button.parentNode;
  var nilaiInput = parentDiv.querySelector('.nilaiInput');
  var saveButton = parentDiv.querySelector('button:last-of-type');
  nilaiInput.style.display = 'block';
  saveButton.style.display = 'block';
  button.style.display = 'none';
}

function saveNilai(button) {
  var parentDiv = button.parentNode;
  var nilaiInput = parentDiv.querySelector('.nilaiInput');
  var nilai = parseInt(nilaiInput.value);

  if (nilai < 0) {
    alert("Nilai tidak boleh kurang dari 0!");
    return;
  }
  else if (nilai > 100) {
    alert("Nilai tidak boleh lebih dari 100!");
    return;
  }

  var nilaiText = parentDiv.querySelector('.nilaiText');
  nilaiText.innerText = "Nilai: " + nilai;
  nilaiInput.style.display = "none";
  button.style.display = "none";
}

function showSuccessMessage() {
  alert("Selamat, sertifikat berhasil dibuat!");
}