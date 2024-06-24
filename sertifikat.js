import { PDFDocument, rgb } from 'pdf-lib';

document.addEventListener('DOMContentLoaded', async function() {
    try {
        const url = './sertifikatLeo.pdf';
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

        // Load PDF yang sudah ada
        const pdfDoc = await PDFDocument.load(existingPdfBytes);

        // Menambahkan halaman baru jika diperlukan
        const page = pdfDoc.getPage(0); // Misalnya, mengambil halaman pertama

        // Menghitung dimensi halaman
        const { width, height } = page.getSize();

        // Menghitung ukuran teks
        const fontSize = 20; // ukuran font
        const text = 'Tulisan di Tengah Halaman';
        const font = await pdfDoc.embedFont('Helvetica'); // menggunakan font Helvetica
        const textWidth = font.widthOfTextAtSize(text, fontSize);

        // Menempatkan teks di tengah halaman
        const textX = (width - textWidth) / 2;
        const textY = height / 2;

        // Menggambar teks di posisi tengah halaman
        page.drawText(text, {
            x: textX,
            y: textY,
            size: fontSize,
            font: font,
            color: rgb(0, 0, 0), // warna teks hitam
        });

        // Menyimpan PDF yang sudah diubah
        const modifiedPdfBytes = await pdfDoc.save();

        // Membuat URL objek untuk menampilkannya di halaman web
        const modifiedBlob = new Blob([modifiedPdfBytes], { type: 'application/pdf' });
        const modifiedUrlPdf = URL.createObjectURL(modifiedBlob);

        // Mengatur elemen PDF Viewer dengan URL objek yang baru
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.setAttribute('data', modifiedUrlPdf); // atau gunakan 'data' untuk <object> atau <iframe>

        // Mengatur judul halaman HTML
        document.title = 'Sertifikat dengan Teks di Tengah Halaman';

    } catch (error) {
        console.error('Error displaying PDF:', error);
        alert('Error occurred while displaying the PDF. Please try again later.');
    }
});