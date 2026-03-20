<!-- back button and search option -->
<script>
    let searchTimeout;

    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keyup", function () {
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
    }

    const searchInputInterior = document.getElementById("searchInputInterior");
    if (searchInputInterior) {
        searchInputInterior.addEventListener("keyup", function () {
            clearTimeout(searchTimeout);
            let keyword = this.value.trim();
            
            if (keyword.length < 1) {
                document.getElementById('defaultList').style.display = 'flex';
                document.getElementById('searchResults').style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(function() {
                fetch('<?php echo base_url("precut/search_interior"); ?>?keyword=' + encodeURIComponent(keyword))
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        
                        data.brands.forEach(brand => {
                            let imgSrc = brand.brand_image ? '<?php echo base_url("assets/images/brands/"); ?>' + brand.brand_image : '';
                            let brandSlug = brand.brand_name.toLowerCase().replace(/ /g, '-');
                            html += `<div class="col-md-2 col-4 brand-logo">
                                <a href="<?php echo base_url('interior/'); ?>${brandSlug}">
                                    ${imgSrc ? `<img src="${imgSrc}" width="100">` : '<span>No image</span>'}
                                    <h3>${brand.brand_name}</h3>
                                </a>
                            </div>`;
                        });
                        
                        data.models.forEach(model => {
                            let imgSrc = model.brand_image ? '<?php echo base_url("assets/images/brand-model/"); ?>' + model.image : '';
                            let brandSlug = model.brand_name.toLowerCase().replace(/ /g, '-');
                            let modelSlug = model.model_name.toLowerCase().replace(/ /g, '-');
                            html += `<div class="col-md-2 col-4 brand-logo">
                                <a href="<?php echo base_url('interior/'); ?>${brandSlug}/${modelSlug}">
                                    ${imgSrc ? `<img src="${imgSrc}" width="100">` : '<span>No image</span>'}
                                    <h3>${model.model_name}</h3>
                                </a>
                            </div>`;
                        });
                        
                        if (html === '') {
                            html = '<p class="text-center col-12">No results found</p>';
                        }
                        
                        document.getElementById('searchResults').innerHTML = html;
                        document.getElementById('defaultList').style.display = 'none';
                        document.getElementById('searchResults').style.display = 'flex';
                    });
            }, 300);
        });
    }

    const searchInputExterior = document.getElementById("searchInputExterior");
    if (searchInputExterior) {
        searchInputExterior.addEventListener("keyup", function () {
            clearTimeout(searchTimeout);
            let keyword = this.value.trim();
            
            if (keyword.length < 1) {
                document.getElementById('defaultList').style.display = 'flex';
                document.getElementById('searchResults').style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(function() {
                fetch('<?php echo base_url("precut/search_exterior"); ?>?keyword=' + encodeURIComponent(keyword))
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        
                        data.brands.forEach(brand => {
                            let imgSrc = brand.brand_image ? '<?php echo base_url("assets/images/brands/"); ?>' + brand.brand_image : '';
                            let brandSlug = brand.brand_name.toLowerCase().replace(/ /g, '-');
                            html += `<div class="col-md-2 col-4 brand-logo">
                                <a href="<?php echo base_url('interior/'); ?>${brandSlug}">
                                    ${imgSrc ? `<img src="${imgSrc}" width="100">` : '<span>No image</span>'}
                                    <h3>${brand.brand_name}</h3>
                                </a>
                            </div>`;
                        });
                        
                        data.models.forEach(model => {
                            let imgSrc = model.brand_image ? '<?php echo base_url("assets/images/brand-model/"); ?>' + model.image : '';
                            let brandSlug = model.brand_name.toLowerCase().replace(/ /g, '-');
                            let modelSlug = model.model_name.toLowerCase().replace(/ /g, '-');
                            html += `<div class="col-md-2 col-4 brand-logo">
                                <a href="<?php echo base_url('interior/'); ?>${brandSlug}/${modelSlug}">
                                    ${imgSrc ? `<img src="${imgSrc}" width="100">` : '<span>No image</span>'}
                                    <h3>${model.brand_name} ${model.model_name}</h3>
                                </a>
                            </div>`;
                        });
                        
                        if (html === '') {
                            html = '<p class="text-center col-12">No results found</p>';
                        }
                        
                        document.getElementById('searchResults').innerHTML = html;
                        document.getElementById('defaultList').style.display = 'none';
                        document.getElementById('searchResults').style.display = 'flex';
                    });
            }, 300);
        });
    }

    function goBack() {
        window.history.back();
    }
    
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
