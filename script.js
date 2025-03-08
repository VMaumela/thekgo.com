console.log("Website loaded successfully!");


document.getElementById("imageModal").style.display = "none";


const images = document.querySelectorAll(".popup-img");
const modal = document.getElementById("imageModal");
const modalImg = document.getElementById("modalImg");
const closeBtn = document.querySelector(".close");

// Add click event to each image
images.forEach(img => {
    img.addEventListener("click", function() {
        modal.style.display = "flex";
        modalImg.src = this.src;
    });
});

// Close the modal when clicking the close button
closeBtn.addEventListener("click", function() {
    modal.style.display = "none";
});

// Close modal when clicking outside the image
modal.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
