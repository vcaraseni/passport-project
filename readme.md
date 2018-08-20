## Simple laravel project with installed passport

## Api routes

### Register in Api

- **URL:** `/api/register`
- **Method:** `POST`
- **Headers:** `None`
- **URL Params:** `None`
- **Data Params:** 
    - **name:** `required | string`
    - **email:** `required | email`
    - **password:** `requred | min:6`
    - **password_confirmation:** `requred | min:6`
- **Success Response:**
    - **Code:** `200`
        
        - **Content:**
        ```
        {
            token_type: (string),
            expires_in: (unix timestamp),
            access_token: (string),
            refresh_token: (string)
        }
        ```
- **Error Response:** `401 Unauthorized`
- **Notes:**
