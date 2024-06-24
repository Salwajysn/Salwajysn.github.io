// File: update_progress.js

function updateProgress(userId, materiId, kelasId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_progress.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Progres berhasil diupdate");
                // Optional: Tampilkan pesan sukses atau update UI sesuai dengan respon
                location.reload(); // Reload halaman setelah berhasil
            } else {
                console.error("Gagal mengupdate progres:", xhr.status, xhr.responseText);
            }
        }
    };

    var params = "userId=" + encodeURIComponent(userId) + 
                 "&materiId=" + encodeURIComponent(materiId) + 
                 "&kelasId=" + encodeURIComponent(kelasId);
    xhr.send(params);
}
