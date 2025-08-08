#!/bin/bash

# Migration script from SQLite to PostgreSQL
echo "===== PostgreSQL Migration & Setup Tool for Karigor ====="

# Hardcoded PostgreSQL credentials
DB_USER="postgres"
DB_PASSWORD="postgres" 
DB_NAME="karigor"
DB_HOST="127.0.0.1"
DB_PORT="5432"

echo "Using PostgreSQL credentials:"
echo "- Host: $DB_HOST:$DB_PORT"
echo "- Database: $DB_NAME"
echo "- User: $DB_USER"

# Function to check if a command exists
command_exists() {
  command -v "$1" >/dev/null 2>&1
}

# Check if PostgreSQL is installed
if ! command_exists psql; then
    echo "PostgreSQL client not found. Installing PostgreSQL..."
    sudo apt update
    sudo apt install -y postgresql postgresql-contrib
    
    # Start PostgreSQL service
    sudo systemctl enable postgresql
    sudo systemctl start postgresql
    
    echo "PostgreSQL installed successfully!"
    
    # Set up the postgres user password
    sudo -u postgres psql -c "ALTER USER postgres WITH PASSWORD '$DB_PASSWORD';"
fi

# Configure PostgreSQL to accept connections
echo "===== PostgreSQL Server Access Configuration ====="
echo "Configuring PostgreSQL to accept connections..."

# Locate postgresql.conf
PG_CONF_DIR=$(sudo -u postgres psql -t -P format=unaligned -c "SHOW config_file" | xargs dirname)
PG_CONF="$PG_CONF_DIR/postgresql.conf"
PG_HBA="$PG_CONF_DIR/pg_hba.conf"

# Backup configuration files
sudo cp "$PG_CONF" "${PG_CONF}.backup.$(date +%Y%m%d%H%M%S)"
sudo cp "$PG_HBA" "${PG_HBA}.backup.$(date +%Y%m%d%H%M%S)"

# Update postgresql.conf to listen on all interfaces
sudo sed -i "s/#listen_addresses = 'localhost'/listen_addresses = '*'/g" "$PG_CONF"

# Add entry to pg_hba.conf to allow connections with password auth if not already present
if ! sudo grep -q "host    all             all             0.0.0.0/0               md5" "$PG_HBA"; then
    echo "Adding entry to pg_hba.conf..."
    echo "host    all             all             0.0.0.0/0               md5" | sudo tee -a "$PG_HBA"
fi

# Restart PostgreSQL to apply changes
echo "Restarting PostgreSQL service..."
sudo systemctl restart postgresql

echo "===== PostgreSQL Database Setup ====="
echo "Creating database: $DB_NAME..."

# Create database if it doesn't exist
if ! PGPASSWORD="$DB_PASSWORD" psql -h $DB_HOST -p $DB_PORT -U $DB_USER -lqt | cut -d \| -f 1 | grep -qw $DB_NAME; then
    PGPASSWORD="$DB_PASSWORD" psql -h $DB_HOST -p $DB_PORT -U $DB_USER -c "CREATE DATABASE $DB_NAME;"
    echo "Database $DB_NAME created successfully!"
else
    echo "Database $DB_NAME already exists, using existing database."
fi

echo "===== Laravel Environment Configuration ====="
# Backup current .env
cp .env .env.sqlite.backup

# Update .env file with PostgreSQL configuration
cat > .env << EOF
APP_NAME=Laravel
APP_ENV=local
APP_KEY=$(grep APP_KEY .env.sqlite.backup | cut -d '=' -f2)
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_DATABASE=$DB_NAME
DB_USERNAME=$DB_USER
DB_PASSWORD=$DB_PASSWORD

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

SESSION_DRIVER=database
SESSION_LIFETIME=120
$(grep -A 30 "MAIL_" .env.sqlite.backup)
EOF

echo "Environment file updated with PostgreSQL configuration."

echo "===== Laravel Database Migration ====="
echo "Running migrations..."
php artisan config:clear
php artisan cache:clear
php artisan migrate:fresh --seed --force

echo "===== Migration Complete ====="
echo "Your application is now configured to use PostgreSQL!"
echo "Database: $DB_NAME on $DB_HOST:$DB_PORT"
echo "Username: $DB_USER"
echo "Password: $DB_PASSWORD"
echo "A backup of your original .env file was saved as .env.sqlite.backup"