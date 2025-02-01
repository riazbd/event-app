# Event Reminder App

The Event Reminder App is a Laravel-based application that allows users to create, manage, and track events. It includes features like:

- CRUD operations for events.
- Email reminders to attendees.
- CSV import/export functionality.
- Search and pagination for events.
- Calendar view using FullCalendar.
- Real-time updates with Pusher.
- Offline functionality with service workers.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Setup and Installation](#setup-and-installation)
- [Running the Application](#running-the-application)
- [Sample CSV File Format](#sample-csv-file-format)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [License](#license)
- [Support](#support)

## Prerequisites
Before you begin, ensure you have the following installed on your local machine:

- PHP 8.1 or higher
- Composer (for dependency management)
- Node.js (for frontend asset compilation)
- MySQL (or any other supported database)
- Git (for version control)

## Setup and Installation

### 1. Clone the Repository
Clone the repository to your local machine:

```bash
git clone https://github.com/your-repo/event-reminder-app.git
cd event-reminder-app
```

### 2. Install PHP Dependencies
Install the required PHP dependencies using Composer:

```bash
composer install
```

### 3. Install NPM Dependencies
Install the required frontend dependencies using NPM:

```bash
npm install
```

### 4. Set Up the Environment File
Copy the `.env.example` file to `.env` and update the database credentials:

```bash
cp .env.example .env
nano .env
```

Update the following variables:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_reminder
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate Application Key
Generate a unique application key:

```bash
php artisan key:generate
```

### 6. Run Migrations
Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### 7. Compile Frontend Assets
Compile the frontend assets (CSS and JavaScript):

```bash
npm run dev
```

## Running the Application

### 1. Start the Development Server
Run the Laravel development server:

```bash
php artisan serve
```

The application will be available at [http://localhost:8000](http://localhost:8000).

### 2. Start the Queue Worker
Start the queue worker to process background jobs (e.g., sending email reminders):

```bash
php artisan queue:work
```

### 3. Access the Application
Open your browser and navigate to [http://localhost:8000](http://localhost:8000). You should see the Event Reminder App homepage.

## Sample CSV File Format

To import events into the application, use a CSV file with the following format:

### CSV File Example

```csv
title,description,event_time,location,attendees
Team Meeting,Discuss project updates,2023-12-25 10:00:00,Office,user1@example.com,user2@example.com
Conference,Annual company conference,2023-12-30 09:00:00,Convention Center,user3@example.com,user4@example.com
Workshop,Learn new technologies,2024-01-05 14:00:00,Training Room,user5@example.com
```

### Fields Explained
- **title**: The title of the event (required).
- **description**: A description of the event (optional).
- **event_time**: The date and time of the event in `YYYY-MM-DD HH:MM:SS` format (required).
- **location**: The location of the event (optional).
- **attendees**: A comma-separated list of email addresses for attendees (optional).

## Remove the header from the csv to import

## Features

### 1. CRUD Operations
- Create, read, update, and delete events.
- Mark events as completed.

### 2. Email Reminders
- Send email reminders to attendees when an event is created or updated.

### 3. CSV Import/Export
- Import events from a CSV file.
- Export events to a CSV file.

### 4. Search and Pagination
- Search events by title, description, or location.
- Paginate the events list (10 events per page).

### 5. Calendar View
- View events in a calendar using FullCalendar.

### 6. Real-time Updates
- Use Pusher for real-time updates when events are created, updated, or deleted.

### 7. Offline Functionality
- Use service workers to enable offline functionality.

## Technologies Used

### Backend
- **Laravel 10**: PHP framework for web applications.
- **MySQL**: Relational database for storing events.
- **Pusher**: Real-time updates with WebSockets.

### Frontend
- **Bootstrap 5**: CSS framework for responsive design.
- **FullCalendar**: JavaScript library for calendar view.
- **Laravel Mix**: Asset compilation.

### Other Tools
- **Composer**: PHP dependency management.
- **Node.js**: Frontend dependency management.
- **Service Workers**: Offline functionality.

## License

This project is open-source and available under the MIT License.

## Support

If you encounter any issues or have questions, feel free to open an issue on the GitHub repository.

Enjoy using the Event Reminder App! 🎉

