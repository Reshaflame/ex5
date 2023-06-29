

var bookUrl = 'https://www.googleapis.com/books/v1/volumes?q=';
var bookName = 'Harry Potter';

var newUrl = bookUrl + bookName;

document.getElementById('clickMe').onclick = function () { /* do nothing */ };

if (window.location.href.includes("book.php")) {
    // Create a button element
    var backButton = document.createElement('button');
    backButton.textContent = 'Go Back';
    backButton.classList.add('view');
    backButton.addEventListener('click', goBack);

    // Append the button to the body or any desired container element
    document.body.appendChild(backButton);

    // Function to go back in history
    function goBack() {
        history.back();
    }
}
// Get the select element
// Get the category select element
var categorySelect = document.getElementById("category-select");

// Fetch the categories from the JSON file
fetch("data/categories.json")
    .then(response => response.json())
    .then(data => {
        // Loop through the categories and add options to the select element
        data.category.forEach(category => {
            var option = document.createElement("option");
            option.value = category.name;
            option.textContent = category.name;
            categorySelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error("Error fetching categories:", error);
    });

// Add event listener for change event
categorySelect.addEventListener("change", filterBooksByCategory);

// Function to filter books by selected category
function filterBooksByCategory() {
    // Get the selected category
    var selectedCategory = categorySelect.value;

    // Get all book elements
    var bookElements = document.querySelectorAll(".col-md-6");

    // Loop through book elements
    for (var i = 0; i < bookElements.length; i++) {
        var bookElement = bookElements[i];

        // Get the data-category attribute value of each book
        var bookCategory = bookElement.getAttribute("data-category");

        // Show or hide book element based on selected category
        if (selectedCategory === "all" || selectedCategory === bookCategory) {
            bookElement.style.display = "block";
        } else {
            bookElement.style.display = "none";
        }
    }
}


