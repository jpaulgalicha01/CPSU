const SaveBookSched = document.getElementById("btnSaveBookSched");
const calendarDays = document.getElementById("calendarDays");
const monthYear = document.getElementById("monthYear");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");

const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
let selectedDays = new Set(); // Set to store selected days

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

// Function to fetch selected days from the server
function fetchSelectedDates(month, year) {
  return fetch(`inputConfig.php?month=${month + 1}&year=${year}`)
    .then((response) => response.json())
    .then((data) => {
      selectedDays = new Set(
        data.map((res) => {
          return new Date(res.date).getDate();
        })
      );
    })
    .catch((err) => console.error(err));
}

// Function to render the calendar
function renderCalendar(month, year) {
  calendarDays.innerHTML = ""; // Clear previous days
  monthYear.innerHTML = `${months[month]} ${year}`; // Set Month and Year in header

  const firstDay = new Date(year, month, 1).getDay(); // First day of the month
  const daysInMonth = new Date(year, month + 1, 0).getDate(); // Total days in the month

  // Adding blank days for previous month
  for (let i = 0; i < firstDay; i++) {
    const blankDay = document.createElement("div");
    calendarDays.appendChild(blankDay);
  }

  // Adding days of the month
  for (let i = 1; i <= daysInMonth; i++) {
    const day = document.createElement("div");
    day.innerHTML = i;

    // Highlight current day
    if (
      i === currentDate.getDate() &&
      month === currentDate.getMonth() &&
      year === currentDate.getFullYear()
    ) {
      day.innerHTML = `<span class="current-day">${i}</span>`;
    }

    // Check if the day is already selected
    if (selectedDays.has(i)) {
      day.classList.add("selected-day");
    }

    // Add click event to each day
    day.addEventListener("click", () => {
      if (selectedDays.has(i)) {
        selectedDays.delete(i);
        savedReservedDates(i);

        day.classList.remove("selected-day");
      } else {
        selectedDays.add(i);
        day.classList.add("selected-day");
        savedReservedDates(i);
      }

      console.log(`Selected Dates:`, Array.from(selectedDays));
    });

    calendarDays.appendChild(day);
  }
}

// Function to initialize and render the calendar with selected dates
function initializeCalendar() {
  fetchSelectedDates(currentMonth, currentYear).then(() => {
    renderCalendar(currentMonth, currentYear);
  });
}

// Previous button click
prevBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  initializeCalendar();
});

// Next button click
nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  initializeCalendar();
});

// Initial render
initializeCalendar();

// Saving or Updating Removing Accepting Booking
async function savedReservedDates(selectedDays) {
  $.ajax({
    type: "GET",
    url: "inputConfig.php",
    data: {
      data: selectedDays,
      function: "saved_reserved_date",
    },
    success: function (response) {
      var res = jQuery.parseJSON(response);
      console.log(res);
      if (res.status == 200) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1500,
        });
        Toast.fire({
          icon: res.icon,
          title: res.message,
        });
      } else if (res.status == 500) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1500,
        });
        Toast.fire({
          icon: res.icon,
          title: res.message,
        });
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1500,
        });
        Toast.fire({
          icon: "question",
          title: "Not Found",
        });
      }
    },
  });
}
