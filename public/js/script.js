let reservedBooks = [];

function reserveBook(book) {
    // Check if the book is already in the array
    let existingBook = reservedBooks.find(b => b.title === book.title);
    if (existingBook) {
        existingBook.quantity++;
    } else {
        book.quantity = 1;
        reservedBooks.push(book);
    }
    
    // Update Cart Count
    let cartCount = document.getElementById('cartCount');
    cartCount.textContent = reservedBooks.reduce((acc, b) => acc + b.quantity, 0);
    
    // Update Modal Content
    updateReservedBooksModal();
}

function updateReservedBooksModal() {
    let modalContent = '';
    reservedBooks.forEach(book => {
        modalContent += `<div class="col-md-4">
                            <div class="card">
                                <img src="${book.image_link}" class="card-img-top" alt="${book.title}">
                                <div class="card-body">
                                    <h5 class="card-title">${book.title}</h5>
                                    <p>Quantity: ${book.quantity}</p>
                                </div>
                            </div>
                         </div>`;
    });
    document.getElementById('reservedBooksList').innerHTML = modalContent;
}

// function initDateTimePicker() {
//         const returnDateInput = $('#return_date');
    
//         // Check if the datepicker is already initialized
//         if (returnDateInput.data('datepicker')) {
//             // Destroy the existing datepicker to reinitialize with new options
//             returnDateInput.datepicker('destroy');
//         }
    
//         returnDateInput.datepicker({
//             format: 'dd-mm-yyyy', // Use 'dd-mm-yyyy' for numeric format
//             startDate: new Date(),
//             endDate: '+20d',
//             autoclose: true,
//         });
    
//         // Trigger date picker when clicking the icon
//         $('#returnDateIcon').click(function () {
//             returnDateInput.datepicker('show');
//         });
    
//         // Prevent direct text input in the date field
//         returnDateInput.on('keydown paste', function (e) {
//             e.preventDefault();
//         });
    
//         // Update the input value in 'YYYY-MM-DD' format when a date is selected
//         returnDateInput.on('changeDate', function (e) {
//             const selectedDate = e.format('YYYY-MM-DD');
//             returnDateInput.val(selectedDate);
//         });
    
//     }


// const SELECTORS = {
//     MOBILE_MENU: '.mobile-menu',
//     CART_COUNT: '#cartCount',
//     CART_SECTION: '#cartSection',
//     MAKE_RESERVATION_BTN: '#makeReservationBtn',
//     CLEAR_ALL_BTN: '#clearAllBtn',
//     RESERVED_BOOKS_LIST: '#reservedBooksList',
// };

// const reservedBooksKey = 'reservedBooks';

// const mobileMenu = document.querySelector(SELECTORS.MOBILE_MENU);
// const cartCountElement = document.querySelector(SELECTORS.CART_COUNT);
// const cartSection = document.querySelector(SELECTORS.CART_SECTION);
// const makeReservationBtn = document.querySelector(SELECTORS.MAKE_RESERVATION_BTN);
// const clearAllBtn = document.querySelector(SELECTORS.CLEAR_ALL_BTN);
// const reservedBooksList = document.querySelector(SELECTORS.RESERVED_BOOKS_LIST);

// document.addEventListener('DOMContentLoaded', () => {
//     initializeCartCount();
//     setupEventListeners();
//     updateCartSection();

//     // Attach event listener for the "Reserve it" buttons
//     document.addEventListener('click', (event) => {
//         if (event.target.classList.contains('reserve-button')) {
//             reserveBook(JSON.parse(event.target.dataset.book));
//         }
//     });
// });


// function setupEventListeners() {
//     cartSection.addEventListener('change', handleQuantityChange);
//     makeReservationBtn.addEventListener('click', makeReservation);
//     clearAllBtn.addEventListener('click', clearAllReservedBooks);
// }

// function initializeCartCount() {
//     const reservedBooks = getReservedBooks();
//     updateCartCount(reservedBooks.length);
// }

// function clearAllReservedBooks() {
//     clearReservedBooks();
//     updateCartCount(0);
//     updateCartSection();
// }



// function reserveBook(book) {
//     console.log("Clicked Reserve");
    
//     const reservedBooks = getReservedBooks();

//     // Check if the book is already reserved
//     const existingBook = reservedBooks.find((reservedBook) => reservedBook.title === book.title);

//     if (existingBook) {
//         // If the book is already reserved, increment the quantity
//         existingBook.quantity += 1;
//     } else {
//         // If the book is not already reserved, add it to the reserved books array
//         book.quantity = 1;
//         reservedBooks.push(book);
//     }

//     // Update the reserved books in storage
//     updateReservedBooksInStorage(reservedBooks);

//     // Update the cart count
//     const updatedCount = reservedBooks.reduce((total, book) => total + (book.quantity || 0), 0);
//     updateCartCount(updatedCount);

//     // Update the cart section and reservation modal
//     updateCartSection();

//     alert('Book reserved successfully!');
// }


// function handleQuantityChange(event) {
//     if (event.target.id === 'quantitySelect') {
//         const title = event.target.dataset.title;
//         const newQuantity = parseInt(event.target.value);

//         // Update the reserved books quantity
//         updateReservedBooksQuantity(title, newQuantity);

//         // Update the cart section and reservation modal
//         updateCartSection();
//     }
// }


// function updateCartSection() {
//     const reservedBooks = getReservedBooks();
//     updateCartCount(reservedBooks.length);
//     reservedBooksList.innerHTML = '';

//     const groupedBooks = groupBooksByTitle(reservedBooks);

//     Object.keys(groupedBooks).forEach(title => {
//         const bookDiv = createBookDiv(title, groupedBooks[title]);
//         reservedBooksList.appendChild(bookDiv);
//     });

//     // Reinitialize date-time picker
//     initDateTimePicker();
// }

// function initDateTimePicker() {
//     const returnDateInput = $('#return_date');

//     // Check if the datepicker is already initialized
//     if (returnDateInput.data('datepicker')) {
//         // Destroy the existing datepicker to reinitialize with new options
//         returnDateInput.datepicker('destroy');
//     }

//     returnDateInput.datepicker({
//         format: 'dd-mm-yyyy', // Use 'dd-mm-yyyy' for numeric format
//         startDate: new Date(),
//         endDate: '+20d',
//         autoclose: true,
//     });

//     // Trigger date picker when clicking the icon
//     $('#returnDateIcon').click(function () {
//         returnDateInput.datepicker('show');
//     });

//     // Prevent direct text input in the date field
//     returnDateInput.on('keydown paste', function (e) {
//         e.preventDefault();
//     });

//     // Update the input value in 'YYYY-MM-DD' format when a date is selected
//     returnDateInput.on('changeDate', function (e) {
//         const selectedDate = e.format('YYYY-MM-DD');
//         returnDateInput.val(selectedDate);
//     });

// }


// function createBookDiv(title, quantity) {
//     const bookDiv = document.createElement('div');
//     bookDiv.classList.add('col-md-4', 'mb-4');

//     const card = document.createElement('div');
//     card.classList.add('card', 'h-100');

//     const cardBody = document.createElement('div');
//     cardBody.classList.add('card-body');

//     const closeButton = document.createElement('button');
//     closeButton.type = 'button';
//     closeButton.classList.add('btn-close');
//     closeButton.setAttribute('aria-label', 'Remove');
//     closeButton.addEventListener('click', () => removeReservedBook(title));

//     const cardTitle = document.createElement('h5');
//     cardTitle.classList.add('card-title');
//     cardTitle.textContent = title;

//     const bookImage = document.createElement('img');
//     bookImage.classList.add('card-img-top');
//     bookImage.setAttribute('src', 'path/to/your/book/image.jpg');
//     bookImage.setAttribute('alt', 'Book Image');

//     const cardText = document.createElement('p');
//     cardText.classList.add('card-text');
//     cardText.textContent = `Quantity: ${quantity}`;

//     cardBody.appendChild(closeButton);
//     cardBody.appendChild(cardTitle);
//     cardBody.appendChild(bookImage);
//     cardBody.appendChild(cardText);
//     card.appendChild(cardBody);
//     bookDiv.appendChild(card);

//     return bookDiv;
// }

// function groupBooksByTitle(books) {
//     return books.reduce((acc, book) => {
//         acc[book.title] = (acc[book.title] || 0) + 1;
//         return acc;
//     }, {});
// }

// function getReservedBooks() {
//     return JSON.parse(localStorage.getItem(reservedBooksKey)) || [];
// }

// function updateReservedBooksInStorage(reservedBooks) {
//     localStorage.setItem(reservedBooksKey, JSON.stringify(reservedBooks));
// }

// function clearReservedBooks() {
//     localStorage.removeItem(reservedBooksKey);
// }

// function updateCartCount(count) {
//     cartCountElement.textContent = count;
// }

// function removeReservedBook(title) {
//     var reservedBooks = getReservedBooks();
//     var removedBookIndex = reservedBooks.findIndex(book => book.title === title);

//     if (removedBookIndex !== -1) {
//         var removedQuantity = reservedBooks[removedBookIndex].quantity || 0;
//         updateCartCount(-removedQuantity);

//         reservedBooks.splice(removedBookIndex, 1);

//         updateReservedBooksInStorage(reservedBooks);
//         updateCartSection();
//     }
// }

// Call updateCartCount on page load to initialize the cart count
// updateCartCount();






////+++++++++++++++++++++++


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


// function makeReservation() {
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
//             description: title,
//             quantity: quantity,
//         }));
//         sendReservationToServer(booksWithQuantity, returnDate)
//             .then(response => {
//                 if (response.status) {
//                     alert('Reservation successful!');
//                     clearReservedBooks();
//                     updateCartSection();
//                     window.location.href = '/Reservations';
//                 } else {
//                     alert('Reservation failed. Please try again.');
//                 }
//             })
//             .catch(() => {
//                 alert('Reservation failed. Please try again.');
//             });
//     } else {
//         alert('No books are reserved.');
//     }
// }


// function sendReservationToServer(reservedBooks, returnDate) {
//     const booksWithQuantity = reservedBooks.map(book => ({ ...book, quantity: book.quantity }));
//     return fetch('/Gestion_Bibliotheque/app/Controllers/ReservationController/ReservationController.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ reservedBooks: booksWithQuantity, returnDate }),
//     });
// }


// function makeReservation() {
//     const reservedBooks = getReservedBooks();
//     const returnDate = $('#return_date').val(); // Ensure the selector matches your input ID

//     if (!returnDate) {
//         alert('Please select a return date.');
//         return;
//     }

//     if (reservedBooks.length > 0) {
//         const reservationData = {
//             reservedBooks: reservedBooks.map(book => ({
//                 bookId: book.id,
//                 description: book.title,
//                 quantity: book.quantity,
//             })),
//             returnDate: returnDate,
//         };

//         fetch('/reservations', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             body: JSON.stringify(reservationData),
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status) {
//                 alert('Reservation successful!');
//                 // Additional actions after success
//             } else {
//                 alert('Reservation failed. Please try again.');
//             }
//         })
//         .catch(error => {
//             alert('Reservation failed. Please try again.');
//             console.error('Error:', error);
//         });
//     } else {
//         alert('No books are reserved.');
//     }
// }


// $(document).ready(function() {
//     $('#confirmReservationButton').click(function() {
//         var reservedBooks = // get reserved books data
//         var returnDate = $('#return_date').val();

//         $.ajax({
//             url: '/reservations/ajax', // URL of your server-side route
//             type: 'POST',
//             data: {
//                 reservedBooks: reservedBooks,
//                 returnDate: returnDate,
//                 _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
//             },
//             success: function(response) {
//                 // Handle success (e.g., show a success message)
//             },
//             error: function(error) {
//                 // Handle error (e.g., show an error message)
//             }
//         });
//     });
// });
