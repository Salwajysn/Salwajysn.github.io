const profilePicture = document.getElementById('profilePicture');

profilePicture.addEventListener('click', function() {
  const fileInput = document.createElement('input');
  fileInput.type = 'file';
  fileInput.accept = 'image/*';

  fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
      const dataURL = event.target.result;
      profilePicture.src = dataURL;

      // Store data URL in local storage
      localStorage.setItem("profilePictureURL", dataURL);
    };

    reader.readAsDataURL(file);
  });

  fileInput.click();
});

// Retrieve data URL from local storage and set src if available
const storedDataURL = localStorage.getItem("profilePictureURL");
if (storedDataURL) {
  profilePicture.src = storedDataURL;
}