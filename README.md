# Workforce Hub

Workforce Hub is a modern, collaborative team and task management application. Built as a Single Page Application (SPA) using **Laravel 12 (PHP)** and **Vue 3 (JS/Vite)**, it provides dynamic work organization, interactive task tracking, and role-based administration.

---

## Features Implemented

*   **Secure Authentication & Session Management**: Built using Laravel Sanctum for API token-based authentication. Features secure user registration, login, profile editing, and password updating.
*   **Interactive Kanban Board**: Fully functional Kanban task board allowing users to track progress across four stages (`Todo`, `In-Progress`, `Review`, and `Done`).
*   **Advanced Task Management**: CRUD capabilities on tasks, including title, description, priority (low, medium, high), due dates, and multiple assignees (up to 5 per task).
*   **Workspace & Team Administration**: Administrative control over workspaces (name, description, status, accent color) and organization of teams within specific workspaces.
*   **Admin User Management**: Admin panel to monitor, create, update, and manage account statuses of all users within the system.
*   **Notification Engine**: Real-time logging of user and task actions (e.g., assignment, status change, deletion) with a dedicated notification center for tracking unread notices.
*   **Preferences & Theme Settings**: Customizable settings for active profiles including dark, light, and system theme preferences, alongside custom notification toggles.

---

## Project Setup

### Installation Steps

1.  **Clone the Repository**:
    ```bash
    git clone <repository-url>
    cd Workforce-Hub
    ```

2.  **Run the Automatic Setup Script**:
    The project includes a pre-configured Composer script to install dependencies and run initial setups:
    ```bash
    composer run setup
    ```
    *This command will automatically install PHP dependencies, copy `.env.example` to `.env`, generate the application key, install npm dependencies, and compile frontend assets.*

3.  **Alternative Manual Setup**:
    If you prefer to perform the setup steps manually, run:
    ```bash
    # Install backend dependencies
    composer install

    # Create environment configuration
    cp .env.example .env

    # Generate application key
    php artisan key:generate

    # Install frontend dependencies
    npm install

    # Build assets
    npm run build
    ```

4.  **Database Migration & Seeding**:
    Migrate the schema and populate the database with default admin credentials:
    ```bash
    php artisan migrate --seed
    ```

5.  **Running the Application**:
    You can run the development servers concurrently using:
    ```bash
    composer run dev
    ```
    *This runs the PHP server, Tailwind/Vite development server, queue listener, and log monitor in a single terminal process.*

    Alternatively, start them separately:
    ```bash
    # Run Laravel backend server
    php artisan serve

    # Run Vite frontend server
    npm run dev
    ```

---

### Environment Setup

The application reads its environment configuration from the `.env` file. You should ensure the following variables are customized:

*   `APP_NAME`: Name of the application (defaults to `Laravel`).
*   `APP_ENV`: Environment mode (typically `local` or `production`).
*   `APP_KEY`: Application key (auto-generated).
*   `APP_URL`: Base URL of the backend API (defaults to `http://localhost`).
*   `ADMIN_NAME`: Full name of the seeded system admin (defaults to `System Admin`).
*   `ADMIN_USERNAME`: Username of the seeded system admin (defaults to `admin`).
*   `ADMIN_EMAIL`: Email of the seeded system admin (defaults to `admin@workforcehub.com`).
*   `ADMIN_PASSWORD`: Password of the seeded system admin (defaults to `Admin123!`).

---

### Database Configuration

Configure your database connection in the `.env` file under the following block:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=workforce_hub
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

Make sure the MySQL/MariaDB database specified in `DB_DATABASE` (default: `workforce_hub`) is created on your server before running migrations:
```bash
php artisan migrate --seed
```

---

## Assumptions Made

1.  **SPA Architecture**: The application operates strictly as a Single Page Application (SPA) where Laravel handles REST API requests and Sanctum session tokens, while Vue 3 and Vue Router manage client-side state and navigation.
2.  **Role-Based Security**: The access model defines two roles (`admin` and standard user). Only administrators can create/modify workspaces, create teams, and manage standard user accounts.
3.  **Workspace Constraints**: Normal users can only view and interact with tasks, teams, and members assigned to the same workspace as their own profile.
4.  **Task Allocation limits**: A task must always have at least one assignee and can have up to a maximum of 5 concurrent assignees, all of whom must belong to the task's parent workspace.
5.  **Local Storage and Notification Delivery**: Notifications are handled via database tables and log queues. Standard configuration assumes log-based mailers and sync queue drivers for local execution.

---

## Challenges Encountered

*   **Experienced difficulties when committing changes across multiple branches**: Managing concurrent feature streams resulted in coordination overhead when keeping local, upstream, and remote branches synchronized.
*   **Encountered challenges integrating the agreed-upon application theme and styling**: Harmonizing the styling requirements and ensuring consistent UI components across all views proved challenging during development.
*   **Had to rebuild parts of the backend after merge conflicts and integration issues during development**: Resolving overlapping changes on backend APIs required restructuring and refactoring controller actions after resolving git merge conflicts.
