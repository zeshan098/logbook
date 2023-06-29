@extends('employee.template.admin_template')


<style>


</style>
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i>
                                    Create New Event</button>

                                <div id="external-events">
                                    <br>
                                    <!-- <p class="text-muted">Drag and drop your event or click in the calendar</p> -->
                                     
                                </div>

                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Upcoming Events</h5>
                            <p class="text-muted">Don't miss scheduled events</p>
                            <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 400px">
                                <div id="upcoming-event-list"></div>
                            </div>
                        </div>

                        <!-- <div class="card">
                            <div class="card-body bg-soft-info">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i data-feather="calendar" class="text-info icon-dual-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-15">Welcome to your Calendar!</h6>
                                        <p class="text-muted mb-0">Event that applications book will appear here. Click
                                            on an event to see the details and manage applicants event.</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-9">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!--end row-->

                <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                <div class="modal fade" id="event-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header p-3 bg-soft-info">
                                <h5 class="modal-title" id="modal-title">Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-hidden="true"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                <input name="_token" id="token" type="hidden" value="{{ csrf_token() }}"/>
                                    <div class="text-end">
                                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn"
                                            data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                                    </div>
                                    <div class="event-details">
                                        <div class="d-flex mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <i class="ri-calendar-event-line text-muted fs-16"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-time-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0"><span
                                                        id="event-timepicker1-tag"></span> - <span
                                                        id="event-timepicker2-tag"></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-map-pin-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0"> <span
                                                        id="event-location-tag"></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-discuss-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row event-form">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Type</label>
                                                <select class="form-select" name="category" id="event-category"
                                                    required>
                                                    <option value="bg-soft-danger">Danger</option>
                                                    <option value="bg-soft-success">Success</option>
                                                    <option value="bg-soft-primary">Primary</option>
                                                    <option value="bg-soft-info">Info</option>
                                                    <option value="bg-soft-dark">Dark</option>
                                                    <option value="bg-soft-warning">Warning</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a valid event category</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Event Name</label>
                                                <input class="form-control d-none" placeholder="Enter event name"
                                                    type="text" name="title" id="event-title" required value="" />
                                                <div class="invalid-feedback">Please provide a valid event name</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label>Event Date</label>
                                                <div class="input-group d-none">
                                                    <input type="text" id="event-start-date"
                                                        class="form-control flatpickr flatpickr-input"
                                                        placeholder="Select date" readonly required>
                                                    <span class="input-group-text"><i
                                                            class="ri-calendar-event-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12" id="event-time">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Start Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker1" type="text"
                                                                class="form-control flatpickr flatpickr-input"
                                                                placeholder="Select start time" readonly>
                                                            <span class="input-group-text"><i
                                                                    class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">End Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker2" type="text"
                                                                class="form-control flatpickr flatpickr-input"
                                                                placeholder="Select end time" readonly>
                                                            <span class="input-group-text"><i
                                                                    class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="event-location">Location</label>
                                                <div>
                                                    <input type="text" class="form-control d-none" name="event-location"
                                                        id="event-location" placeholder="Event location">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <input type="hidden" id="eventid" name="eventid" value="" />
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control d-none" id="event-description"
                                                    placeholder="Enter a description" rows="3"
                                                    spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i
                                                class="ri-close-line align-bottom"></i> Delete</button>
                                        <button type="submit" class="btn btn-success" id="btn-save-event">Add
                                            Event</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end modal-content-->
                    </div> <!-- end modal dialog-->
                </div> <!-- end modal-->
                <!-- end modal-->
            </div>
        </div> <!-- end row-->




    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->


 
 
<script src="{{ asset('admin_file/assets/libs/fullcalendar/main.min.js') }}"></script>
        
<script>
    var start_date = document.getElementById("event-start-date"),
    timepicker1 = document.getElementById("timepicker1"),
    timepicker2 = document.getElementById("timepicker2"),
    date_range = null,
    T_check = null;

function flatPickrInit() {
    var e = {
        enableTime: !0,
        noCalendar: !0
    };
    flatpickr(start_date, {
        enableTime: !1,
        mode: "range",
        minDate: "today",
        onChange: function(e, t, n) {
            1 < t.split("to").length ? document.getElementById("event-time").setAttribute("hidden", !0) : (document.getElementById("timepicker1").parentNode.classList.remove("d-none"), document.getElementById("timepicker1").classList.replace("d-none", "d-block"), document.getElementById("timepicker2").parentNode.classList.remove("d-none"), document.getElementById("timepicker2").classList.replace("d-none", "d-block"), document.getElementById("event-time").removeAttribute("hidden"))
        }
    });
    flatpickr(timepicker1, e), flatpickr(timepicker2, e)
}

function flatpicekrValueClear() {
    start_date.flatpickr().clear(), timepicker1.flatpickr().clear(), timepicker2.flatpickr().clear()
}

function eventClicked() {
    document.getElementById("form-event").classList.add("view-event"), 
    document.getElementById("event-title").classList.replace("d-block", "d-none"), 
    document.getElementById("event-category").classList.replace("d-block", "d-none"), 
    document.getElementById("event-start-date").parentNode.classList.add("d-none"), 
    document.getElementById("event-start-date").classList.replace("d-block", "d-none"), 
    document.getElementById("event-time").setAttribute("hidden", !0), 
    document.getElementById("timepicker1").parentNode.classList.add("d-none"), 
    document.getElementById("timepicker1").classList.replace("d-block", "d-none"), 
    document.getElementById("timepicker2").parentNode.classList.add("d-none"), 
    document.getElementById("timepicker2").classList.replace("d-block", "d-none"), 
    document.getElementById("event-location").classList.replace("d-block", "d-none"), 
    document.getElementById("event-description").classList.replace("d-block", "d-none"), 
    document.getElementById("event-start-date-tag").classList.replace("d-none", "d-block"), 
    document.getElementById("event-timepicker1-tag").classList.replace("d-none", "d-block"), 
    document.getElementById("event-timepicker2-tag").classList.replace("d-none", "d-block"), 
    document.getElementById("event-location-tag").classList.replace("d-none", "d-block"), 
    document.getElementById("event-description-tag").classList.replace("d-none", "d-block"), 
    document.getElementById("btn-save-event").setAttribute("hidden", !0)
}

function editEvent(e) {
    var t = e.getAttribute("data-id");
    ("new-event" == t ? (document.getElementById("modal-title").innerHTML = "", 
    document.getElementById("modal-title").innerHTML = "Add Event", 
    document.getElementById("btn-save-event").innerHTML = "Add Event", 
    eventTyped) : "edit-event" == t ? (e.innerHTML = "Cancel", e.setAttribute("data-id", "cancel-event"), 
    document.getElementById("btn-save-event").innerHTML = "Update Event", 
    e.removeAttribute("hidden"), eventTyped) : (e.innerHTML = "Edit", 
    e.setAttribute("data-id", "edit-event"), eventClicked))()
}

function eventTyped() {
    document.getElementById("form-event").classList.remove("view-event"), document.getElementById("event-title").classList.replace("d-none", "d-block"), document.getElementById("event-category").classList.replace("d-none", "d-block"), document.getElementById("event-start-date").parentNode.classList.remove("d-none"), document.getElementById("event-start-date").classList.replace("d-none", "d-block"), document.getElementById("timepicker1").parentNode.classList.remove("d-none"), document.getElementById("timepicker1").classList.replace("d-none", "d-block"), document.getElementById("timepicker2").parentNode.classList.remove("d-none"), document.getElementById("timepicker2").classList.replace("d-none", "d-block"), document.getElementById("event-location").classList.replace("d-none", "d-block"), document.getElementById("event-description").classList.replace("d-none", "d-block"), document.getElementById("event-start-date-tag").classList.replace("d-block", "d-none"), document.getElementById("event-timepicker1-tag").classList.replace("d-block", "d-none"), document.getElementById("event-timepicker2-tag").classList.replace("d-block", "d-none"), document.getElementById("event-location-tag").classList.replace("d-block", "d-none"), document.getElementById("event-description-tag").classList.replace("d-block", "d-none"), document.getElementById("btn-save-event").removeAttribute("hidden")
}

function upcomingEvent(e) {
    e.sort(function(e, t) {
        return new Date(e.start) - new Date(t.start)
    }), document.getElementById("upcoming-event-list").innerHTML = null, Array.from(e).forEach(function(e) {
        var t = e.title,
            n = (l = e.end ? (endUpdatedDay = new Date(e.end)).setDate(endUpdatedDay.getDate() - 1) : l) || void 0;
        n = "Invalid Date" == n || null == n ? null : (a = new Date(n).toLocaleDateString("en", {
            year: "numeric",
            month: "numeric",
            day: "numeric"
        }), new Date(a).toLocaleDateString("en-GB", {
            day: "numeric",
            month: "short",
            year: "numeric"
        }).split(" ").join(" "));
        (e.start ? str_dt(e.start) : null) === (l ? str_dt(l) : null) && (n = null);
        var a = e.start,
            d = (a = "Invalid Date" === a || void 0 === a ? null : (d = new Date(a).toLocaleDateString("en", {
                year: "numeric",
                month: "numeric",
                day: "numeric"
            }), new Date(d).toLocaleDateString("en-GB", {
                day: "numeric",
                month: "short",
                year: "numeric"
            }).split(" ").join(" ")), n ? " to " + n : ""),
            n = e.className.split("-"),
            i = e.description || "",
            e = tConvert(getTime(e.start)),
            l = (e == (l = tConvert(getTime(l))) && (e = "Full day event", l = null), l ? " to " + l : "");
        u_event = "<div class='card mb-3'>                        <div class='card-body'>                            <div class='d-flex mb-3'>                                <div class='flex-grow-1'><i class='mdi mdi-checkbox-blank-circle me-2 text-" + n[2] + "'></i><span class='fw-medium'>" + a + d + " </span></div>                                <div class='flex-shrink-0'><small class='badge badge-soft-primary ms-auto'>" + e + l + "</small></div>                            </div>                            <h6 class='card-title fs-16'> " + t + "</h6>                            <p class='text-muted text-truncate-two-lines mb-0'> " + i + "</p>                        </div>                    </div>", document.getElementById("upcoming-event-list").innerHTML += u_event
    })
}

function getTime(e) {
    if (null != (e = new Date(e)).getHours()) return e.getHours() + ":" + (e.getMinutes() ? e.getMinutes() : 0)
}

function tConvert(e) {
    var e = e.split(":"),
        t = e[0],
        e = e[1],
        n = 12 <= t ? "PM" : "AM";
    return (t = (t %= 12) || 12) + ":" + (e < 10 ? "0" + e : e) + " " + n
}
document.addEventListener("DOMContentLoaded", function() {
    flatPickrInit();
    console.log('{!!$events!!}');
    var JSONObject = JSON.parse('{!!$events!!}');
    console.log(JSONObject);
    var g = new bootstrap.Modal(document.getElementById("event-modal"), {
            keyboard: !1
        }),
        d = (document.getElementById("event-modal"), document.getElementById("modal-title")),
        i = document.getElementById("form-event"),
        v = null,
        p = document.getElementsByClassName("needs-validation"),
        e = new Date,
        t = e.getDate(),
        n = e.getMonth(),
        e = e.getFullYear(),
        a = FullCalendar.Draggable,
        l = document.getElementById("external-events"),
        y = JSONObject,
        e = (new a(l, {
            itemSelector: ".external-event",
            eventData: function(e) {
                return {
                    id: Math.floor(11e3 * Math.random()),
                    title: e.innerText,
                    allDay: !0,
                    start: new Date,
                    className: e.getAttribute("data-class")
                }
            }
        }), document.getElementById("calendar"));

    function o(e) {
        document.getElementById("form-event").reset(), 
        document.getElementById("btn-delete-event").setAttribute("hidden", !0), 
        g.show(), 
        i.classList.remove("was-validated"), 
        i.reset(), 
        v = null, 
        d.innerText = "Add Event", 
        newEventData = e, 
        document.getElementById("edit-event-btn").setAttribute("data-id", "new-event"), 
        document.getElementById("edit-event-btn").click(), 
        document.getElementById("edit-event-btn").setAttribute("hidden", !0)
    }

    function r() {
        return 768 <= window.innerWidth && window.innerWidth < 1200 ? "timeGridWeek" : window.innerWidth <= 768 ? "listMonth" : "dayGridMonth"
    }
    var c = new Choices("#event-category", {
            searchEnabled: !1
        }),
        E = new FullCalendar.Calendar(e, {
            timeZone: "local",
            editable: !0,
            droppable: !0,
            selectable: !0,
            navLinks: !0,
            initialView: r(),
            themeSystem: "bootstrap",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
            windowResize: function(e) {
                var t = r();
                E.changeView(t)
            },
            eventResize: function(t) {
                var e = y.findIndex(function(e) {
                    return e.id == t.event.id
                });
                y[e] && (y[e].title = t.event.title, y[e].start = t.event.start, y[e].end = t.event.end || null, y[e].allDay = t.event.allDay, y[e].className = t.event.classNames[0], y[e].description = t.event._def.extendedProps.description || "", y[e].location = t.event._def.extendedProps.location || ""), upcomingEvent(y)
            },
            eventClick: function(e) {
                document.getElementById("edit-event-btn").removeAttribute("hidden"), 
                document.getElementById("btn-save-event").setAttribute("hidden", !0), 
                document.getElementById("edit-event-btn").setAttribute("data-id", "edit-event"), 
                document.getElementById("edit-event-btn").innerHTML = "Edit", 
                eventClicked(), 
                flatPickrInit(), 
                flatpicekrValueClear(), 
                g.show(), 
                i.reset(), 
                v = e.event, 
                document.getElementById("modal-title").innerHTML = "", 
                document.getElementById("event-location-tag").innerHTML = void 0 === v.extendedProps.location ? "No Location" : v.extendedProps.location, 
                document.getElementById("event-description-tag").innerHTML = void 0 === v.extendedProps.description ? "No Description" : v.extendedProps.description, 
                document.getElementById("event-title").value = v.title, 
                document.getElementById("event-location").value = void 0 === v.extendedProps.location ? "No Location" : v.extendedProps.location, 
                document.getElementById("event-description").value = void 0 === v.extendedProps.description ? "No Description" : v.extendedProps.description, 
                document.getElementById("eventid").value = v.id; 
                if (v && v.classNames && v.classNames.length > 0) {
                    if (typeof Choices === 'function') {
                        if (typeof c === 'object' && typeof c.destroy === 'function' && typeof c.setChoiceByValue === 'function') {
                        c.destroy();
                        }
                        c = new Choices("#event-category", {
                        searchEnabled: false
                        });
                    }
                }
                // v.classNames[0] && (c.destroy(), 
                // (c = new Choices("#event-category", {
                //     searchEnabled: !1
                // })).setChoiceByValue(v.classNames[0]));
                 
                function t(e) {
                    var t = "" + ((e = new Date(e)).getMonth() + 1),
                        n = "" + e.getDate();
                    return [e.getFullYear(), t = t.length < 2 ? "0" + t : t, n = n.length < 2 ? "0" + n : n].join("-")
                }
                var e = v.start,
                    n = v.end,
                    a = null == n ? str_dt(e) : str_dt(e) + " to " + str_dt(n),
                    e = null == n ? t(e) : t(e) + " to " + t(n),
                    n = (flatpickr(start_date, {
                        defaultDate: e,
                        altInput: !0,
                        altFormat: "j F Y",
                        dateFormat: "Y-m-d",
                        mode: "range",
                        onChange: function(e, t, n) {
                            1 < t.split("to").length ? document.getElementById("event-time").setAttribute("hidden", !0) : (document.getElementById("timepicker1").parentNode.classList.remove("d-none"), document.getElementById("timepicker1").classList.replace("d-none", "d-block"), document.getElementById("timepicker2").parentNode.classList.remove("d-none"), document.getElementById("timepicker2").classList.replace("d-none", "d-block"), document.getElementById("event-time").removeAttribute("hidden"))
                        }
                    }), document.getElementById("event-start-date-tag").innerHTML = a, getTime(v.start)),
                    e = getTime(v.end);
                n == e ? (document.getElementById("event-time").setAttribute("hidden", !0), flatpickr(document.getElementById("timepicker1"), {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i"
                }), flatpickr(document.getElementById("timepicker2"), {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i"
                })) : (document.getElementById("event-time").removeAttribute("hidden"), flatpickr(document.getElementById("timepicker1"), {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i",
                    defaultDate: n
                }), flatpickr(document.getElementById("timepicker2"), {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i",
                    defaultDate: e
                }), document.getElementById("event-timepicker1-tag").innerHTML = tConvert(n), document.getElementById("event-timepicker2-tag").innerHTML = tConvert(e)), newEventData = null, d.innerText = v.title, document.getElementById("btn-delete-event").removeAttribute("hidden")
            },
            dateClick: function(e) {
                o(e)
            },
            events: y,
            eventReceive: function(e) {
                e = {
                    id: parseInt(e.event.id),
                    title: e.event.title,
                    start: e.event.start,
                    allDay: e.event.allDay,
                    className: e.event.classNames[0]
                };
                y.push(e), upcomingEvent(y)
            },
            eventDrop: function(t) {
                var e = y.findIndex(function(e) {
                    return e.id == t.event.id
                });
                y[e] && (y[e].title = t.event.title, y[e].start = t.event.start, y[e].end = t.event.end || null, y[e].allDay = t.event.allDay, y[e].className = t.event.classNames[0], y[e].description = t.event._def.extendedProps.description || "", y[e].location = t.event._def.extendedProps.location || ""), upcomingEvent(y)
            }
        });
    E.render(), upcomingEvent(y), i.addEventListener("submit", function(e) {
        e.preventDefault();
        var t, n, e = document.getElementById("event-title").value,
            a = document.getElementById("event-category").value,
            d = document.getElementById("event-start-date").value.split("to"),
            i = new Date(d[0].trim()),
            l = d[1] ? new Date(d[1].trim()) : "",
            o = null,
            r = document.getElementById("event-location").value,
            c = document.getElementById("event-description").value,
            s = document.getElementById("eventid").value,
            m = !1,
            u = (1 < d.length ? ((o = new Date(d[1])).setDate(o.getDate() + 1), d = new Date(d[0]), m = !0) : (t = d, u = document.getElementById("timepicker1").value.trim(), n = document.getElementById("timepicker2").value.trim(), d = new Date(d + "T" + u), o = new Date(t + "T" + n)), y.length + 1);
        !1 === p[0].checkValidity() ? p[0].classList.add("was-validated") : (v ? (v.setProp("id", s), v.setProp("title", e), v.setProp("classNames", [a]), v.setStart(i), v.setEnd(l), v.setAllDay(m), v.setExtendedProp("description", c), v.setExtendedProp("location", r), t = y.findIndex(function(e) {
            return e.id == v.id
        }), y[t] && (y[t].title = e, y[t].start = i, y[t].end = l, y[t].allDay = m, y[t].className = a, y[t].description = c, y[t].location = r), E.render()) : (E.addEvent(n = {
            id: u,
            title: e,
            start: d,
            end: o,
            allDay: m,
            className: a,
            description: c,
            location: r
        }), y.push(n)), g.hide(), upcomingEvent(y))
    }), document.getElementById("btn-delete-event").addEventListener("click", function(e) {
        if (v) {
            for (var t = 0; t < y.length; t++) y[t].id == v.id && (y.splice(t, 1), t--);
            upcomingEvent(y), v.remove(), v = null, g.hide()
        }
    }), document.getElementById("btn-new-event").addEventListener("click", function(e) {
        flatpicekrValueClear(), flatPickrInit(), o(), document.getElementById("edit-event-btn").setAttribute("data-id", "new-event"), document.getElementById("edit-event-btn").click(), document.getElementById("edit-event-btn").setAttribute("hidden", !0)
    })
});
var str_dt = function(e) {
    var e = new Date(e),
        t = "" + ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][e.getMonth()],
        n = "" + e.getDate(),
        e = e.getFullYear();
    return t.length < 2 && (t = "0" + t), [(n = n.length < 2 ? "0" + n : n) + " " + t, e].join(",")
};
</script>   

@endsection
 