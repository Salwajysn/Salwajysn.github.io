let subMenu = document.getElementById('subMenu');

function toggleMenu() {
  subMenu.classList.toggle('open-menu');
}

document.addEventListener("DOMContentLoaded", function() {
  const logoutLink = document.getElementById("logOut");

  // Handle logout
  logoutLink.addEventListener("click", function(event) {
    event.preventDefault();
    alert("Logging out...");
    // Redirect to landing page
    window.location.href = "index.php";
  });
});

//============================================================================
function navigateTo(contentId, targetPage) {
  if (targetPage) {
      // Navigate to another page with a fragment identifier
      window.location.href = `${targetPage}#${contentId}`;
      // Scroll to the top of the page
      window.scrollTo(0, 0);
  } else {
      // Internal navigation: Remove 'active' class from all content sections
      let allContent = document.querySelectorAll('.content');
      allContent.forEach(function(content) {
          content.classList.remove('active');
      });

      // Add 'active' class to the selected content section
      var selectedContent = document.getElementById(contentId);
      if (selectedContent) {
          selectedContent.classList.add('active');
          // Scroll to the top of the page
          window.scrollTo(0, 0);
      }
  }
}

document.addEventListener("DOMContentLoaded", function() {
  // Check if the URL contains a fragment identifier
  if (window.location.hash) {
      // Extract the fragment identifier (without the '#')
      var contentId = window.location.hash.substring(1);

      // Remove 'active' class from all content sections
      let allContent = document.querySelectorAll('.content');
      allContent.forEach(function(content) {
          content.classList.remove('active');
      });

      // Add 'active' class to the selected content section
      var selectedContent = document.getElementById(contentId);
      if (selectedContent) {
          // Scroll to the top of the page
          window.scrollTo(0, 0);
          selectedContent.classList.add('active');
      }
  }
});

// =================================================================
// CLICK BUTTON 'KELOLA KELAS'
function activateAndScrollTo(targetDivId) {
  // Remove 'active' class from all content sections
  let allContent = document.querySelectorAll('.content');
  allContent.forEach(function(content) {
    content.classList.remove('active');
  });

  // Add 'active' class to the selected content section
  var selectedContent = document.getElementById(targetDivId);
  if (selectedContent) {
    selectedContent.classList.add('active');
    // Scroll to the top of the selected content section

    window.scrollTo(0, 0);
  }
}

// CLICK BUTTON TO NILAI PROYEK AKHIR
function activateAndScrollTo2(targetDivId, scrollToId) {
  // Remove 'active' class from all content sections
  let allContent = document.querySelectorAll('.content');
  allContent.forEach(function(content) {
    content.classList.remove('active');
  });

  // Add 'active' class to the selected content section
  var selectedContent = document.getElementById(targetDivId);
  if (selectedContent) {
    selectedContent.classList.add('active');

    // Scroll to the top of the selected content section
    selectedContent.scrollIntoView({ behavior: 'smooth' });

    // Scroll to the specific ID within the selected content section
    var scrollToElement = selectedContent.querySelector('#' + scrollToId);
    if (scrollToElement) {
      scrollToElement.scrollIntoView({ behavior: 'smooth' });
    }
  }
}


// REDIRECTING HALAMAN ADMIN
function redirectToPage3(targetedPage) {
  window.location.href = targetedPage;
  window.scroll(0,0);
}