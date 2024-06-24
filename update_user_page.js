// update_user_page.js

// Fungsi untuk menyimpan konten yang diedit dan memperbarui halaman pengguna
function saveText(paragraph, newText) {
    paragraph.innerHTML = newText;

    // Permintaan AJAX untuk memperbarui halaman pengguna
    $.ajax({
        url: 'update_user_page.php',
        method: 'POST',
        data: { section_id: paragraph.id, new_content: newText },
        success: function(response) {
            console.log('Halaman pengguna berhasil diperbarui.');
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan saat memperbarui halaman pengguna:', error);
        }
    });
}
