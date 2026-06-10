# Workforce Hub

Workforce Hub is a modern, collaborative team and task management board. Built as a Single Page Application (SPA) using **Laravel 12 (PHP)** and **Vue 3 (JS/Vite)**, it provides dynamic work organization, interactive task tracking, and role-based administration.

---

## Features Implemented

*   **Secure Authentication & Session Management**: Built using Laravel Sanctum for API token-based authentication. Features secure user registration, login, profile editing, and password updating.

*   **Interactive Kanban Board**: Fully functional Kanban-style task board allowing users to track progress and easily drag/move tasks across four specific columns: To Do, In Progress, Testing, and Done.

*   **Advanced Task Management**: Full CRUD capabilities on tasks, with scoped access based on user roles:
    *   **Standard Users** can create and manage tasks by defining core details: Title, Description, Priority level (Low, Medium, High), Status, and Due Dates.
    *   **Admin Users** possess all standard creation capabilities, but retain exclusive privileges for task allocation, acting as the sole role permitted to assign team members (up to 5 concurrent assignees) to a task.

*   **Real-Time Dashboard Statistics**: A metrics suite that aggregates system data to provide instant visual summaries of productivity indicators:
    *   **Total Tasks**
    *   **Completed Tasks**
    *   **Pending Tasks**
    *   **Overdue Tasks**

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

**Theme & UI Philosophy (Soft Brutalism)**
*   **User Experience over Aesthetic Extremes**: Assumed a "Soft Brutalism" approach rather than pure Neo-Brutalism. Pure Neo-Brutalism (thick white borders/solid shadows on dark backgrounds) creates "visual vibration" and severe eye strain during extended use.
*   **Designed for Extended Daily Use**: Assumed the target audience uses this as a heavy-duty productivity tool (Kanban boards, dense data) for 8-hour workdays. The UI was dialed back to prevent dashboard fatigue.
*   **Prioritized Accessibility & Readability**: Assumed modern contrast and Web Content Accessibility Guidelines (WCAG) compliance take precedence over high-contrast styling. Muted pastel accents, dark borders, and deep charcoal backgrounds (zinc-950) were used to ensure long-term readability without sacrificing the developer-focused aesthetic.

**User Roles & Permissions**
*   **Multi-Tenant Scoping**: Assumed a strict separation of data visibility based on roles for team-based workflows.
*   **Admin Users**: Assumed global visibility, granting them access to view all tasks across the entire system.
*   **Standard Users**: Assumed restricted access, limiting their visibility strictly to tasks within their assigned workspaces and tasks assigned directly to them.

**System Navigation**
*   **Power-User Access**: Assumed the target audience prefers keyboard-driven workflows, prompting the implementation of global command keys for faster navigation. This includes pressing N to instantly create a task and ⌘K (or Ctrl+K) to trigger the central command palette.

**User Data & Validation**
*   **Data Integrity Constraints**: Since validation rules were not explicitly provided in the requirements, assumed standard security best practices: usernames must be unique and carry a minimum length of 8 characters.

**Task Allocation & Workspace Boundaries**
*   **Assignee Constraints**: Assumed strict validation rules for task distribution based on standard team collaboration limits. Specifically, a task must always have at least 1 assignee and a maximum of 5 concurrent assignees, all of whom are restricted to users already belonging to that task's parent workspace.


---

## Challenges Encountered

*   **Experienced difficulties when committing changes across multiple branches**: Managing concurrent feature streams resulted in coordination overhead when keeping local, upstream, and remote branches synchronized.
*   **Encountered challenges integrating the agreed-upon application theme and styling**: Harmonizing the styling requirements and ensuring consistent UI components across all views proved challenging during development.
*   **Had to rebuild parts of the backend after merge conflicts and integration issues during development**: Resolving overlapping changes on backend APIs required restructuring and refactoring controller actions after resolving git merge conflicts.
