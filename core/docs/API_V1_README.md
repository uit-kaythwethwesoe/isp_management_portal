# API V1 Documentation

## Overview

This is the new secure API (v1) with proper token-based authentication. All new mobile apps should use these endpoints instead of the legacy API.

## Base URL

```
https://your-domain.com/api/v1/
```

## Authentication

The API uses Bearer token authentication. Include the token in the `Authorization` header:

```
Authorization: Bearer <your-access-token>
```

## Endpoints

### Public Endpoints (No Authentication Required)

#### Register
```http
POST /api/v1/auth/register
Content-Type: application/json

{
    "phone": "09123456789",
    "name": "John Doe",
    "password": "password123",
    "confirm_password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "status": 201,
    "message": "Registration successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "phone": "09123456789",
            ...
        },
        "token": "your-access-token-here",
        "token_type": "Bearer",
        "expires_at": "2026-01-21T00:00:00.000Z"
    }
}
```

#### Login
```http
POST /api/v1/auth/login
Content-Type: application/json

{
    "phone": "09123456789",
    "password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "status": 200,
    "message": "Login successful",
    "data": {
        "user": { ... },
        "token": "your-access-token-here",
        "token_type": "Bearer",
        "expires_at": "2026-01-21T00:00:00.000Z"
    }
}
```

### Protected Endpoints (Authentication Required)

#### Get Profile
```http
GET /api/v1/profile
Authorization: Bearer <token>
```

#### Update Profile
```http
PUT /api/v1/profile
Authorization: Bearer <token>
Content-Type: application/json

{
    "name": "New Name",
    "email": "email@example.com"
}
```

#### Change Password
```http
POST /api/v1/auth/change-password
Authorization: Bearer <token>
Content-Type: application/json

{
    "current_password": "oldpassword",
    "new_password": "newpassword123",
    "confirm_password": "newpassword123"
}
```

#### Logout
```http
POST /api/v1/auth/logout
Authorization: Bearer <token>
```

#### Logout All Devices
```http
POST /api/v1/auth/logout-all
Authorization: Bearer <token>
```

#### Refresh Token
```http
POST /api/v1/auth/refresh-token
Authorization: Bearer <token>
```

## Error Responses

### Validation Error (422)
```json
{
    "success": false,
    "status": 422,
    "message": "Validation failed",
    "errors": {
        "phone": ["The phone field is required."],
        "password": ["The password must be at least 6 characters."]
    }
}
```

### Unauthorized (401)
```json
{
    "success": false,
    "status": 401,
    "message": "Unauthenticated. Please provide a valid access token."
}
```

### Server Error (500)
```json
{
    "success": false,
    "status": 500,
    "message": "Internal server error"
}
```

## Token Expiration

- Tokens expire after **30 days** by default
- Use the refresh token endpoint to get a new token before expiration
- Expired tokens will return a 401 error

## Security Notes

1. **NEVER** store the access token in localStorage (use secure storage)
2. Always use HTTPS in production
3. Tokens should be stored securely on the mobile device
4. Implement token refresh before expiration

## Flutter/React Native Usage

### Flutter Example
```dart
import 'package:http/http.dart' as http;
import 'dart:convert';

class ApiService {
  final String baseUrl = 'https://your-domain.com/api/v1';
  String? _token;

  Future<Map<String, dynamic>> login(String phone, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/auth/login'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({'phone': phone, 'password': password}),
    );
    
    final data = jsonDecode(response.body);
    if (data['success']) {
      _token = data['data']['token'];
    }
    return data;
  }

  Future<Map<String, dynamic>> getProfile() async {
    final response = await http.get(
      Uri.parse('$baseUrl/profile'),
      headers: {
        'Authorization': 'Bearer $_token',
        'Content-Type': 'application/json',
      },
    );
    return jsonDecode(response.body);
  }
}
```

### React Native Example
```javascript
const API_BASE = 'https://your-domain.com/api/v1';

const login = async (phone, password) => {
  const response = await fetch(`${API_BASE}/auth/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ phone, password }),
  });
  return response.json();
};

const getProfile = async (token) => {
  const response = await fetch(`${API_BASE}/profile`, {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json',
    },
  });
  return response.json();
};
```

## Migration Steps

After deploying these changes, run:

```bash
php artisan migrate
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

This will:
1. Create the `personal_access_tokens` table
2. Remove the `new_pass` column from the `users` table (SECURITY FIX)
