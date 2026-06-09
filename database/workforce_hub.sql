CREATE TABLE workspaces (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR(255) NOT NULL UNIQUE,
  description TEXT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'active',
  color VARCHAR(255) NULL,
  created_by_user_id INTEGER NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE teams (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  workspace_id INTEGER NULL,
  name VARCHAR(255) NOT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'active',
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  UNIQUE (workspace_id, name),
  FOREIGN KEY (workspace_id) REFERENCES workspaces(id) ON DELETE SET NULL
);

CREATE TABLE tasks (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  workspace_id INTEGER NULL,
  team_id INTEGER NULL,
  created_by_user_id INTEGER NULL,
  assigned_to_user_id INTEGER NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'todo',
  priority VARCHAR(255) NOT NULL DEFAULT 'medium',
  due_date DATE NULL,
  completed BOOLEAN NOT NULL DEFAULT 0,
  completed_at DATETIME NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  FOREIGN KEY (workspace_id) REFERENCES workspaces(id) ON DELETE SET NULL,
  FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL,
  FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (assigned_to_user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE notifications (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  title VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  type VARCHAR(255) NOT NULL DEFAULT 'info',
  data JSON NULL,
  read_at DATETIME NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE users ADD COLUMN phone VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN department VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN role VARCHAR(255) NOT NULL DEFAULT 'user';
ALTER TABLE users ADD COLUMN workspace_id INTEGER NULL;
ALTER TABLE users ADD COLUMN team_id INTEGER NULL;
ALTER TABLE users ADD COLUMN api_token_hash VARCHAR(64) NULL UNIQUE;

CREATE INDEX users_workspace_id_index ON users(workspace_id);
CREATE INDEX users_team_id_index ON users(team_id);

ALTER TABLE users ADD CONSTRAINT users_workspace_id_foreign FOREIGN KEY (workspace_id) REFERENCES workspaces(id) ON DELETE SET NULL;
ALTER TABLE users ADD CONSTRAINT users_team_id_foreign FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL;
