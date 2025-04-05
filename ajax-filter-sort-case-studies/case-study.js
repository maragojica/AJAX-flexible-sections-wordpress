document.addEventListener('DOMContentLoaded', function () {
    const categoryDropdown = document.getElementById('category-dropdown');
    const sortDropdown = document.getElementById('sort-dropdown');
    const categorySelected = document.getElementById('category-selected');
    const sortSelected = document.getElementById('sort-selected');
    const caseStudiesList = document.getElementById('case-studies-list');

    let selectedCategory = 'all'; // Default category is 'all'
    let selectedSort = 'recent'; // Default sort is 'recent'

    // Toggle dropdown visibility
    categoryDropdown.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent the click from propagating to the document
        categoryDropdown.classList.toggle('open');
    });

    sortDropdown.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent the click from propagating to the document
        sortDropdown.classList.toggle('open');
    });


    // Close dropdowns when clicking outside
    document.addEventListener('click', function () {
        categoryDropdown.classList.remove('open');
        sortDropdown.classList.remove('open');
    });

    // Handle Category Selection
    categoryDropdown.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.category-item')) {
            selectedCategory = e.target.getAttribute('data-category');
            const selectedCategoryText = e.target.textContent;

            // Update the selected category text
            categorySelected.textContent = selectedCategoryText;

            // Close the dropdown
            categoryDropdown.classList.remove('open');

            // Fetch filtered case studies
            fetchFilteredCaseStudies(selectedCategory, selectedSort);
        }
    });

    // Handle Sort Selection
    sortDropdown.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.sort-item')) {
            selectedSort = e.target.getAttribute('data-sort');
            const selectedSortText = e.target.textContent;

            // Update the selected sort text
            sortSelected.textContent = selectedSortText;

            // Close the dropdown
            sortDropdown.classList.remove('open');

            // Fetch filtered case studies
            fetchFilteredCaseStudies(selectedCategory, selectedSort);
        }
    });

    // Function to Fetch Case Studies Based on Filters
    function fetchFilteredCaseStudies(category, sort) {
        const categoryUrl = `${caseStudiesData.ajax_url}?action=filter_case_studies&category=${category}&sort=${sort}`;

        fetch(categoryUrl)
            .then(response => response.json())
            .then(data => {
                caseStudiesList.innerHTML = ''; // Clear current list
                if (data.length > 0) {
                    data.forEach(caseStudy => {
                         // Filter out the "All" category from the categories list
                         let filteredCategories;
                         if (Array.isArray(caseStudy.categories)) {
                             // If categories are an array
                             filteredCategories = caseStudy.categories
                                 .filter(cat => cat.toLowerCase() !== 'all') // Replace 'all' with the actual name or slug
                                 .join(', ');
                         } else {
                             // If categories are a string
                             filteredCategories = caseStudy.categories
                                 .split(', ')
                                 .filter(cat => cat.toLowerCase() !== 'all') // Replace 'all' with the actual name or slug
                                 .join(', ');
                         }
                        const caseStudyHTML = `
                            <div class="case-studies-card">
                                <div class="case-study-image"><a href="${caseStudy.link}"><img src="${caseStudy.image}" alt="${caseStudy.title}"></a></div>
                                <div class="case-study-content">
                                    <h2 class="entry-title"><a class="entry-title-link" href="${caseStudy.link}">${caseStudy.title}</a></h2>
                                    <p class="entry-meta"><span>${caseStudy.categories}</span> <time class="entry-time">${caseStudy.date}</time></p>
                                    <div class="entry-content">${caseStudy.excerpt}</div>                               
                                    <a href="${caseStudy.link}" class="case-study-more">Read More</a>
                                </div>
                            </div>
                        `;
                        caseStudiesList.innerHTML += caseStudyHTML;
                    });
                } else {
                    caseStudiesList.innerHTML = '<p>No case studies found.</p>';
                }
            })
            .catch(error => console.error('Error fetching filtered case studies:', error));
    }

    // Initial fetch to load all case studies
    fetchFilteredCaseStudies(selectedCategory, selectedSort);
});