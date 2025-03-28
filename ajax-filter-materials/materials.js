jQuery(document).ready(function ($) {
  var currentFilters = {
    price: "",
    species: "",
    length: "",
  };
  var currentPage = 1;
  var isLoading = false;
  var allPostsLoaded = false;

  function showLoading() {
    $(".materials-row").addClass("loading").append('<div class="spinner"></div>');
  }

  function hideLoading() {
    $(".materials-row").removeClass("loading").find(".spinner").remove();
  }

  function fetchFilteredMaterials() {
    showLoading(); 

    var queryString = $.param({
      filters: currentFilters,
      page: currentPage,
    });

    $.ajax({
      url: `/wp-json/wp/v2/materials_filter?${queryString}`,
      method: "GET",
      beforeSend: function (xhr) {
        xhr.setRequestHeader("X-WP-Nonce", ajax_params.nonce);
      },
      success: function (response) {
        hideLoading(); 

        if (currentPage === 1) {
          $(".materials-row").empty();
          
        }
        if (response.posts.length == 0) { 
        
          $(".materials-row").append('<p class="cl-black text-center w-100 p-t1">All items are displayed.</p>');
        }

        if (response.posts.length > 0) {
          var html = response.posts
            .map(function (item) {
              return `
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 col-materials m-t2">
                            <div class="box-card h-100">
                                <div class="card-media">
                                    <a class="w-100 h-100" tab-index="0" href="${item.thumbnail_url}" data-fancybox="gallery" aria-label="${item.title}" title="${item.title}">
                                        <img src="${item.thumbnail_url}" alt="${item.title}" height="241" srcset="${item.srcset}" sizes="${item.sizes}">
                                    </a>
                                </div>
                                <div class="card-footer text-center bg-black">
                                    ${item.price ? `<div class="subheadline cl-l-orange pb-10px text-uppercase wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.2s">$${item.price}</div>` : ""}
                                    <h4 class="cl-white">${item.title}</h4>
                                    ${item.terms ? `<div class="dp-1 cl-white">${item.terms}</div>` : ""}
                                </div>
                            </div>
                        </div>
                    `;
            })
            .join("");
          $(".materials-row").append(html);

          if (response.posts.length < 8) {
            allPostsLoaded = true;
            $("#load-more").hide();
          } else {
            $("#load-more").show();
          }
        } else {
          $("#load-more").hide();
          allPostsLoaded = true;
        }

        isLoading = false;
      },
      error: function () {
        hideLoading(); 
        console.error("Failed to fetch materials.");
        isLoading = false;
      },
    });
  }

  function updateFilters() {
    currentPage = 1; 
    allPostsLoaded = false; 
    fetchFilteredMaterials();
  }

  $(".select-category-price .material-link").on("click", function (e) {
    e.preventDefault(); 
    currentFilters.price = $(this).data("term-id"); 
    $(".dropdown__button__price span")
      .text($(this).text())
      .parent()
      .attr("data-value", currentFilters.price);
    updateFilters();
  });

  $(".select-category-species .material-link").on("click", function (e) {
    e.preventDefault();
    currentFilters.species = $(this).data("term-id");
    $(".dropdown__button__species span")
      .text($(this).text())
      .parent()
      .attr("data-value", currentFilters.species);
    updateFilters();
  });

  $(".select-category-length .material-link").on("click", function (e) {
    e.preventDefault();
    currentFilters.length = $(this).data("term-id");
    $(".dropdown__button__length span")
      .text($(this).text())
      .parent()
      .attr("data-value", currentFilters.length);
    updateFilters();
  });

  $("#load-more").on("click", function () {
    if (!isLoading && !allPostsLoaded) {
      isLoading = true;
      currentPage++;
      fetchFilteredMaterials();
    }
  });
});