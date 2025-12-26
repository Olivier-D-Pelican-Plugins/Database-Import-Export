# Database Import/Export Plugin

![Database Import/Export Plugin Banner](./banner-db-ie.png)


Export and import your Pelican Panel server databases directly from the panel interface.

## Features

- **Export databases** to SQL files with automatic download
- **Import SQL files** back into your databases
- One-click operations directly from the databases table
- Automatic cleanup of temporary files
- Permission-based access control
- Works with all database types supported by Pelican Panel

## Installation

1. Download the plugin ZIP file from the [Releases](https://github.com/Olivier-D-Pelican-Plugins/Database-Import-Export/releases) page
2. Go to your Pelican Panel admin area
3. Navigate to the Plugins page
4. Click on "Import file"
5. Select the downloaded ZIP file
6. Click "Import"

## Usage

### Exporting a Database

1. Navigate to your server's **Databases** page
2. Find the database you want to export
3. Click the **Export** button (green icon)
4. Confirm the export in the modal
5. The SQL file will be automatically downloaded

### Importing a Database

1. Navigate to your server's **Databases** page
2. Find the database you want to import into
3. Click the **Import** button (blue icon)
4. Select your SQL file (max 10 MB by default)
5. Click "Import"
6. Wait for the import to complete

**Important:** Importing will replace existing data if tables have the same name. This action is irreversible. Always backup before importing!

## Requirements

- Pelican Panel v1.0+
- PHP 8.2+
- `mysqldump` command available on the server
- `mysql` command available on the server
- Sufficient disk space for temporary export files

## Permissions

The plugin uses Pelican's built-in subuser permissions:
- **Export**: Requires `database.view-password` permission
- **Import**: Requires `database.update` permission

## Configuration

You can configure the plugin in `config/database-import-export.php`:

```php
return [
    'max_upload_size' => 10240, // Max upload size in KB (10 MB)
    'export_timeout' => 300,    // Max execution time for export in seconds
    'import_timeout' => 300,    // Max execution time for import in seconds
];
```

## Technical Details

- Exports are generated using `mysqldump` with UTF-8 encoding
- Temporary files are stored in `storage/app/temp-exports/` and `storage/app/temp-imports/`
- Files are automatically cleaned up after download/import
- Export filename format: `database_export_{database_name}_{timestamp}.sql`

## Troubleshooting

### "mysqldump: command not found"
Install MySQL client tools on your server:
```bash
apt-get install mysql-client  # Debian/Ubuntu
yum install mysql             # CentOS/RHEL
```

### "The SQL File must be a file of type..."
Make sure you're uploading a valid `.sql` file. The plugin accepts these MIME types:
- `application/sql`
- `text/plain`
- `text/x-sql`
- `application/x-sql`


## Author

Made by **olivierdti**