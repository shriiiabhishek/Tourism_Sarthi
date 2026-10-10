Quick setup to run the site locally (Windows + XAMPP)

1) Start XAMPP
- Open `C:\xampp\xampp-control.exe` and click Start for Apache and MySQL.

2) Import database
- Option A (phpMyAdmin): Open http://localhost/phpmyadmin -> Import -> choose `mp_sarthi.sql` (in the project root) -> Go.
- Option B (MySQL CLI): open a command prompt and run:

```powershell
cd C:\xampp\htdocs\mp_sarthi
mysql -u root < mp_sarthi.sql
```

Note: If your Apache runs on port 8080, use `http://localhost:8080` instead of `http://localhost`.

3) Open the pages
- Register/Login page: http://localhost/mp_sarthi/index.php
- Admin view: http://localhost/mp_sarthi/admin_view.php
- Dashboard: http://localhost/mp_sarthi/dashboard.php

4) Troubleshooting
- If Apache fails to start, another app (IIS, Skype, TeamViewer) may be using port 80. Change Apache port in `C:\xampp\apache\conf\httpd.conf` (change `Listen 80` to `Listen 8080` and `ServerName localhost:8080`), then restart Apache.
- If you get DB connection errors, open `api/db.php` and update credentials.

If you want, I can try to start/check Apache and MySQL from here and open the pages for you.