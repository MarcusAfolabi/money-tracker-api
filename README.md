```markdown
# Money Tracker API - Laravel Assessment

This is a RESTful API built with **Laravel 11** to manage users, wallets, and financial transactions. This project was developed as a technical assessment to demonstrate senior-level clean code, architectural patterns, and automated testing.

## 🚀 Features
- **User Management**: Create user accounts and view profiles.
- **Wallet System**: Create multiple wallets per user.
- **Transaction Engine**: Handle Income and Expense transactions with automated balance updates.
- **Data Integrity**: Uses Database Transactions and strict validation for financial accuracy.
- **API Versioning**: Built under the `v1` namespace.

## 🛠️ Technical Stack
- **Framework**: Laravel 11
- **Testing**: Pest PHP
- **Database**: SQLite
- **Resources**: Laravel API Resources for standardized JSON formatting.

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/MarcusAfolabi/money-tracker-api
   cd money-tracker-api

```

2. **Install Dependencies:**
```bash
composer install

```


3. **Environment Setup:**
```bash
cp .env.example .env
php artisan key:generate

```


4. **Database Migration:**
*Note: Ensure your .env is configured for your local DB (SQLite is recommended for quick testing).*
```bash
php artisan migrate

```


5. **Start the Server:**
```bash
php artisan serve

```



---

## 🧪 Running Tests

This project uses **Pest PHP** for feature testing to ensure all functional requirements are met.

To run the full suite:

```bash
php artisan test

```

The tests verify:

* User creation logic.
* Multiple wallet creation.
* Balance logic (Income adds, Expense subtracts).
* Total balance calculation across multiple wallets.
* Validation for positive amounts and valid transaction types.

---

## 📡 API Endpoints (v1)

| Method | Endpoint | Description |
| --- | --- | --- |
| `POST` | `/api/v1/users` | Create a new user |
| `GET` | `/api/v1/users/{id}` | View profile (Wallets & Total Balance) |
| `POST` | `/api/v1/users/{id}/wallets` | Create a new wallet for a user |
| `GET` | `/api/v1/wallets/{id}` | View single wallet (Balance & Transactions) |
| `POST` | `/api/v1/wallets/{id}/transactions` | Record an Income/Expense |

---

## 👤 Author

* **Name**: Abiodun
* **Role**: Backend Developer (Laravel)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
