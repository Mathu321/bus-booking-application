# BusGo - Bus Ticket Booking Web Application

BusGo is a full-stack, lightweight web-based reservation system designed to simplify transit booking, route discovery, and fleet management. It features a responsive user interface, interactive seat selection, and a comprehensive administrative control panel[cite: 3, 4].

## Features

* **Route Discovery & Search:** Instantly filter and find available buses based on departure locations and destinations.
* **Interactive Seat Map:** Real-time visual seat selection grid that dynamically differentiates between available, occupied, and selected seats.
* **Streamlined Reservation Flow:** Multi-step booking process capturing passenger credentials and calculating dynamic reservation totals.
* **Admin Control Panel:** Secure login portal providing administrators with structured tabular interfaces to monitor customer bookings and manage fleet routes[cite: 3, 4, 5, 10].

## Tech Stack

* **Frontend:** HTML5, CSS3, JavaScript (Fetch API)
* **Backend:** Native PHP with PDO prepared statements[cite: 11, 12, 13]
* **Database:** MySQL

## Project Structure

```text
bus_project/
│
├── admin/
│   ├── bookings.html
│   ├── dashboard.html
│   ├── edit_bus.html
│   └── login.html
├── api/
│   ├── admin_delete_bus.php
│   ├── admin_get_bookings.php
│   ├── admin_login.php
│   ├── admin_save_bus.php
│   ├── book_ticket.php
│   ├── get_bus_details.php
│   ├── get_buses.php
│   ├── get_receipt.php
│   └── get_routes.php
├── config/
│   └── db.php
├── css/
│   └── style.css
├── database/
│   └── schema.sql
└── public/
    ├── booking.html
    ├── index.html
    ├── receipt.html
    └── routes.html