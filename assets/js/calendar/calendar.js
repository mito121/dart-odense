/*
 *** Calendar
 */

document.addEventListener("DOMContentLoaded", function () {
  let events = [
    {
      title: "Heldags engagement",
      start: "2021-06-01",
    },
    {
      title: "Dart Camp Danmark",
      start: "2021-06-07",
      end: "2021-06-10",
    },
    // Mandagsspil
    {
      groupId: "999",
      title: "Mandagsspil",
      start: "2021-05-24T16:00:00",
    },
    {
      groupId: "999",
      title: "Mandagsspil",
      start: "2021-05-31T16:00:00",
    },
    {
      groupId: "999",
      title: "Tirsdagsdart",
      start: "2021-05-01T16:00:00",
    },
    {
      title: "Dart Konference Kolding (DKK)",
      start: "2021-06-11",
      end: "2021-06-13",
    },
    {
      title: "Åbent hus",
      start: "2021-06-12T18:30:00",
      end: "2021-06-12T20:30:00",
    },
    {
      title: "Åbent hus",
      start: "2021-06-12T14:30:00",
    },
    {
      title: "Yvette's fødselsdag",
      start: "2021-06-13T07:00:00",
    },
    {
      title: "Nyhed! (Klik for at se mere)",
      url: "index.php?page=news",
      start: "2021-06-28",
    },
  ];

  let admin = false;
  if (document.getElementById("adminCalendar")) {
    admin = true;
  }

  const calendarEl = document.getElementById("calendar");

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "da",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    events: events,
    editable: admin,
  });

  calendar.render();

  /* Add event */
  function addEvent() {
    const title = document.getElementById("eventTitle").value;
    const startDate = document.getElementById("startDate").value;

    var date = new Date(startDate + "T00:00:00");

    if (!isNaN(date.valueOf())) {
      // date is valid
      calendar.addEvent({
        title: title,
        start: date,
        allDay: true,
      });

      // Reset input fields
      title.value = "";
      startDate.value = "";
    } else {
      // Invalid date
      alert("Ugyldig dato.");
    }
  }

  document.getElementById("addEvent").addEventListener("click", addEvent);

  /* Datepicker options */
  const datepickerOpts = {
    autoHide: true,
    format: "yyyy-mm-dd",
  };
  /* init */
  $('[data-toggle="datepicker"]').datepicker(datepickerOpts);
});
