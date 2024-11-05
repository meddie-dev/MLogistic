import './bootstrap';

// Sidebar Toggler
window.addEventListener('DOMContentLoaded', event => {

  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector('#sidebarToggle');
  if (sidebarToggle) {
    // Prsist sidebar toggle between refreshes
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        document.body.classList.toggle('sb-sidenav-toggled');
    }
    sidebarToggle.addEventListener('click', event => {
      event.preventDefault();
      document.body.classList.toggle('sb-sidenav-toggled');
      localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
  }

});

// Simple-DataTables
window.addEventListener('DOMContentLoaded', event => {
  // Simple-DataTables
  // https://github.com/fiduswriter/Simple-DataTables/wiki

  const datatablesSimple = document.getElementById('datatablesSimple');
  if (datatablesSimple) {
    new simpleDatatables.DataTable(datatablesSimple);
  }
});

/**
  * Preloader
  */
const preloader = document.querySelector('#preloader');
if (preloader) {
  window.addEventListener('load', () => {
    preloader.remove();
  });
}

// Pure Counter
new PureCounter();

document.addEventListener("DOMContentLoaded", function() {
  var alertElement = document.getElementById('autoHideAlert');
  if (alertElement) {
      // Set timeout to auto-hide after 3 seconds (3000ms)
      setTimeout(function () {
          var alertInstance = new bootstrap.Alert(alertElement);
          alertInstance.close();
      }, 3000); // 3000ms = 3 seconds
  }
});

// Scroll Top
let scrollTop = document.querySelector('.scroll-top');

function toggleScrollTop() {
  if (scrollTop) {
    window.scrollY > 50 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
  }
}
scrollTop.addEventListener('click', (e) => {
  e.preventDefault();
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});

window.addEventListener('load', toggleScrollTop);
document.addEventListener('scroll', toggleScrollTop);

function aosInit() {
  AOS.init({
    duration: 600,
    easing: 'ease-in-out',
    once: true,
    mirror: false
  });
}
window.addEventListener('load', aosInit);

window.addEventListener('load', function(e) {
  if (window.location.hash) {
    if (document.querySelector(window.location.hash)) {
      setTimeout(() => {
        let section = document.querySelector(window.location.hash);
        let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
        window.scrollTo({
          top: section.offsetTop - parseInt(scrollMarginTop),
          behavior: 'smooth'
        });
      }, 100);
    }
  }
});

// Calendar
import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid'


let calendarEl = document.getElementById('calendar');
let selectedDate = null;



let calendar = new Calendar(calendarEl, {
  plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
  initialView: 'dayGridMonth',
  selectable: true,
  headerToolbar: {
    start: 'title', // will normally be on the left. if RTL, will be on the right
    center: '',
    end: 'dayGridMonth,timeGridDay prev,next' // will normally be on the right. if RTL, will be on the left
  },
  businessHours: [ // specify an array instead
    {
      daysOfWeek: [ 1, 2, 3 ], // Monday, Tuesday, Wednesday
      startTime: '08:00', // 8am
      endTime: '18:00' // 6pm
    },
    {
      daysOfWeek: [ 4, 5 ], // Thursday, Friday
      startTime: '10:00', // 10am
      endTime: '16:00' // 4pm
    }
  ],
 


  select: function(info) {
    const reservationDateInput = document.querySelector('#reservation_date');

    if (selectedDate === info.startStr) {
      selectedDate = null;
      reservationDateInput.value = '';
      calendar.getEvents().forEach(event => event.remove());
      loadExistingReservations();
    } else {
      selectedDate = info.startStr;
      reservationDateInput.value = selectedDate;
      calendar.getEvents().forEach(event => event.remove());
      loadExistingReservations();
      const user_id = window.user_id; 
      calendar.addEvent({
        start: selectedDate,
        allDay: true,
        display: 'background',
      
        backgroundColor: existingReservations.find(reservation => reservation.user_id === user_id) ? '#ffeb3b' : '#2196f3'
      });
    }
  },
});

function loadExistingReservations() {
  existingReservations.forEach(reservation => {
    const eventTitle = `${reservation.vehicle_name} - ${reservation.purpose}`;

    // Determine color based on reservation status
    let backgroundColor;
    switch (reservation.status) {
      case 'Approved':
        backgroundColor = 'rgba(0, 128, 0, 0.5)'; // Green for approved
        break;
      case 'Pending':
        backgroundColor = 'rgba(255, 223, 0, 0.5)'; // Yellow for pending
        break;
      case 'Canceled':
        backgroundColor = 'rgba(255, 0, 0, 0.5)'; // Red for canceled
        break;
      default:
        backgroundColor = '#2196f3'; // Default color for unknown statuses
    }

    // Add each reservation as a separate event with dynamic color
    calendar.addEvent({
      start: reservation.reservation_date,
      title: eventTitle, // Individual title for each reservation
      backgroundColor: backgroundColor,
      borderColor: backgroundColor.replace('0.5', '1'), // Border color to match background with full opacity
      extendedProps: {
        description: eventTitle // Add description for hover effect
      }
    });
  });
}


loadExistingReservations();
calendar.render();


