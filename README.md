# website sewa tempat camping sedaucamp

## Setting database

```env
database.default.hostname = 127.0.0.1
database.default.database = camp
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
# database.default.DBPrefix =
database.default.port = 3306
```

### Running migrate database and model

```bash
php spark migrate
```

### Running server localhost:8080

```bash
php spark serve
```

```bash
php spark serve

CodeIgniter v4.6.1 Command Line Tool - Server Time: 2025-07-14 12:28:11 UTC+00:00

CodeIgniter development server started on http://localhost:8080
Press Control-C to stop.
[Mon Jul 14 20:28:11 2025] PHP 8.4.10 Development Server (http://localhost:8080) started
```
