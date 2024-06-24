// Function to handle editing materi judul
function editMateriJudul() {
  let newJudul = prompt("Perbarui judul proyek akhir:");
  if (newJudul !== null) {
      updateProjectData('title', newJudul);
      document.querySelector('.editable_nama_materi h2').textContent = newJudul; // Update judul langsung di tampilan
  }
}

// Function to handle editing sections (deskripsi, gambaran umum, hasil akhir)
function editSection(iconElement, fieldName) {
  // Find the next sibling element which should be a <p> tag with class "paragraf"
  let paragraph = iconElement.closest('section').nextElementSibling;

  if (paragraph && paragraph.classList.contains('paragraf')) {
      let sectionContent = paragraph.innerHTML;

      // Create a textarea with the existing content
      let textarea = document.createElement('textarea');
      textarea.style.width = '100%';
      textarea.style.height = '200px';
      textarea.value = sectionContent;

      // Replace the section content with the textarea
      paragraph.innerHTML = '';
      paragraph.appendChild(textarea);

      // Create a save button
      let saveButton = document.createElement('button');
      saveButton.innerText = 'Simpan';
      saveButton.onclick = function() {
          saveText(iconElement, fieldName, textarea.value);
      };
      paragraph.appendChild(saveButton);
  }
}

// Function to save edited text and update UI
function saveText(iconElement, fieldName, newText) {
  // Update UI with the new text
  let paragraph = iconElement.closest('section').nextElementSibling;
  paragraph.innerHTML = newText;

  // Send data to update_data_project.php using Ajax
  updateProjectData(fieldName, newText);
}

// Function to save changes using Ajax
function updateProjectData(field, value) {
  let data = new FormData();
  data.append('field', field);
  data.append('value', value);

  fetch('update_data_project.php', {
      method: 'POST',
      body: data
  })
  .then(response => response.text())
  .then(data => {
      alert(data); // Tampilkan pesan sukses atau error
  })
  .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat memperbarui data proyek');
  });
}

// Function to redirect to another page
function redirectToPage(pageUrl) {
  window.location.href = pageUrl;
}
