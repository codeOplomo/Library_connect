const SELECTORS = {
    MOBILE_MENU: '.mobile-menu',
    CART_COUNT: '#cartCount',
    CART_SECTION: '#cartSection',
    MAKE_RESERVATION_BTN: '#makeReservationBtn',
    CLEAR_ALL_BTN: '#clearAllBtn',
    RESERVED_BOOKS_LIST: '#reservedBooksList',
};

const reservedBooksKey = 'reservedBooks';

const mobileMenu = document.querySelector(SELECTORS.MOBILE_MENU);
const cartCountElement = document.querySelector(SELECTORS.CART_COUNT);
const cartSection = document.querySelector(SELECTORS.CART_SECTION);
const makeReservationBtn = document.querySelector(SELECTORS.MAKE_RESERVATION_BTN);
const clearAllBtn = document.querySelector(SELECTORS.CLEAR_ALL_BTN);
const reservedBooksList = document.querySelector(SELECTORS.RESERVED_BOOKS_LIST);

document.addEventListener('DOMContentLoaded', () => {
    initializeCartCount();
    setupEventListeners();
    updateCartSection();
    
});


function setupEventListeners() {
    cartSection.addEventListener('change', handleQuantityChange);
    makeReservationBtn.addEventListener('click', makeReservation);
    clearAllBtn.addEventListener('click', clearAllReservedBooks);
}

function initializeCartCount() {
    const reservedBooks = getReservedBooks();
    updateCartCount(reservedBooks.length);
}

function clearAllReservedBooks() {
    clearReservedBooks();
    updateCartCount(0);
    updateCartSection();
}

function handleQuantityChange(event) {
    if (event.target.id === 'quantitySelect') {
        const title = event.target.dataset.title;
        const newQuantity = parseInt(event.target.value);
        updateReservedBooksQuantity(title, newQuantity);
        updateCartSection();
    }
}

// function confirmReservation() {
//     const reservedBooks = getReservedBooks();
//     const returnDate = getReturnDate();

//     if (!returnDate) {
//         alert('Please select a return date.');
//         return;
//     }

//     if (reservedBooks.length > 0) {
//         const groupedBooks = groupBooksByTitle(reservedBooks);
//         const booksWithQuantity = Object.entries(groupedBooks).map(([title, quantity]) => ({
//             bookId: reservedBooks.find(book => book.title === title).id,
//             description: `${title} (${quantity} books)`, // Include quantity in the description
//             quantity: quantity,
//         }));

//         // Make an AJAX request to store reservation data in the database
//         fetch('/reservations', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify({ reservedBooks: booksWithQuantity, returnDate }),
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status) {
//                 alert('Reservation successful!');
//                 clearReservedBooks();
//                 updateCartSection();
//                 window.location.href = '/Gestion_Bibliotheque/Views/User/books.php';
//             } else {
//                 alert('Reservation failed. Please try again.');
//             }
//         })
//         .catch(() => {
//             alert('Reservation failed. Please try again.');
//         });
//     } else {
//         alert('No books are reserved.');
//     }
// }

// function confirmReservation() {
//     var reservedBooks = JSON.parse(sessionStorage.getItem('reservedBooks') || '[]');
//     var returnDate = document.getElementById('returnDate').value;

//     $.ajax({
//         url: '{{ route("reservations.store") }}', // Assuming your route is named "reservations.store"
//         type: 'POST',
//         data: {
//             reservedBooks: reservedBooks,
//             returnDate: returnDate,
//             _token: '{{ csrf_token() }}',
//         },
//         success: function (response) {
//             console.log(response);
//             // Optionally, update the UI or perform other actions here
//             if (response.status) {
//                 alert('Reservation successful');
//                 // Optionally, close the modal or redirect to another page
//                 $('#cartModal').modal('hide');
//             } else {
//                 alert('Reservation failed: ' + response.message);
//             }
//         },
//         error: function (error) {
//             console.log(error);
//             alert('Reservation failed. Please try again.');
//         }
//     });
// }

// $(document).ready(function () {
//     $('#confirmReservationBtn').on('click', confirmReservation);
// });


function makeReservation() {
    const reservedBooks = getReservedBooks();
    const returnDate = getReturnDate();

    if (!returnDate) {
        alert('Please select a return date.');
        return;
    }

    if (reservedBooks.length > 0) {
        const groupedBooks = groupBooksByTitle(reservedBooks);
        const booksWithQuantity = Object.entries(groupedBooks).map(([title, quantity]) => ({
            bookId: reservedBooks.find(book => book.title === title).id,
            description: title,
            quantity: quantity,
        }));
        sendReservationToServer(booksWithQuantity, returnDate)
            .then(response => {
                if (response.status) {
                    alert('Reservation successful!');
                    clearReservedBooks();
                    updateCartSection();
                    window.location.href = '/Gestion_Bibliotheque/Views/User/books.php';
                } else {
                    alert('Reservation failed. Please try again.');
                }
            })
            .catch(() => {
                alert('Reservation failed. Please try again.');
            });
    } else {
        alert('No books are reserved.');
    }
}

function sendReservationToServer(reservedBooks, returnDate) {
    const booksWithQuantity = reservedBooks.map(book => ({ ...book, quantity: book.quantity }));
    return fetch('/Gestion_Bibliotheque/app/Controllers/ReservationController/ReservationController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ reservedBooks: booksWithQuantity, returnDate }),
    });
}

function reserveBook(book) {
    const currentCount = parseInt(cartCountElement.textContent);
    cartCountElement.textContent = currentCount + 1;

    const reservedBooks = getReservedBooks();
    book.quantity = 1;
    reservedBooks.push(book);
    updateReservedBooksInStorage(reservedBooks);

    updateCartCount(currentCount + 1);
    updateCartSection();
    alert('Book reserved successfully!');
}

function updateCartSection() {
    const reservedBooks = getReservedBooks();
    updateCartCount(reservedBooks.length);
    reservedBooksList.innerHTML = '';

    const groupedBooks = groupBooksByTitle(reservedBooks);

    Object.keys(groupedBooks).forEach(title => {
        const bookDiv = createBookDiv(title, groupedBooks[title]);
        reservedBooksList.appendChild(bookDiv);
    });

    // Reinitialize date-time picker
    initDateTimePicker();
}

function initDateTimePicker() {
    const returnDateInput = $('#returnDate');

    // Check if the datepicker is already initialized
    if (returnDateInput.data('datepicker')) {
        // Destroy the existing datepicker to reinitialize with new options
        returnDateInput.datepicker('destroy');
    }

    returnDateInput.datepicker({
        format: 'dd-mm-yyyy', // Use 'dd-mm-yyyy' for numeric format
        startDate: new Date(),
        endDate: '+20d',
        autoclose: true,
    });

    // Trigger date picker when clicking the icon
    $('#returnDateIcon').click(function () {
        returnDateInput.datepicker('show');
    });

    // Prevent direct text input in the date field
    returnDateInput.on('keydown paste', function (e) {
        e.preventDefault();
    });

    // Update the input value in 'YYYY-MM-DD' format when a date is selected
    returnDateInput.on('changeDate', function (e) {
        const selectedDate = e.format('YYYY-MM-DD');
        returnDateInput.val(selectedDate);
    });
}





function createBookDiv(title, quantity) {
    const bookDiv = document.createElement('div');
    bookDiv.classList.add('col-md-4', 'mb-4');

    const card = document.createElement('div');
    card.classList.add('card', 'h-100');

    const cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.classList.add('btn-close');
    closeButton.setAttribute('aria-label', 'Remove');
    closeButton.addEventListener('click', () => removeReservedBook(title));

    const cardTitle = document.createElement('h5');
    cardTitle.classList.add('card-title');
    cardTitle.textContent = title;

    const bookImage = document.createElement('img');
    bookImage.classList.add('card-img-top');
    bookImage.setAttribute('src', 'path/to/your/book/image.jpg');
    bookImage.setAttribute('alt', 'Book Image');

    const cardText = document.createElement('p');
    cardText.classList.add('card-text');
    cardText.textContent = `Quantity: ${quantity}`;

    cardBody.appendChild(closeButton);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(bookImage);
    cardBody.appendChild(cardText);
    card.appendChild(cardBody);
    bookDiv.appendChild(card);

    return bookDiv;
}

function groupBooksByTitle(books) {
    return books.reduce((acc, book) => {
        acc[book.title] = (acc[book.title] || 0) + 1;
        return acc;
    }, {});
}

function getReservedBooks() {
    return JSON.parse(localStorage.getItem(reservedBooksKey)) || [];
}

function updateReservedBooksInStorage(reservedBooks) {
    localStorage.setItem(reservedBooksKey, JSON.stringify(reservedBooks));
}

function clearReservedBooks() {
    localStorage.removeItem(reservedBooksKey);
}

function updateCartCount(count) {
    cartCountElement.textContent = count;
}

function removeReservedBook(title) {
    var reservedBooks = getReservedBooks();
    var removedBookIndex = reservedBooks.findIndex(book => book.title === title);

    if (removedBookIndex !== -1) {
        var removedQuantity = reservedBooks[removedBookIndex].quantity || 0;
        updateCartCount(-removedQuantity);

        reservedBooks.splice(removedBookIndex, 1);

        updateReservedBooksInStorage(reservedBooks);
        updateCartSection();
    }
}

// Call updateCartCount on page load to initialize the cart count
// updateCartCount();
