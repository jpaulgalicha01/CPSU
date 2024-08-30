const calendarDays = document.getElementById("calendarDays");
const monthYear = document.getElementById("monthYear");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");

const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
const selectedDays = new Set(); // Set to store selected days

// Array for month names
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
    const dayKey = `${year}-${month}-${i}`;
    if (selectedDays.has(dayKey)) {
      day.classList.add("selected-day");
    }

    // Add click event to each day
    day.addEventListener("click", () => {
      // Check if the day is already selected
      if (selectedDays.has(dayKey)) {
        // If already selected, deselect it
        selectedDays.delete(dayKey);
        day.classList.remove("selected-day");
      } else {
        // Otherwise, select it
        selectedDays.add(dayKey);
        day.classList.add("selected-day");
      }

      console.log(`Selected Dates:`, Array.from(selectedDays));
    });

    calendarDays.appendChild(day);
  }
}

// Previous button click
prevBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar(currentMonth, currentYear);
});

// Next button click
nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar(currentMonth, currentYear);
});

// Initial render
renderCalendar(currentMonth, currentYear);
