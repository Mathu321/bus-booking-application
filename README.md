# BusGo - Bus Ticket Reservation System

BusGo is a full-stack web application designed for seamless bus ticket reservations, featuring a responsive customer portal and a comprehensive administrative control panel.

---

## Key Features

* **User Portal**:
  * User registration and secure login with password hashing[cite: 12, 15, 33].
  * Dynamic bus search by source and destination[cite: 11].
  * Interactive seat selection grid with real-time seat availability tracking[cite: 9].
  * Personal booking dashboard ("My Tickets") to view and manage active reservations[cite: 13].
  * Printable booking receipt generation[cite: 14].

* **Admin Portal**:
  * Secure database-backed administrator authentication using `password_verify()`[cite: 8, 22].
  * Fleet management dashboard to add, edit, or delete bus routes and fares[cite: 6, 7, 19, 23].
  * Multi-admin account creation directly from the dashboard[cite: 6, 18].
  * Direct administrative booking capability for booking tickets on behalf of passengers without needing a customer account[cite: 4, 17].
  * Global bookings overview ("All Bookings") and admin-specific tracking ("My Bookings") with cancellation capabilities[cite: 3, 5].

---

## Project Directory Structure

```text
bus_project/
│
├── admin/
│   ├── admin_bookings.html    # Tickets booked specifically by the active admin[cite: 3]
│   ├── bookings.html          # Global customer and admin bookings overview[cite: 5]
│   ├── book_ticket.html       # Direct admin booking interface for passengers[cite: 4]
│   ├── dashboard.html         # Fleet management and new admin registration[cite: 6]
│   ├── edit_bus.html          # Add or edit bus routes and pricing[cite: 7]
│   └── login.html             # Admin authentication portal[cite: 8]
│
├── api/
│   ├── admin_book_ticket.php  # Backend endpoint for admin bookings[cite: 17]
│   ├── admin_create_admin.php # Backend endpoint for creating new admins[cite: 18]
│   ├── admin_delete_bus.php   # Backend endpoint for deleting buses[cite: 19]
│   ├── admin_get_bookings.php # Fetch all system-wide bookings[cite: 20]
│   ├── admin_get_my_bookings.php # Fetch bookings tied to current admin[cite: 21]
│   ├── admin_login.php        # Admin login verification endpoint[cite: 22]
│   ├── admin_save_bus.php     # Insert or update bus details[cite: 23]
│   ├── book_ticket.php        # Customer seat reservation endpoint[cite: 24]
│   ├── cancel_ticket.php      # Shared cancellation handler[cite: 25]
│   ├── check_session.php      # Public session validator[cite: 26]
│   ├── get_bus_details.php    # Fetch bus specs and occupied seats[cite: 27]
│   ├── get_buses.php          # Search/filter bus listing endpoint[cite: 28]
│   ├── get_receipt.php        # Fetch booking receipt details[cite: 29]
│   ├── get_routes.php         # Aggregate unique origin/destination paths[cite: 30]
│   ├── get_user_bookings.php  # Fetch personal user ticket history[cite: 31]
│   ├── logout.php             # Session destruction endpoint[cite: 32]
│   ├── register.php           # Customer onboarding endpoint[cite: 33]
│   └── user_login.php         # Customer authentication endpoint[cite: 34]
│
├── config/
│   └── db.php                 # Database PDO connection setup
│
├── css/
│   └── style.css              # Global application styles
│
├── public/
│   ├── booking.html           # Customer seat reservation flow[cite: 9]
│   ├── index.html             # Home page and bus search engine[cite: 11]
│   ├── login.html             # Customer sign-in page[cite: 12]
│   ├── my_tickets.html        # Customer ticket tracking dashboard[cite: 13]
│   ├── receipt.html           # Printable confirmation receipt view[cite: 14]
│   ├── register.html          # Customer registration page[cite: 15]
│   └── routes.html            # Active transit pathways directory[cite: 16]
│
├── entry.html                 # Entry portal selecting user/admin access
└── database/
    └──schema.sql             # Complete MySQL database initialization script[cite: 2]