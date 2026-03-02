 // Function to change main image, number, and model text
    function changeImage(imagePath, number, modelText, button) {
        document.getElementById('mainImage').src = imagePath;
        document.getElementById('imageNumber').textContent = number;
        document.getElementById('modelText').textContent = modelText;

        // Reset all buttons and set active class
        let buttons = document.querySelectorAll('button');
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    }

    // Open the zoom modal to show full-size image
    function openZoom() {
        var image = document.getElementById('mainImage');
        var zoomModal = document.getElementById('zoomModal');
        var zoomedImage = document.getElementById('zoomedImage');
        
        zoomedImage.src = image.src;  // Set zoomed image source
        zoomModal.style.display = 'flex';  // Display the modal
    }

    // Close the zoom modal
    function closeZoom() {
        var zoomModal = document.getElementById('zoomModal');
        zoomModal.style.display = 'none';  // Hide the zoom modal
    }