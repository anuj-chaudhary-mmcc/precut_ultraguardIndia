<!-- back button and search option -->
<script>
   // Brand name search functionality
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let brands = document.querySelectorAll(".brand-logo");

        brands.forEach(function (brand) {
            let brandName = brand.querySelector("h3").textContent.toLowerCase();
            if (brandName.includes(filter)) {
                brand.style.display = "block";
            } else {
                brand.style.display = "none";
            }
        });
    });

    // Optional: Back function if not already defined
    function goBack() {
        window.history.back();
    }
    
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
